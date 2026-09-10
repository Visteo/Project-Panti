

<?php $__env->startSection('title', 'Laporan Donasi'); ?>

<?php $__env->startSection('content'); ?>
    <section class="page-header">
        <div>
            <h1>Laporan Donasi</h1>
            <p>
                Pantau dan unduh data transaksi donasi.
            </p>
        </div>

        <a
            href="<?php echo e(route(
                'admin.reports.export',
                request()->query()
            )); ?>"
            class="btn btn-primary"
        >
            Unduh CSV
        </a>
    </section>

    <?php if($errors->any()): ?>
        <div class="alert alert-error">
            <?php echo e($errors->first()); ?>

        </div>
    <?php endif; ?>

    <section class="card" style="margin-bottom: 22px;">
        <form
            action="<?php echo e(route('admin.reports.index')); ?>"
            method="GET"
        >
            <div
                class="report-filter-grid"
                style="
                    display: grid;
                    grid-template-columns:
                        repeat(2, 1fr)
                        minmax(180px, 1.2fr)
                        minmax(180px, 1fr);
                    gap: 15px;
                "
            >
                <div class="form-group">
                    <label class="form-label" for="start_date">
                        Tanggal Awal
                    </label>

                    <input
                        type="date"
                        id="start_date"
                        name="start_date"
                        class="form-control"
                        value="<?php echo e(request('start_date')); ?>"
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="end_date">
                        Tanggal Akhir
                    </label>

                    <input
                        type="date"
                        id="end_date"
                        name="end_date"
                        class="form-control"
                        value="<?php echo e(request('end_date')); ?>"
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="campaign_id">
                        Campaign
                    </label>

                    <select
                        id="campaign_id"
                        name="campaign_id"
                        class="form-control"
                    >
                        <option value="">Semua campaign</option>

                        <?php $__currentLoopData = $campaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option
                                value="<?php echo e($campaign->id); ?>"
                                <?php echo e((string) request('campaign_id')
                                        === (string) $campaign->id
                                            ? 'selected'
                                            : ''); ?>

                            >
                                <?php echo e($campaign->title); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="form-group">
                    <label
                        class="form-label"
                        for="payment_status"
                    >
                        Status
                    </label>

                    <select
                        id="payment_status"
                        name="payment_status"
                        class="form-control"
                    >
                        <option value="">Semua status</option>

                        <option
                            value="pending"
                            <?php echo e(request('payment_status') === 'pending'
                                    ? 'selected'
                                    : ''); ?>

                        >
                            Menunggu Pembayaran
                        </option>

                        <option
                            value="waiting_verification"
                            <?php echo e(request('payment_status')
                                    === 'waiting_verification'
                                        ? 'selected'
                                        : ''); ?>

                        >
                            Menunggu Verifikasi
                        </option>

                        <option
                            value="paid"
                            <?php echo e(request('payment_status') === 'paid'
                                    ? 'selected'
                                    : ''); ?>

                        >
                            Berhasil
                        </option>

                        <option
                            value="failed"
                            <?php echo e(request('payment_status') === 'failed'
                                    ? 'selected'
                                    : ''); ?>

                        >
                            Gagal/Ditolak
                        </option>

                        <option
                            value="expired"
                            <?php echo e(request('payment_status') === 'expired'
                                    ? 'selected'
                                    : ''); ?>

                        >
                            Kedaluwarsa
                        </option>

                        <option
                            value="cancelled"
                            <?php echo e(request('payment_status') === 'cancelled'
                                    ? 'selected'
                                    : ''); ?>

                        >
                            Dibatalkan
                        </option>
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    Terapkan Filter
                </button>

                <a
                    href="<?php echo e(route('admin.reports.index')); ?>"
                    class="btn btn-secondary"
                >
                    Reset
                </a>
            </div>
        </form>
    </section>

    <section class="statistics">
        <div class="card statistic-card">
            <p>Total Transaksi</p>

            <h3>
                <?php echo e(number_format(
                    $statistics['total_transactions'],
                    0,
                    ',',
                    '.'
                )); ?>

            </h3>
        </div>

        <div class="card statistic-card">
            <p>Transaksi Berhasil</p>

            <h3>
                <?php echo e(number_format(
                    $statistics['paid_transactions'],
                    0,
                    ',',
                    '.'
                )); ?>

            </h3>
        </div>

        <div class="card statistic-card">
            <p>Menunggu Diproses</p>

            <h3>
                <?php echo e(number_format(
                    $statistics['pending_transactions'],
                    0,
                    ',',
                    '.'
                )); ?>

            </h3>
        </div>

        <div class="card statistic-card">
            <p>Dana Berhasil Diterima</p>

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
        <?php if($donations->isEmpty()): ?>
            <div class="empty-state">
                Tidak ada transaksi yang sesuai dengan filter.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Tanggal</th>
                            <th>Donatur</th>
                            <th>Campaign</th>
                            <th>Nominal</th>
                            <th>Metode</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <a
                                        href="<?php echo e(route(
                                            'admin.donations.show',
                                            $donation
                                        )); ?>"
                                        style="
                                            color: #0f766e;
                                            font-weight: 700;
                                        "
                                    >
                                        <?php echo e($donation->invoice_number); ?>

                                    </a>
                                </td>

                                <td>
                                    <?php echo e($donation->created_at
                                        ->format('d/m/Y H:i')); ?>

                                </td>

                                <td><?php echo e($donation->donor_name); ?></td>

                                <td>
                                    <?php echo e(Str::limit(
                                        $donation->campaign->title,
                                        35
                                    )); ?>

                                </td>

                                <td>
                                    <strong>
                                        Rp <?php echo e(number_format(
                                            $donation->amount,
                                            0,
                                            ',',
                                            '.'
                                        )); ?>

                                    </strong>
                                </td>

                                <td>
                                    <?php echo e($donation->payment_method === 'midtrans'
                                        ? 'Midtrans'
                                        : 'Transfer Manual'); ?>

                                </td>

                                <td>
                                    <?php switch($donation->payment_status):
                                        case ('paid'): ?>
                                            <span class="badge badge-success">
                                                Berhasil
                                            </span>
                                            <?php break; ?>

                                        <?php case ('waiting_verification'): ?>
                                            <span
                                                class="badge"
                                                style="
                                                    background: #fef3c7;
                                                    color: #92400e;
                                                "
                                            >
                                                Perlu Verifikasi
                                            </span>
                                            <?php break; ?>

                                        <?php case ('pending'): ?>
                                            <span
                                                class="badge"
                                                style="
                                                    background: #dbeafe;
                                                    color: #1e40af;
                                                "
                                            >
                                                Pending
                                            </span>
                                            <?php break; ?>

                                        <?php case ('failed'): ?>
                                            <span
                                                class="badge"
                                                style="
                                                    background: #fee2e2;
                                                    color: #991b1b;
                                                "
                                            >
                                                Gagal
                                            </span>
                                            <?php break; ?>

                                        <?php case ('expired'): ?>
                                            <span class="badge badge-secondary">
                                                Kedaluwarsa
                                            </span>
                                            <?php break; ?>

                                        <?php default: ?>
                                            <span class="badge badge-secondary">
                                                Dibatalkan
                                            </span>
                                    <?php endswitch; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <?php if($donations->hasPages()): ?>
                <div class="pagination-wrapper">
                    <?php echo e($donations->links()); ?>

                </div>
            <?php endif; ?>
        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        @media (max-width: 900px) {
            .report-filter-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }

        @media (max-width: 600px) {
            .report-filter-grid {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project\Laravel\harapan-bangsa\resources\views/admin/reports/index.blade.php ENDPATH**/ ?>