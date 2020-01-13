<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\dai_ly;
use App\phieu_nhap;

class DailyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $daily = dai_ly::all();
        return view('admin.daily.index')
        ->with('daily', $daily);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $daily = dai_ly::all();
        return view('admin.daily.create')
        ->with('daily', $daily);
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
            'tendl' => 'required',
            'sdt' => 'required|alpha_num|min:10|max:11',
            'diachi' => 'required',
            'tinh' => 'required'
                                    ],
            [
            'tendl.required' => 'Vui lòng nhập tên đại lý',
            'sdt.required' => 'Vui lòng nhập số điện thoại',
            'sdt.min' => 'Số điện thoại phải ít nhất 10 chữ số',
            'sdt.max' => 'Số điện thoại phải dài nhất 11 chữ số',
            'sdt.alpha_num' => 'Số điện thoại phải bằng số',
            'diachi.required' => 'Vui lòng nhập địa chỉ',
            'tinh.required'  => 'Vui lòng nhập tỉnh\thành phố',    
            ]);
        $daily = new dai_ly();
        $daily->ten_dai_ly = $request->tendl;
        $daily->so_dien_thoai = $request->sdt;
        $daily->dia_chi = $request->diachi;
        $daily->tinh = $request->tinh;
        $daily->save();
        return redirect(route('daily'))->with(['flash_level'=>'success','flash_message'=>'Success !!Thêm đại lý thành công']);
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
        return dai_ly::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $daily = dai_ly::find($id);
        return view('admin.daily.edit')
        ->with('daily', $daily);
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
        $daily = dai_ly::find($id);
        $this->validate($request,[
            'tendl' => 'required',
            'sdt' => 'required|alpha_num|min:10|max:11',
            'diachi' => 'required',
            'tinh' => 'required'
                                    ],
            [
            'tendl.required' => 'Vui lòng nhập tên đại lý',
            'sdt.required' => 'Vui lòng nhập số điện thoại',
            'sdt.alpha_num' => 'Số điện thoại phải bằng số',
            'sdt.min' => 'Số điện thoại phải ít nhất 10 chữ số',
            'sdt.max' => 'Số điện thoại phải dài nhất 11 chữ số',
            
            'diachi.required' => 'Vui lòng nhập địa chỉ',
            'tinh.required'  => 'Vui lòng nhập tỉnh\thành phố',  
            ]);
        $daily->ten_dai_ly = $request->tendl;
        $daily->so_dien_thoai = $request->sdt;
        $daily->dia_chi = $request->diachi;
        $daily->tinh = $request->tinh;
        $daily->save();
        return redirect(route('daily'))->with(['flash_level'=>'success','flash_message'=>'Success !!Cập nhật đại lý thành công']);
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
        $parent = phieu_nhap::where('ma_dai_ly', $id)->count();
        if ($parent == 0 ) {
            $daily = dai_ly::find($id);
            $daily->delete();
            
            return redirect(route('daily'))->with(['flash_level'=>'success','flash_message'=>' Xóa đại lý thành công !!!']);
        }

        else {
                return redirect(route('daily'))->with(['flash_level'=>'danger','flash_message'=>' Tồn tại nhập hàng liên quan đến đại lý !!!']);
        }
    }
    public function theotinh($ten)
    {
       $daily = dai_ly::where('tinh', $ten)->get();
        return view('admin.daily.index')
            ->with('daily', $daily);
    }
}
