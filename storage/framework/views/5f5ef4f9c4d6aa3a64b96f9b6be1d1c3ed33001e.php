<?php
	if(!isset($id))
		$id = 'formSearch-'.rand(1000,9999);

	if(!isset($label))
		$label = trans('forms.button.search') ;
?>

<span id="<?php echo e($id); ?>-span" class="search">
	<?php echo Form::open([
		'id' => $id ,
		'url' => $target ,
		'method' => isset($method)? $method : 'get' ,
//		'files' => isset($files)? $files : 'false' ,
		'class' => 'form-inline' ,
		'style' => 'display:inline;',
//		'onsubmit' => "return search('$id')"
	]); ?>


	<input name="<?php echo e(isset($field_name) ? $field_name : 'keyword'); ?>" value="<?php echo e(isset($value) ? $value : ''); ?>" class="form-control" placeholder="<?php echo e($label); ?>...">
	<input name="searched" type="hidden" value="1">
	<?php /*<button type="submit" class="btn btn-<?php echo e(isset($type) ? $type : 'default'); ?>">*/ ?>
		<?php /*<i class="fa fa-search"></i>*/ ?>
	<?php /*</button>*/ ?>

	<?php echo Form::close(); ?>

</span>
