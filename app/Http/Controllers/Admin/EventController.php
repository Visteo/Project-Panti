<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(Request $request): View
    {
        $events = Event::query()
            ->when(
                $request->filled('search'),
                function ($query) use ($request) {
                    $search = $request->string('search')->trim();

                    $query->where(function ($query) use ($search) {
                        $query
                            ->where('title', 'like', "%{$search}%")
                            ->orWhere(
                                'location',
                                'like',
                                "%{$search}%"
                            );
                    });
                }
            )
            ->when(
                $request->filled('status'),
                fn ($query) => $query->where(
                    'status',
                    $request->status
                )
            )
            ->orderByDesc('event_date')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.events.index',
            compact('events')
        );
    }

    public function create(): View
    {
        return view('admin.events.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->merge([
            'is_featured' => $request->boolean('is_featured'),
        ]);

        $validated = $this->validateEvent($request);

        $validated['slug'] = $this->generateUniqueSlug(
            $validated['title']
        );

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('events', 'public');
        }

        $validated['published_at'] =
            $validated['status'] === 'published'
                ? now()
                : null;

        Event::create($validated);

        return redirect()
            ->route('admin.events.index')
            ->with(
                'success',
                'Acara berhasil ditambahkan.'
            );
    }

    public function edit(Event $event): View
    {
        return view(
            'admin.events.edit',
            compact('event')
        );
    }

    public function update(
        Request $request,
        Event $event
    ): RedirectResponse {
        $request->merge([
            'is_featured' => $request->boolean('is_featured'),
        ]);

        $validated = $this->validateEvent(
            $request,
            $event
        );

        if ($validated['title'] !== $event->title) {
            $validated['slug'] = $this->generateUniqueSlug(
                $validated['title'],
                $event->id
            );
        }

        if ($request->hasFile('thumbnail')) {
            $newThumbnail = $request
                ->file('thumbnail')
                ->store('events', 'public');

            if ($event->thumbnail) {
                Storage::disk('public')
                    ->delete($event->thumbnail);
            }

            $validated['thumbnail'] = $newThumbnail;
        }

        if ($validated['status'] === 'published') {
            $validated['published_at'] =
                $event->published_at ?? now();
        } else {
            $validated['published_at'] = null;
        }

        $event->update($validated);

        return redirect()
            ->route('admin.events.index')
            ->with(
                'success',
                'Acara berhasil diperbarui.'
            );
    }

    public function destroy(Event $event): RedirectResponse
    {
        if ($event->thumbnail) {
            Storage::disk('public')
                ->delete($event->thumbnail);
        }

        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with(
                'success',
                'Acara berhasil dihapus.'
            );
    }

    private function validateEvent(
        Request $request,
        ?Event $event = null
    ): array {
        return $request->validate(
            [
                'title' => [
                    'required',
                    'string',
                    'max:200',
                ],

                'short_description' => [
                    'nullable',
                    'string',
                    'max:500',
                ],

                'description' => [
                    'required',
                    'string',
                ],

                'event_date' => [
                    'required',
                    'date',
                ],

                'start_time' => [
                    'nullable',
                    'date_format:H:i',
                ],

                'end_time' => [
                    'nullable',
                    'date_format:H:i',
                    'after:start_time',
                ],

                'location' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'thumbnail' => [
                    $event ? 'nullable' : 'required',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:4096',
                ],

                'status' => [
                    'required',
                    Rule::in([
                        'draft',
                        'published',
                    ]),
                ],

                'is_featured' => [
                    'required',
                    'boolean',
                ],
            ],
            [
                'title.required' =>
                    'Nama acara wajib diisi.',

                'description.required' =>
                    'Deskripsi acara wajib diisi.',

                'event_date.required' =>
                    'Tanggal acara wajib diisi.',

                'event_date.date' =>
                    'Tanggal acara tidak valid.',

                'end_time.after' =>
                    'Waktu selesai harus setelah waktu mulai.',

                'thumbnail.required' =>
                    'Foto acara wajib dipilih.',

                'thumbnail.image' =>
                    'File harus berupa gambar.',

                'thumbnail.mimes' =>
                    'Foto harus berformat JPG, PNG, atau WEBP.',

                'thumbnail.max' =>
                    'Ukuran foto maksimal 4 MB.',

                'status.required' =>
                    'Status acara wajib dipilih.',
            ]
        );
    }

    private function generateUniqueSlug(
        string $title,
        ?int $ignoreId = null
    ): string {
        $baseSlug = Str::slug($title);
        $baseSlug = $baseSlug !== ''
            ? $baseSlug
            : 'acara';

        $slug = $baseSlug;
        $counter = 2;

        while (
            Event::query()
                ->when(
                    $ignoreId,
                    fn ($query) => $query->where(
                        'id',
                        '!=',
                        $ignoreId
                    )
                )
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}