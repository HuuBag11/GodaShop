<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

session_start();

class ImageItemController extends Controller
{
    public function list(Request $request) {
        if (empty(Session::has('username'))) {
            return redirect('admin/login');
        }

        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 37)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền hiển thị danh sách hình ảnh');
            return redirect('admin/index');
        }

        $result = DB::table('product')->get();
        $page_title = "Danh sách hình ảnh sản phẩm";
        if($result){            
            return view('admin.imageItem.list')->with('products', $result)->with('page_title', $page_title);
        }
    }

    public function show(Request $request, $product_id) {
        $result = DB::table('product')->where('id', $product_id)->first();
        if($result){            
            return view('admin.layout.show')->with('product', $result);
        }
    }

    public function showItem($image_id) {
        $result = DB::table('image_item')->where('id', $image_id)->first();
        if($result){            
            return view('admin.imageItem.show')->with('image', $result);
        }
    }

    public function detail(Request $request, $product_id) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 39)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền hiển thị chi tiết hình ảnh');
            return redirect('admin/index');
        }

        $page_title = "Chi tiết hình ảnh";
        $result = DB::table('image_item')->where('product_id', $product_id)->get();
        return view('admin.imageItem.detail')->with('images', $result)->with('product_id', $product_id)->with('page_title', $page_title);
    }

    public function delete(Request $request, $product_id, $image_id) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 40)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền xóa hình ảnh');
            return redirect('admin/index');
        }

        $qr = DB::table('image_item')->where('id', $image_id)->first();
        $oldImg = 'upload/'.$qr->name;

        $result = DB::table('image_item')->where('id', $image_id)->delete();
        if($result) {
            File::delete($oldImg); 
            $request->session()->put('message', 'Xóa hình ảnh thành công');
            return redirect('admin/imageItem/detail/'.$product_id);
        }
    }

    public function uploadImageItem(Request $request, $product_id) {
        $image = $request->file('image');
        $image_name = $image->hashName();
        $result = DB::table('image_item')->insert([
            'product_id' => $product_id,
            'name' => $image_name,
        ]);
        $image->move(public_path('upload'), $image_name);

        $request->session()->put('message', 'Thêm hình ảnh thành công');
        return redirect('admin/imageItem/detail/'.$product_id);

    }
}
