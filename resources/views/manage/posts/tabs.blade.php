@include('manage.frame.use.tabs' , [
	'current' => $page[0][2] ,
	'tabs' => [
		['published' , trans('posts.manage.published') , $branch->title()],
		['scheduled' , trans('posts.manage.scheduled') , $branch->title() ],
		['pending' , trans('posts.manage.pending') , $branch->title().'.publish' , $db->counter($branch->slug , 'pending')],
		['drafts' , trans('posts.manage.drafts') , $branch->title().'.publish'],
		['my_posts' , trans('posts.manage.my_posts') , $branch->title().'.create'],
		['my_drafts' , trans('posts.manage.my_drafts') , $branch->title().'.create',$db->counter($branch->slug , 'my_drafts') , 'info'],
		['bin' , trans('posts.manage.bin') , $branch->title().'.bin'],
		['search' , trans('people.volunteers.manage.search') , $branch->title().'.search'],
	] ,
])
