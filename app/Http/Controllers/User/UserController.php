<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeInfoRequest;
use App\Http\Requests\PasswordRequest;
use App\Repositories\User\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function info()
    {
        $user = Auth::user();

        return view('user.info', compact('user'));
    }

    public function changeInfo(ChangeInfoRequest $request)
    {
        $user = Auth::user();
        $options = $request->only('name');
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('/images/articles/', 'public');
            if ($path) {
                $options['avatar'] = $path;
            }

            if (Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
        }

        if ($user->update($options)) {
            return back()->with('success', __('Updated successfully'));
        }

        return back()->with('error', __('Update failed'));
    }

    public function changePassword(PasswordRequest $request)
    {
        $pass = $request->input('new_password');

        $user = Auth::user();
        $user->update(['password' => $pass]);

        return back()->with('success', __('Changed password successfully'));
    }

    public function markReadNotification($id)
    {
        try {
            Auth::user()->Notifications->find($id)->markAsRead();
        } catch (Exception $ex) {
            return response()->json(['message' => $ex], 500);
        }

        return response()->json(['message' => 'success'], 200);
    }

    public function markReadAllNotification()
    {
        try {
            Auth::user()->Notifications->markAsRead();
        } catch (Exception $ex) {
            return response()->json(['message' => $ex], 500);
        }

        return response()->json(['message' => 'success'], 200);
    }
}
