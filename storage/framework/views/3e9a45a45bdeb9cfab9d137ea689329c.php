

<?php $__env->startSection('content'); ?>
    <div class="card" style="max-width: 460px; margin: 0 auto;">
        <h2>Đăng nhập</h2>

        <?php if($errors->any()): ?>
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 18px;">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>
            <div class="input-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
            </div>

            <div class="input-group">
                <label for="password">Mật khẩu</label>
                <input id="password" type="password" name="password" required>
            </div>

            <div class="input-group" style="display: flex; align-items: center; gap: 8px;">
                <input id="remember" type="checkbox" name="remember">
                <label for="remember" style="margin: 0;">Ghi nhớ đăng nhập</label>
            </div>

            <button type="submit">Đăng nhập</button>
        </form>

        <p style="margin-top: 16px; font-size: 14px;">
            Chưa có tài khoản? <a href="<?php echo e(route('register')); ?>">Đăng ký ngay</a>
        </p>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin1\Downloads\quanlysinhvien\quanlysinhvien\resources\views/auth/login.blade.php ENDPATH**/ ?>