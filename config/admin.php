<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Default admin user
    |--------------------------------------------------------------------------
    |
    | Default user will be created at project installation/deployment
    |
    */

    'admin_email' => env('ADMIN_EMAIL', ''),
		'admin_password' =>env('ADMIN_PASSWORD', ''),
		'admin_email_verified' =>env('ADMIN_EMAIL_VERIFIED', '1'),
		'admin_type' =>env('ADMIN_TYPE', '0'),
    ];