<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cart;

session_start();

class ProductController extends Controller
{
    public function list(Request $request, $category_id = null) {
        $products = DB::table('product')->where('inventory_qty', '!=', 0);
        // $total_products = DB::table('product')->where('inventory_qty', '!=', 0)->get();

        if ($category_id != null) {
            $products = DB::table('product')
            ->where('category_id', $category_id)->where('inventory_qty', '!=', 0);
            // $total_products = DB::table('product')->where('inventory_qty', '!=', 0)->where('category_id', $category_id)->get();
        }

        
        $categories = DB::table('category')->where('active', '!=', 0)->get();


        if (!empty($request->get('sort'))) {
            $tmp = explode('-', $request->get('sort'));
            $column = $tmp[0];
            $map = ['price' => 'price', 'created' => 'created_date', 'alpha' => 'name'];
            $real_column = $map[$column];
            $sort_type = $tmp[1];
            $data = $products->orderBy($real_column, $sort_type);
        }

        if (!empty($request->get('price-range'))) {
            $tmp = explode('-', $request->get('price-range'));
            $start = $tmp[0];
            $end = $tmp[1];
            if ($end == 'greater') {
                $data = $products->where('price', '>=', $start);
            }
            else {
                $data = $products->whereBetween('price', [$start, $end]);
            }
        }

        $data = $products->paginate(6)->appends(request()->query());

        return view('customer.product.list')
        ->with('data', $data)
        ->with('categories', $categories);
    }

    public function detail($product_id) {
        $result = DB::table('product')->where('id', $product_id)->first();
        $comments = DB::table('comment')->where('product_id', $product_id)->orderBy('created_date', 'desc')->get();
        $categories = DB::table('category')->where('active', '!=', 0)->get();
        $relatedProducts = DB::table('product')->where('category_id', $result->category_id)->get();
        return view('customer.product.detail')
        ->with('product', $result)
        ->with('comments', $comments)
        ->with('categories', $categories)
        ->with('relatedProducts', $relatedProducts);
    }

    public function addComment(Request $request, $product_id) {
        $categories = DB::table('category')->where('active', '!=', 0)->get();
        $qr = DB::table('comment')->insert([
            'product_id' => $product_id,
            'email' => $request->get('email'),
            'fullname' => $request->get('fullname'),
            'star' => $request->get('rating'),
            'description' => $request->get('description'),
            'created_date' => date('Y-m-d H-i-s'),
        ]);
        $comments = DB::table('comment')->where('product_id', $product_id)->get();
        $product_star = 0;
        $count = 0;
        foreach ($comments as $comment) {
            $product_star += $comment->star;
            $count++;
        }
        if ($count != 0) {
            $product_star /= $count;
        }
        else {
            $product_star = 0;
        }
        if ($product_star > 4.7) {
            $star = 5;
        }
        else if ($product_star > 4.2) {
            $star = 4.5;
        }
        else if ($product_star > 3.7) {
            $star = 4;
        }
        else if ($product_star > 3.2) {
            $star = 3.5;
        }
        else if ($product_star > 2.7) {
            $star = 3;
        }
        else if ($product_star > 2.2) {
            $star = 2.5;
        }
        else if ($product_star > 1.7) {
            $star = 2;
        }
        else if ($product_star > 1.2) {
            $star = 1.5;
        }
        else if ($product_star > 0.7) {
            $star = 1;
        }
        else if ($product_star > 0.2) {
            $star = 0.5;
        }
        else {
            $star = 0;
        }
        DB::table('product')->where('id', $product_id)->update(['star' => $star]);
        return redirect('/product/detail/'.$product_id);
    }
}
