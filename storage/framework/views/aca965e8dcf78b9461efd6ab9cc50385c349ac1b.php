<?php $__env->startSection('section'); ?>
	<?php echo $__env->make('manage.settings.dev_tab', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.opener',[
		'url' => 'manage/devSettings/posts-cats/save' ,
		'title' => isset($model)? trans('manage.devSettings.posts-cats.edit.trans') : trans('manage.devSettings.posts-cats.add.trans'),
		'class' => 'js' ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.hidden' , [
		'name' => 'id' ,
		'value' => isset($model)? $model->id : '0',
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('forms.hidden' , [
		'name' => 'parent_id' ,
		'value' => isset($model)? $model->parent_id : '0',
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
	    'name' =>	'title',
	    'value' =>	isset($model)? $model->title : '',
	    'class' => 'form-required' ,
	    'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.persian-only'),
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
	    'name' =>	'slug',
	    'class' =>	'form-required ltr',
		'value' =>	isset($model)? $model->slug : '',
	    'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.english-only'),
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.group-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.check' , [
	    'name' => 'have_rss',
	    'label' => trans('manage.devSettings.posts-cats.add.have_rss'),
	    'value' => isset($model)? $model->have_rss : '',
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.check' , [
	    'name' => 'have_comments',
	    'label' => trans('manage.devSettings.posts-cats.add.have_comments'),
	    'value' => isset($model)? $model->have_comments : '',
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.check' , [
	    'name' => 'is_gallery',
	    'label' => trans('manage.devSettings.posts-cats.add.is_gallery'),
	    'value' => isset($model)? $model->is_gallery : '',
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.check' , [
	    'name' => 'is_hidden',
	    'label' => trans('manage.devSettings.posts-cats.add.is_hidden'),
	    'value' => isset($model)? $model->is_hidden : '',
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.group-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.button' , [
		'label' => trans('forms.button.save'),
		'shape' => 'success',
		'type' => 'submit' ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('forms.button' , [
		'label' => trans('forms.button.cancel'),
		'shape' => 'link',
		'link' => '/manage/devSettings/posts-cats'
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.feed', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.closer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('manage.frame.use.0', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>