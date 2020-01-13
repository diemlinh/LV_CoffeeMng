<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Http\Request as IRequest;
use App\hoa_don;
use App\ban;
use DB;
use App\san_pham;
use App\chi_tiet_hoa_don;
use Cart;
use App\cong_thuc;
use App\nguyen_lieu;
use App\gio_hang;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;
use App\Events\PhachePusherEvent;

class OrderController extends Controller
{
    //Kiểm tra trạng thái bàn
    public function order($id)
    {
        $ban = Ban::find($id);  
        $sanpham = san_pham::where('trang_thai', '<>', 'nghi ban')->get();
        $hoadon= DB::table('hoa_don')->where('ma_ban',$id)->where('trang_thai', 'chua thanh toan')->first();
        if($hoadon == null){
            $hoadon = new hoa_don();
            $hoadon->ngay_lap = Carbon::now(); 
        }
        if(Request::get('from') != null){
            Cart::destroy();
            
            if($hoadon <> null){
                $cthd = chi_tiet_hoa_don::where('ma_hoa_don',$hoadon->ma_hoa_don)
                                        ->join('san_pham','chi_tiet_hoa_don.ma_sp','=','san_pham.ma_sp')
                                        ->get();
                foreach ($cthd as $ct){
                    Cart::add($ct->ma_sp, $ct->ten_sp, $ct->so_luong, $ct->don_gia);
                }
            }
        }
        return view('admin.order.order')
            ->with('hoadon',$hoadon)
            ->with('sanpham',$sanpham)
            ->with('ban', $ban);    
    }
    public function goimon()
    {
        $rows = Cart::search(function($key, $value) {
            return $key->id == Request::get('ma_sp');
        });
        if($rows->first() != null){
            $item = $rows->first();
            Cart::update($item->rowId, $item->qty + 1);
        } else {
            $sanpham = san_pham::find(Request::get('ma_sp'));
            Cart::add(array(
                'id' => Request::get('ma_sp'),
                'name' => $sanpham->ten_sp,
                'qty' => 1,
                'price' => $sanpham->don_gia,
            ));
        }
        return redirect(url("/hoadon/web/order/".Request::get('ma_ban')));
    }
    public function capnhat($id, IRequest $request)
    {
    	
        $qty = $request->sl;
        Cart::update($id, $qty); 
        return redirect(url("/hoadon/web/order/".Request::get('ma_ban')))->with(['flash_level'=>'success','flash_message'=>'Success !! Cập nhật thành công']);;
    }
    public function xoa($id)
    {      
       Cart::remove($id);
       return back();
    }

