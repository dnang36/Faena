<?php

namespace App\Http\Services\Comment;

use App\Http\Services\User\UserService;
use App\Models\Comment;
use Toastr;

use function PHPUnit\Framework\isEmpty;

class CommentService
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function create($request)
    {
        $user_name = $request->input('user_name');
        $product_id = $request->input('product_id');
        $content = $request->input('content');
        if (is_null($user_name)) {
            Toastr::error('Bạn cần đăng nhập để bình luận!', 'Lỗi');
            return false;
        }

        if (is_null($content)) {
            Toastr::error('Bình luận không hợp lệ!', 'Lỗi');
            return false;
        }
        // dd($request->all());
        $user_id = $this->userService->getUserIdByName($user_name);

        Comment::create([
            'user_id' => (int) $user_id,
            'product_id' => (int) $product_id,
            'content' => (string) $request->input('content')
        ]);
        Toastr::success('Bình luận sản thành công!', 'Thành công');
        return true;
    }
    public function getComment($product_id)
    {
        return Comment::with('user')->where('product_id', $product_id)->get();
    }
    public function destroy($id)
    {
        $comment = Comment::where('id', $id)->first();
        if ($comment) {
            $comment->delete();
            Toastr::success('Xóa bình luận sản thành công!', 'Thành công');
            return true;
        }
        return false;

    }
    public function getAllComments(){
        return Comment::with('user')->orderBy('id')->paginate(10);
    }
}
