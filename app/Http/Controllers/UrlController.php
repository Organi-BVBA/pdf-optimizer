<?php

namespace App\Http\Controllers;

use App\Constants\Type;
use App\Jobs\UploadPdf;
use App\Models\Webhook;
use App\Constants\Status;
use App\Http\Requests\UrlRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\WebhookResource;

class UrlController extends Controller
{
    public function __invoke(UrlRequest $request): WebhookResource
    {
        $webhook         = new Webhook($request->validated());
        $webhook->type   = Type::URL;
        $webhook->status = Status::UPLOADING_PDF;

        // Auth isn't always available. It can be disabled for testing
        if (Auth::check()) {
            $webhook->user()->associate(Auth::user());
        } else {
            // In that case, set the user to 0
            $webhook->user_id = 0;
        }

        $webhook->save();

        if ($webhook->wait) {
            UploadPdf::dispatchSync($webhook);

            $webhook->refresh();

            return new WebhookResource($webhook);
        }

        UploadPdf::dispatch($webhook);

        return new WebhookResource($webhook);
    }
}
