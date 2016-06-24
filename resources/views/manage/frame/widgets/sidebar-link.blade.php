<li {{ (Request::is('*'.$url) && $url!='#' ? 'class="active"' : '') }}>
	<a href="{{ url ($url) }}">
		<i class="fa fa-{{ $icon or 'dot-circle-o' }} fa-fw"></i>
		&nbsp;{{$caption or '...'}}&nbsp;
		@if(isset($sub_menus))
			<span class="fa arrow">
		@endif
	</a>

	@if(isset($sub_menus))
		<ul class="nav nav-second-level">
			@foreach($sub_menus as $sub_menu)
				<li {{ (Request::is('*'.$sub_menu) ? 'class="active"' : '') }}>
					<a href="{{ url ('manage/'.$sub_menu) }}">{{ trans('manage.menu.'.$sub_menu) }}</a>
				</li>
			@endforeach
		</ul>
	@endif

</li>
