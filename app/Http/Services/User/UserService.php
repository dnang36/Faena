<?php

namespace App\Http\Services\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Jobs\RecoverPassword;
use Exception;
use Toastr;

class UserService
{
    public function create($request)
    {
        try {
            if ($this->checkExistsName($request->input('name'))) {
                Toastr::error('Tài khoản đã có người đăng ký!', 'Lỗi');
                return false;
            } elseif ($this->checkExistsEmail($request->input('email'))) {
                Toastr::error('Email này đã được sử dụng!', 'Lỗi');
                return false;
            } elseif ($request->input('password') != $request->input('repassword')) {
                Toastr::error('Mật khẩu nhập lại không trùng khớp!', 'Lỗi');
                return false;
            } else {
                $data = $request->except('repassword', '_token');
                $data['password'] = Hash::make($request->password);
                if(!isset($data['roles'])) $data['roles'] = 0;
                else $data['roles']=1;

                // dd($data);
                User::create($data);
                Toastr::success('Đăng ký thành công!', 'Thành công');
            }
        } catch (Exception $e) {
            Toastr::error('Đăng ký không thành công!', 'Lỗi');
            return false;
        }
        return true;
    }
    public function checkExistsName($name)
    {
        $user = User::where('name', $name)->first();
        if ($user)
            return true;
        return false;
    }
    public function checkExistsEmail($email)
    {
        $user = User::where('email', $email)->first();
        if ($user)
            return true;
        return false;
    }
    public function getUserIdByName($user_name)
    {
        $user = User::select('id')->where('name', $user_name)->first();
        return $user->id;
    }
    public function getUserByName($user_name)
    {
        $user = User::where('name', $user_name)->first();
        return $user;
    }
    public function getUserById($id)
    {
        return User::where('id', $id)->first();
    }
    public function getAllUsers()
    {
        return User::get();
    }
    public function destroy($request)
    {
        $user = User::where('id', $request->input('id'))->first();
        if ($user) {
            $user->delete();
            return true;
        }
        return false;
    }
    public function update($request)
    {
        if ($request->input('password') != $request->input('repassword')) {
            Toastr::error('Mật khẩu nhập lại không trùng khớp!', 'Lỗi');
            return false;
        }
        try {
            User::where('name', $request->input('name'))->update([
                'password' => bcrypt($request->input('password')),
                'email' => $request->input('email')
            ]);
            Toastr::success('Sửa tài khoản thành công!', 'Thành công');
        } catch (Exception $e) {
            Toastr::error('Sửa tài khoản không thành công!', 'Lỗi');
            return false;
        }
        return true;
    }
    public function edit($request)
    {
        if(!$this->checkPass($request)){
            Toastr::error('Mật khẩu cũ không chính xác!', 'Lỗi');
            return false;
        }
        if ($request->input('password') != $request->input('repassword')) {
            Toastr::error('Mật khẩu nhập lại không trùng khớp!', 'Lỗi');
            return false;
        }

        try {
            User::where('name', $request->input('name'))->update([
                'password' => bcrypt($request->input('password')),
                'email' => $request->input('email')
            ]);
            Toastr::success('Đổi mật khẩu thành công!', 'Thành công');
        } catch (Exception $e) {
            Toastr::error('Đổi mật khẩu không thành công!', 'Lỗi');
            return false;
        }
        return true;
    }
    public function checkPass($request){
        if (Auth::attempt(['name' => $request->input('name'), 'password' =>  $request->input('old_password')])) {
            return true;
        }
        return false;
    }
    public function recover($request){
        if(!$this->checkExistsName($request->name)){
            Toastr::error('Tài khoản không tồn tại!', 'Lỗi');
        }
        elseif(!$this->checkExistsEmail($request->email)){
            Toastr::error('Email không tồn tại!', 'Lỗi');
        }
        elseif((!$this->checkExistsName($request->name) && $this->checkExistsEmail($request->email)) |
        ($this->checkExistsName($request->name) && !$this->checkExistsEmail($request->email))){
            Toastr::error('Email đăng ký hoặc tài khoản không trùng khớp!', 'Lỗi');
        }
        else{
            $new_pass = '';
            $source = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];
            for ($i=0; $i < count($source); $i++) {
                $j = rand(0, count($source) - 1);
                $new_pass .= $source[$j];
            }
            User::where('name', $request->name)->update([
                'password' => Hash::make($new_pass)
            ]);

            #Queues
            $user = User::where('name', $request->name)->first();
            RecoverPassword::dispatch($user, $new_pass)->delay(now()->addSecond(2));

            return true;
        }
        return false;
    }
}
