<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cart;
use Illuminate\Support\Facades\Session;

session_start();

class PaymentController extends Controller
{
    public function checkout() {
        if (empty(Session::has('customer_name'))) {
            return redirect("/")->with('alert', 'Vui lòng đăng nhập để mua hàng');
        }

        if (empty(Session::has('cart'))) {
            return redirect("/")->with('alert', 'Bạn chưa chọn sản phẩm để mua hàng');
        }

        $qr = DB::table('customer')->where('id', Session::get('customer_id'))->first();
        $provinces = DB::table('province')->get();
        $districts = DB::table('district')->get();
        $wards = DB::table('ward')->get();
        return view('customer.payment.checkout')
        ->with('qr', $qr)
        ->with('provinces', $provinces)
        ->with('districts', $districts)
        ->with('wards', $wards);
    }

    public function confirm(Request $request) {
        return view('customer.payment.confirm');
    }
    
    public function finish(Request $request) {
        $customer_id = DB::table('customer')->where('id', Session::get('customer_id'))->first();
        $qr = DB::table('order')->insert([
            'created_date' => date('Y-m-d H-i-s'),
            'order_status_id' => 1,
            'customer_id' => Session::get('customer_id'),
            'shipping_fullname' => $request->get('shipping_name'),
            'shipping_mobile' => $request->get('shipping_mobile'),
            'payment_method' => $request->get('payment-method'),
            'shipping_ward_id' => $customer_id->ward_id,
            'shipping_housenumber_street' => $request->get('shipping_name'),
            'shipping_fee' => $request->get('shipping_fee'),
        ]);
        if ($qr) {
            $order = DB::table('order')->where('customer_id', Session::get('customer_id'))->orderBy('created_date', 'desc')->first();
            
            $oldCart = Session('cart') ? Session('cart') : null;
            $newCart = new Cart($oldCart);

            foreach (Session::get('cart')->products as $item) {
                $product = DB::table('product')->where('id', $item['productInfo']->id)->first();

                DB::table('order_item')->insert([
                    'product_id' => $item['productInfo']->id,
                    'order_id' => $order->id,
                    'qty' => $item['qty'],
                    'unit_price' => $item['price'],
                    'total_price' => $item['qty'] * $item['price'],
                ]);

                DB::table('product')->update([
                    'inventory_qty' => $product->inventory_qty - $item['qty']
                ]);
                
                $newCart->DeleteItemCart($item['productInfo']->id);

                if (count($newCart->products) > 0) {
                    $request->session()->put('cart', $newCart);
                }
                else {
                    $request->session()->forget('cart', $newCart);
                }
            }
            
            return redirect('/')->with('alert', 'Đặt hàng thành công');
        }
        
    }
}
