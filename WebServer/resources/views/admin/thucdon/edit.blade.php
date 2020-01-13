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
      <form name="frmsanpham" method="POST" action="{{ route('suaSp', $thucdon->ma_sp) }}" enctype="multipart/form-data" role="form" class="form-horizontal">
        {{ csrf_field() }}

        <div class="col-md-12"> 
            <h1 class="panel-heading">Cập nhật món</h1>
            <hr>
          <!-- /.box-header -->
          <!-- form start -->
            <div class="box-body">
              <div class="form-group">
                <label class="col-lg-2 control-label">Loại</label>
                <div class="col-lg-8">
                <select name="loai" id="loai" class="form-control">
                  @foreach ($loai as $l)
                  <option value="{{ $l->ma_loai }}" <?php echo ($l->ma_loai == $thucdon->ma_loai) ? 'selected' : '' ?>>{{ $l->ten_loai }}</option>
                  @endforeach
                </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-2 control-label">Tên món</label>
                <div class="col-lg-8">
                <input type="text" class="form-control" name="ten" id="ten" value="{{ $thucdon->ten_sp }}">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-2 control-label">Đơn giá</label>
                <div class="col-lg-8">
                <input type="text" class="form-control" name="gia" id="gia" value="{{ $thucdon->don_gia }}">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-lg-2 control-label">Hình đại diện</label>
                <div class="col-lg-8">

                <input type="file" name="hinh" id="hinh" class="filestyle" value="Chọn hình">
              
                <img id="image" src="{{ asset('upload/' . $thucdon->hinh_anh) }}" width="50px" height="50px" onchange="readURL(this);"/>
              </div>  
              </div>
            
              <div class="form-group">
                <label class="col-lg-2 control-label">Trạng thái</label>
                <div class="col-lg-8">
                <select name="trangthai" id="trangthai" class="form-control">       
                  <option value="con km" <?php echo ('con km' == $thucdon->trang_thai) ? 'selected' : '' ?>>Còn khuyến mãi</option>
                  <option value="het km" <?php echo ('het km' == $thucdon->trang_thai) ? 'selected' : '' ?>>Hết khuyến mãi</option>
                  <option value="nghi ban" <?php echo ('nghi ban' == $thucdon->trang_thai) ? 'selected' : '' ?>>Ngừng bán</option>                 
                </select>
                </div>
            </div>

            <!-- /.box-body -->

        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-lg-offset-4 col-lg-6">
              <button type="submit" class="btn btn-primary">Cập nhật</button>
              <a href="{{ route('thucdon') }}" class="btn btn-primary">Hủy</a>

      </div>
      </form>
    </div>
</div>

@endsection