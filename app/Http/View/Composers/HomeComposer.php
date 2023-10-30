<?php
namespace App\Http\View\Composers;

use Illuminate\Support\Composer;
use Illuminate\View\View;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use App\Models\Customer;
use DB;


class HomeComposer extends Composer{
    public function compose(View $view){
        $sum_comment = count(Comment::get());
        $view->with('sum_comment', $sum_comment);

        $sum_product = count(Product::get());
        $view->with('sum_product', $sum_product);

        $sum_user = count(User::get());
        $view->with('sum_user', $sum_user);

        $products = Product::orderByDesc('id')->limit(5)->get();
        $view->with('products', $products);

        $orders = Customer::with('voucher')
        ->with('cart')
        ->orderByDesc('id')
        ->limit(5)
        ->get();
        $view->with('orders', $orders);
    }
}
