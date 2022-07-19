<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

session_start();

class BrandController extends Controller
{
    public function list(Request $request) {
        if (empty(Session::has('username'))) {
            return redirect('admin/login');
        }

        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 25)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền hiển thị danh sách nhãn hiệu');
            return redirect('admin/index');
        }

        $page_title = "Danh sách nhãn hiệu";
        $result = DB::table('brand')->get();
        return view('admin.brand.list')->with('brands', $result)->with('page_title', $page_title);
    }

    public function addBrand(Request $request) {
        if (empty(Session::has('username'))) {
            return redirect('admin/login');
        }
        $page_title = "Thêm nhãn hiệu";

        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 26)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền thêm nhãn hiệu');
            return redirect('admin/index');
        }

        return view('admin.brand.add')->with('page_title', $page_title);
    }

    public function save(Request $request) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 26)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền thêm nhãn hiệu');
            return redirect('admin/index');
        }

        $name = $request->name;
        if ($name != null) {
            $qr = DB::table('brand')->where('name', $name)->first();
            if ($qr) {
                $request->session()->put('error', 'Lỗi trùng tên nhãn hiệu '.$name);
                return redirect('admin/brand/add');
            }
            $result = DB::table('brand')->insert(['name' => $name]);
            $request->session()->put('message', 'Thêm nhãn hiệu thành công');
            return redirect('admin/brand/list');
        }        
        else {
            $request->session()->put('error', 'Vui lòng nhập tên nhãn hiệu');
            return redirect('admin/brand/add');
        }
    }

    public function edit(Request $request, $brand_id) {
        $page_title = "Cập nhật nhãn hiệu";

        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 27)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền cập nhật nhãn hiệu');
            return redirect('admin/index');
        }

        $result = DB::table('brand')->where('id', $brand_id)->first();
        return view('admin.brand.edit')->with('brand', $result)->with('page_title', $page_title);
    }

    public function update(Request $request, $brand_id) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 27)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền cập nhật nhãn hiệu');
            return redirect('admin/index');
        }

        $name = $request->name;
        if ($name != null) {
            $qr = DB::table('brand')->where('name', $name)->where('id', '!=', $brand_id)->get();
            if (count($qr) > 0) {
                $request->session()->put('error', 'Lỗi trùng tên nhãn hiệu '.$name);
                return redirect('admin/brand/edit/'.$brand_id);
            }
            $result = DB::table('brand')->where('id', $brand_id)->update(['name' => $name]);
            $request->session()->put('message', 'Cập nhật nhãn hiệu thành công');
            return redirect('admin/brand/list');
        }
        else {
            $request->session()->put('error', 'Vui lòng nhập tên nhãn hiệu');
            return redirect('admin/brand/edit/'.$brand_id);
        }
    }

    public function delete(Request $request, $brand_id) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 28)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền xóa nhãn hiệu');
            return redirect('admin/index');
        }

        $brand = DB::table('brand')->where('id', $brand_id)->first();
        $count = DB::table('product')->where('brand_id', $brand->id)->get();
        if (count($count) > 0) {
            $request->session()->put('error', 'Sản phẩm có nhãn hiệu!!! Không thể xóa');
            return redirect('admin/brand/list'); 
        }

        $result = DB::table('brand')->where('id', $brand_id)->delete();
        $request->session()->put('message', 'Xóa nhãn hiệu thành công');
        return redirect('admin/brand/list');
    }

    public function deletes(Request $request) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 28)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền xóa nhãn hiệu');
            return redirect('admin/index');
        }

        $brand_ids = [];
        $brand_ids[] = $request->get('ids');
        foreach ($brand_ids as $brand_id) {
            $brand = DB::table('brand')->where('id', $brand_id)->first();
            $count = DB::table('product')->where('brand_id', $brand->id)->get();
            if (count($count) > 0) {
                $request->session()->put('error', 'Sản phẩm có nhãn hiệu!!! Không thể xóa');
                return redirect('admin/brand/list'); 
            }
        }
        
        foreach ($brand_ids as $brand_id) {
            DB::table('brand')->where('id', $brand_id)->delete();
        }
        $request->session()->put('message', 'Xóa nhãn hiệu thành công');
        return redirect('admin/brand/list');
    }
}