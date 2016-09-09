<li class="dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#">
		<i class="fa fa-{{$icon or 'navicon'}} fa-fw"></i> <i class="fa fa-caret-down"></i>
	</a>
	<ul class="dropdown-menu">

		@foreach($items as $item)
			@if($item[0] == '-' )
				<li class="divider"></li>
			@elseif(isset($item[3]) and !$item[3])
			@else
				@include('manage.frame.use.navbar-dropdown-link' , [
					'target' => url($item[0]),
					'caption'=> $item[1],
					'icon' => $item[2]
				])
			@endif
		@endforeach
	</ul>
</li>

