
$(function(){
	//////////////////////////////////////VALIDAR CAJA TIPE FILE



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
	$('#form-servicios').validate({
		errorElement: 'span',
		errorClass: 'help-inline',
		focusInvalid: false,
		rules: {
			txt_servicio: {
				required: true				
			},
			txt_descripcion: {
				required: true				
			},
			txt_otros: {
				required: true
			},
			txt_archivo: {
				required: true
			}
		},

		messages: {
			txt_servicio: {
				required: "Por favor, Digíte nombre del servicio."				
			},
			txt_descripcion: {
				required: "Por favor, Digíte descripcion del servicio."
			},
		txt_otros: {required:"Por favor, Digíte otros"},
		txt_archivo: "Seleccione la Imagen"			
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
                   alert(data)
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
                   
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                } 	        
            });

        	
		},
		invalidHandler: function (form) {
			//alert('fallast')
		}
	});
});



inputid=0;	
//////////////////////////////////////////////////INICIO PROCESO GENERAR ELEMENTOS//////////////////////										
				$("#btn_mas").click(function(){
					inputid++;
					var campo = ''
							+'<i class="icon-caret-right blue"></i> <b><i class="icon-time blue"></i> Horario: '+inputid+'</b>'
							+'<div class="row-fluid">'
								+'<div class="span6">'
									+'<div class="control-group"><label class="control-label" for="Opciones Dias">Seleccione dias:</label>'
										+'<div class="controls">'
											+'<div class="span12">'
												+'<select multiple="" class="chzn-select'+inputid+'" id="'+'select'+inputid+'" data-placeholder="Seleccione Días">'												
												+'</select>'
											+'</div>'
										+'</div>'
									+'</div>'
								+'</div>'
								+'<div class="span6">'
									+'<div class="row-fluid">'
										+'<div class="span12">'
											+'<div class="control-group">'
												+'<label class="control-label" for="form-field-tags">Horarios</label>'
												+'<div class="controls">'													
													+'<input class="span5" type="text" id="form-field-tags'+inputid+'" placeholder="Digite hora..." />'													
												+'</div>'
											+'</div>'
										+'</div>'
									+'</div>'
								+'</div>'
							+'</div>';
					$("#obj_contenedor").append(campo);
					
					//$('.chzn-select'+inputid+"").append("<option value='LUNES' />LUNES");						
					var semana = [ 
						    {"id": 'LUNES', "name": "LUNES"}, 
						    {"id": 'MARTES', "name": "MARTES"},
						    {"id": 'MIERCOLES', "name": "MIERCOLES"},
						    {"id": 'JUEVES', "name": "JUEVES"},
						    {"id": 'VIERNES', "name": "VIERNES"},
						    {"id": 'SABADO', "name": "SABADO"},
						    {"id": 'DOMINGO', "name": "DOMINGO"}
						];

					var myOptions = "<option value></option>";
					for(var i=0; i<semana.length; i++){
					    myOptions +=  '<option value="'+semana[i].id+'">'+semana[i].name+'</option>';
					}
					// uses new "chosen" actualiza con el nuevo señesct"
					$('.chzn-select'+inputid+"").html(myOptions).chosen().trigger("chosen:updated");

					////TAGS
					//we could just set the data-provide="tag" of the element inside HTML, but IE8 fails!
					var tag_input = $("#form-field-tags"+inputid);	
					//alert(tag_input.attr('id'))		
					var regexp = /[0-9]{1,2}[:]{1}[0-9][1,2]/;			
					if(! ( regexp.test(navigator.userAgent)) ){							
						tag_input.tag({placeholder:tag_input.attr('placeholder')});
						//alert('hola '+tag_input.val())
					}							
					else {
						//display a textarea for old IE, because it doesn't support this plugin or another one I tried!							
						tag_input.after('<textarea class="span12" id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="5">'+tag_input.val()+'</textarea>').remove();
						//$('#form-field-tags').autosize({append: "\n"});
					}
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