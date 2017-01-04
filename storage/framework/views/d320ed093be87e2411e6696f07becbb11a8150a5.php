<?php $__env->startSection('section'); ?>

	<?php echo $__env->make('manage.posts.editor-warnings', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php if($model->deleted_at): ?>
		<?php echo $__env->make('manage.posts.editor-undelete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endif; ?>

	<?php echo $__env->make('forms.opener' , [
		'id' => 'frmEditor',
		'url' => 'manage/posts/save',
		'files' =>false,
		'title' => $model->id ? trans('posts.manage.edit',[
			'thing' => $model->branch()->title(1),
		]) : trans('posts.manage.create' ,[
			'thing' => $model->branch()->title(1),
		]),
		'class' => 'js'
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div class="row w100">
		<?php /*
		|--------------------------------------------------------------------------
		| Big Side
		|--------------------------------------------------------------------------
		| For the main content
		*/ ?>

		<div class="col-md-9">

			<?php echo $__env->make('forms.feed' , [], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('forms.hiddens' , ['fields' => [
				['id' , $model->id ],
				['action' , '' , 'txtAction'] ,
				['branch' , $model->branch()->encrypted_slug()] ,
				['is_published' , $model->published_by]
			]], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php if($model->branch()->hasFeature('title')): ?>
				<?php echo $__env->make('forms.input' , [
					'name' => 'title',
					'value' => $model->title ,
					'class' => 'form-required form-default',
					'hint' => trans('posts.manage.title_hint') ,
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php else: ?>
				<?php echo $__env->make('forms.hiddens' , ['fields' => [
					['title' , $model->title? $model->title : '-'],
				]], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php endif; ?>

			<?php if($model->branch()->hasFeature('text')): ?>
				<?php echo $__env->make('forms.textarea' , [
					'name' => 'text',
					'id' => 'txtText' ,
					'class' => 'form-required tinyEditor',
					'value' => $model->text ,
					'rows' => 15,
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php else: ?>
				<?php echo $__env->make('forms.hiddens' , ['fields' => [
					['text' , '-'],
				]], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php endif; ?>

			<?php if($model->branch()->hasFeature('abstract')): ?>
				<?php echo $__env->make('forms.textarea' , [
					'name' => 'abstract',
					'value' => $model->abstract ,
					'hint' => trans('posts.manage.abstract_hint'.(!$model->branch()->hasFeature('text')? '_for_galleries' : '')),
					'rows' => 4,
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php endif; ?>

			<?php if($model->branch()->hasFeature('category')): ?>
				<?php echo $__env->make('forms.select' , [
					'name' => 'category_id' ,
					'value' => $model->category_id  ,
					'options' => $model->branch()->categories ,
					'blank_value' => '',
	//				'class' => 'form-required',
					'blank_label' => trans('posts.categories.without')
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php endif; ?>

			<?php if($model->branch()->hasFeature('keyword')): ?>
				<?php echo $__env->make('forms.textarea' , [
					'name' => 'keywords',
					'value' => $model->keywords ,
					'hint' => trans('posts.manage.keywords_hint'),
					'rows' => 2,
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php endif; ?>

			<?php echo $__env->make('manage.posts.editor-meta', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php if($model->branch()->hasFeature('gallery')): ?>
				<?php echo $__env->make('manage.posts.editor-album', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php endif; ?>
			<?php /*<?php echo $__env->make('manage.posts.editor-multidomains', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>


		</div>


		<?php /*
		|--------------------------------------------------------------------------
		| Small Side
		|--------------------------------------------------------------------------
		| For the buttons, keywords and publish options
		*/ ?>

		<div class="col-md-3">

			<?php echo $__env->make('manage.posts.editor-status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('manage.posts.editor-slug', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('manage.posts.editor-saves', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('manage.posts.editor-image', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('manage.posts.editor-schedule', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('manage.posts.editor-domains', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('manage.posts.editor-creator', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		</div>
	</div>

	<?php echo $__env->make('forms.closer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('manage.frame.use.0', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>