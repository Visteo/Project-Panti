

<?php $__env->startSection('title', 'Pendiri Yayasan'); ?>

<?php $__env->startSection('content'); ?>
    <section class="page-header">
        <div>
            <h1>Pendiri Yayasan</h1>

            <p>
                Kelola profil pendiri dan pengurus Yayasan Harapan Bangsa.
            </p>
        </div>

        <a
            href="<?php echo e(route('admin.founders.create')); ?>"
            class="btn btn-primary"
        >
            Tambah Pendiri
        </a>
    </section>

    <section class="card" style="margin-bottom: 22px;">
        <form
            action="<?php echo e(route('admin.founders.index')); ?>"
            method="GET"
        >
            <div class="founder-filter-grid">
                <div class="form-group" style="margin: 0;">
                    <label for="search" class="form-label">
                        Pencarian
                    </label>

                    <input
                        type="text"
                        id="search"
                        name="search"
                        class="form-control"
                        value="<?php echo e(request('search')); ?>"
                        placeholder="Cari nama atau jabatan"
                    >
                </div>

                <div class="form-group" style="margin: 0;">
                    <label for="status" class="form-label">
                        Status
                    </label>

                    <select
                        id="status"
                        name="status"
                        class="form-control"
                    >
                        <option value="">Semua Status</option>

                        <option
                            value="active"
                            <?php if(request('status') === 'active'): echo 'selected'; endif; ?>
                        >
                            Aktif
                        </option>

                        <option
                            value="inactive"
                            <?php if(request('status') === 'inactive'): echo 'selected'; endif; ?>
                        >
                            Tidak Aktif
                        </option>
                    </select>
                </div>

                <div class="founder-filter-actions">
                    <button type="submit" class="btn btn-primary">
                        Cari
                    </button>

                    <a
                        href="<?php echo e(route('admin.founders.index')); ?>"
                        class="btn"
                    >
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </section>

    <section class="card">
        <?php if($founders->isEmpty()): ?>
            <div class="empty-state">
                Belum ada data pendiri yayasan.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="founder-table">
                    <thead>
                        <tr>
                            <th>Profil</th>
                            <th>Jabatan</th>
                            <th>Tahun Bergabung</th>
                            <th>Urutan</th>
                            <th>Status</th>
                            <th style="text-align: right;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $founders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $founder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <div class="founder-identity">
                                        <?php if($founder->photo): ?>
                                            <img
                                                src="<?php echo e(asset(
                                                    'storage/' .
                                                    $founder->photo
                                                )); ?>"
                                                alt="<?php echo e($founder->name); ?>"
                                            >
                                        <?php else: ?>
                                            <div class="founder-placeholder">
                                                <?php echo e(strtoupper(
                                                    substr(
                                                        $founder->name,
                                                        0,
                                                        2
                                                    )
                                                )); ?>

                                            </div>
                                        <?php endif; ?>

                                        <div>
                                            <strong>
                                                <?php echo e($founder->name); ?>

                                            </strong>

                                            <?php if($founder->biography): ?>
                                                <span>
                                                    <?php echo e(Str::limit(
                                                        $founder->biography,
                                                        70
                                                    )); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <?php echo e($founder->position ?: '-'); ?>

                                </td>

                                <td>
                                    <?php echo e($founder->joined_year ?: '-'); ?>

                                </td>

                                <td>
                                    <?php echo e($founder->display_order); ?>

                                </td>

                                <td>
                                    <span
                                        class="status-badge <?php echo e($founder->is_active
                                                ? 'status-active'
                                                : 'status-inactive'); ?>"
                                    >
                                        <?php echo e($founder->is_active
                                            ? 'Aktif'
                                            : 'Tidak Aktif'); ?>

                                    </span>
                                </td>

                                <td>
                                    <div class="table-actions">
                                        <a
                                            href="<?php echo e(route(
                                                'admin.founders.edit',
                                                $founder
                                            )); ?>"
                                            class="action-edit"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="<?php echo e(route(
                                                'admin.founders.destroy',
                                                $founder
                                            )); ?>"
                                            method="POST"
                                            onsubmit="
                                                return confirm(
                                                    'Hapus data pendiri ini?'
                                                )
                                            "
                                        >
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>

                                            <button
                                                type="submit"
                                                class="action-delete"
                                            >
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <?php if($founders->hasPages()): ?>
                <div style="margin-top: 24px;">
                    <?php echo e($founders->links()); ?>

                </div>
            <?php endif; ?>
        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .founder-filter-grid {
            display: grid;
            grid-template-columns: 1fr 230px auto;
            align-items: end;
            gap: 16px;
        }

        .founder-filter-actions {
            display: flex;
            gap: 8px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .founder-table {
            width: 100%;
            border-collapse: collapse;
        }

        .founder-table th {
            padding: 13px 15px;
            border-bottom: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 12px;
            text-align: left;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .founder-table td {
            padding: 16px 15px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .founder-identity {
            display: flex;
            align-items: center;
            min-width: 290px;
            gap: 13px;
        }

        .founder-identity img,
        .founder-placeholder {
            width: 58px;
            height: 58px;
            flex: 0 0 58px;
            border-radius: 18px;
            object-fit: cover;
        }

        .founder-placeholder {
            display: grid;
            place-items: center;
            background: #eaf4ff;
            color: #12355b;
            font-size: 13px;
            font-weight: 900;
        }

        .founder-identity strong,
        .founder-identity span {
            display: block;
        }

        .founder-identity span {
            max-width: 310px;
            margin-top: 4px;
            color: #6b7280;
            font-size: 12px;
        }

        .status-badge {
            display: inline-flex;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 800;
        }

        .status-active {
            background: #dcfce7;
            color: #166534;
        }

        .status-inactive {
            background: #f1f5f9;
            color: #64748b;
        }

        .table-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .action-edit,
        .action-delete {
            padding: 7px 11px;
            border: 0;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
        }

        .action-edit {
            background: #e0f2fe;
            color: #075985;
        }

        .action-delete {
            background: #fee2e2;
            color: #b91c1c;
        }

        @media (max-width: 800px) {
            .founder-filter-grid {
                grid-template-columns: 1fr;
            }

            .founder-filter-actions .btn {
                flex: 1;
            }
        }
    </style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project\Laravel\harapan-bangsa\resources\views/admin/founders/index.blade.php ENDPATH**/ ?>