@extends('templates.admin-visitors.index')
@section('content')
<div class="wthree-font-awesome ">         
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thực đơn
                            
                        </h1>
                    </div>
                    <p><a href="{{ route('createSp')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus" title="Thêm"></i> Thêm món</a>
                    </p>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Loại</th>                                
                                <th>Tên món</th>
                                <th>Giá</th>
                                <th>Hình</th>
                                <th>Trạng thái</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                             @foreach($thucdon as $td)
                            <tr class="odd gradeX" align="center">
                                <td>
                                    {{-- <a href="{{ route('theoloai',$td->ma_loai) }}"> --}}
                                       <?php 
                                       $loai = DB::table('loai')->where('ma_loai',$td->ma_loai)->first();
                                       ?>
                                       @if(!empty($loai->ten_loai))
                                       {{ $loai->ten_loai }}
                                       @endif
                                   {{-- </a> --}}
                               </td> 
                               <td>{{$td->ten_sp}}</td>  
                               <td>{{$td->don_gia}}</td>
                                <td>
                                    <img src="{{ asset('upload/' . $td->hinh_anh) }}" width="50px" height="30px" />
                                </td>                                                                                                                
                                <td>
                                    @if($td->trang_thai == 'con km')
                                        Còn khuyến mãi
                                    
                                    @elseif($td->trang_thai == 'het km')
                                        Hết khuyến mãi
                                    
                                    @else
                                        Ngừng bán
                                    @endif
                                </td>
                              
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{ route('updateSp', $td->ma_sp) }}">Edit</a></td>
                                <td class="center">
                                        <form method="POST" action="{{ route('xoaSp', $td->ma_sp) }}">
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