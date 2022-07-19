<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cart;
use Illuminate\Support\Facades\Session;

session_start();

class CartController extends Controller
{
    public function add(Request $request, $product_id) {
        $product = DB::table('product')->where('id', $product_id)->first();
        if ($product->inventory_qty != 0) {
            $oldCart = Session('cart') ? Session('cart') : null;
            $newCart = new Cart($oldCart);

            // if ($request->session()->has('error')) {
            //     return view('customer.layout.cart')->with('error', Session::get('error'));
            // }
            $newCart->AddCart($product, $product_id);

            $request->session()->put('cart', $newCart);
        }
        
        return view('customer.layout.cart')->with('newCart', $newCart);
    }

    public function delete(Request $request, $product_id) {
        $oldCart = Session('cart') ? Session('cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->DeleteItemCart($product_id);

        if (count($newCart->products) > 0) {
            $request->session()->put('cart', $newCart);
        }
        else {
            $request->session()->forget('cart', $newCart);
        }

        return view('customer.layout.cart')->with('newCart', $newCart);
    }

    public function update(Request $request, $product_id, $qty) {
        $product = DB::table('product')->where('id', $product_id)->first();
        $oldCart = Session('cart') ? Session('cart') : null;
        $newCart = new Cart($oldCart);
        if ($qty > $product->inventory_qty) {
            return view('customer.layout.cart')->with('error', 'Không thể mua nhiều hơn');
        }
        $newCart->UpdateCart($product, $product_id, $qty);
        $request->session()->put('cart', $newCart);
        
        return view('customer.layout.cart');
    }
}
