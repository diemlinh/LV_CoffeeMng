@extends('templates.admin-visitors.index')
@section('content')
       
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chi tiết khuyến mãi
                        </h1>
                    </div>
                   
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead class="bg-info">
                            <tr align="center">
                                <th>STT</th>
                                <th>Tên món</th>
                                <th>Kiểu khuyến mãi</th>
                                <th>Giá trị khuyến mãi</th>
                                <th>Gía khuyến mãi</th>
                                <th>Gía gốc</th>
                                <th></th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                                <?php $a=1 ?>
                             @foreach($ctkm as $ct)
                            <tr class="odd gradeX" align="center">
                                <td><?php echo $a; ?></td>
                                <td>
                                    {{ $ct->ten_sp }}
                                </td>                            
                                <td>{{$ct->kieu_khuyen_mai}}</td>
                                <td>
                                    {{ $ct->gia_tri_KM }}
                                </td>
                                
                                <td>                                	
                                    {{ $ct->gia_khuyen_mai }}
                                </td>
                                <td>{{$ct->don_gia}}</td>
                                <td class="center"><a href="{{ route('updateCtkm', $ct->ma_ctkm) }}"><i class="fa fa-pencil fa-fw"></i> </a></td>
                                <td class="center">
                                        <form method="POST" action="{{ route('xoaCtkm', $ct->ma_ctkm) }}">
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
            <p><a href="{{ route('khuyenmai') }}" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i> Trở về</a></p>

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