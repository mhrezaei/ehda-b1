<?php echo $__env->make('forms.select' , [
	'name' => isset($name)? $name : 'marital' ,
	'value' => isset($value)? $value : '0' ,
	'class' => isset($class)? $class : '' ,
	'blank_value' => isset($blank_value)? $blank_value : 'NO',

	'options' => [
		['id'=>'2' , 'title'=>trans('forms.general.single')],
		['id'=>'1' , 'title'=>trans('forms.general.married')],
	]
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>