<?php $__env->startSection('email_content'); ?>
	سفیر گرامی
	<br>
	خبردار شدیم که رمز عبور خود را در سامانهٔ اهدای عضو فراموش کرده‌اید.
	<br>
	برای ساختن رمز تازه، به این کد عددی نیاز خواهید داشت که می‌بایست در همان صفحه‌ای که فراموشی خود را اعلام کردید، وارد نمایید.
	<br>
	<strong style="font-size: 16px;"><?php echo e($reset_token); ?></strong>
	<br>
	یادتان باشد که این کد، ظرف چند دقیقه منقضی می‌شود.
	<br>
	اگر شما چنین درخواستی نداده‌اید، این ایمیل را نادیده بگیرید. حساب کاربری شما ایمن خواهد ماند.
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.email.email_frame', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>