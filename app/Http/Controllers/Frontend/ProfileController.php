<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function profile(){
        return view('frontend.pages.account.index');
    }
    public function profileChangeInfo(){
        $id = Auth::id();
        $info = DB::table('users')->where('id', $id)->first();
        return view('frontend.pages.account.info', compact('info'));
    }
    public function profileUpdateInfo(Request $request){
        $phoneInput = $request->phone;
//        $dataPhone = DB::table('users')->where('phone', $phoneInput)->where('id', '!=', Auth::id())->get();
//        $rules = [];
//        if(count($dataPhone) == 1){
//            $rules = [
//                'name' => 'required|min:2|max:255',
//                'phone' => 'required|numeric|regex:/((0)+([0-9]{9})\b)/u|unique:users',
//                'birth' => 'required|date',
//                'gender' => 'required',
//            ];
//        }elseif(count($dataPhone) == 0){
//            $rules = [
//                'name' => 'required|min:2|max:255',
//                'phone' => 'required|numeric|regex:/((0)+([0-9]{9})\b)/u',
//                'birth' => 'required|date',
//                'gender' => 'required',
//            ];
//        }
        $rules = [
            'name' => 'required|min:2|max:255',
            'phone' => 'required|numeric|regex:/((0)+([0-9]{9})\b)/u',
            'birth' => 'required|date',
            'gender' => 'required',
        ];
        $message = [
            'name.required' => 'Họ và tên không được để trống!',
            'name.min' => 'Họ và tên tối thiểu :min kí tự!',
            'name.max' => 'Họ và tên tối đa :max kí tự!',
            'phone.required' => 'Số điện thoại không được để trống!',
            'phone.numeric' => 'Số điện thoại phải là số!',
            'phone.regex' => 'Số điện thoại không hợp lệ!',
            'phone.unique' => 'Số điện thoại đã tồn tại!',
            'birth.required' => 'Ngày sinh không được để trống!',
            'birth.date' => 'Ngày sinh không hợp lệ!',
            'gender.required' => 'Giới tính không được để trống!',
        ];
        $this->validate($request, $rules, $message);
        $data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['birth'] = $request->birth;
        $data['gender'] = $request->gender;
//        dd($data);
        DB::table('users')->where('id', Auth::id())->update($data);
        $notification = [
            'message' => 'Cập nhật thông tin thành công!',
            'alert-type' => 'success',
        ];
        return Redirect::route('admin.profile')->with($notification);
    }
    public function profileChangePassword(){
        return view('frontend.pages.account.password');
    }
    public function profileUpdatePassword(Request $request){
        $rules = [
            'password' => 'min:6|max:255',
//            'password_confirmation' => 'confirmed',
        ];
        $message = [
            'password.min' => 'Password tối thiểu :min kí tự!',
            'password.max' => 'Password tối đa :min kí tự!',
//            'password_confirmation.confirmed' => 'Password nhập lại không hợp lệ!',
        ];
        $this->validate($request, $rules, $message);
        $data = array();
        $passCurrent = Auth::user()->password;
        $password_old = $request->password_old;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;
        if(Hash::check($password_old, $passCurrent)){
            if($password == $password_confirmation){
                $user = User::find(Auth::id());
                $user->password=Hash::make($request->password);
                $user->save();
//                Auth::logout();
                $notification = [
                    'message' => 'Thay đổi mật khẩu thành công!',
                    'alert-type' => 'success',
                ];
                return Redirect::route('fe.profile')->with($notification);
            }else{
                $notification = [
                    'message' => 'Mật khẩu xác nhận không trùng nhau!',
                    'alert-type' => 'error',
                ];
                return Redirect::back()->with($notification);
            }
        }else{
            $notification = [
                'message' => 'Mật khẩu cũ không chính xác!',
                'alert-type' => 'error',
            ];
            return Redirect::back()->with($notification);
        }
    }
    public function profileOrder(){
        $orders = DB::table('orders')->where('user_id', Auth::id())->get();
        return view('frontend.pages.account.order', compact('orders'));
    }
    public function profileWishlist(){
        return view('frontend.pages.account.wishlist');
    }
}
