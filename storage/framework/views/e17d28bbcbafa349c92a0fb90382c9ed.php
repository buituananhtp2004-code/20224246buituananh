

<?php $__env->startSection('content'); ?>
    <div class="card" style="max-width: 460px; margin: 0 auto;">
        <h2>Đăng ký</h2>

        <?php if($errors->any()): ?>
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 18px;">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('register')); ?>">
            <?php echo csrf_field(); ?>
            <div class="input-group">
                <label for="name">Họ và tên</label>
                <input id="name" type="text" name="name" value="<?php echo e(old('name')); ?>" required autofocus>
            </div>

            <div class="input-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required>
            </div>

            <div class="input-group">
                <label for="password">Mật khẩu</label>
                <input id="password" type="password" name="password" required>
            </div>

            <div class="input-group">
                <label for="password_confirmation">Xác nhận mật khẩu</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
            </div>

            <button type="submit">Đăng ký</button>
        </form>

        <p style="margin-top: 16px; font-size: 14px;">
            Đã có tài khoản? <a href="<?php echo e(route('login')); ?>">Đăng nhập</a>
        </p>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\quanlysinhvien\resources\views/auth/register.blade.php ENDPATH**/ ?>