@extends('templates.admin-visitors.index')
@section('content')
<div class="wthree-font-awesome ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Lịch sử nhập hàng
                        </h1>
                    </div>
                    <p><a href="{{ route('createnhap') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus" title="Thêm"></i> Nhập hàng</a></p>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead class="bg-info">
                            <tr align="center">
                                <th>Mã phiếu</th>
                                <th>Đại lý</th>
                                <th>Nguyên liệu</th>
                                <th>Số lượng nhập</th>
                                <th>Số lượng trong kho</th>
                                <th>Đơn vị tính</th>
                                <th>Giá nhập</th>
                                <th>Ngày nhập</th>

                            </tr>
                        </thead>
                        <tbody>
                        	
                             @foreach($nhap as $p)
                            <tr class="odd gradeX" align="center">
                                <td>{{$p->ma_phieu}}</td>
                                <td>
                 
                                    <?php 
                                    $daily = DB::table('dai_ly')->where('ma_dai_ly',$p->ma_dai_ly)->first();
                                    ?>
                                    
                                    {{ $daily->ten_dai_ly }}
                               
                              
                                </td>
                                <td>
                                	 <?php 
                                    $nguyenlieu = DB::table('nguyen_lieu')->where('ma_nguyen_lieu',$p->ma_nguyen_lieu)->first();
                                    ?>
                                    
                                    {{ $nguyenlieu->ten_nguyen_lieu }}
                                </td>                            
                                <td>{{$p->so_luong_nhap}}</td>
                                <td>
                                    <?php 
                                    $nguyenlieu = DB::table('nguyen_lieu')->where('ma_nguyen_lieu',$p->ma_nguyen_lieu)->first();
                                    ?>
                                    
                                    {{ $nguyenlieu->so_luong }}
                                </td>
                                
                                <td>
                                	<?php 
                                    $dvt = DB::table('nguyen_lieu')->where('ma_nguyen_lieu',$p->ma_nguyen_lieu)->first();
                                    ?>
                                    
                                    {{ $dvt->dvt }}
                                </td>
                                <td>{{$p->gia_nhap}}</td>
                                <td>{{$p->ngay_nhap}}</td>
                               
                            </tr>
                             @endforeach
                        </tbody>
                    </table>
                            
                </div>
                <!-- /.row -->
            </div>

            <!-- /.container-fluid -->
        </div>

@endsection