<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Webhook;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class Clear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all stored images older than 15 minutes.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $webhooks = Webhook::where('created_at', '<', Carbon::now()->subMinutes(20))->get();

        foreach ($webhooks as $webhook) {
            Storage::delete($webhook->optimized_filename);
            Storage::delete($webhook->upload_filename);
        }

        return 0;
    }
}
