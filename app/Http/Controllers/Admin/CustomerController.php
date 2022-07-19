<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

session_start();

class CustomerController extends Controller
{
    public function list(Request $request) {
        if (empty(Session::has('username'))) {
            return redirect('admin/login');
        }

        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 13)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền hiển thị danh sách khách hàng');
            return redirect('admin/index');
        }

        $result = DB::table('customer')->get();
        $page_title = "Danh sách khách hàng";
        if($result){            
            return view('admin.customer.list')->with('customers', $result)->with('page_title', $page_title);
        }
    }

    public function delete(Request $request, $customer_id) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 16)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền xóa khách hàng');
            return redirect('admin/index');
        }

        $delete = DB::table('customer')->where('id', $customer_id)->delete();
        $request->session()->put('message', 'Xóa khách hàng thành công');
        return redirect('admin/customer/list');
    }
}
