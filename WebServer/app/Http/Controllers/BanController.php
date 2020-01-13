<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ban;
use App\loai;
use App\hoa_don;
use App\chi_tiet_hoa_don;
use App\san_pham;

class BanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return ban::get();
       
        $ban = Ban::all();
        // $cthd = Chitiethoadon::all();
        // $hoadon = Hoadon::all();
        // $thucdon = Thucuong::all();
        return view('admin.ban.ban')
        ->with('ban', $ban);
        // ->with('cthd', $cthd)
        
        // ->with('hoadon', $hoadon)
        // ->with('thucdon', $thucdon)
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        $ban = new ban();
        $ban->trang_thai = "trong";
        $ban->ten_ban = $ban->ma_ban;
        $ban->save();
           return redirect(route('ban'));
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
        $ban = Ban::find($id);
        $ban->trang_thai = "trong";
        $ban->save();
        $mes = "ok";
        return json_encode($mes,200);

    }
    public function datrong($id)
    {
        $ban = Ban::find($id);
        $ban->trang_thai = "trong";
        $ban->save();
        return redirect(route('ban'));

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
        $banhoadon = hoa_don::where('ma_ban', $id)->count();
        if($banhoadon > 0 ){
            return redirect(route('ban'))->with(['flash_level'=>'danger','flash_message'=>' Bàn có hóa đơn, không được xóa !!!']);
        }
        else{
            $ban = Ban::find($id);
            $ban->delete();
             return redirect(route('ban'))->with(['flash_level'=>'success','flash_message'=>' Xóa bàn thành công !!!']);
   
            }
        }
    //////////////////////////////////////////////////////////////// API /////////////////////////////////////////////////
    public function indexAPI()
    {
        $ban = ban::all();
        return $ban;
    }
}
