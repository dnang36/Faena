<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Services\Cart\CartService;
use App\Http\Services\Voucher\VoucherService;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Customer\CustomerRequest;

class  CartController extends Controller
{
    protected $cartService;
    protected $voucherService;
    public function __construct(VoucherService $voucherService, CartService $cartService)
    {
        $this->cartService = $cartService;
        $this->voucherService = $voucherService;
    }
    public function index(Request $request)
    {
        $result = $this->cartService->create($request);
        if (!$result)
            return redirect()->back();
        return redirect('/carts');
    }
    public function show()
    {
        return view('admin.customers.cart', [
            'title' => 'Giỏ hàng',
            'products' => $this->cartService->getProduct(),
            'carts' => Session::get('carts'),
            'vouchers' => $this->voucherService->getVoucher(1)
        ]);
    }
    public function update(Request $request)
    {
        $result = $this->cartService->update($request);
        return redirect()->back();
    }
    public function destroy($id)
    {
        $result = $this->cartService->destroy($id);
        if ($result)
            return redirect()->back();
    }
    public function addCart(CustomerRequest $request)
    {
        $this->cartService->addCart($request);
        return redirect()->back();
        // dd($customer);
    }
}
