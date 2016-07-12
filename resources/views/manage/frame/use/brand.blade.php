<a class="navbar-brand" href="{{ url ('manage') }}">
	{{ trans('manage.global.page_title') }}
</a>

<?php $trans = $link = 'manage'; ?>

@foreach($page as $i => $p)
	<?php
	$trans .= ".$p[0]";
	$link .= "/$p[0]";
	?>
	<span class="navbar-brand">/</span>
	<a class="navbar-brand navbar-brand-sub" href="{{ isset($p[2])? $p[2] : url($link) }}">
		@if($i==0)
			{{ trans("manage.modules.$p[0]") }}
		@elseif(isset($p[1]))
			{{ $p[1] }}
		@else
			{{ trans("$trans.trans") }}
		@endif
	</a>
@endforeach
