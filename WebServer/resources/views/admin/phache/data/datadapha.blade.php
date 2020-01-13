@foreach($ctdapha as $ctdp)    
    <tr>
        <td>{{$ctdp->ten_sp}}</td> 
        <td>{{$ctdp->pha_che}}</td>
        <td>{{$ctdp->ma_ban}}</td> 
        <td>{{$ctdp->ngay_sua }}</td>  
        <td>
            <a href="{{ url("/phache/web/toChuapha/$ctdp->ma_hoa_don/$ctdp->ma_sp/$ctdp->pha_che") }}" class="btn btn-default" data-toggle="tooltip" title="Chưa pha"><i class="glyphicon glyphicon-repeat"></i></a>
        </td>             
    </tr>
@endforeach