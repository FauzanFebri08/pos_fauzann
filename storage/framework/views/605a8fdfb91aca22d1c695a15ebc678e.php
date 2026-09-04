

<?php $__env->startSection('title', 'Produk'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="produk">
<div class="container my-4">
    <div class="card card-main p-3">
        
        <div class="card-body header-banner p-4 mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h3 class="fw-bold mb-1 d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                        <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.85A.5.5 0 0 1 16 3.5v9.75a.5.5 0 0 1-.316.465l-7.5 3a1.5 1.5 0 0 1-1.168 0l-7.5-3A.5.5 0 0 1 0 13.25V3.5a.5.5 0 0 1 .316-.465z"/>
                    </svg>
                    Manajemen Produk
                </h3>
                <p class="mb-0 header-banner-subtitle small">Kelola seluruh data barang, harga, dan stok produk.</p>
            </div>
            
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Produk::class)): ?>
                <a href="<?php echo e(route('produk.create')); ?>" class="btn btn-light fw-bold px-3 py-2 rounded-3 text-primary d-flex align-items-center gap-1 shadow-sm">
                    <span class="fs-5">+</span> Tambah Produk
                </a>
            <?php endif; ?>
        </div>

        <div class="px-2">
            <form action="<?php echo e(route('produk.index')); ?>" method="GET" class="mb-4">
                <div class="input-group">
                    <input 
                        type="text" 
                        name="search" 
                        value="<?php echo e(request('search')); ?>" 
                        class="form-control py-2 ps-3 input-search" 
                        placeholder="Cari nama produk..."
                    >
                    <button class="btn btn-primary px-4 fw-semibold btn-search" type="submit">
                     Search
                    </button>
                </div>
            </form>
            

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="fw-bold text-secondary">#</th>
                            <th scope="col" class="fw-bold text-secondary">Foto</th>
                            <th scope="col" class="fw-bold text-secondary">Nama</th>
                            <th scope="col" class="fw-bold text-secondary">Jenis</th>
                            <th scope="col" class="fw-bold text-secondary">User</th>
                            <th scope="col" class="fw-bold text-secondary">Harga Beli</th>
                            <th scope="col" class="fw-bold text-secondary">Harga Jual</th>
                            <th scope="col" class="fw-bold text-secondary text-center">Stok</th>
                            <th scope="col" class="fw-bold text-secondary text-center">Aksi</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <th scope="row" class="text-secondary fw-normal"><?php echo e($products->firstItem() + $loop->index); ?></th>
                                <td>
                                    <img src="<?php echo e(asset('storage/' . $product->foto)); ?>" 
                                        alt="<?php echo e($product->nama); ?>" 
                                        class="rounded-3 img-thumbnail img-product-thumb">
                                </td>
                                <td class="fw-bold text-dark"><?php echo e($product->nama); ?></td>
                                <td><?php echo e($product->jenis->nama_jenis ?? '-'); ?></td>
                                <td class="text-secondary"><?php echo e($product->user->name); ?></td>
                                <td>Rp <?php echo e(number_format($product->harga_beli, 0, ',', '.')); ?></td>
                                <td class="fw-semibold text-success">Rp <?php echo e(number_format($product->harga_jual, 0, ',', '.')); ?></td>
                                <td class="text-center">
                                    <span class="badge rounded-pill <?php echo e($product->stok > 5 ? 'bg-success' : 'bg-danger'); ?> px-3 py-2">
                                        <?php echo e($product->stok); ?>

                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $product)): ?>
                                            <a href="<?php echo e(route('produk.edit', $product)); ?>" class="btn btn-warning btn-sm text-white rounded-3 px-2">
                                            edit
                                            </a>
                                        <?php endif; ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $product)): ?>
                                            <form action="<?php echo e(route('produk.destroy', $product)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button class="btn btn-danger btn-sm rounded-3 px-2">
                                                hapus
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <h5 class="fw-bold text-secondary mb-0">Data tidak tersedia.</h5>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <?php echo e($products->links()); ?>

            </div>
        </div>

    </div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\finall\resources\views/produk/index.blade.php ENDPATH**/ ?>