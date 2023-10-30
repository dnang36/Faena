<?php

namespace App\Http\Controllers\Admin\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Comment\CommentService;
use App\Models\Comment;

class CommentController extends Controller
{
    protected $commentService;
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    public function create(Request $request)
    {
        $result = $this->commentService->create($request);
        return redirect()->back();
    }
    public function delete(Request $request)
    {
        // dd($request->all());
        $result = $this->commentService->destroy($request->input('id'));
        if($result)
        return response()->json([
            'error' => false,
            'message' => 'Xóa thành công'
        ]);
        return response()->json([
            'error' => true
        ]);
    }
    public function destroy($id)
    {
        $this->commentService->destroy($id);
        return redirect()->back();
    }
    public function index(){
        return view('admin.comments.list',[
            'title' => 'Danh sách bình luận',
            'comments' => $this->commentService->getAllComments()
        ]);
        // dd($this->commentService->getAllComments());
    }
    //
}