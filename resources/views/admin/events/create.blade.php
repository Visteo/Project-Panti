@extends('admin.layouts.app')

@section('title', 'Tambah Acara')

@section('content')
    <section class="page-header">
        <div>
            <h1>Tambah Acara</h1>

            <p>
                Tambahkan agenda atau kegiatan baru.
            </p>
        </div>
    </section>

    <form
        action="{{ route('admin.events.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        @include('admin.events._form', [
            'submitLabel' => 'Simpan Acara',
        ])
    </form>
@endsection