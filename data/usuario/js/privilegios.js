$(document).ready(function() {	
	//llamar a la funcion
	privilegio_();
	function privilegio_(){
		$('#tbt_privilegios').dataTable( {
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
		    	data:{privilegios:'hola'}
		    }
		});
	}
});
function s_privilegio(event){
	var valor=event.target.value;
	var tar = event.target;
	var ob_valor;
	$(tar).parent().parent().each(function (){					
		$(this).children("td").each(function (index) {
			switch (index) {
			case 0:
				ob_valor=$(this).text();
			break;
			case 7:
				$(this).text(valor.toUpperCase());
			break;
			}
		});
	})
	$.ajax({
	    url: "php/mostrar_usuarios.php",
	    type: "POST",
	    data: {modificar:'hola', valor:valor, ced:ob_valor},
	    success: function(data)
	    {
	       //console.log(data);
	       if (data==0) {
	       		$.gritter.add({						
					title: '..Mensaje..!',						
					text: 'OK: <br><i class="icon-cloud purple bigger-230"></i>  Sus datos fueron almacenados correctamente. <br><i class="icon-spinner icon-spin green bigger-230"></i>',						
					//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
					sticky: false,						
					time: 2000
				});
				//$('#txt_archivo').ace_file_input();
				$('#txt_archivo').ace_file_input('reset_input');

				$('#form-servicios').each (function(){
					this.reset();
				});
	       };
	       if (data==1) {
	       		$.gritter.add({						
					title: '..Mensaje..!',						
					text: 'Ooooo: <br><i class="icon-cloud purple bigger-230"></i>   Lo sentimos intente mas tarde. <br><i class="icon-spinner icon-spin red bigger-230"></i> : [',						
					//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
					sticky: false,						
					time: ''
				});
	       };      
	       
	    },
	    error: function(jqXHR, textStatus, errorThrown) 
	    {
	    } 	        
	});
}