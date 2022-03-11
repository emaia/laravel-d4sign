<?php

return [
    'environment' => env('D4SIGN_ENV'),
    'production_url' => 'https://secure.d4sign.com.br/api/v1/',
    'sandbox_url' => 'https://sandbox.d4sign.com.br/api/v1/',
    'token_api' => env('D4SIGN_TOKEN_API', ''),
    'crypt_key' => env('D4SIGN_CRYPT_KEY', '')
];
