

<?php $__env->startSection('title', 'Kategori Campaign'); ?>

<?php $__env->startSection('content'); ?>
    <section class="page-header">
        <div>
            <h1>Kategori Campaign</h1>
            <p>Kelola kategori untuk mengelompokkan campaign.</p>
        </div>

        <a
            href="<?php echo e(route('admin.categories.create')); ?>"
            class="btn btn-primary"
        >
            + Tambah Kategori
        </a>
    </section>

    <section class="card">
        <?php if($categories->isEmpty()): ?>
            <div class="empty-state">
                <p>Belum ada kategori campaign.</p>

                <a
                    href="<?php echo e(route('admin.categories.create')); ?>"
                    class="btn btn-primary"
                    style="margin-top: 16px;"
                >
                    Tambah Kategori Pertama
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Slug</th>
                            <th>Campaign</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <?php echo e($categories->firstItem() + $loop->index); ?>

                                </td>

                                <td>
                                    <strong><?php echo e($category->name); ?></strong>

                                    <?php if($category->description): ?>
                                        <div
                                            style="
                                                color: #6b7280;
                                                font-size: 12px;
                                                margin-top: 4px;
                                            "
                                        >
                                            <?php echo e(Str::limit(
                                                $category->description,
                                                70
                                            )); ?>

                                        </div>
                                    <?php endif; ?>
                                </td>

                                <td><?php echo e($category->slug); ?></td>

                                <td>
                                    <?php echo e($category->campaigns_count); ?>

                                </td>

                                <td>
                                    <?php if($category->is_active): ?>
                                        <span class="badge badge-success">
                                            Aktif
                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary">
                                            Tidak Aktif
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <div class="actions">
                                        <a
                                            href="<?php echo e(route(
                                                'admin.categories.edit',
                                                $category
                                            )); ?>"
                                            class="btn btn-warning btn-sm"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="<?php echo e(route(
                                                'admin.categories.destroy',
                                                $category
                                            )); ?>"
                                            method="POST"
                                            onsubmit="
                                                return confirm(
                                                    'Yakin ingin menghapus kategori ini?'
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

            <?php if($categories->hasPages()): ?>
                <div class="pagination-wrapper">
                    <?php echo e($categories->links()); ?>

                </div>
            <?php endif; ?>
        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project\Laravel\harapan-bangsa\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>