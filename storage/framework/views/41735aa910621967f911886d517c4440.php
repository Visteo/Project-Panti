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

        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option
                value="<?php echo e($category->id); ?>"
                <?php echo e(old(
                        'category_id',
                        $campaign->category_id ?? ''
                    ) == $category->id
                        ? 'selected'
                        : ''); ?>

            >
                <?php echo e($category->name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="field-error"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
        value="<?php echo e(old('title', $campaign->title ?? '')); ?>"
        placeholder="Contoh: Bantuan Perlengkapan Sekolah"
        required
    >

    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="field-error"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
    ><?php echo e(old(
        'short_description',
        $campaign->short_description ?? ''
    )); ?></textarea>

    <?php $__errorArgs = ['short_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="field-error"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
    ><?php echo e(old('description', $campaign->description ?? '')); ?></textarea>

    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="field-error"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="form-group">
    <label class="form-label" for="thumbnail">
        Gambar Campaign
        <?php if(!isset($campaign)): ?>
            <span class="required">*</span>
        <?php endif; ?>
    </label>

    <?php if(isset($campaign) && $campaign->thumbnail): ?>
        <div style="margin-bottom: 12px;">
            <img
                src="<?php echo e(asset('storage/' . $campaign->thumbnail)); ?>"
                alt="<?php echo e($campaign->title); ?>"
                style="
                    width: 220px;
                    height: 130px;
                    object-fit: cover;
                    border-radius: 10px;
                "
            >
        </div>
    <?php endif; ?>

    <input
        type="file"
        id="thumbnail"
        name="thumbnail"
        class="form-control"
        accept=".jpg,.jpeg,.png,.webp"
        <?php echo e(isset($campaign) ? '' : 'required'); ?>

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

    <?php $__errorArgs = ['thumbnail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="field-error"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
            value="<?php echo e(old(
                'target_amount',
                $campaign->target_amount ?? ''
            )); ?>"
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

        <?php $__errorArgs = ['target_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="field-error"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
            <?php
                $selectedStatus = old(
                    'status',
                    $campaign->status ?? 'draft'
                );
            ?>

            <option
                value="draft"
                <?php echo e($selectedStatus === 'draft' ? 'selected' : ''); ?>

            >
                Draft
            </option>

            <option
                value="published"
                <?php echo e($selectedStatus === 'published' ? 'selected' : ''); ?>

            >
                Dipublikasikan
            </option>

            <option
                value="completed"
                <?php echo e($selectedStatus === 'completed' ? 'selected' : ''); ?>

            >
                Selesai
            </option>

            <option
                value="inactive"
                <?php echo e($selectedStatus === 'inactive' ? 'selected' : ''); ?>

            >
                Tidak Aktif
            </option>
        </select>

        <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="field-error"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
            value="<?php echo e(old(
                'start_date',
                isset($campaign)
                    ? $campaign->start_date->format('Y-m-d')
                    : date('Y-m-d')
            )); ?>"
            required
        >

        <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="field-error"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
            value="<?php echo e(old(
                'end_date',
                isset($campaign) && $campaign->end_date
                    ? $campaign->end_date->format('Y-m-d')
                    : ''
            )); ?>"
        >

        <?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="field-error"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>

<div class="form-group">
    <label class="checkbox-row">
        <input
            type="checkbox"
            name="is_featured"
            value="1"
            <?php echo e(old(
                    'is_featured',
                    $campaign->is_featured ?? false
                )
                    ? 'checked'
                    : ''); ?>

        >

        Jadikan campaign unggulan
    </label>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">
        <?php echo e(isset($campaign) ? 'Simpan Perubahan' : 'Simpan Campaign'); ?>

    </button>

    <a
        href="<?php echo e(route('admin.campaigns.index')); ?>"
        class="btn btn-secondary"
    >
        Batal
    </a>
</div>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?><?php /**PATH D:\Project\Laravel\harapan-bangsa\resources\views/admin/campaigns/_form.blade.php ENDPATH**/ ?>