@extends('admin.layouts.app')

@section('title', 'Edit Campaign')

@section('content')
    <section class="page-header">
        <div>
            <h1>Edit Campaign</h1>
            <p>Perbarui informasi campaign donasi.</p>
        </div>
    </section>

    <section class="card" style="max-width: 900px;">
        <form
            action="{{ route(
                'admin.campaigns.update',
                $campaign
            ) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            @include('admin.campaigns._form')
        </form>
    </section>
@endsection