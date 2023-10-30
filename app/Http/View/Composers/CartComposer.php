<?php

namespace App\Http\View\Composers;

use Illuminate\Support\Composer;
use Illuminate\View\View;
use App\Models\Cart;
use Illuminate\Contracts\Session\Session;

class CartComposer extends Composer
{
    public function compose(View $view)
    {
        // $user_name = Session::get('user');
        // if(!is_null($user_name))
        // $menus = Menu::select('name', 'id', 'parent_id')->where('active', 1)->get();
        // $view->with('menus', $menus);
    }
}