<?php
/*
|--------------------------------------------------------------------------
| Permissions Environment
|--------------------------------------------------------------------------
|
*/

return [

	'available_modules' => [
		'cards' => ['browse','send','search','create','bulk','edit','publish','report','delete','bin'],
		'volunteers' => ['browse','send','search','create','edit','publish','report','delete' , 'bin'],
		'settings' => ['*'],
		'stats' => ['*'],
		'faqs' => ['browse','search','create','edit','publish','cats','delete','bin'],
		'angels' => ['browse','search','create','edit','publish','delete','bin'],
		'donates' => ['browse','search','report'],
		'submits' => ['browse', 'search' , 'report','cats','delete','bin'],
		'exams' => ['browse','search','create','edit','publish','report','cats','delete','bin'],
		'posts-static' => ['browse','search','create','edit','publish','report','delete','bin'],
		'posts-news' => ['browse','search','create','edit','publish','report','delete','bin'],
		'posts-celebs' => ['browse','search','create','edit','publish','report','delete','bin'],
		'posts-slideshows' => ['browse','search','create','edit','publish','report','delete','bin'],
	] ,

	'available_permits' => [
		'browse',
		'send',
		'search',
		'create',
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
