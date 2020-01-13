<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\khach_hang;

class KhachhangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return khach_hang::get();
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
        $khachhang = new khach_hang();
        $khachhang->ho_ten = $request->ho_ten;
        $khachhang->email = $request->email;
        $khachhang->gioi_tinh = $request->gioi_tinh;
        $khachhang->sinh_nhat = $request->sinh_nhat;
        $khachhang->so_dien_thoai = $request->so_dien_thoai;
        $khachhang->trang_thai = $request->trang_thai;
        $khachhang->tinh = $request->tinh;
        $khachhang->diem_tich_luy = $request->diem_tich_luy;
        $khachhang->so_ly_KM = $request->so_ly_KM;
        $khachhang->save();
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
        return khach_hang::find($id);
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
        //
        if ($id != null) {
            khach_hang::where('ma_kh', $id)->update($request->all());  
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
        //
        if ($id != null) {
            $khachhang = khach_hang::find($id);
            $khachhang->delete();    
        }
    }
}