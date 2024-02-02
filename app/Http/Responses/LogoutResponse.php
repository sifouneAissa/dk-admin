<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use function Ramsey\Collection\Map\get;

class LogoutResponse implements \Laravel\Fortify\Contracts\LogoutResponse
{

    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        $is_admin = adminRequest(url()->previous());

        $home = $is_admin ? config('fortify.login_admin') : config('fortify.login');

        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect($home);
    }

}
