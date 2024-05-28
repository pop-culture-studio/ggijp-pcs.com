<?php

use App\Console\Commands\UpdateCategoryMainCommand;
use App\Console\Commands\UpdateCategorySubCommand;
use App\Jobs\SitemapJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('sitemap', function () {
    SitemapJob::dispatch();
})->purpose('Create sitemap')->dailyAt('04:00');

Schedule::command(UpdateCategoryMainCommand::class)->dailyAt('05:00');
Schedule::command(UpdateCategorySubCommand::class)->dailyAt('06:00');
