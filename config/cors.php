<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Cross-Origin Resource Sharing (CORS) Configuration
	|--------------------------------------------------------------------------
	|
	| Here you may configure your settings for cross-origin resource sharing
	| or "CORS". This determines what cross-origin operations may execute
	| in web browsers. You are free to adjust these settings as needed.
	|
	| To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
	|
	*/

	'paths' => ['api/*'],

	// 'allowed_methods' => ['*'],
	'allowed_methods' => [
		'GET',
		'POST',
		'PUT',
		'PATCH',
		'DELETE',
		'OPTIONS',
	],

	'allowed_origins' => ['*'],
	// 'allowed_origins' => [
	// 	$_SERVER['HTTP_HOST']
	// ],

	'allowed_origins_patterns' => [],

	// 'allowed_headers' => ['*'],
	'allowed_headers' => [
		'X-Requested-With',
		'Content-Type',
		'Accept',
		'Origin',
		'Authorization'
	],

	'exposed_headers' => [
		'Cache-Control',
		'Content-Language',
		'Content-Type',
		'Expires',
		'Last-Modified',
		'Pragma',
	],

	/*
	* Preflight request will respond with value for the max age header.
	*/
	'max_age' => 60 * 60 * 24,
	// 'max_age' => 0,

	'supports_credentials' => false,
];