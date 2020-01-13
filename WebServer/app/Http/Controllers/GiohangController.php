<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\san_pham;
use App\hoa_don;
use App\chi_tiet_hoa_don;
use Cart;

class GiohangController extends Controller
{
    public function showGiohangban($maban) {
        Cart::destroy();
        $sanpham = san_pham::get();
        $hoadon = hoa_don::where([
                                ['ma_ban','=',$maban],
                                ['trang_thai','=','process'],
                                ])->first();
        if($hoadon != null){
            $cthoadon = chi_tiet_hoa_don::where('ma_hoa_don',$hoadon->ma_hoa_don)
                                    ->join('san_pham','chi_tiet_hoa_don.ma_sp','=','san_pham.ma_sp')
                                    ->get();
            foreach ($cthoadon as $cthd){
                Cart::add($cthd->ma_sp, $cthd->ten_sp, $cthd->so_luong, $cthd->don_gia);
            }
            
        }
        
        return view('admin.hoadon.hoadon',compact('sanpham','hoadon'));
    }

    public function editGiohang(){

    }
}