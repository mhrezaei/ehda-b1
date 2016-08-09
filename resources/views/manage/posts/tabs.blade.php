@include('manage.frame.use.tabs' , [
	'current' => $page[0][2] ,
	'tabs' => [
		['published' , trans('posts.manage.published') , $branch->title()],
		['pending' , trans('posts.manage.pending') , $branch->title().'.publish'],
		['my_posts' , trans('posts.manage.my_posts') , $branch->title().'.create'],
		['my_drafts' , trans('posts.manage.my_drafts') , $branch->title().'.create'],
		['bin' , trans('posts.manage.bin') , $branch->title().'.bin'],
		['search' , trans('people.volunteers.manage.search') , $branch->title().'.search'],
	] ,
])
