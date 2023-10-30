<?php

namespace App\Http\View\Composers;

use Illuminate\Support\Composer;
use Illuminate\View\View;
use App\Models\Slide;


class SlideComposer extends Composer
{
    public function compose(View $view)
    {
        $slides = Slide::where('active', 1)->orderBy('sort_by')->get();
        $view->with('slides', $slides);
    }
}