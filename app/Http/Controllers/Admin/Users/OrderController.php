<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Services\Order\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    public function index(Request $request)
    {
        return view('admin.orders.list', [
            'title' => 'Danh sách đơn hàng',
            'orders' => $this->orderService->getOrder($request)
        ]);
    }
    public function destroy(Request $request)
    {
        $result = $this->orderService->destroy($request);
        if ($result)
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công!'
            ]);
        return response()->json([
            'error' => true
        ]);
    }
    public function show($customer_id)
    {
        return view('admin.orders.edit', [
            'title' => 'Chi tiết đơn hàng',
            'customer' => $this->orderService->getCustomerById($customer_id),
            'products' => $this->orderService->getOrderByCusId($customer_id)
        ]);
        // dd($this->orderService->getCustomerById($customer_id));
    }
    public function update(Request $request)
    {
        $this->orderService->update($request);
        return redirect()->back();
    }
}
