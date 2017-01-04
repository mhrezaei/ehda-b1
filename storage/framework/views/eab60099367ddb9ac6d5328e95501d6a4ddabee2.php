<?php
if(!isset($name))
	$name = 'date' ;

if(!isset($id))
	$id = 'txtDate'.rand(1,1000) ;

if(isset($class))
	$class = 'datepicker '.$class ;
else
	$class = 'datepicker ';

if(isset($value) and $value and $value != '0000-00-00') {
	$j_value = jdate($value)->format('Y/m/d');
}
else {
	$j_value = '' ;
	$value = '' ;
}
?>

<?php echo $__env->make('forms.input' , [
    'name' => $name,
    'label' => isset($label)? $label : trans("validation.attributes.$name"),
    'value' => $j_value,
    'id' => $id,
    'type' => isset($type)? $type : '',
    'class' => $class,
    'placeholder' =>  isset($placeholder)? $placeholder : '',
    'hint' => isset($hint)? $hint : '',
    'extra' => isset($extra)? $extra : '',
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('forms.hidden' , [
	'name' => $name ,
	'id' => $id."_extra" ,
	'value' => $value ,
	'class' => '' ,
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
