@include('forms.select' , [
	'name' => isset($name)? $name : 'education' ,
	'value' => isset($value)? $value : '0' ,
	'class' => isset($class)? $class : '' ,
	'blank_value' => isset($blank_value)? $blank_value : '0',
	'size' => 10 ,

	'options' => [
		['id'=>'1' , 'title'=>trans('forms.education.1')],
		['id'=>'2' , 'title'=>trans('forms.education.2')],
		['id'=>'3' , 'title'=>trans('forms.education.3')],
		['id'=>'4' , 'title'=>trans('forms.education.4')],
		['id'=>'5' , 'title'=>trans('forms.education.5')],
		['id'=>'6' , 'title'=>trans('forms.education.6')],
	]
])