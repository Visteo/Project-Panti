<div class="form-group">
    <label class="form-label" for="title">
        Judul Berita
        <span class="required">*</span>
    </label>

    <input
        type="text"
        id="title"
        name="title"
        class="form-control"
        value="{{ old('title', $news->title ?? '') }}"
        placeholder="Masukkan judul berita atau kegiatan"
        required
        autofocus
    >

    @error('title')
        <div class="field-error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label" for="excerpt">
        Ringkasan
        <span class="required">*</span>
    </label>

    <textarea
        id="excerpt"
        name="excerpt"
        class="form-control"
        maxlength="500"
        placeholder="Tuliskan ringkasan singkat berita"
        required
    >{{ old('excerpt', $news->excerpt ?? '') }}</textarea>

    @error('excerpt')
        <div class="field-error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label" for="content">
        Isi Berita
        <span class="required">*</span>
    </label>

    <textarea
        id="content"
        name="content"
        class="form-control"
        style="min-height: 300px;"
        placeholder="Tuliskan isi berita secara lengkap"
        required
    >{{ old('content', $news->content ?? '') }}</textarea>

    @error('content')
        <div class="field-error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label" for="thumbnail">
        Gambar Berita
        @if (!isset($news))
            <span class="required">*</span>
        @endif
    </label>

    @if (isset($news) && $news->thumbnail)
        <div style="margin-bottom: 12px;">
            <img
                src="{{ asset('storage/' . $news->thumbnail) }}"
                alt="{{ $news->title }}"
                style="
                    width: 240px;
                    height: 145px;
                    object-fit: cover;
                    border-radius: 10px;
                "
            >
        </div>
    @endif

    <input
        type="file"
        id="thumbnail"
        name="thumbnail"
        class="form-control"
        accept=".jpg,.jpeg,.png,.webp"
        {{ isset($news) ? '' : 'required' }}
    >

    <small
        style="
            display: block;
            margin-top: 7px;
            color: #6b7280;
        "
    >
        Format JPG, PNG, atau WEBP. Maksimal 2 MB.
    </small>

    @error('thumbnail')
        <div class="field-error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label" for="status">
        Status
        <span class="required">*</span>
    </label>

    @php
        $selectedStatus = old(
            'status',
            $news->status ?? 'draft'
        );
    @endphp

    <select
        id="status"
        name="status"
        class="form-control"
        required
    >
        <option
            value="draft"
            {{ $selectedStatus === 'draft' ? 'selected' : '' }}
        >
            Draft
        </option>

        <option
            value="published"
            {{ $selectedStatus === 'published' ? 'selected' : '' }}
        >
            Dipublikasikan
        </option>

        <option
            value="inactive"
            {{ $selectedStatus === 'inactive' ? 'selected' : '' }}
        >
            Tidak Aktif
        </option>
    </select>

    @error('status')
        <div class="field-error">{{ $message }}</div>
    @enderror
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">
        {{ isset($news) ? 'Simpan Perubahan' : 'Simpan Berita' }}
    </button>

    <a
        href="{{ route('admin.news.index') }}"
        class="btn btn-secondary"
    >
        Batal
    </a>
</div>