

<?php $__env->startSection('title', 'Berita dan Kegiatan'); ?>

<?php $__env->startSection('content'); ?>
    <section class="page-header">
        <div>
            <h1>Berita dan Kegiatan</h1>
            <p>Kelola informasi terbaru Harapan Bangsa.</p>
        </div>

        <a
            href="<?php echo e(route('admin.news.create')); ?>"
            class="btn btn-primary"
        >
            + Tambah Berita
        </a>
    </section>

    <section class="card" style="margin-bottom: 20px;">
        <form
            action="<?php echo e(route('admin.news.index')); ?>"
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
                placeholder="Cari judul berita..."
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
        <?php if($news->isEmpty()): ?>
            <div class="empty-state">
                Belum ada berita atau kegiatan.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Berita</th>
                            <th>Penulis</th>
                            <th>Status</th>
                            <th>Publikasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <div
                                        style="
                                            display: flex;
                                            align-items: center;
                                            gap: 12px;
                                            min-width: 300px;
                                        "
                                    >
                                        <img
                                            src="<?php echo e(asset(
                                                'storage/' .
                                                $item->thumbnail
                                            )); ?>"
                                            alt="<?php echo e($item->title); ?>"
                                            style="
                                                width: 75px;
                                                height: 52px;
                                                object-fit: cover;
                                                border-radius: 8px;
                                            "
                                        >

                                        <div>
                                            <strong>
                                                <?php echo e($item->title); ?>

                                            </strong>

                                            <div
                                                style="
                                                    margin-top: 4px;
                                                    color: #6b7280;
                                                    font-size: 12px;
                                                "
                                            >
                                                <?php echo e(Str::limit(
                                                    $item->excerpt,
                                                    70
                                                )); ?>

                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td><?php echo e($item->author->name); ?></td>

                                <td>
                                    <?php if($item->status === 'published'): ?>
                                        <span class="badge badge-success">
                                            Dipublikasikan
                                        </span>
                                    <?php elseif($item->status === 'draft'): ?>
                                        <span class="badge badge-secondary">
                                            Draft
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
                                    <?php echo e($item->published_at
                                        ? $item->published_at
                                            ->format('d/m/Y H:i')
                                        : '-'); ?>

                                </td>

                                <td>
                                    <div class="actions">
                                        <a
                                            href="<?php echo e(route(
                                                'admin.news.edit',
                                                $item
                                            )); ?>"
                                            class="btn btn-warning btn-sm"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="<?php echo e(route(
                                                'admin.news.destroy',
                                                $item
                                            )); ?>"
                                            method="POST"
                                            onsubmit="
                                                return confirm(
                                                    'Yakin ingin menghapus berita ini?'
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

            <?php if($news->hasPages()): ?>
                <div class="pagination-wrapper">
                    <?php echo e($news->links()); ?>

                </div>
            <?php endif; ?>
        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project\Laravel\harapan-bangsa\resources\views/admin/news/index.blade.php ENDPATH**/ ?>