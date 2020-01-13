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
      <form name="frmsanpham" method="POST" action="{{ route('themTv') }}" enctype="multipart/form-data" role="form" class="form-horizontal">
        {{ csrf_field() }}
        <div class="col-md-12"> 
            <h1 class="panel-heading">Thêm thành viên</h1>
            <hr>
          <!-- /.box-header -->
          <!-- form start -->
            <div class="box-body">
              <div class="form-group">
                <label class="col-lg-2 control-label">Tên đăng nhập</label>
                <div class="col-lg-8">
                <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên đăng nhập">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-2 control-label">Họ tên</label>
                <div class="col-lg-8">
                <input type="text" class="form-control" name="yourname" id="yourname" placeholder="Nhập họ tên">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-lg-2 control-label">Email</label>
                <div class="col-lg-8">
                <input type="email" class="form-control" name="email" id="email" placeholder="Nhập email đúng định dạng abc@abc.com">
                </div>
              </div>
              <div class="form-group">
                      <label class="col-lg-2 control-label">Mật khẩu</label>
                      <div class="col-lg-8">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Nhập mật khẩu">
                      </div>
              </div>
              <div class="form-group">
                      <label class="col-lg-2 control-label">Nhập lại mật khẩu</label>
                      <div class="col-lg-8">
                      <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Nhập lại mật khẩu">
                      </div>
              </div>
              <div class="form-group">
                      <label class="col-lg-2 control-label">Giới tính</label>
                      <div class="col-lg-8">
                      <select name="gioitinh" id="gioitinh" class="form-control">
                              <option value="">Chọn giới tính</option>
                              <option value="Nam">Nam</option>
                              <option value="Nu">Nữ</option>
                      </select>
                      </div>
              </div>
              <div class="form-group">
                      <label class="col-lg-2 control-label">Sinh nhật</label> 
                      <div class="col-lg-8">                       
                          <input type="date" name="sinhnhat" id="sinhnhat" max="2003-12-31" class="form-control" placeholder="Nhập sinh nhật">  
                      </div>                   
              </div>
              <div class="form-group">
                      <label class="col-lg-2 control-label">Địa chỉ</label> 
                      <div class="col-lg-8">              
                          <input id="diachi" type="text" name="diachi" class="form-control" placeholder="Nhập địa chỉ"> 
                      </div>               
              </div>
              <div class="form-group">
                      <label class="col-lg-2 control-label">Số điện thoại</label>   
                      <div class="col-lg-8">            
                          <input id="dienthoai" type="tel" pattern="[0]{1}[0-9]{2,11}" name="dienthoai" class="form-control" placeholder="Nhập số điện thoại">
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
              <div class="form-group">
                      <label class="col-lg-2 control-label">Quyền</label>
                      <div class="col-lg-8">
                          <select name="quyen" id="quyen" class="form-control">
                              <option value="">Chọn quyền</option>
                              <option value="staff">Nhân viên phục vụ</option>
                              <option value="cashier">Nhân viên thu ngân</option>
                              <option value="bartender">Nhân viên pha chế</option>
                              <option value="admin">Quản trị</option>
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
              <a href="{{route('thanhvien')}}" class="btn btn-primary">Bỏ qua</a>
      </div>   
      </form>
    </div>
</div>

@endsection