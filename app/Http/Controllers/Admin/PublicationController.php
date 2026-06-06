<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Support\BibtexParser;

class PublicationController extends Controller
{
    public function index(Request $request): View
    {
        $publications = Publication::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->string('q')->toString();

                $query->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->where('title', 'like', "%{$search}%")
                        ->orWhere('title_en', 'like', "%{$search}%")
                        ->orWhere('authors', 'like', "%{$search}%")
                        ->orWhere('venue', 'like', "%{$search}%")
                        ->orWhere('research_area', 'like', "%{$search}%")
                        ->orWhere('doi', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('type'), function ($query) use ($request) {
                $query->where('type', $request->string('type')->toString());
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                if ($request->status === 'published') {
                    $query->where('is_published', true);
                }

                if ($request->status === 'draft') {
                    $query->where('is_published', false);
                }

                if ($request->status === 'featured') {
                    $query->where('is_featured', true);
                }
            })
            ->orderByDesc('year')
            ->orderBy('sort_order')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.publications.index', compact('publications'));
    }

    public function create(): View
    {
        $publication = new Publication([
            'type' => 'journal',
            'source' => 'manual',
            'is_published' => true,
            'citation_count' => 0,
            'sort_order' => 0,
        ]);

        return view('admin.publications.create', compact('publication'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data = $this->prepareData($request, $data);

        Publication::create($data);

        return redirect()
            ->route('admin.publications.index')
            ->with('success', 'Publication berhasil ditambahkan.');
    }

    public function edit(Publication $publication): View
    {
        return view('admin.publications.edit', compact('publication'));
    }

    public function update(Request $request, Publication $publication): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data = $this->prepareData($request, $data, $publication);

        $publication->update($data);

        return redirect()
            ->route('admin.publications.index')
            ->with('success', 'Publication berhasil diperbarui.');
    }

    public function destroy(Publication $publication): RedirectResponse
    {
        $publication->delete();

        return redirect()
            ->route('admin.publications.index')
            ->with('success', 'Publication berhasil dihapus.');
    }

    public function importForm(): View
    {
        return view('admin.publications.import');
    }

    public function importBibtex(Request $request, BibtexParser $parser): RedirectResponse
    {
        $request->validate([
            'bibtex' => ['required', 'string', 'min:10'],
            'default_status' => ['required', 'in:published,draft'],
            'duplicate_strategy' => ['required', 'in:skip,update,create'],
        ]);

        $entries = $parser->parse($request->input('bibtex'));

        if (count($entries) === 0) {
            return back()
                ->withInput()
                ->withErrors([
                    'bibtex' => 'Tidak ada entry BibTeX yang valid ditemukan.',
                ]);
        }

        $created = 0;
        $updated = 0;
        $skipped = 0;

        foreach ($entries as $entry) {
            $fields = $entry['fields'];

            $title = $fields['title'] ?? null;
            $authors = $fields['author'] ?? null;

            if (! $title || ! $authors) {
                $skipped++;
                continue;
            }

            $year = isset($fields['year']) && is_numeric($fields['year'])
                ? (int) $fields['year']
                : null;

            $doi = $fields['doi'] ?? null;

            $existing = $this->findExistingPublication($title, $doi);

            if ($existing && $request->input('duplicate_strategy') === 'skip') {
                $skipped++;
                continue;
            }

            $data = [
                'title' => $title,
                'title_en' => null,
                'authors' => str_replace(' and ', ', ', $authors),
                'year' => $year,
                'venue' => $fields['journal']
                    ?? $fields['booktitle']
                    ?? $fields['publisher']
                    ?? null,
                'publisher' => $fields['publisher'] ?? null,
                'volume' => $fields['volume'] ?? null,
                'issue' => $fields['number'] ?? $fields['issue'] ?? null,
                'pages' => $fields['pages'] ?? null,
                'type' => $this->mapBibtexType($entry['bibtex_type']),
                'source' => 'google_scholar',
                'doi' => $doi,
                'abstract' => $fields['abstract'] ?? null,
                'abstract_en' => null,
                'keywords' => $fields['keywords'] ?? null,
                'research_area' => null,
                'google_scholar_url' => null,
                'sinta_url' => null,
                'scopus_url' => null,
                'journal_url' => $fields['url'] ?? null,
                'pdf_url' => null,
                'citation_count' => 0,
                'is_featured' => false,
                'is_published' => $request->input('default_status') === 'published',
                'published_at' => $request->input('default_status') === 'published' ? now() : null,
                'sort_order' => 0,
            ];

            if ($existing && $request->input('duplicate_strategy') === 'update') {
                $existing->update($data);
                $updated++;
                continue;
            }

            $data['slug'] = $this->uniqueSlug($title);

            Publication::create($data);
            $created++;
        }

        return redirect()
            ->route('admin.publications.index')
            ->with('success', "Import selesai. Created: {$created}, Updated: {$updated}, Skipped: {$skipped}.");
    }

    private function findExistingPublication(string $title, ?string $doi = null): ?Publication
    {
        if ($doi) {
            $publication = Publication::query()
                ->where('doi', $doi)
                ->first();

            if ($publication) {
                return $publication;
            }
        }

        return Publication::query()
            ->where('title', $title)
            ->first();
    }

    private function mapBibtexType(string $type): string
    {
        return match (strtolower($type)) {
            'article' => 'journal',
            'inproceedings', 'conference' => 'conference',
            'incollection', 'inbook', 'book' => 'book_chapter',
            'proceedings' => 'proceeding',
            'phdthesis', 'mastersthesis' => 'thesis',
            default => 'other',
        };
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],

            'authors' => ['required', 'string'],
            'year' => ['nullable', 'integer', 'min:1900', 'max:' . ((int) date('Y') + 1)],

            'venue' => ['nullable', 'string', 'max:255'],
            'publisher' => ['nullable', 'string', 'max:255'],
            'volume' => ['nullable', 'string', 'max:255'],
            'issue' => ['nullable', 'string', 'max:255'],
            'pages' => ['nullable', 'string', 'max:255'],

            'type' => ['required', 'string', 'in:journal,conference,book_chapter,proceeding,thesis,other'],
            'source' => ['required', 'string', 'in:manual,google_scholar,sinta,scopus,crossref'],

            'doi' => ['nullable', 'string', 'max:255'],
            'abstract' => ['nullable', 'string'],
            'abstract_en' => ['nullable', 'string'],
            'keywords' => ['nullable', 'string', 'max:255'],
            'research_area' => ['nullable', 'string', 'max:255'],

            'google_scholar_url' => ['nullable', 'url', 'max:2048'],
            'sinta_url' => ['nullable', 'url', 'max:2048'],
            'scopus_url' => ['nullable', 'url', 'max:2048'],
            'journal_url' => ['nullable', 'url', 'max:2048'],
            'pdf_url' => ['nullable', 'url', 'max:2048'],

            'citation_count' => ['nullable', 'integer', 'min:0'],
            'sort_order' => ['nullable', 'integer'],
            'published_at' => ['nullable', 'date'],

            'is_featured' => ['nullable', 'boolean'],
            'is_published' => ['nullable', 'boolean'],
        ]);
    }

    private function prepareData(Request $request, array $data, ?Publication $publication = null): array
    {
        $data['slug'] = $this->uniqueSlug(
            $request->input('slug') ?: $data['title'],
            $publication?->id
        );

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');
        $data['citation_count'] = $data['citation_count'] ?? 0;
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($data['is_published']) {
            $data['published_at'] = $request->filled('published_at')
                ? $request->input('published_at')
                : ($publication?->published_at ?? now());
        } else {
            $data['published_at'] = null;
        }

        return $data;
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($value) ?: Str::random(8);
        $slug = $baseSlug;
        $counter = 2;

        while (
            Publication::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn($query) => $query->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
