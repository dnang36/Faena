<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Services\Voucher\VoucherService;
use App\Models\c;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    protected $voucherService;
    public function __construct(VoucherService $voucherService)
    {
        $this->voucherService = $voucherService;
    }
    public function index()
    {
        return view('admin.vouchers.list', [
            'title' => 'Quản lý khuyến mãi',
            'vouchers' => $this->voucherService->getVoucher(0)
        ]);
    }

    public function store(Request $request)
    {
        $this->voucherService->create($request);
        return redirect()->back();
    }

    public function show($id)
    {
        return view('admin.vouchers.edit', [
            'title' => 'Cập nhật khuyến mãi',
            'voucher' => $this->voucherService->getVoucherById($id)
        ]);
    }
    public function update(Request $request, $id)
    {
        $this->voucherService->update($request, $id);
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->voucherService->destroy($request);
        if($result)
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công!'
            ]);
        return response()->json([
            'error' => true
        ]);
    }
}
