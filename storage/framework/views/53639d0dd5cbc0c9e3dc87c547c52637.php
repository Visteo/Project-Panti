

<?php $__env->startSection('title', 'Campaign'); ?>

<?php $__env->startSection('content'); ?>
    <section class="page-header">
        <div>
            <h1>Campaign</h1>
            <p>Kelola seluruh campaign donasi Harapan Bangsa.</p>
        </div>

        <a
            href="<?php echo e(route('admin.campaigns.create')); ?>"
            class="btn btn-primary"
        >
            + Tambah Campaign
        </a>
    </section>

    <section class="card" style="margin-bottom: 20px;">
        <form
            action="<?php echo e(route('admin.campaigns.index')); ?>"
            method="GET"
            style="
                display: grid;
                grid-template-columns: 1fr 220px auto;
                gap: 12px;
            "
        >
            <input
                type="text"
                name="search"
                class="form-control"
                value="<?php echo e(request('search')); ?>"
                placeholder="Cari judul campaign..."
            >

            <select name="status" class="form-control">
                <option value="">Semua status</option>

                <option
                    value="draft"
                    <?php echo e(request('status') === 'draft' ? 'selected' : ''); ?>

                >
                    Draft
                </option>

                <option
                    value="published"
                    <?php echo e(request('status') === 'published' ? 'selected' : ''); ?>

                >
                    Dipublikasikan
                </option>

                <option
                    value="completed"
                    <?php echo e(request('status') === 'completed' ? 'selected' : ''); ?>

                >
                    Selesai
                </option>

                <option
                    value="inactive"
                    <?php echo e(request('status') === 'inactive' ? 'selected' : ''); ?>

                >
                    Tidak Aktif
                </option>
            </select>

            <button type="submit" class="btn btn-primary">
                Filter
            </button>
        </form>
    </section>

    <section class="card">
        <?php if($campaigns->isEmpty()): ?>
            <div class="empty-state">
                <p>Belum ada campaign.</p>

                <a
                    href="<?php echo e(route('admin.campaigns.create')); ?>"
                    class="btn btn-primary"
                    style="margin-top: 15px;"
                >
                    Tambah Campaign Pertama
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Campaign</th>
                            <th>Kategori</th>
                            <th>Target</th>
                            <th>Terkumpul</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $campaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <div
                                        style="
                                            display: flex;
                                            align-items: center;
                                            gap: 12px;
                                            min-width: 260px;
                                        "
                                    >
                                        <img
                                            src="<?php echo e(asset(
                                                'storage/' .
                                                $campaign->thumbnail
                                            )); ?>"
                                            alt="<?php echo e($campaign->title); ?>"
                                            style="
                                                width: 72px;
                                                height: 50px;
                                                object-fit: cover;
                                                border-radius: 8px;
                                            "
                                        >

                                        <div>
                                            <strong>
                                                <?php echo e($campaign->title); ?>

                                            </strong>

                                            <?php if($campaign->is_featured): ?>
                                                <div
                                                    style="
                                                        color: #d97706;
                                                        font-size: 12px;
                                                        margin-top: 5px;
                                                    "
                                                >
                                                    ★ Campaign unggulan
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>

                                <td><?php echo e($campaign->category->name); ?></td>

                                <td>
                                    Rp <?php echo e(number_format(
                                        $campaign->target_amount,
                                        0,
                                        ',',
                                        '.'
                                    )); ?>

                                </td>

                                <td>
                                    Rp <?php echo e(number_format(
                                        $campaign->collected_amount ?? 0,
                                        0,
                                        ',',
                                        '.'
                                    )); ?>

                                </td>

                                <td>
                                    <?php if($campaign->status === 'published'): ?>
                                        <span class="badge badge-success">
                                            Dipublikasikan
                                        </span>
                                    <?php elseif($campaign->status === 'draft'): ?>
                                        <span class="badge badge-secondary">
                                            Draft
                                        </span>
                                    <?php elseif($campaign->status === 'completed'): ?>
                                        <span
                                            class="badge"
                                            style="
                                                background: #dbeafe;
                                                color: #1e40af;
                                            "
                                        >
                                            Selesai
                                        </span>
                                    <?php else: ?>
                                        <span
                                            class="badge"
                                            style="
                                                background: #fee2e2;
                                                color: #991b1b;
                                            "
                                        >
                                            Tidak Aktif
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <div class="actions">
                                        <a
                                            href="<?php echo e(route(
                                                'admin.campaigns.edit',
                                                $campaign
                                            )); ?>"
                                            class="btn btn-warning btn-sm"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="<?php echo e(route(
                                                'admin.campaigns.destroy',
                                                $campaign
                                            )); ?>"
                                            method="POST"
                                            onsubmit="
                                                return confirm(
                                                    'Yakin ingin menghapus campaign ini?'
                                                )
                                            "
                                        >
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>

                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm"
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

            <?php if($campaigns->hasPages()): ?>
                <div class="pagination-wrapper">
                    <?php echo e($campaigns->links()); ?>

                </div>
            <?php endif; ?>
        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project\Laravel\harapan-bangsa\resources\views/admin/campaigns/index.blade.php ENDPATH**/ ?>