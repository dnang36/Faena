<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;

class MenuController extends Controller
{
    protected $menuService;
    protected $productService;
    public function __construct(MenuService $menuService, ProductService $productService)
    {
        $this->menuService = $menuService;
        $this->productService = $productService;
    }
    public function index(Request $request, $id, $slug)
    {
        return view('admin.customers.list', [
            'title' => $this->menuService->getMenuByID($id)->name,
            'products' => $this->productService->getProductByMenuID($request, $id),
            'menu' => $this->menuService->getMenuByID($id)
        ]);
        // dd($id);
    }
}