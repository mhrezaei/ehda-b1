<?php if(Auth::user()->isDeveloper()): ?>
	<div class="panel panel-default w100">
		<div class="panel-heading">
			<?php echo e(trans('validation.attributes.slug')); ?>

		</div>

		<div class="text-center m10 ">
			<input type="text" name="slug" time="1" placeholder="<?php echo e(trans('Slug (English Only)')); ?>"  value="<?php echo e($model->slug); ?>" class="form-control text-center ltr ">
		</div>

	</div>
<?php else: ?>

<?php endif; ?>

