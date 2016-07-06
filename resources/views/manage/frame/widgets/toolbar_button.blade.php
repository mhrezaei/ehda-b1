<?php

if(!isset($target)) {
	$target = 'javascript:void(0)' ;
	$on_click = '' ;
}
elseif(str_contains($target,'(')) {
	$on_click = $target ;
	$target = 'javascript:void(0)' ;
}
else {
	$target = url($target) ;
}

?>


<a href="{{$target}}" class="btn btn-{{ $type or 'default' }} tbtn-toolbar" onclick="{{$on_click or ''}}">
	{{ $caption or '' }}
</a>
