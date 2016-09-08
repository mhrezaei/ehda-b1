{{--@include('manage.frame.widgets.sidebar-search' , [--}}
	{{--'url' => '#' ,--}}
	{{--'placeholder' => trans('manage.menu.search-all').'...'--}}
{{--])--}}
@include('manage.frame.widgets.sidebar-link' , [
	'module' => 'index' ,
	'icon' => 'dashboard' ,
])

@include('manage.frame.widgets.sidebar-link' , [
	'module' => 'cards' ,
	'icon' => 'credit-card',
	'sub_menus' => [
		['create' , 'create' , trans('people.cards.manage.create')],
		['browse/all' , 'browse' , trans('people.cards.manage.all')],
//		['browse/complete' , 'browse' , trans('people.cards.manage.complete')],
		['browse/incomplete' , 'browse' , trans('people.cards.manage.incomplete')],
		['browse/under_print' , 'print' , trans('people.cards.manage.under_print')],
		['browse/newsletter_member' , 'send' , trans('people.cards.manage.newsletter_member')],
		['search' , 'search' , trans('manage.permits.search')],
	]
])


@include('manage.frame.widgets.sidebar-link' , [
	'module' => 'volunteers' ,
	'icon' => 'child',
	'sub_menus_' => [
		['search' , 'search' , trans('manage.permits.search')],
		['browse/active' , '' , trans('people.volunteers.manage.active')],
		['browse/pending' , 'publish' , trans('people.volunteers.manage.pending')],
		['browse/care' , 'edit' , trans('people.volunteers.manage.care')],
		['browse/examining' , 'publish' , trans('people.volunteers.manage.examining')],
		['browse/bin' , 'publish' , trans('people.volunteers.manage.bin')],
		['report' , 'report' , trans('manage.permits.report')],
	],
])


@include('manage.frame.widgets.sidebar-link' , [
	'module' => 'posts-news' ,
	'icon' => 'file-text-o' ,
])
@include('manage.frame.widgets.sidebar-link' , [
	'module' => 'posts-gallery' ,
	'icon' => 'picture-o' ,
])




@include('manage.frame.widgets.sidebar-link' , [
	'module' => 'posts-celebs' ,
	'icon' => 'street-view',
])
@include('manage.frame.widgets.sidebar-link' , [
	'module' => 'angels' ,
	'icon' => 'gratipay',
])
@include('manage.frame.widgets.sidebar-link' , [
	'module' => 'faqs' ,
	'icon' => 'info-circle',
])
@include('manage.frame.widgets.sidebar-link' , [
	'module' => 'donates' ,
	'icon' => 'money',
])
@include('manage.frame.widgets.sidebar-link' , [
	'module' => 'submits' ,
	'icon' => 'comment-o',
])

@include('manage.frame.widgets.sidebar-link' , [
	'module' => 'settings' ,
	'icon' => 'cogs',
//	'sub_menus' => ['settings_profile' , 'settings_socials' , 'settings_contacts' , 'settings_general']
])
@include('manage.frame.widgets.sidebar-link' , [
	'module' => 'devSettings' ,
	'icon' => 'user-secret',
//	'sub_menus' => ['devSettings_domains' , 'devSettings_states' , 'devSettings_activities' , 'devSettings_roles' , 'devSettings_cats']
])

{{--@include('manage.frame.use._sidebar')--}}