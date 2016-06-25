<li class="dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#">
		<i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
	</a>
	<ul class="dropdown-menu dropdown-user">

		@include('manage.frame.use.navbar-dropdown-link' , [
			'target' => url('manage/profile'),
			'caption'=> trans('manage.menu.profile'),
			'icon' => 'user'
		])

		@include('manage.frame.use.navbar-dropdown-link' , [
			'target' => url('manage/settings'),
			'caption'=> trans('manage.menu.settings'),
			'icon' => 'cog'
		])

		<li class="divider"></li>

		@include('manage.frame.use.navbar-dropdown-link' , [
			'target' => url('manage/logout'),
			'caption'=> trans('manage.menu.logout'),
			'icon' => 'sign-out'
		])
	</ul>
	<!-- /.dropdown-user -->
</li>
