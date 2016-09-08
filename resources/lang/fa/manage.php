<?php

return [

	// Authentication...
		"login" => [
				'page_title' => 'ورود به سامانه' ,
				'head_title' => 'ورود به سامانه' ,
				'error_username' => 'شناسه کاربری یا رمز عبور اشتباه است.' ,
				'error_password' => 'شناسه کاربری یا رمز عبور اشتباه است.' ,
				'error_deleted'	 => 'دست‌رسی به این حساب امکان‌پذیر نیست.',
				'error_not_published' => 'دست‌رسی به این حساب، فعلاً امکان‌پذیر نیست.',
				'reset_password_link' => 'رمز عبورم را فراموش کردم!',
		],

		"old_password" => [
				'page_title' => 'به روز رسانی رمز عبور',
				'head_title' => 'تغییر رمز عبور',
				'error_password' => 'رمز عبور جدید نمی تواند با رمز عبور قدیمی برابر باشد.',
				'change_password_msg' => 'رمز عبور فعلی شما منقضی شده است، لطفا با استفاده از فرم زیر رمز عبور جدیدی انتخاب نمائید، این رمز می‌بایست حداقل ۸ کاراکتر باشد.',
				'error_new_password_equal_old_password' => 'رمز عبور جدید نمی تواند با رمز عبور قبلی برابر باشد.',
		],

		"reset_password" => [
				'page_title' => 'بازیابی رمز عبور',
				'head_title' => 'بازیابی رمز عبور',
				'error_username' => 'شناسه کاربری اشتباه است.',
				'reset_token_success_send' => 'یک کد ۶ رقمی جهت بازآوری رمز عبور از طریق ایمیل و پیامک برای شما ارسال گردید.',
				'reset_token_expire_time' => 'مدت زمان استفاده از این کد منقضی شده است، جهت بازآوری رمز عبور دوباره درخواست دهید.',
				'reset_token_invalid' => 'کد وارد شده صحیح نمی باشد.',
				'invalid_request' => 'درخواست شما یافت نشد.',
				'token_success_request' => 'درخواست با موفقیت انجام شد. لطفاْ منتظر بمانید...',
		],

		"global" => [
				'page_title' => 'انجمن اهدای عضو ایرانیان',
				'grid_count' => 'در حال نمایش :rows سطر از مجموع :total سطر موجود اطلاعات'  ,
		],

		"permits" => [
				'*' => 'کنترل کامل',
				'view' => 'نمایش' ,
				'browse' => 'پیمایش' ,
				'send' => 'ارسال ایمیل/پیامک',
				'search' => 'جست‌وجو' ,
				'create' => 'افزودن' ,
				'bulk' => 'کارهای دسته‌جمعی' ,
				'edit' => 'ویرایش' ,
				'publish' => 'انتشار' ,
				'report' => 'گزارش‌گیری' ,
				'cats' => 'دسته‌بندی‌ها' ,
				'permits' => 'مجوزهای دسترسی',
				'delete' => 'پاک کردن' ,
				'bin' => 'زباله‌دان' ,
				'print' => 'چاپ' ,
		],

		"modules" => [
				'logout' => 'خروج',
				'profile'	=> 'حساب کاربری',
				'dashboard'	=> 'پیشخوان',
				'index'	=> 'پیشخوان',
				'profile' => 'پروفایل',
				'search-all' => 'جست‌وجوی همه چیز',

				'cards' => 'کارت‌های اهدای عضو',
				'volunteers' => 'سفیران اهدای عضو',
				'faqs' => 'پرسش‌های متداول',
				'angels' => 'فرشتگان ماندگار',
				'donates' => 'کمک‌های مالی',
				'submits' => 'یادمان',

				'stats' => 'آمار سایت',
				'exams' => 'آزمون‌های صلاحیت',

				'settings'=> 'تنظیمات',

			//exceptions...
				'devSettings' => 'تنظیمات بالادستی',
				'posts' => 'مطالب و نوشته‌ها' ,
				'galleries' => 'آلبوم‌ها' ,

		] ,

		"settings" => [
				"socials" => [
						'tab-title' => 'شبکه‌های اجتماعی',
				]
		],

		"devSettings" => [
				"branches" => [
						'trans' => 'شاخه‌ها',
						'have_rss' => 'آراس‌اس؟' ,
						'have_comments' => 'دیدگاه؟' ,
						'is_gallery' => 'آلبوم؟' ,
						'is_hidden' => 'محرمانه؟' ,
						'content_pics' => 'آلبوم' ,
						'content_text' => 'متن' ,
						"add" => [
								'trans' => 'افزودن شاخه تازه',
								'have_rss' => 'قابلیت ایجاد خودکار فایل‌های آراس‌اس',
								'have_comments' => 'قابلیت دریافت پیام‌های کاربران',
								'is_gallery' => 'نمایش به صورت آلبوم عکس',
								'is_hidden' => 'فقط برای استفاده‌های خاص برنامه‌نویسان',
						],
						"edit" => [
								'trans' => 'ویرایش شاخه',
						],
				],
				"posts-cats" => [
						'trans' =>' دسته‌بندی مطالب' ,
						"add" => [
								'trans' => 'افزودن دسته‌بندی تازه',
						],
						"edit" => [
								'trans' => 'ویرایش دسته‌بندی',
						],
				] ,
				"domains" => [
						'trans' => 'دامنه‌ها',
						'domain' => 'دامنه',
						'cities' => 'شهرها',
						'cities-of' => 'شهرهای',
						'city' => 'شهر',
						'admin' => 'سرپرست',
						'add' => 'افزودن دامنه‌ی تازه',
						'edit' => 'ویرایش اطلاعات دامنه',
				],
				"states" => [
						'trans' => 'استان‌ها و شهرها',
						'province-title' => 'نام استان',
						'capital' => 'مرکز استان',
						'province' => 'استان :province',
						'province-add' => 'افزودن استان تازه',
						'province-edit' => 'ویرایش اطلاعات استان',
						'city-add' => 'افزودن شهر تازه',
						'city-edit' => 'ویرایش اطلاعات شهر',
						'city-search' => 'جست‌وجوی شهر',
				],

		],


];

?>