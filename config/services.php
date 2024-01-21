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

    'google' => [
        'client_id' => '809802782669-1vilrbbd1bjap4up96ntqgvl943i3ktl.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://127.0.0.1:8000/api/auth/google/callback',
    ],
    'github' => [
        'client_id' => '062482d4abdb3e8ecebe',
        'client_secret' => '7ce83c51a85fc36e905d301d1702c028311ce113',
        'redirect' => 'http://127.0.0.1:8000/api/auth/github/callback',
    ],
    'dribbble' => [
        'client_id' => '1ed5e139ac77aff8086bd785074d10a5cc8c4e885a970507970b2d74cafe781b',
        'client_secret' => 'b0bf0d98ea054322f79d757d2faa479e7d816ba1c62bf3c4bf1afd0d2011ea74',
        'redirect' =>'http://127.0.0.1:8000/api/auth/dribbble/callback',
    ],
    'facebook' => [
        'client_id' => '243005525410194',
        'client_secret' => '96b734b526dfb4e55b865ab3adbe4a8a',
        'redirect' =>'http://127.0.0.1:8000/api/auth/facebook/callback',
    ],
];
