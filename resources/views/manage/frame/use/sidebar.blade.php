{{--@include('manage.frame.widgets.sidebar-search' , [--}}
	{{--'url' => '#' ,--}}
	{{--'placeholder' => trans('manage.menu.search-all').'...'--}}
{{--])--}}

@include('manage.frame.widgets.sidebar-link' , [
	'icon' => 'dashboard' ,
	'caption' => trans('manage.modules.index') ,
	'link' => 'index' ,
])

@include('manage.frame.widgets.sidebar-link' , [
	'icon' => 'child' ,
	'caption' => trans('manage.modules.volunteers') ,
	'link' => 'volunteers' ,
	'permission' => 'volunteers' ,
])


@include('manage.frame.widgets.sidebar-link' , [
	'icon' => 'credit-card' ,
	'caption' => trans('manage.modules.cards') ,
	'link' => 'cards' ,
	'permission' => 'cards' ,
	'sub_menus' => [
		['cards/create' , trans('people.cards.manage.create') , 'plus-square-o' , 'cards.create'] ,
		['cards/browse/all' , trans('people.cards.manage.all') , 'bars' , 'cards.browse'],
		['cards/browse/incomplete' , trans('people.cards.manage.incomplete') , 'star-half' , 'cards.browse'],
		['cards/browse/under_print' , trans('people.cards.manage.under_print') , 'print' , 'cards.print'],
		['cards/browse/newsletter_member' , trans('people.cards.manage.newsletter_member') , 'newspaper-o' , 'cards.send'],
		['cards/search' , trans('forms.button.search') , 'search' , 'cards.search'],
	]
])

@foreach(Taha::sidebarPostsMenu() as $item)
	@include('manage.frame.widgets.sidebar-link' , $item)
@endforeach

@include('manage.frame.widgets.sidebar-link' , [
	'icon' => 'money',
	'caption' => trans('manage.modules.donates'),
	'link' => 'donates' ,
	'disabled' => true ,
])

@include('manage.frame.widgets.sidebar-link' , [
	'icon' => 'comment-o',
	'caption' => trans('manage.modules.submits') ,
	'link' => 'submits' ,
	'disabled' => true ,
])

@include('manage.frame.widgets.sidebar-link' , [
	'icon' => 'cogs',
	'caption' => trans('manage.modules.settings'),
	'link' => 'settings' ,
])
@include('manage.frame.widgets.sidebar-link' , [
	'icon' => 'user-secret',
	'caption' => trans('manage.modules.devSettings'),
	'link' => 'devSettings' ,
])
