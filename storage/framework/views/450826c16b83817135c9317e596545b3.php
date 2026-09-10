

<?php $__env->startSection('title', 'Pengaturan Website'); ?>

<?php $__env->startSection('content'); ?>
    <section class="page-header">
        <div>
            <h1>Pengaturan Website</h1>

            <p>
                Kelola profil organisasi, kontak, dan rekening donasi.
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
        action="<?php echo e(route('admin.settings.update')); ?>"
        method="POST"
        enctype="multipart/form-data"
    >
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <section class="card" style="margin-bottom: 22px;">
            <h2 style="margin-bottom: 22px;">
                Profil Organisasi
            </h2>

            <div class="form-group">
                <label
                    for="organization_name"
                    class="form-label"
                >
                    Nama Organisasi
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="organization_name"
                    name="organization_name"
                    class="form-control"
                    value="<?php echo e(old(
                        'organization_name',
                        $setting->organization_name
                    )); ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label for="tagline" class="form-label">
                    Tagline
                </label>

                <input
                    type="text"
                    id="tagline"
                    name="tagline"
                    class="form-control"
                    value="<?php echo e(old(
                        'tagline',
                        $setting->tagline
                    )); ?>"
                    placeholder="Berbagi Kebaikan, Menumbuhkan Harapan"
                >
            </div>

            <div class="form-group">
                <label
                    for="short_description"
                    class="form-label"
                >
                    Deskripsi Singkat
                </label>

                <textarea
                    id="short_description"
                    name="short_description"
                    class="form-control"
                    placeholder="Deskripsi singkat organisasi"
                ><?php echo e(old(
                    'short_description',
                    $setting->short_description
                )); ?></textarea>
            </div>

            <div class="form-group">
                <label for="about" class="form-label">
                    Tentang Organisasi
                </label>

                <textarea
                    id="about"
                    name="about"
                    class="form-control"
                    style="min-height: 250px;"
                    placeholder="Ceritakan sejarah dan profil singkat organisasi"
                ><?php echo e(old('about', $setting->about)); ?></textarea>
            </div>

            <div class="form-group">
                <label for="about_image" class="form-label">
                    Foto Tentang Yayasan
                </label>

                <?php if($setting->about_image): ?>
                    <div style="margin-bottom: 14px;">
                        <img
                            src="<?php echo e(asset(
                                'storage/' . $setting->about_image
                            )); ?>"
                            alt="Tentang <?php echo e($setting->organization_name); ?>"
                            style="
                                width: 100%;
                                max-width: 600px;
                                max-height: 350px;
                                border-radius: 14px;
                                object-fit: cover;
                            "
                        >
                    </div>
                <?php endif; ?>

                <input
                    type="file"
                    id="about_image"
                    name="about_image"
                    class="form-control"
                    accept=".jpg,.jpeg,.png,.webp"
                >

                <small
                    style="
                        display: block;
                        margin-top: 7px;
                        color: #6b7280;
                    "
                >
                    Gunakan foto kegiatan yayasan.
                    Format JPG, PNG, atau WEBP. Maksimal 5 MB.
                </small>
            </div>

            <div class="form-group">
                <label for="vision" class="form-label">
                    Visi Yayasan
                </label>
                <textarea
                    id="vision"
                    name="vision"
                    class="form-control"
                    style="min-height: 140px;"
                    placeholder="Tuliskan visi utama yayasan"
                ><?php echo e(old('vision', $setting->vision)); ?></textarea>

                <small
                    style="
                        display: block;
                        margin-top: 7px;
                        color: #6b7280;">
                    Tuliskan tujuan atau cita-cita utama yayasan.
                </small>
            </div>

            <div class="form-group">
                <label for="mission" class="form-label">
                    Misi Yayasan
                </label>
                <textarea
                    id="mission"
                    name="mission"
                    class="form-control"
                    style="min-height: 190px;"
                    placeholder="Memberikan pendidikan yang layak&#10;Memenuhi kebutuhan kesehatan anak&#10;Mengembangkan potensi dan keterampilan anak"
                ><?php echo e(old('mission', $setting->mission)); ?></textarea>

                <small
                    style="
                        display: block;
                        margin-top: 7px;
                        color: #6b7280;
                    "
                >
                    Tulis satu poin misi pada setiap baris.
                </small>
            </div>

            <div class="form-group">
                <label for="logo" class="form-label">
                    Logo
                </label>

                <?php if($setting->logo): ?>
                    <div style="margin-bottom: 12px;">
                        <img
                            src="<?php echo e(asset(
                                'storage/' . $setting->logo
                            )); ?>"
                            alt="<?php echo e($setting->organization_name); ?>"
                            style="
                                max-width: 180px;
                                max-height: 120px;
                                object-fit: contain;
                                border: 1px solid #e5e7eb;
                                border-radius: 10px;
                                padding: 8px;
                            "
                        >
                    </div>
                <?php endif; ?>

                <input
                    type="file"
                    id="logo"
                    name="logo"
                    class="form-control"
                    accept=".jpg,.jpeg,.png,.webp"
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
            </div>
        </section>

        <section class="card" style="margin-bottom: 22px;">
            <h2 style="margin-bottom: 22px;">
                Informasi Kontak
            </h2>

            <div
                class="setting-grid"
                style="
                    display: grid;
                    grid-template-columns: repeat(2, 1fr);
                    gap: 18px;
                "
            >
                <div class="form-group">
                    <label for="email" class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        value="<?php echo e(old('email', $setting->email)); ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">
                        Nomor Telepon
                    </label>

                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        class="form-control"
                        value="<?php echo e(old('phone', $setting->phone)); ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="whatsapp" class="form-label">
                        Nomor WhatsApp
                    </label>

                    <input
                        type="text"
                        id="whatsapp"
                        name="whatsapp"
                        class="form-control"
                        value="<?php echo e(old(
                            'whatsapp',
                            $setting->whatsapp
                        )); ?>"
                        placeholder="08xxxxxxxxxx"
                    >
                </div>

                <div class="form-group">
                    <label for="instagram" class="form-label">
                        URL Instagram
                    </label>

                    <input
                        type="url"
                        id="instagram"
                        name="instagram"
                        class="form-control"
                        value="<?php echo e(old(
                            'instagram',
                            $setting->instagram
                        )); ?>"
                        placeholder="https://instagram.com/username"
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="address" class="form-label">
                    Alamat
                </label>

                <textarea
                    id="address"
                    name="address"
                    class="form-control"
                    placeholder="Alamat lengkap organisasi"
                ><?php echo e(old('address', $setting->address)); ?></textarea>
            </div>
        </section>

        <section class="card" style="margin-bottom: 22px;">
            <h2 style="margin-bottom: 8px;">
                Rekening Donasi
            </h2>

            <p
                style="
                    margin-bottom: 22px;
                    color: #6b7280;
                "
            >
                Rekening ini ditampilkan pada metode transfer manual.
            </p>

            <?php $__currentLoopData = [
                'bca' => 'BCA',
                'bri' => 'BRI',
                'mandiri' => 'Mandiri',
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div
                    class="setting-grid"
                    style="
                        display: grid;
                        grid-template-columns: repeat(2, 1fr);
                        gap: 18px;
                        margin-bottom: 18px;
                        padding-bottom: 18px;
                        border-bottom: 1px solid #e5e7eb;
                    "
                >
                    <div class="form-group">
                        <label
                            for="<?php echo e($key); ?>_account_number"
                            class="form-label"
                        >
                            Nomor Rekening <?php echo e($bank); ?>

                        </label>

                        <input
                            type="text"
                            id="<?php echo e($key); ?>_account_number"
                            name="<?php echo e($key); ?>_account_number"
                            class="form-control"
                            value="<?php echo e(old(
                                $key . '_account_number',
                                $setting->{$key . '_account_number'}
                            )); ?>"
                        >
                    </div>

                    <div class="form-group">
                        <label
                            for="<?php echo e($key); ?>_account_name"
                            class="form-label"
                        >
                            Nama Pemilik Rekening
                        </label>

                        <input
                            type="text"
                            id="<?php echo e($key); ?>_account_name"
                            name="<?php echo e($key); ?>_account_name"
                            class="form-control"
                            value="<?php echo e(old(
                                $key . '_account_name',
                                $setting->{$key . '_account_name'}
                            )); ?>"
                        >
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </section>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                Simpan Pengaturan
            </button>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        @media (max-width: 650px) {
            .setting-grid {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project\Laravel\harapan-bangsa\resources\views/admin/settings/edit.blade.php ENDPATH**/ ?>