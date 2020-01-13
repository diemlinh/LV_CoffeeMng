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
    <form name="frmloai" method="POST" action="{{ route('suaDl', $daily->ma_dai_ly) }}" enctype="multipart/form-data" role="form" class="form-horizontal">
      {{ csrf_field() }}

      <div class="col-md-12"> 
          <h1 class="panel-heading">Cập nhật đại lý</h1>
          <hr>
        <!-- /.box-header -->
        <!-- form start -->
          <div class="box-body">
            <div class="form-group">
              <label class="col-lg-2 control-label">Tên đại lý</label>
              <div class="col-lg-8">
              <input type="text" class="form-control" name="tendl" id="tendl" value="{{ $daily->ten_dai_ly }}"  autofocus>
              </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" >Số điện thoại</label>  
                <div class="col-lg-8">       
                <input id="sdt" type="text" class="form-control" maxlength="11" name="sdt" value="{{ $daily->so_dien_thoai }}" >
                </div>
              </div>
              <div class="form-group">
                  <label class="col-lg-2 control-label">Địa chỉ</label>
                  <div class="col-lg-8">
                  <input id="diachi" type="text" class="form-control" name="diachi" value="{{ $daily->dia_chi }}" >
                  </div>
              </div>
              <div class="form-group">
                <label class="col-lg-2 control-label">Tỉnh</label>
                <div class="col-lg-8">
                <select name="tinh" id="tinh" class="form-control">
                        <option value="Chọn tỉnh\thành phố"></option>
                        <option value="Can Tho" <?php echo ('Can Tho' == $daily->tinh) ? 'selected' : '' ?>>Cần Thơ</option>
                        <option value="Ca Mau" <?php echo ('Ca Mau' == $daily->tinh) ? 'selected' : '' ?>>Cà Mau</option>
                    
                </select>
                </div>                          
              </div>
          <!-- /.box-body -->
        </div>
      </div>
      <div class="col-md-1"></div>
          <div class="col-lg-offset-4 col-lg-6">
            <button type="submit" class="btn btn-primary">Cập nhật </button>
            <a href="{{route('daily')}}" class="btn btn-primary">Hủy</a>
          </div>
        </form>
    </div>
</div>
    
@endsection

