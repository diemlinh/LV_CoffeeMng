@extends('templates.admin-visitors.index')
@section('content')
       <div class="wthree-font-awesome ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Nhật ký đơn hàng                            
                        </h1>
                    </div>
                    </p>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Mã hóa đơn</th>                              
                                <th>Mã bàn</th>
                                <th>Số lượng</th>
                                <th>Tổng tiền</th>
                                <th>Đã pha</th>
                                <th>Chưa pha</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>

                                @foreach($hoadon as $hd)
                                <?php
                                        $sl = DB::table('chi_tiet_hoa_don')
                                            ->where('chi_tiet_hoa_don.ma_hoa_don', $hd->ma_hoa_don)
                                            ->sum('so_luong');
                                        $dapha = DB::table('chi_tiet_hoa_don')
                                            ->where('chi_tiet_hoa_don.ma_hoa_don', $hd->ma_hoa_don)
                                            ->sum('pha_che');
                                        $chuapha = $sl-$dapha;
                                    ?>
                                <tr class="odd gradeX" align="center">
                                    
                                    <td>{{$hd->ma_hoa_don}}</td>
                                    <td>{{$hd->ma_ban}}</td>
                                    <td>{{$sl}}</td> 
                                    <td>{{$hd->tong_tien}}</td>                                                        
                                    <td>{{$dapha}}</td>
                                    <td>{{$chuapha}}</td>
                            
                                    <td>@if($hd->trang_thai == 'da thanh toan')
                                            Đã thanh toán
                                        
                                        @else
                                            Chưa thanh toán
                                        
                                       
                                        @endif
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

@endsection