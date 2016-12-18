<li class="dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#">
		<i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
	</a>
	<ul class="dropdown-menu dropdown-user">

		<?php echo $__env->make('manage.frame.use.navbar-dropdown-link' , [
			'target' => url('manage/profile'),
			'caption'=> trans('manage.modules.profile'),
			'icon' => 'user'
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php /*<?php echo $__env->make('manage.frame.use.navbar-dropdown-link' , [*/ ?>
			<?php /*'target' => url('manage/settings'),*/ ?>
			<?php /*'caption'=> trans('manage.menu.settings'),*/ ?>
			<?php /*'icon' => 'cog'*/ ?>
		<?php /*], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
<?php /**/ ?>
		<?php /*<li class="divider"></li>*/ ?>

		<?php echo $__env->make('manage.frame.use.navbar-dropdown-link' , [
			'target' => url('manage/logout'),
			'caption'=> trans('manage.modules.logout'),
			'icon' => 'sign-out'
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</ul>
	<!-- /.dropdown-user -->
</li>
