

<?php $__env->startSection('title', 'Acara & Kegiatan'); ?>

<?php $__env->startSection('content'); ?>
    <section class="page-header">
        <div>
            <h1>Acara & Kegiatan</h1>

            <p>
                Kelola agenda dan kegiatan Yayasan Harapan Bangsa.
            </p>
        </div>

        <a
            href="<?php echo e(route('admin.events.create')); ?>"
            class="btn btn-primary"
        >
            Tambah Acara
        </a>
    </section>

    <section class="card" style="margin-bottom: 22px;">
        <form
            action="<?php echo e(route('admin.events.index')); ?>"
            method="GET"
        >
            <div class="event-filter-grid">
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
                        placeholder="Cari nama acara atau lokasi"
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
                            value="published"
                            <?php if(request('status') === 'published'): echo 'selected'; endif; ?>
                        >
                            Dipublikasikan
                        </option>

                        <option
                            value="draft"
                            <?php if(request('status') === 'draft'): echo 'selected'; endif; ?>
                        >
                            Draft
                        </option>
                    </select>
                </div>

                <div class="event-filter-actions">
                    <button type="submit" class="btn btn-primary">
                        Cari
                    </button>

                    <a
                        href="<?php echo e(route('admin.events.index')); ?>"
                        class="btn"
                    >
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </section>

    <section class="card">
        <?php if($events->isEmpty()): ?>
            <div class="empty-state">
                Belum ada acara atau kegiatan.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="event-table">
                    <thead>
                        <tr>
                            <th>Acara</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Unggulan</th>
                            <th style="text-align: right;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <div class="event-identity">
                                        <?php if($event->thumbnail): ?>
                                            <img
                                                src="<?php echo e(asset(
                                                    'storage/' .
                                                    $event->thumbnail
                                                )); ?>"
                                                alt="<?php echo e($event->title); ?>"
                                            >
                                        <?php else: ?>
                                            <div class="event-placeholder">
                                                AC
                                            </div>
                                        <?php endif; ?>

                                        <div>
                                            <strong>
                                                <?php echo e($event->title); ?>

                                            </strong>

                                            <?php if($event->short_description): ?>
                                                <span>
                                                    <?php echo e(Str::limit(
                                                        $event->short_description,
                                                        65
                                                    )); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <strong>
                                        <?php echo e($event->event_date
                                            ->translatedFormat('d M Y')); ?>

                                    </strong>

                                    <?php if($event->start_time): ?>
                                        <span class="table-note">
                                            <?php echo e(substr(
                                                $event->start_time,
                                                0,
                                                5
                                            )); ?>

                                            WIB
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php echo e($event->location ?: '-'); ?>

                                </td>

                                <td>
                                    <span
                                        class="status-badge <?php echo e($event->status === 'published'
                                                ? 'status-published'
                                                : 'status-draft'); ?>"
                                    >
                                        <?php echo e($event->status === 'published'
                                            ? 'Dipublikasikan'
                                            : 'Draft'); ?>

                                    </span>
                                </td>

                                <td>
                                    <?php echo e($event->is_featured ? 'Ya' : 'Tidak'); ?>

                                </td>

                                <td>
                                    <div class="table-actions">
                                        <a
                                            href="<?php echo e(route(
                                                'admin.events.edit',
                                                $event
                                            )); ?>"
                                            class="action-edit"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="<?php echo e(route(
                                                'admin.events.destroy',
                                                $event
                                            )); ?>"
                                            method="POST"
                                            onsubmit="
                                                return confirm(
                                                    'Hapus acara ini?'
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

            <?php if($events->hasPages()): ?>
                <div style="margin-top: 24px;">
                    <?php echo e($events->links()); ?>

                </div>
            <?php endif; ?>
        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .event-filter-grid {
            display: grid;
            grid-template-columns: 1fr 230px auto;
            align-items: end;
            gap: 16px;
        }

        .event-filter-actions {
            display: flex;
            gap: 8px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .event-table {
            width: 100%;
            border-collapse: collapse;
        }

        .event-table th {
            padding: 13px 15px;
            border-bottom: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 12px;
            text-align: left;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .event-table td {
            padding: 16px 15px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .event-identity {
            display: flex;
            align-items: center;
            min-width: 280px;
            gap: 13px;
        }

        .event-identity img,
        .event-placeholder {
            width: 65px;
            height: 50px;
            flex: 0 0 65px;
            border-radius: 9px;
            object-fit: cover;
        }

        .event-placeholder {
            display: grid;
            place-items: center;
            background: #e0f2fe;
            color: #075985;
            font-size: 12px;
            font-weight: 800;
        }

        .event-identity strong,
        .event-identity span,
        .table-note {
            display: block;
        }

        .event-identity span,
        .table-note {
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

        .status-published {
            background: #dcfce7;
            color: #166534;
        }

        .status-draft {
            background: #fef3c7;
            color: #92400e;
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
            .event-filter-grid {
                grid-template-columns: 1fr;
            }

            .event-filter-actions .btn {
                flex: 1;
            }
        }
    </style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project\Laravel\harapan-bangsa\resources\views/admin/events/index.blade.php ENDPATH**/ ?>