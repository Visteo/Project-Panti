@extends('admin.layouts.app')

@section('title', 'Tambah Campaign')

@section('content')
    <section class="page-header">
        <div>
            <h1>Tambah Campaign</h1>
            <p>Buat campaign donasi baru.</p>
        </div>
    </section>

    <section class="card" style="max-width: 900px;">
        <form
            action="{{ route('admin.campaigns.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            @include('admin.campaigns._form')
        </form>
    </section>
@endsection