@extends('templates.admin-visitors.index')
@section('content')
<div class="wthree-font-awesome ">
<div class="table-agile-info">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý bàn</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
        </div>
        <div class="col-md-3 text-right"> 
            <form action="{{ route('themban') }}" method="post">
                 {{ csrf_field() }}
                 <div class="col-xs-8">
                 {{-- <input type="number" min="1" id="themban" class="form-control" value="1"> --}}
                </div>
                 <input type="submit" value="Thêm" class="btn btn-success">
                 
            </form>
        </div>
          
    </div>

        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
    
    @foreach($ban as $b)
               
        @if($b->trang_thai == "trong")
        
        <div class="col-lg-3 col-xs-4" >
    
            <div class="panel panel-green" style="border-radius: 10px;">
                <div class="panel-body" style="border-top-left-radius: 10px; border-top-right-radius: 10px; ">
                    <div class="row">
                        <div class="col-xs-7">
                            <p class="tb-action-link">
                            @if($b->ma_ban > 20)
                            {{-- <a href="" onclick="ktra()"> Xóa</a> --}}
                            <a href="{{ route('xoaban', $b->ma_ban) }}" onclick="return ktra();"><i class="fa fa-trash"></i></a>
                             {{-- <form method="POST" action="{{ route('xoaban', $b->ma_ban) }}" >
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                                  
                                  <input type="submit" class="btn-success fa-trash" onclick="return ktra();" data-title="Goto twitter?"/>
                             </form> --}}
                            {{-- <a href="{{ route('ban.destroy', $b->ma_ban) }}"><i style="color: red" class="glyphicon glyphicon-remove"></i></a> --}}
                            @endif
                            </p>
                            <p class="tb-action-link"></p>
                        </div>
                        <div class="col-xs-5 text-right">
                            <div class="huge">{{ $b->ma_ban }}</div>
                            <div><?php echo $b->trang_thai=="trong"?"Bàn trống":"";?><br>
                                <h2></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <a href='{{ url("/hoadon/web/order/$b->ma_ban?from=ban") }}'>
                        
                        {{-- {{url('/hoadon/web/giohangban/' . $b->ma_ban)}} --}}
                    <div class="panel-footer" style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                        <span class="pull-left">Order</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        @elseif($b->trang_thai == "da thanh toan")
        
        <div class="col-lg-3 col-xs-4" >
    
            <div class="panel panel-red" style="border-radius: 10px;">
                <div class="panel-body" style="border-top-left-radius: 10px; border-top-right-radius: 10px;" >
                    <div class="row">
                        <div class="col-xs-7">
                            <p class="tb-action-link">
                            
                            </p>
                            <p class="tb-action-link"></p>
                        </div>
                        <div class="col-xs-5 text-right">
                            <div class="huge">{{ $b->ma_ban }}</div>
                            <div><a href="{{ route('datrong', $b->ma_ban) }}" title="Đã trống" style="color:white;"><?php echo $b->trang_thai=="da thanh toan"?"Đã &nbsp&nbsp&nbsp&nbsp thanh toán":"";?></a>

                            </div>
                        </div>
                    </div>
                </div>
                <a href='{{ route('xemhoadon',$b->ma_ban) }}'>
                        
                        {{-- {{url('/hoadon/web/giohangban/' . $b->ma_ban)}} --}}
                    <div class="panel-footer" style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                        <span class="pull-left">Xem hóa đơn</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
      
        
        @else
       <div class="col-lg-3 col-xs-4" >
            <div class="panel panel-yellow" style="border-radius: 10px; ">
                <div class="panel-body" style="border-top-left-radius: 10px; border-top-right-radius: 10px; ">
                    <div class="row">
                        <div class="col-xs-7">
                            {{-- <p class="tb-action-link"><a href='{{ url("/hoadon/web/order/$b->ma_ban?from=ban") }}'>Cập nhật</p> --}}
                            <p class="tb-action-link"><a href='{{ url("/hoadon/web/order/$b->ma_ban?from=ban") }}' title="Cập nhật">
                                <?php
                                $tong = DB::table('hoa_don')->where('ma_ban',$b->ma_ban)->where('trang_thai','chua thanh toan')->first();
                                ?><b>VND: {{ number_format($tong->tong_tien) }}</b></a></p> 
                        </div>
                        <div class="col-xs-5 text-right">
                            <div class="huge">{{ $b->ma_ban }}</div>
                            <div><?php echo $b->trang_thai=="chua thanh toan"?"Chưa thanh toán":"";?></div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('xuathoadon',$b->ma_ban) }}">
                        
                    <div class="panel-footer" style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                        <span class="pull-left">Xuất hóa đơn</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    
    
        @endif
        
    @endforeach
    </div>
</div>
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