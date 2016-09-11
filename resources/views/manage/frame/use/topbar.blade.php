@include('manage.frame.widgets.topbar' , [
	'id' => 'topBarCreate' ,
	'icon' => 'plus-circle' ,
	'items' => $topbar_create_menu = \App\Http\Controllers\Manage\ManageController::topbarCreateMenu() ,
])

@include('manage.frame.widgets.topbar' , [
	'icon' => 'user' ,
	'items' => [
		['manage/account' , trans('manage.account.account_settings') , 'sliders'] ,
//		['-'] ,
		['/logout' , trans('manage.modules.logout') , 'sign-out'] ,
	]
])

@if(!sizeof($topbar_create_menu))
	<script>
		$('#topBarCreate').hide() ; 
	</script>
@endif