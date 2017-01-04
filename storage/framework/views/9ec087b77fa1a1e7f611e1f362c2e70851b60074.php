<?php echo $__env->make('manage.frame.use.tabs' , [
	'current' => $page[1][0] ,
	'fake' => !isset($volunteer_id)? $volunteer_id = 0 : 1,
	'tabs' => [
		['browse/all/'.$volunteer_id , trans('people.cards.manage.all') , 'cards.browse'],
//		['browse/complete/'.$volunteer_id , trans('people.cards.manage.complete') , 'cards.browse'],
		['browse/incomplete/'.$volunteer_id , trans('people.cards.manage.incomplete') , 'cards.edit' , $volunteer_id? 0 : $db::counter('card','incomplete') , 'info'],
		['browse/print_request/'.$volunteer_id , trans('people.cards.manage.print_request') , 'cards.print' , $volunteer_id? 0 : $db::counter('card','print_request')],
		['browse/print_control/'.$volunteer_id , trans('people.cards.manage.print_control') , 'cards.print' , $volunteer_id? 0 : $db::counter('card','print_control')],
		['browse/under_print/'.$volunteer_id , trans('people.cards.manage.under_print') , 'cards.print' , $volunteer_id? 0 : $db::counter('card','under_print') , 'info'],
		['browse/newsletter_member/'.$volunteer_id , trans('people.cards.manage.newsletter_member') , 'cards.send'],
		['search' , trans('people.cards.manage.search') , 'cards.search'],
	] ,
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
