

<?php $__env->startSection('title', 'Tambah Campaign'); ?>

<?php $__env->startSection('content'); ?>
    <section class="page-header">
        <div>
            <h1>Tambah Campaign</h1>
            <p>Buat campaign donasi baru.</p>
        </div>
    </section>

    <section class="card" style="max-width: 900px;">
        <form
            action="<?php echo e(route('admin.campaigns.store')); ?>"
            method="POST"
            enctype="multipart/form-data"
        >
            <?php echo csrf_field(); ?>

            <?php echo $__env->make('admin.campaigns._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </form>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project\Laravel\harapan-bangsa\resources\views/admin/campaigns/create.blade.php ENDPATH**/ ?>