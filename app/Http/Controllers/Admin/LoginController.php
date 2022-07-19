<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

session_start();

class LoginController extends Controller
{
    public function index() {
        if (empty(Session::has('username'))) {
            return view('admin.login');
        }
        
        return redirect('admin/index');
    }

    public function checkLogin(Request $request) {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request->username;
        $password = md5($request->password);

        $result = DB::table('staff')->where('username', $username)->where('password', $password)->first();
        if ($result) {
            if ($result->is_active == 0) {
                return view('admin.login')->with('error', 'Tài khoản bị vô hiệu hóa!');
            }
            // Session::put('username', $username);
            // Session::put('name', $result->name);
            $request->session()->put('role_id', $result->role_id);
            $request->session()->put('username', $username);
            $request->session()->put('name', $result->name);
            return redirect('admin/index');
        }
        else {
            return view('admin.login')->with('error', 'Đăng nhập thất bại!');
        }
        
    }

    public function logout() {
        Session::flush();
        return redirect('admin/login');
    }
}
