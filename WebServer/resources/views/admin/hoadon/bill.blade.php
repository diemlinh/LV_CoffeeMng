@section('content')
<div class="row">
    <div class="col-md-7">
      <div class="panel panel-info">
        <div class="panel-heading">Hóa đơn: {{$hoadon->ma_hoa_don}}</div>
        <div class="panel-body">
            <p><b>Số bàn: </b>{{ $hoadon->ma_ban}}</p>
            <p><b>Ngày lập: </b>{{$hoadon->ngay_lap}}</p>
            <p><b>Nhân viên lập: </b></p>
      
          <table class="table">

            <tr>
              <th>STT</th>
              <th>Tên món</th>
              <th>Số Lượng</th>
              <th>Đơn giá</th>
              <th>Thành tiền</th>
              
             
            </tr> 
            <?php $a=1 ?>
             @foreach($cthd as $ct)       
            <tr>
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
      @endsection