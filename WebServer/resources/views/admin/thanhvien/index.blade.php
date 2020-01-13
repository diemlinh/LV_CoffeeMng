@extends('templates.admin-visitors.index')
@section('content')
<div class="wthree-font-awesome ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thành viên
                            <small>List</small>
                        </h1>
                    </div>
                    <p><a href="{{route('createTv')}}"><button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-plus" title="Thêm"></i> Thêm thành viên</button></a></p>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead class="bg-info">
                            <tr align="center">
                                <th>STT</th>
                                <th>Tên đăng nhập</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Giới tính</th>
                                <th>Sinh nhật</th>
                                <th>Địa chỉ</th>
                                <th>Điện thoại</th>                               
                                <th>Tỉnh</th>
                                <th>Trạng thái</th>
                                <th>Edit</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php $a=1 ?>
                             @foreach($thanhvien as $tv)
                            <tr class="odd gradeX" align="center">
                                <td>{{ $a }}</td>
                                <td>{{$tv->ten_dang_nhap}}</td>
                                <td>{{$tv->ho_ten}}</td>
                                <td>{{$tv->email}}</td>                            
                                <td>{{$tv->gioi_tinh}}</td>
                                <td>{{$tv->sinh_nhat}}</td>
                                <td>{{$tv->dia_chi}}</td>
                                <td>{{$tv->so_dt}}</td>
                                <td>{{$tv->tinh}}</td>
                                <td>{{$tv->trang_thai}}</td>
                                
                                
                                <td class="center"><a href="{{ route('updateTv', $tv->ma_tv) }}"><i class="fa fa-pencil fa-fw"></i> </a></td>
                                <td class="center">
                                        <form method="POST" action="{{ route('xoaTv', $tv->ma_tv) }}">
                                                {{ csrf_field() }}
                                               
                                                <input type="submit" class="btn-link" style="color:red;" onclick="return ktra()" value="X"/></i>
                                </form>
                                </td>
                            </tr>
                             <?php $a=$a+1; ?>
                             @endforeach
                        </tbody>
                    </table>
                            
                </div>
                <!-- /.row -->
            </div>

            <!-- /.container-fluid -->
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