@extends('templates.admin-visitors.index')
@section('content')
 
  <div class="row">
    <div class="col-md-7">
      <div class="panel panel-info">
        <div class="panel-heading">Hóa đơn: {{$hoadon->ma_hoa_don}}</div>
        <div class="panel-body">
            <p><b>Số bàn: </b>{{ $ban->ma_ban}}</p>
            <p><b>Ngày lập: </b>{{$hoadon->ngay_lap}}</p>
            <p><b>Nhân viên: </b>{{ Auth::user()->ten_dang_nhap }}</p>
          <table class="table">

            <tr>
              <th>STT</th>
              <th>Tên món</th>
              <th>Số Lượng</th>
              <th>Đơn giá</th>
              <th>Thành tiền</th>
             
            </tr> 
            <?php $a=1 ?>
            <input type="hidden" name="_token" value="{{ csrf_token()}}">
            @foreach(Cart::content() as $item)
          <tr>
        <form method="POST" action='{{ url("/hoadon/web/giohang/capnhat/$item->rowId?ma_ban=$ban->ma_ban") }}'>
                 {{ csrf_field() }}
                 <td>{{ $a }}</td>
              <td>{{$item->name}}</td>
              <td><input class="form-control" type="number" id="sl" size="1" min="1" name="sl" value="{{$item->qty}}"></td>
              <td>{{ number_format($item->price)}}</td>
              <td>{{ number_format($item->price*$item->qty)}}</td>
              
              <td><button class="btn btn-link" data-toggle="tooltip" title="Sửa" type="submit"><i class="glyphicon glyphicon-floppy-disk text-primary"></i></button></td>
              </form>
              <td><a class="btn btn-link" data-toggle="tooltip" title="Xóa" href="{{ route('xoa', $item->rowId) }}"><i class="glyphicon glyphicon-remove text-danger tb-btn-del"></i></a></td>            

          </tr>
           <?php $a=$a+1; ?> 
           @endforeach
          
          </table>
          <p style="text-align: right;"><b>Tổng tiền: </b><?php echo Cart::subtotal(0,',','.') ;  ?>đ</p>
        </div>
      </div>
      
      <div>
       
       <form method="POST" action="{{ route('updatehoadon',$ban->ma_ban) }}" >
    
      {{ csrf_field() }} 
   <div class="box-footer col-md-12">
      <a href="{{ route('ban') }}" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i> Trở về</a>
      <button type="submit" class="btn btn-primary">Lưu</button>
        
      {{-- <a href="{{ route('xuathoadon',$ban->ma_ban) }}" class="btn btn-success">Xuất hóa đơn<i class="glyphicon glyphicon-arrow-right"></i></a> --}}
    </div>
    </form>
      
   </div>
   </div>
 
    <div class="col-md-5">
      <table class="table table-hover" style="background-color: white" id="dataTables-example">
       <thead class="bg-info"> 
        <tr>
          <th>Hình</th>
          <th>Tên món</th>
          <th>Giá</th>
          <th></th>
        </tr>
       </thead>
        @foreach($sanpham as $sp)
        <tr>
          @if ($sp->hinh_anh == null)
          <td><img src="{{ asset('admin/images/no-image.jpg') }}" width="50px" height="30px" /></td>
          @else
          <td><img src="{{ asset('upload/' . $sp->hinh_anh) }}" width="50px" height="30px" /></td>
          @endif
         
         
          <td>{{$sp->ten_sp}}</td>
          <td>{{$sp->don_gia}}</td>
          <td><a href="{{url('/hoadon/web/goimon?ma_ban='.$ban->ma_ban.'&ma_sp='.$sp->ma_sp)}}"><i style="color: green" class="glyphicon glyphicon-plus"></i></a></td>
        </tr>
       @endforeach
      </table>
    </div>        
    </div>
  </div>
  
    </div>
  </div>
@endsection

