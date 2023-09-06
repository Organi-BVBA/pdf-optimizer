<?php

namespace App\Http\Controllers;

use App\Constants\Type;
use App\Models\Webhook;
use App\Constants\Status;
use App\Jobs\OptimizePdf;
use App\Http\Requests\UploadRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\WebhookResource;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function __invoke(UploadRequest $request): WebhookResource
    {
        $webhook         = new Webhook($request->validated());
        $webhook->type   = Type::UPLOAD;
        $webhook->status = Status::OPTIMIZING_PDF;
        $webhook->ext    = 'pdf';

        // Auth isn't always available. It can be disabled for testing
        if (Auth::check()) {
            $webhook->user()->associate(Auth::user());
        } else {
            // In that case, set the user to 0
            $webhook->user_id = 0;
        }

        $webhook->save();

        $path = $request->file('upload')->storeAs('upload', $webhook->filename);

        $size = Storage::size($path);

        $webhook->original_size = $size;
        $webhook->save();

        if ($webhook->wait) {
            OptimizePdf::dispatchSync($webhook);

            $webhook->refresh();

            return new WebhookResource($webhook);
        }

        OptimizePdf::dispatch($webhook);

        return new WebhookResource($webhook);
    }
}
