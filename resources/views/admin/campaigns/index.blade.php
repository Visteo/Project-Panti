@extends('admin.layouts.app')

@section('title', 'Campaign')

@section('content')
    <section class="page-header">
        <div>
            <h1>Campaign</h1>
            <p>Kelola seluruh campaign donasi Harapan Bangsa.</p>
        </div>

        <a
            href="{{ route('admin.campaigns.create') }}"
            class="btn btn-primary"
        >
            + Tambah Campaign
        </a>
    </section>

    <section class="card" style="margin-bottom: 20px;">
        <form
            action="{{ route('admin.campaigns.index') }}"
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
                placeholder="Cari judul campaign..."
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
                    value="completed"
                    {{ request('status') === 'completed' ? 'selected' : '' }}
                >
                    Selesai
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
        @if ($campaigns->isEmpty())
            <div class="empty-state">
                <p>Belum ada campaign.</p>

                <a
                    href="{{ route('admin.campaigns.create') }}"
                    class="btn btn-primary"
                    style="margin-top: 15px;"
                >
                    Tambah Campaign Pertama
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Campaign</th>
                            <th>Kategori</th>
                            <th>Target</th>
                            <th>Terkumpul</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($campaigns as $campaign)
                            <tr>
                                <td>
                                    <div
                                        style="
                                            display: flex;
                                            align-items: center;
                                            gap: 12px;
                                            min-width: 260px;
                                        "
                                    >
                                        <img
                                            src="{{ asset(
                                                'storage/' .
                                                $campaign->thumbnail
                                            ) }}"
                                            alt="{{ $campaign->title }}"
                                            style="
                                                width: 72px;
                                                height: 50px;
                                                object-fit: cover;
                                                border-radius: 8px;
                                            "
                                        >

                                        <div>
                                            <strong>
                                                {{ $campaign->title }}
                                            </strong>

                                            @if ($campaign->is_featured)
                                                <div
                                                    style="
                                                        color: #d97706;
                                                        font-size: 12px;
                                                        margin-top: 5px;
                                                    "
                                                >
                                                    ★ Campaign unggulan
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <td>{{ $campaign->category->name }}</td>

                                <td>
                                    Rp {{ number_format(
                                        $campaign->target_amount,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </td>

                                <td>
                                    Rp {{ number_format(
                                        $campaign->collected_amount ?? 0,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </td>

                                <td>
                                    @if ($campaign->status === 'published')
                                        <span class="badge badge-success">
                                            Dipublikasikan
                                        </span>
                                    @elseif ($campaign->status === 'draft')
                                        <span class="badge badge-secondary">
                                            Draft
                                        </span>
                                    @elseif ($campaign->status === 'completed')
                                        <span
                                            class="badge"
                                            style="
                                                background: #dbeafe;
                                                color: #1e40af;
                                            "
                                        >
                                            Selesai
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
                                    <div class="actions">
                                        <a
                                            href="{{ route(
                                                'admin.campaigns.edit',
                                                $campaign
                                            ) }}"
                                            class="btn btn-warning btn-sm"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route(
                                                'admin.campaigns.destroy',
                                                $campaign
                                            ) }}"
                                            method="POST"
                                            onsubmit="
                                                return confirm(
                                                    'Yakin ingin menghapus campaign ini?'
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

            @if ($campaigns->hasPages())
                <div class="pagination-wrapper">
                    {{ $campaigns->links() }}
                </div>
            @endif
        @endif
    </section>
@endsection