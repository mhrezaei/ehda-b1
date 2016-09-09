@include('manage.frame.widgets.topbar' , [
	'icon' => 'plus-circle' ,
	'items' => \App\Http\Controllers\Manage\ManageController::topbarCreateMenu() ,
])

@include('manage.frame.widgets.topbar' , [
	'icon' => 'user' ,
	'items' => [
		['manage/account' , trans('manage.account.settings') , 'sliders'] ,
//		['-'] ,
		['/logout' , trans('manage.modules.logout') , 'sign-out'] ,
	]
])

