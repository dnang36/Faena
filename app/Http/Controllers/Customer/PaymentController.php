<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Jobs\SendMail;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Brian2694\Toastr\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function vnpay_payment(Request $request){
        $data = $request->all();
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://webmypham.test/vnpay_payment_success?" . 'cus_name=' . $data['cus_name'] . '&email=' . $data['email'] . '&address=' . $data['address'] . '&phone_number=' . $data['phone_number'] . '&note=' . $data['note'] ;
        $vnp_TmnCode = "3H3CA9TT"; // Mã website tại VNPAY
        $vnp_HashSecret = "MRATWALAPQTNHERSJQBJPFIBDFFNNTNU"; // Chuỗi bí mật

        $vnp_TxnRef = random_int(100000, 999999); // Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán hóa đơn";
        $vnp_OrderType = "Web mỹ phẩm";
        $vnp_Amount = $data['total']*100;
        $vnp_Locale = "VN";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

//var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }

    public function vnpay_payment_success(Request $request) {
        try {
            $carts = Session::get('carts');

            if (is_null($carts))
                return false;
            $data = [];
            $data['cus_name'] = $request->query('cus_name');
            $data['email'] = $request->query('email');
            $data['address'] = $request->query('address');
            $data['phone_number'] = $request->query('phone_number');
            $data['note'] = $request->query('note');
            $data['status'] = 0;
            // dd($request->all());
            $customer = Customer::create($data);
            $this->infoProductCart($carts, $customer->id);
            DB::commit();
            #Queues
            Session::forget('carts');
        } catch (Exception $ex) {
            DB::rollBack();
            Toastr::error('Mua hàng không thành công!', 'Lỗi!');
            return false;
        }
        return redirect('/carts');
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
