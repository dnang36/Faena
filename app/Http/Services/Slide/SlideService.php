<?php

namespace App\Http\Services\Slide;

use App\Models\Slide;
use Exception;
use Illuminate\Support\Facades\Storage;
use Toastr;

class SlideService
{
    //lấy tất cả slider
    public function getSliders()
    {
        return Slide::orderByDesc('id')->paginate(15);
    }
    // lấy slider active
    public function getSlider()
    {
        return Slide::where('active', 1)->orderByDesc('sort_by')->get();
    }
    public function create($request)
    {
        try {
            $slide = new Slide();
            $request->except('_token');
            $slide->fill($request->input());
            $slide->save();
            Toastr::success('Thêm slide thành công!', 'Thành công');
        } catch (Exception $e) {
            Toastr::error('Thêm slide không thành công!', 'Lỗi');
            return false;
        }
        return true;
    }
    public function update($request, $slide)
    {
        try {
            $slide->fill($request->input());
            $slide->save();
            Toastr::success('Sửa slide thành công!', 'Thành công');
        } catch (Exception $e) {
            Toastr::error('Sửa slide không thành công!', 'Lỗi');
            return false;
        }
        return true;
    }
    public function destroy($request)
    {
        $slide = Slide::where('id', $request->input('id'))->first();
        if ($slide) {
            $path = str_replace('storage', 'public', $slide->thumb);
            Storage::delete($path);
            $slide->delete();
            return true;
        }
        return false;
    }
}

