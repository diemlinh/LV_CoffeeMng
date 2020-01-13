<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\chi_tiet_khuyen_mai;
use App\san_pham;
use App\khuyen_mai;
use DB;


class ChitietkhuyenmaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
       
        $ctkm = DB::table('chi_tiet_khuyen_mai')
                    ->join('san_pham', 'chi_tiet_khuyen_mai.ma_sp', '=', 'san_pham.ma_sp')
                    ->where('ma_khuyen_mai', $id)
                    ->get();
        return view('admin.khuyenmai.chitiet')
        ->with('ctkm', $ctkm);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $sanpham = san_pham::all();
        $khuyenmai = khuyen_mai::find($id);

        return view('admin.khuyenmai.create')
        ->with('khuyenmai', $khuyenmai)
        ->with('sanpham', $sanpham);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $ctkm = new chi_tiet_khuyen_mai();
           
            $this->validate($request,[
            'sanpham' => 'required',
            'kieu' => 'required',
            'giatri' => 'required',
                                    ],
            [
            'sanpham.required' => 'Tên món không được bỏ trống',
            'kieu.required' => 'Vui lòng nhập kiểu khuyến mãi',
            'giatri.required' => 'Vui lòng nhập giá trị khuyến mãi',
        
            ]);
            $ctkm->ma_khuyen_mai = $request->khuyenmai;    
            $ctkm->ma_sp = $request->sanpham;
            $ctkm->kieu_khuyen_mai = $request->kieu;
            $ctkm->gia_tri_KM = $request->giatri;
            $sanpham = san_pham::where('ma_sp', $request->sanpham)->first();
            $ctkm->gia_khuyen_mai = $sanpham->don_gia-$sanpham->don_gia*$request->giatri/100;            
            $ctkm->save();
        return redirect(route('chitietkm', $request->khuyenmai))->with(['flash_level'=>'success','flash_message'=>'Success !! Thêm chương trình khuyến mãi thành công']);
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
        $khuyenmai = khuyen_mai::all();
        $sanpham = san_pham::all();
        $ctkm = chi_tiet_khuyen_mai::find($id);
        return view('admin.khuyenmai.edit')
        ->with('sanpham', $sanpham)
        ->with('khuyenmai', $khuyenmai)
        ->with('ctkm', $ctkm);
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
            $ctkm = chi_tiet_khuyen_mai::find($id);
           
            $this->validate($request,[
            'sanpham' => 'required',
            'kieu' => 'required',
            'giatri' => 'required',
                                    ],
            [
            'sanpham.required' => 'Tên món không được bỏ trống',
            'kieu.required' => 'Vui lòng nhập kiểu khuyến mãi',
            'giatri.required' => 'Vui lòng nhập giá trị khuyến mãi',
        
            ]);
            $ctkm->ma_khuyen_mai = $request->khuyenmai;    
            $ctkm->ma_sp = $request->sanpham;
            $ctkm->kieu_khuyen_mai = $request->kieu;
            $ctkm->gia_tri_KM = $request->giatri;
            $sanpham = san_pham::where('ma_sp', $request->sanpham)->first();
            $ctkm->gia_khuyen_mai = $sanpham->don_gia-$sanpham->don_gia*$request->giatri/100;            
            $ctkm->save();
        return redirect(route('chitietkm', $request->khuyenmai))->with(['flash_level'=>'success','flash_message'=>'Success !! Cập nhật chương trình khuyến mãi thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ctkm = chi_tiet_khuyen_mai::find($id);
        $khuyenmai = $ctkm->ma_khuyen_mai;
        $ctkm->delete();
        $ctkm = chi_tiet_khuyen_mai::where('ma_khuyen_mai', $khuyenmai)->count();
        if($ctkm == 0){
        return redirect(route('khuyenmai'))->with(['flash_level'=>'success','flash_message'=>'Success !! Xóa thành công, đã hết chương trình khuyến mãi']);
        }
        return redirect(route('chitietkm', $khuyenmai))->with(['flash_level'=>'success','flash_message'=>'Success !! Xóa chương trình khuyến mãi thành công']);
    }
}
