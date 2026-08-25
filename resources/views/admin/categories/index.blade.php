@extends('admin.layouts.app')

@section('title', 'Kategori Campaign')

@section('content')
    <section class="page-header">
        <div>
            <h1>Kategori Campaign</h1>
            <p>Kelola kategori untuk mengelompokkan campaign.</p>
        </div>

        <a
            href="{{ route('admin.categories.create') }}"
            class="btn btn-primary"
        >
            + Tambah Kategori
        </a>
    </section>

    <section class="card">
        @if ($categories->isEmpty())
            <div class="empty-state">
                <p>Belum ada kategori campaign.</p>

                <a
                    href="{{ route('admin.categories.create') }}"
                    class="btn btn-primary"
                    style="margin-top: 16px;"
                >
                    Tambah Kategori Pertama
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Slug</th>
                            <th>Campaign</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    {{ $categories->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <strong>{{ $category->name }}</strong>

                                    @if ($category->description)
                                        <div
                                            style="
                                                color: #6b7280;
                                                font-size: 12px;
                                                margin-top: 4px;
                                            "
                                        >
                                            {{ Str::limit(
                                                $category->description,
                                                70
                                            ) }}
                                        </div>
                                    @endif
                                </td>

                                <td>{{ $category->slug }}</td>

                                <td>
                                    {{ $category->campaigns_count }}
                                </td>

                                <td>
                                    @if ($category->is_active)
                                        <span class="badge badge-success">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="badge badge-secondary">
                                            Tidak Aktif
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="actions">
                                        <a
                                            href="{{ route(
                                                'admin.categories.edit',
                                                $category
                                            ) }}"
                                            class="btn btn-warning btn-sm"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route(
                                                'admin.categories.destroy',
                                                $category
                                            ) }}"
                                            method="POST"
                                            onsubmit="
                                                return confirm(
                                                    'Yakin ingin menghapus kategori ini?'
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

            @if ($categories->hasPages())
                <div class="pagination-wrapper">
                    {{ $categories->links() }}
                </div>
            @endif
        @endif
    </section>
@endsection