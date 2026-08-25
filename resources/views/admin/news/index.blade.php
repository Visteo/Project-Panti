@extends('admin.layouts.app')

@section('title', 'Berita dan Kegiatan')

@section('content')
    <section class="page-header">
        <div>
            <h1>Berita dan Kegiatan</h1>
            <p>Kelola informasi terbaru Harapan Bangsa.</p>
        </div>

        <a
            href="{{ route('admin.news.create') }}"
            class="btn btn-primary"
        >
            + Tambah Berita
        </a>
    </section>

    <section class="card" style="margin-bottom: 20px;">
        <form
            action="{{ route('admin.news.index') }}"
            method="GET"
            style="
                display: grid;
                grid-template-columns: 1fr 220px auto;
                gap: 12px;
            "
        >
            <input
                type="text"
                name="search"
                class="form-control"
                value="{{ request('search') }}"
                placeholder="Cari judul berita..."
            >

            <select name="status" class="form-control">
                <option value="">Semua status</option>

                <option
                    value="draft"
                    {{ request('status') === 'draft' ? 'selected' : '' }}
                >
                    Draft
                </option>

                <option
                    value="published"
                    {{ request('status') === 'published' ? 'selected' : '' }}
                >
                    Dipublikasikan
                </option>

                <option
                    value="inactive"
                    {{ request('status') === 'inactive' ? 'selected' : '' }}
                >
                    Tidak Aktif
                </option>
            </select>

            <button type="submit" class="btn btn-primary">
                Filter
            </button>
        </form>
    </section>

    <section class="card">
        @if ($news->isEmpty())
            <div class="empty-state">
                Belum ada berita atau kegiatan.
            </div>
        @else
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Berita</th>
                            <th>Penulis</th>
                            <th>Status</th>
                            <th>Publikasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($news as $item)
                            <tr>
                                <td>
                                    <div
                                        style="
                                            display: flex;
                                            align-items: center;
                                            gap: 12px;
                                            min-width: 300px;
                                        "
                                    >
                                        <img
                                            src="{{ asset(
                                                'storage/' .
                                                $item->thumbnail
                                            ) }}"
                                            alt="{{ $item->title }}"
                                            style="
                                                width: 75px;
                                                height: 52px;
                                                object-fit: cover;
                                                border-radius: 8px;
                                            "
                                        >

                                        <div>
                                            <strong>
                                                {{ $item->title }}
                                            </strong>

                                            <div
                                                style="
                                                    margin-top: 4px;
                                                    color: #6b7280;
                                                    font-size: 12px;
                                                "
                                            >
                                                {{ Str::limit(
                                                    $item->excerpt,
                                                    70
                                                ) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>{{ $item->author->name }}</td>

                                <td>
                                    @if ($item->status === 'published')
                                        <span class="badge badge-success">
                                            Dipublikasikan
                                        </span>
                                    @elseif ($item->status === 'draft')
                                        <span class="badge badge-secondary">
                                            Draft
                                        </span>
                                    @else
                                        <span
                                            class="badge"
                                            style="
                                                background: #fee2e2;
                                                color: #991b1b;
                                            "
                                        >
                                            Tidak Aktif
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    {{ $item->published_at
                                        ? $item->published_at
                                            ->format('d/m/Y H:i')
                                        : '-' }}
                                </td>

                                <td>
                                    <div class="actions">
                                        <a
                                            href="{{ route(
                                                'admin.news.edit',
                                                $item
                                            ) }}"
                                            class="btn btn-warning btn-sm"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route(
                                                'admin.news.destroy',
                                                $item
                                            ) }}"
                                            method="POST"
                                            onsubmit="
                                                return confirm(
                                                    'Yakin ingin menghapus berita ini?'
                                                )
                                            "
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm"
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

            @if ($news->hasPages())
                <div class="pagination-wrapper">
                    {{ $news->links() }}
                </div>
            @endif
        @endif
    </section>
@endsection