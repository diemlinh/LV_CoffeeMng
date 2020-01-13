@extends('templates.admin-visitors.index')
@section('content')
<div class="wthree-font-awesome ">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách loại</h1>
        </div>
        <!-- /.col-lg-12 -->
  </div>
 
  <div class="row">
    <div class="col-md-8">
      <table class="table table-hover table table-striped"" id="dataTables-example">
      <thead
        <tr>
        
        <th>Mã loại</th>       
        <th>Tên loại</th>
        <th>Cập nhật</th>
         <th>Xóa</th>
      </tr>
      </thead>
      @foreach($loai as $l)
      <tr>
        <form method="POST" action="{{ route('sualoai', $l->ma_loai) }}">
              {{ csrf_field() }}
       
        <td>{{$l->ma_loai}}</td>
        <td><input type="text" id="ten" name="ten" value="{{$l->ten_loai}}"><span style="display:none;">{{$l->ten_loai}}</span></td>
        <td class="center">
           
              <button type="submit" class="btn fa fa-pencil" style="color:blue;"></button>
            
        </td>
      </form>
        <td>
          <form method="POST" action="{{ route('xoaloai', $l->ma_loai) }}">
              {{ csrf_field() }}
             
              <button type="submit" class="btn fa fa-remove" style="color:red;" onclick="return ktra()"></button>
            </form>
        </td>
      </tr>
      @endforeach
      
    </table>
    </div>
    <form method="POST" action="{{ route('themloai') }}" enctype="multipart/form-data" >
   {{ csrf_field() }}
    <div class="col-md-4">
      <div class="panel panel-info">
        <div class="panel-heading">Thêm loại</div>
        <div class="panel-body">
         <div class="form-group">
      <label for="inputText3" class="col-sm-2 control-label">Tên loại</label>
      <div class="col-xs-3">
        <input type="text" id="them" name="them" value="{{ old('them') }}" autofocus>
      </div>
    </div>
    </div>
    </div>    
      <button type="submit" class="btn btn-primary">Lưu</button>
       <button type="reset" class="btn btn-success">Nhập lại</button>
    
     
    </div>
  </form>
  </div>
</div>
    <script language="javascript">
      function ktra()
    {  
      if(confirm("Bạn có chắc chắn muốn xóa ")) 
      { 
        return true;
      }
       else 
       { 
          return false;
      }
    }
    </script>


@endsection

