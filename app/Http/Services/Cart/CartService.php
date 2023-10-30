<?php

namespace App\Http\Services\Cart;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Customer;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendMail;
use Toastr;

use function PHPUnit\Framework\isNull;

class CartService
{
    public function create($request)
    {
        $quantity = (int)$request->input('quantity');
        $product_id = (int)$request->input('product_id');
        if ($quantity <= 0 | $product_id <= 0) {
            Toastr::error('Số lượng sản phẩm không chính xác!', 'Lỗi!');
            return false;
        }

        $carts = Session::get('carts');
        //kiểm tra trong session có carts chưa
        if (is_null($carts)) {
            Session::put('carts', [
                $product_id => $quantity
            ]);
            return true;
        }

        $exist = Arr::exists($carts, $product_id);
        if ($exist) {
            $carts[$product_id] = $carts[$product_id] + $quantity;
            Session::put('carts', $carts);
            return true;
        }

        $carts[$product_id] = $quantity;
        Session::put('carts', $carts);
        return true;
    }
    public function getProduct()
    {
        $carts = Session::get('carts');
        if (is_null($carts)) return [];

        $productID = array_keys($carts);
        return Product::whereIn('id', $productID)->where('active', 1)->get();
    }
    public function update($request)
    {
        $carts = Session::get('carts');
        $products = $request->input('num_product');
        foreach ($products as $product_id => $quantity) {
            $carts[$product_id] = $quantity;
        }
        Session::put('carts', $carts);
        Toastr::success('Cập nhật giỏ hàng thành công!', 'Thành công!');
        return true;
    }
    public function destroy($id)
    {
        $carts = Session::get('carts');
        unset($carts[$id]);
        Session::put('carts', $carts);
        Toastr::success('Xóa sản phẩm khỏi giỏ hàng thành công!', 'Thành công!');
        return true;
    }
    public function addCart($request)
    {
        // dd($request->all());
        try {
            $carts = Session::get('carts');

            if (is_null($carts))
                return false;
            DB::beginTransaction();
            $data = $request->except('_token');
            // if(!isset($data['voucher_id']) | is_null($data['voucher_id']))

            $data['status'] = 0;
            // dd($request->all());
            $customer = Customer::create($data);
            $this->infoProductCart($carts, $customer->id);
            DB::commit();
            #Queues
            SendMail::dispatch($carts, $customer, $this->getListProductOrder($carts))->delay(now()->addSecond(2));

            Session::forget('carts');
            Toastr::success('Mua hàng thành công!', 'Thành công!');
        } catch (Exception $ex) {
            DB::rollBack();
            Toastr::error('Mua hàng không thành công!', 'Lỗi!');
            return false;
        }
        return true;
    }
    public function infoProductCart($carts, $customer_id)
    {
        $productsID = array_keys($carts);
        $products = Product::where('active', 1)->whereIn('id', $productsID)->get();
        $data = [];
        foreach ($products as $key => $product) {
            $data[] = [
                'customer_id' => $customer_id,
                'product_id' => $product->id,
                'quantity' => $carts[$product->id],
                'price' => $product->price_sale != 0 ? $product->price_sale : $product->price
            ];
        }
        return Cart::insert($data);
    }
    // lấy sản phẩm có id trong mảng
    public static function getListProductOrder($carts)
    {
        $productsID = array_keys($carts);
        return $products = Product::where('active', 1)->whereIn('id', $productsID)->get();
    }
}
