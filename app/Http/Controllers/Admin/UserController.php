<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getUserList();
        $status = config('custom.user_status_text');

        return view('admin.user.index', compact('users', 'status'));
    }

    public function changeStatus(Request $request, $id)
    {
        $status = $request->input('status');
        $user = $this->userRepository->getUser($id);
        if (in_array($status, config('custom.user_status'))) {
            $user->status = $status;
            if ($user->save()) {
                return back()->with('success', __('Changed status successfully'));
            }
        }

        return back()->with('error', __('Change status failed'));
    }
}
