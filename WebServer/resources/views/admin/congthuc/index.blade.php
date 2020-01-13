@extends('templates.admin-visitors.index')
@section('content')
<div class="wthree-font-awesome ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Công thức
                            <small>List</small>
                        </h1>
                    </div>
                    <p><a href="{{ route('createCt') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus" title="Thêm"></i> Thêm công thức</a></p>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr class="success">
                                <th>Mã công thức</th>
                                <th>Tên món</th>
                                <th>Nguyên liệu</th>
                                <th>Số lượng</th>
                                <th>Đơn vị tính</th>
                        
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                        	
                             @foreach($congthuc as $ct)
                            <tr class="odd gradeX" align="center">
                                <td>{{$ct->ma_ct}}</td>
                                <td>
                 
                                    <?php 
                                    $sanpham = DB::table('san_pham')->where('ma_sp',$ct->ma_sp)->first();
                                    ?>
                                    
                                    {{ $sanpham->ten_sp }}
                               
                              
                                </td>
                                <td>
                                	 <?php 
                                    $nguyenlieu = DB::table('nguyen_lieu')->where('ma_nguyen_lieu',$ct->ma_nguyen_lieu)->first();
                                    ?>
                                    
                                    {{ $nguyenlieu->ten_nguyen_lieu }}
                                </td>                            
                                <td>{{$ct->so_luong}}</td>
                                <td>
                                    {{ $ct->dvt}}
                                </td>
                                <td class="center"><a href="{{ route('updateCt', $ct->ma_ct) }}"><button type="button" class="fa fa-pencil"></button></a></td>
                                <td class="center">
                                        <form method="POST" action="{{ route('xoaCt', $ct->ma_ct) }}">
                                                {{ csrf_field() }}
                                               
                                                <button type="submit" class="fa fa-remove" style="color:red;" onclick="return ktra()" ></button>
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