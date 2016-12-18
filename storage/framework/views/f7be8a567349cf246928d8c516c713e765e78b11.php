<?php if($branch->hasFeature('category')  and isset($categories_array)): ?>
	<?php echo $__env->make('manage.frame.widgets.grid-action' , [
		'id' => '0',
		'button_size' => 'md' ,
		'button_class' => 'info' ,
		'button_label' => trans('posts.categories.filter_by_category'),
		'actions' => $categories_array
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
