@extends('admin.layouts.app')

@section('title', 'Edit Berita')

@section('content')
    <section class="page-header">
        <div>
            <h1>Edit Berita</h1>
            <p>Perbarui berita atau informasi kegiatan.</p>
        </div>
    </section>

    <section class="card" style="max-width: 900px;">
        <form
            action="{{ route('admin.news.update', $news) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            @include('admin.news._form')
        </form>
    </section>
@endsection