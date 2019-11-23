
<head>

<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />


<link href="https://cdn.datatables.net/scroller/2.0.0/css/scroller.dataTables.min.css" />

</head>


<body>
<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>First name</th>
                <th>Last name</th>
                <th>ZIP / Post code</th>
                <th>Country</th>
            </tr>
        </thead>
    </table>
    
   </body> 
    
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/scroller/2.0.0/js/dataTables.scroller.min.js"></script>


    
    
    <script>
	$(document).ready(function() { 
    $('#example').DataTable( {
        serverSide: true,
        ordering: false,
        searching: false,
        ajax: function ( data, callback, settings ) {
            var out = [];
 
            for ( var i=data.start, ien=data.start+data.length ; i<ien ; i++ ) {
                out.push( [ i+'-1', i+'-2', i+'-3', i+'-4', i+'-5' ] );
            }
 
            setTimeout( function () {
                callback( {
                    draw: data.draw,
                    data: out,
                    recordsTotal: 5000000,
                    recordsFiltered: 5000000
                } );
            }, 50 );
        },
        scrollY: 200,
        scroller: {
            loadingIndicator: true
        },
    } );
} );
	
	
	
	</script>