<?php

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\san_pham;
use App\chi_tiet_hoa_don;
use App\hoa_don;
use DB;
use App\cong_thuc;
use App\nguyen_lieu;
use App\Events\PhachePusherEvent;

class PhacheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.phache.index');
    }
    public function dataindex()
    {
            $CHUAPHA = null;
            $DAPHA = "da pha";
            $tonghopchuapha = DB::table('chi_tiet_hoa_don')
                            ->select(DB::raw('SUM(so_luong) as sumsoluong,ten_sp'))
                            ->join('hoa_don','chi_tiet_hoa_don.ma_hoa_don','=','hoa_don.ma_hoa_don')                                     
                            ->join('san_pham','chi_tiet_hoa_don.ma_sp','=','san_pham.ma_sp')
                            ->where('hoa_don.trang_thai','=','chua thanh toan')
                            ->whereNull('chi_tiet_hoa_don.trang_thai')
                            ->groupBy('chi_tiet_hoa_don.ma_sp')
                            ->orderBy('chi_tiet_hoa_don.ma_sp', 'asc')
                            ->get();
            $ctchuapha = DB::table('chi_tiet_hoa_don')
                        ->select('chi_tiet_hoa_don.ma_hoa_don', 'chi_tiet_hoa_don.ma_sp', 'ten_sp', 'so_luong', 'ma_ban', 'chi_tiet_hoa_don.ngay_sua')
                        ->join('hoa_don','chi_tiet_hoa_don.ma_hoa_don','=','hoa_don.ma_hoa_don')                                     
                        ->join('san_pham','chi_tiet_hoa_don.ma_sp','=','san_pham.ma_sp')
                        ->where('hoa_don.trang_thai','=','chua thanh toan')
                        ->whereNull('chi_tiet_hoa_don.trang_thai')
                        ->orderBy('chi_tiet_hoa_don.ngay_sua', 'asc')
                        ->get();
            $ctdapha = DB::table('chi_tiet_hoa_don')
                        ->select('chi_tiet_hoa_don.ma_hoa_don', 'chi_tiet_hoa_don.ma_sp', 'ten_sp', 'so_luong', 'ma_ban', 'chi_tiet_hoa_don.ngay_sua')
                        ->join('hoa_don','chi_tiet_hoa_don.ma_hoa_don','=','hoa_don.ma_hoa_don')                                     
                        ->join('san_pham','chi_tiet_hoa_don.ma_sp','=','san_pham.ma_sp')
                        ->where('hoa_don.trang_thai','=','chua thanh toan')
                        ->where('chi_tiet_hoa_don.trang_thai','=',$DAPHA)
                        ->orderBy('chi_tiet_hoa_don.ngay_sua', 'desc')
                        ->get();            
            // $cthd = DB::table('chi_tiet_hoa_don')
            //             ->join('hoa_don','chi_tiet_hoa_don.ma_hoa_don','=','hoa_don.ma_hoa_don')                                     
            //             ->join('san_pham','chi_tiet_hoa_don.ma_sp','=','san_pham.ma_sp')
            //             ->select('hoa_don.ma_hoa_don','hoa_don.ma_ban','hoa_don.ngay_sua',
            //              'chi_tiet_hoa_don.ma_hoa_don','chi_tiet_hoa_don.ma_sp','chi_tiet_hoa_don.so_luong', 'san_pham.ten_sp')
            //             // ->groupBy('chi_tiet_hoa_don.ma_sp')
            //             ->orderBy('hoa_don.ngay_sua', 'desc')
            //             ->where('hoa_don.trang_thai', "chua thanh toan")
            //             ->where('chi_tiet_hoa_don.trang_thai', null)                     
            //             ->get();                               
            return view('admin.phache.dataindex')
                    ->with('tonghopchuapha', $tonghopchuapha)
                    ->with('ctchuapha',$ctchuapha)
                    ->with('ctdapha',$ctdapha); 

    }

    public function datachuapha()
    {
            $CHUAPHA = null;
            $DAPHA = "da pha";
            $ctchuapha = DB::table('chi_tiet_hoa_don')
                        ->select('chi_tiet_hoa_don.ma_hoa_don', 'chi_tiet_hoa_don.ma_sp', 'ten_sp', 'chi_tiet_hoa_don.so_luong', 'chi_tiet_hoa_don.pha_che', 'ma_ban', 'chi_tiet_hoa_don.ngay_sua')
                        ->join('hoa_don','chi_tiet_hoa_don.ma_hoa_don','=','hoa_don.ma_hoa_don')                                     
                        ->join('san_pham','chi_tiet_hoa_don.ma_sp','=','san_pham.ma_sp')
                        ->where('hoa_don.trang_thai','=','chua thanh toan')
                        ->whereColumn('so_luong', '>', 'pha_che')
                        ->orderBy('chi_tiet_hoa_don.ngay_sua', 'asc')
                        ->get();                 
            return view('admin.phache.data.datachuapha')
                    ->with('ctchuapha',$ctchuapha); 
    }

    public function datadapha()
    {
            $CHUAPHA = null;
            $DAPHA = "da pha";
            $ctdapha = DB::table('chi_tiet_hoa_don')
                        ->select('chi_tiet_hoa_don.ma_hoa_don', 'chi_tiet_hoa_don.ma_sp', 'ten_sp', 'chi_tiet_hoa_don.so_luong', 'chi_tiet_hoa_don.pha_che', 'ma_ban', 'chi_tiet_hoa_don.ngay_sua')
                        ->join('hoa_don','chi_tiet_hoa_don.ma_hoa_don','=','hoa_don.ma_hoa_don')                                     
                        ->join('san_pham','chi_tiet_hoa_don.ma_sp','=','san_pham.ma_sp')
                        ->where('hoa_don.trang_thai','=','chua thanh toan')
                        ->whereColumn('so_luong', '<=', 'pha_che')
                        ->orderBy('chi_tiet_hoa_don.ngay_sua', 'desc')
                        ->get();     
            return view('admin.phache.data.datadapha')
                    ->with('ctdapha',$ctdapha); 
    }

    public function datatonghop()
    {
            $CHUAPHA = null;
            $DAPHA = "da pha";
            $tonghopchuapha = DB::table('chi_tiet_hoa_don')
                            ->select(DB::raw('SUM(chi_tiet_hoa_don.so_luong) - SUM(chi_tiet_hoa_don.pha_che) as sumsoluong,ten_sp'))
                            ->join('hoa_don','chi_tiet_hoa_don.ma_hoa_don','=','hoa_don.ma_hoa_don')                                     
                            ->join('san_pham','chi_tiet_hoa_don.ma_sp','=','san_pham.ma_sp')
                            ->where('hoa_don.trang_thai','=','chua thanh toan')
                            ->whereColumn('so_luong', '>', 'pha_che')
                            ->groupBy('chi_tiet_hoa_don.ma_sp')
                            ->orderBy('chi_tiet_hoa_don.ma_sp', 'asc')
                            ->get();   
            return view('admin.phache.data.datatonghop')
                    ->with('tonghopchuapha', $tonghopchuapha);
    }

    public function dapha($ma_hoa_don,$ma_sp,$so_luong) {
        $currentaction = 'da pha';
        $this->suaTrangthaiCTHoadon($ma_hoa_don,$ma_sp, $so_luong, $currentaction);
        $this->suaSolgNguyenlieuTheoSP($ma_sp, $so_luong, $currentaction);
        
        $banhientai = DB::table('hoa_don')
                            ->select('hoa_don.ma_ban')
                            ->where('hoa_don.ma_hoa_don','=', $ma_hoa_don)
                            ->first();  
        $sphientai = DB::table('san_pham')
                            ->select('san_pham.ten_sp')
                            ->where('san_pham.ma_sp','=', $ma_sp)
                            ->first();  

        $msg = "Bàn ".($banhientai->ma_ban).": ".($so_luong)." ".($sphientai->ten_sp)." đã chế biến (HĐ ".($ma_hoa_don).")";

        event(new PhachePusherEvent($msg));
        return redirect(url("/phache/web/"));
    }

    public function chuapha($ma_hoa_don,$ma_sp,$so_luong) {
        $currentaction = null;
        $this->suaTrangthaiCTHoadon($ma_hoa_don,$ma_sp, $so_luong, $currentaction);
        $this->suaSolgNguyenlieuTheoSP($ma_sp, $so_luong, $currentaction);
        return redirect(url("/phache/web/"));
    }


    private function suaTrangthaiCTHoadon($ma_hoa_don,$ma_sp, $so_luong, $currentaction) {
        $cthd = chi_tiet_hoa_don::where('ma_hoa_don','=',$ma_hoa_don)->where('ma_sp','=',$ma_sp)->first();
        if ($currentaction == 'da pha') {
            $cthd->pha_che = $cthd->pha_che+$so_luong;
        } else {
            $cthd->pha_che = $cthd->pha_che-$so_luong;
        }
        $cthd->save();
    }

    private function suaSolgNguyenlieuTheoSP($ma_sp, $so_luong_cthd, $currentaction) {
        $congthuc = cong_thuc::where('ma_sp','=',$ma_sp)->get();
        foreach ($congthuc as $ct) {
            $ma_nguyen_lieu = $ct->ma_nguyen_lieu;
            $so_luong = $ct->so_luong;
            if ($currentaction == 'da pha') {
                $this->giamSolgNguyenlieu($ma_nguyen_lieu,$so_luong,$so_luong_cthd);
            } else {
                $this->tangSolgNguyenlieu($ma_nguyen_lieu,$so_luong,$so_luong_cthd);
            }
        }
    }

    private function giamSolgNguyenlieu($ma_nguyen_lieu, $so_luong, $so_luong_cthd){
        $nguyenlieu = nguyen_lieu::find($ma_nguyen_lieu);
        $nguyenlieu->so_luong = $nguyenlieu->so_luong - ($so_luong*$so_luong_cthd);
        $nguyenlieu->save();
        
            if($nguyenlieu->so_luong <10 ){
             $msg = "Nguyên liệu ".($nguyenlieu->ten_nguyen_lieu).":  sắp hết. Vui lòng nhập thêm";

            event(new PhachePusherEvent($msg));
                    }
                            
    }

    private function tangSolgNguyenlieu($ma_nguyen_lieu, $so_luong, $so_luong_cthd){
        $nguyenlieu = nguyen_lieu::find($ma_nguyen_lieu);
        $nguyenlieu->so_luong = $nguyenlieu->so_luong + ($so_luong*$so_luong_cthd);
        $nguyenlieu->save();
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
        
        $request->session()->flash('status', 'Đã pha chế xong!');
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
