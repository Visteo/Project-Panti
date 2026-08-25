@extends('admin.layouts.app')

@section('title', 'Tambah Berita')

@section('content')
    <section class="page-header">
        <div>
            <h1>Tambah Berita</h1>
            <p>Buat berita atau informasi kegiatan baru.</p>
        </div>
    </section>

    <section class="card" style="max-width: 900px;">
        <form
            action="{{ route('admin.news.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            @include('admin.news._form')
        </form>
    </section>
@endsection