<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

		'captcha'			=> 'کد امنیتی اشتباه است.',
		'invalid'			=> 'درخواست معتبر نیست',
		'phone'             => ':attribute درست وارد نشده است.',
		'code_melli'        => ":attribute درست وارد نشده است.",

		"accepted"         => ":attribute باید پذیرفته شده باشد.",
		"active_url"       => "نشانی :attribute معتبر نیست",
		"after"            => ":attribute باید تاریخی بعد از :date باشد.",
		"alpha"            => ":attribute باید شامل حروف الفبا باشد.",
		"alpha_dash"       => ":attribute باید شامل حروف الفبا و عدد و خظ تیره(-) باشد.",
		"alpha_num"        => ":attribute باید شامل حروف الفبا و عدد باشد.",
		"array"            => ":attribute باید شامل آرایه باشد.",
		"before"           => ":attribute باید تاریخی قبل از :date باشد.",
		"between"          => array(
				"numeric" => ":attribute باید بین :min و :max باشد.",
				"file"    => ":attribute باید بین :min و :max کیلوبایت باشد.",
				"string"  => ":attribute باید بین :min و :max کاراکتر باشد.",
				"array"   => ":attribute باید بین :min و :max آیتم باشد.",
		),
		"boolean"          => "The :attribute field must be true or false",
		"confirmed"        => ":attribute با تاییدیه مطابقت ندارد.",
		"date"             => ":attribute یک تاریخ معتبر نیست.",
		"date_format"      => ":attribute با الگوی :format مطاقبت ندارد.",
		"different"        => ":attribute و :other باید متفاوت باشند.",
		"digits"           => ":attribute باید :digits رقم باشد.",
		"digits_between"   => ":attribute باید بین :min و :max رقم باشد.",
		"email"            => "قالب :attribute معتبر نیست.",
		"exists"           => ":attribute واردشده، معتبر نیست.",
		"image"            => ":attribute باید تصویر باشد.",
		"in"               => ":attribute واردشده، معتبر نیست.",
		"integer"          => ":attribute باید نوع داده‌ای عددی (integer) باشد.",
		"ip"               => ":attribute باید آی‌پی نشانی معتبر باشد.",
		"max"              => [
				"numeric" => ":attribute نباید بزرگ‌تر از :max باشد.",
				"file"    => ":attribute نباید بزرگ‌تر از :max کیلوبایت باشد.",
				"string"  => ":attribute نباید بیشتر از :max کاراکتر باشد.",
				"array"   => ":attribute نباید بیشتر از :max آیتم باشد.",
		],
		"mimes"            => ":attribute باید یکی از قالب‌های :values باشد.",
		"min"              => array(
				"numeric" => ":attribute نباید کوچک‌تر از :max باشد.",
				"file"    => ":attribute نباید کوچک‌تر از :max کیلوبایت باشد.",
				"string"  => ":attribute نباید کمتر از :min کاراکتر باشد.",
				"array"   => ":attribute نباید کمتر از :max آیتم باشد.",
		),
		"not_in"           => ":attribute انتخاب شده، معتبر نیست.",
		"numeric"          => ":attribute باید شامل عدد باشد.",
		"regex"            => ":attribute یک قالب معتبر نیست",
		"required"         => "وارد کردن «:attribute» الزامی است.",
		"required_if"      => "وارد کردن  «:attribute» الزامی است.",
		"required_with"    => ":attribute الزامی است زمانی که :values موجود است.",
		"required_with_all"=> ":attribute الزامی است زمانی که :values موجود است.",
		"required_without" => ":attribute الزامی است زمانی که :values موجود نیست.",
		"required_without_all" => ":attribute الزامی است زمانی که :values موجود نیست.",
		"same"             => ":attribute و :other باید مانند هم باشند.",
		"size"             => array(
				"numeric" => ":attribute باید برابر با :size باشد.",
				"file"    => ":attribute باید برابر با :size کیلوبایت باشد.",
				"string"  => ":attribute باید برابر با :size کاراکتر باشد.",
				"array"   => ":attribute باسد شامل :size آیتم باشد.",
		),
		"timezone"         => "The :attribute must be a valid zone.",
		"unique"           => ":attribute تکراری است.",
		"url"              => "قالب نشانی :attribute اشتباه است.",
		"auth.fail"              => "شناسه‌ی کاربری یا رمز عبور اشتباه است.",
		"search"            => "جست‌وجو بی‌نتیجه بود.",

	'javascript_validation' => [
		"email"	=> "ایمیل را به درستی وارد نمائید.",
		"username" => "شناسه‌ی کاربری را به درستی وارد نمائید.",
		"security"	=> "کد امنیتی را با اعداد تکمیل نمائید.",
		"password"=> "رمز عبور را حداقل هشت کاراکتر وارد نمائید.",
		"password2"=> "تکرار رمز را به درستی وارد نمائید.",
		"birthday"=> "تاریخ تولد را به صورت صحیح وارد نمائید.",
		"name_first"=> "نام را با حروف فارسی وارد نمائید.",
		"name_last"=> "نام خانوادگی را با حروف فارسی وارد نمائید.",
		"code_melli" => "کد ملی ده رقمی را وارد نمائید.",
		"gender"=> "جنسیت را انتخاب نمائید.",
		"birth_date" => "تاریخ تولد را به درستی وارد نمائید.",
		"birth_city" => "محل تولد را با حروف فارسی وارد نمائید.",
		"marital_status" => "وضعیت تأهل را انتخاب نمائید.",
		"occupation" => "شغل و تحصیلات را انتخاب نمائید." ,
		"education" => "تحصیلات انتخاب نمائید." ,
		"edu_level" => "میزان تحصیلات را انتخاب نمائید.",
		"edu_field" => "رشته‌ی تحصیلی را با حروف فارسی وارد نمائید." ,
		'edu_city' => 'محل تحصیل را با حروف فارسی وارد نمائید.',
		"tel_mobile" => 'تلفن همراه ۱۱ رقمی خود را وارد نمائید.',
		"tel_emergency" => 'تلفن اضطراری ۱۱ رقمی خود را وارد نمائید.' ,
		"home_city" => "محل سکونت را انتخاب نمائید.",
		"home_address" => "نشانی منزل را با حروف فارسی وارد نمائید.",
		"home_tel" => "تلفن منزل ۱۱ رقمی خود را وارد نمائید." ,
		"work_city" => "محل کار خود را انتخاب نمائید.",
		"work_address" => "نشانی محل کار خود را با حروف فارسی وارد نمائید.",
		"work_tel" => "تلفن محل کار ۱۱ رقمی خود را وارد نمائید." ,
		"job" => "شغل را با حروف فارسی وارد نمائید",
		"familization" => "نحوه‌ی آشنایی را انتخاب نمائید." ,
		"motivation" => "انگیزه‌ی همکاری را با حروف فارسی وارد نمائید.",
		"alloc_time" => "فرصت همکاری وارد نمائید." ,
		'title' => 'عنوان را وارد نمائید.',
		'slug' => 'نامک را وارد نمائید.',
		'cities' => 'شهرها را انتخاب نمائید.',
		],


	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

		'custom' => [
				'attribute-name' => [
						'rule-name' => 'custom-message',
				],
		],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

		'attributes' => [
				"email"	=> "ایمیل",
				"username" => "شناسه‌ی کاربری",
				"security"	=> "کد امنیتی",
				"password"=> "رمز عبور",
				"password2"=> "تکرار رمز",
				"birthday"=> "تاریخ تولد",
				"name_first"=> "نام",
				"name_last"=> "نام خانوادگی",
				"code_melli" => "کد ملی",
				"gender"=> "جنسیت",
				"birth_date" => "تاریخ تولد",
				"birth_city" => "محل تولد",
				"marital_status" => "وضعیت تأهل",
				"occupation" => "شغل و تحصیلات" ,
				"education" => "تحصیلات" ,
				"edu_level" => "میزان تحصیلات",
				"edu_field" => "رشته‌ی تحصیلی" ,
				'edu_city' => 'محل تحصیل',
				"tel_mobile" => 'تلفن همراه',
				"tel_emergency" => 'تلفن اضطراری' ,
				"home_city" => "محل سکونت",
				"home_address" => "نشانی منزل",
				"home_tel" => "تلفن منزل" ,
				"work_city" => "محل کار",
				"work_address" => "نشانی محل کار",
				"work_tel" => "تلفن محل کار" ,
				"job" => "شغل",
				"familization" => "نحوه‌ی آشنایی" ,
				"motivation" => "انگیزه‌ی همکاری",
				"alloc_time" => "فرصت همکاری" ,
				'title' => 'عنوان',
				'slug' => 'نامک',
				'cities' => 'شهرها',

			"token" => "توکن",

				'content' => 'محتوا',
				'capital_id'=> 'مرکز استان',
				'province_id' => 'استان',
				'domain_id' => 'دامنه',
				'status' => 'وضعیت' ,
				'tel' => 'تلفن',
				'message' => 'متن پیام',
				'items'=>'گزیدگان',
				'keyword' => 'کلیدواژه',
		],

		"http" => [
				'Eror404' => 'این نشانی را نمی‌شناسیم',
				'Eror403' => 'با ما به از این باش که با خلق جهانی',
				'Eror410' => 'دنبال که می‌گردی؟ او رفته از اینجا',
		],

		"hint" => [
				'unique' => 'یکتا',
				'english-only' => 'فقط با کاراکترهای انگلیسی',
				'persian-only' => 'فقط با کاراکترهای فارسی',
		],

];
