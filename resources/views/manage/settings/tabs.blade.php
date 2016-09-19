@include('manage.frame.use.tabs' , [
	'current' => $page[1][0] ,
	'tabs' => [
		['socials' , trans('manage.devSettings.socials.trans')],
		['contact' , trans('manage.devSettings.contact.trans')],
		['activities' , trans('manage.devSettings.activities.trans')],
	] ,
])
