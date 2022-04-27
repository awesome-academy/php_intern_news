<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function info()
    {
        $user = Auth::user();

        return view('user.info', compact('user'));
    }

    public function changeInfo(Request $request)
    {
    }

    public function changePassword(Request $request)
    {
    }
}
