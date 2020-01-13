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
      <form name="frmsanpham" method="POST" action="{{ route('suaCt', $congthuc->ma_ct) }}" enctype="multipart/form-data" role="form" class="form-horizontal">
        {{ csrf_field() }}

      <div class="col-md-12"> 
        <h1 class="panel-heading"> Cập nhật </h1>
        <!-- /.box-header -->
        <!-- form start -->
          <div class="box-body">
            <div class="form-group">
              <label class="col-lg-3 control-label">Tên món</label>
              <div class="col-lg-6">
                <select name="thucuong" id="thucuong" class="form-control">
                    @foreach ($sanpham as $sp)
                    <option value="{{ $sp->ma_sp }}" <?php echo ($sp->ma_sp == $congthuc->ma_sp) ? 'selected' : '' ?>>{{ $sp->ten_sp }}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Nguyên liệu</label>
              <div class="col-lg-6">
                <select name="nguyenlieu" id="nguyenlieu" class="form-control">
                    @foreach ($nguyenlieu as $nl)
                    <option value="{{ $nl->ma_nguyen_lieu }}" <?php echo ($nl->ma_nguyen_lieu == $congthuc->ma_nguyen_lieu) ? 'selected' : '' ?>>{{ $nl->ten_nguyen_lieu }}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Số lượng</label>
              <div class="col-lg-6">
                <input type="text" class="form-control" name="soluong" id="soluong" value="{{$congthuc->so_luong}}" placeholder="Vui lòng nhập số lượng">
              </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Đơn vị tính</label>
                  <div class="col-lg-6">
                    <select name="dvt" id="dvt" class="form-control">
                      <option value="">Chọn đơn vị tính</option>
                      <option value="kg" <?php echo ($congthuc->dvt == 'kg') ? 'selected' : '' ?>>Kg</option>
                      <option value="l" <?php echo ($congthuc->dvt == 'l') ? 'selected' : '' ?>>Lít</option>
                    </select>
                  </div>
            </div>
          <!-- /.box-body -->
        </div>
      </div>
      <div class="col-md-1"> </div>

      <div class="col-lg-offset-3 col-lg-6">
              <button type="submit" class="btn btn-primary">Cập nhật</button>
              <button type="reset" class="btn btn-primary">Nhập lại</button>
              <a href="{{route('congthuc')}}" class="btn btn-primary">Bỏ qua</a>
      </div>
    </form>
  </div>
</div>
@endsection
