@extends('templates.admin-visitors.index')
@section('content')
 
<div class="wthree-font-awesome ">
<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách khuyến mãi</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
 
  <div class="row">
    <div class="col-md-8">
      <table class="table table-hover table-striped" id="dataTables-example">
        <thead class="bg-info">
        <tr>
        <th>Mã khuyến mãi</th>
        <th>Tên khuyến mãi</th>
        <th>Ngày bắt đầu</th>
         <th>Ngày kết thúc</th>
         <th>Tạo KM</th>
         <th></th>
         <th></th>
      </tr>
    </thead>
      @foreach($khuyenmai as $km)
      <tr>
        <form method="POST" action="{{ route('suaKm', $km->ma_khuyen_mai) }}">
              {{ csrf_field() }}
        <td>
         <?php $ctkm = DB::table('chi_tiet_khuyen_mai')->where('ma_khuyen_mai', $km->ma_khuyen_mai)->count(); ?>
          @if($ctkm == 0)
           <a class="a-disable" href="{{ route('chitietkm', $km->ma_khuyen_mai) }}"><i class="fa fa-play fa-fw"></i> </a> {{$km->ma_khuyen_mai}}
          @else
          <a href="{{ route('chitietkm', $km->ma_khuyen_mai) }}"><i class="fa fa-play fa-fw"></i> </a> {{$km->ma_khuyen_mai}}
          @endif
        </td>
        <td><input type="text" id="tenkm" name="tenkm" value="{{$km->ten_khuyen_mai}}" required></td>
        <td><input type="date" id="batdau"size="10" name="batdau" value="{{$km->ngay_bat_dau}}" required></td>
        <td><input type="date" id="ketthuc" name="ketthuc" value="{{$km->ngay_ket_thuc}}" required></td>
        <td> 
                <a href="{{ route('createCtkm', $km->ma_khuyen_mai) }}"><i class="fa fa-arrow-right fa-fw"></i> </a>
        </td>
        <td>
           
              <button type="submit" class="fa fa-pencil" style="color:blue;"></button>
            
        </td>
      </form>
        <td>
          <form method="POST" action="{{ route('xoaKm', $km->ma_khuyen_mai) }}">
              {{ csrf_field() }}
             
              <button type="submit" class="fa fa-remove" style="color:red;" onclick="return ktra()"></button>
            </form>
        </td>
      </tr>
      @endforeach
      
    </table>
    </div>
    <form method="POST" action="{{ route('themKm') }}" enctype="multipart/form-data" >
   {{ csrf_field() }}
    <div class="col-md-4">
      <div class="panel panel-info">
        <div class="panel-heading">Thêm Khuyến mãi</div>
        <div class="panel-body">
         <div class="form-group">
      <label for="inputText3" class="col-sm-3 control-label">Tên</label>
      <div class="col-xs-3">
        <input type="text" id="themkm" name="themkm" value="{{ old('themkm') }}" required>
      </div>
         </div>
        </div>
     
      <div class="panel-body">
      <div class="form-group">
      <label for="inputText3" class="col-sm-3 control-label">Bắt đầu</label>
      <div class="col-xs-3">
        <input type="date" id="ngaybd" name="ngaybd" required>
      </div>
      </div>
      </div>
      <div class="panel-body">
      <div class="form-group">
      <label for="inputText3" class="col-sm-3 control-label">Kết thúc</label>
      <div class="col-xs-3">
        <input type="date" id="ngaykt" name="ngaykt" required>
      </div>
      </div>
      </div>

    </div>
      
      <button type="submit" class="btn btn-primary">Lưu</button>
       <button type="reset" class="btn btn-success">Nhập lại</button>
    
     
    </div>
  </form>
  <hr>

  </div>
</div>
    <script language="javascript">
      function ktra()
    {  
      if(confirm("Bạn có chắc chắn muốn xóa ")) 
      { 
        return true;
      }
       else 
       { 
          return false;
      }
    }
    </script>
@endsection

