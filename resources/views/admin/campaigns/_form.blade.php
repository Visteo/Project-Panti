<div class="form-group">
    <label class="form-label" for="category_id">
        Kategori
        <span class="required">*</span>
    </label>

    <select
        id="category_id"
        name="category_id"
        class="form-control"
        required
    >
        <option value="">Pilih kategori</option>

        @foreach ($categories as $category)
            <option
                value="{{ $category->id }}"
                {{
                    old(
                        'category_id',
                        $campaign->category_id ?? ''
                    ) == $category->id
                        ? 'selected'
                        : ''
                }}
            >
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    @error('category_id')
        <div class="field-error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label" for="title">
        Judul Campaign
        <span class="required">*</span>
    </label>

    <input
        type="text"
        id="title"
        name="title"
        class="form-control"
        value="{{ old('title', $campaign->title ?? '') }}"
        placeholder="Contoh: Bantuan Perlengkapan Sekolah"
        required
    >

    @error('title')
        <div class="field-error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label" for="short_description">
        Deskripsi Singkat
        <span class="required">*</span>
    </label>

    <textarea
        id="short_description"
        name="short_description"
        class="form-control"
        maxlength="500"
        placeholder="Ringkasan singkat campaign"
        required
    >{{ old(
        'short_description',
        $campaign->short_description ?? ''
    ) }}</textarea>

    @error('short_description')
        <div class="field-error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label" for="description">
        Deskripsi Lengkap
        <span class="required">*</span>
    </label>

    <textarea
        id="description"
        name="description"
        class="form-control"
        style="min-height: 220px;"
        placeholder="Ceritakan tujuan dan manfaat campaign"
        required
    >{{ old('description', $campaign->description ?? '') }}</textarea>

    @error('description')
        <div class="field-error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label" for="thumbnail">
        Gambar Campaign
        @if (!isset($campaign))
            <span class="required">*</span>
        @endif
    </label>

    @if (isset($campaign) && $campaign->thumbnail)
        <div style="margin-bottom: 12px;">
            <img
                src="{{ asset('storage/' . $campaign->thumbnail) }}"
                alt="{{ $campaign->title }}"
                style="
                    width: 220px;
                    height: 130px;
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
        {{ isset($campaign) ? '' : 'required' }}
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

<div
    style="
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    "
>
    <div class="form-group">
        <label class="form-label" for="target_amount_display">
            Target Donasi
            <span class="required">*</span>
        </label>

        <input
            type="text"
            id="target_amount_display"
            class="form-control"
            inputmode="numeric"
            placeholder="Rp 10.000.000"
            autocomplete="off"
            required
        >

        <input
            type="hidden"
            id="target_amount"
            name="target_amount"
            value="{{ old(
                'target_amount',
                $campaign->target_amount ?? ''
            ) }}"
        >

        <small
            style="
                display: block;
                margin-top: 7px;
                color: #6b7280;
            "
        >
            Minimal target donasi Rp 10.000.
        </small>

        @error('target_amount')
            <div class="field-error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label" for="status">
            Status
            <span class="required">*</span>
        </label>

        <select
            id="status"
            name="status"
            class="form-control"
            required
        >
            @php
                $selectedStatus = old(
                    'status',
                    $campaign->status ?? 'draft'
                );
            @endphp

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
                value="completed"
                {{ $selectedStatus === 'completed' ? 'selected' : '' }}
            >
                Selesai
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
</div>

<div
    style="
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    "
>
    <div class="form-group">
        <label class="form-label" for="start_date">
            Tanggal Mulai
            <span class="required">*</span>
        </label>

        <input
            type="date"
            id="start_date"
            name="start_date"
            class="form-control"
            value="{{ old(
                'start_date',
                isset($campaign)
                    ? $campaign->start_date->format('Y-m-d')
                    : date('Y-m-d')
            ) }}"
            required
        >

        @error('start_date')
            <div class="field-error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label" for="end_date">
            Tanggal Selesai
        </label>

        <input
            type="date"
            id="end_date"
            name="end_date"
            class="form-control"
            value="{{ old(
                'end_date',
                isset($campaign) && $campaign->end_date
                    ? $campaign->end_date->format('Y-m-d')
                    : ''
            ) }}"
        >

        @error('end_date')
            <div class="field-error">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group">
    <label class="checkbox-row">
        <input
            type="checkbox"
            name="is_featured"
            value="1"
            {{
                old(
                    'is_featured',
                    $campaign->is_featured ?? false
                )
                    ? 'checked'
                    : ''
            }}
        >

        Jadikan campaign unggulan
    </label>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">
        {{ isset($campaign) ? 'Simpan Perubahan' : 'Simpan Campaign' }}
    </button>

    <a
        href="{{ route('admin.campaigns.index') }}"
        class="btn btn-secondary"
    >
        Batal
    </a>
</div>

@push('scripts')
    <script>
        const targetDisplay = document.getElementById(
            'target_amount_display'
        );

        const targetValue = document.getElementById(
            'target_amount'
        );

        function formatRupiah(value) {
            const numbers = String(value).replace(/\D/g, '');

            if (!numbers) {
                return '';
            }

            return 'Rp ' + new Intl.NumberFormat('id-ID').format(
                Number(numbers)
            );
        }

        function updateTargetAmount() {
            const numbers = targetDisplay.value.replace(/\D/g, '');

            targetValue.value = numbers;
            targetDisplay.value = formatRupiah(numbers);
        }

        targetDisplay.addEventListener('input', updateTargetAmount);

        targetDisplay.addEventListener('focus', function () {
            if (!targetDisplay.value && targetValue.value) {
                targetDisplay.value = formatRupiah(
                    targetValue.value
                );
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            if (targetValue.value) {
                const initialValue = String(
                    targetValue.value
                ).split('.')[0];

                targetValue.value = initialValue;
                targetDisplay.value = formatRupiah(initialValue);
            }
        });
    </script>
@endpush