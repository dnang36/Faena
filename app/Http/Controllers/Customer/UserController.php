<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\User\UserService;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index()
    {
        return view('admin.customers.signup', [
            'title' => 'Đăng ký'
        ]);
    }
    public function store(Request $request)
    {
        $this->userService->create($request);
        return redirect()->back();
    }
    public function show(){
        return view('admin.customers.change-pass', [
            'title' => 'Đổi mật khẩu'
        ]);
    }
    //đổi mật khẩu
    public function update(Request $request){
        $this->userService->edit($request);
        return redirect()->back();
    }
    //lay mat khau
    public function index_forgot(){
        return view('admin.customers.forgot-pass',[
            'title' => 'Quên mật khẩu'
        ]);
    }
    public function store_forgot(Request $request){
        $result = $this->userService->recover($request);
        if($result)
            return redirect()->back();
        return redirect()->back();
    }
}
