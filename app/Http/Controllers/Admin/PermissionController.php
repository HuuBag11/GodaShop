<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

session_start();

class PermissionController extends Controller
{
    public function listRole(Request $request) {
        if (empty(Session::has('username'))) {
            return redirect('admin/login');
        }

        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 41)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền thêm vai trò');
            return redirect('admin/index');
        }

        $result = DB::table('role')->orderBy('id', 'asc')->get();
        $page_title = "Danh sách vai trò";
        if(count($result) > 0){            
            return view('admin.permission.listRole')->with('roles', $result)->with('page_title', $page_title);
        }
    }

    public function editRole(Request $request, $id) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 43)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền cập nhật vai trò');
            return redirect('admin/index');
        }

        $result = DB::table('role')->where('id', $id)->first();
        $page_title = "Cập nhật vai trò";
        if($result){            
            return view('admin.permission.editRole')->with('role', $result)->with('page_title', $page_title);
        }
    }

    public function updateRole(Request $request, $id) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 43)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền cập nhật vai trò');
            return redirect('admin/index');
        }

        if ($request->fullname) {
            $data = $request->fullname;
            DB::table('role')->where('id', $id)->update(['name' => $data]);
            $request->session()->put('message', 'Cập nhật vai trò thành công');
            return redirect('admin/permission/listRole');
        }
        else {
            $request->session()->put('error', 'Vui lòng nhập tên vài trò');
            return redirect('admin/permission/editRole/'.$role_id);
        }
    }

    public function addRole(Request $request) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 42)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền thêm vai trò');
            return redirect('admin/index');
        }

        $page_title = "Thêm vai trò";
        return view('admin.permission.addRole')->with('page_title', $page_title);
    }

    public function saveRole(Request $request) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 42)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền thêm vai trò');
            return redirect('admin/index');
        }

        if ($request->fullname) {
            $data = $request->fullname;
            DB::table('role')->insert(['name' => $data]);
            $request->session()->put('message', 'Thêm vai trò thành công');
            return redirect('admin/permission/listRole');
        }
        else {
            $request->session()->put('error', 'Vui lòng nhập tên vài trò');
            return redirect('admin/permission/addRole');
        }
    }

    public function deleteRole(Request $request, $role_id) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 44)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền xóa vai trò');
            return redirect('admin/index');
        }

        $result = DB::table('role')->where('id', $role_id)->delete();
        if ($result) {
            $request->session()->put('message', 'Xóa vai trò thành công');
            return redirect('admin/permission/listRole');
        }
    }
    
    public function listAction(Request $request) {
        $result = DB::table('action')->get();
        $page_title = 'Danh sách tác vụ';
        if(count($result) > 0){            
            return view('admin.permission.listAction')->with('actions', $result)->with('page_title', $page_title);
        }
    }

    public function listRoleAction(Request $request, $role_id) {
        $result = DB::table('role_action')->where('role_id', $role_id)->get();
        $actions = DB::table('action')->get();
        $role = DB::table('role')->where('id', $role_id)->first();
        $page_title = 'Tác vụ';
        // if(count($result) > 0){            
            
        // }
        return view('admin.permission.listRoleAction')
        ->with('actions', $actions)
        ->with('role', $role)
        ->with('roleActions', $result)->with('page_title', $page_title);
    }

    public function updateRoleAction(Request $request, $id) {
        $id_login = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $id_login)->where('action_id', 43)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền cập nhật vai trò');
            return redirect('admin/index');
        }

        $action_ids = $request->get('action_ids');
        // dd($action_ids);
        DB::table('role_action')->where('role_id', $id)->delete();
        foreach($action_ids as $action_id) {
            $data = [];
            $data['action_id'] = $action_id;
			$data['role_id'] = $id;
            
            DB::table('role_action')->insert([
                'role_id' => $data['role_id'],
                'action_id' => $data['action_id'],
            ]);
        }

        $request->session()->put('message', 'Cập nhật vai trò thành công');
        return redirect('admin/permission/listRole');
    }
}
