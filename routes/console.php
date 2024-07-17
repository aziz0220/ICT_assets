<?php

use App\Jobs\PublishScheduledContent;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Artisan::command('schedule:publish', function () {
    dispatch(new PublishScheduledContent());
})->describe('Publish scheduled content');

Schedule::job(new PublishScheduledContent)->everyMinute();
