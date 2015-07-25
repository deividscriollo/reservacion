// declaracion inicio de procesos con jquery
$(function(){
	// llamado de funciones
	mostrar_clientes();
	// creacion de funciones	
	// mostrar registros de clientes
	function mostrar_clientes(){
    	// llamado de registros a la tabla
    	$.ajax({
    		url:'app.php',
    		type:'POST',
    		data:{mostrar_clientes:'ok'},
    		dataType:'json',
    		success:function(data){
    			var t = $('#tbt_mensajes').DataTable();
    			var counter = 1;
    			for (var i = 0; i < data.length; i=i+4) {
    				t.row.add( [
            counter +'.1',
            counter +'.2',
            counter +'.3',
            counter +'.4',
            counter +'.5'
        ] ).draw();
    			}
    		}
    	});
    }
    // permite verificar los registros seleccionados en la tabla
    function busca_seleccionado_chek(){
        var amd_x=':(';
        $("#tbt_mensajes tbody tr").each(function (index) {
            var campo0, campo1, campo2, campo3,campo4;
            $(this).children("td").each(function (index2) {
                switch (index2) {
                    case 1:
                        campo1 = $(this).text();
                        break;
                    case 2:
                        campo2 = $(this).text();
                        break;
                    case 3:
                        campo3 = $(this).text();
                        break;
                    case 4:
                        campo0 = $(this).children('label').children('input').is(":checked");
                        if (campo0==true) { 
                            amd_x=':)';
                        };
                        break;
                }
            });
            // console.log(campo0+' '+campo1+' '+campo2)
        });
    return amd_x;
    }
    // procesando informacion antes de enviar
    $('#form-mensajes').validate({
		submitHandler: function (form) {
			if ($('#editor1').html()=='') {
				 $('#editor1').addClass('bounce animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
			      $(this).removeClass('bounce animated');
			    });
			}
			var req=busca_seleccionado_chek();
			if (req==':(') {
                $('#tbt_mensajes').addClass('rubberBand animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
			      $(this).removeClass('rubberBand animated');
			    });
			};
			if (req==':)') {
				// envio de mensajes
				$("#tbt_mensajes tbody tr").each(function (index) {             
		            var campo0, campo1, campo2, campo3,campo4;
		            $(this).children("td").each(function (index2) {
		                switch (index2) {
		                    case 1:
		                        campo1 = $(this).text();
		                        break;
		                    case 2:
		                        campo2 = $(this).text();
		                        break;
		                    case 3:
		                        campo3 = $(this).text();
		                        break;                    
		                    case 4:
		                        campo0 = $(this).children('label').children('input').is(":checked");
		                        if (campo0==true) { 
		                            $.ajax({
							    		url:'app.php',
							    		type:'POST',
							    		data:{envio_mensajes:'ok', mensaje:$('#editor1').html(),nombre:campo1, correo:campo2},
							    		beforeSend: function (index3) {								        	
								        	$.blockUI({
												message:'<i id="icon-tiempo" class="width-10 icon-spinner red icon-spin bigger-125"></i> El envió de correos masivos desde forma local tienen su tiempo de espera de 1 a 2 segundos por mensaje tenga paciencia. Espere un momento...',
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
								           	console.log(data)
								           	if (data==1) {
								           		$.gritter.add({
													title: '<h1 class="icon-ok" style="color: #336699;">Usuario</h1>',
													text: 'Correo publicitario enviado con exito <br>Email: '+campo2,
													time: 4000
													//class_name: 'gritter-info')
												});	
								           	};
							    		}
							    	});
		                        };
		                        break;   
		                }                
		            });
		        });
			}
		}		
	});
	// estableciendo parametros para la tabla de mostrar clientes
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
		    "sSearch":         "Buscar:",
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
	
});