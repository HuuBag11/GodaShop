<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

session_start();

class DashboardController extends Controller
{
    public function index() {
        if (empty(Session::has('username'))) {
            return view('admin.login');
        }
        $from_date = date("Y-m-d")." 00:00:00";
        $to_date = date("Y-m-d")." 23:59:59";
        $result = DB::table('order')->whereBetween('created_date', [$from_date, $to_date])->get();
        if ($result) {
            return view('admin.index')->with('orders', $result);
        }
        return view('admin.index');
    }

    public function datetime(Request $request, $datetime) {
        switch ($datetime) {
            case 'today': {
                $from_date = date("Y-m-d")." 00:00:00";
                $to_date = date("Y-m-d")." 23:59:59";
                $result = DB::table('order')->whereBetween('created_date', [$from_date, $to_date])->get();
                if ($result) {
                    return view('admin.index')->with('orders', $result);
                }
                break;
            }
            case 'yesterday': {
                $from_date = date("Y-m-d", strtotime('-1 day'))." 00:00:00";
                $to_date = date("Y-m-d", strtotime('-1 day'))." 23:59:59";
                $result = DB::table('order')->whereBetween('created_date', [$from_date, $to_date])->get();
                if ($result) {
                    return view('admin.index')->with('orders', $result);
                }
                break;
            }
            case 'week': {
                $from_date = date("Y-m-d", strtotime('this week'))." 00:00:00";
                $to_date = date("Y-m-d")." 23:59:59";
                $result = DB::table('order')->whereBetween('created_date', [$from_date, $to_date])->get();
                if ($result) {
                    return view('admin.index')->with('orders', $result);
                }
                break;
            }
            case 'month': {
                $from_date = date("Y-m-1")." 00:00:00";
                $to_date = date("Y-m-d")." 23:59:59";
                $result = DB::table('order')->whereBetween('created_date', [$from_date, $to_date])->get();
                if ($result) {
                    return view('admin.index')->with('orders', $result);
                }
                break;
            }
            case '3months': {
                $from_date = date("Y-m-d", strtotime('-3 months'))." 00:00:00";
                $to_date = date("Y-m-d")." 23:59:59";
                $result = DB::table('order')->whereBetween('created_date', [$from_date, $to_date])->get();
                if ($result) {
                    return view('admin.index')->with('orders', $result);
                }
                break;
            }
            case 'year': {
                $from_date = date("Y-1-1")." 00:00:00";
                $to_date = date("Y-m-d")." 23:59:59";
                $result = DB::table('order')->whereBetween('created_date', [$from_date, $to_date])->get();
                if ($result) {
                    return view('admin.index')->with('orders', $result);
                }
                break;
            }
            case 'custom': {
                $from_date = $request->from_date;
                $to_date = $request->to_date;
                if ($from_date > $to_date) {
                    $tmp = $to_date;
                    $to_date = $from_date;
                    $from_date = $tmp;
                }
                $result = DB::table('order')->whereBetween('created_date', [$from_date." 00:00:00", $to_date." 23:59:59"])->get();
                if ($result) {
                    return view('admin.index')->with('orders', $result)->with('from_date', $from_date)->with('to_date', $to_date);
                }
                break;
            }
            default: {
                $from_date = date("Y-m-d")." 00:00:00";
                $to_date = date("Y-m-d")." 23:59:59";
                $result = DB::table('order')->whereBetween('created_date', [$from_date, $to_date])->get();
                if ($result) {
                    return view('admin.index')->with('orders', $result);
                }          
                return view('admin.index');
            }
        }
    }
}