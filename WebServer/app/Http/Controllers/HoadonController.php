<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\san_pham;
use App\hoa_don;
use App\chi_tiet_hoa_don;
use App\ban;
use Cart;
use DB;
use App\Events\ThanhtoanPusherEvent;
use Illuminate\Support\Facades\Auth;

class HoadonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function xuathoadon($id)
    {      
        $ban = Ban::find($id);
        $hoadon= DB::table('hoa_don')->where('ma_ban',$id)->where('trang_thai', 'chua thanh toan')->first();

        $cthd = DB::table('chi_tiet_hoa_don')
                ->join('san_pham', 'chi_tiet_hoa_don.ma_sp', '=', 'san_pham.ma_sp')
                ->where('chi_tiet_hoa_don.ma_hoa_don', $hoadon->ma_hoa_don)
                ->get();
        return view('admin.hoadon.inhoadon')
            ->with('hoadon',$hoadon) 
            ->with('ban',$ban)      
            ->with('cthd', $cthd);
    }
    public function xemhoadon($id)
    {      
        $ban= DB::table('ban')->where('ma_ban',$id)->where('trang_thai', 'da thanh toan')->first();
        $ngay= DB::table('hoa_don')->where('ma_ban',$id)->where('trang_thai', 'da thanh toan')->max('ngay_lap');
        $hoadon= DB::table('hoa_don')->where('ma_ban',$id)->where('trang_thai', 'da thanh toan')->where('ngay_lap', $ngay)->first();

        $cthd = DB::table('chi_tiet_hoa_don')
                ->join('san_pham', 'chi_tiet_hoa_don.ma_sp', '=', 'san_pham.ma_sp')
                ->where('chi_tiet_hoa_don.ma_hoa_don', $hoadon->ma_hoa_don)
                ->get();
        return view('admin.hoadon.hoadon')
            ->with('hoadon',$hoadon) 
            ->with('ban',$ban)      
            ->with('cthd', $cthd);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function thanhtoan(Request $request, $id)
    {
              
        $hoadon = hoa_don::find($id);
        $hoadon->trang_thai = "da thanh toan";
        $hoadon->nv_lap = Auth::user()->ten_dang_nhap;
            $ban = Ban::find($hoadon->ma_ban);
            $ban->trang_thai = "da thanh toan";
                $ban->save();
                $hoadon->save();
        $msg = "Bàn ".($ban->ma_ban)." đã thanh toán (HĐ ".($hoadon->ma_hoa_don).")";

        event(new ThanhtoanPusherEvent($msg));
        return redirect(route('ban'))->with(['flash_level'=>'success','flash_message'=>'Success !! Đã thanh toán']);
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
    public function thanhtoanAPI(Request $request)
    {
        $maban = $request->get('ma_ban');
        $hoadon = DB::table('hoa_don')->where('ma_ban',$maban)->where('trang_thai','chua thanh toan')->first();
        $id = $hoadon->ma_hoa_don;
        $hoadon1 = hoa_don::find($id);
        $hoadon1->trang_thai = "da thanh toan";
        $hoadon1->save();
            $ban = Ban::find($maban);
            $ban->trang_thai = "trong";
                $ban->save();
        return response()->json($hoadon1, 200);     
    
    }

}
