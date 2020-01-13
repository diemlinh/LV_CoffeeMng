<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\thanh_vien;
use JWTAuth;
use JWTAuthException;
use Hash;

class ThanhvienController extends Controller
{
    private $user;

    public function __construct(thanh_vien $user){
        $this->user = $user;
    }
    /**
     * function use to show all thanh vien in table thanh_vien
     */
    
    /**
     * function use to create new record in table thanh_vien
     */
    
    /**
     * function use to show a record by ma_tv in table thanh_vien
     */
    public function show($ma_tv)
    {
        $thanhvien = thanh_vien::find($ma_tv);
        // Show single product
        return $thanhvien;
    }
    /**
     * function use to edit a record in table thanh_vien
     */
    // public function update(Request $request, $ma_tv)
    // {
    //     $request->merge(['mat_khau' => Hash::make($request->get('mat_khau'))]);
    //     // Update the Product
    //     if ($ma_tv != null) {
    //         thanh_vien::where('ma_tv', $ma_tv)->update($request->all());  
    //     }
    // }
    /**
     * function use to delete a record in table thanh_vien
     */
    public function remove($ma_tv)
    {
        // Delete the Product
        if ($ma_tv != null) {
            $product = thanh_vien::find($ma_tv);
            $product->delete();    
        }
    }

    public function register(Request $request){
        $user = $this->user->create([
          'ten_dang_nhap' => $request->get('ten_dang_nhap'),
          'mat_khau' => Hash::make($request->get('mat_khau')),
          'ho_ten' => $request->get('ho_ten'),
          'email' => $request->get('email'),
          'gioi_tinh' => $request->get('gioi_tinh'),
          'sinh_nhat' => $request->get('sinh_nhat'),
          'dia_chi' => $request->get('dia_chi'),
          'quyen' => $request->get('quyen'),
          'so_dt' => $request->get('so_dt'),
          'trang_thai' => $request->get('trang_thai'),
          'tinh' => $request->get('tinh')
        ]);
        
        return response()->json([
            'status'=> 200,
            'message'=> 'User created successfully',
            'data'=>$user
        ]);
    }

    public function login(Request $request){
        $credentials = $request->only('ten_dang_nhap', 'mat_khau');
        //$token = null;
        try {
           if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['invalid_email_or_password'], 422);
           }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

    public function getUserInfo(Request $request){
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }


