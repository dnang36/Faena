<?php

namespace App\Http\Services\Menu;

use Exception;
use App\Models\Menu;
use Illuminate\Support\Str;
use Toastr;
use PDO;

class MenuService
{
    public function create($request)
    {
        try {
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (int) $request->input('active'),
                'slug' => Str::slug($request->input('name'), '-')
            ]);
            Toastr::success('Thêm danh mục thành công!', 'Thành công');
        } catch (Exception $e) {
            Toastr::error('Thêm danh mục không thành công!', 'Lỗi');
            return false;
        }
        return true;
    }
    public function get()
    {
        return Menu::paginate(10);
    }
    // xóa danh mục
    public function destroy($request)
    {
        $id = (int)$request->input('id');
        $menu = Menu::where('id', $id)->first();
        if ($menu) {
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;
    }
    // sửa danh mục
    public function update($menu, $request)
    {
        if ($request->input('id') != $request->input('parent_id')) {
            $menu->fill($request->input());
            $menu->save();
            Toastr::success('Cập nhật danh mục thành công!', 'Thành công');
            return true;
        }
        Toastr::error('Cập nhật danh mục không thành công!', 'Lỗi');
        return false;
    }
    //lấy menu theo id
    public function getMenuByID($id)
    {
        return Menu::where('id', $id)->first();
    }
    //lấy menu active
    public function getMenuIsActive()
    {
        return Menu::where('active', 1)->get();
    }
}
