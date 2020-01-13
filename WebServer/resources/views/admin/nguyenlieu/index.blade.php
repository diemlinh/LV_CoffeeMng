@extends('templates.admin-visitors.index')
@section('content')

<div class="wthree-font-awesome ">
<div class="container-fluid">
	
					<div class="row">
							<div class="col-lg-12">
									<h1 class="page-header">Danh sách nguyên liệu</h1>
							</div>
							<!-- /.col-lg-12 -->
					</div>

					<div class="row">
						<p><a href="{{ route('createNl') }}"><button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-plus" title="Thêm"></i> Thêm nguyên liệu</button></a></p>
						<table class="table table-hover table-bordered" id="dataTables-example">
						<thead>
							<tr class="success">
								<th>STT</th>
								<th>Tên nguyên liệu</th>
								
								<th>Số lượng</th>
								<th>Đơn vị tính</th>
								<th></th>

								<th></th>
								{{-- <th></th> --}}
							</tr>
						</thead>
							<?php $a=1 ?>
							@foreach($nguyenlieu as $nl)
						<tr>
							<td><?php echo $a; ?></td>
							<td>{{$nl->ten_nguyen_lieu}}</td>
							<td>{{$nl->so_luong}}</td>
						
							<td>{{$nl->dvt}}</td>
							<td class="center">
										{{-- <button class="btn btn-default pull-right"><a href="{{route('updateNl', $nl->ma_nguyen_lieu)}}">Sửa</a></button> --}}
										<a href="{{ route('updateNl', $nl->ma_nguyen_lieu) }}"><button type="button" class="fa fa-pencil"></button></a>
							</td>
							<td class="center">
									<form method="POST" action="{{ route('xoaNl', $nl->ma_nguyen_lieu) }}">
										{{ csrf_field() }}
									   
										<button type="submit" class="fa fa-remove" style="color:red;" onclick="return ktra()" ></button>
									</form>
							</td>
						
									
						</tr>
							<?php $a=$a+1; ?>
						@endforeach
						
					</table>
					</div>
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