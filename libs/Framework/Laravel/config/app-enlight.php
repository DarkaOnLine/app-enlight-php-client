<?php

return [
    /*
	|--------------------------------------------------------------------------
	| API Key
	|--------------------------------------------------------------------------
	|
	| You can find your API key on your application settings.
	|
	| This api key points the notifier to the project in your account
	| which should receive your application's uncaught exceptions.
	|
	*/
    'api_key' => env('APP_ENLIGHT_API_KEY', 'YOUR-API-KEY-HERE'),
    /*
    |--------------------------------------------------------------------------
    | Notify Release Stages
    |--------------------------------------------------------------------------
    |
    | Set which release stages should send notifications.
    |
    | Example: ['development', 'production']
    |
    */
    'notify_release_stages' => ['production'],
    /*
    |--------------------------------------------------------------------------
    | Use secure or not secure connection
    |--------------------------------------------------------------------------
    |
    */
    'scheme' => env('APP_ENLIGHT_SCHEME', 'https'),
    /*
    |--------------------------------------------------------------------------
    | API version
    |--------------------------------------------------------------------------
    |
    */
    'version' => env('APP_ENLIGHT_API_VERSION', '0.5'),
    /*
    |--------------------------------------------------------------------------
    | Server name
    |--------------------------------------------------------------------------
    |
    */
    'server_name' => env('APP_ENLIGHT_SERVER_NAME', 'production'),
];