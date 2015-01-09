
	mostrar_usr();
	function mostrar_usr(){
		$('#tbt_mostrar_usuarios').dataTable( {
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
			},					
	        ajax: { 
	        	url: "php/mostrar_usuarios.php",
	        	type:'POST',
	        	data:{mostrar:'hola'}
	        }			 

	    });
	} 
	
	mostrar_mensajes()
	function mostrar_mensajes(){
		$('#tbt_mensajes').dataTable( {
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
			},					
	        ajax: { 
	        	url: "php/mostrar_usuarios.php",
	        	type:'POST',
	        	data:{mostrar_mensajes:'hola'}
	        }
			 

	    });
	}  
$(function(){
	$('#btn_todos').click(function(){
		$('#btn_error_msm').hide(500);
		$("#tbt_mensajes tbody tr").each(function (index) {
                var campo1, campo2, campo3;
                $(this).children("td").each(function (index2) {
                    switch (index2) {                        
                        case 1:
                            campo1 = $(this).text();
                            break;
                        case 2:
                            campo2 = $(this).text();
                            break;
                        case 4:
                            campo3 = $(this).text();
                            break;
                        case 5:
                        	
                            // campo4 = $(this).children().children().removeAttr('checked');
							//campo4 = $(this).children().children().attr("checked", "checked");                        
							campo4 = $(this).children().children().prop("checked", "checked");                        
                            break;
                    }
                
                })
            // console.log(campo1 + ' - ' + campo2 + ' - ' + campo3+ ' - ' + campo4);

            })
		 // console.log($(campo4).Attr("checked"))		
	});
	$('#btn_usuario').click(function(){
		$('#btn_error_msm').hide(500);
		$("#tbt_mensajes tbody tr").each(function (index) {
                var campo1, campo2, campo3;
                $(this).children("td").each(function (index2) {
                    switch (index2) {                        
                        case 1:
                            campo1 = $(this).text();
                            break;
                        case 2:
                            campo2 = $(this).text();
                            break;
                        case 4:
                            campo3 = $(this).text();
                            break;
                        case 5:
                        	if(campo3=='cliente')
								campo4 = $(this).children().children().prop("checked", "checked");
							else
								campo4 = $(this).children().children().removeAttr('checked');
                            break;
                    }
                
                });
            // console.log(campo1 + ' - ' + campo2 + ' - ' + campo3+ ' - ' + campo4);

        })
	});
	$('#btn_admin').click(function(){
		$('#btn_error_msm').hide(500);
			$("#tbt_mensajes tbody tr").each(function (index) {
		        var campo1, campo2, campo3;
		        $(this).children("td").each(function (index2) {
		            switch (index2) {                        
		                case 1:
		                    campo1 = $(this).text();
		                    break;
		                case 2:
		                    campo2 = $(this).text();
		                    break;
		                case 4:
		                    campo3 = $(this).text();
		                    break;
		                case 5:
		                	if(campo3=='administrador')
								campo4 = $(this).children().children().prop("checked", "checked");
							else
								campo4 = $(this).children().children().removeAttr('checked');
		                    break;
		            }
		        
		        });
		    // console.log(campo1 + ' - ' + campo2 + ' - ' + campo3+ ' - ' + campo4);
		    })
	});
$('#btn_error_msm').hide();
$('#btn_error_msm2').hide();
$('#btn_enviar_mensaje').click(function(){

	if($('input[type=radio]:checked').length == 0){
		$('#btn_error_msm').show(500);
	};		
	if($('input[type=radio]:checked').length == 1){
		mensaje=$('#editor1').html();
		// console.log(mensaje.length)
		if (mensaje.length==0) {
			$('#btn_error_msm2').show(500);
		};
		if (mensaje.length!=0) {			
			$('#btn_error_msm2').hide(500);
			$("#tbt_mensajes tbody tr").each(function (index) {				
		        $(this).children("td").each(function (index2) {

		            switch (index2) {                        
		                case 1:
		                    campo1 = $(this).text();
		                    break;
		                case 2:
		                    campo2 = $(this).text();
		                    break;
		                case 4:
		                    campo3 = $(this).text();
		                    break;
		                case 5:		                	
							campo4 = $(this).children().children('input').is(":checked");
							if (campo4==true) {
								// console.log(mensaje+'listo para enviar')
								$(this).parent().css("background-color", "#BFCFFF");								
									$.ajax({
								        url: "php/correo_masivo.php",
								        type: "POST",								        
								        data: {correo:campo2,html:mensaje},
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
								        success: function(data)
								        {
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
								           	if (data!=1) {
								           		$.gritter.add({
													title: '<h1 style="color: #336699;">Mensaje</h1>',
													text: 'MMM.. tenemos Algunos Inconvenientes LO SENTIMOS te sugerimos intentar mas tarde...',
													time: 4000
													//class_name: 'gritter-info')
												});	
								           	};
								        }					                 	        
								    });
							};
							
		            }
		        	        
		        });			               
		    })
			
		};
	};	
});
})
