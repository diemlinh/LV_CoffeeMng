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
    <form name="frmloai" method="POST" action="{{ route('suaNl', $nguyenlieu->ma_nguyen_lieu) }}" enctype="multipart/form-data" role="form" class="form-horizontal">
      {{ csrf_field() }}
      
      <div class="col-md-12"> 
          <h1 class="panel-heading">Cập nhật nguyên liệu </h1>
          <hr>
        <!-- /.box-header -->
        <!-- form start -->
          <div class="box-body">
            <div class="form-group">
              <label class="col-lg-2 control-label">Tên nguyên liệu</label>
              <div class="col-lg-8">
                <input type="text" class="form-control" name="ten" id="ten" value="{{ $nguyenlieu->ten_nguyen_lieu }}"  autofocus>
              </div>
            </div>                           
            <div class="form-group">
                <label class="col-lg-2 control-label">Đơn vị tính</label>
                <div class="col-lg-8">   
                  <select name="dvtinh" id="dvtinh" class="form-control">
                      <option value="">Chọn đơn vị tính</option>
                      <option value="g" <?php echo ($nguyenlieu->dvt == 'g') ? 'selected' : '' ?>>Gam</option>
                      <option value="ml" <?php echo ($nguyenlieu->dvt == 'ml') ? 'selected' : '' ?>>Mililit</option>
                      <option value="chai" <?php echo ($nguyenlieu->dvt == 'chai') ? 'selected' : '' ?>>Chai</option>
                  </select>
                </div>
            </div>
          </div>
          <!-- /.box-body -->

          <div class="col-md-1"> </div>
            <div class="col-lg-offset-3 col-lg-6">
            <button type="submit" class="btn btn-primary">Cập nhật </button>
            <button type="reset" class="btn btn-primary">Nhập lại </button>
            <a href="{{route('nguyenlieu')}}" class="btn btn-primary">Bỏ qua</a>
          </div>
      </div>
    </form>
  </div>
</div>
@endsection

