<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Session as FacadesSession;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Services\User\UserService;
use Toastr;

class LoginController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }
    public function index()
    {
        return view('admin.customers.login',
        ['title' => 'Đăng nhập hệ thống']);
    }
    public function store(LoginRequest $request)
    {
        if (Auth::attempt([
            'name' => $request->input('name'),
            'password' => $request->input('password')
        ])) {
            Session::forget('carts');
            Session::put('user', $request->input('name'));
            $user = $this->userService->getUserByName($request->input('name'));
            if ($user->roles == 1)
                return redirect()->route('admin');
            elseif ($user->roles == 2) return redirect()->route('admin');
            return redirect()->route('home');
        };
        Toastr::error('Tài khoản hoặc mật khẩu không chính xác!', 'Lỗi!');
        return redirect()->back();
    }
    public function logout()
    {
        $user = Session::get('user');
        if (!is_null($user))
            Session::forget('user');
        return redirect()->route('login');
    }
}
