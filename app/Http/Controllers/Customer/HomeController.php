<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cart;

session_start();

class HomeController extends Controller
{
    public function index() {
        $featured = DB::table('product')->where('inventory_qty', '!=', 0)->where('featured', 1)->limit(4)->get();
        $lastest_products = DB::table('product')->where('inventory_qty', '!=', 0)->orderBy('created_date', 'desc')->limit(4)->get();
        return view('customer/index')
        ->with('featured_products', $featured)
        ->with('lastest_products', $lastest_products);
    }
}
