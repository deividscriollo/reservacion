$(function(){
	var calendar = $('#calendar').fullCalendar({
		//isRTL: true,
		defaultDate: new Date(),
		defaultView: "agendaWeek",
		buttonHtml: {
			prev: '<i class="ace-icon fa fa-chevron-left"></i>',
			next: '<i class="ace-icon fa fa-chevron-right"></i>'
		},
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ], 
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: [ 'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
		buttonText: {
			today: 'hoy',
			month: 'mes',
			week: 'semana',
			day: 'día'
		},
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		events: {
			url: 'app.php',
			data:{reservacion_eventos:'ok'},
			type:'POST',
			error: function(data) {
				console.log(data);
			}
		},
		slotDuration: '00:15:00',
		editable: true,
		droppable: true, // this allows things to be dropped onto the calendar !!!
		selectable: true,
		selectHelper: true,
		eventLimit: true, // allow "more" link when too many events
	});

	$('#btn_descartar').click(function(){
		$('#modal-form').modal('hide');
		$('#modal-negado').modal('show');
		var nombre=$('#lbl_cliente').html();
		var servicio=$('#lbl_servicio').html();
		$('#txt_mensaje_negado').html('Estimado/a, '+nombre+' al momento no disponemos el servicio '+servicio+' en el horario para esa fecha si desea reservar en otro horario con gusto le atenderemos, Gracias por su tiempo.')
	})
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
	$('#btn_confirmar_reservacion').click(function(){
		$('#modal-negado').modal('hide');
		$.ajax({
			url:'app.php',
			type:'POST',
			dataType: 'json',
			data:{confirmar_reservacion_otros:'ok',id:$('#txt_id_reservacion').val(),mensaje:$('#txt_mensaje_negado').html(),correo:$('#lbl_correo').html()},
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
 				$.unblockUI();
				if (data[0]==1) {
					llenar_tabla()
					bootbox.alert("<h2>Mensaje Enviado Correctamente</h2>")
				};
				if (data[0]!=1) {
					bootbox.alert("<h2>Mensaje NO enviado intente mas tarde</h2>")
				}

			}
		});
	});
});
function llenar_tabla(){

$.ajax({
	url:'app.php',
	type:'POST',
	dataType: 'json',
	data:{mostrar_reservacion:'ok'},
	success:function(data){
		var a=1;
		$('#tbt_mensajes').DataTable().clear().draw();
		for (var i = 0; i < data.length; i=i+5) {
			$('#tbt_mensajes').dataTable().fnAddData([
					a,
					data[i+0],
					data[i+1],
					data[i+2],
					data[i+3],
					data[i+4],
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
				url:'app.php',
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
		url:'app.php',
		type:'POST',
		dataType:'json',
		data:{info_reservacion:':)',id:id},
		success:function(data){
			$('#lbl_servicio').text(data[0]);
			$('#lbl_cliente').text(data[1]);
			$('#lbl_cedula').text(data[2]);
			$('#lbl_correo').text(data[3]);
			$('#lbl_telefono').text(data[4]);
			$('#lbl_inicio').text(data[5]);
			$('#lbl_fin').text(data[6]);
			$('#lbl_monto').text(data[7]);
			$('#obj_deposito').html(data[8]);
			$('#modal-form').modal('show');
			$('#txt_id_reservacion').val(id);
		}
	});
}

