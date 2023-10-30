<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use App\Http\Services\User\UserService;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function create()
    {
        return view('admin.users.add', [
            'title' => 'Thêm tài khoản'
        ]);
    }
    public function store(UserRequest $request)
    {
        $this->userService->create($request);
        return redirect()->back();
    }
    public function index()
    {
        return view('admin.users.list', [
            'title' => 'Danh sách tài khoản',
            'users' => $this->userService->getAllUsers()
        ]);
    }
    public function destroy(Request $request)
    {
        $result = $this->userService->destroy($request);
        if ($result)
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công!'
            ]);
        return response()->json([
            'error' => true
        ]);
    }
    public function show($id)
    {
        return view('admin.users.edit', [
            'title' => 'Chỉnh sửa thông tin',
            'user' => $this->userService->getUserById($id)
        ]);
        // dd($request->all());
    }
    public function update(Request $request)
    {
        $this->userService->update($request);
        return redirect()->back();
    }
}
