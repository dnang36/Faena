<?php

use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\Users\MainController;
use App\Http\Controllers\Admin\Users\MenuController;
use App\Http\Controllers\Admin\Users\ProductController;
use App\Http\Controllers\Admin\Users\UploadController;
use App\Http\Controllers\Admin\Users\SlideController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Admin\Users\OrderController;
use App\Http\Controllers\Admin\Users\CommentController;
use App\Http\Controllers\Admin\Users\VoucherController;
use  App\Http\Controllers\Chart\ChartController;
use Illuminate\Support\Facades\Route;
use App\Models\Menu;

Route::prefix('admin/users/')->group(function () {
    #login
    Route::prefix('login')->group(function () {
        Route::get('/', [LoginController::class, 'index'])->name('login');
        Route::post('/store', [LoginController::class, 'store']);
    });
    #logout
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    #signup
    Route::prefix('signup')->group(function () {
        Route::get('/', [App\Http\Controllers\Customer\UserController::class, 'index'])->name('signup');
        Route::post('/store', [App\Http\Controllers\Customer\UserController::class, 'store']);
    });
    #change pass
    Route::prefix('change-pass')->group(function () {
        Route::get('/', [App\Http\Controllers\Customer\UserController::class, 'show'])->name('change-pass');
        Route::post('/', [App\Http\Controllers\Customer\UserController::class, 'update']);
    });
    #forgot pass
    Route::prefix('forgot-pass')->group(function () {
        Route::get('/', [App\Http\Controllers\Customer\UserController::class, 'index_forgot'])->name('forgot-pass');
        Route::post('/', [App\Http\Controllers\Customer\UserController::class, 'store_forgot']);
    });
});

// kiểm tra đã đăng nhập hay chưa, nếu đăng nhập rồi mới vào đc main admin
Route::middleware(['auth', 'role:1-10'])->group(
    function () {
        Route::prefix('admin')->group(function () {
            // trang chủ admin
            Route::get('/', [MainController::class, 'index'])->name('admin');
            //
            Route::get('main', [MainController::class, 'index']);
            #Menu
            Route::prefix('menus')->group(function () {
                //thêm danh mục
                Route::get('add', [MenuController::class, 'create'])->name('menu.add');
                Route::post('add', [MenuController::class, 'store']);
                // danh sách danh mục
                Route::get('list', [MenuController::class, 'index'])->name('menu.list');
                // sửa danh mục
                Route::get('edit/{menu}', [MenuController::class, 'show']);
                Route::post('edit/{menu}', [MenuController::class, 'update']);
                //xóa danh mục
                Route::DELETE('destroy', [MenuController::class, 'destroy']);
            });
            #Product
            Route::prefix('products')->group(function () {
                //thêm sản phẩm
                Route::get('add', [ProductController::class, 'create'])->name('product.add');
                Route::post('add', [ProductController::class, 'store']);
                // danh sách sản phẩm
                Route::get('list', [ProductController::class, 'index'])->name('product.list');
                // sửa sản phẩm
                Route::get('edit/{product}', [ProductController::class, 'show']);
                Route::post('edit/{product}', [ProductController::class, 'update']);
                //xóa sản phẩm
                Route::DELETE('destroy', [ProductController::class, 'destroy']);
            });
            #upload
            Route::post('upload/services', [UploadController::class, 'store']);
            #Slide
            Route::prefix('slides')->group(function () {
                //thêm slide
                Route::get('add', [SlideController::class, 'create'])->name('slide.add');
                Route::post('add', [SlideController::class, 'store']);
                // danh sách slide
                Route::get('list', [SlideController::class, 'index'])->name('slide.list');
                // sửa slide
                Route::get('edit/{slide}', [SlideController::class, 'show']);
                Route::post('edit/{slide}', [SlideController::class, 'update']);
                //xóa slide
                Route::DELETE('destroy', [SlideController::class, 'destroy']);
            });
            #Order
            Route::prefix('orders')->group(function () {
                // danh sách đơn hàng
                Route::get('list', [OrderController::class, 'index'])->name('order.list');
                // chuyển trạng thái, chi tiết đơn hàng
                Route::get('edit/{id}', [OrderController::class, 'show']);
                Route::post('edit/{id}', [OrderController::class, 'update']);
                // xóa đơn hàng
                Route::DELETE('destroy', [OrderController::class, 'destroy']);
            });
            #User
            Route::prefix('users')->middleware(['role:10'])->group(function () {
                // thêm tài khoản
                Route::get('add', [UserController::class, 'create']);
                Route::post('add', [UserController::class, 'store']);
                // danh sách tài khoản
                Route::get('list', [UserController::class, 'index'])->name('user.list');
                // sửa tài khoản
                Route::get('edit/{id}', [UserController::class, 'show']);
                Route::post('edit/{id}', [UserController::class, 'update']);
                // xóa tài khoản
                Route::DELETE('destroy', [UserController::class, 'destroy']);
            });
            #Bình luận
            Route::prefix('comments')->group(function () {
                Route::get('list', [CommentController::class, 'index']);
                Route::DELETE('delete', [CommentController::class, 'delete']);
            });
            #Khuyến mãi
            Route::prefix('vouchers')->group(function () {
                Route::get('list', [VoucherController::class, 'index']);
                Route::post('list', [VoucherController::class, 'store']);
                Route::get('edit/{id}', [VoucherController::class, 'show']);
                Route::post('edit/{id}', [VoucherController::class, 'update']);
                Route::DELETE('destroy', [VoucherController::class, 'destroy']);
            });
            #Biểu đồ
            Route::prefix('charts')->group(function () {
                Route::get('quantity', [ChartController::class, 'indexQuantity']);
                Route::post('quantity', [ChartController::class, 'showQuantity']);
                Route::get('reveneu', [ChartController::class, 'indexRevenue']);
                Route::post('reveneu', [ChartController::class, 'showRevenue']);
            });

        });

    }
);
// Khách hàng
// Route::get('/', [LoginController::class, 'index'])->name('login');
Route::prefix('/')->group(function () {
    Route::get('/', [App\Http\Controllers\Customer\MainController::class, 'index'])->name('home');
    Route::get('danh-muc/{id}-{slug}', [App\Http\Controllers\Customer\MenuController::class, 'index']);
    Route::get('san-pham/{product}-{slug}', [App\Http\Controllers\Customer\ProductController::class, 'index']);
    #Giỏ hàng
    Route::post('add-cart', [App\Http\Controllers\Customer\CartController::class, 'index']);
    Route::post('update-cart', [App\Http\Controllers\Customer\CartController::class, 'update']);
    Route::get('carts', [App\Http\Controllers\Customer\CartController::class, 'show']);
    Route::get('carts/delete/{id}', [App\Http\Controllers\Customer\CartController::class, 'destroy']);
    Route::post('carts/confirm', [App\Http\Controllers\Customer\CartController::class, 'addCart']);
    #Comment
    Route::post('add-comment', [CommentController::class, 'create']);
    Route::get('delete-comment/{id}', [CommentController::class, 'destroy']);
    #Tìm kiếm
    Route::get('search', [App\Http\Controllers\Customer\MainController::class, 'show']);

    Route::post('vnpay_payment',[\App\Http\Controllers\Customer\PaymentController::class,'vnpay_payment']);
    Route::get('vnpay_payment_success',[\App\Http\Controllers\Customer\PaymentController::class,'vnpay_payment_success']);
});


/*
Để ý namespace
*/
