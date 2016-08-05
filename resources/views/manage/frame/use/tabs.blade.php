{{-- $tabs = [ 0:url 1:caption 2:permit ] --}}
<ul class="nav nav-tabs">
	@foreach($tabs as $tab)
		<?php
			$url = $tab[0] ;
			$caption = $tab[1] ? $tab[1] : trans('manage/'.$page[0][0].".$tab.trans") ;
			$permit = $tab[2] ? $tab[2] : 'any' ;
			if($url==$current)
				$active = true ;
			else
				$active = false ;
		?>
		@if(\Illuminate\Support\Facades\Auth::user()->can($permit))
			<li class="{{ $active ? 'active' : '' }}">
				<a href="{{ url($active ? '#' : "manage/".$page[0][0]."/".$url) }}">{{$caption}}</a>
			</li>
		@endif
	@endforeach
</ul>
