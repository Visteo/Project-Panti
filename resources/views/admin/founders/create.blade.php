@extends('admin.layouts.app')

@section('title', 'Tambah Pendiri')

@section('content')
    <section class="page-header">
        <div>
            <h1>Tambah Pendiri</h1>

            <p>
                Tambahkan profil pendiri atau pengurus yayasan.
            </p>
        </div>
    </section>

    <form
        action="{{ route('admin.founders.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        @include('admin.founders._form', [
            'submitLabel' => 'Simpan Pendiri',
        ])
    </form>
@endsection