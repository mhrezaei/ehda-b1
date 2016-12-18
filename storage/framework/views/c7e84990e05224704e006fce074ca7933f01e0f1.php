<?php echo $__env->make('manage.frame.use.tabs' , [
	'current' => $page[1][0] ,
	'tabs' => [
		['browse/all' , trans('people.cards.manage.all') , 'cards.browse'],
//		['browse/complete' , trans('people.cards.manage.complete') , 'cards.browse'],
		['browse/incomplete' , trans('people.cards.manage.incomplete') , 'cards.browse' , $db::counter('card','incomplete') , 'info'],
		['browse/print_request' , trans('people.cards.manage.print_request') , 'cards.print' , $db::counter('card','print_request')],
		['browse/print_control' , trans('people.cards.manage.print_control') , 'cards.print' , $db::counter('card','print_control')],
		['browse/under_print' , trans('people.cards.manage.under_print') , 'cards.print' , $db::counter('card','under_print') , 'info'],
		['browse/newsletter_member' , trans('people.cards.manage.newsletter_member') , 'cards.send'],
		['search' , trans('people.cards.manage.search') , 'cards.search'],
	] ,
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
