@extends('templates.admin-visitors.index')
@section('content')
<div class="wthree-font-awesome ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Bảng pha chế
                        </h1>
                    </div>
                    <div id="dataphache" class="row">
                        <div class="col-lg-10">
                            <div id="myTabs">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#chuapha" aria-controls="chuapha" role="tab" data-toggle="tab">Chưa pha</a></li>
                                    <li role="presentation"><a href="#dapha" aria-controls="dapha" role="tab" data-toggle="tab">Đã pha</a></li>
                                </ul>
                                
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="chuapha">
                                        <br/>
                                        <table class="table table-bordered table-hover" id="dataTables-chuapha">
                                            <thead class="bg-info">
                                                <tr>
                                                    <th>Tên món</th>
                                                    <th>Số Lượng</th>
                                                    <th>Bàn</th>
                                                    <th>Thời gian order</th>
                                                    <th></th>
                                                </tr> 
                                            </thead>
                                            <tbody id="tbChuapha" style="background-color: #fff">
                                                <!-- load datachuapha here -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="dapha">
                                        <br/>
                                        <table class="table table-bordered table-hover" id="dataTables-dapha">
                                            <thead class="bg-info">
                                                <tr>
                                                    <th>Tên món</th>
                                                    <th>Số Lượng</th>
                                                    <th>Bàn</th>
                                                    <th>Lần cuối cập nhật</th>
                                                    <th></th>
                                                </tr> 
                                            </thead>
                                            <tbody id="tbDapha" style="background-color: #fff">
                                                <!-- load datadapha here -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-2">
                                <table class="table table-bordered table-hover">
                                    <thead class="bg-info">
                                        <tr>
                                            <th colspan="2" style="text-align: center"><h4>Tổng hợp chưa pha</h4></th>
                                        </tr> 
                                    </thead>
                                    <thead class="bg-info">
                                        <tr>
                                            <th>Tên món</th>
                                            <th>Số Lượng</th>
                                        </tr> 
                                    </thead>
                                    <tbody id="tbTonghop" style="background-color: #fff">
                                        <!-- load datatonghop here -->
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>

            <!-- /.container-fluid -->
        
        <script type="text/javascript">
            $(document).ready( function () {
                {{-- $('#dataTables-chuapha').DataTable({
                    "paging":   false,
                    "ordering": true,
                    "info":     false,
                    "lengthChange": false
                });
                $('#dataTables-dapha').DataTable({
                    "paging":   false,
                    "ordering": true,
                    "info":     false,
                    "lengthChange": false
                }); --}}
                var auto_refresh = setInterval(
                    function(){
                        $('#tbChuapha').load('<?php echo url('phache/web/data/datachuapha');?>').fadeIn('slow');
                        $('#tbDapha').load('<?php echo url('phache/web/data/datadapha');?>').fadeIn('slow');
                        $('#tbTonghop').load('<?php echo url('phache/web/data/datatonghop');?>').fadeIn('slow');
                    },500);
            });

            

            {{--  init_reload();
            function init_reload(){
                setInterval( function() {
                           window.location.reload();
         
                  },30000);
            }  --}}
        </script>
@endsection