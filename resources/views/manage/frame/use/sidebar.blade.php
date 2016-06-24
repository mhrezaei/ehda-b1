@include('manage.frame.widgets.sidebar-search' , [
	'url' => '#' ,
	'placeholder' => trans('manage.menu.search-all').'...'
])
@include('manage.frame.widgets.sidebar-link' , [
	'url' => 'manage/index' ,
	'icon' => 'dashboard' ,
	'caption' => trans('manage.menu.dashboard')
])
@include('manage.frame.widgets.sidebar-link' , [
	'url' => 'manage/posts' ,
	'icon' => 'file-text-o' ,
	'caption' => trans('manage.menu.posts')
])
@include('manage.frame.widgets.sidebar-link' , [
	'url' => 'manage/galleries' ,
	'icon' => 'picture-o' ,
	'caption' => trans('manage.menu.galleries')
])

@include('manage.frame.widgets.sidebar-link' , [
	'url' => '#' ,
	'icon' => 'credit-card',
	'caption' => trans('manage.menu.cards'),
	'sub_menus' => ['cards_browse' , 'cards_verify' , 'cards_new_one' , 'cards_new_bulk' , 'cards_print_bulk' , 'cards_search' , 'cards_report' , 'cards_meli' ]
])

@include('manage.frame.widgets.sidebar-link' , [
	'url' => '#' ,
	'icon' => 'child',
	'caption' => trans('manage.menu.volunteers'),
	'sub_menus' => ['volunteers_browse' , 'volunteers_new' , 'volunteers_verify' , 'volunteers_search' , 'cards_new_bulk' , 'volunteers_report' ]
])

@include('manage.frame.widgets.sidebar-link' , [
	'url' => 'celebs' ,
	'icon' => 'street-view',
	'caption' => trans('manage.menu.celebs'),
])
@include('manage.frame.widgets.sidebar-link' , [
	'url' => 'angels' ,
	'icon' => 'gratipay',
	'caption' => trans('manage.menu.angels'),
])
@include('manage.frame.widgets.sidebar-link' , [
	'url' => 'faqs' ,
	'icon' => 'info-circle',
	'caption' => trans('manage.menu.faqs'),
])
@include('manage.frame.widgets.sidebar-link' , [
	'url' => 'donates' ,
	'icon' => 'money',
	'caption' => trans('manage.menu.donates'),
])
@include('manage.frame.widgets.sidebar-link' , [
	'url' => 'submits' ,
	'icon' => 'comment-o',
	'caption' => trans('manage.menu.submits'),
])

@include('manage.frame.widgets.sidebar-link' , [
	'url' => '#' ,
	'icon' => 'cogs',
	'caption' => trans('manage.menu.settings'),
	'sub_menus' => ['settings_profile' , 'settings_socials' , 'settings_contacts' , 'settings_general']
])
@include('manage.frame.widgets.sidebar-link' , [
	'url' => '#' ,
	'icon' => 'user-secret',
	'caption' => trans('manage.menu.devSettings'),
	'sub_menus' => ['devSettings_domains' , 'devSettings_states' , 'devSettings_activities' , 'devSettings_roles' , 'devSettings_cats']
])

{{--@include('manage.frame.use._sidebar')--}}