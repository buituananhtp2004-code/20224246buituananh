

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2>Danh sách sinh viên</h2>
                <p>Hiển thị <?php echo e(count($students)); ?> trên <?php echo e($total); ?> sinh viên.</p>
            </div>
            <a class="button" href="<?php echo e(route('students.create')); ?>">Thêm sinh viên</a>
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
                    <th>Mã SV</th>
                    <th>Họ tên</th>
                    <th>Năm sinh</th>
                    <th>ĐT</th>
                    <th>Email</th>
                    <th>Lớp</th>
                    <th>Ngành</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($student['ma_sv']); ?></td>
                        <td><?php echo e($student['ho_ten']); ?></td>
                        <td><?php echo e($student['nam_sinh']); ?></td>
                        <td><?php echo e($student['so_dt']); ?></td>
                        <td><?php echo e($student['email']); ?></td>
                        <td><?php echo e($student['lop']); ?></td>
                        <td><?php echo e($student['nganh']); ?></td>
                        <td>
                            <a class="button button-secondary" href="<?php echo e(route('students.edit', $student['id'])); ?>">Sửa</a>
                            <form action="<?php echo e(route('students.destroy', $student['id'])); ?>" method="POST" style="display: inline-block; margin-top: 4px;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="button button-secondary" style="background: #dc2626;">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8">Chưa có sinh viên nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if($pages > 1): ?>
            <div class="pagination">
                <?php for($i = 1; $i <= $pages; $i++): ?>
                    <a href="<?php echo e(route('students.index', ['page' => $i])); ?>" class="<?php echo e($i === $page ? 'active' : ''); ?>"><?php echo e($i); ?></a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\quanlysinhvien\resources\views/students/index.blade.php ENDPATH**/ ?>