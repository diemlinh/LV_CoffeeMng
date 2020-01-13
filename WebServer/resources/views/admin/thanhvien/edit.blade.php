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
        <form name="frmsanpham" method="POST" action="{{ route('suaTv', $thanhvien->ma_tv) }}" enctype="multipart/form-data" role="form" class="form-horizontal">
        {{ csrf_field() }}
        <div class="col-md-12"> 
                <h1 class="panel-heading">Cập nhật thành viên</h1>
                <hr>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
                <div class="form-group">
                <label class="col-lg-2 control-label">Tên đăng nhập</label>
                <div class="col-lg-8">
                <input type="text" class="form-control" name="name" id="name" minlength="8" value="{{ $thanhvien->ten_dang_nhap }}">
                </div>        
        </div>
                <div class="form-group">
                <label class="col-lg-2 control-label">Họ tên</label>
                <div class="col-lg-8">
                <input type="text" class="form-control" name="yourname" id="yourname" value="{{ $thanhvien->ho_ten }}">
                </div>
        </div>
                
                <div class="form-group">
                <label class="col-lg-2 control-label">Email</label>
                <div class="col-lg-8">
                <input type="email" name="email" id="email" class="form-control" value="{{ $thanhvien->email }}" placeholder="abc@abc.com">
                </div>        
        </div>
                <div class="form-group">
                        <label class="col-lg-2 control-label">Mật khẩu</label>
                        <div class="col-lg-8">
                        <input type="password" name="password" id="password" class="form-control" minlength="8">
                        </div>
                </div>
                <div class="form-group">
                        <label class="col-lg-2 control-label">Nhập lại mật khẩu</label>
                        <div class="col-lg-8">
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" minlength="8">
                        </div>
                </div>
                <div class="form-group">
                        <label class="col-lg-2 control-label">Giới tính</label>
                        <div class="col-lg-8">
                        <select name="gioitinh" id="gioitinh" class="form-control">
                                <option value="Nam" <?php echo ('Nam' == $thanhvien->gioi_tinh) ? 'selected' : '' ?>>Nam</option>
                                <option value="Nu" <?php echo ('Nu' == $thanhvien->gioi_tinh) ? 'selected' : '' ?>>Nữ</option>
                        </select>
                        </div>
                </div>
                <div class="form-group">
                        <label class="col-lg-2 control-label">Sinh nhật</label>    
                        <div class="col-lg-8">                    
                        <input type="date" name="sinhnhat" id="sinhnhat" max="2000-12-31" class="form-control" value="{{ $thanhvien->sinh_nhat }}">                     
                        </div>                
                </div>
                <div class="form-group">
                        <label class="col-lg-2 control-label">Địa chỉ</label>  
                        <div class="col-lg-8">             
                        <input id="diachi" type="text" name="diachi" class="form-control" value="{{ $thanhvien->dia_chi }}">                
                        </div>
                </div>
                <div class="form-group">
                        <label class="col-lg-2 control-label">Số điện thoại</label>   
                        <div class="col-lg-8">            
                        <input id="dienthoai" type="tel" maxlength="11" minlength="10" pattern="[0]{1}[0-9]{2,11}" name="dienthoai" value="{{ $thanhvien->so_dt }}" class="form-control">                
                        </div>
                </div>
                <div class="form-group">
                        <label class="col-lg-2 control-label">Tỉnh</label>
                        <div class="col-lg-8">
                        <select name="tinh" id="tinh" class="form-control">
                                <option value="">Chọn tỉnh\thành phố</option>
                                <option value="Can Tho" <?php echo ('Can Tho' == $thanhvien->tinh) ? 'selected' : '' ?>>Cần Thơ</option>
                                <option value="Ca Mau" <?php echo ('Ca Mau' == $thanhvien->tinh) ? 'selected' : '' ?>>Cà Mau</option>
                        
                        </select>   
                        </div>                       
                </div>
                <div class="form-group">
                        <label class="col-lg-2 control-label">Trạng thái</label>
                        <div class="col-lg-8">
                        <select name="trangthai" id="trangthai" class="form-control">
                                <option value="">Chọn trạng thái</option>
                                <option value="available" <?php echo ('available' == $thanhvien->trang_thai) ? 'selected' : '' ?>>Đang hoạt động</option>
                                <option value="unavailable" <?php echo ('unavailable' == $thanhvien->trang_thai) ? 'selected' : '' ?>>Ngừng hoạt động</option>
                        
                        </select> 
                        </div>                         
                </div>
                <div class="form-group">
                        <label class="col-lg-2 control-label">Quyền</label>
                        <div class="col-lg-8">
                        <select name="quyen" id="quyen" class="form-control">
                                <option value="staff" <?php echo ('staff' == $thanhvien->quyen) ? 'selected' : '' ?>>Nhân viên phục vụ</option>
                                <option value="bartender" <?php echo ('bartender' == $thanhvien->quyen) ? 'selected' : '' ?>>Nhân viên pha chế</option>
                                <option value="cashier" <?php echo ('cashier' == $thanhvien->quyen) ? 'selected' : '' ?>>Quản trị</option>
                                <option value="admin" <?php echo ('admin' == $thanhvien->quyen) ? 'selected' : '' ?>>Quản trị</option>
                        </select>
                        </div>
                </div>
        <!-- /.box-body -->

        </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-lg-offset-3 col-lg-6">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <button type="reset" class="btn btn-primary">Nhập lại</button>
                <a href="{{route('thanhvien')}}" class="btn btn-primary">Bỏ qua</a>
        </div>
        </form>
</div>
</div>

@endsection