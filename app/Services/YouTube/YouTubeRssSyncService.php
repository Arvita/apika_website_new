<?php

namespace App\Services\YouTube;

use App\Models\Video;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class YouTubeRssSyncService
{
    public function sync(): array
    {
        $apiKey = config('services.youtube.key');
        $channelId = config('services.youtube.channel_id');

        if (! $apiKey) {
            throw new \RuntimeException('YOUTUBE_API_KEY belum diatur di .env');
        }

        if (! $channelId) {
            throw new \RuntimeException('YOUTUBE_CHANNEL_ID belum diatur di .env');
        }

        $uploadsPlaylistId = $this->getUploadsPlaylistId($channelId, $apiKey);
        $items = $this->getUploadedVideos($uploadsPlaylistId, $apiKey);

        $created = 0;
        $updated = 0;

        foreach ($items as $item) {
            $snippet = $item['snippet'] ?? [];
            $contentDetails = $item['contentDetails'] ?? [];

            $youtubeId = $contentDetails['videoId'] ?? null;

            if (! $youtubeId) {
                continue;
            }

            $title = trim($snippet['title'] ?? 'Untitled Video');

            if (in_array($title, ['Private video', 'Deleted video'], true)) {
                continue;
            }

            $publishedAt = isset($snippet['publishedAt'])
                ? Carbon::parse($snippet['publishedAt'])
                : null;

            $existing = Video::where('youtube_id', $youtubeId)->first();

            $video = Video::updateOrCreate(
                ['youtube_id' => $youtubeId],
                [
                    'title' => $existing?->title ?: $title,
                    'slug' => $existing?->slug ?: Video::uniqueSlug($title),
                    'youtube_url' => 'https://www.youtube.com/watch?v=' . $youtubeId,
                    'youtube_id' => $youtubeId,
                    'description' => $existing?->description ?: ($snippet['description'] ?? null),
                    'year' => $publishedAt?->year,
                    'is_published' => $existing?->is_published ?? true,
                    'published_at' => $publishedAt,
                    'sort_order' => $existing?->sort_order ?? 0,
                ]
            );

            $video->wasRecentlyCreated ? $created++ : $updated++;
        }

        return [
            'created' => $created,
            'updated' => $updated,
            'total' => $created + $updated,
        ];
    }

    private function getUploadsPlaylistId(string $channelId, string $apiKey): string
    {
        $response = Http::timeout(30)
            ->retry(2, 500)
            ->get('https://www.googleapis.com/youtube/v3/channels', [
                'part' => 'contentDetails',
                'id' => $channelId,
                'key' => $apiKey,
            ]);

        if (! $response->successful()) {
            throw new \RuntimeException(
                'Gagal mengambil channel YouTube. Status: '
                . $response->status()
                . ' Body: '
                . Str::limit($response->body(), 300)
            );
        }

        $data = $response->json();

        $playlistId = $data['items'][0]['contentDetails']['relatedPlaylists']['uploads'] ?? null;

        if (! $playlistId) {
            throw new \RuntimeException('Uploads playlist tidak ditemukan. Cek YOUTUBE_CHANNEL_ID.');
        }

        return $playlistId;
    }

    private function getUploadedVideos(string $playlistId, string $apiKey): array
    {
        $items = [];
        $pageToken = null;

        do {
            $response = Http::timeout(30)
                ->retry(2, 500)
                ->get('https://www.googleapis.com/youtube/v3/playlistItems', [
                    'part' => 'snippet,contentDetails',
                    'playlistId' => $playlistId,
                    'maxResults' => 50,
                    'pageToken' => $pageToken,
                    'key' => $apiKey,
                ]);

            if (! $response->successful()) {
                throw new \RuntimeException(
                    'Gagal mengambil video YouTube. Status: '
                    . $response->status()
                    . ' Body: '
                    . Str::limit($response->body(), 300)
                );
            }

            $data = $response->json();

            $items = array_merge($items, $data['items'] ?? []);
            $pageToken = $data['nextPageToken'] ?? null;
        } while ($pageToken);

        return $items;
    }
}