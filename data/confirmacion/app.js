$(function(){
	var table=$('#tbt_mensajes').dataTable( {
        language: {
		    "sProcessing":     "Procesando...",
		    "sLengthMenu":     "Mostrar _MENU_ registros",
		    "sZeroRecords":    "No se encontraron resultados",
		    "sEmptyTable":     "Ningún dato disponible en esta tabla",
		    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		    "sInfoPostFix":    "",
		    "sSearch":         "Buscar: ",
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
	llenar_tabla();
	$('#btn_confirmar').click(function(){
		var c=$('#lbl_correo').text();
		var b=$('#lbl_cliente').text();
		var a=$('#txt_id_reservacion').val();
		correo_envio(a,b,c);
	});
});
function llenar_tabla(){

$.ajax({
	url:'confirmacion.php',
	type:'POST',
	dataType: 'json',
	data:{mostrar_reservacion:'ok'},
	success:function(data){
		var a=1;
		$('#tbt_mensajes').DataTable().clear().draw();
		for (var i = 0; i < data.length; i=i+2) {
			$('#tbt_mensajes').dataTable().fnAddData([
					a,
					data[i+0],
					data[i+1],
				]);
			a++;
		}
	}

});
}

function correo_envio(a,b,c){
	$('#modal-form').modal('hide');
	bootbox.confirm("<h1>Se enviara un correo de confirmación a su cliente. ¡Está seguro!</h1>", function(result) {
		if(result) {
			$.ajax({
				url:'confirmacion.php',
	 			type:'POST',
	 			data:{confirmar_reservacion:'ok',id:a,correo:c,nombre:b},
	 			beforeSend: function () {
					$.blockUI({
						message:'<i id="icon-tiempo" class="width-10 icon-spinner red icon-spin bigger-125"></i> Espere un momento...',
						css: {
				            border: 'none',
				            padding: '15px',
				            backgroundColor: '#000',
				            '-webkit-border-radius': '10px',
				            '-moz-border-radius': '10px',
				            opacity: .5,
				            color: '#fff'
				        }
				    })
				},
	 			success:function(data){
	 				llenar_tabla();
	 				$.unblockUI();
	 				if (data==0) {
						bootbox.alert("Se ha enviado satisfactoriamente !");
						llenar_tabla();
                	};
                	if (data==1) {
                		bootbox.alert('Lo sentimos No pudimos enviar la confirmación de la reservación');
                	};
	 			}
			});
		}
	});
$('#tbt_mensajes').dataTable().fnClearTable();
llenar_tabla()
}

function mostrar(id){
	$.ajax({
		url:'confirmacion.php',
		type:'POST',
		dataType:'json',
		data:{info_reservacion:':)',id:id},
		success:function(data){
			$('#lbl_cliente').text(data[0]);
			$('#lbl_cedula').text(data[1]);
			$('#lbl_correo').text(data[2]);
			$('#lbl_telefono').text(data[3]);
			$('#lbl_inicio').text(data[4]);
			$('#lbl_fin').text(data[5]);
			$('#lbl_monto').text(data[6]);
			$('#obj_deposito').html(data[7]);
			$('#modal-form').modal('show');
			$('#txt_id_reservacion').val(id);
		}
	});
}