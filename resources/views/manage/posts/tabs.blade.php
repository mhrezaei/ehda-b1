@include('manage.frame.use.tabs' , [
	'current' => $page[0][2] ,
	'tabs' => [
		['published' , trans('posts.manage.published') , $branch->title()],
		['pending' , trans('posts.manage.pending') , $branch->title().'.publish'],
		['bin' , trans('posts.manage.bin') , $branch->title().'.bin'],
		['search' , trans('people.volunteers.manage.search') , $branch->title().'.search'],
	] ,
])
