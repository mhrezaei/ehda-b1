@include('manage.frame.widgets.sidebar-search' , [
	'url' => '#' ,
	'placeholder' => trans('manage.menu.search-all').'...'
])
@include('manage.frame.widgets.sidebar-link' , [
	'url' => 'index' ,
	'icon' => 'dashboard' ,
])
@include('manage.frame.widgets.sidebar-link' , [
	'url' => 'posts' ,
	'icon' => 'file-text-o' ,
])
@include('manage.frame.widgets.sidebar-link' , [
	'url' => 'galleries' ,
	'icon' => 'picture-o' ,
])

@include('manage.frame.widgets.sidebar-link' , [
	'url' => 'cards' ,
	'icon' => 'credit-card',
	'sub_menus' => ['cards_browse' , 'cards_verify' , 'cards_new_one' , 'cards_new_bulk' , 'cards_print_bulk' , 'cards_search' , 'cards_report' , 'cards_meli' ]
])

@include('manage.frame.widgets.sidebar-link' , [
	'url' => 'volunteers' ,
	'icon' => 'child',
	'sub_menus' => ['volunteers_browse' , 'volunteers_new' , 'volunteers_verify' , 'volunteers_search' , 'cards_new_bulk' , 'volunteers_report' ]
])

@include('manage.frame.widgets.sidebar-link' , [
	'url' => 'celebs' ,
	'icon' => 'street-view',
])
@include('manage.frame.widgets.sidebar-link' , [
	'url' => 'angels' ,
	'icon' => 'gratipay',
])
@include('manage.frame.widgets.sidebar-link' , [
	'url' => 'faqs' ,
	'icon' => 'info-circle',
])
@include('manage.frame.widgets.sidebar-link' , [
	'url' => 'donates' ,
	'icon' => 'money',
])
@include('manage.frame.widgets.sidebar-link' , [
	'url' => 'submits' ,
	'icon' => 'comment-o',
])

@include('manage.frame.widgets.sidebar-link' , [
	'url' => 'settings' ,
	'icon' => 'cogs',
	'sub_menus' => ['settings_profile' , 'settings_socials' , 'settings_contacts' , 'settings_general']
])
@include('manage.frame.widgets.sidebar-link' , [
	'url' => 'devSettings' ,
	'icon' => 'user-secret',
	'sub_menus' => ['devSettings_domains' , 'devSettings_states' , 'devSettings_activities' , 'devSettings_roles' , 'devSettings_cats']
])

{{--@include('manage.frame.use._sidebar')--}}