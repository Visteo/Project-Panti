

<?php $__env->startSection('title', 'Donasi'); ?>

<?php $__env->startSection('content'); ?>
    <section class="page-header">
        <div>
            <h1>Data Donasi</h1>

            <p>
                Kelola dan verifikasi pembayaran donatur.
            </p>
        </div>
    </section>

    <section class="card" style="margin-bottom: 20px;">
        <form
            action="<?php echo e(route('admin.donations.index')); ?>"
            method="GET"
            style="
                display: grid;
                grid-template-columns: 1fr 230px auto;
                gap: 12px;
            "
        >
            <input
                type="text"
                name="search"
                class="form-control"
                value="<?php echo e(request('search')); ?>"
                placeholder="Cari invoice, nama, email, atau WhatsApp..."
            >

            <select name="status" class="form-control">
                <option value="">Semua status</option>

                <option
                    value="waiting_verification"
                    <?php echo e(request('status') === 'waiting_verification'
                            ? 'selected'
                            : ''); ?>

                >
                    Menunggu Verifikasi
                </option>

                <option
                    value="paid"
                    <?php echo e(request('status') === 'paid' ? 'selected' : ''); ?>

                >
                    Berhasil
                </option>

                <option
                    value="pending"
                    <?php echo e(request('status') === 'pending' ? 'selected' : ''); ?>

                >
                    Pending
                </option>

                <option
                    value="failed"
                    <?php echo e(request('status') === 'failed' ? 'selected' : ''); ?>

                >
                    Ditolak/Gagal
                </option>

                <option
                    value="cancelled"
                    <?php echo e(request('status') === 'cancelled' ? 'selected' : ''); ?>

                >
                    Dibatalkan
                </option>
            </select>

            <div style="display: flex; gap: 8px;">
                <button type="submit" class="btn btn-primary">
                    Filter
                </button>

                <?php if(request('search') || request('status')): ?>
                    <a
                        href="<?php echo e(route('admin.donations.index')); ?>"
                        class="btn btn-secondary"
                    >
                        Reset
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </section>

    <section class="card">
        <?php if($donations->isEmpty()): ?>
            <div class="empty-state">
                Belum ada data donasi yang ditemukan.
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
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <strong>
                                        <?php echo e($donation->invoice_number); ?>

                                    </strong>
                                </td>

                                <td>
                                    <strong>
                                        <?php echo e($donation->donor_name); ?>

                                    </strong>

                                    <?php if($donation->is_anonymous): ?>
                                        <div
                                            style="
                                                margin-top: 4px;
                                                color: #6b7280;
                                                font-size: 12px;
                                            "
                                        >
                                            Ditampilkan sebagai anonim
                                        </div>
                                    <?php endif; ?>
                                </td>

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
                                    <?php echo e(strtoupper(
                                        $donation->payment_channel
                                            ?? $donation->payment_method
                                    )); ?>

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

                                        <?php case ('failed'): ?>
                                            <span
                                                class="badge"
                                                style="
                                                    background: #fee2e2;
                                                    color: #991b1b;
                                                "
                                            >
                                                Ditolak/Gagal
                                            </span>
                                            <?php break; ?>

                                        <?php case ('cancelled'): ?>
                                            <span class="badge badge-secondary">
                                                Dibatalkan
                                            </span>
                                            <?php break; ?>

                                        <?php default: ?>
                                            <span class="badge badge-secondary">
                                                Pending
                                            </span>
                                    <?php endswitch; ?>
                                </td>

                                <td>
                                    <?php echo e($donation->created_at
                                        ->format('d/m/Y H:i')); ?>

                                </td>

                                <td>
                                    <a
                                        href="<?php echo e(route(
                                            'admin.donations.show',
                                            $donation
                                        )); ?>"
                                        class="btn btn-primary btn-sm"
                                    >
                                        Detail
                                    </a>
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
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project\Laravel\harapan-bangsa\resources\views/admin/donations/index.blade.php ENDPATH**/ ?>