

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2>Danh sách lớp học</h2>
                <p>Hiển thị <?php echo e(count($classrooms)); ?> trên <?php echo e($total); ?> lớp học.</p>
            </div>
            <a class="button" href="<?php echo e(route('classrooms.create')); ?>">Thêm lớp học</a>
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
                    <th>Mã lớp</th>
                    <th>Tên lớp</th>
                    <th>Sĩ số</th>
                    <th>Khóa học</th>
                    <th>Ngành</th>
                    <th>Phòng học</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $classrooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classroom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($classroom['ma_lop']); ?></td>
                        <td><?php echo e($classroom['ten_lop']); ?></td>
                        <td><?php echo e($classroom['si_so']); ?></td>
                        <td><?php echo e($classroom['khoa_hoc']); ?></td>
                        <td><?php echo e($classroom['nganh']); ?></td>
                        <td><?php echo e($classroom['phong_hoc'] ?? 'Chưa xác định'); ?></td>
                        <td>
                            <a class="button button-secondary" href="<?php echo e(route('classrooms.edit', $classroom['id'])); ?>">Sửa</a>
                            <form action="<?php echo e(route('classrooms.destroy', $classroom['id'])); ?>" method="POST" style="display: inline-block; margin-top: 4px;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="button button-secondary" style="background: #dc2626;">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7">Chưa có lớp học nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if($pages > 1): ?>
            <div class="pagination">
                <?php for($i = 1; $i <= $pages; $i++): ?>
                    <a href="<?php echo e(route('classrooms.index', ['page' => $i])); ?>" class="<?php echo e($i === $page ? 'active' : ''); ?>"><?php echo e($i); ?></a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin1\Downloads\quanlysinhvien\quanlysinhvien\resources\views/classrooms/index.blade.php ENDPATH**/ ?>