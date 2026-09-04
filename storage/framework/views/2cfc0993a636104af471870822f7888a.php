

<?php $__env->startSection('title', 'Users'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="users">
  <div class="container py-4">

    <div class="card shadow-lg border-0 rounded-4">

        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4">

            <div>
                <h2 class="mb-0">
                    <i class="bi bi-people-fill"></i>
                    Manajemen Users
                </h2>
                <small>Kelola seluruh akun pengguna sistem.</small>
            </div>

            <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-light">
                <i class="bi bi-plus-circle"></i>
                Tambah User
            </a>

        </div>

        <div class="card-body">

            <form action="<?php echo e(route('admin.users')); ?>" method="GET" class="row g-2 mb-4">

                <div class="col-md-10">
                    <input
                        type="text"
                        name="search"
                        value="<?php echo e(request('search')); ?>"
                        class="form-control"
                        placeholder="Cari username atau email...">
                </div>

                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary">
                        <i class="bi bi-search"></i>
                        Search
                    </button>
                </div>

            </form>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                    <tr>
                        <th width="70">#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th width="180">Aksi</th>
                    </tr>

                    </thead>

                    <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr>

                            <td><?php echo e($users->firstItem() + $loop->index); ?></td>

                            <td>
                                <strong><?php echo e($user->name); ?></strong>
                            </td>

                            <td><?php echo e($user->email); ?></td>

                            <td>

                                <?php if($user->role->name == 'admin'): ?>
                                    <span class="badge bg-danger">Admin</span>
                                <?php else: ?>
                                    <span class="badge bg-success">
                                        <?php echo e(ucfirst($user->role->name)); ?>

                                    </span>
                                <?php endif; ?>

                            </td>

                            <td>

                                <a href="<?php echo e(route('admin.users.edit', $user)); ?>"
                                
                                   class="btn btn-warning btn-sm">
                                    edit
                                </a>

                                <form action="<?php echo e(route('admin.users.destroy', $user)); ?>"
                                      method="POST"
                                      class="d-inline ">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus user ini?')">

                                        hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-1"></i><br>
                                Belum ada data user.
                            </td>
                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

            <div class="mt-3">
                <?php echo e($users->links()); ?>

            </div>

        </div>

    </div>

  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\finall\resources\views/users/index.blade.php ENDPATH**/ ?>