<ul class="nav nav-tabs">
	@foreach($tabs as $tab)
		<li role="setting" class="{{ $tab == $request_tab ? 'active' : '' }}">
			<a href="{{ url ($tab == $request_tab ? '#' : "manage/$request_module/$tab" ) }}">{{ trans("manage.$request_module.$tab.tab-title") }}</a>
		</li>
	@endforeach
</ul>