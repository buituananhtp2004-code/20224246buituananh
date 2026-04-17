

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2>Danh sách phòng học</h2>
                <p>Hiển thị <?php echo e(count($rooms)); ?> trên <?php echo e($total); ?> phòng học.</p>
            </div>
            <a class="button" href="<?php echo e(route('rooms.create')); ?>">Thêm phòng học</a>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-error"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Mã phòng</th>
                    <th>Tên phòng</th>
                    <th>Tòa nhà</th>
                    <th>Tầng</th>
                    <th>Sức chứa</th>
                    <th>Loại phòng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($room['ma_phong']); ?></td>
                        <td><?php echo e($room['ten_phong']); ?></td>
                        <td><?php echo e($room['toà_nha']); ?></td>
                        <td><?php echo e($room['tang']); ?></td>
                        <td><?php echo e($room['suc_chua']); ?></td>
                        <td><?php echo e($room['loai_phong']); ?></td>
                        <td>
                            <a class="button button-secondary" href="<?php echo e(route('rooms.edit', $room['id'])); ?>">Sửa</a>
                            <form action="<?php echo e(route('rooms.destroy', $room['id'])); ?>" method="POST" style="display: inline-block; margin-top: 4px;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="button button-secondary" style="background: #dc2626;">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7">Chưa có phòng học nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if($pages > 1): ?>
            <div class="pagination">
                <?php for($i = 1; $i <= $pages; $i++): ?>
                    <a href="<?php echo e(route('rooms.index', ['page' => $i])); ?>" class="<?php echo e($i === $page ? 'active' : ''); ?>"><?php echo e($i); ?></a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\quanlysinhvien\resources\views/rooms/index.blade.php ENDPATH**/ ?>