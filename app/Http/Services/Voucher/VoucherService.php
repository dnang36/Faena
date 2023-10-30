<?php

namespace App\Http\Services\Voucher;

use App\Models\Voucher;
use Toastr;

class VoucherService{
    public function create($request){
        try{
            $data = $request->except('_token');
            Voucher::create($data);
        }
        catch(Exception $e){
            Toastr::error('Thêm khuyến mãi không thành công!', 'Lỗi');
            return false;
        }
        Toastr::success('Thêm khuyến mãi thành công!', 'Thành công');
        return true;
    }

    public function update($request, $id){
        try{
            $data = $request->except('_token');
            Voucher::where('id', $request->id)->update($data);
        }
        catch(Exception $e){
            return false;
            Toastr::error('Cập nhật khuyến mãi không thành công!', 'Lỗi');
        }
        Toastr::success('Cập nhật khuyến mãi thành công!', 'Thành công');
        return true;
    }

    public function destroy($request){
        try{
            Voucher::where('id', $request->id)->first()->delete();
        }
        catch(Exception $e){
            return false;
        }
        return true;
    }

    public function getVoucher($status){
        $bool = $status == 1 ? true : false;
        return Voucher::orderBy('id')->when($bool, function($query){
            $query->where('active', 1);
        })->paginate(5);
    }

    public function getVoucherById($id){
        return Voucher::where('id', $id)->first();
    }
}
