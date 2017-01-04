<?php echo $__env->make('manage.frame.use.tabs' , [
	'current' => $page[1][0] ,
	'tabs' => $model_data->first()->categories(),
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>