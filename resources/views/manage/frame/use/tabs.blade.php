<ul class="nav nav-tabs">
	@foreach($tabs as $tab)
		<?php
			$url = $tab[0] ;
			$caption = $tab[1] ? $tab[1] : trans('manage/'.$page[0][0].".$tab.trans") ;
			$permit = $tab[2] ? $tab[2] : 'any' ;
		?>
		@if(\Illuminate\Support\Facades\Auth::user()->can($permit))
			<li class="{{ $url == $page[1][0] ? 'active' : $page[1][0] }}">
				<a href="{{ url($url == $page[1][0] ? '#' : "manage/".$page[0][0]."/".$url) }}">{{$caption}}</a>
			</li>
		@endif
	@endforeach
</ul>
