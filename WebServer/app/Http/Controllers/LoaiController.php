<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\loai;
use App\san_pham;

class LoaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loai = loai::all();
        return view('admin.loai.index')
            ->with('loai', $loai);
    }
    public function indexAPI()
    {
        $loai = loai::all();
        return $loai;
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
        $this->validate($request,[
            'them' => 'required|unique:loai,ten_loai',
                                    ],
            [
            'them.required' => 'Bắt buộc nhập tên loại',
            'them.unique' => 'Tên loại đã có, vui lòng nhập lại',     
            ]);
        $loai = new loai();
        $loai->ten_loai = $request->them;
        $loai->save();

        return redirect(route('loai'))->with(['flash_level'=>'success','flash_message'=>' Thêm loại thành công !!!']);
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
        $loai = loai::find($id);
           
        $loai->ten_loai = $request->ten;
       
        $loai->save();

        return redirect(route('loai'))->with(['flash_level'=>'success','flash_message'=>' Cập nhật loại thành công !!!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parent = san_pham::where('ma_loai', $id)->count();
        if ($parent == 0 ) {
            $loai = loai::find($id);
            $loai->delete();
            
            return redirect(route('loai'))->with(['flash_level'=>'success','flash_message'=>' Xóa loại thành công !!!']);
        }

        else {
                return redirect(route('loai'))->with(['flash_level'=>'danger','flash_message'=>' Loại tồn tại thức uống !!!']);
        }
    }
}
