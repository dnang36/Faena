<?php

namespace App\Http\Controllers\Chart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Chart\ChartRequest;
use App\Http\Services\Order\OrderService;
use Illuminate\Support\Facades\Session;

class ChartController extends Controller
{
    protected $orderService;
    public function __construct(OrderService $orderService)
    {
        // Session::forget('products');
        // Session::forget('from');
        // Session::forget('to');
        $this->orderService = $orderService;
    }
    #Quantity-chart
    public function indexQuantity()
    {
        return view('admin.charts.quantity-chart', [
            'title' => 'Biểu đồ số sản phẩm đã bán',
             'datas' =>  Session::has('products') ? Session::get('products') : []
        ]);
    }
    public function showQuantity(ChartRequest $request)
    {
        return view('admin.charts.quantity-chart', [
            'title' => 'Biểu đồ số sản phẩm đã bán',
            'datas' => $this->orderService->getProductByTime($request)
        ]);
    }
    #Reveneu-chart
    public function indexRevenue()
    {
        return view('admin.charts.reveneu-chart', [
            'title' => 'Biểu đồ doanh thu',
            'datas' => Session::has('products') ? Session::get('products') : []
        ]);
        // dd($this->orderService->getReveneuByMonth());
    }
    public function showRevenue(ChartRequest $request)
    {
        return view('admin.charts.reveneu-chart', [
            'title' => 'Biểu đồ doanh thu',
            'datas' => $this->orderService->getReveneuByTime($request)
        ]);
        // dd($this->orderService->getReveneuByMonth());
    }
}