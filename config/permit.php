<?php
/*
|--------------------------------------------------------------------------
| Permissions Environment
|--------------------------------------------------------------------------
|
*/

return [

	'available_modules' => [
		'cards' => ['browse','search','add','bulk','edit','publish','report','delete','bin'],
		'volunteers' => ['browse','search','add','edit','publish','report','delete' , 'bin'],
		'settings' => ['*'],
		'stats' => ['*'],
		'faqs' => ['browse','search','add','edit','publish','cats','delete','bin'],
		'angels' => ['browse','search','add','edit','publish','delete','bin'],
		'donates' => ['browse','search','report'],
		'submits' => ['browse', 'search' , 'report','cats','delete','bin'],
		'exams' => ['browse','search','add','edit','publish','report','cats','delete','bin'],
		'posts-static' => ['browse','search','add','edit','publish','report','delete','bin'],
		'posts-news' => ['browse','search','add','edit','publish','report','delete','bin'],
		'posts-celebs' => ['browse','search','add','edit','publish','report','delete','bin'],
		'posts-slideshows' => ['browse','search','add','edit','publish','report','delete','bin'],
	] ,

	'available_permits' => [
		'browse',
		'search',
		'add',
		'bulk',
		'edit',
		'publish',
		'report',
		'cats',
		'delete',
		'bin',
	] ,

	'public_modules' => [
		'index' ,
		'profile' ,
		'logout' ,
	],

	'wildcards' => [
		'' ,
		'any' ,
		'*' ,
	]
];
