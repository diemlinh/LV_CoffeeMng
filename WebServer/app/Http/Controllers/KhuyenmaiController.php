<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\khuyen_mai;
use App\chi_tiet_khuyen_mai;

class KhuyenmaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $khuyenmai = khuyen_mai::all();
        $ctkm = chi_tiet_khuyen_mai::all();
        return view('admin.khuyenmai.index')
        ->with('khuyenmai', $khuyenmai)
        ->with('ctkm', $ctkm);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $khuyenmai = new khuyen_mai();
        $khuyenmai->ten_khuyen_mai = $request->themkm;
        $khuyenmai->ngay_bat_dau = $request->ngaybd;
        $khuyenmai->ngay_ket_thuc = $request->ngaykt;
        $khuyenmai->save();
        return redirect(route('khuyenmai'))->with(['flash_level'=>'success','flash_message'=>' Thêm khuyến mãi thành công !!!']);
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
        return khuyen_mai::find($id);
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
        $khuyenmai = khuyen_mai::find($id);
           
        $khuyenmai->ten_khuyen_mai = $request->tenkm;
        $khuyenmai->ngay_bat_dau = $request->batdau;
        $khuyenmai->ngay_ket_thuc = $request->ketthuc;       
        $khuyenmai->save();

        return redirect(route('khuyenmai'))->with(['flash_level'=>'success','flash_message'=>' Cập nhật khuyến mãi thành công !!!']);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parent = chi_tiet_khuyen_mai::where('ma_khuyen_mai', $id)->count();
        if ($parent == 0 ) {
            $khuyenmai = khuyen_mai::find($id);
            $khuyenmai->delete();
            
            return redirect(route('khuyenmai'))->with(['flash_level'=>'success','flash_message'=>' Xóa khuyến mãi thành công !!!']);
        }

        else {
                return redirect(route('khuyenmai'))->with(['flash_level'=>'danger','flash_message'=>' Vẫn còn chương trình khuyến mãi !!!']);
        }
    }
}
