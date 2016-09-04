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
		'volunteers' => ['send','search' , 'view' ,'edit','publish','report', 'permits','delete' , 'bin'],
		'settings' => ['*'],
		'stats' => ['*'],
		'faqs' => ['browse','search','create','edit','publish','cats','delete','bin'],
		'angels' => ['browse','search','create','edit','publish','delete','bin'],
		'donates' => ['browse','view','search','report'],
		'submits' => ['browse', 'view' , 'search' , 'report','cats','delete','bin'],
		'exams' => ['browse','search','create','edit','publish','report','cats','delete','bin'],
		'posts-static' => ['browse','view','create','edit','publish','report','delete','bin'],
		'posts-news' => ['browse','view','create','edit','publish','report','delete','bin'],
		'posts-celebs' => ['browse','view','create','edit','publish','report','delete','bin'],
		'posts-gallery' => ['browse','view','create','edit','publish','report','delete','bin'],
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
		'permits',
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
