<div id="<?php echo e(isset($id) ? $id : ''); ?>" class="alert alert-<?php echo e(isset($shape) ? $shape : 'info'); ?> w90 <?php echo e(isset($div_class) ? $div_class : ''); ?>">
	<?php foreach($texts as $text): ?>
		<div class="row mv5">
			<div class="col-md-1 text-center">
				<i class="fa fa-<?php echo e(isset($icon) ? $icon : 'hand-o-left'); ?> f15 <?php echo e(isset($icon_class) ? $icon_class : ''); ?>"></i>
			</div>
			<div class="col-md-11 text-justify <?php echo e(isset($text_class) ? $text_class : ''); ?>">
				<?php echo e($text); ?>

			</div>
		</div>
	<?php endforeach; ?>
</div>