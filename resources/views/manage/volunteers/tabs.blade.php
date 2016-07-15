@include('manage.frame.use.tabs' , [
	'tabs' => [
		['browse/active' , trans('people.volunteers.manage.active') , 'volunteers'],
		['browse/pending' , trans('people.volunteers.manage.pending') , 'volunteers.publish'],
		['browse/care' , trans('people.volunteers.manage.care') , 'volunteers.edit'],
		['browse/examining' , trans('people.volunteers.manage.examining') , 'volunteers'],
		['browse/bin' , trans('people.volunteers.manage.bin') , 'volunteers.bin'],
//		['search' , trans('people.volunteers.manage.search') , 'volunteers.search'],
	] ,
])
