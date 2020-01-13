<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function getLogin(){
        return view('admin.login');
    }

    public function postLogin(Request $request) {
        // Kiểm tra dữ liệu nhập vào
        $rules = [
            'ten_dang_nhap' =>'required',
            'mat_khau' => 'required|min:6'
        ];
        $messages = [
            'ten_dang_nhap.required' => 'Tên đăng nhập là trường bắt buộc',
            'mat_khau.required' => 'Mật khẩu là trường bắt buộc',
            'mat_khau.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        
        
        if ($validator->fails()) {
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect('login')->withErrors($validator)->withInput();
        } else {
            // Nếu dữ liệu hợp lệ sẽ kiểm tra trong csdl
            $ten_dang_nhap = $request->input('ten_dang_nhap');
            $mat_khau = $request->input('mat_khau');
     
            if( Auth::attempt(['ten_dang_nhap' => $ten_dang_nhap, 'mat_khau' =>$mat_khau])) {
                // Kiểm tra đúng email và mật khẩu sẽ chuyển trang
                if (Gate::allows('role', 'admin') || Gate::allows('role', 'cashier')) {
                    Session::flash('success', 'Đăng nhập thành công!');
                    return redirect('/ban/web');
                } else if (Gate::allows('role', 'bartender')) {
                    Session::flash('success', 'Đăng nhập thành công!');
                    return redirect('/phache/web');
                } else {
                    Session::flash('error', 'Không có quyền đăng nhập trang quản trị!');
                    return redirect('login');
                }
                
            } else {
                // Kiểm tra không đúng sẽ hiển thị thông báo lỗi
                Session::flash('error', 'Tên đăng nhập hoặc mật khẩu không đúng!');
                return redirect('login');
            }
        }
    }
}