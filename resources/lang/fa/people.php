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
				],

		],
		'mr' => 'آقای' ,
		'mrs'=> 'خانم' ,
]
?>