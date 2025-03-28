<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/home'; // dùng để chuyển đến trang home sau khi đăng nhập

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
