<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\phieu_nhap;
use App\nguyen_lieu;
use App\dai_ly;

class NhapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nhap = phieu_nhap::all();
        $nguyenlieu = nguyen_lieu::all();
        return view('admin.nhaphang.index')
        ->with('nhap', $nhap)
        ->with('nguyenlieu', $nguyenlieu);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $daily = dai_ly::all();
        $nguyenlieu = nguyen_lieu::all();
        return view('admin.nhaphang.create')
        ->with('daily', $daily)
        
        ->with('nguyenlieu', $nguyenlieu);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $phieunhap = new phieu_nhap();   
        $this->validate($request,[
            'tendaily' => 'required',
            'tennguyenlieu' => 'required',
            'soluong' => 'required|numeric',
            'gia' => 'required',
            'dvit' => 'required'
                                    ],
            [
            'tendaily.required' => 'Tên đại lý không được bỏ trống',
            'tennguyenlieu.required' => 'Tên nguyên liệu không được bỏ trống',
            'soluong.required' => 'Số lượng không được bỏ trống',
            'soluong.numeric' => 'Số lượng phải là số',
            'gia.required' => 'Giá không được bỏ trống',
            'dvit.required' => 'Đơn vị tính không được bỏ trống',

            ]);
            
            $phieunhap->ma_dai_ly = $request->tendaily;
            $phieunhap->ma_nguyen_lieu = $request->tennguyenlieu;
            $phieunhap->so_luong_nhap = $request->soluong;
            $phieunhap->gia_nhap = $request->gia;
            $phieunhap->dvt = $request->dvit;

            $nguyenlieu = nguyen_lieu::find($request->tennguyenlieu);
            $nguyenlieu->so_luong = $nguyenlieu->so_luong + $request->soluong;
            $phieunhap->save();
            $nguyenlieu->save();
        return redirect(route('nhap'))->with(['flash_level'=>'success','flash_message'=>'Success !! Nhập hàng thành công']);
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
    }
}
