<html>
<script type="text/javascript" src="dal/inc/js/jquery-2.1.3.js"></script>
<script type="text/javascript" src="dal/inc/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="dal/inc/js/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>

<script type="text/javascript" src="dal/inc/bootstrap/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="dal/inc/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.2.1/dt-1.10.16/datatables.min.css"/>


<?php

$con = mysqli_connect('localhost','root','root');
mysqli_select_db($con,'dbregartabi2015');
/*
$sql= "update tblentreg set edadreg='33' where bndpryreg=2";
mysqli_query($con,$sql);*/


echo "<label>Minimo de Edad</label><input type='text' id='minimo'>";
echo "<label>Maximo de Edad</label><input type='text' id='maximo'>";
echo "<table class='table table-bordered' id='tablaIP'>
            <thead>
                <tr><td>Nombre</td><td>Sexo</td><td>Edad</td><td>Correo</td></tr>
                </thead><tbody>
";
$query = mysqli_query($con,"Select * from tblentreg");
while($r=mysqli_fetch_assoc($query)){
    echo "<tr>";
    echo "<td>".$r['nomentreg']."</td><td>".$r['celentreg']."</td><td>".$r['edadreg']."</td><td>".$r['usuentreg']."</td>";

    echo "</tr>";
}

echo "</tbody></table>";
?>

<script>
    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            var min = parseInt( $('#minimo').val(), 10 );
            var max = parseInt( $('#maximo').val(), 10 );
            var age = parseFloat( data[2] ) || 0; // use data for the age column

            if ( ( isNaN( min ) && isNaN( max ) ) ||
                ( isNaN( min ) && age <= max ) ||
                ( min <= age   && isNaN( max ) ) ||
                ( min <= age   && age <= max ) )
            {
                return true;
            }
            return false;
        }
    );
    var tabla = $("#tablaIP").DataTable({

        responsive: true,
        "width": "150%",
        "order": [[ 1, "asc" ]],
        language:{
            search: "Buscar IP: ",
            lengthMenu:     "Mostrar _MENU_ registros",
            info: "Mostrando _START_ de _END_ registros de un total de _TOTAL_ registros",
            paginate: {
                "previous":"<<",
                "next":">>",
            },
            zeroRecords: "No se encontraron registros",
            infoEmpty:"Mostrando 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros en total)",
        }
    });

    $('#minimo, #maximo').keyup( function() {
        tabla.draw();
    } );

</script>
</html>