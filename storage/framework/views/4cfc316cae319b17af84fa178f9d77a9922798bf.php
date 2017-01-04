<div class="row top-bar bg-primary clearfix">
	<ul class="pull-right list-inline no-margin">
		<?php if(Auth::check()): ?>
		<li class="has-child">
			<a href="/"><?php echo e(Auth::user()->name_first); ?> <?php echo e(trans('site.global.users_welcome_msg')); ?></a>
			<ul class="list-unstyled bg-primary">
				<li><a href="<?php echo e(url('/members/my_card')); ?>"><?php echo e(trans('site.global.show_organ_donation_card')); ?></a></li>
				<li><a href="<?php echo e(url('/card/show_card/full/' . encrypt(Auth::user()->code_melli) . '/download')); ?>"><?php echo e(trans('site.global.download_oragan_donation_card')); ?></a></li>
				<li><a href="<?php echo e(url('/members/my_card/print')); ?>"><?php echo e(trans('forms.button.card_print')); ?></a></li>
				<li><a href="<?php echo e(url('/members/my_card/edit')); ?>"><?php echo e(trans('site.global.users_edit_data')); ?></a></li>
				<li><a href="<?php echo e(url('/logout')); ?>"><?php echo e(trans('site.global.log_out')); ?></a></li>
			</ul>
		</li>
		<?php else: ?>
			<li>
				<a href="<?php echo e(url('/login')); ?>"><?php echo e(trans('site.global.users_login')); ?></a>
			</li>
		<?php endif; ?>
		<li>
			<a href="<?php echo e(url('/login11')); ?>"><?php echo e(trans('site.global.stats_login')); ?></a>
		</li>
	</ul>
	<a href="/" class="slogan pull-left">
		<span><?php echo e(trans('site.global.organ_donation')); ?></span><span><?php echo e(trans('site.global.donate_life')); ?></span>
	</a>
</div>
