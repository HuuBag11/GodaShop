<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

session_start();

class OrderController extends Controller
{
    public function list(Request $request) {
        if (empty(Session::has('username'))) {
            return redirect('admin/login');
        }

        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 9)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền hiển thị danh sách đơn hàng');
            return redirect('admin/index');
        }

        $result = DB::table('order')->get();
        $page_title = "Danh sách đơn hàng";
        if($result){            
            return view('admin.order.list')->with('orders', $result)->with('page_title', $page_title);
        }
    }

    public function confirm(Request $request, $order_id) {
        $staff = DB::table('staff')->where('username', session()->get('username'))->first();
        $result = DB::table('order')->where('id', $order_id)->update(['order_status_id' => 2, 'staff_id' => $staff->id]);
        if($result) {
            $request->session()->put('message', 'Xác nhận thành công đơn hàng có MÃ: '.$order_id);
            return redirect('admin/order/list');
        }
    }

    public function delete(Request $request, $order_id) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 12)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền xóa đơn hàng');
            return redirect('admin/index');
        }

        $qr = DB::table('order_item')->where('order_id', $order_id)->delete();
        $result = DB::table('order')->where('id', $order_id)->delete();
        $request->session()->put('message', 'Xóa thành công đơn hàng có MÃ: '.$order_id);
        return redirect('admin/order/list');
    }

    public function detail(Request $request, $order_id) {
        $result = DB::table('order_item')->where('order_id', $order_id)->get();
        if($result) {
            return view('admin.order.detail')->with('orders', $result)->with('order_id', $order_id);
        }
    }
}
