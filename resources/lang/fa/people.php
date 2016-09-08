<?php
return [

		'mr' => 'جناب آقای' ,
		'mrs' => 'سرکار خانم' ,
		'dr' => 'دکتر',
		'card' => 'کارت اهدا' ,
		'volunteer' => 'سفیر اهدای عضو' ,

		"event" => [
				'email_reset_password_title' => 'بازآوری رمز عبور',
				'sms_reset_content' => 'کد بازآوری رمز عبور: ',
				'volunteer_publish_notice_email' => 'فعال سازی حساب کاربری',
				'volunteer_publish_notice_sms' => 'حساب کاربری شما فعال گردید.',
				'volunteer_new_password_sms' => 'رمز عبور شما در سامانه عبارتست از: ',
		],

		"commands" => [
				"change_password" => 'تغییر رمز عبور',
				"activate" => 'فعال‌سازی',
				'soft_delete' => 'انتقال به زباله‌دان',
				"undelete" => 'بازیابی از زباله‌دان',
				'hard_delete' => 'حذف برای همیشه' ,
				'publish' => 'فعال‌سازی',
				'send_sms' => 'ارسال پیامک',
				'send_email' => 'ارسال ایمیل',
				'search' => 'جست‌وجوی اشخاص',
				'block' => 'مسدودسازی' ,
				'unblock' => 'رفع مسدودی' ,
				'view_card' => 'نمایش کارت' ,
				'view_info' => 'نمایش جزئیات' ,
				'print_status' => 'کارت چاپی',
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
						'examining' => 'پشت آزمون',
						'care' => 'نیازمند رسیدگی',
						'documentation' => 'تکمیل اطلاعات' ,
				],

				"manage" => [
						'create' => 'افزودن سفیر تازه' ,
						'edit' => 'ویرایش اطلاعات سفیر',

						'active' => 'سفیران فعال',
						'pending' => 'منتظر تأیید',
						'care' => 'نیازمند بررسی',
						'examining' => 'پشت آزمون',
						'bin' => 'مسدودشده‌ها',
						'search' => 'جست‌وجو',
						'advanced_search' => 'جست‌وجوی پیشرفته',
						'domains' => 'دامنه‌های فعالیت',
						'documentation' => 'تکمیل اطلاعات' ,
				],
		],

		"cards" => [
				"status" => [
						'deleted' => 'حذف‌شده',
						'blocked' => 'مسدود',
						'active' => 'فعال',
				],

				"manage" => [
						'create' => 'افزودن کارت تازه' ,
						'edit' => 'ویرایش کارت',

						'all' => 'همه‌ی کارت‌ها' ,
						'complete' => 'کارت‌های کامل' ,
						'active' => 'فعال' ,
						'incomplete' => 'نقص اطلاعات' ,
						'under_print' => 'در فرآیند چاپ' ,
						'newsletter_member' => 'عضو خبرنامه' ,

						'bin' => 'مسدودشده‌ها', //deprecated
						'search' => 'جست‌وجو',
						'advanced_search' => 'جست‌وجوی پیشرفته',
						'domain' => 'دامنه',
						'pvc_card' => 'کارت چاپی',
						'save_and_send_to_print' => 'ذخیره  و ارسال به صف چاپ فیزیکی کارت' ,
						'preset_password' => 'معکوس شماره‌ی ملی به عنوان رمز عبور لحاظ می‌شود و کاربر در اولین ورود مجبور به تعویض آن خواهد شد.' ,
						'newsletter_membership' => 'این شخص در خبرنامه‌ی ایمیلی سامانه‌ی اهدای عضو ثبت نام شود.'
				],

		],

		"familization" => [
				'0' => 'نامشخص',
				'1' => 'دوست‌ها و آشنایان',
				'2' => 'رسانه‌ها',
				'3' => 'سایت',
				'4' => 'راه‌های دیگر',
		],

		"marital" => [
				'0' => 'نامشخص',
				"1" => 'متأهل' ,
				"2" => 'بدون همسر' ,
				"3" => 'طلاق‌گرفته' ,
				"4" => 'همسر وفات‌یافته',
		],

		"education" => [
				'0' => 'نامشخص',
				'1' => 'پایین‌تر از دیپلم متوسطه',
				'2' => 'دیپلم متوسطه',
				'3' => 'کاردانی',
				'4' => 'کارشناسی',
				'5' => 'کارشناسی ارشد',
				'6' => 'دکترا و بالاتر',
		],
		"edu_level" => [ //short form of `education`
				'0' => ' نامشخص',
				'1' => 'زیر دیپلم',
				'2' => 'دیپلم',
				'3' => 'کاردانی',
				'4' => 'کارشناسی',
				'5' => 'ارشد',
				'6' => 'دکترا',
		],

		"organs" => [
			'heart' => 'قلب',
			'lung' => 'ریه',
			'liver' => 'کبد',
			'kidney' => 'کلیه',
			'pancreas' => 'پانکراس',
			'tissues' => 'نسوج',
			'all' => 'همه ی اعضا و نسوج قابل اهدا'
		],
		"gender" => [
			'1' => 'آقا' ,
			'2' => 'خانم' ,
			'3' => 'سایر' ,
		],

		"card_print_status" => [
			'0' => 'درخواست نشده!' ,
			'1' => 'ثبت درخواست' ,
			'2' => 'ارسال به چاپگر' ,
			'3' => 'ارسال به شخص' ,
			'9' => 'تحویل شد' ,
		] ,

		"card_print_status_color" => [
			'0' => 'grey' ,
			'1' => 'info' ,
			'2' => 'info' ,
			'3' => 'info' ,
			'9' => 'success' ,
		]
]
?>