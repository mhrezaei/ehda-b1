@include('manage.frame.use.tabs' , [
	'current' => $page[0][2] ,
	'tabs' => [
		['published' , trans('posts.manage.published') , 'posts-'.$branch->slug],
		['scheduled' , trans('posts.manage.scheduled') , 'posts-'.$branch->slug ],
		['pending' , trans('posts.manage.pending') , 'posts-'.$branch->slug.'.publish' , $db->counter($branch->slug , Auth::user()->allowedDomains() , 'pending')],
		['drafts' , trans('posts.manage.drafts') , 'posts-'.$branch->slug.'.publish'],
		['my_posts' , trans('posts.manage.my_posts') , 'posts-'.$branch->slug.'.create'],
		['my_drafts' , trans('posts.manage.my_drafts') , 'posts-'.$branch->slug.'.create',$db->counter($branch->slug , Auth::user()->allowedDomains() , 'my_drafts') , 'info'],
		['bin' , trans('posts.manage.bin') , 'posts-'.$branch->slug.'.bin'],
		['search' , trans('people.volunteers.manage.search') , 'posts-'.$branch->slug],
	] ,
])
