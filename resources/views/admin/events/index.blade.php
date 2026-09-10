@extends('admin.layouts.app')

@section('title', 'Acara & Kegiatan')

@section('content')
    <section class="page-header">
        <div>
            <h1>Acara & Kegiatan</h1>

            <p>
                Kelola agenda dan kegiatan Yayasan Harapan Bangsa.
            </p>
        </div>

        <a
            href="{{ route('admin.events.create') }}"
            class="btn btn-primary"
        >
            Tambah Acara
        </a>
    </section>

    <section class="card" style="margin-bottom: 22px;">
        <form
            action="{{ route('admin.events.index') }}"
            method="GET"
        >
            <div class="event-filter-grid">
                <div class="form-group" style="margin: 0;">
                    <label for="search" class="form-label">
                        Pencarian
                    </label>

                    <input
                        type="text"
                        id="search"
                        name="search"
                        class="form-control"
                        value="{{ request('search') }}"
                        placeholder="Cari nama acara atau lokasi"
                    >
                </div>

                <div class="form-group" style="margin: 0;">
                    <label for="status" class="form-label">
                        Status
                    </label>

                    <select
                        id="status"
                        name="status"
                        class="form-control"
                    >
                        <option value="">Semua Status</option>

                        <option
                            value="published"
                            @selected(request('status') === 'published')
                        >
                            Dipublikasikan
                        </option>

                        <option
                            value="draft"
                            @selected(request('status') === 'draft')
                        >
                            Draft
                        </option>
                    </select>
                </div>

                <div class="event-filter-actions">
                    <button type="submit" class="btn btn-primary">
                        Cari
                    </button>

                    <a
                        href="{{ route('admin.events.index') }}"
                        class="btn"
                    >
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </section>

    <section class="card">
        @if ($events->isEmpty())
            <div class="empty-state">
                Belum ada acara atau kegiatan.
            </div>
        @else
            <div class="table-responsive">
                <table class="event-table">
                    <thead>
                        <tr>
                            <th>Acara</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Unggulan</th>
                            <th style="text-align: right;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td>
                                    <div class="event-identity">
                                        @if ($event->thumbnail)
                                            <img
                                                src="{{ asset(
                                                    'storage/' .
                                                    $event->thumbnail
                                                ) }}"
                                                alt="{{ $event->title }}"
                                            >
                                        @else
                                            <div class="event-placeholder">
                                                AC
                                            </div>
                                        @endif

                                        <div>
                                            <strong>
                                                {{ $event->title }}
                                            </strong>

                                            @if ($event->short_description)
                                                <span>
                                                    {{ Str::limit(
                                                        $event->short_description,
                                                        65
                                                    ) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <strong>
                                        {{ $event->event_date
                                            ->translatedFormat('d M Y') }}
                                    </strong>

                                    @if ($event->start_time)
                                        <span class="table-note">
                                            {{ substr(
                                                $event->start_time,
                                                0,
                                                5
                                            ) }}
                                            WIB
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    {{ $event->location ?: '-' }}
                                </td>

                                <td>
                                    <span
                                        class="status-badge {{
                                            $event->status === 'published'
                                                ? 'status-published'
                                                : 'status-draft'
                                        }}"
                                    >
                                        {{ $event->status === 'published'
                                            ? 'Dipublikasikan'
                                            : 'Draft' }}
                                    </span>
                                </td>

                                <td>
                                    {{ $event->is_featured ? 'Ya' : 'Tidak' }}
                                </td>

                                <td>
                                    <div class="table-actions">
                                        <a
                                            href="{{ route(
                                                'admin.events.edit',
                                                $event
                                            ) }}"
                                            class="action-edit"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route(
                                                'admin.events.destroy',
                                                $event
                                            ) }}"
                                            method="POST"
                                            onsubmit="
                                                return confirm(
                                                    'Hapus acara ini?'
                                                )
                                            "
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-delete"
                                            >
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($events->hasPages())
                <div style="margin-top: 24px;">
                    {{ $events->links() }}
                </div>
            @endif
        @endif
    </section>
@endsection

@push('styles')
    <style>
        .event-filter-grid {
            display: grid;
            grid-template-columns: 1fr 230px auto;
            align-items: end;
            gap: 16px;
        }

        .event-filter-actions {
            display: flex;
            gap: 8px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .event-table {
            width: 100%;
            border-collapse: collapse;
        }

        .event-table th {
            padding: 13px 15px;
            border-bottom: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 12px;
            text-align: left;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .event-table td {
            padding: 16px 15px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .event-identity {
            display: flex;
            align-items: center;
            min-width: 280px;
            gap: 13px;
        }

        .event-identity img,
        .event-placeholder {
            width: 65px;
            height: 50px;
            flex: 0 0 65px;
            border-radius: 9px;
            object-fit: cover;
        }

        .event-placeholder {
            display: grid;
            place-items: center;
            background: #e0f2fe;
            color: #075985;
            font-size: 12px;
            font-weight: 800;
        }

        .event-identity strong,
        .event-identity span,
        .table-note {
            display: block;
        }

        .event-identity span,
        .table-note {
            margin-top: 4px;
            color: #6b7280;
            font-size: 12px;
        }

        .status-badge {
            display: inline-flex;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 800;
        }

        .status-published {
            background: #dcfce7;
            color: #166534;
        }

        .status-draft {
            background: #fef3c7;
            color: #92400e;
        }

        .table-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .action-edit,
        .action-delete {
            padding: 7px 11px;
            border: 0;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
        }

        .action-edit {
            background: #e0f2fe;
            color: #075985;
        }

        .action-delete {
            background: #fee2e2;
            color: #b91c1c;
        }

        @media (max-width: 800px) {
            .event-filter-grid {
                grid-template-columns: 1fr;
            }

            .event-filter-actions .btn {
                flex: 1;
            }
        }
    </style>
@endpush