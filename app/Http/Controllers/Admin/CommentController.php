<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

session_start();

class CommentController extends Controller
{
    public function list(Request $request) {
        if (empty(Session::has('username'))) {
            return redirect('admin/login');
        }
        
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 45)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền hiển thị danh sách đánh giá');
            return redirect('admin/index');
        }

        $result = DB::table('product')->get();
        $page_title = "Danh sách đánh giá";
        return view('admin.comment.list')->with('products', $result)->with('page_title', $page_title);
    }

    public function detail($product_id) {
        $page_title = "Chi tiết đánh giá";
        $result = DB::table('comment')->where('product_id', $product_id)->get();
        return view('admin.comment.detail')->with('comments', $result)->with('product_id', $product_id)->with('page_title', $page_title);
    }

    public function delete(Request $request, $product_id, $comment_id) {
        $result = DB::table('comment')->where('id', $comment_id)->delete();
        if ($result) {
            $request->session()->put('message', 'Xóa đánh giá thành công');
            return redirect('admin/comment/detail/'.$product_id);
        }
    }
}