    public function updatehoadon($id)
    {
      
        $ban = ban::find($id);
        if($ban->trang_thai == "chua thanh toan"){
        $hoadontam = DB::table('hoa_don')->where('ma_ban',$id)->where('trang_thai', 'chua thanh toan')->first();
        if($hoadontam <>null){
        // $giohang = hoa_don::find($id);
        $cartInfor = Cart::content();
        $hoadon = hoa_don::find($hoadontam->ma_hoa_don);
        $hoadon->nv_lap = Auth::user()->ten_dang_nhap;
        $hoadon->tong_tien = str_replace(',', '', Cart::subtotal());
            $hoadon->save();          

                if (count($cartInfor) > 0) {
                    foreach ($cartInfor as $key => $item) {
                        $ct = chi_tiet_hoa_don::where('ma_hoa_don', $hoadontam->ma_hoa_don)->where('ma_sp', $item->id)->first();
                        if($ct <> null){
                            $ct->so_luong = $item->qty;
                            $ct->thanh_tien = $item->price*$item->qty;
                            $ct->save();
                        }
                        else{
                            $ctdh = new chi_tiet_hoa_don();
                            $ctdh->ma_hoa_don = $hoadontam->ma_hoa_don;
                            $ctdh->ma_sp = $item->id;
                            $ctdh->so_luong = $item->qty;
                            $ctdh->pha_che = 0;
                            $ctdh->don_gia = $item->price;
                            $ctdh->thanh_tien = $item->price*$item->qty;
                            $ctdh->save();
                        }
                        
                    }
                }
            }
        }
            else
            {
                $hoadon1 = new hoa_don();
                $hoadon1->ma_ban = $id;
                $hoadon1->nv_lap = Auth::user()->ten_dang_nhap;
                $hoadon1->tong_tien = str_replace(',', '', Cart::subtotal());
                $hoadon1->trang_thai = "chua thanh toan";
                $hoadon1->save();
                        $ban = Ban::find($id);
                        $ban->trang_thai = "chua thanh toan";
                        $ban->save();                
                        $cartInfor = Cart::content();
                if (count($cartInfor) >0) {
                    foreach ($cartInfor as $key => $item) {
                        $ctdh = new chi_tiet_hoa_don();
                        $ctdh->ma_hoa_don = $hoadon1->ma_hoa_don;
                        $ctdh->ma_sp = $item->id;
                        $ctdh->so_luong = $item->qty;
                        $ctdh->pha_che = 0;
                        $ctdh->don_gia = $item->price;
                        $ctdh->thanh_tien = $item->price*$item->qty;
                        $ctdh->save();
                        
                    }
                }
            }

        Cart::destroy();
        return redirect(route('ban'))->with(['flash_level'=>'success','flash_message'=>'Success !! Order thành công']);

    }

