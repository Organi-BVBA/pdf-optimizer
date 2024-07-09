<?php

namespace App\Http\Resources;

use App\Constants\Status;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WebhookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $out = [
            'success' => true,
            'id'      => $this->uuid,
            'status'  => $this->status,
            'message' => $this->status_description,
        ];

        if (! in_array($this->status, [Status::SUCCESSFUL, Status::CALLING_WEBHOOK])) {
            return $out;
        }

        $out['url']            = $this->optimized_url;
        $out['original_size']  = $this->original_size;
        $out['optimized_size'] = $this->optimized_size;

        return $out;
    }
}
