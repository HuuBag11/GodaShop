<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

session_start();

class StaffController extends Controller
{
    public function list(Request $request) {
        if(empty(Session::has('username'))) {
            return redirect('admin/login');
        }

        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 5)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền hiển thị danh sách nhân viên');
            return redirect('admin/index');
        }

        $result = DB::table('staff')->get();
        if($result) {
            $page_title = 'Danh sách nhân viên';
            return view('admin.staff.list')->with('staffs', $result)->with('page_title', $page_title);
        }
    }

    public function active(Request $request, $staff_id) {
        if(empty(Session::has('username'))) {
            return redirect('admin/login');
        }

        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 5)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền kích hoạt nhân viên');
            return redirect('admin/index');
        }
        
        $role_id = DB::table('staff')->where('id', $staff_id)->first();
        if ($role_id->role_id != 1) {
            if ($role_id->is_active == 0) {
                DB::table('staff')->where('id', $staff_id)->update(['is_active' => 1]);
                $request->session()->put('message', 'Kích hoạt thành công');
            }
            else {
                DB::table('staff')->where('id', $staff_id)->update(['is_active' => 0]);
                $request->session()->put('message', 'Vô hiệu hóa thành công');
            }
            return redirect('admin/staff/list');
        }
        return redirect('admin/staff/list');
    }

    public function add(Request $request) {
        if(empty(Session::has('username'))) {
            return redirect('admin/login');
        }

        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 6)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền tạo nhân viên');
            return redirect('admin/index');
        }

        $page_title = 'Tạo nhân viên';
        $result = DB::table('role')->get();
        return view('admin.staff.add')->with('roles', $result)->with('page_title', $page_title);
    }

    public function save(Request $request) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 6)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền tạo nhân viên');
            return redirect('admin/index');
        }

        $this->validate($request, [
            'fullname' => 'required',
            'username' => 'required',
            'password' => 'required',
            'mobile' => 'required',
            'email' => 'required',
        ]);
        $qr = DB::table('staff')
        ->where('username', $request->username)
        ->orWhere('email', $request->email)
        ->get();
        if (count($qr) == 0) {
            $result = DB::table('staff')->insert([
                'role_id' => $request->role_id,
                'name' => $request->fullname,
                'mobile' => $request->mobile,
                'username' => $request->username,
                'password' => md5($request->password),
                'email' => $request->email,
                'is_active' => $request->is_active,
            ]);
            if ($result) {
                $request->session()->put('message', 'Tạo nhân viên thành công');
                return redirect('admin/staff/list');
            }
        }
        $request->session()->put('error', 'Tên đăng nhập or email nhân viên bị trùng');
        $role = DB::table('role')->get();
        return redirect('admin/staff/add')->with('roles', $role);
    }
    
    public function edit(Request $request, $staff_id) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 7)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền cập nhật nhân viên');
            return redirect('admin/index');
        }

        $page_title = 'Cập nhật nhân viên';
        $staff = DB::table('staff')->where('id', $staff_id)->first();
        $roles = DB::table('role')->get();
        return view('admin.staff.edit')->with('staff', $staff)->with('roles', $roles)->with('page_title', $page_title);
    }

    public function update(Request $request, $staff_id) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 7)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền cập nhật nhân viên');
            return redirect('admin/index');
        }

        $this->validate($request, [
            'fullname' => 'required',
            'username' => 'required',
            'mobile' => 'required',
            'email' => 'required',
        ]);

        $staff = DB::table('staff')->where('id', $staff_id)->first();
        $roles = DB::table('role')->get();

        $username = $request->username;
        $email = $request->email;
        $qr = DB::table('staff')
        ->where('id', '!=', $staff_id)
        ->where(function ($query) use ($username, $email) {
            $query->where('username', $username)->orWhere('email', $email);
        })
        ->get();
        if (count($qr) > 0) {
            $request->session()->put('error', 'Tên đăng nhập or email nhân viên bị trùng');
            return redirect('admin/staff/edit/'.$staff_id)->with('staff', $staff)->with('roles', $roles);
        }
        else {
            $password = $staff->password;
            if ($request->password) {
                $password = md5($request->password);
            }

            $active = 0;
            if ($request->is_active) {
                $active = $request->is_active;
            }
            $result = DB::table('staff')->where('id', $staff_id)->update([
                'role_id' => $request->role_id,
                'name' => $request->fullname,
                'mobile' => $request->mobile,
                'username' => $request->username,
                'password' => $password,
                'email' => $request->email,
                'is_active' => $active,
            ]);
            $request->session()->put('message', 'Cập nhật nhân viên thành công');
            return redirect('admin/staff/list');
        }
        $request->session()->put('error', 'Tên đăng nhập or email nhân viên bị trùng');
        return redirect('admin/staff/edit/'.$staff_id)->with('staff', $staff)->with('roles', $roles);
    }
}
