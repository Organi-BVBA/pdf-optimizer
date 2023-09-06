<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use App\Constants\Status;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\ClientException;

class UploadPdf extends Job
{
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $guzzle = new Client();

        try {
            $response = $guzzle->get($this->webhook->url);
        } catch (ClientException $e) {
            $this->webhook->status = Status::COULDNT_RETRIEVE_FILE;
            $this->webhook->save();

            return;
        }

        $contents = $response->getBody()->getContents();

        // Store the ext on the webhook so it's available in the
        // upload_filename and optimized_filename properties
        $this->webhook->ext = 'pdf';

        Storage::put($this->webhook->upload_filename, $contents);

        $size = Storage::size($this->webhook->upload_filename);

        $this->webhook->status        = Status::OPTIMIZING_PDF;
        $this->webhook->original_size = $size;
        $this->webhook->save();

        if ($this->webhook->wait) {
            OptimizePdf::dispatchSync($this->webhook);

            return;
        }

        OptimizePdf::dispatch($this->webhook);
    }
}
