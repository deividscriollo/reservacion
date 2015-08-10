$(function(){
///////////////////////////PROCESAR IMAGENES////////////////////////////

	function getDoc(frame) {
    	var doc = null;     
     	
     	try {
        	if (frame.contentWindow) {
            	doc = frame.contentWindow.document;
         	}
     	} catch(err) {
    	}
	    if (doc) { 
	         return doc;
	    }
	    try { 
	         doc = frame.contentDocument ? frame.contentDocument : frame.document;
	    } catch(err) {
	         doc = frame.document;
	    }
	    return doc;
 	}
 	// existencia de datos en la tabla
	function buscando(registro){			
		var result = "" ; 					
		$.ajax({
	            url:'php/tarifa.php',
	            async :  false ,   
	            type:  'post',
	            data: {existencia_ser:'ok',reg:registro},            
	            success : function ( data )  {
			         result = data ;  
			    } 		                
	    	});
		return result ; 
	}
	//Validación Existencia correo electronico
		jQuery.validator.addMethod("existe_serv", function (value, element) {
			var a=value;
			var reg=$('#txt_servicio').val();					
			if (buscando(reg,0)==0) {						
				return true;
			};
			if(buscando(reg,0)!=0){						
				return false;
			};
		}, "Por favor, Digite otro servicio ya existe!!!.");
	// validar tamaño del archivo
	$.validator.addMethod('filesize', function(value, element, param) {			    
	    return this.optional(element) || (element.files[0].size <= param) 
	});
	$('#form-servicios').validate({
		errorElement: 'span',
		errorClass: 'help-inline',
		focusInvalid: false,
		rules: {
			txt_servicio: {
				required: true,
				existe_serv: true			
			},
			txt_descripcion: {
				required: true				
			},
			txt_otros: {
				required: true
			},
			txt_archivo: {
				required: true,
				accept: "png|jpe?g|gif", 
				filesize: 1048576
			},
			txt_iva: {
				required: true
			},
			txt_porcentaje: {
				required: true,
				number: true
			},
			txt_capacidad: {
				required: true,
				number: true
			},
		},

		messages: {
			txt_servicio: {
				required: "Por favor, Digite nombre del servicio.",
				existe_serv:'Digite otro servicio ya existe!!!'			
			},
			txt_descripcion: {
				required: "Por favor, Digite descripción del servicio."
			},			
			txt_iva: {
				required: "Por favor, Seleccione es requerido"
			},
			txt_porcentaje: {
				required: 'Por favor, Digite porcentaje es requerido',
				number: 'Por favor, Digite solo valores numéricos'
			},
			txt_otros: {
				required:"Por favor, Seleccione formato de horario"
			},
			txt_capacidad: {
				required: 'Por favor, Digite este campo es requerido',
				number: 'Por favor, Digite solo valores numéricos'
			},
			txt_archivo: {
				required:"Seleccione la Imagen",
				accept:'El archivo debe ser formato JPG, GIF o PNG, menos de 1 MB',
				filesize:'El archivo debe ser formato JPG, GIF o PNG, menos de 1 MB'
			}				
		},

		invalidHandler: function (event, validator) { //display error alert on form submit   
			$('.alert-error', $('.login-form')).show();
		},

		highlight: function (e) {
			$(e).closest('.control-group').removeClass('info').addClass('error');
		},

		success: function (e) {
			$(e).closest('.control-group').removeClass('error').addClass('info');
			$(e).remove();
		},

		errorPlacement: function (error, element) {
			if(element.is(':checkbox') || element.is(':radio')) {
				var controls = element.closest('.controls');
				if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
				else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
			}
			else if(element.is('.select2')) {
				error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
			}
			else if(element.is('.chzn-select')) {
				error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
			}
			else error.insertAfter(element);
		},

		submitHandler: function (form) {

			var formObj = new FormData(form);
			$.ajax({
                url: "php/guardar.php",
                type: "POST",
                data:  formObj,
                mimeType:"multipart/form-data",
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                   mostrar_servicios();
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
                   if (data!=0&&data!=1) {
                   	$.gritter.add({						
							title: '..Mensaje..!',						
							text: 'TENEMOS INCONVENIENTES INTENTE MAS TARDE<br><i class="icon-cloud purple bigger-230"></i> comuniquese con el administrador <br><i class="icon-spinner icon-spin purple bigger-230"></i> : [',						
							//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
							sticky: false,						
							time: ''
						});
                   };                   
                }	        
            });
		}
	});
});

//////////////////////////////////////////////////FIN PROCESO GENERAR ELEMENTOS//////////////////////////////////////////////				
//Validación Existencia registro en tablas
jQuery.validator.addMethod("exis_registro", function (value, element) {
	var a=value;
	var reg=$('#txt_servicio').val();					
	if (buscando(reg)==0) {						
		return false;
	}
}, "Por favor, El servicio que ingreso ya existe verifique!!!.");

function buscar_reg(reg){
	$.ajax({
        url: "php/buscar_registro.php",
        type: "POST",
        data: {registro:reg},        
        success: function(data)
        {
           return data;
        }	        
    });
}