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


<a href="<?php echo e($target); ?>" title="<?php echo e(isset($caption) ? $caption : ''); ?>" onclick="<?php echo e(isset($on_click) ? $on_click : ''); ?>">
	<button class="btn btn-<?php echo e(isset($type) ? $type : 'default'); ?>">
		<?php /*<i class="fa fa-<?php echo e(isset($icon) ? $icon : 'dot-circle-o'); ?>"></i>*/ ?>
		<?php echo e($caption); ?>

	</button>
</a>
