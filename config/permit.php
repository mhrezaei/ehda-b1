<?php
/*
|--------------------------------------------------------------------------
| Permissions Environment
|--------------------------------------------------------------------------
|
*/

return [

	'available_modules' => [
		'cards' => ['browse','view','send','search','create','bulk','edit','print','report','delete'],
		'volunteers' => ['send','search' , 'view' ,'edit','publish','report','delete' , 'bin'],
		'posts' => ['view','create','edit','publish','report','delete','bin'] ,

		'settings' => ['*'],
		'stats' => ['*'],
//		'donates' => ['browse','view','search','report'],
//		'submits' => ['browse', 'view' , 'search' , 'report','cats','delete','bin'],
	] ,

	'available_permits' => [
		'browse' , // np need for volunteers but vital for cards.
		'print' , // np need for volunteers but vital for cards.
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
