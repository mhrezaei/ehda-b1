<?php if(!$model->trashed()): ?>
	<div class="panel panel-default w100">
		<div class="panel-heading">
			<?php echo e(trans('posts.manage.operation')); ?>

		</div>

		<?php if($model->isPublished()): ?>
			<?php echo $__env->make('manage.posts.editor-saves-preview' , ['text'=>trans('posts.manage.view_in_site')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('manage.posts.editor-saves-update' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<hr>
			<?php echo $__env->make('manage.posts.editor-saves-unpublish', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('manage.posts.editor-saves-delete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php elseif($model->isScheduled()): ?>
			<?php echo $__env->make('manage.posts.editor-saves-preview', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('manage.posts.editor-saves-update' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<hr>
			<?php echo $__env->make('manage.posts.editor-saves-unpublish', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('manage.posts.editor-saves-delete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php else: ?>
			<?php echo $__env->make('manage.posts.editor-saves-preview', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('manage.posts.editor-saves-draft', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('manage.posts.editor-saves-review', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('manage.posts.editor-saves-publish', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('manage.posts.editor-saves-delete' , ['class' => 'btn-link'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php endif; ?>
	</div>
<?php endif; ?>