    /////////////////API/////////////////
    public function orderAPI($id)
    {
        $ban = Ban::find($id);
        $hoadon = DB::table('hoa_don')->where('ma_ban',$id)->where('trang_thai', 'chua thanh toan')->first();       
       
        if($hoadon == null){
            $giohang = new gio_hang();
            $giohang->ma_ban = $id;
            $giohang->ma_sp = null;
            $giohang->ten_sp = null;
            $giohang->so_luong = 0;
            $giohang->don_gia = 0;
            $giohang->thanh_tien = 0;
            $giohang->ghi_chu = null;
        }      
        return $giohang; 
            
    }
    public function hoadonAPI($id)
    {
        $ban = Ban::find($id);
        $hoadon = DB::table('hoa_don')->where('ma_ban',$id)->where('trang_thai', 'chua thanh toan')->first();
       
        if($hoadon == null){
            
            $hoadon = new hoa_don();
            $hoadon->ma_hoa_don = 0;
            $hoadon->ma_ban = $id;
            $hoadon->ngay_lap = Carbon::now();
            $hoadon->trang_thai = null;
            $hoadon->tong_tien = 0;
            $hoadon->ngay_sua = Carbon::now();
            $hoadon->nv_lap = null;  
            
                   

    }
    return response()->json($hoadon, 200); 
}
    public function themgiohangAPI($ma_ban, IRequest $request){
        $ban = ban::find($ma_ban);
        // if($ban->trang_thai == "trong"){
        //     $ban->trang_thai = "co khach";
        //     $ban->save();
        // }
        $giohang = gio_hang::where('ma_sp',$request->get("ma_sp"))->first();
        if($giohang <> null){
            $giohang->so_luong = $giohang->so_luong + $request->get("so_luong");
            $giohang->thanh_tien = $giohang->so_luong * $giohang->don_gia;
            $giohang->save();
        }
        else{
        $sanpham = san_pham::find($request->get("ma_sp"));     
        $giohang = new gio_hang();
        $giohang->ma_sp = $request->get("ma_sp");
        $giohang->ma_ban = $ma_ban;
        $giohang->ten_sp = $sanpham->ten_sp;
        $giohang->so_luong = $request->get("so_luong");
        $giohang->don_gia = $sanpham->don_gia;
        $giohang->thanh_tien = $giohang->so_luong * $giohang->don_gia;
        $giohang->ghi_chu = $request->get("ghi_chu");
        $giohang->save();
        }
        return response()->json($giohang, 200);


    }
    public function capnhatSLAPI($id, IRequest $request){
        $giohang = gio_hang::where('ma_sp',$id)->first();
        $giohang->so_luong = $request->get('so_luong');
        $giohang->thanh_tien = $giohang->so_luong * $giohang->don_gia;
        $giohang->save();
        $message = "Cập nhật thành công!";
        return response()->json($message, 200); 
    }
    public function capnhatAPI($id, IRequest $request){
        $giohang = gio_hang::where('ma_sp',$id)->first();
        // $giohang->so_luong = $request->get('so_luong');
        // $giohang->thanh_tien = $giohang->so_luong * $giohang->don_gia;
        $giohang->ghi_chu = $request->get('ghi_chu');
        $giohang->save();
        $message = "Cập nhật thành công";
        return response()->json($message, 200); 
    }
    public function xoagiohangAPI($id){
        $giohang = gio_hang::where('ma_ban',$id);
        $giohang->delete(); 
        $message = "Xóa thành công";
        return response()->json($message, 200); 
    }
    public function chitiethoadonAPI($id)
    {
        $ban = Ban::find($id);
        $giohang = gio_hang::where('ma_ban', '<>', $id);
                if($giohang <> null){
                    $giohang->delete();
                }
        if($ban->trang_thai == "chua thanh toan"){
        $hoadon = DB::table('hoa_don')->where('ma_ban',$id)->where('trang_thai', 'chua thanh toan')->first();
                                             
                $giohang1 = gio_hang::where('ma_ban',$id)->first();
                if($giohang1 <> null){
                    $giohang = gio_hang::select('gio_hang.ma_sp', 'gio_hang.ten_sp', 'gio_hang.so_luong', 'gio_hang.don_gia',
                    'gio_hang.thanh_tien', 'gio_hang.ghi_chu')->get();
                    return response()->json($giohang);     
                }   
                else{  
                    $giohang = gio_hang::where('ma_ban', $id);
                    $giohang->delete();
                
                    $cthd = chi_tiet_hoa_don::where('ma_hoa_don',$hoadon->ma_hoa_don)
                                        ->join('san_pham','chi_tiet_hoa_don.ma_sp','=','san_pham.ma_sp')
                                        ->select('chi_tiet_hoa_don.ma_sp', 'san_pham.ten_sp', 'chi_tiet_hoa_don.so_luong', 'chi_tiet_hoa_don.don_gia',
                                        'chi_tiet_hoa_don.thanh_tien', 'chi_tiet_hoa_don.ghi_chu')
                                        ->get();            
                    $giohangRS = new Collection();
                    foreach($cthd as $ct){
                        $giohang = new gio_hang();
                        $giohang->ma_ban = $id;
                        $giohang->ma_sp = $ct->ma_sp;
                        $giohang->ten_sp = $ct->ten_sp;
                        $giohang->so_luong = $ct->so_luong;
                        $giohang->don_gia = $ct->don_gia;
                        $giohang->thanh_tien = $ct->thanh_tien;
                        $giohang->ghi_chu = $ct->ghi_chu;
                        $giohangRS->push($giohang);
                        $giohang->save();
                    }
                //     $giohang = gio_hang::select('gio_hang.ma_sp', 'gio_hang.ten_sp', 'gio_hang.so_luong', 'gio_hang.don_gia',
                // 'gio_hang.thanh_tien', 'gio_hang.ghi_chu')->get();     
                    return response()->json($giohangRS);                     
                }
                               
            }
            else{
                $giohang = gio_hang::where('ma_ban',$id)->first();
                if($giohang <> null){
                    $giohang = gio_hang::select('gio_hang.ma_sp', 'gio_hang.ten_sp', 'gio_hang.so_luong', 'gio_hang.don_gia',
                'gio_hang.thanh_tien', 'gio_hang.ghi_chu')->get();
                }  
                else{
                    $giohang = new gio_hang();
                    $giohang->ma_ban = $id;
                    $giohang->ma_sp = 0;
                    $giohang->ten_sp = null;
                    $giohang->so_luong = 0;
                    $giohang->don_gia = 0;
                    $giohang->thanh_tien = 0;
                    $giohang->ghi_chu = null;
                    
                }
                return response()->json($giohang, 200);
            }
        

        
        return $giohang;
    }
    public function luuhoadonAPI($id, IRequest $request)
    {
        $ban = Ban::find($id);
        $hoadontam = DB::table('hoa_don')->where('ma_ban',$id)->where('trang_thai', 'chua thanh toan')->first();
        if($ban->trang_thai == "chua thanh toan"){
        
                $hoadon = hoa_don::find($hoadontam->ma_hoa_don);
                $hoadon->tong_tien = $request->get('tong_tien');
                $hoadon->save();   
                        $giohang = gio_hang::all();                 
                        foreach ($giohang as $gh) {
                            $ct = chi_tiet_hoa_don::where('ma_hoa_don', $hoadontam->ma_hoa_don)->where('ma_sp', $gh->ma_sp)->first();
                            if($ct <> null){
                                $ct->so_luong = $gh->so_luong;
                                $ct->thanh_tien = $gh->thanh_tien;
                                $ct->ghi_chu = $gh->ghi_chu;
                                $ct->save();
                            
                            }
                            else{
                                $ctdh = new chi_tiet_hoa_don();
                                $ctdh->ma_hoa_don = $hoadontam->ma_hoa_don;
                                $ctdh->ma_sp = $gh->ma_sp;
                                $ctdh->so_luong = $gh->so_luong;
                                $ctdh->pha_che = 0;
                                $ctdh->don_gia = $gh->don_gia;
                                $ctdh->thanh_tien = $gh->thanh_tien;
                                $ctdh->ghi_chu = $gh->ghi_chu;
                                $ctdh->save();
                            }
                            
                        }
                        
                        $giohang = gio_hang::where('ma_ban',$id);
                        $giohang->delete();
                        $message = "Order thành công!";
                        $msg = "1 order mới bàn ".($id)."";

                         event(new PhachePusherEvent($msg));
                    
            }
                else
                {
                    $hoadon = new hoa_don();
                    $hoadon->ma_ban = $id;
                    $hoadon->tong_tien = $request->get('tong_tien');
                    $hoadon->trang_thai = "chua thanh toan";
                    $hoadon->save();
                    $giohang = gio_hang::all(); 
                    $hoadon1 = DB::table('hoa_don')->where('ma_ban',$id)->where('trang_thai', 'chua thanh toan')->first();
                        foreach ($giohang as $gh) {
                            $ctdh = new chi_tiet_hoa_don();
                                $ctdh->ma_hoa_don = $hoadon1->ma_hoa_don;
                                $ctdh->ma_sp = $gh->ma_sp;
                                $ctdh->so_luong = $gh->so_luong;
                                $ctdh->pha_che = 0;
                                $ctdh->don_gia = $gh->don_gia;
                                $ctdh->thanh_tien = $gh->thanh_tien;
                                $ctdh->ghi_chu = $gh->ghi_chu;
                                $ctdh->save();
                        } 
                            $ban = Ban::find($id);
                            $ban->trang_thai = "chua thanh toan";
                            $ban->save();                
                    
                        $giohang = gio_hang::where('ma_ban',$id);
                        $giohang->delete();      
                        $message = "Order thành công!";  
                        $msg = "1 order mới bàn ".($id)."";

                         event(new PhachePusherEvent($msg));          
                }
                
                // $msg = "Bàn ".($id).": có order mới";

                // event(new PhachePusherEvent($msg));
                // return redirect(route('ban'));
                return response()->json($message, 200);
        }
        public function getSolgPhacheTrongHD($hoadonId, $sanphamId) {
            $chitiethoadonRS = DB::table('chi_tiet_hoa_don')->where('ma_hoa_don',$hoadonId)->where('ma_sp', $sanphamId)->first();
            return response()->json($chitiethoadonRS->pha_che, 200);
        }
}


