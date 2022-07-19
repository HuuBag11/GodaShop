<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

session_start();

class CategoryController extends Controller
{
    public function list(Request $request) {
        if (empty(Session::has('username'))) {
            return redirect('admin/login');
        }

        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 17)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền hiển thị danh sách danh mục');
            return redirect('admin/index');
        }

        $result = DB::table('category')->get();
        $page_title = "Danh sách danh mục sản phẩm";
        return view('admin.category.list')->with('categories', $result)->with('page_title', $page_title);
        //return view('admin.index')->with('admin.category.list', $categories);
    }

    public function active(Request $request, $category_id) {
        if (empty(Session::has('username'))) {
            return redirect('admin/login');
        }

        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 19)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền cập nhật danh mục');
            return redirect('admin/index');
        }

        $active = DB::table('category')->where('id', $category_id)->first();
        if ($active->active == 0) {
            $result = DB::table('category')->where('id', $category_id)->update(['active' => '1']);
        }
        else {
            $result = DB::table('category')->where('id', $category_id)->update(['active' => '0']);
        }
        
        $request->session()->put('message', 'Cập nhật danh mục thành công');
        return redirect('admin/category/list');
    }

    public function add(Request $request) {
        if (empty(Session::has('username'))) {
            return redirect('admin/login');
        }

        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 18)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền thêm danh mục');
            return redirect('admin/index');
        }

        $page_title = "Thêm danh mục sản phẩm";
        return view('admin.category.add')->with('page_title', $page_title);
    }

    public function save(Request $request) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 18)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền thêm danh mục');
            return redirect('admin/index');
        }

        $name = $request->name;
        if ($name != null) {
            $qr = DB::table('category')->where('name', $name)->first();
            if ($qr) {
                $request->session()->put('error', 'Lỗi trùng tên danh mục '.$name);
                return redirect('admin/category/add');
            }
            $result = DB::table('category')->insert(['name' => $name, 'active' => 0]);
            $request->session()->put('message', 'Thêm danh mục thành công');
            return redirect('admin/category/list');
        }

        else {
            $request->session()->put('error', 'Vui lòng nhập tên danh mục');
            return redirect('admin/category/add');
        }
    }

    public function edit(Request $request, $category_id) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 19)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền cập nhật danh mục');
            return redirect('admin/index');
        }

        $page_title = "Cập nhật danh mục sản phẩm";
        $result = DB::table('category')->where('id', $category_id)->first();
        return view('admin.category.edit')->with('category', $result)->with('page_title', $page_title);
    }

    public function update(Request $request, $category_id) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 19)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền cập nhật danh mục');
            return redirect('admin/index');
        }
        
        $name = $request->name;
        if ($name != null) {
            $qr = DB::table('category')->where('name', $name)->where('id', '!=', $category_id)->get();
            if (count($qr) > 0) {
                $request->session()->put('error', 'Lỗi trùng tên danh mục '.$name);
                return redirect('admin/category/edit/'.$category_id);
            }
            $result = DB::table('category')->where('id', $category_id)->update(['name' => $name]);
            $request->session()->put('message', 'Cập nhật danh mục thành công');
            return redirect('admin/category/list');
        }
        else {
            $request->session()->put('error', 'Vui lòng nhập tên danh mục');
            return redirect('admin/category/edit/'.$category_id);
        }
    }

    public function delete(Request $request, $category_id) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 20)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền xóa danh mục');
            return redirect('admin/index');
        }

        $cate = DB::table('category')->where('id', $category_id)->first();
        $count = DB::table('product')->where('category_id', $cate->id)->get();
        if (count($count) == 0) {
            $result = DB::table('category')->where('id', $category_id)->delete();
            $request->session()->put('message', 'Xóa danh mục thành công');
            return redirect('admin/category/list'); 
        }
        else {
            $request->session()->put('error', 'Danh mục chứa sản phẩm!!! Không thể xóa');
            return redirect('admin/category/list'); 
        }
    }

    public function deletes(Request $request) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 20)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền xóa danh mục');
            return redirect('admin/index');
        }

        $category_ids = [];
        $category_ids[] = $request->get('ids');
        foreach ($category_ids as $category_id) {
            $cate = DB::table('category')->where('id', $category_id)->first();
            $count = DB::table('product')->where('category_id', $cate->id)->get();
            if (count($count) > 0) {
                $request->session()->put('error', 'Danh mục chứa sản phẩm!!! Không thể xóa');
                return redirect('admin/category/list'); 
            }
        }
        
        foreach ($category_ids as $category_id) {
            DB::table('category')->where('id', $category_id)->delete();
        }
        $request->session()->put('message', 'Xóa danh mục thành công');
        return redirect('admin/category/list');
    }
}
