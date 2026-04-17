

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
            <div>
                <h2>Danh sách học phần</h2>
                <p>Hiển thị <?php echo e(count($subjects)); ?> trên <?php echo e($total); ?> học phần.</p>
            </div>
            <a class="button" href="<?php echo e(route('subjects.create')); ?>">Thêm học phần</a>
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
                    <th>Mã HP</th>
                    <th>Tên học phần</th>
                    <th>Tín chỉ</th>
                    <th>Học kỳ</th>
                    <th>Năm học</th>
                    <th>Loại</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($subject['ma_hp']); ?></td>
                        <td><?php echo e($subject['ten_hp']); ?></td>
                        <td><?php echo e($subject['so_tin_chi']); ?></td>
                        <td><?php echo e($subject['hoc_ky']); ?></td>
                        <td><?php echo e($subject['nam_hoc']); ?></td>
                        <td><?php echo e($subject['loai_hoc_phan']); ?></td>
                        <td>
                            <a class="button button-secondary" href="<?php echo e(route('subjects.edit', $subject['id'])); ?>">Sửa</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7">Chưa có học phần nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if($pages > 1): ?>
            <div class="pagination">
                <?php for($i = 1; $i <= $pages; $i++): ?>
                    <a href="<?php echo e(route('subjects.index', ['page' => $i])); ?>" class="<?php echo e($i === $page ? 'active' : ''); ?>"><?php echo e($i); ?></a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\quanlysinhvien\resources\views/subjects/index.blade.php ENDPATH**/ ?>