    /////////////////////////////////////////////// WEB /////////////////////////////////////////////
    /**
     * function use to show all in web
     */
    public function index()
    {
       
        $thanhvien = thanh_vien::all();
        return view('admin.thanhvien.index')
            ->with('thanhvien', $thanhvien);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
       return view('admin.thanhvien.create');

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
            $this->validate($request,[
            'name' => 'required|unique:thanh_vien,ten_dang_nhap',
            'yourname' => 'required',
            'email' => 'required|email',
            'gioitinh' => 'required',
            'sinhnhat' => 'required',
            'diachi' => 'required',
            'tinh' => 'required',
            'quyen' => 'required',
            'dienthoai' => 'required|alpha_num|min:10|max:11',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
                                    ],
            [
            'unique' => ':attribute đã tồn tại',
            'min' => ':attribute phải lớn hơn :min',
            'max' => ':attribute phải nhỏ hơn :max',
            'email' => ':attribute không phải email',
            'required'  => ':attribute không được bỏ trống',
            'same'  => 'Mật khẩu nhập lại phải giống mật khẩu',
            'alpha_num'  => ':attribute phải nhập số',

            ],
            [
                'name' => 'Tên đăng nhập',
                'yourname' => 'Họ tên',
                'email' => 'Email',
                'gioitinh' => 'Giới tính',
                'sinhnhat' => 'Sinh nhật',
                'diachi' => 'Địa chỉ',
                'tinh' => 'Tỉnh',
                'quyen' => 'Quyền',
                'dienthoai' => 'Số điện thoại',
                'password' => 'Mật khẩu',
                'password_confirmation' => 'Mật khẩu nhập lại',
            ]
        );
            $thanhvien = new thanh_vien();
            $thanhvien->ten_dang_nhap = $request->name;
            $thanhvien->ho_ten = $request->yourname;
            $thanhvien->email = $request->email;
            $thanhvien->mat_khau = bcrypt($request->password);
            $thanhvien->gioi_tinh = $request->gioitinh;
            $thanhvien->sinh_nhat = date('Y-m-d',strtotime($request->sinhnhat));
            $thanhvien->dia_chi = $request->diachi;
            $thanhvien->tinh = $request->tinh;
            $thanhvien->so_dt = $request->dienthoai;
            $thanhvien->quyen = $request->quyen;
            $thanhvien->trang_thai = "available";
            $thanhvien->save();
        return redirect(route('thanhvien'))->with(['flash_level'=>'success','flash_message'=>'Success !! Thêm thành viên thành công']);
    }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thanhvien = thanh_vien::find($id);
        return view('admin.thanhvien.edit')
            ->with('thanhvien', $thanhvien);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
            if(isset($request->password)){
                $thanhvien = thanh_vien::find($id);
                $this->validate($request,[
                    'name' => 'required',
                    'yourname' => 'required',
                    'email' => 'required|email',
                    'gioitinh' => 'required',
                    'sinhnhat' => 'required',
                    'diachi' => 'required',
                    'tinh' => 'required',
                    'quyen' => 'required',
                    'trangthai' => 'required',
                    'dienthoai' => 'required|alpha_num|min:10|max:11',
                    'password' => 'required|min:6',
                    'password_confirmation' => 'required|same:password',
                                            ],
                    [
                    'min' => ':attribute phải lớn hơn :min',
                    'max' => ':attribute phải nhỏ hơn :max',
                    'email' => ':attribute không phải email',
                    'required'  => ':attribute không được bỏ trống',
                    'same'  => 'Mật khẩu nhập lại phải giống mật khẩu',
                    'alpha_num'  => ':attribute phải nhập số',
        
        
                    ],
                    [
                        'name' => 'Tên đăng nhập',
                        'trangthai' => 'Trạng thái',
                        'yourname' => 'Họ tên',
                        'email' => 'Email',
                        'gioitinh' => 'Giới tính',
                        'sinhnhat' => 'Sinh nhật',
                        'diachi' => 'Địa chỉ',
                        'tinh' => 'Tỉnh',
                        'quyen' => 'Quyền',
                        'dienthoai' => 'Số điện thoại',
                        'password' => 'Mật khẩu',
                        'password_confirmation' => 'Mật khẩu nhập lại',
                    ]
                );
    
                $thanhvien->ten_dang_nhap = $request->name;
                $thanhvien->ho_ten = $request->yourname;
                $thanhvien->email = $request->email;
                $thanhvien->mat_khau = bcrypt($request->password);
                $thanhvien->gioi_tinh = $request->gioitinh;
                $thanhvien->sinh_nhat = date('Y-m-d',strtotime($request->sinhnhat));
                $thanhvien->dia_chi = $request->diachi;
                $thanhvien->tinh = $request->tinh;
                $thanhvien->so_dt = $request->dienthoai;
                $thanhvien->quyen = $request->quyen;
                $thanhvien->trang_thai = $request->trangthai;
                $thanhvien->save();
            return redirect(route('thanhvien'))->with(['flash_level'=>'success','flash_message'=>'Success !! Cập nhật thành viên thành công']);}
            else{
                $this->validate($request,[
                    'name' => 'required',
                    'yourname' => 'required',
                    'email' => 'required|email',
                    'gioitinh' => 'required',
                    'sinhnhat' => 'required',
                    'diachi' => 'required',
                    'tinh' => 'required',
                    'quyen' => 'required',
                    'dienthoai' => 'required|alpha_num|min:10|max:11',
                                            ],
                    [
                    'min' => ':attribute phải lớn hơn :min',
                    'max' => ':attribute phải nhỏ hơn :max',
                    'email' => ':attribute không phải email',
                    'required'  => ':attribute không được bỏ trống',
                    'alpha_num'  => ':attribute phải nhập số',
        
        
                    ],
                    [
                        'name' => 'Tên đăng nhập',
                        'yourname' => 'Họ tên',
                        'email' => 'Email',
                        'gioitinh' => 'Giới tính',
                        'sinhnhat' => 'Sinh nhật',
                        'diachi' => 'Địa chỉ',
                        'tinh' => 'Tỉnh',
                        'quyen' => 'Quyền',
                        'dienthoai' => 'Số điện thoại',
                    ]
                );
                $thanhvien = thanh_vien::find($id);
                $thanhvien->ten_dang_nhap = $request->name;
                $thanhvien->ho_ten = $request->yourname;
                $thanhvien->email = $request->email;
                $thanhvien->gioi_tinh = $request->gioitinh;
                $thanhvien->sinh_nhat = date('Y-m-d',strtotime($request->sinhnhat));
                $thanhvien->dia_chi = $request->diachi;
                $thanhvien->tinh = $request->tinh;
                $thanhvien->so_dt = $request->dienthoai;
                $thanhvien->quyen = $request->quyen;
                $thanhvien->trang_thai = $request->trangthai;
                $thanhvien->save();
            return redirect(route('thanhvien'))->with(['flash_level'=>'success','flash_message'=>'Success !! Cập nhật thành viên thành công']);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
            $thanhvien = thanh_vien::find($id);
            if($thanhvien->trang_thai == "unavailable"){
            $thanhvien->delete();
            
            return redirect(route('thanhvien'))->with(['flash_level'=>'success','flash_message'=>'Success !! Xóa nhân viên thành công']);
            }
            return redirect(route('thanhvien'))->with(['flash_level'=>'danger','flash_message'=>'Fail !! Thành viên vẫn còn hoạt động']);

    }
}
