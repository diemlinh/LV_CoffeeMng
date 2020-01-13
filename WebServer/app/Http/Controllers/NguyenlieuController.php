<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\nguyen_lieu;
use App\cong_thuc;
use App\phieu_nhap;

class NguyenlieuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $nguyenlieu = nguyen_lieu::all();
        return view('admin.nguyenlieu.index')
        ->with('nguyenlieu', $nguyenlieu);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        return view('admin.nguyenlieu.create');
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
        $this->validate($request,[
            'ten' => 'required|max:255',
            'dvtinh' => 'required',
                                    ],
            [
            'ten.required' => 'Tên nguyên liệu không được bỏ trống',
            'dvtinh.required' => 'Đơn vị tính không được bỏ trống',
    
            ]
        );       
                $nl = new nguyen_lieu();
                $nl->ten_nguyen_lieu = $request->ten;
                $nl->so_luong = 0;
                $nl->dvt = $request->dvtinh;
                $nl->ma_nguyen_lieu = $nl->ma_nguyen_lieu;
                $nl->save();
            return redirect(route('nguyenlieu'))->with(['flash_level'=>'success','flash_message'=>'Success !! Thêm nguyên liệu thành công']);
            
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // return nguyen_lieu::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nguyenlieu = nguyen_lieu::find($id);
        return view('admin.nguyenlieu.edit')
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
        //
        
        $this->validate($request,[
        'ten' => 'required',
        'dvtinh' => 'required',
                                ],
        [
        'ten.required' => 'Tên nguyên liệu không được bỏ trống',
        'dvtinh.required' => 'Đơn vị tính không được bỏ trống',

        ]);
        $nl = nguyen_lieu::find($id);
        $nl->ten_nguyen_lieu = $request->ten;
        $nl->dvt = $request->dvtinh;
        $nl->save();
    return redirect(route('nguyenlieu'))->with(['flash_level'=>'success','flash_message'=>'Success !! Sửa nguyên liệu thành công']);
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
            $congthuc = cong_thuc::where('ma_nguyen_lieu', $id)->count();
            $phieunhap = phieu_nhap::where('ma_nguyen_lieu', $id)->count();
            if($congthuc <> 0 || $phieunhap <> 0){
                return redirect(route('nguyenlieu'))->with(['flash_level'=>'danger','flash_message'=>'Thất bại !! Tồn tại công thức có nguyên liệu']);
            }
            else{
            $nguyenlieu = nguyen_lieu::find($id);
            $nguyenlieu->delete();   
            return redirect(route('nguyenlieu'))->with(['flash_level'=>'success','flash_message'=>'Success !! Xóa nguyên liệu thành công']);
            } 
    }
}
