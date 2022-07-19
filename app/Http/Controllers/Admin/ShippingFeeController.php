<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

session_start();

class ShippingFeeController extends Controller
{
    public function list(Request $request) {
        if(empty(Session::has('username'))) {
            return redirect('admin/login');
        }

        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 21)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền hiển thị danh sách phí vận chuyển');
            return redirect('admin/index');
        }

        $result = DB::table('transport')->get();
        if($result) {
            $page_title = 'Phí vận chuyển';
            return view('admin.shippingFee.list')->with('transports', $result)->with('page_title', $page_title);
        }
    }

    public function edit(Request $request, $fee_id) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 23)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền cập nhật phí vận chuyển');
            return redirect('admin/index');
        }

        $result = DB::table('transport')->where('id', $fee_id)->first();
        if ($result) {
            $page_title = 'Cập nhật phí vận chuyển';
            return view('admin.shippingFee.edit')->with('transport', $result)->with('page_title', $page_title);
        }
    }

    public function update(Request $request, $fee_id) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 23)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền cập nhật phí vận chuyển');
            return redirect('admin/index');
        }

        if ($fee_id != 50) {
            if ($request->price >= 19000) {
                $transport = DB::table('transport')->where('id', $fee_id)->first();
                $province = DB::table('province')->where('id', $transport->province_id)->first();
                $result = DB::table('transport')->where('id', $fee_id)->update(['price' => $request->price]);
                $request->session()->put('message', 'Cập nhật phí vận chuyển tại '.$province->name.' thành công');
                return redirect('admin/shippingFee/list');
            }
            $request->session()->put('error', 'Phí vận chuyển thấp nhất 19,000 đồng');
        }
        $request->session()->put('error', 'Mặc định phí vận chuyển TP.HCM không thể đổi');
        return redirect('admin/shippingFee/list');
    }
}