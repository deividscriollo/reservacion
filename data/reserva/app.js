$(function(){
    //editables on first profile page
    $.fn.editable.defaults.mode = 'inline';
    $.fn.editableform.loading = "<div class='editableform-loading'><i class='light-blue icon-2x icon-spinner icon-spin'></i></div>";
    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="icon-ok icon-white"></i></button>'+
                                '<button type="button" class="btn editable-cancel"><i class="icon-remove"></i></button>';    


    $(".chzn-select").chosen();

    $('#select_categoria').change(function(){
        var acu=$(this).val();
        // estableciendo nombre
        $.ajax({
            url:'app.php',
            type:'POST',
            // dataType:'json',
            data:{mostrar_tarifa_servicios:':)',id:acu},
            success:function(data){
                console.log(data);
                $('#obj_tarifas_nombre').html(data);
            }
        });
        // estableciendo precio
        $.ajax({
            url:'app.php',
            type:'POST',
            // dataType:'json',
            data:{mostrar_tarifa_servicios2:':)',id:acu},
            success:function(data){
                console.log(data);
                $('#obj_tarifas_precio').html(data);
            }
        });
        // estableciendo cantidad
        $.ajax({
            url:'app.php',
            type:'POST',
            dataType:'json',
            data:{mostrar_tarifa_servicios3:':)',id:acu},
            success:function(data){
                console.log(data);
                var acumulador='';
                var sumador='';
                for (var i = 0; i < data.length; i=i+3) {
                    acumulador+='<li id="'+data[0+i]+'"> <span class="editable" id="lbl_'+data[i+0]+','+data[2+i]+'" onclick="ejemplo(event)">0</span> </li>';
                    sumador+='<li id="'+data[0+i]+'">00.00</li>';
                }
                $('#obj_tarifas_cantidad').html(acumulador);
                $('#obj_tarifas_total').html(sumador);
            }
        });
    });


    $('#btn_buscar_cliente').click(function(){
        $('#modal-cliente').modal('show');
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
    // llenando por procesos
    $.ajax({
        url:'app.php',
        type:'POST',
        dataType:'json',
        data:{llenar_clientes:':)'},
        success:function(data){
            for (var i=0; i<(data.length); i=i+5) {
                $('#tbt_clientes').dataTable().fnAddData([
                  data[i+0],
                  data[i+1],
                  data[i+2],
                  data[i+3],
                  data[i+4]
                ]);
            }
        }
    });


});
    function renovar() {
        $('#tabla_horas tbody tr td label input').removeClass('animated bounceOut');
        $('#tabla_horas tbody tr td label input').removeAttr('checked');
    }
    function renovar1() {
        $('#txt_tarifa1').removeClass('animated wobble');
        $('#txt_tarifa2').removeClass('animated wobble');
    }

    function seleccion_cliente(id){
        $.ajax({
            url:'app.php',
            type:'POST',
            dataType:'json',
            data:{llenar_clientes_datos:':)',id:id},
            success:function(data){
                $('#lbl_ced').html(data[0])
                $('#lbl_nom').html(data[1])
                $('#lbl_tel').html(data[2])
                $('#lbl_dir').html(data[3])
                $('#lbl_cor').html(data[4])
                $('#lbl_id_cliente').html(id);
            }
        });
        $.ajax({
            url:'app.php',
            type:'POST',
            // dataType:'json',
            data:{mostrar_cliente_reservaciones:':)',id:id},
            success:function(data){
                $('#obj_reservaciones').html(data);
            }
        });
        $('#modal-cliente').modal('hide');
    }
    function accion_reservacion(event){
        var valor=event.target.value;
        var tar = event.target;
        $(tar).attr('checked','');
        var id = $(tar).attr('id');
        var id=id.split(',');
        $.ajax({
            url:'app.php',
            type:'POST',
            // dataType:'json',
            data:{mostrar_servicios_reservacion:':)',id:id[0], id_s:id[1]},
            success:function(data){
                $('#select_categoria').html(data);
                $('#select_categoria').trigger('liszt:updated');
            }
        });

    }
    function ejemplo(event){
        var valor=event.target.value;
        var tar = event.target;
        var id_elemento=$(tar).attr('id');
        var elemento=document.getElementById(id_elemento);
        $(elemento).editable({
            type: 'spinner',
            pk: {id_tarifa:id_elemento,id_reserva:2,c:3},
            title: 'Enter username',
            spinner : { min : 0, max:99, step:1 },
            url:'app.php',
            validate: function(value) {
              if($.trim(value) == '')
                return false;
            },
            success:function(response, newValue){

            }
        });
    }



