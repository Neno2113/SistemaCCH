<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'http://localhost/sistemaCCH/public/user',
        'http://localhost/sistemaCCH/public/user/*',
        'http://localhost/sistemaCCH/public/user/edit/*',
        'http://localhost/sistemaCCH/public/composition',
        'http://localhost/sistemaCCH/public/composition/*',
        'http://localhost/sistemaCCH/public/supplier',
        'http://localhost/sistemaCCH/public/supplier/*',
    ];
}
