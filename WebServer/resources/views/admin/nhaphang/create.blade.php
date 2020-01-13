@extends('templates.admin-visitors.index')
@section('content')
<div class="wthree-font-awesome ">
    <div class="container-fluid">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
<form name="frmsanpham" method="POST" action="{{ route('themnhap') }}" enctype="multipart/form-data" role="form" class="form-horizontal">
  {{ csrf_field() }}
  <div class="col-md-12"> 
      <h1 class="panel-heading">Nhập hàng</h1>
      <hr>
    <!-- /.box-header -->
    <!-- form start -->
      <div class="box-body">
        <div class="form-group">
          <label class="col-lg-2 control-label">Đại lý</label>
          <div class="col-lg-8">
          <select name="tendaily" id="tendaily" class="form-control">
            <option>Chọn đại lý</option>
            @foreach ($daily as $dl)
            <option value="{{ $dl->ma_dai_ly }}">{{ $dl->ten_dai_ly }}</option>
            @endforeach
          </select>
          </div>
        </div>
         <div class="box-body">
        <div class="form-group">
          <label class="col-lg-2 control-label">Nguyên liệu</label>
          <div class="col-lg-8">
          <select name="tennguyenlieu" id="tennguyenlieu" class="form-control">
            <option>Chọn nguyên liệu</option>
            @foreach ($nguyenlieu as $nl)
            <option value="{{ $nl->ma_nguyen_lieu }}">{{ $nl->ten_nguyen_lieu }}</option>
            @endforeach
          </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-2 control-label">Số lượng</label>
          <div class="col-lg-8">
          <input type="number" min="1" class="form-control" name="soluong" id="soluong" placeholder="Vui lòng nhập số lượng">
          </div>
        </div>
         <div class="form-group">
          <label class="col-lg-2 control-label">Đơn vị tính</label>
          <div class="col-lg-8">
          <select name="dvit" id="dvit" class="form-control">
            <option>Chọn đơn vị tính </option>
            <option value="g">Gam</option>
            <option value="ml">Mililit</option>
            <option value="chai">Chai</option>
           
          </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-2 control-label">Giá nhập</label>
          <div class="col-lg-8">
          <input type="number" class="form-control" name="gia" id="gia" placeholder="Vui lòng nhập giá">
          </div>
        </div>

      <!-- /.box-body -->

  </div>

<div class="col-md-1">
  
</div>

<div class="col-lg-offset-3 col-lg-6">
        <button type="submit" class="btn btn-success">Thêm mới</button>
        <button type="reset" class="btn btn-success">Nhập lại</button>
        <a href="{{route('nhap')}}" class="btn btn-primary">Bỏ qua</a>
      </div>


</form>
</div>
</div>

@endsection