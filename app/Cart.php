<?php
namespace App;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class Cart {
    public $products = null;
	public $total_price;
	public $total_product_number;

    public function __construct($cart) {
        if ($cart) {
            $this->products = $cart->products;
            $this->total_price = $cart->total_price;
            $this->total_product_number = $cart->total_product_number;
        }
    }
    
    public function AddCart($product, $id) {
        $price = $product->price;
        if ($product->discount_percentage != 0) {
            $price = $product->price - $product->price * $product->discount_percentage / 100;
        }
        $newProduct = ['qty' => 0, 'price' => $price, 'productInfo' => $product];
        if ($this->products) {
            if (array_key_exists($id, $this->products)) {
                $newProduct = $this->products[$id];
            }
        }
        if ($product->inventory_qty > $newProduct['qty']){
            $newProduct['qty']++;
            $newProduct['price'] = $newProduct['qty'] * $price;
            $this->products[$id] = $newProduct;
            $this->total_price += $price;
            $this->total_product_number++;
        }
        Session::put('error', 'Không thể mua nhiều hơn');
        
    }

    public function DeleteItemCart($id) {
        $this->total_product_number -= $this->products[$id]['qty'];
        $this->total_price -= $this->products[$id]['price'];
        unset($this->products[$id]);
    }

    public function UpdateCart($product, $id, $qty) {
        $price = $product->price;
        if ($product->discount_percentage != 0) {
            $price = $product->price - $product->price * $product->discount_percentage / 100;
        }

        $this->total_product_number -= $this->products[$id]['qty'];
        $this->total_price -= $this->products[$id]['price'];

        $this->products[$id]['qty'] = $qty;
        $this->products[$id]['price'] = $qty * $price;

        $this->total_product_number += $this->products[$id]['qty'];
        $this->total_price += $this->products[$id]['price'];
    }
}
?>