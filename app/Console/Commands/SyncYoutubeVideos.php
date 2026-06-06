<?php

namespace App\Console\Commands;

use App\Services\YouTube\YouTubeRssSyncService;
use Illuminate\Console\Command;

class SyncYoutubeVideos extends Command
{
    protected $signature = 'videos:sync-youtube';

    protected $description = 'Sync videos from Arvita Agus Kurniasari YouTube RSS feed';

    public function handle(YouTubeRssSyncService $service): int
    {
        $this->info('Syncing YouTube videos...');

        $result = $service->sync();

        $this->info("Done. Created: {$result['created']}, Updated: {$result['updated']}, Total: {$result['total']}");

        return self::SUCCESS;
    }
}