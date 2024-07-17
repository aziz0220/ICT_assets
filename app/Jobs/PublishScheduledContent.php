<?php

namespace App\Jobs;

use App\Models\Content;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PublishScheduledContent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $contents = Content::where('scheduled_at', '<=', now())->whereNull('published_at')->get();
        foreach ($contents as $content) {
            $content->published_at = now();
            $content->save();
        }
    }

}
