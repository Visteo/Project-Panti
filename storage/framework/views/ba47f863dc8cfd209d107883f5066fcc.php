

<?php $__env->startSection('title', 'Tambah Kategori'); ?>

<?php $__env->startSection('content'); ?>
    <section class="page-header">
        <div>
            <h1>Tambah Kategori</h1>
            <p>Buat kategori baru untuk campaign.</p>
        </div>
    </section>

    <section class="card" style="max-width: 750px;">
        <form
            action="<?php echo e(route('admin.categories.store')); ?>"
            method="POST"
        >
            <?php echo csrf_field(); ?>

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
                    value="<?php echo e(old('name')); ?>"
                    placeholder="Contoh: Pendidikan"
                    required
                    autofocus
                >

                <?php $__errorArgs = ['name'];
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
                    Deskripsi
                </label>

                <textarea
                    id="description"
                    name="description"
                    class="form-control"
                    placeholder="Tuliskan penjelasan singkat kategori"
                ><?php echo e(old('description')); ?></textarea>

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
                <label class="checkbox-row">
                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        <?php echo e(old('is_active', true) ? 'checked' : ''); ?>

                    >

                    Aktifkan kategori
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    Simpan Kategori
                </button>

                <a
                    href="<?php echo e(route('admin.categories.index')); ?>"
                    class="btn btn-secondary"
                >
                    Batal
                </a>
            </div>
        </form>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project\Laravel\harapan-bangsa\resources\views/admin/categories/create.blade.php ENDPATH**/ ?>