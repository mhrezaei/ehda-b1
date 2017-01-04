<?php if(sizeof($topbar_notification_menu = \App\Http\Controllers\Manage\ManageController::topbarNotificationMenu() )): ?>
	<?php echo $__env->make('manage.frame.widgets.topbar' , [
		'icon' => 'bell' ,
		'items' => $topbar_notification_menu ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<?php if(sizeof($topbar_create_menu = \App\Http\Controllers\Manage\ManageController::topbarCreateMenu() )): ?>
	<?php echo $__env->make('manage.frame.widgets.topbar' , [
		'icon' => 'plus-circle' ,
		'items' => $topbar_create_menu ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<?php echo $__env->make('manage.frame.widgets.topbar' , [
	'icon' => 'user' ,
	'items' => [
		['manage/account' , trans('manage.account.account_settings') , 'sliders'] ,
//		['-'] ,
		['/logout' , trans('manage.modules.logout') , 'sign-out'] ,
	]
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
