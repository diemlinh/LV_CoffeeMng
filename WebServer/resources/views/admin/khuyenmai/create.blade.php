@extends('templates.admin-visitors.index')
@section('content')

@if (count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
<form name="frmsanpham" method="POST" action="{{ route('themCtkm') }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="col-md-12">
<div class="col-md-7">

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Thêm mới</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
      <div class="box-body">
         <div class="form-group">
          <label for="khuyenmai">Khuyến mãi</label>
          <input type="text" class="form-control" name="khuyenmai" id="khuyenmai" value="{{ $khuyenmai->ma_khuyen_mai}}" readonly>
        </div>
        <div class="form-group">
          <label for="sanpham">Tên món</label>
          <select name="sanpham" id="sanpham" class="form-control">
            @foreach ($sanpham as $sp)
            <option value="{{ $sp->ma_sp }}">{{ $sp->ten_sp }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="kieu">Kiểu khuyến mãi</label>
          <input type="text" class="form-control" name="kieu" id="kieu" value="%" readonly>
        </div>
        <div class="form-group">
                <label for="kieu">Gía trị khuyến mãi</label>
                <input type="number" class="form-control" min="0" max="100" name="giatri" id="giatri" >
        </div>
        
      <!-- /.box-body -->

  </div>
</div>
<div class="col-md-1">
  
</div>

<div class="box-footer col-md-12">
        <button type="submit" class="btn btn-primary">Thêm mới</button>
        <button type="reset" class="btn btn-primary">Nhập lại</button>
        <a href="{{route('khuyenmai')}}" class="btn btn-primary">Bỏ qua</a>
</div>

</div>
</form>

@endsection