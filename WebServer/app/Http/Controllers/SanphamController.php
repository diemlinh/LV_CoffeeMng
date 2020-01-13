<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\san_pham;
use App\loai;
use App\chi_tiet_hoa_don;
use App\cong_thuc;

class SanphamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thucdon = san_pham::where('trang_thai', '<>', 'nghi ban')->get();
        $loai = loai::all();
       return view('admin.thucdon.index')
       ->with('thucdon', $thucdon)
       ->with('loai', $loai);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $thucdon = san_pham::all();
        $loai = loai::all();
       return view('admin.thucdon.create')
       ->with('thucdon', $thucdon)
       ->with('loai', $loai);
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
                'loai' => 'required',
                'ten' => 'required|unique:san_pham,ten_sp',
                'gia' => 'required',
                'hinh' => 'required|image',
                'trangthai' => 'required'
                                        ],
                [
                'loai.required' => 'Vui lòng chọn loại',
                'ten.required' => 'Vui lòng chọn tên món',
                'ten.unique' => 'Tên món đã có, vui lòng nhập lại',
                'gia.required' => 'Vui lòng nhập giá',
                'hinh.required' => 'Vui lòng chọn hình đại diện',
                'hinh.image' => 'Vui lòng chọn hình đại diện đúng định dạng',
                'trangthai.required'  => 'Vui lòng chọn trạng thái',       
                ]);
                $thucdon = new san_pham();
                $thucdon->ma_loai = $request->loai;
                $thucdon->ten_sp = $request->ten;           
                $thucdon->don_gia = $request->gia;
            
            //Kiểm tra file
            if($request->hasFile('hinh')){
              $file = $request->hinh;
                $thucdon->hinh_anh = $file->getClientOriginalName();
                $file->move('upload', $thucdon->hinh_anh);
            }
                   
            $thucdon->trang_thai = $request->trangthai;
           
            
            $thucdon->save();

            return redirect(route('thucdon'))->with(['flash_level'=>'success','flash_message'=>' Thêm món thành công !!!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $thucdon = san_pham::find($id);
        $loai = loai::all();
       return view('admin.thucdon.edit')
       ->with('thucdon', $thucdon)
       ->with('loai', $loai);
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
        //
        if(isset($request->hinh)){
            
            $this->validate($request,[
                'loai' => 'required',
                'ten' => 'required',
                'gia' => 'required',
                'hinh' => 'required|image',
                'trangthai' => 'required'
                                        ],
                [
                'loai.required' => 'Vui lòng chọn loại',
                'ten.required' => 'Vui lòng chọn tên món',
                'ten.unique' => 'Tên món đã có, vui lòng nhập lại',
                'gia.required' => 'Vui lòng nhập giá',
                'hinh.required' => 'Vui lòng chọn hình đại diện',
                'hinh.image' => 'Vui lòng chọn hình đại diện đúng định dạng',
                'trangthai.required'  => 'Vui lòng chọn trạng thái',          
                ]);
            $thucdon = san_pham::find($id);
            $thucdon->ma_loai = $request->loai;
            $thucdon->ten_sp = $request->ten;           
            $thucdon->don_gia = $request->gia;
           
            //Kiểm tra file
            if($request->hasFile('hinh')){
              $file = $request->hinh;
                $thucdon->hinh_anh = $file->getClientOriginalName();
                $file->move('upload', $thucdon->hinh_anh);
            }
                   
            $thucdon->trang_thai = $request->trangthai;
           
            
            $thucdon->save();

            return redirect(route('thucdon'))->with(['flash_level'=>'success','flash_message'=>' Cập nhật món thành công !!!']);
        }
        else
          {
            $thucdon = san_pham::find($id);
            $this->validate($request,[
                'loai' => 'required',
                'ten' => 'required',
                'gia' => 'required',
                'trangthai' => 'required'
                                        ],
                [
                'loai.required' => 'Vui lòng chọn loại',
                'ten.required' => 'Vui lòng chọn tên món',
                'gia.required' => 'Vui lòng nhập giá',
                'trangthai.required'  => 'Vui lòng chọn trạng thái',   
                ]);
             $thucdon->ma_loai = $request->loai;
             $thucdon->ten_sp = $request->ten;           
             $thucdon->don_gia = $request->gia;
             $thucdon->trang_thai = $request->trangthai;
            
            $thucdon->save();

            return redirect(route('thucdon'))->with(['flash_level'=>'success','flash_message'=>' Cập nhật món thành công !!!']);
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function theoloai($id)
    {
       $thucdon = san_pham::where('ma_loai', $id)->get();
        return view('admin.thucdon.theoloai')
            ->with('thucdon', $thucdon);
    }
    public function destroy($id)
    {
        $chitiet = chi_tiet_hoa_don::where('ma_sp', $id)->count();
        $congthuc = cong_thuc::where('ma_sp', $id)->count();
        if($congthuc <> 0 || $chitiet <> 0){
            return redirect(route('thucdon'))->with(['flash_level'=>'danger','flash_message'=>'Thất bại !! Tồn tại món trong dữ liệu khác']);            
        }
        else{
            $sanpham = san_pham::find($id);
            $sanpham->delete();   
            return redirect(route('thucdon'))->with(['flash_level'=>'success','flash_message'=>'Success !! Xóa món thành công']);
            } 
        
    }
    ////////////////////////////////API/////////////////
    public function indexAPI()
    {
        $thucdon = san_pham::where('trang_thai', '<>', 'nghi ban')->get();
       return $thucdon;
    }
    public function theoloaiAPI($id)
    {
       $thucdon = san_pham::where('ma_loai', $id)->get();
        return json_encode($thucdon, 200);
    }
}
