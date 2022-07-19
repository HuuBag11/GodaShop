<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ImageItemController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShippingFeeController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\LoginController as CustomerLoginController;
use App\Http\Controllers\Customer\PaymentController;
use App\Http\Controllers\Customer\ProductController as CustomerProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//admin

Route::get('admin/login', [LoginController::class, 'index']);
Route::post('admin/login', [LoginController::class, 'checkLogin']);
Route::get('/logout', [LoginController::class, 'logout']);

//Route::get('admin/main', [MainController::class, 'index'])->name('admin');

Route::get('admin/layout/show/{product_id}', [ImageItemController::class, 'show']);

//Category
Route::get('admin/category/list', [CategoryController::class, 'list']);
Route::get('admin/category/add', [CategoryController::class, 'add']);
Route::get('admin/category/edit/{category_id}', [CategoryController::class, 'edit']);
Route::get('/active-category/{category_id}', [CategoryController::class, 'active']);
Route::post('/save-category', [CategoryController::class, 'save']);
Route::post('/update-category/{category_id}', [CategoryController::class, 'update']);
Route::get('/delete-category/{category_id}', [CategoryController::class, 'delete']);
Route::post('/deletes-category', [CategoryController::class, 'deletes']);

//Brand
Route::get('admin/brand/list', [BrandController::class, 'list']);
Route::get('admin/brand/add', [BrandController::class, 'addBrand']);
Route::get('admin/brand/edit/{brand_id}', [BrandController::class, 'edit']);

Route::post('/save-brand', [BrandController::class, 'save']);
Route::post('/update-brand/{brand_id}', [BrandController::class, 'update']);
Route::get('/delete-brand/{brand_id}', [BrandController::class, 'delete']);
Route::post('/deletes-brand', [BrandController::class, 'deletes']);

//Comment
Route::get('admin/comment/list', [CommentController::class, 'list']);
Route::get('admin/comment/detail/{product_id}', [CommentController::class, 'detail']);
Route::get('/delete-comment/{product_id}/{comment_id}', [CommentController::class, 'delete']);

//Customer
Route::get('admin/customer/list', [CustomerController::class, 'list']);
Route::get('admin/customer/edit', [CustomerController::class, 'edit']);
Route::get('/update-customer/{customer_id}', [CustomerController::class, 'update']);
Route::get('/delete-customer/{customer_id}', [CustomerController::class, 'delete']);

//Order
Route::get('admin/order/list', [OrderController::class, 'list']);
Route::get('/confirm-order/{order_id}', [OrderController::class, 'confirm']);
Route::get('/delete-order/{order_id}', [OrderController::class, 'delete']);
Route::get('admin/order/detail/{order_id}', [OrderController::class, 'detail']);

//Product
Route::get('admin/product/list', [ProductController::class, 'list']);
Route::get('admin/product/edit/{product_id}', [ProductController::class, 'edit']);
Route::post('/update-product/{product_id}', [ProductController::class, 'update']);
Route::get('admin/product/add', [ProductController::class, 'add']);
Route::post('/save-product', [ProductController::class, 'save']);


//Image Item
Route::get('admin/imageItem/list', [ImageItemController::class, 'list']);
Route::get('admin/imageItem/detail/{product_id}', [ImageItemController::class, 'detail']);
Route::get('/delete-image/{product_id}/{image_id}', [ImageItemController::class, 'delete']);
Route::get('admin/imageItem/show/{image_id}', [ImageItemController::class, 'showItem']);
Route::post('/upload-image-item/{product_id}', [ImageItemController::class, 'uploadImageItem']);

//Shipping Fee
Route::get('admin/shippingFee/list', [ShippingFeeController::class, 'list']);
Route::get('admin/shippingFee/edit/{fee_id}', [ShippingFeeController::class, 'edit']);
Route::post('/update-fee/{fee_id}', [ShippingFeeController::class, 'update']);

//Dashboard
Route::get('admin/index', [DashboardController::class, 'index']);
Route::get('admin/index/{datetime}', [DashboardController::class, 'datetime']);

//Staff
Route::get('admin/staff/list', [StaffController::class, 'list']);
Route::get('/active/{staff_id}', [StaffController::class, 'active']);
Route::get('admin/staff/add', [StaffController::class, 'add']);
Route::post('/save-staff', [StaffController::class, 'save']);
// Route::get('admin/staff/edit/{staff_id}', [StaffController::class, 'edit']);
Route::get('admin/staff/edit/{staff_id}', [StaffController::class, 'edit']);
Route::post('/update-staff/{staff_id}', [StaffController::class, 'update']);

//Permission
Route::get('admin/permission/listRole', [PermissionController::class, 'listRole']);
Route::get('admin/permission/editRole/{role_id}', [PermissionController::class, 'editRole']);
Route::post('/update-role/{role_id}', [PermissionController::class, 'updateRole']);
Route::get('admin/permission/addRole', [PermissionController::class, 'addRole']);
Route::post('/save-role', [PermissionController::class, 'saveRole']);
Route::get('/delete-role/{role_id}', [PermissionController::class, 'deleteRole']);
Route::get('admin/permission/listAction', [PermissionController::class, 'listAction']);
Route::get('admin/permission/listRoleAction/{role_id}', [PermissionController::class, 'listRoleAction']);
Route::post('/update-role-action/{role_id}', [PermissionController::class, 'updateRoleAction']);

//Status
Route::get('admin/status/list', [StatusController::class, 'list']);

//----------------------------------------
//Customer
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);

Route::post('/check-login', [CustomerLoginController::class, 'checkLogin']);
Route::get('/check-logout', [CustomerLoginController::class, 'logout']);
Route::post('/register-customer', [CustomerLoginController::class, 'register']);
Route::get('/shipping-address', [CustomerLoginController::class, 'shippingAdress']);
Route::post('/update-default-shipping', [CustomerLoginController::class, 'updateShipping']);
Route::get('/my-order', [CustomerLoginController::class, 'myOrder']);
Route::get('/my-info', [CustomerLoginController::class, 'myInfo']);
Route::post('/update-info', [CustomerLoginController::class, 'updateInfo']);

//Product
Route::get('/product', [CustomerProductController::class, 'list']);
Route::get('/product/category/{category_id}', [CustomerProductController::class, 'list']);
Route::get('/product/detail/{product_id}', [CustomerProductController::class, 'detail']);
Route::post('/add-comment/{product_id}', [CustomerProductController::class, 'addComment']);

//Cart
Route::get('/add-cart/{product_id}', [CartController::class, 'add']);
Route::get('/delete-item-cart/{product_id}', [CartController::class, 'delete']);
Route::get('/update-cart/{product_id}/{qty}', [CartController::class, 'update']);

//Payment
Route::get('/check-out', [PaymentController::class, 'checkout']);
Route::post('/confirm-order', [PaymentController::class, 'confirm']);
Route::post('/finish-order', [PaymentController::class, 'finish']);

//Information
Route::get('/returnPolicy', function(){
    return view('customer.Information.returnPolicy');
});

Route::get('/paymentPolicy', function(){
    return view('customer.Information.paymentPolicy');
});

Route::get('/deliveryPolicy', function(){
    return view('customer.Information.deliveryPolicy');
});

Route::get('/contact', function(){
    return view('customer.Information.contact');
});

Route::post('/send-contact', function(){
    return redirect('/contact');
});