<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

session_start();

class LoginController extends Controller
{
    public function checkLogin(Request $request) {
        $email = $request->email;
        $password = md5($request->password);

        $result = DB::table('customer')
        ->where('email', $email)
        ->where('password', $password)->first();
        if ($result) {
            if ($result->is_active == 0) {
                return redirect()->back()->with('alert', 'Tài khoản bị vô hiệu hóa!');
            }
            // Session::put('username', $username);
            // Session::put('name', $result->name);
            $request->session()->put('customer_id', $result->id);
            $request->session()->put('customer_name', $result->name);
            return redirect('/')->with('error', 'Đăng nhập thành công!');
        }
        else {
            $error = $request->session()->put('error', 'Đăng nhập thất bại!');
            return redirect('/')->with('error', $error);
        }

    }

    public function logout() {
        Session::forget('customer_id');
        Session::forget('customer_name');
        // return redirect('/')->with('alert', 'Logout');
        return redirect('/');
    }

    public function register(Request $request) {
        $data = array();
        $data['name'] = $request->fullname;
        $data['mobile'] = $request->mobile;
        $data['email'] = $request->email;
        $data['password'] = md5($request->password);
        $data['re_password'] = md5($request->password_confirmation);
        // dd($data);
        $customer = DB::table('customer')->where('email', $data['email'])->first();
        if ($data['password'] == $data['re_password'] && !$customer) {
            $qr = DB::table('customer')->insert([
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'email' => $data['email'],
                'password' => $data['password'],
                'login_by' => 'form',
                'is_active' => '1',
                'shipping_name' => $data['name'],
                'shipping_mobile' => $data['mobile'],
            ]);
            return redirect('/')->with('error', 'Đăng ký thành công');
        }
        $error = $request->session()->put('error', 'Email đăng nhập đã tồn tại');
        return redirect('/');
    }

    public function shippingAdress(Request $request) {
        $categories = DB::table('category')->where('active', '!=', 0)->get();
        $qr = DB::table('customer')->where('id', Session::get('customer_id'))->first();
        $provinces = DB::table('province')->get();
        $districts = DB::table('district')->get();
        $wards = DB::table('ward')->get();

        return view('customer.layout.defaultShipping')
        ->with('qr', $qr)
        ->with('provinces', $provinces)
        ->with('districts', $districts)
        ->with('wards', $wards)
        ->with('categories', $categories);
    }

    public function updateShipping(Request $request) {
        $qr = DB::table('customer')->where('id', Session::get('customer_id'))->update([
            'shipping_name' => $request->get('fullname'),
            'shipping_mobile' => $request->get('mobile'),
            'housenumber_street' => $request->get('address')
        ]);
        $message = $request->session()->put('message', 'Cập nhật thành công');
        return redirect('/shipping-address')->with('message', $message);
    }

    public function myOrder(Request $request) {
        $categories = DB::table('category')->where('active', '!=', 0)->get();
        $qr = DB::table('order')->where('customer_id', Session::get('customer_id'))->get();
        return view('customer.layout.myorder')
        ->with('orders', $qr)
        ->with('categories', $categories);
    }

    public function myInfo(Request $request) {
        $categories = DB::table('category')->where('active', '!=', 0)->get();
        $qr = DB::table('customer')->where('id', Session::get('customer_id'))->first();
        return view('customer.layout.infomation')
        ->with('categories', $categories)
        ->with('customer', $qr);
    }

    public function updateInfo(Request $request) {
        $qr = DB::table('customer')->where('id', Session::get('customer_id'))->first();
        if ($qr->password == md5($request->get('current_password'))) {
            if ($request->get('password') != $request->get('current_password')) {
                if ($request->get('password') == $request->get('re-password')) {
                    $qr = DB::table('customer')->where('id', Session::get('customer_id'))->update([
                        'name' => $request->get('fullname'),
                        'mobile' => $request->get('mobile'),
                        'password' => md5($request->get('password'))
                    ]);
                    $request->session()->put('message-info', 'Cập nhật thành công');
                    return redirect('/my-info');
                }
                $request->session()->put('message-info', 'Mật khẩu mới và xác nhận không giống nhau!');
                return redirect('/my-info');
            }
            $request->session()->put('message-info', 'Mật khẩu mới trùng mật khẩu cũ!');
            return redirect('/my-info');
        }
        $request->session()->put('message-info', 'Sai mật khẩu!!!');
        return redirect('/my-info');
    }
}
