<?php

namespace App\Http\Controllers\Customer;

use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;
use App\Http\Services\Slide\SlideService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;


class MainController extends Controller
{
    protected $productService;
    protected $slideService;
    public function __construct(ProductService $productService, SlideService $slideService)
    {
        $this->productService = $productService;
        $this->slideService = $slideService;
    }
    public function index()
    {
////        $role = Role::create(['name' => 'user']);
//        if ($user = Auth::user()){
//            $user->assignRole('super-admin');
//        }
        return view('admin.customers.home', [
            'title' => 'Trang chủ',
            'products' => $this->productService->getProduct(),
            'slides' => $this->slideService->getSlider()
        ]);
    }
    public function show(Request $request)
    {
        return view('admin.customers.search', [
            'title' => 'Tìm kiếm - ' . $request->input('content-search'),
            'products' => $this->productService->getProductByKeyWord($request),
            'others' => $this->productService->getOtherProductByKeyWord($request)
        ]);
        // dd( $this->productService->getProductByKeyWord($request));
    }
}
