@extends('admin.layouts.app')

@section('title', 'Edit Kategori')

@section('content')
    <section class="page-header">
        <div>
            <h1>Edit Kategori</h1>
            <p>Perbarui informasi kategori campaign.</p>
        </div>
    </section>

    <section class="card" style="max-width: 750px;">
        <form
            action="{{ route('admin.categories.update', $category) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label" for="name">
                    Nama Kategori
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control"
                    value="{{ old('name', $category->name) }}"
                    required
                    autofocus
                >

                @error('name')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="description">
                    Deskripsi
                </label>

                <textarea
                    id="description"
                    name="description"
                    class="form-control"
                >{{ old('description', $category->description) }}</textarea>

                @error('description')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="checkbox-row">
                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{
                            old('is_active', $category->is_active)
                                ? 'checked'
                                : ''
                        }}
                    >

                    Aktifkan kategori
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="btn btn-secondary"
                >
                    Batal
                </a>
            </div>
        </form>
    </section>
@endsection