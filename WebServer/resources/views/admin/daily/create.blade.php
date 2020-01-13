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
      <form name="frmloai" method="POST" action="{{ route('themDl') }}" enctype="multipart/form-data" role="form" class="form-horizontal">
        {{ csrf_field() }}

        <div class="col-md-12"> 
            <h1 class="panel-heading">Thêm đại lý</h1>
            <hr>
          <!-- /.box-header -->
            <div class="box-body">             
              <div class="form-group">
                <label class="col-lg-2 control-label">Tên đại lý</label>
                <div class="col-lg-8">
                <input type="text" class="form-control" name="tendl" id="tendl" value="{{ old('ten') }}"  autofocus placeholder="Nhập tên đại lý">
                </div>
              </div>
              <div class="form-group">
                  <label class="col-lg-2 control-label">Số điện thoại</label>  
                  <div class="col-lg-8">       
                  <input id="sdt" type="tel" class="form-control" maxlength="11" name="sdt" value="{{ old('sdt') }}" placeholder="Nhập số điện thoại">
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Địa chỉ</label>
                    <div class="col-lg-8">
                    <input id="diachi" type="text" class="form-control" name="diachi"  placeholder="Nhập địa chỉ">
                    </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-2 control-label">Tỉnh</label>
                  <div class="col-lg-8">
                  <select name="tinh" id="tinh" class="form-control">
                          <option value="">Chọn tỉnh\thành phố</option>
                          <option value="Can Tho">Cần Thơ</option>
                          <option value="Ca Mau">Cà Mau</option>
                      
                  </select> 
                  </div>                         
                </div>
            
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-md-1"></div>
            <div class="col-lg-offset-3 col-lg-6">
              <button type="submit" class="btn btn-primary">Thêm mới </button>
              <button type="reset" class="btn btn-primary">Nhập lại </button>
              <a href="{{route('daily')}}" class="btn btn-primary">Bỏ qua</a>
            </div>
      </form>
    </div>
</div>
@endsection

