<img id="imgCard" src="" style="height: 450px">
<?php echo $__env->make('forms.opener' , [
	'id' => 'frmEditor',
	'url' => 'manage/cards/save/add_to_print',
//	'title' => $model->id? trans('people.cards.manage.edit').' '.$model->fullName() : trans('people.cards.manage.create') ,
	'class' => 'js' ,
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<input type="hidden" id="txtCard" name="code_melli">

<?php echo $__env->make('forms.button' , [
	'label' => trans('people.cards.manage.send_to_print'),
	'value' => 'print' ,
	'shape' => 'primary',
	'type' => 'submit' ,
	'class' => 'btn-lg m30'
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php if(Auth::user()->can('cards.edit')): ?>
	<?php echo $__env->make('forms.button' , [
		'label' => trans('people.cards.manage.edit'),
		'value' => 'edit' ,
		'shape' => 'default',
		'type' => 'submit' ,
		'class' => 'btn-lg m30'
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>


<?php echo $__env->make('forms.feed' , [], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('forms.closer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>