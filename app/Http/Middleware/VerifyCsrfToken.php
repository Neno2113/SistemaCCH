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
      
        'http://localhost/sistemaCCH/public/user/edit/*',
        'http://localhost/sistemaCCH/public/composition',
        'http://localhost/sistemaCCH/public/composition/*',
        'http://localhost/sistemaCCH/public/supplier',
        'http://localhost/sistemaCCH/public/supplier/*',
        'http://localhost/sistemaCCH/public/client',
        'http://localhost/sistemaCCH/public/client/*',
        'http://localhost/sistemaCCH/public/client-branch',
        'http://localhost/sistemaCCH/public/client-branch/*',
        'http://localhost/sistemaCCH/public/cloth',
        'http://localhost/sistemaCCH/public/cloth/*',
        'http://localhost/sistemaCCH/public/rollos',
        'http://localhost/sistemaCCH/public/rollo/*',
        'http://localhost/sistemaCCH/public/product',
        'http://localhost/sistemaCCH/public/product/*',
        'http://localhost/sistemaCCH/public/sku',
        'http://localhost/sistemaCCH/public/asignar/*',
        'http://localhost/sistemaCCH/public/corte',
        'http://localhost/sistemaCCH/public/talla',
        'http://localhost/sistemaCCH/public/corte/*',
        'http://localhost/sistemaCCH/public/lavanderia',
        'http://localhost/sistemaCCH/public/lavanderia/*',
        'http://localhost/sistemaCCH/public/product_ref',
        'http://localhost/sistemaCCH/public/imprimir/conduce/*',
        'http://localhost/sistemaCCH/public/recepcion'
    ];
}
