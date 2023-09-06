<?php

namespace App\Jobs;

use App\Models\Webhook;
use App\Constants\Status;
use Illuminate\Support\Facades\Storage;

class OptimizePdf extends Job
{
    /**
     * Create a new job instance.
     */
    public function __construct(Webhook $webhook)
    {
        parent::__construct($webhook);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Load input image
        $in = Storage::path($this->webhook->upload_filename);

        $shortOut = implode('/', ['optimized', $this->webhook->filename]);

        $out = Storage::path($shortOut);

        shell_exec("ps2pdf {$in} {$out}");

        // shell_exec("exiftool -\"Producer\"=\"Organi\" -\"Creator\"=\"Organi\" -\"Author\"=\"Organi\" {$out}");
        shell_exec("exiftool -all= {$out}");

        $size = Storage::size($shortOut);

        $this->webhook->optimized_size = $size;

        if (! $this->webhook->wait) {
            $this->webhook->status = Status::CALLING_WEBHOOK;
            $this->webhook->save();

            ReturnWebhook::dispatch($this->webhook);
        } else {
            $this->webhook->status = Status::SUCCESSFUL;
            $this->webhook->save();
        }

        // Delete the original
        Storage::delete($this->webhook->upload_filename);
    }
}
