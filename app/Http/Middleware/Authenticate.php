<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as BaseAuthenticate;
use Illuminate\Http\JsonResponse;

class Authenticate extends BaseAuthenticate
{
    /**
     * Handle an unauthenticated user.
     *
     * @param $request
     * @param array $guards
     * @return JsonResponse|void
     * @throws AuthenticationException
     */
    protected function unauthenticated($request, array $guards)
    {
        throw new AuthenticationException(
            'Unauthenticated',
        );
    }
}
