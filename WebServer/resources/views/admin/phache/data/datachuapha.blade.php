@foreach($ctchuapha as $ctcp)    
    <tr>
        <td>{{$ctcp->ten_sp}}</td> 
        <td>{{ $ctcp->so_luong - $ctcp->pha_che }}</td>
        <td>{{$ctcp->ma_ban}}</td> 
        <td>{{$ctcp->ngay_sua }}</td>  
        <td>
            <a href="{{ url("/phache/web/toDapha/$ctcp->ma_hoa_don/$ctcp->ma_sp/1") }}" class="btn btn-success" data-toggle="tooltip" title="Đã pha 1"><i class="glyphicon glyphicon-ok"></i></a>
            <?php $sl = $ctcp->so_luong - $ctcp->pha_che; ?>
            <a href="{{ url("/phache/web/toDapha/$ctcp->ma_hoa_don/$ctcp->ma_sp/$sl") }}" class="btn btn-success" data-toggle="tooltip" title="Đã pha tất cả"><i class="glyphicon glyphicon-flash"></i></a>
        </td>             
    </tr>
@endforeach