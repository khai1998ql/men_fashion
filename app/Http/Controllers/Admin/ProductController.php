<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Response;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function product(){
        $products = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
            ->select('products.*', 'categories.category_name', 'subcategories.subcategory_name')
            ->get();
        return view('admin.product.index', compact('products'));
    }
    public function addProduct(){
        $categories = DB::table('categories')->get();
        return view('admin.product.add', compact('categories'));
    }
    public function getSubCategory($id_category){
        $subcategories = DB::table('subcategories')->where('category_id', $id_category)->get();
        return response()->json(array(
            'subcategories' => $subcategories,
        ));
    }
    public function createProduct(Request $request){
        $rules = [
            'product_name' => 'required|unique:products|min:2|max:255|',
            'product_code' => 'required|unique:products|min:2|max:255|',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'product_price' => 'required|numeric|min:1',
            'discount_price' => 'numeric|min:0|max:99',
            'product_avatar' => 'required',
            'product_content' => 'required',
        ];
        $messages = [
            'product_name.required' => 'Tên sản phẩm không được bỏ trống!',
            'product_name.unique' => 'Tên sản phẩm ":input" đã tồn tại!',
            'product_name.min' => 'Tên sản phẩm phải lớn hơn :min kí tự!',
            'product_name.max' => 'Tên sản phẩm không được vượt quá :max kí tự!',

            'product_code.required' => 'Mã sản phẩm không được bỏ trống!',
            'product_code.unique' => 'Mã sản phẩm ":input" đã tồn tại!',
            'product_code.min' => 'Mã sản phẩm phải lớn hơn :min kí tự!',
            'product_code.max' => 'Mã sản phẩm không được vượt quá :max kí tự!',

            'category_id.required' => 'Chọn danh mục sản phẩm!',

            'subcategory_id.required' => 'Chọn danh mục con sản phẩm!',

            'product_price.required' => 'Giá sản phẩm không được bỏ trống!',
            'product_price.numeric' => 'Giá sản phẩm phải là chữ số!',
            'product_price.min' => 'Giá sản phẩm phải lớn hơn :min!',

            'discount_price.numeric' => 'Giảm giá sản phẩm phải là chữ số!',
            'discount_price.min' => 'Giảm giá sản phẩm phải lớn hơn :min!',
            'discount_price.max' => 'Giảm giá sản phẩm phải nhỏ hơn :max!',

            'product_avatar.required' => 'Avatar sản phẩm không được bỏ trống!',

            'product_content.required' => 'Nội dung sản phẩm không được bỏ trống!',
        ];
        $this->validate($request, $rules, $messages);
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['slug_product_name'] = to_slug($request->product_name);
        $data['product_code'] = $request->product_code;
        $data['category_id'] = $request->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['product_price'] = $request->product_price;
        $data['discount_price'] = $request->discount_price;
        $data['product_content'] = $request->product_content;
        $data['product_color_name'] = $request->product_color_name;
        $data['hot_deal'] = $request->hot_deal;
        $data['hot_new'] = $request->hot_new;
        $data['trend'] = $request->trend;
//        dd($data);
        $data_detail = array();
        for($i = 1; $i <=30; $i++){

            $detail = 'detail' . $i;
            $detail_value[$i] = $request->$detail;
            if(!empty($request->$detail)){
                $detail_ex[$i] = explode(',', $detail_value[$i]);
                foreach ($detail_ex as $item){
//                dd($item[2]);
                    $data_detail[$i]['product_color'] = $item[0];
                    $data_detail[$i]['product_size'] = $item[1];
                    $data_detail[$i]['product_qty'] = intval($item[2]);
                    $data_detail[$i]['slug_product_color'] = to_slug($item[0]);
                }
            }

        }
//        dd($data_detail);
        $product_avatar = $request->product_avatar;

        $product_avatar_name = to_slug($request->product_name) . '-avatar' . '.' . $product_avatar->getClientOriginalExtension();

        $product_avatar_url = 'public/backend/media/product/avatar/' . $product_avatar_name;
        Image::make($product_avatar)->resize(1280,1600)->save($product_avatar_url);
        $data['product_avatar'] = $product_avatar_url;
        // Hình ảnh sản phẩm
        $data_images = array();
        for($i = 1; $i <= 30; $i++){
            $product_image_stt = 'product_image_' . $i;
            if(!empty($request->$product_image_stt)){
                $product_image = $request->$product_image_stt;
                $product_image_name = to_slug($request->product_name) . '-' . $i . '.' . $product_image->getClientOriginalExtension();
                $product_image_url = 'public/backend/media/product/images/' . $product_image_name;
                Image::make($product_image)->resize(1280,1600)->save($product_image_url);
                $data_images[$i] = $product_image_url;
            }
        }
//        dd($data_images);
        $data['product_images_big'] = implode('|', $data_images);
        // Hình ảnh màu sản phẩm
        $data_images_color = array();
        $data_images_small = array();
        for($i = 1; $i <= 10; $i++){
            $product_image_color_stt = 'product_image_color_' . $i;
            if(!empty($request->$product_image_color_stt)){
                $product_image_color = $request->$product_image_color_stt;
                $product_image_color_name = to_slug($request->product_name) . '-color-' . $i . '.' . $product_image_color->getClientOriginalExtension();
                $product_image_color_url = 'public/backend/media/product/images_color/' . $product_image_color_name;
                Image::make($product_image_color)->resize(22,30)->save($product_image_color_url);
                $data_images_color[$i] = $product_image_color_url;

                $product_image_small_name = to_slug($request->product_name) . '-small-' . $i . '.' . $product_image_color->getClientOriginalExtension();
                $product_image_small_url = 'public/backend/media/product/images_small/' . $product_image_small_name;
                Image::make($product_image_color)->resize(1280,1600)->save($product_image_small_url);
                $data_images_small[$i] = $product_image_small_url;
            }
        }
//        dd($data_images);
        $data['product_image_color'] = implode('|', $data_images_color);
        $data['product_images_small'] = implode('|', $data_images_small);
//        dd($data);
        $id_product = DB::table('products')->insertGetId($data);
        foreach ($data_detail as $item){
            $item['product_id'] = $id_product;
            DB::table('product_detail')->insert($item);
        }
        $notification = array(
            'message' => 'Thêm sản phẩm thành công!',
            'alert-type' => 'success',
        );
        return Redirect::route('admin.product.index')->with($notification);
    }
    public function changeStatusProduct($id){
        $product =  DB::table('products')->where('id', $id)->first();
        $status = $product->product_status;
        $newStatus = ($status == 1) ? 0 : 1;
        $data = array(
            'product_status' => $newStatus,
        );
        DB::table('products')->where('id', $id)->update($data);

        $notification = array(
            'message' => 'Cập nhật trạng thái sản phẩm thành công!',
            'alert-type' => 'success',
        );
        return response()->json(array(
            'notification' => $notification,
        ));
    }
    public function deleteProduct($id){
        $product = DB::table('products')->where('id', $id)->first();
        $avatarUrl = $product->product_avatar;
        if(!empty($avatarUrl)){
            if(is_file ($avatarUrl)){
                unlink($avatarUrl);
            }
        }

        $product_images_big = $product->product_images_big;
        $imagesData = explode('|',$product_images_big);
        if(!empty($imagesData)){
            foreach ($imagesData as $item){
                if(is_file ($item)){
                    unlink($item);
                }
            }
        }
        $product_image_color = $product->product_image_color;
        $imagesColorData = explode('|',$product_image_color);
        if(!empty($imagesColorData)){
            foreach ($imagesColorData as $item){
                if(is_file ($item)){
                    unlink($item);
                }
            }
        }
        $product_images_small = $product->product_images_small;
        $imagesSmallData = explode('|',$product_images_small);
        if(!empty($imagesSmallData)){
            foreach ($imagesSmallData as $item){
                if(is_file ($item)){
                    unlink($item);
                }
            }
        }
        DB::table('product_detail')->where('product_id', $id)->delete();
        DB::table('products')->where('id', $id)->delete();

        $notification = array(
            'message' => 'Xóa sản phẩm thành công!',
            'alert-type' => 'success',
        );
        return Redirect::route('admin.product.index')->with($notification);
    }
    public function productDetail($id){
        $product = DB::table('products')
                ->join('categories', 'products.category_id', 'categories.id')
                ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
                ->select('products.*', 'categories.category_name', 'subcategories.subcategory_name')
                ->where('products.id', $id)
                ->first();
        $product_detail = DB::table('product_detail')->where('product_id', $id)->get();
        return view('admin.product.detail', compact('product', 'product_detail'));
    }
    public function editProduct($id){
        $product = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
            ->select('products.*', 'categories.category_name', 'subcategories.subcategory_name')
            ->where('products.id', $id)
            ->first();
        $categories = DB::table('categories')->get();
        $subcategories = DB::table('subcategories')->where('category_id', $product->category_id)->get();
        $product_detail = DB::table('product_detail')->where('product_id', $product->id)->get();
        return view('admin.product.edit', compact('product', 'categories', 'subcategories', 'product_detail'));
    }
    public function updateInfoProduct(Request $request){
        $id = $request->product_info;
        // Xử lý phần (màu,size,qty)
        $detailString = $request->detailString;
        $detailArray = explode(',', $detailString);
        $detailDelete = array();
        $detailNew = array();
        foreach ($detailArray as $key => $item){
            $detailId = 'detail' . $item;
            if(empty($request->$detailId)){
                $detailDelete[] = $item;
            }else{
                $detailNew[$item] = $request->$detailId;
            }
        }
//        dd($detailNew);

        $rules = [
            'product_name' => 'required|min:2|max:255|',
            'product_code' => 'required|min:2|max:255|',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'product_price' => 'required|numeric|min:1',
            'discount_price' => 'numeric|min:0|max:99',
            'product_content' => 'required',
        ];
        $messages = [
            'product_name.required' => 'Tên sản phẩm không được bỏ trống!',
            'product_name.min' => 'Tên sản phẩm phải lớn hơn :min kí tự!',
            'product_name.max' => 'Tên sản phẩm không được vượt quá :max kí tự!',

            'product_code.required' => 'Mã sản phẩm không được bỏ trống!',
            'product_code.min' => 'Mã sản phẩm phải lớn hơn :min kí tự!',
            'product_code.max' => 'Mã sản phẩm không được vượt quá :max kí tự!',

            'category_id.required' => 'Chọn danh mục sản phẩm!',

            'subcategory_id.required' => 'Chọn danh mục con sản phẩm!',

            'product_price.required' => 'Giá sản phẩm không được bỏ trống!',
            'product_price.numeric' => 'Giá sản phẩm phải là chữ số!',
            'product_price.min' => 'Giá sản phẩm phải lớn hơn :min!',

            'discount_price.numeric' => 'Giảm giá sản phẩm phải là chữ số!',
            'discount_price.min' => 'Giảm giá sản phẩm phải lớn hơn :min!',
            'discount_price.max' => 'Giảm giá sản phẩm phải nhỏ hơn :max!',

            'product_content.required' => 'Nội dung sản phẩm không được bỏ trống!',
        ];
        $this->validate($request, $rules, $messages);

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['slug_product_name'] = to_slug($request->product_name);
        $data['product_code'] = $request->product_code;
        $data['category_id'] = $request->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['product_price'] = $request->product_price;
        $data['discount_price'] = $request->discount_price;
        $data['hot_deal'] = $request->hot_deal;
        $data['hot_new'] = $request->hot_new;
        $data['trend'] = $request->trend;
        $data['product_content'] = $request->product_content;
        DB::table('products')->where('id', $id)->update($data);

        foreach ($detailNew as $key => $item){
            $dataDetail = array();
            $dataVal = explode(',', $item);
            $dataDetail['product_color'] = $dataVal[0];
            $dataDetail['slug_product_color'] = to_slug($dataVal[0]);
            $dataDetail['product_size'] = $dataVal[1];
            $dataDetail['product_qty'] = intval($dataVal[2]);
//            dd($dataDetail);
            DB::table('product_detail')->where('id', $key)->update($dataDetail);
        }
        if(count($detailDelete) >0){
            foreach ($detailDelete as $item){
                DB::table('product_detail')->where('id', $item)->delete();
            }
        }
        $notification = array(
            'message' => 'Cập nhật thông tin sản phẩm thành công!',
            'alert-type' => 'success',
        );
        return Redirect::Route('admin.product.index')->with($notification);
    }
    public function updateDetailProduct(Request $request){
        $id = $request->productDetail;
        $detailString = array();
        for ($i =1; $i <= 30; $i++){
            $detail = 'detail' . $i;
            if(!empty($request->$detail)){
                $detailString[] = $request->$detail;
            }
        }
        if(count($detailString) > 0){
            foreach ($detailString as $item){
                $dataDetail = explode(',', $item);
                $data = array();
                $data['product_id'] = $id;
                $data['product_color'] = $dataDetail[0];
                $data['slug_product_color'] = to_slug($dataDetail[0]);
                $data['product_size'] = $dataDetail[1];
                $data['product_qty'] = intval($dataDetail[2]);
                DB::table('product_detail')->insert($data);
            }
            $notification = array(
                'message' => 'Thêm chi tiết sản phẩm thành công!',
                'alert-type' => 'success',
            );
            return Redirect::Route('admin.product.index')->with($notification);
        }else{
            $notification = array(
                'message' => 'Thêm chi tiết sản phẩm thất bại!',
                'alert-type' => 'error',
            );
            return Redirect::Route('admin.product.index')->with($notification);
        }

    }
    public function updateImagesProduct(Request $request){
        $id = $request->idProduct;
        $urlAvatar = $request->idAvatar;
        $urlImages = $request->idImage;
        $urlImagesColor = $request->idImageColor;
        $urlImagesSmall = $request->idImageSmall;
        $data = array();
        if(!empty($request->product_avatar)){
            $product_avatar = $request->product_avatar;
            $product_avatar_name = to_slug($request->product_name) . '-avatar' . '.' . $product_avatar->getClientOriginalExtension();
            $product_avatar_url = 'public/backend/media/product/avatar/' . $product_avatar_name;
            Image::make($product_avatar)->resize(1280,1600)->save($product_avatar_url);
            $data['product_avatar'] = $product_avatar_url;
            if(is_file ($urlAvatar)){
                unlink($urlAvatar);
            }
        }
        $arrImages = array();
        $productImages = array();
        for($i = 1; $i <= 30; $i++){
            $product_ima = 'product_image_' . $i;
            if(!empty($request->$product_ima)){
                $product_image = $request->$product_ima;
                $product_image_name = to_slug($request->product_name) . '-' .$i . '.' . $product_image->getClientOriginalExtension();
                $product_image_url = 'public/backend/media/product/images/' . $product_image_name;
                Image::make($product_image)->resize(1280,1600)->save($product_image_url);
                $productImages[] = $product_image_url;
            }

        }

        if(count($productImages) > 0){
            $product_images_big = implode('|', $productImages);
            $data['product_images_big'] = $product_images_big;
            // xÓA ẢNH CŨ
            $oldImages = explode('|', $urlImages);
            foreach ($oldImages as $item){
                if(is_file ($item)){
                    unlink($item);
                }

            }
        }

        if(!empty($request->product_color_name)){
            $data['product_color_name'] = $request->product_color_name;
        }
        $productImagesColor = array();
        $productImagesSmall = array();
        for($i = 1; $i <= 10; $i++){
            $product_ima_color = 'product_image_color_' . $i;
            if(!empty($request->$product_ima_color)){
                $product_image_color = $request->$product_ima_color;
                $product_image_color_name = to_slug($request->product_name) . '-color-' .$i . '.' . $product_image_color->getClientOriginalExtension();
                $product_image_color_url = 'public/backend/media/product/images_color/' . $product_image_color_name;
                Image::make($product_image_color)->resize(22,30)->save($product_image_color_url);
                $productImagesColor[] = $product_image_color_url;

                $product_image_small_name = to_slug($request->product_name) . '-small-' .$i . '.' . $product_image_color->getClientOriginalExtension();
                $product_image_small_url = 'public/backend/media/product/images_small/' . $product_image_small_name;
                Image::make($product_image_color)->resize(1280,1600)->save($product_image_small_url);
                $productImagesSmall[] = $product_image_small_url;
            }

        }
        if(count($productImagesColor) > 0){
            $product_images_small = implode('|', $productImagesSmall);
            $data['product_images_small'] = $product_images_small;
            // xÓA ẢNH CŨ
            $oldImagesSmall = explode('|', $urlImagesSmall);
            foreach ($oldImagesSmall as $item){
                if(is_file ($item)){
                    unlink($item);
                }
            }

            $product_images_color = implode('|', $productImagesColor);
            $data['product_image_color'] = $product_images_color;
            // xÓA ẢNH CŨ
            $oldImagesColor = explode('|', $urlImagesColor);
            foreach ($oldImagesColor as $item){
                if(is_file ($item)){
                    unlink($item);
                }
            }
        }

        DB::table('products')->where('id', $id)->update($data);
        $notification = array(
            'message' => 'Cập nhật ảnh sản phẩm thành công!',
            'alert-type' => 'success',
        );
        return Redirect::Route('admin.product.index')->with($notification);
    }
}
