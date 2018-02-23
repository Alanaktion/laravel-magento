<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Magento API base URL
    |--------------------------------------------------------------------------
    |
    | This URL will be used as the base for all API calls, and is generally
    | the main page of your Magento site.
    |
    */

    'base_url' => env('MAGENTO_BASE_URL'),

    /*
    |--------------------------------------------------------------------------
    | Magento API integration token
    |--------------------------------------------------------------------------
    |
    | Here you should specify an Access Token from an Integration on your
    | Magento site. It can have any access level required for your application.
    |
    */

    'integration_token' => env('MAGENTO_TOKEN'),

];
