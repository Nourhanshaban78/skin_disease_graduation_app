<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'firbase'=>[

            'api_key'=> "AIzaSyCyBqT-pyy6FCgQkcdC5in6x5zgMebpnf0",
            'auth_domain'=> "fir-dd458.firebaseapp.com",
            'database_url'=>'https://fir-dd458-default-rtdb.firebaseio.com/',
            'project_id'=>"fir-dd458",
            'storage_bucket'=> "fir-dd458.appspot.com",
            'messaging_sender_id'=> "450371844594",
            'app_id'=> "1:450371844594:web:bc08fcf3bdf13d2082936b",
            'measurement_id'=> "G-61E1LHXYSF"
    

    ],

];
