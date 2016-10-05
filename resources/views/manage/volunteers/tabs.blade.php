@include('manage.frame.use.tabs' , [
	'current' => $page[1][0] ,
	'tabs' => [
		['browse/active' , trans('people.volunteers.manage.active') , 'volunteers'],
		['browse/pending' , trans('people.volunteers.manage.pending') , 'volunteers.publish' , $db->counter('volunteer','pending')],
		['browse/care' , trans('people.volunteers.manage.care') , 'volunteers.edit' , $db->counter('volunteer','care')],
		['browse/documentation' , trans('people.volunteers.manage.documentation') , 'volunteers.publish'],
		['browse/examining' , trans('people.volunteers.manage.examining') , 'volunteers.publish'],
		['browse/bin' , trans('people.volunteers.manage.bin') , 'volunteers.bin'],
		['search' , trans('people.volunteers.manage.search') , 'volunteers.search'],
	] ,
])
