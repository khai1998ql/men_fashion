<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Response;

class CategoryController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth:admin');
    }
    //    MENU
    public function menu(){
        $menu = DB::table('menu')->get();
        return view('admin.category.menu', compact('menu'));
    }
    public function createMenu(Request $request){
        $rules = [
            'menu_name' => 'required|unique:menu|max:55',
        ];
        $messages = [
            'menu_name.required' => 'Tên menu không được để trống!',
            'menu_name.unique' => 'Tên menu :input đã tồn tại!',
            'menu_name.max' => 'Tên menu lớn nhất :max kí tự!',
        ];
        $this->validate($request, $rules, $messages);
        $validate = $request->validate([
            'menu_name' => 'required|unique:menu|max:55',
        ]);
        $data = array();
        $data['menu_name'] = $request->menu_name;
        $data['slug_menu_name'] = to_slug($request->menu_name);
        DB::table('menu')->insert($data);
        $notification = array(
            'message' => 'Thêm menu thành công!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function deleteMenu($id){
        $category = DB::table('categories')->where('menu_id', $id)->get();
        if(count($category) == 0){
            DB::table('menu')->where('id', $id)->delete();
            $notification = array(
                'message' => 'Xóa menu thành công!',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Menu đã có danh mục! Xóa thất bại!',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
    public function editMenu($id){
        $menu = DB::table('menu')->where('id', $id)->first();
        return response::json(array(
            'menu' => $menu
        ));
    }
    public function updateMenu(Request $request){
        $id = $request->menu_id;
        $data = array();
        $rules = [
            'menu_name' => 'required|max:55',
        ];
        $messages = [
            'menu_name.required' => 'Tên menu không được để trống!',
            'menu_name.max' => 'Tên menu lớn nhất :max kí tự!',
        ];
        $this->validate($request, $rules, $messages);
        $data['menu_name'] = $request->menu_name;
        $data['slug_menu_name'] = to_slug($request->menu_name);
        DB::table('menu')->where('id', $id)->update($data);
        $notification = array(
            'message' => 'Cập nhật menu thành công!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    //    CATEGORY
    public function category(){
        $category = DB::table('categories')
                    ->join('menu', '.categories.menu_id', 'menu.id')
                    ->select('categories.*', 'menu.menu_name')
                    ->get();
        $menu = DB::table('menu')->get();
        return view('admin.category.category', compact('category', 'menu'));
    }
    public function createCategory(Request $request){
        $rules = [
            'category_name' => 'required|unique:categories|max:55|min:2',
            'menu_id' => 'required'
        ];
        $messages = [
            'category_name.required' => 'Tên danh mục không được để trống!',
            'category_name.unique' => 'Tên danh mục :input đã tồn tại!',
            'category_name.max' => 'Tên danh mục lớn nhất :max kí tự!',
            'category_name.min' => 'Tên danh mục nhỏ nhất :min kí tự!',
            'menu_id.required' => 'Tên menu không được để trống!',
        ];
        $this->validate($request, $rules, $messages);
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['slug_category_name'] = to_slug($request->category_name);
        $data['menu_id'] = $request->menu_id;
        DB::table('categories')->insert($data);
        $notification = array(
            'message' => 'Thêm danh mục thành công!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function deleteCategory($id){
        $subcategory = DB::table('subcategories')->where('category_id', $id)->get();
        if(count($subcategory) == 0){
            DB::table('categories')->where('id', $id)->delete();
            $notification = array(
                'message' => 'Xóa danh mục thành công!',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Đã có danh mục con! Xóa danh mục thất bại!',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
    public function editCategory($id){
        $category = DB::table('categories')->where('id', $id)->first();
        return response()->json(array(
            'category' => $category
        ));
    }
    public function updateCategory(Request $request){
        $rules = [
            'category_name' => 'required|max:55|min:2',
            'menu_id' => 'required'
        ];
        $messages = [
            'category_name.required' => 'Tên danh mục không được để trống!',
            'category_name.max' => 'Tên danh mục lớn nhất :max kí tự!',
            'category_name.min' => 'Tên danh mục nhỏ nhất :min kí tự!',
            'menu_id.required' => 'Tên menu không được để trống!',
        ];
        $this->validate($request, $rules, $messages);
        $id = $request->category_id;
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['slug_category_name'] = to_slug($request->category_name);
        $data['menu_id'] = $request->menu_id;
        DB::table('categories')->where('id', $id)->update($data);
        $notification = array(
            'message' => 'Cập nhật danh mục thành công!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    //     SUBCATEGORY
    public function subcategory(){
        $subcategory = DB::table('subcategories')
                        ->join('categories', 'subcategories.category_id','categories.id')
                        ->select('subcategories.*', 'categories.category_name')
                        ->get();
        $category = DB::table('categories')->get();
        return view('admin.category.subcategory', compact('subcategory', 'category'));
    }
    public function createsubCategory(Request $request){
        $rules = [
            'subcategory_name' => 'required|max:55|min:2',
            'category_id' => 'required',
        ];
        $messages = [
            'subcategory_name.required' => 'Tên dannh mục con không được để trống.',
            'subcategory_name.max' => 'Tên dannh mục con được vượt quá :max kí tự.',
            'subcategory_name.min' => 'Tên dannh mục con phải hơn :min kí tự.',
            'category_id.required' => 'Tên dannh mục không được để trống.',
        ];
        $this->validate($request, $rules, $messages);
        $data = array();
        $data['subcategory_name'] = $request->subcategory_name;
        $data['slug_subcategory_name'] = to_slug($request->subcategory_name);
        $data['category_id'] = $request->category_id;
        DB::table('subcategories')->insert($data);
        $notification = array(
            'message' => 'Tạo danh mục con thành công!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function deletesubCategory($id){
        DB::table('subcategories')->where('id', $id)->delete();
        $notification = array(
            'message' => 'Xóa danh mục con thành công!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function editsubCategory($id){
        $subcategory = DB::table('subcategories')->where('id', $id)->first();
        return response()->json(array(
            'subcategory' => $subcategory
        ));
    }
    public function updatesubCategory(Request $request){
        $id = $request->subcategory_id;
        $rules = [
            'subcategory_name' => 'required|min:2|max:55',
            'category_id' => 'required',
        ];
        $messages = [
            'subcategory_name.required' => 'Tên danh mục con không được để trống!',
            'subcategory_name.min' => 'Tên danh mục con nhỏ nhất :min kí tự!',
            'subcategory_name.max' => 'Tên danh mục con lớn nhất :max kí tự!',
            'category_id.required' => 'Tên danh mục không được để trống!',
        ];
        $this->validate($request, $rules, $messages);
        $data = array();
        $data['subcategory_name'] = $request->subcategory_name;
        $data['slug_subcategory_name'] = to_slug($request->subcategory_name);
        $data['category_id'] = $request->category_id;
        DB::table('subcategories')->where('id', $id)->update($data);
        $notification = array(
            'message' => 'Cập nhật danh mục con thành công!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
