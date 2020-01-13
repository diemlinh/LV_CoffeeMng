
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

      <form name="frmloai" method="POST" action="{{ route('themNl') }}" enctype="multipart/form-data" role="form" class="form-horizontal">
        {{ csrf_field() }}

        <div class="col-md-12"> 
            <h1 class="panel-heading">Thêm nguyên liệu </h1>
            <hr>
          <!-- /.box-header -->
          <!-- form start -->
            <div class="box-body">             
              <div class="form-group">
                <label class="col-lg-2 control-label">Tên nguyên liệu</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control" name="ten" id="ten" value="{{ old('ten') }}" placeholder="Nhập tên nguyên liệu" autofocus>
                </div>
              </div>

              <div class="form-group">
                    <label class="col-lg-2 control-label">Đơn vị tính</label>
                    <div class="col-lg-8">
                    <select name="dvtinh" id="dvtinh" class="form-control">
                        <option value="">Chọn đơn vị tính</option>
                        <option value="g">Gam</option>
                        <option value="ml">Mililit</option>
                        <option value="chai">Chai</option>                  
                    </select>
                    </div>
              </div>
        </div>
            <!-- /.box-body -->
          </div>
        
        <div class="col-md-1"> </div>
            <div class="col-lg-offset-3 col-lg-6">
              <button type="submit" class="btn btn-primary">Thêm mới </button>
              <button type="reset" class="btn btn-primary">Nhập lại </button>
              <a href="{{route('nguyenlieu')}}" class="btn btn-primary">Bỏ qua</a>
            </div>
          </form>
        </div>
        </div>
    
@endsection

