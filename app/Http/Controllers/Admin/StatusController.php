<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

session_start();

class StatusController extends Controller
{
    public function list(Request $request) {
        if (empty(Session::has('username'))) {
            return redirect('admin/login');
        }

        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 33)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền hiển thị danh sách trạng thái đơn hàng');
            return redirect('admin/index');
        }

        $result = DB::table('status')->get();
        $page_title = "Danh sách trạng thái đơn hàng";
        return view('admin.status.list')->with('status', $result)->with('page_title', $page_title);
        //return view('admin.index')->with('admin.category.list', $categories);
    }
}
