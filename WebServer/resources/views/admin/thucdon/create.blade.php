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
      <form name="frmsanpham" method="POST" action="{{ route('themSp') }}" enctype="multipart/form-data" role="form" class="form-horizontal">
        {{ csrf_field() }}
        <div class="col-md-12"> 
            <h1 class="panel-heading">Thêm món mới</h1>
            <hr>
          <!-- /.box-header -->
          <!-- form start -->
            <div class="box-body">
              <div class="form-group">
                <label class="col-lg-2 control-label">Loại</label>
                <div class="col-lg-8">
                <select name="loai" id="loai" class="form-control">\
                  <option value="">Chọn loại</option>
                  @foreach ($loai as $l)
                  <option value="{{ $l->ma_loai }}">{{ $l->ten_loai }}</option>
                  @endforeach
                </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-2 control-label">Tên món</label>
                <div class="col-lg-8">
                <input type="text" class="form-control" name="ten" id="ten" placeholder="Vui lòng nhập tên thức uống">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-2 control-label">Đơn giá</label>
                <div class="col-lg-8">
                <input type="number" class="form-control" name="gia" id="gia" placeholder="Vui lòng nhập đơn giá">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-lg-2 control-label">Hình đại diện</label>
                <div class="col-lg-8">
                <input type="file" name="hinh" id="hinh" >
                </div>
              </div>
            
              <div class="form-group">
                <label class="col-lg-2 control-label">Trạng thái</label>
                <div class="col-lg-8">
                <select name="trangthai" id="trangthai" class="form-control">
                  <option value="">Chọn khuyến mãi</option>
                  <option value="con km">Còn khuyến mãi</option>
                  <option value="het km">Hết khuyến mãi</option>
                  <option value="nghi ban">Ngừng bán</option>
                  
                </select>
                </div>
              </div>
            <!-- /.box-body -->

        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-lg-offset-3 col-lg-6">
              <button type="submit" class="btn btn-primary">Thêm mới</button>
              <button type="reset" class="btn btn-primary">Nhập lại</button>
              <a href="{{route('thucdon')}}" class="btn btn-primary">Bỏ qua</a>
      </div>
      </form>
  </div>
</div>
@endsection