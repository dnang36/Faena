<?php

namespace App\Http\View\Composers;

use Illuminate\Support\Composer;
use Illuminate\View\View;
use App\Models\Menu;

class MenuComposer extends Composer
{
    public function compose(View $view)
    {
        $menus = Menu::select('name', 'id', 'parent_id')->where('active', 1)->get();
        $view->with('menus', $menus);
        $menuParents = Menu::select('name', 'id', 'parent_id')->where('active', 1)->where('parent_id', 0)->get();
        $view->with('menuParents', $menuParents);
    }
}