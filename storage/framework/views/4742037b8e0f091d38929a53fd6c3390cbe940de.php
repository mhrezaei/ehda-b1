<?php echo $__env->make('forms.select' , [
	'name' => isset($name)? $name : 'gender' ,
	'value' => isset($value)? $value : '0' ,
	'class' => isset($class)? $class : '' ,
	'blank_value' => isset($blank_value)? $blank_value : 'NO',

	'options' => [
		['id'=>'2' , 'title'=>trans('forms.general.female')],
		['id'=>'1' , 'title'=>trans('forms.general.male')],
	]
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>