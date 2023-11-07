<?php

namespace App\Http\Services\Product;

use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Menu;
use Exception;
use Toastr;
class ProductService
{
    protected function isValidPrice($request)
    {
        $price = (int)$request->input('price');
        $price_sale = (int)$request->input('price_sale');
        if (($price != 0 & $price_sale != 0) & $price <= $price_sale) {
            Toastr::error('Giá giảm phải nhỏ hơn giá gốc!', 'Lỗi');
            return false;
        }
        if ($price < 0 | $price_sale < 0) {
            Toastr::error('Giá phải lớn hơn 0!', 'Lỗi');
            return false;
        }
        if ($price == null & $price_sale != null) {
            Toastr::error('Chưa nhập giá gốc!', 'Lỗi');
            return false;
        }
        return true;
    }
    public function create($request)
    {
        $isValidPrice = $this->isValidPrice($request);
        if (!$isValidPrice) return false;
        try {
            $request->except('_token');
            Product::create($request->all());
            Toastr::success('Thêm sản phẩm thành công!', 'Thành công');
        } catch (Exception $e) {
            Toastr::error('Thêm sản phẩm không thành công!', 'Lỗi');
            return false;
        }
        return true;
    }

    // xóa sp
    public function destroy($request)
    {
        $result = Product::where('id', $request->input('id'))->first();
        if ($result) {
            $result->delete();
            return true;
        }
        return false;
    }
    //Sua
    public function update($request, $product)
    {
        $isValidPrice = $this->isValidPrice($request);
        if (!$isValidPrice) return false;
        try {
            $product->fill($request->input());
            $product->save();
            Toastr::success('Sửa sản phẩm thành công!', 'Thành công');
        } catch (Exception $e) {
            Toastr::error('Sửa sản phẩm không thành công!', 'Lỗi');
            return false;
        };
        return true;
    }
    //lấy tất cả sp
    public function getAll($request)
    {
        $category = $request->input('category');
        if (!is_null($category))
            return Product::with('menu')
            ->where('menu_id', $category)
            ->orderByDesc('id')->paginate(10);
        return Product::with('menu')->orderByDesc('id')->paginate(5);
    }
    //lấy sp theo id
    public function getProductByMenuID($request, $id)
    {
        if ($request->input('price')) {
            if ($request->input('price') == 'desc') {
                return Product::where('menu_id', $id)->orderByDesc('price')->get();
            }
            return Product::where('menu_id', $id)->orderBy('price')->get();
        }
        return Product::where('menu_id', $id)->orderByDesc('id')->get();
    }
    //lấy tất cả sản phẩm theo mã danh mục
    public function getProduct()
    {
        $products = [];
        $menu = DB::table('products')->join('menus', 'products.menu_id', '=', 'menus.id')
        ->where('menus.active', 1)->distinct()->pluck('menus.id', 'menus.name');
        foreach ($menu as $key => $id) {
            $products[$key] = Product::with('menu')->orderByDesc('id')
            ->where('menu_id', $id)->where('active', 1)->limit(5)->get();
        }
        return $products;
    }
    public function getProductByKeyWord($request){
        $key = $request->input('content-search');
        return Product::with('menu')
        ->where('name', 'like', $key.'%')
        ->where('active', 1)->orderBy('name')->get();
    }

    public function getOtherProductByKeyWord($request){
        $key = $request->input('content-search');
        return Product::with('menu')
        ->where('name', 'not like', $key.'%')
        ->where('active', 1)->orderBy('name')->get();
    }
}
