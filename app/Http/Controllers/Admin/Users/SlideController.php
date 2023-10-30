<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Services\Slide\SlideService;
use Illuminate\Http\Request;
use App\Http\Requests\Slide\SlideRequest;
use App\Models\Slide;

class SlideController extends Controller
{
    protected $slideService;
    public function __construct(SlideService $slideService)
    {
        $this->slideService = $slideService;
    }
    public function index()
    {
        return view('admin.slides.list', [
            'title' => 'Danh sách slide',
            'slides' => $this->slideService->getSliders()
        ]);
    }

    public function create()
    {
        return view('admin.slides.add', [
            'title' => 'Thêm slide'
        ]);
    }

    public function store(SlideRequest $request)
    {
        $this->slideService->create($request);
        return redirect()->back();
    }

    public function show(Slide $slide)
    {
        return view('admin.slides.edit', [
            'title' => 'Sửa slide - ' . $slide->name,
            'slide' => $slide
        ]);
    }


    public function update(SlideRequest $request, Slide $slide)
    {
        $result = $this->slideService->update($request, $slide);
        if ($result) {
            return redirect('admin/slides/list');
        }
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->slideService->destroy($request);
        if ($result) {
            return response([
                'error' => false,
                'message' => 'Xóa slide thành công'
            ]);
        }
        return response([
            'error' => true
        ]);
    }
}
