@include('manage.frame.use.tabs' , [
	'current' => $page[1][0] ,
	'tabs' => [
		['profile' , trans('manage.account.profile') ],
		['change_password' , trans('manage.account.change_password') ],
		['card' , trans('manage.account.card') ],
		['delete' , trans('manage.account.delete') ],
	] ,
])
