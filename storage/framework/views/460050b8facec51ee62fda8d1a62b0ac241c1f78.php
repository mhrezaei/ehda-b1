<?php echo $__env->make('manage.frame.use.tabs' , [
	'current' => $page[1][0] ,
	'tabs' => [
		['branches' , trans('manage.devSettings.branches.trans')],
//		['categories' , trans('manage.devSettings.categories.trans')],
		['domains' , trans('manage.devSettings.domains.trans')],
		['states' , trans('manage.devSettings.states.trans')],
	] ,
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
