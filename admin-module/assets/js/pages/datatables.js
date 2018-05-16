$(function(){
    $(".datatable").each( function() {
        $(this).dataTable();
    });

    $(".datatable-with-total").each( function() {
        $(this).dataTable( {
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
     
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\₱,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
     
                // Total over all pages
                data = api.column( 7 ).data();
                total = data.length ?
                    data.reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                    } ) :
                    0;
     
                // Total over this page
                data = api.column( 7, { page: 'current'} ).data();
                pageTotal = data.length ?
                    data.reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                    } ) :
                    0;
     
                // Update footer
                $( api.column( 7 ).footer() ).html(
                    '₱'+ Number(pageTotal).toLocaleString('en') +' (₱'+ Number(total).toLocaleString('en') +' total)'
                );
            }
        } );
    });

    var table = $('#datatables-2').DataTable();
 
    $("#datatables-2 tfoot th").each( function ( i ) {
        var select = $('<select class="form-control input-sm"><option value=""></option></select>')
            .appendTo( $(this).empty() )
            .on( 'change', function () {
                table.column( i )
                    .search( '^'+$(this).val()+'$', true, false )
                    .draw();
            } );
 
        table.column( i ).data().unique().sort().each( function ( d, j ) {
            select.append( '<option value="'+d+'">'+d+'</option>' )
        } );
    } );
    $('#datatables-4').DataTable( {
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "./assets/libs/jquery-datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
        }
    } );    
})