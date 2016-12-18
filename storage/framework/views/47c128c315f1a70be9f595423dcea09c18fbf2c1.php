<div class="col-lg-3 col-md-6">
	<div class="panel panel-<?php echo e(isset($theme) ? $theme : 'primary'); ?>">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-3">
					<i class="fa fa-<?php echo e(isset($icon) ? $icon : ''); ?> fa-5x"></i>
				</div>
				<div class="col-xs-9 text-left">
					<div class="huge"><?php echo App\Providers\AppServiceProvider::pd(($number)) ?></div>
					<div><?php echo e($text); ?></div>
				</div>
			</div>
		</div>
		<?php if(isset($link) and $link != 'NO'): ?>
			<a href="<?php echo e($link); ?>">
				<div class="panel-footer">
					<span class="pull-left"><?php echo e(isset($button_text) ? $button_text : trans('forms.button.details')); ?></span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		<?php else: ?>
			<div class="panel-footer" style="opacity: 0.5;color:#9d9d9d">
				<?php /*<span class="pull-left" style="font-style: italic"><?php echo e(trans('manage.global.page_title')); ?></span>*/ ?>
				<div class="text-center"><i class="fa fa-bell-slash-o"></i></div>
				<?php /*<span class="pull-left" style="font-style: italic"><i class="fa fa-heart-o"></i></span>*/ ?>
				<?php /*<span class="pull-right"><i class="fa fa-heart-o"></i></span>*/ ?>
				<div class="clearfix"></div>
			</div>
		<?php endif; ?>
	</div>
</div>
