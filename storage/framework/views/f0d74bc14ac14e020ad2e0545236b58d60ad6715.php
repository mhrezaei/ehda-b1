
<?php if(sizeof($topbar_notification_menu = Taha::topbarNotificationMenu() )>1): ?>
	<?php echo $__env->make('manage.frame.widgets.topbar' , [
		'icon' => 'bell' ,
		'items' => $topbar_notification_menu ,
		'counter' => $topbar_notification_menu['total']  ,
		'color' => 'coral'
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<?php if(sizeof($topbar_create_menu = Taha::topbarCreateMenu() )): ?>
	<?php echo $__env->make('manage.frame.widgets.topbar' , [
		'icon' => 'plus-circle' ,
		'items' => $topbar_create_menu ,
		'color' => 'green' ,
//		'text' => trans('forms.button.add') ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>


<?php echo $__env->make('manage.frame.widgets.topbar' , [
	'icon' => 'user' ,
	'color' => 'grey' ,
	'text' => Auth::user()->fullName() ,
	'items' => [
		['manage/account' , trans('manage.account.account_settings') , 'sliders'] ,
//		['-'] ,
		['/logout' , trans('manage.modules.logout') , 'sign-out'] ,
	]
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
