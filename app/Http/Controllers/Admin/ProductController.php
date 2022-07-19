<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;


session_start();

class ProductController extends Controller
{
    public function list(Request $request) {
        if (empty(Session::has('username'))) {
            return redirect('admin/login');
        }

        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 1)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền hiển thị danh sách sản phẩm');
            return redirect('admin/index');
        }

        $result = DB::table('product')->orderBy('discount_percentage', 'desc')->orderBy('id', 'desc')->get();
        $page_title = "Danh sách sản phẩm";
        if($result){            
            return view('admin.product.list')->with('products', $result)->with('page_title', $page_title);
        }
    }

    public function edit(Request $request, $product_id) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 3)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền cập nhật sản phẩm');
            return redirect('admin/index');
        }

        $result = DB::table('product')->where('id', $product_id)->first();
        $page_title = "Cập nhật sản phẩm";
        if($result){            
            return view('admin.product.edit')->with('product', $result)->with('page_title', $page_title);
        }
    }

    public function update(Request $request, $product_id) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 3)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền cập nhật sản phẩm');
            return redirect('admin/index');
        }

        $this->validate($request, [
            'barcode' => 'required|numeric',
            'name' => 'required',
            'price' => 'required|numeric|gt:0',
            'image' => 'required|image'
        ],
        [
            'barcode.required' => 'Vui lòng nhập barcode',
            'barcode.numeric' => 'Barcode phải là số',
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'price.required' => 'Vui lòng nhập giá thành',
            'price.numeric' => 'Giá thành phải là số',
            'image.required' => 'Vui lòng chọn hình ảnh sản phẩm',
            'image.image' => 'Vui lòng chỉ chọn hình ảnh',
        ]);

        $qr = DB::table('product')->where('id', $product_id)->first();
        $oldImg = 'upload/'.$qr->featured_image;
        
        $data = array();
        $data['barcode'] = $request->barcode;
        $data['sku'] = $request->sku;
        $data['name'] = $request->name;
        $data['price'] = $request->price;
        $data['discount_percentage'] = $request->discount_percentage;
        $data['discount_from_date'] = $request->discount_from_date;
        $data['discount_to_date'] = $request->discount_to_date;
        $data['inventory_qty'] = $request->inventory_qty;
        $data['featured'] = $request->featured;
        $data['category_id'] = $request->category;
        $data['brand_id'] = $request->brand;
        $data['description'] = $request->description;
        // chưa fix hình
        if ($data['name'] != null || $data['category_id'] != null || $data['brand_id'] != null) {
            $result = DB::table('product')->where('id', $product_id)->update([
                'sku' => $data['sku'],
                'barcode' => $data['barcode'],
                'name' => $data['name'],
                'price' => $data['price'],
                'discount_percentage' => $data['discount_percentage'],
                'discount_from_date' => $data['discount_from_date'],
                'discount_to_date' => $data['discount_to_date'],
                'inventory_qty' => $data['inventory_qty'],
                'featured' => $data['featured'],
                'category_id' => $data['category_id'],
                'brand_id' => $data['brand_id'],
                'description' => $data['description']
            ]);

            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = $image->hashName();
                $result = DB::table('product')->where('id', $product_id)->update([
                    'featured_image' => $image_name,
                ]);
                $image->move(public_path('upload'), $image_name);
                
                File::delete($oldImg);  
            }
            
            if ($result) {
                $request->session()->put('message', 'Cập nhật sản phẩm thành công');
                return redirect('admin/product/edit/'.$product_id);
            }
        }
        else {
            $request->session()->put('error', 'Vui lòng nhập đầy đủ dữ liệu');
            return redirect('admin/product/edit/'.$product_id);
        }
    }

    public function add(Request $request) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 2)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền thêm sản phẩm');
            return redirect('admin/index');
        }

        $categories = DB::table('category')->get();
        $brands = DB::table('brand')->get();
        $page_title = "Thêm sản phẩm";
        return view('admin.product.add')
        ->with('categories', $categories)
        ->with('brands', $brands)
        ->with('page_title', $page_title);
    }

    public function save(Request $request) {
        $role_id = $request->session()->get('role_id');
        $result = DB::table('role_action')->where('role_id', $role_id)->where('action_id', 2)->first();
        if (empty($result)) {
            $request->session()->put('error', 'Bạn không có quyền thêm sản phẩm');
            return redirect('admin/index');
        }

        $this->validate($request, [
            'barcode' => 'required|numeric',
            'name' => 'required',
            'price' => 'required|numeric|gt:0',
            'image' => 'required|image'
        ],
        [
            'barcode.required' => 'Vui lòng nhập barcode',
            'barcode.numeric' => 'Barcode phải là số',
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'price.required' => 'Vui lòng nhập giá thành',
            'price.numeric' => 'Giá thành phải là số',
            'image.required' => 'Vui lòng chọn hình ảnh sản phẩm',
            'image.image' => 'Vui lòng chỉ chọn hình ảnh',
        ]);


        $barcode = $request->barcode;
        $name = $request->name;
        $price = $request->price;
        $category = $request->category;
        $brand = $request->brand;
        $image = $request->file('image');
        $image_name = $image->hashName();
        

        $er_barcode = DB::table('product')->where('barcode', $barcode)->first();

        if ($er_barcode) {
            $request->session()->put('error', 'Barcode đã tồn tại');
            return redirect('admin/product/add');
        }
        
        $result = DB::table('product')->insert([
            'sku' => $request->sku,
                'barcode' => $barcode,
                'name' => $name,
                'price' => $price,
                'featured_image' => $image_name,
                'discount_percentage' => $request->discount_percentage,
                'discount_from_date' => $request->discount_from_date,
                'discount_to_date' => $request->discount_to_date,
                'inventory_qty' => $request->inventory_qty,
                'featured' => $request->featured,
                'category_id' => $request->category,
                'brand_id' => $request->brand,
                'created_date' => date('Y-m-d H:i:s'),
                'featured' => $request->featured,
                'description' => $request->description
        ]);

        if ($result) {
            $image->move(public_path('upload'), $image_name);
            $request->session()->put('message', 'Thêm sản phẩm mới thành công');
            return redirect('admin/product/list');
        }
        else {
            $request->session()->put('error', 'Lỗi lỗi');
            return redirect('admin/product/add');
        }
    }
}
