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
      <form name="frmsanpham" method="POST" action="{{ route('themCt') }}" enctype="multipart/form-data" role="form" class="form-horizontal">
        {{ csrf_field() }}

      <div class="col-md-12"> 
        <h1 class="panel-heading">Thêm mới </h1>
        <hr>
        <!-- /.box-header -->
        <!-- form start -->
          <div>
            <div class="form-group">
              <label class="col-lg-2 control-label">Tên món</label>
              <div class="col-lg-8">
                <select name="thucuong" id="thucuong" class="form-control">
                    <option value="">Chọn món</option>
                  @foreach ($sanpham as $sp)
                  
                  <option value="{{ $sp->ma_sp }}">{{ $sp->ten_sp }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-2 control-label">Nguyên liệu</label>
              <div class="col-lg-8">
                <select name="nguyenlieu" id="nguyenlieu" class="form-control">
                    <option value="">Chọn nguyên liệu</option>
                  @foreach ($nguyenlieu as $nl)
                  
                  <option value="{{ $nl->ma_nguyen_lieu }}">{{ $nl->ten_nguyen_lieu }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-2 control-label">Số lượng</label>
              <div class="col-lg-8">
                <input type="text" class="form-control" name="soluong" id="soluong" placeholder="Nhập số lượng">
              </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">Đơn vị tính</label>
                  <div class="col-lg-8">
                    <select name="dvt" id="dvt" class="form-control">
                      <option value="">Chọn đơn vị tính</option>
                      <option value="g">Gam</option>
                      <option value="ml">Mililit</option>
                    </select>
                  </div>
            </div>
          <!-- /.box-body -->
        </div>
      </div>
      <div class="col-md-1"> </div>

      <div class="col-lg-offset-3 col-lg-6">
              <button type="submit" class="btn btn-primary">Thêm mới</button>
              <button type="reset" class="btn btn-primary">Nhập lại</button>
              <a href="{{route('congthuc')}}" class="btn btn-primary">Bỏ qua</a>
      </div>
    </form>
  </div>
</div>
@endsection