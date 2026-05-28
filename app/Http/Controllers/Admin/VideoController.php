<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $videos = Video::query()
            ->when($request->q, function ($query, $q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('title', 'like', "%{$q}%")
                        ->orWhere('title_en', 'like', "%{$q}%")
                        ->orWhere('category', 'like', "%{$q}%")
                        ->orWhere('topic', 'like', "%{$q}%");
                });
            })
            ->when($request->status === 'published', fn($q) => $q->where('is_published', true))
            ->when($request->status === 'draft', fn($q) => $q->where('is_published', false))
            ->orderBy('sort_order')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.create', [
            'video' => new Video(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        $youtubeId = Video::extractYoutubeId($data['youtube_url']);

        if (! $youtubeId) {
            return back()
                ->withErrors(['youtube_url' => 'URL YouTube tidak valid.'])
                ->withInput();
        }

        $data['youtube_id'] = $youtubeId;
        $data['slug'] = Video::uniqueSlug($data['title']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;

        Video::create($data);

        return redirect()
            ->route('admin.videos.index')
            ->with('success', 'Video berhasil ditambahkan.');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $data = $this->validatedData($request);

        $youtubeId = Video::extractYoutubeId($data['youtube_url']);

        if (! $youtubeId) {
            return back()
                ->withErrors(['youtube_url' => 'URL YouTube tidak valid.'])
                ->withInput();
        }

        $data['youtube_id'] = $youtubeId;
        $data['slug'] = Video::uniqueSlug($data['title'], $video->id);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');

        if ($data['is_published'] && ! $video->published_at) {
            $data['published_at'] = now();
        }

        if (! $data['is_published']) {
            $data['published_at'] = null;
        }

        $video->update($data);

        return redirect()
            ->route('admin.videos.index')
            ->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()
            ->route('admin.videos.index')
            ->with('success', 'Video berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'youtube_url' => ['required', 'url', 'max:255'],
            'description' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'max:100'],
            'topic' => ['nullable', 'string', 'max:150'],
            'year' => ['nullable', 'integer', 'min:1900', 'max:' . now()->year],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
