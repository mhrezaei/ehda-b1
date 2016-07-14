<?php
/*
|--------------------------------------------------------------------------
| Permissions Environment
|--------------------------------------------------------------------------
|
*/

return [

	'available_modules' => [
		'cards' => ['browse','view','send','search','create','bulk','edit','publish','report','delete','bin'],
		'volunteers' => ['send','search' , 'view' ,'edit','publish','report','delete' , 'bin'],
		'settings' => ['*'],
		'stats' => ['*'],
		'faqs' => ['browse','search','create','edit','publish','cats','delete','bin'],
		'angels' => ['browse','search','create','edit','publish','delete','bin'],
		'donates' => ['browse','view','search','report'],
		'submits' => ['browse', 'view' , 'search' , 'report','cats','delete','bin'],
		'exams' => ['browse','search','create','edit','publish','report','cats','delete','bin'],
		'posts-static' => ['browse','view','search','create','edit','publish','report','delete','bin'],
		'posts-news' => ['browse','view','search','create','edit','publish','report','delete','bin'],
		'posts-celebs' => ['browse','view','search','create','edit','publish','report','delete','bin'],
		'posts-slideshows' => ['browse','view','search','create','edit','publish','report','delete','bin'],
	] ,

	'available_permits' => [
		'browse' , // np need for volunteers but vital for cards.
		'view',
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
