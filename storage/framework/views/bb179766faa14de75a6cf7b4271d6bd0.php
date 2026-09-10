

<?php $__env->startSection('title', 'Profil Admin'); ?>

<?php $__env->startSection('content'); ?>
    <section class="page-header">
        <div>
            <h1>Profil Admin</h1>

            <p>
                Kelola nama, email, dan keamanan akun admin.
            </p>
        </div>
    </section>

    <?php if($errors->any()): ?>
        <div class="alert alert-error">
            <strong>Data belum dapat disimpan:</strong>

            <ul
                style="
                    margin-top: 8px;
                    padding-left: 20px;
                "
            >
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form
        action="<?php echo e(route('admin.profile.update')); ?>"
        method="POST"
    >
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <section
            class="card"
            style="
                max-width: 750px;
                margin-bottom: 22px;
            "
        >
            <h2 style="margin-bottom: 22px;">
                Informasi Akun
            </h2>

            <div class="form-group">
                <label for="name" class="form-label">
                    Nama Admin
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control"
                    value="<?php echo e(old('name', $user->name)); ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label for="email" class="form-label">
                    Email
                    <span class="required">*</span>
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control"
                    value="<?php echo e(old('email', $user->email)); ?>"
                    required
                >
            </div>
        </section>

        <section
            class="card"
            style="
                max-width: 750px;
                margin-bottom: 22px;
            "
        >
            <h2 style="margin-bottom: 8px;">
                Ganti Password
            </h2>

            <p
                style="
                    margin-bottom: 22px;
                    color: #6b7280;
                "
            >
                Kosongkan bagian ini jika tidak ingin mengganti password.
            </p>

            <div class="form-group">
                <label
                    for="current_password"
                    class="form-label"
                >
                    Password Saat Ini
                </label>

                <input
                    type="password"
                    id="current_password"
                    name="current_password"
                    class="form-control"
                    autocomplete="current-password"
                >
            </div>

            <div class="form-group">
                <label for="password" class="form-label">
                    Password Baru
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    autocomplete="new-password"
                >

                <small
                    style="
                        display: block;
                        margin-top: 7px;
                        color: #6b7280;
                    "
                >
                    Minimal 8 karakter, mengandung huruf besar,
                    huruf kecil, dan angka.
                </small>
            </div>

            <div class="form-group">
                <label
                    for="password_confirmation"
                    class="form-label"
                >
                    Konfirmasi Password Baru
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="form-control"
                    autocomplete="new-password"
                >
            </div>
        </section>

        <button type="submit" class="btn btn-primary">
            Simpan Profil
        </button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project\Laravel\harapan-bangsa\resources\views/admin/profile/edit.blade.php ENDPATH**/ ?>