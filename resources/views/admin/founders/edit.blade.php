@extends('admin.layouts.app')

@section('title', 'Edit Pendiri')

@section('content')
    <section class="page-header">
        <div>
            <h1>Edit Pendiri</h1>

            <p>
                Perbarui profil pendiri atau pengurus yayasan.
            </p>
        </div>
    </section>

    <form
        action="{{ route(
            'admin.founders.update',
            $founder
        ) }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        @include('admin.founders._form', [
            'founder' => $founder,
            'submitLabel' => 'Simpan Perubahan',
        ])
    </form>
@endsection