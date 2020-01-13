$(document).ready(function() {
    $('#dataTables-example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
            responsive: true,
        "language": {
                // "lengthMenu": "Hiển thị _MENU_",
                "zeroRecords": "Không tìm thấy dữ liệu",
                "info": "Hiển thị _START_ - _END_ của _TOTAL_ dòng",
                "infoEmpty": "Không có dữ liệu sẵn có",
                "paginate": {
                    "previous": "<<",
                    "next": ">>"
                },
                "infoFiltered": "(Lọc từ _MAX_ total dữ liệu)"
                
        }   
        
   });
});
$(document).ready(function() {
    $('#thanhtoan').click(function(){
        this.style.display='none';
        html = document.getElementById('print-area').innerHTML;
        //document.write("LINH'S CAFE");
        //document.write(html);
        // window.print(html, "_blank"); 
        w=window.open();
        w.document.write(html);
        w.print();
        w.close();
    });
    

} );
    
function xacnhan() {

    $.confirm({
        title: 'Confirm!',
        content: 'Simple confirm!',
        buttons: {
        confirm: function() {         
            // document.getElementById('xoa').setAttribute('type','submit');
            // $('#xoa').click();
            $('#xoa').change().after();
        },
        cancel: {
            // document.getElementById('xoa').setAttribute('type','button');
            
        }
    }
    });
    
}
$(function(){
    $('#xoa').change(function() {
        $('#xoa').attr('type','submit');
    });
    
    $('#xoa').click(function(){
         xacnhan();
    });
});


$("div.contain-alert-message").delay(3000).slideUp();