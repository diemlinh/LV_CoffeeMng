@extends('templates.admin-visitors.index')
@section('content')
<div class="wthree-font-awesome ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Đại lý
                            
                        </h1>
                    </div>
                    <p><a href="{{ route('createDl')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus" title="Thêm"></i> Thêm đại lý</a>
                    </p>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead class="bg-info">
                            <tr align="center">
                                <th>Mã đại lý</th>
                               
                                <th>Tên đại lý</th>
                                <th>Số điện thoại</th>
                                 <th>Đại chỉ</th>
                                <th>Tỉnh</th>
                              
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>

                             @foreach($daily as $dl)
                            <tr class="odd gradeX" align="center">
                                 <td>
                                    {{$dl->ma_dai_ly}}
                                </td>
                                 <td>{{$dl->ten_dai_ly}}</td>  
                                 <td>{{$dl->so_dien_thoai}}</td>
                                <td>{{$dl->dia_chi}}</td>                               
                                <td>
                                    {{$dl->tinh}}
                                </td>
                              
                                <td class="center"><a href="{{ route('updateDl', $dl->ma_dai_ly) }}"><i class="fa fa-pencil fa-fw"></i> </a></td>
                                <td class="center">
                                        <form method="POST" action="{{ route('xoaDl', $dl->ma_dai_ly) }}">
                                                {{ csrf_field() }}
                                               
                                                <button type="submit" class="fa fa-trash" style="color:red;" onclick="return ktra()" ></button>
                                </form>
                                </td>
                            </tr>
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