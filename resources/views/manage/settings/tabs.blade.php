<ul class="nav nav-tabs">
	@foreach($tabs as $tab)
		<li role="setting" class="{{ $tab == $page[1][0] ? 'active' : '' }}">
			<a href="{{ url ($tab == $page[1][0] ? '#' : "manage/".$page[0][0]."/$tab" ) }}">{{ trans("manage.".$page[0][0].".$tab.trans") }}</a>
		</li>
	@endforeach
</ul>