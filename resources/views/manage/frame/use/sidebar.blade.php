{{--@include('manage.frame.widgets.sidebar-search' , [--}}
	{{--'url' => '#' ,--}}
	{{--'placeholder' => trans('manage.menu.search-all').'...'--}}
{{--])--}}
@include('manage.frame.widgets.sidebar-link' , [
	'module' => 'index' ,
	'icon' => 'dashboard' ,
])

@include('manage.frame.widgets.sidebar-link' , [
	'module' => 'posts' ,
	'icon' => 'file-text-o' ,
	'sub_menus' => ['posts-static' , 'posts-news']
])
@include('manage.frame.widgets.sidebar-link' , [
	'module' => 'galleries' ,
	'icon' => 'picture-o' ,
	'sub_menus' => ['posts-slideshows']
])

@include('manage.frame.widgets.sidebar-link' , [
	'module' => 'cards' ,
	'icon' => 'credit-card',
	'sub_menus' => ['.browse' , '.publish' , '.add' , '.bulk' , '.search' , '.report' ]
])

@include('manage.frame.widgets.sidebar-link' , [
	'module' => 'volunteers' ,
	'icon' => 'child',
	'sub_menus' => ['.browse' , '.add' , '.publish' , '.search' , '.bulk' , '.report' ]
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