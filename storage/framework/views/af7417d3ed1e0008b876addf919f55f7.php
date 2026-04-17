<div class="input-group">
    <label for="ma_lop">Mã lớp</label>
    <input type="text" id="ma_lop" name="ma_lop" value="<?php echo e(old('ma_lop', $classroom['ma_lop'] ?? '')); ?>">
</div>
<div class="input-group">
    <label for="ten_lop">Tên lớp</label>
    <input type="text" id="ten_lop" name="ten_lop" value="<?php echo e(old('ten_lop', $classroom['ten_lop'] ?? '')); ?>">
</div>
<div class="input-group">
    <label for="si_so">Sĩ số</label>
    <input type="number" id="si_so" name="si_so" value="<?php echo e(old('si_so', $classroom['si_so'] ?? '')); ?>">
</div>
<div class="input-group">
    <label for="khoa_hoc">Khóa học</label>
    <input type="text" id="khoa_hoc" name="khoa_hoc" value="<?php echo e(old('khoa_hoc', $classroom['khoa_hoc'] ?? '')); ?>">
</div>
<div class="input-group">
    <label for="nganh">Ngành</label>
    <input type="text" id="nganh" name="nganh" value="<?php echo e(old('nganh', $classroom['nganh'] ?? '')); ?>">
</div>
<div class="input-group">
    <label for="giao_vien">Giáo viên</label>
    <input type="text" id="giao_vien" name="giao_vien" value="<?php echo e(old('giao_vien', $classroom['giao_vien'] ?? '')); ?>">
</div>
<div class="input-group">
    <label for="ghi_chu">Ghi chú</label>
    <textarea id="ghi_chu" name="ghi_chu" rows="3"><?php echo e(old('ghi_chu', $classroom['ghi_chu'] ?? '')); ?></textarea>
</div>
<?php /**PATH C:\xampp\htdocs\quanlysinhvien\resources\views/classrooms/_form.blade.php ENDPATH**/ ?>