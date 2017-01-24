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
				'current_password_incorrect' => 'رمز عبور فعلی را اشتباه وارد کرده‌اید.' ,
		],

		"commands" => [
				"change_password" => 'تغییر رمز عبور',
				"activate" => 'فعال‌سازی',
				'soft_delete' => 'انتقال به زباله‌دان',
				"undelete" => 'بازیابی از زباله‌دان',
				'hard_delete' => 'حذف برای همیشه' ,
				'login_as' => 'لاگین به جای ایشان' ,
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
				'bulk_sms_hint' => "شماره‌ها را با علامت کامای انگلیسی (,) از هم جدا نمایید.",
		],
		"volunteers" => [
				'short_title' => 'سفیران' ,

				"status" => [
						'deleted' => 'حذف‌شده',
						'blocked' => 'مسدود',
						'active' => 'فعال',
						'pending' => 'منتظر تأیید',
						'examining' => 'پشت آزمون',
						'care' => 'درخواست ویرایش',
						'documentation' => 'تکمیل اطلاعات' ,
				],

				"manage" => [
						'create' => 'افزودن سفیر تازه' ,
						'edit' => 'ویرایش اطلاعات سفیر',

						'active' => 'سفیران فعال',
						'pending' => 'منتظر تأیید',
						'care' => 'منتظر ویرایش',
						'care_review' => 'بررسی تغییرات' ,
						'care_save' => 'تأیید و ذخیره‌ی تغییرات' ,
						'care_reject' => 'رد تغییرات',
						'examining' => 'پشت آزمون',
						'bin' => 'مسدودشده‌ها',
						'search' => 'جست‌وجو',
						'advanced_search' => 'جست‌وجوی پیشرفته',
						'domains' => 'دامنه‌های فعالیت',
						'documentation' => 'تکمیل اطلاعات' ,

						'delete_notice_1' => 'حذف حساب، به منزله‌ی استعفا از حضور در جمع سفیران اهدای عضو است.' ,
						'delete_notice_2' => 'با حذف حساب سفیری اهدای عضو، داده‌های مربوط به کارت اهدای عضو شما در سیستم باقی خواهد ماند.' ,
						'delete_notice_3' => 'با حذف حساب سفیری اهدای عضو، تمام اطلاعات پرونده پاک خواهند شد، اما نام و مشخصات شناسنامه‌ای شما در سیستم به صورت غیرفعال باقی خواهد ماند.',
						'delete_notice_4' => 'پیوستن دوباره به جمع سفیران اهدای عضو، منوط به طی تمام مراحل عضویت و تأیید مدیران انجمن خواهد بود.',

						'level_admin' => 'سرپرستی دامنه (دستکاری تنظیمات و مدیریت سطح دسترسی دیگر سفیران)',
						'level_user' => 'سفیر معمولی',
						'exam' => 'آزمون صلاحیت' ,
						'no_exam' => 'آزمون را گذرانده یا بی‌نیاز از گذراندن آن است.' ,
				],
		],

		"cards" => [
				"short_title" => 'کارت‌ها' ,
				"short_title_y" => 'کارت‌های' ,
				'full_title' => 'کارت اهدای عضو' ,

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
					'stats' => "آمار ثبت نام",
						'incomplete' => 'نقص اطلاعات' ,
						'under_print' => 'در فرآیند چاپ' ,
						'print_request' => 'درخواست چاپ' ,
						'print_control' => 'صف بازنگری کارت' ,
						'newsletter_member' => 'عضو خبرنامه' ,

						'bin' => 'مسدودشده‌ها', //deprecated
						'search' => 'جست‌وجو',
						'advanced_search' => 'جست‌وجوی پیشرفته',
						'domain' => 'دامنه',
						'pvc_card' => 'کارت چاپی',
						'add_as_volunteer' => 'ارتقا به سفیر اهدای عضو' ,
						'save_and_send_to_print' => 'ذخیره  و ارسال به صف چاپ فیزیکی کارت' ,
						'send_to_print' => 'ارسال به صف چاپ فیزیکی کارت' ,
						'preset_password' => 'شماره‌ی تلفن همراه به عنوان رمز عبور لحاظ می‌شود و کاربر در اولین ورود مجبور به تعویض آن خواهد شد.' ,
						'password_set_to_mobile' => 'شماره‌ی تلفن همراه به عنوان رمز عبور در نظر گرفته شود.' ,
						'newsletter_membership' => 'این شخص در خبرنامه‌ی ایمیلی سامانه‌ی اهدای عضو ثبت نام شود.',
						'newsletter_membership2' => 'عضویت در خبرنامه‌ی ایمیلی سامانه‌ی اهدای عضو' ,

						'delete_notice_1' => 'پس از حذف کارت اهدای عضو، حساب کاربری شما به عنوان سفیر اهدای عضو، و اطلاعات موجود در پرونده، دست‌نخورده باقی می‌مانند.',
						'delete_notice_2' => 'پس از حذف، همیشه می‌توانید نسبت به ثبت نام مجدد اقدام نمایید، اما شماره‌ی عضویت تازه‌ای به شما اختصاص خواهد یافت.' ,
						'inquiry_success' => 'ادامه‌ی فرم را تکمیل کنید.' ,
						'inquiry_has_card' => 'کارت اهدای عضو برای این شماره‌ی ملی موجود است.' ,
						'inquiry_is_volunteer' => 'این شماره‌ی ملی، برای یکی از سفیران اهدای عضو ثبت شده است.' ,
						'print_already_requested' => 'این کارت هم‌اکنون نیز در صف چاپ است.' ,
						'inquiry_was_volunteer' => 'حساب این شخص مسدود شده است.' ,
						'inquiry_will_be_volunteer' => 'این کد ملی، متعلق به سفیر در انتظار تأیید است.' ,
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
			'2' => 'منتظر چاپگر' ,
			'3' => 'منتظر بازنگری نهایی',
			'4' => 'ارسال شد' ,
			'9' => 'تحویل شد' ,
		] ,

		"card_print_status_color" => [
			'0' => 'grey' ,
			'1' => 'warning' ,
			'2' => 'info' ,
			'3' => 'warning' ,
			'4' => 'info' ,
			'9' => 'success' ,
		]
]
?>