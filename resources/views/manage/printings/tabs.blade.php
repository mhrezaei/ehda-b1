@include('manage.frame.use.tabs' , [
	'current' => $page[1][0] ,
	'fake' => !isset($volunteer_id)? $volunteer_id = 0 : 1,
	'fake' => $switches = [
		'event_id' => $event_id,
		'user_id' => $user_id,
		'volunteer_id' => $volunteer_id,
	],
	'tabs' => [
//		["printings/under_any_action/$event_id/$user_id/$volunteer_id" , trans('people.printing_status.under_any_action') , null , $db::counter($switches , 'under_any_action' , 'info')  ],
		["printings/pending/$event_id/$user_id/$volunteer_id" , trans('people.printing_status.pending') , null , $db::counter($switches , 'pending' , 'info')  ],
		["printings/under_print/$event_id/$user_id/$volunteer_id" , trans('people.printing_status.under_print') , null , $db::counter($switches , 'under_print' , 'info')  ],
		["printings/under_verification/$event_id/$user_id/$volunteer_id" , trans('people.printing_status.under_verification') , null , $db::counter($switches , 'under_verification' , 'info')  ],
//		["printings/under_dispatch/$event_id/$user_id/$volunteer_id" , trans('people.printing_status.under_dispatch') , null , $db::counter($switches , 'under_dispatch' , 'info')  ],
//		["printings/under_delivery/$event_id/$user_id/$volunteer_id" , trans('people.printing_status.under_delivery') , null , $db::counter($switches , 'under_delivery' , 'info')  ],
//		["printings/archive/$event_id/$user_id/$volunteer_id" , trans('people.printing_status.archive') , null , $db::counter($switches , 'archive' , 'info')  ],
//		["printings/bin/$event_id/$user_id/$volunteer_id" , trans('people.printing_status.bin') , null , $db::counter($switches , 'bin' , 'info')  ],
	] ,
])
