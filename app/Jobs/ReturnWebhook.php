<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use App\Constants\Status;
use App\Http\Resources\WebhookResource;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;

class ReturnWebhook extends Job
{
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $guzzle = new Client();

        try {
            $resource = (new WebhookResource($this->webhook))->resolve();
            $response = $guzzle->post($this->webhook->webhook, [
                'json' => $resource,
            ]);

            $this->webhook->status   = Status::SUCCESSFUL;
            $this->webhook->response = $response->getStatusCode();
        } catch (ConnectException $e) {
            $this->webhook->status = Status::INVALID_HOST;
        } catch (\InvalidArgumentException $e) {
            $this->webhook->status = Status::INVALID_WEBHOOK_URL;
        } catch (ClientException $e) {
            \Log::info($e->getResponse()->getBody());
            $this->webhook->response = $e->getResponse()->getStatusCode();
            $this->webhook->status   = Status::ERROR_WEBHOOK;
        } catch (ServerException $e) {
            \Log::info($e->getResponse()->getBody());
            $this->webhook->response = $e->getResponse()->getStatusCode();
            $this->webhook->status   = Status::ERROR_WEBHOOK;
        } catch (\Exception $e) {
            throw $e;
        }

        $this->webhook->save();
    }
}
