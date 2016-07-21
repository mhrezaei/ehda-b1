<?php
// to be used for anything with regards of buddies; particularly `users` and `volunteers` tables
// fields are in the valuation file though.

return [
		"commands" => [
			"change_password" => 'تغییر رمز عبور',
			"activate" => 'فعال‌سازی',
			'soft_delete' => 'انتقال به زباله‌دان',
			"undelete" => 'بازیابی از زباله‌دان',
			'hard_delete' => 'حذف برای همیشه' ,
			'publish' => 'فعال‌سازی',
		],
		"form" => [
			"notify-with-email" => 'به کاربر از طریق ایمیل اطلاع‌رسانی شود.' ,
			"notify-with-sms" => 'به کاربر از طریق پیامک اطلاع‌رسانی شود.' ,
			"notify" => 'به کاربر از طریق پیامک و ایمیل اطلاع‌رسانی شود.' ,
			"will-be-notified" => 'به کاربر از طریق پیامک و ایمیل اطلاع‌رسانی می‌شود.' ,
			'hard_delete_notice' => 'پس از این حذف، امکان بازیابی از هیچ راهی وجود نخواهد داشت.' ,
			'create-time' => 'زمان ایجاد',
		],
		"volunteers" => [
				"status" => [
					'deleted' => 'حذف‌شده',
					'blocked' => 'مسدود',
					'active' => 'فعال',
					'pending' => 'منتظر تأیید',
					'examining' => 'پشت امتحان',
					'care' => 'نیازمند رسیدگی',
				],

				"manage" => [
						'create' => 'افزودن سفیر تازه' ,
						'edit' => 'ویرایش اطلاعات سفیر',

						'active' => 'سفیران فعال',
						'pending' => 'منتظر تأیید',
						'care' => 'نیازمند بررسی',
						'examining' => 'پشت آزمون',
						'bin' => 'زباله‌دان',
						'search' => 'جست‌وجوی پیشرفته',
						'domains' => 'دامنه‌های فعالیت',
				],

		],

		'mr' => 'آقای' ,
		'mrs'=> 'خانم' ,
]
?>