

<?php $__env->startSection('content'); ?>
    <div class="card">
        <h2>Chỉnh sửa lớp học</h2>

        <?php if($errors->any()): ?>
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 18px;">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('classrooms.update', $classroom['id'])); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <?php echo $__env->make('classrooms._form', ['classroom' => $classroom], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <input type="submit" value="Lưu" class="button">
            <a class="button button-secondary" href="<?php echo e(route('classrooms.index')); ?>">Quay lại</a>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\quanlysinhvien\resources\views/classrooms/edit.blade.php ENDPATH**/ ?>