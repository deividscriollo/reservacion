function seleccion_cliente(id){
     $.ajax({
        url:'factura.php',
        type:'POST',
        dataType:'json',
        data:{llenar_clientes_datos:':)',id:id},
        success:function(data){
            $('#lbl_ced').html(data[0])         
            $('#lbl_nom').html(data[1])         
            $('#lbl_tel').html(data[2])         
            $('#lbl_dir').html(data[3])  
            $('#lbl_id_cliente').html(data[4]);          
            $('#lbl_cor').html(data[5]);          
        }
    });    
    $('#modal-cliente').modal('hide');

    $.ajax({
        url:'factura.php',
        type:'POST',
        data:{llenar_reservacion_datos:':)',id:id},
        success:function(data){
            console.log(data)  
            $('#reservacion_cliente tbody').html(data);
            
        }
    });   
}
$(function(){
    // btn mostrar modal busqueda cliente
$('#btn_buscar_cliente').click(function(){
    $('#modal-cliente').modal('show');
});
// generar table clientes mostrar
    $.ajax({
        url:'factura.php',
        type:'POST',
        dataType:'json',
        data:{llenar_clientes:':)'},
        success:function(data){
            var a=1;
            for (var i=0; i<(data.length); i=i+5) {                
                $('#tbt_clientes').dataTable().fnAddData([
                  data[i+0],
                  data[i+1],                  
                  data[i+2],
                  data[i+3],
                  data[i+4]
                ]);                                    
                a++;
            }
        }
    });
// Valores Inciales data table
    var table=$('#tbl_reservaciones').dataTable( {
        language: {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:  ",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    }); 
 var table=$('#tbt_clientes').dataTable( {
        language: {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:  ",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    }); 
// llenar datos data table de reservaciones existentes
    $.ajax({
        url:'factura.php',
        type:'POST',
        dataType:'json',
        data:{llenar_reservacion:':)'},
        success:function(data){
            // console.log(data)
            var a=0;
            for (var i=0; i<(data.length); i=i+7) { 
                a++;            
                $('#tbl_reservaciones').dataTable().fnAddData([
                    a,
                  data[i+0],
                  data[i+1],                  
                  data[i+2],
                  data[i+3],
                  data[i+4],
                  data[i+5],
                  data[i+6]
                ]);                                    
                
            }
        }
    });

})