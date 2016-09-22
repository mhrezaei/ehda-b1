@if(sizeof($topbar_notification_menu = \App\Http\Controllers\Manage\ManageController::topbarNotificationMenu() ))
	@include('manage.frame.widgets.topbar' , [
		'icon' => 'bell' ,
		'items' => $topbar_notification_menu ,
		'counter' => $topbar_notification_menu[0]['total'] ,
		'color' => 'coral'
	])
@endif

@if(sizeof($topbar_create_menu = \App\Http\Controllers\Manage\ManageController::topbarCreateMenu() ))
	@include('manage.frame.widgets.topbar' , [
		'icon' => 'plus-circle' ,
		'items' => $topbar_create_menu ,
		'color' => 'green'
	])
@endif

@include('manage.frame.widgets.topbar' , [
	'icon' => 'user' ,
	'color' => 'grey' ,
	'items' => [
		['manage/account' , trans('manage.account.account_settings') , 'sliders'] ,
//		['-'] ,
		['/logout' , trans('manage.modules.logout') , 'sign-out'] ,
	]
])
