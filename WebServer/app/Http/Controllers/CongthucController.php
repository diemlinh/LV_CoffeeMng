<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cong_thuc;
use App\nguyen_lieu;
use App\san_pham;

class CongthucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $congthuc = cong_thuc::all();
        return view('admin.congthuc.index')
        ->with('congthuc', $congthuc);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sanpham = san_pham::all();
        $nguyenlieu = nguyen_lieu::all();
        return view('admin.congthuc.create')
        ->with('sanpham', $sanpham)
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
            $congthuc = new cong_thuc();
            $this->validate($request,[
            'thucuong' => 'required',
            'nguyenlieu' => 'required',
            'soluong' => 'required',
            'dvt' => 'required'
                                    ],
            [
            'thucuong.required' => 'Tên thức uống không được bỏ trống',
            'nguyenlieu.required' => 'Tên nguyên liệu không được bỏ trống',
            'soluong.required' => 'Số lượng không được bỏ trống',
            'dvt.required' => 'Đơn vị tính không được bỏ trống',
            ]);

            $congthuc->ma_sp = $request->thucuong;
            $congthuc->ma_nguyen_lieu = $request->nguyenlieu;
            $congthuc->so_luong = $request->soluong;
            $congthuc->dvt = $request->dvt;            
            $congthuc->save();
        return redirect(route('congthuc'))->with(['flash_level'=>'success','flash_message'=>'Success !! Thêm công thức thành công']);
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
        $congthuc = cong_thuc::find($id);
        $sanpham = san_pham::all();
        $nguyenlieu = nguyen_lieu::all();
        return view('admin.congthuc.edit')
        ->with('sanpham', $sanpham)
        ->with('congthuc', $congthuc)
        ->with('nguyenlieu', $nguyenlieu);
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
        $congthuc = cong_thuc::find($id);
        $this->validate($request,[
        'thucuong' => 'required',
        'nguyenlieu' => 'required',
        'soluong' => 'required',
        'dvt' => 'required'
                                ],
        [
        'thucuong.required' => 'Tên thức uống không được bỏ trống',
        'nguyenlieu.required' => 'Tên nguyên liệu không được bỏ trống',
        'soluong.required' => 'Số lượng không được bỏ trống',
        'dvt.required' => 'Đơn vị tính không được bỏ trống',
        ]);

        $congthuc->ma_sp = $request->thucuong;
        $congthuc->ma_nguyen_lieu = $request->nguyenlieu;
        $congthuc->so_luong = $request->soluong;
        $congthuc->dvt = $request->dvt;
        
        $congthuc->save();
    return redirect(route('congthuc'))->with(['flash_level'=>'success','flash_message'=>'Success !! Cập nhật công thức thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $congthuc = cong_thuc::find($id);
        $congthuc->delete();
        return redirect(route('congthuc'))->with(['flash_level'=>'success','flash_message'=>'Success !!Xóa công thức thành công']);
    }
}
