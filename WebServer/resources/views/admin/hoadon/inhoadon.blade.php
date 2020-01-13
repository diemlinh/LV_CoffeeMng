@extends('templates.admin-visitors.index')
@section('content')
<div class="wthree-font-awesome ">
<div class="row" style="margin: 0 auto;">
    <div class="container-fluid">
      <div class="col-md-8">
      
      <div id="print-area" class="panel panel-info">
        
        <div class="panel-heading" style="text-align: center; font-size: 20px;">Linh's Cafe
        </div>
        <div style="text-align: center; font-size: 13px;">
          Địa chỉ: Khoa CNTT & TT, ĐHCT
        </div>
        <hr style="color: blue;">
        <div class="panel-body">
            <p>
              <div class="col-md-6"><b>Hóa đơn: </b> {{$hoadon->ma_hoa_don}}</div>
              <div class="col-md-6" style="text-align: end;"><b>Số bàn: </b>{{ $hoadon->ma_ban}}</div>
            </p>
            <p>
                <div class="col-md-6"><b>Ngày lập: </b>{{$hoadon->ngay_lap}}</div>
                <div class="col-md-6" style="text-align: end;"><b>Nhân viên lập: </b>{{ Auth::user()->ten_dang_nhap }}</div>
              </p>
              <hr style="color: blue;">
      <div style="text-align: center">
          <table class="table" style=" width: -webkit-fill-available;">

            <tr style="text-align: center">
              <th style="text-align: center">STT</th>
              <th style="text-align: center">Tên món</th>
              <th style="text-align: center">Số Lượng</th>
              <th style="text-align: center">Đơn giá</th>
              <th style="text-align: center">Thành tiền</th>
              
             
            </tr> 
            <?php $a=1 ?>
             @foreach($cthd as $ct)       
            <tr style="text-align: center">
              <td>
                  {{ $a }}
              </td>
              <td>{{$ct->ten_sp}}</td>
              <td>{{$ct->so_luong}}</td>
              <td>{{ number_format($ct->don_gia) }}</td>
               <td>{{ number_format($ct->thanh_tien) }}</td>  
                        
            </tr>
            <?php $a=$a+1; ?>  
            @endforeach
          </table>
           <p style="text-align: right;"><b>Tổng cộng: </b> {{ number_format($hoadon->tong_tien) }}đ</p>
           <p style="text-align: center;color: red;">Cảm ơn quý khách đã ủng hộ!!!</p>
      </div>
        </div>
      </div>
      </div>
      
      <div>
       <form method="POST" action="{{ route('thanhtoan',$hoadon->ma_hoa_don) }}" >
   {{ csrf_field() }} 
   <div class="box-footer col-md-12">
       <button type="submit" class="btn btn-success" id="thanhtoan">Thanh toán</button> 
     </div>
     </form>
    </div>
    <p><a href="{{ route('ban') }}" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i> Trở về</a></p>
    </div>
</div>
</div>
@endsection