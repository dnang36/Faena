<?php

namespace App\Http\Services\Product;

use App\Http\Services;
use Exception;

class UploadService
{
    public function store($request)
    {
        if ($request->hasFile('file')) {
            try {
                $file_name = date('H-i-s') . $request->file('file')->getClientOriginalName();
                $pathFull = 'uploads/' . date('Y-m-d');
                $request->file('file')->storeAs(
                    'public/' . $pathFull,
                    $file_name
                );
                return '/storage/' . $pathFull . '/' . $file_name;
            } catch (Exception $e) {
                return false;
            }
        }
    }
    
}