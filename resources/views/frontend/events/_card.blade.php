<article class="public-event-card">
    <a href="{{ route('events.show', $event) }}">
        <div class="public-event-image">
            @if ($event->thumbnail)
                <img
                    src="{{ asset(
                        'storage/' . $event->thumbnail
                    ) }}"
                    alt="{{ $event->title }}"
                >
            @else
                <div class="public-event-placeholder">
                    HB
                </div>
            @endif

            <div class="public-event-date">
                <strong>
                    {{ $event->event_date->format('d') }}
                </strong>

                <span>
                    {{ $event->event_date
                        ->translatedFormat('M Y') }}
                </span>
            </div>
        </div>
    </a>

    <div class="public-event-body">
        <div class="event-meta">
            @if ($event->start_time)
                <span>
                    ⏱ {{ substr($event->start_time, 0, 5) }} WIB
                </span>
            @endif

            @if ($event->location)
                <span>
                    ◉ {{ $event->location }}
                </span>
            @endif
        </div>

        <a
            href="{{ route('events.show', $event) }}"
            style="text-decoration: none;"
        >
            <h3>{{ $event->title }}</h3>
        </a>

        <p>
            {{ Str::limit(
                $event->short_description
                    ?: strip_tags($event->description),
                120
            ) }}
        </p>

        <a
            href="{{ route('events.show', $event) }}"
            class="event-detail-link"
        >
            Lihat Detail →
        </a>
    </div>
</article>