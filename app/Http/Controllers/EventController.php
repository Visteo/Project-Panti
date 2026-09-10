<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        $upcomingEvents = Event::published()
            ->whereDate('event_date', '>=', today())
            ->orderBy('event_date')
            ->paginate(9);

        $pastEvents = Event::published()
            ->whereDate('event_date', '<', today())
            ->orderByDesc('event_date')
            ->limit(6)
            ->get();

        return view(
            'frontend.events.index',
            compact(
                'upcomingEvents',
                'pastEvents'
            )
        );
    }

    public function show(Event $event): View
    {
        abort_unless(
            $event->status === 'published'
            && $event->published_at
            && $event->published_at->isPast(),
            404
        );

        $otherEvents = Event::published()
            ->whereKeyNot($event->id)
            ->orderByDesc('is_featured')
            ->orderByDesc('event_date')
            ->limit(3)
            ->get();

        return view(
            'frontend.events.show',
            compact(
                'event',
                'otherEvents'
            )
        );
    }
}