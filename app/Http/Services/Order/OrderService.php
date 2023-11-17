<?php

namespace App\Http\Services\Order;

use App\Models\Customer;
use App\Models\Cart;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Session;
use Toastr;

class OrderService
{
    #Order
    public function getOrder($request)
    {
        $status = $request->input('status');
        return Customer::with('voucher')->with('cart')
         ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })->orderByDesc('id')
        ->paginate(10);

    }
    public function destroy($request)
    {
        $customer = Customer::where('id', $request->input('id'))->first();
        if ($customer) {
            $customer->delete();
            return true;
        }
        return false;
    }
    public function getCustomerById($id)
    {
        return Customer::with('voucher')->where('id', $id)->first();
    }
    public function getOrderByCusId($id)
    {
        return Cart::select(
            'carts.customer_id',
            'carts.product_id',
            'carts.price',
            'carts.quantity',
            'products.name'
        )
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->where('carts.customer_id', $id)->get();
    }
    public function update($request)
    {
        // dd($request->input());
        Toastr::success('Thay đổi trạng thái đơn hàng thành công!', 'Thành công!');
        return DB::table('customers')
        ->where('id', $request->input('id'))
        ->update(['status' => $request->input('status')]);
    }
    #Chart
    #Quantity-chart
    //số sản phẩm đã bán
    public function getProductSold()
    {
        return Cart::select('products.name', DB::raw('sum(carts.quantity) as sumQuantity'))
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->join('customers', 'customers.id', '=', 'carts.customer_id')
            ->groupBy('products.name')
            ->orderBy('products.name')
            ->get();
    }
    //số sản phẩm đã bán theo mốc thời gian
    public function getProductByTime($request)
    {
        $from = $request->input('from-date');
        $to = $request->input('to-date');
        $check = $this->isValidDate($from, $to);
        if ($check){
            $carts = Cart::select('products.name','products.id',
                    DB::raw('sum(carts.quantity) as sumQuantity'))
                    ->join('products', 'products.id', '=', 'carts.product_id')
                    ->join('customers', 'customers.id', '=', 'carts.customer_id')
                    ->whereBetween('customers.created_at', [$from, $to])
                    ->groupBy('products.name','products.id')
                    ->orderBy('products.name')
                    ->get();
            Session::put('products', $carts);
            Session::put('from', $from);
            Session::put('to', $to);
                    return $carts;
        }

        return [];
    }
    #Reveneu-chart
    public function getReveneuByTime($request)
    {
        $from = $request->input('from-date');
        $to = $request->input('to-date');
        $check = $this->isValidDate($from, $to);
        if($check){
            $carts =  Cart::select(
            DB::raw('month(customers.created_at) as month'),
            DB::raw('sum(carts.quantity) as sumQuantity'),
            DB::raw('sum(carts.quantity*carts.price) as total')
        )
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->join('customers', 'customers.id', '=', 'carts.customer_id')
            ->whereBetween('customers.created_at', [$from, $to])
            ->groupBy('month')
            ->orderBy('month')
            ->get();
            Session::put('products', $carts);
            Session::put('from', $from);
            Session::put('to', $to);
            return $carts;
        }
        return [];

    }
    //kiểm tra dữ liệu hợp lệ
    public function isValidDate($from, $to)
    {
        if (is_null($from)) {
            return false;
        }
        if (is_null($to)) {
            return false;
        }
        if ($from > $to) {
            FacadesSession::flash('error', 'Ngày bắt đầu phải nhỏ hơn ngày kết thúc!');
            return false;
        }
        return true;
    }
}
