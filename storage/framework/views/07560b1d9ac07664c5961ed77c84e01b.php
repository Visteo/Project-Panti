

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <section class="page-header">
        <div>
            <h1>Dashboard Admin</h1>
            <p>Ringkasan campaign dan donasi Harapan Bangsa.</p>
        </div>
    </section>

    <section class="statistics">
        <div class="card statistic-card">
            <p>Total Campaign</p>
            <h3><?php echo e($statistics['campaigns']); ?></h3>
        </div>

        <div class="card statistic-card">
            <p>Campaign Aktif</p>
            <h3><?php echo e($statistics['active_campaigns']); ?></h3>
        </div>

        <div class="card statistic-card">
            <p>Total Donasi</p>
            <h3><?php echo e($statistics['donations']); ?></h3>
        </div>

        <div class="card statistic-card">
            <p>Dana Terkumpul</p>

            <h3>
                Rp <?php echo e(number_format(
                    $statistics['collected_amount'],
                    0,
                    ',',
                    '.'
                )); ?>

            </h3>
        </div>
    </section>

    <section class="card">
        <h2 style="margin-bottom: 20px;">Donasi Terbaru</h2>

        <?php if($latestDonations->isEmpty()): ?>
            <div class="empty-state">
                Belum ada data donasi.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Donatur</th>
                            <th>Campaign</th>
                            <th>Nominal</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $latestDonations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($donation->invoice_number); ?></td>
                                <td><?php echo e($donation->display_name); ?></td>
                                <td><?php echo e($donation->campaign->title); ?></td>

                                <td>
                                    Rp <?php echo e(number_format(
                                        $donation->amount,
                                        0,
                                        ',',
                                        '.'
                                    )); ?>

                                </td>

                                <td>
                                    <?php echo e(ucfirst($donation->payment_status)); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project\Laravel\harapan-bangsa\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>