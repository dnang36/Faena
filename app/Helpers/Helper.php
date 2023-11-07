<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{
    public static function menu($menus, $parent_id = 0, $char = '')
    {
        // var_dump($menus);
        $html = '';
        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '
                    <tr>
                        <td>' . $menu->id . '</td>
                        <td>' . $char . $menu->name . '</td>
                        <td>' . self::active($menu->active) . '</td>
                        <td>' . $menu->updated_at . '</td>
                        <td>' . '<a class="btn btn-primary btn-sm" href="/admin/menus/edit/' . $menu->id . '">
                        <i class="fas fa-edit"></i>
                         </a>
                    <a href="#" class="btn btn-danger btn-sm" onclick="removeRow(' . $menu->id . ', \'/admin/menus/destroy\')">
                    <i class="fas fa-trash"></i>
                    </a>' . '</td>
                    </tr>
                ';
                unset($menus[$key]);
                $html .= self::menu($menus, $menu->id, $char . '-');
            }
        }
        return $html;
    }
    public static function active($active = 0)
    {
        return $active == 0 ? '<span class="btn btn-danger btn-xs">Không Kích hoạt</span>' :
            '<span class="btn btn-success btn-xs">Kích hoạt</span>';
    }
    public static function menus($menus, $parent_id = 0)
    {
        $html = '';
        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '<li class="in-menu">
                        <a href="/danh-muc/' . $menu->id . '-' . Str::slug($menu->name, '-') . '/">
                        ' . $menu->name . (self::isChild($menus, $menu->id) == true ? ' <i class="fas fa-angle-down"></i>' : '') . '</a>';
                unset($menus[$key]);

                if (self::isChild($menus, $menu->id)) {
                    $html .= '<ul class="sub-menu">';
                    $html .= self::menus($menus, $menu->id);
                    $html .= '</ul>';
                }
                $html .= '</li>';
            }
        }
        return $html;
    }
    public static function isChild($menus, $id)
    {
        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $id)
                return true;
        }
        return false;
    }
    public static function price($price, $price_sale)
    {
        if ($price_sale != 0) {
            return 'Giá: ' . number_format($price_sale, 0, ',', '.') . 'đ&nbsp
            <sup style="text-decoration: line-through; opacity:0.6">'
                . number_format($price, 0, ',', '.') . 'đ</sup>';
        }
        return 'Giá: ' . number_format($price, 0, ',', '.') . 'đ';
    }
    public static function status($status)
    {
        if ($status == 0) {
            $status = '<span class="badge badge-warning">Đang chờ</span>';
        } elseif ($status == 1) {
            $status = '<span class="badge badge-info">Đang giao</span>';
        } elseif ($status == 2) {
            $status = '<span class="badge badge-success">Đã giao</span>';
        } elseif ($status == 3) {
            $status = '<span class="badge badge-danger">Đã Hủy</span>';
        }
        else $status = '<span class="badge badge-danger">Tất cả</span>';

        return $status;
    }
}
