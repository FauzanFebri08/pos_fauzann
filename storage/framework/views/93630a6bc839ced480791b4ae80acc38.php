

<?php $__env->startSection('title', 'Jenis'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container my-4">
    <div class="card border-0 shadow-sm rounded-4 p-3">
        
        <div class="card-body bg-primary text-white rounded-4 p-4 mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h3 class="fw-bold mb-1 d-flex align-items-center gap-2">
                    Manajemen Jenis
                </h3>
                <p class="mb-0 text-white-50 small">Kelola seluruh data transaksi Jenis.</p>
            </div>
            <a href="<?php echo e(route('jenis.create')); ?>" class="btn btn-light text-primary fw-bold px-3 py-2 rounded-3 shadow-sm">
                + Tambah Jenis
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="fw-bold text-secondary" style="width: 10%;">#</th>
                        <th scope="col" class="fw-bold text-secondary" style="width: 30%;">Nama Jenis</th>
                        <th scope="col" class="fw-bold text-secondary" style="width: 30%;">Dibuat Oleh</th>
                        <th scope="col" class="fw-bold text-secondary text-end" style="width: 30%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $jenis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            
                            <td><?php echo e($item->nama_jenis); ?></td>
                            
                            
                            <td><?php echo e($item->user?->name); ?></td>
                            
                            <td class="text-end">
                                <form action="<?php echo e(route('jenis.destroy', $item->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <a href="<?php echo e(route('jenis.edit', $item->id)); ?>" class="btn btn-warning btn-sm text-white fw-semibold rounded-2">
                                        Edit
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-sm fw-semibold rounded-2">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Belum ada data jenis yang tersimpan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\finall\resources\views/jenis/index.blade.php ENDPATH**/ ?>