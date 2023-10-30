<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Services\Product\ProductService;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\Menu\MenuService;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    protected $productService;
    protected $menuService;
    public function __construct(ProductService $productService, MenuService $menuService)
    {
        $this->productService = $productService;
        $this->menuService = $menuService;
    }
    public function index(Request $request)
    {
        return view('admin.products.list', [
            'title' => 'Danh sách sản phẩm',
            'products' => $this->productService->getAll($request),
            'menus' => $this->menuService->get()
        ]);
        // dd($this->productService->getAll());
    }
    public function create()
    {
        return view('admin.products.add', [
            'title' => 'Thêm sản phẩm',
            'menus' => $this->menuService->get()
        ]);
    }
    public function store(ProductRequest $request)
    {
        $result = $this->productService->create($request);
        return redirect()->back();
    }
    public function show(Product $product)
    {
        return view('admin.products.edit', [
            'title' => 'Sửa sản phẩm - ' . $product->name,
            'product' => $product,
            'menus' => $this->menuService->get()
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $this->productService->update($request, $product);
        return redirect('/admin/products/list');
    }
    public function destroy(Request $request)
    {
        $result = $this->productService->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa sản phẩm thành công!'
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }
}