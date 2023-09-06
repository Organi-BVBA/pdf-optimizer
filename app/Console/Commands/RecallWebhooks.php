<?php

namespace App\Console\Commands;

use App\Models\Webhook;
use App\Constants\Status;
use App\Jobs\ReturnWebhook;
use Illuminate\Console\Command;

class RecallWebhooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webhooks:retry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rerun all jobs stuck in \'calling webhook\'.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $webhooks = Webhook::where('status', Status::CALLING_WEBHOOK)
            ->where('wait', false)
            ->get();

        $bar = $this->output->createProgressBar($webhooks->count());
        $bar->start();

        foreach ($webhooks as $webhook) {
            ReturnWebhook::dispatch($webhook);

            $bar->advance();
        }

        $bar->finish();

        return Command::SUCCESS;
    }
}
