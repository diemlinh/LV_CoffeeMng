
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
                        <tbody style="background-color: #fff">
                            @foreach($ctchuapha as $ctcp)    
                                <tr>
                                    <td>{{$ctcp->ten_sp}}</td> 
                                    <td>{{$ctcp->so_luong}}</td>
                                    <td>{{$ctcp->ma_ban}}</td> 
                                    <td>{{$ctcp->ngay_sua }}</td>  
                                    <td>
                                        <a href="{{ url("/phache/web/toDapha/$ctcp->ma_hoa_don/$ctcp->ma_sp/$ctcp->so_luong") }}" class="btn btn-success" data-toggle="tooltip" title="Đã pha"><i class="glyphicon glyphicon-ok"></i></a>
                                    </td>             
                                </tr>
                            @endforeach
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
                        <tbody style="background-color: #fff">
                            @foreach($ctdapha as $ctdp)    
                                <tr>
                                    <td>{{$ctdp->ten_sp}}</td> 
                                    <td>{{$ctdp->so_luong}}</td>
                                    <td>{{$ctdp->ma_ban}}</td> 
                                    <td>{{$ctdp->ngay_sua }}</td>  
                                    <td>
                                        <a href="{{ url("/phache/web/toChuapha/$ctdp->ma_hoa_don/$ctdp->ma_sp/$ctdp->so_luong") }}" class="btn btn-default" data-toggle="tooltip" title="Chưa pha"><i class="glyphicon glyphicon-repeat"></i></a>
                                    </td>             
                                </tr>
                            @endforeach
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
                <tbody style="background-color: #fff">
                    @foreach($tonghopchuapha as $thcp)    
                        <tr>
                            <td>{{$thcp->ten_sp}}</td> 
                            <td>{{$thcp->sumsoluong}}</td>          
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>