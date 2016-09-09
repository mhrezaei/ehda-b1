{{-- $submenu[0=>url 1=>permission 2=>label] --}}
@if(Auth::user()->can($module))

	<?php
		if(str_contains($module,'posts-')) {
			$slug = str_replace('posts-','',$module) ;
			$target = "posts/$slug" ;
		}
		else {
			$target = $module ;
			$caption = trans('manage.modules.'.$module) ;
		}
	?>

	<li {{ (Request::is('*'.$module) ? 'class="active"' : '') }}>
		@if(isset($disabled) and $disabled)
			<a href="javascript:void(0)" class="text-grey" style="cursor: default;z-index: -1">
				<i class="fa fa-{{ $icon or 'dot-circle-o' }} fa-fw"></i>
				&nbsp;{{ $caption }}&nbsp;
				@if(isset($sub_menus))
					<span class="fa arrow">
				@endif
			</a>
		@else
			<a href="{{ url ('manage/'.$target) }}">
				<i class="fa fa-{{ $icon or 'dot-circle-o' }} fa-fw"></i>
				&nbsp;{{ $caption }}&nbsp;
				@if(isset($sub_menus))
					<span class="fa arrow">
				@endif
			</a>
		@endif

		@if(isset($sub_menus))
			<ul class="nav nav-second-level">
				@foreach($sub_menus as $sub_menu) {{-- [$target,$permit,$caption]  --}}
					@if(Auth::user()->can($module.$sub_menu[1]))
						<li {{ (Request::is('*'.$sub_menu[0]) ? 'class="active"' : '') }}>
							<a href="{{ url ("manage/$module/".$sub_menu[0]) }}">{{ $sub_menu[2] }}</a>
						</li>
					@endif
				@endforeach
			</ul>
		@endif

	</li>
@endif
