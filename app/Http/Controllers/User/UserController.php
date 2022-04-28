<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function changePassword(PasswordRequest $request)
    {
        $pass = $request->input('new_password');

        $user = Auth::user();
        $user->update(['password' => $pass]);

        return back()->with('success', __('Changed password successfully'));
    }
}
