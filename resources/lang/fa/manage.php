<?php

return [

	// Authentication...
		"login" => [
				'page_title' => 'ورود به سامانه' ,
				'head_title' => 'ورود به سامانه' ,
				'error_username' => 'شناسه کاربری یا رمز عبور اشتباه است.' ,
				'error_password' => 'شناسه کاربری یا رمز عبور اشتباه است..' ,
				'error_deleted'	 => 'دست‌رسی به این حساب امکان‌پذیر نیست.',
				'error_not_published' => 'دست‌رسی به این حساب، فعلاً امکان‌پذیر نیست.',
		],

		"global" => [
				'page_title' => 'سفیران زندگی',
		],

		"permits" => [
				'browse' => 'پیمایش' ,
				'search' => 'جست‌وجو' ,
				'create' => 'افزودن' ,
				'bulk' => 'کارهای دسته‌جمعی' ,
				'edit' => 'ویرایش' ,
				'publish' => 'انتشار' ,
				'report' => 'گزارش‌گیری' ,
				'cats' => 'دسته‌بندی‌ها' ,
				'delete' => 'پاک کردن' ,
				'bin' => 'زباله‌دان' ,
		],

		"modules" => [
				'logout' => 'خروج',
				'profile'	=> 'حساب کاربری',
				'dashboard'	=> 'پیشخوان',
				'index'	=> 'پیشخوان',
				'profile' => 'پروفایل',
				'search-all' => 'جست‌وجوی همه چیز',

				'cards' => 'کارت‌های اهدای عضو',
				'volunteers' => 'سفیران زندگی',
				'faqs' => 'پرسش‌های متداول',
				'angels' => 'فرشتگان ماندگار',
				'donates' => 'کمک‌های مالی',
				'submits' => 'یادمان',

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
				"posts-cats" => [
						'trans' =>' دسته‌بندی مطالب' ,
						'have_rss' => 'آراس‌اس؟' ,
						'have_comments' => 'دیدگاه؟' ,
						'is_gallery' => 'آلبوم؟' ,
						'is_hidden' => 'محرمانه؟' ,
						'content_pics' => 'آلبوم' ,
						'content_text' => 'متن' ,
						"add" => [
								'trans' => 'افزودن دسته‌بندی تازه',
								'have_rss' => 'قابلیت ایجاد خودکار فایل‌های آراس‌اس',
								'have_comments' => 'قابلیت دریافت پیام‌های کاربران',
								'is_gallery' => 'نمایش به صورت آلبوم عکس',
								'is_hidden' => 'فقط برای استفاده‌های خاص برنامه‌نویسان',
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