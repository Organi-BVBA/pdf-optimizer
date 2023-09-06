<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Webhook;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class WebhookController extends Controller
{
    public function index(Request $request): Response
    {
        $data = $this->getWebhooks($request);

        return Inertia::render('Webhooks', $data);
    }

    public function search(Request $request): JsonResponse
    {
        return response()->json($this->getWebhooks($request));
    }

    public function show(string $uuid): Response
    {
        $webhook = Auth::user()->webhooks()
            ->whereUuid($uuid)
            ->first()
            ->append([
                'status_description', 'status_color', 'response_color',
                'original_size_readable', 'optimized_size_readable',
                'saved_readable', 'saved_percentage',
            ]);

        return Inertia::render('Webhook', compact('webhook'));
    }

    private function getWebhooks(Request $request): array
    {
        if ($q = $request->get('q')) {
            $webhooks = Webhook::search($q)->where('user_id', Auth::user()->id);
        } else {
            $webhooks = Auth::user()->webhooks()->orderByDesc('id');
        }

        $webhooks = $webhooks
            ->paginate(10)
            ->through(function ($webhook) {
                return [
                    'uuid'               => $webhook->uuid,
                    'status'             => $webhook->status,
                    'status_description' => $webhook->status_description,
                    'status_color'       => $webhook->status_color,
                    'response'           => $webhook->response,
                    'response_color'     => $webhook->response_color,
                    'created_at'         => $webhook->created_at,
                ];
            });

        return compact('webhooks', 'q');
    }
}
