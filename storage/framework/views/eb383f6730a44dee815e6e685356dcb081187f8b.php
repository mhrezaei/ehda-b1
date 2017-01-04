<?php $__env->startSection('navbar-brand' ,view('manage.frame.use.brand',['page'=>$page]) ); ?>
<?php $__env->startSection('navbar-menus' ,view('manage.frame.use.topbar')); ?>
<?php $__env->startSection('sidebar' , view('manage.frame.use.sidebar')); ?>

<?php $__env->startSection('page_title'); ?>
	<?php if(isset($page[0][1])): ?>
		<?php echo e($page[0][1]); ?>:&nbsp;
	<?php endif; ?>
	<?php echo e(trans('manage.global.page_title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
	<div id="masterModal-lg" class="modal fade">
		<div class="modal-dialog modal-lg" >
			<div class="modal-content">
			</div>
		</div>
	</div>

	<div id="masterModal-md" class="modal fade">
		<div class="modal-dialog" >
			<div class="modal-content">
			</div>
		</div>
	</div>

	<div id="masterModal-sm" class="modal fade">
		<div class="modal-dialog" >
			<div class="modal-content modal-sm">
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('manage.frame.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>