

<?php $__env->startSection('title', 'Penjualan'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container my-4">
    <div class="card border-0 shadow-sm rounded-4 p-3">
        
        <!-- Pesan Notifikasi Success / Error -->
        
        <div class="card-body bg-primary text-white rounded-4 p-4 mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h3 class="fw-bold mb-1 d-flex align-items-center gap-2">
                    Manajemen Penjualan
                </h3>
                <p class="mb-0 text-white-50 small">Kelola seluruh data transaksi penjualan.</p>
            </div>
            <a href="<?php echo e(route('penjualan.create')); ?>" class="btn btn-light text-primary fw-bold px-3 py-2 rounded-3 shadow-sm">
                + Tambah Penjualan
            </a>
        </div>

        <div class="px-2">
            <form action="<?php echo e(route('penjualan.index')); ?>" method="GET" class="mb-4">
                <div class="input-group">
                    <input 
                        type="text" 
                        name="search" 
                        value="<?php echo e(request('search')); ?>" 
                        class="form-control py-2 ps-3 border-end-0" 
                        placeholder="Cari nama kasir..."
                    >
                    <button class="btn btn-primary px-4 fw-bold" type="submit">
                        Search
                    </button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="fw-bold text-secondary">#</th>
                            <th scope="col" class="fw-bold text-secondary">Tanggal Transaksi</th>
                            <th scope="col" class="fw-bold text-secondary">Kasir</th>
                            <th scope="col" class="fw-bold text-secondary">Total Pembayaran</th>
                            <th scope="col" class="fw-bold text-secondary">Metode Pembayaran</th>
                            <th scope="col" class="fw-bold text-secondary">Status</th>
                            <th scope="col" class="fw-bold text-secondary text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <th scope="row" class="text-secondary fw-normal"><?php echo e($sales->firstItem() + $loop->index); ?></th>
                                <td class="fw-semibold text-dark"><?php echo e($sale->created_at->translatedFormat('d-m-Y H:i:s')); ?></td>
                                <td class="text-secondary"><?php echo e($sale->user->name ?? '-'); ?></td>
                                <td class="fw-bold text-success">Rp <?php echo e(number_format($sale->total_pembayaran, 0, ',', '.')); ?></td>
                                <td>
                                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                        <?php echo e($sale->metode_pembayaran); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="badge rounded-pill <?php echo e(strtoupper($sale->status) == 'COMPLETED' ? 'bg-success' : 'bg-warning text-dark'); ?> px-3 py-2">
                                        <?php echo e($sale->status); ?>

                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                    
                                        <?php if(strtoupper($sale->status) == 'COMPLETED'): ?>
                                            <a href="<?php echo e(route('penjualan.show', $sale)); ?>" class="btn btn-info btn-sm text-white rounded-2 px-2 py-1">
                                                Detail
                                            </a>
                                        <?php else: ?>
                                            
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view', $sale)): ?>
                                                <a href="<?php echo e(route('penjualan.edit', $sale)); ?>" class="btn btn-warning btn-sm text-white rounded-2 px-2 py-1">
                                                    Lanjutkan
                                                </a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $sale)): ?>
                                            <form action="<?php echo e(route('penjualan.destroy', $sale)); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin akan menghapus penjualan ini?');" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-2">
                                                    Hapus
                                                </button>
                                            </form>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <h4 class="fw-bold text-dark mb-0">Data tidak tersedia.</h4>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <?php echo e($sales->links()); ?>

            </div>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\finall\resources\views/penjualan/index.blade.php ENDPATH**/ ?>