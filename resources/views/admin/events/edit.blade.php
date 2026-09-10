@extends('admin.layouts.app')

@section('title', 'Edit Acara')

@section('content')
    <section class="page-header">
        <div>
            <h1>Edit Acara</h1>

            <p>
                Perbarui informasi acara atau kegiatan.
            </p>
        </div>
    </section>

    <form
        action="{{ route('admin.events.update', $event) }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        @include('admin.events._form', [
            'event' => $event,
            'submitLabel' => 'Simpan Perubahan',
        ])
    </form>
@endsection