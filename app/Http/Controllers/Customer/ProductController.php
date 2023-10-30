<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Comment\CommentService;
use App\Http\Services\Product\ProductService;
use App\Models\Product;

class ProductController extends Controller
{
    protected $productService;
    protected $commentService;
    public function __construct(ProductService $productService, CommentService $commentService)
    {
        $this->productService = $productService;
        $this->commentService = $commentService;
    }
    public function index(Product $product, Request $request)
    {
        return view('admin.customers.detail', [
            'title' => $product->name,
            'product' => $product,
            'products' => $this->productService->getProductByMenuID($request, $product->menu_id),
            'comments' => $this->commentService->getComment($product->id)
        ]);
    }
}