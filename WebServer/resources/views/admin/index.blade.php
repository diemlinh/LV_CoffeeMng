@extends('templates.admin-visitors.index')
@section('content')
<?php //Hiển thị thông báo thành công?>
@if ( Session::has('success') )
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>{{ Session::get('success') }}</strong>
    </div>
@endif
    <!-- //market-->
    
		<div class="market-updates">
      <a href="{{route('thucdon')}}">
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-2">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-eye"> </i>
					</div>
					 <div class="col-md-8 market-update-left">
                         <?php
                         $sanpham = DB::table('san_pham')->count('ma_sp');
                         ?>

					 <h4>Sản phẩm</h4>
                     <h3>{{$sanpham}}</h3>
                     <p>Other hand, we denounce</p>
				  </div>
				  <div class="clearfix"> </div>
				</div>
      </div>
      </a>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-users" ></i>
					</div>
					<div class="col-md-8 market-update-left">
                            <?php
                            $hoadon = DB::table('hoa_don')->count('ma_hoa_don');
                            ?>
					<h4>Hóa đơn</h4>
						<h3>{{$hoadon}}</h3>
						<p>Other hand, we denounce</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-usd"></i>
					</div>
					<div class="col-md-8 market-update-left">
                            <?php
                            $hoadon = DB::table('hoa_don')->where('trang_thai','=','da thanh toan')->sum('tong_tien');
                            ?>
						<h4>Doanh thu</h4>
						<h3>{{number_format($hoadon)}}</h3>
						<p>Other hand, we denounce</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-4">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					<div class="col-md-8 market-update-left">
                            <?php
                            $thanhvien = DB::table('thanh_vien')->count('ma_tv');
                            ?>
						<h4>Thành viên</h4>
						<h3>{{number_format($thanhvien)}}</h3>
						<p>Other hand, we denounce</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>	
		<!-- //market-->
		<div class="row">
			<div class="panel-body">
				<div class="col-md-12 w3ls-graph">
					<!--agileinfo-grap-->
						<div class="agileinfo-grap">
							<div class="agileits-box">
								<header class="agileits-box-header clearfix">									
										<div class="toolbar">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                        HÓA ĐƠN MỚI
                                                </div>
                                                <?php
                                                $hoadonmoi = DB::table('hoa_don')->orderBy('ma_hoa_don','DESC')->limit(7)->get();
                                                ?>
                                                        <div>
                                                          <table class="table">
                                                            <thead>
                                                              <tr>
                                                                <th data-breakpoints="xs">Mã hóa đơn</th>
                                                                <th>Mã bàn</th>
                                                                <th>Tổng tiền</th>
                                                                <th data-breakpoints="xs">Nhân viên</th>
                                                                <th data-breakpoints="xs">Trạng thái</th>
                                                                <th data-breakpoints="xs sm md" data-title="DOB">Ngày lập</th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                              @foreach ($hoadonmoi as $hd)                                                            
                                                              <tr data-expanded="true">
                                                                <td>{{$hd->ma_hoa_don}}</td>
                                                                <td>{{$hd->ma_ban}}</td>
                                                                <td>{{$hd->tong_tien}}</td>
                                                                <td>{{$hd->nv_lap}}</td>
                                                                
                                                                <td>{{$hd->trang_thai}}</td>
                                                                <td>{{$hd->ngay_lap}}</td>
                                                              </tr>
                                                              @endforeach
                                                            </tbody>
                                                          </table>
                                                        </div>
                                                      </div>
                                                  
								</header>
								<div class="agileits-box-body clearfix">
									<div id="hero-area"></div>
								</div>
							</div>
						</div>
	<!--//agileinfo-grap-->

				</div>
			</div>
    </div>
@endsection
