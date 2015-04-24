mostrar_categoria();               
mostrar_servicios();
// existencia de datos en la tabla
function buscando_cat(registro){
	var result = "" ; 					
	$.ajax({
            url:'php/tarifa.php',
            async: false,
            type:  'post',
            data: {existencia_categoria:'ok',reg:registro},            
            success : function ( data )  {
            	//$("#icon_b_usuario").addClass("icon-user");		                						         
		         result = parseInt(data);  
		         // console.log(result)
		    } 		                
    	});
	return result ; 
}
//Validación Existencia correo electronico
	jQuery.validator.addMethod("existe_cat", function (value, element) {
		var a=value;
		var reg=$('#txt_categoria').val();
		if (buscando_cat(reg,0)==0) {						
			return true;
		};
		if(buscando_cat(reg,0)!=0){						
			return false;
		};
	}, "Por favor, Digite otro correo ya existe!!!.");
$('#form-categoria').validate({
	errorElement: 'span',
	errorClass: 'help-inline',
	focusInvalid: false,
	rules: {
		txt_categoria: {
			required: true,
			existe_cat:true			
		}
	},
	messages: {
		txt_categoria: {
			required: "Por favor, Digíte nombre dela categoría.",
			existe_cat: "La categoría ya existe, digíte otra."
		}			
	},
	invalidHandler: function (event, validator) { //display error alert on form submit   
		$('.alert-error', $('.login-form')).show();
	},
	highlight: function (e) {
		$(e).closest('.control-group').removeClass('success').addClass('error');
	},
	success: function (e) {
		$(e).closest('.control-group').removeClass('error').addClass('success');
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

		$.ajax({
            url: "php/tarifa.php",
            type: "POST",
            data: {guardar_cat:'ok',txt_1:$('#txt_categoria').val()},
            success: function(data)
            {
				mostrar_categoria();               
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

					$('#form-categoria').each (function(){
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
// mostrar contenido de la ventana modal con los datos seleccionados
function modificar_servicios(id){
	$('#txt_id_servicio').val(id)
	$.ajax({
	    url: "php/servicio.php",
	    type: "POST",
	    dataType:'json',
	    data: {campos_servicios:'ok',id:id},        
	    success: function(data)
	    {	//console.log(data);
	        $('#lbl_servicio').html(data[0]);
	        if (data[4]=='0')
	       		$('#lbl_horario').html('CONTIÚO');
	        if (data[4]=='1')
	       		$('#lbl_horario').html('POR HORAS');
	        $('#lbl_iva').html(data[5]);
	       
	    	$('#lbl_porcentaje').html(data[6]);
	    	$('#lbl_capacidad').html(data[7]);
	    	$('#file_img2').attr('src','img/'+data[2]);
	    	$('#lbl_descr').html(data[1]);
	    	$('#lbl_stado').html(data[8])
	    }	        
	});	
	$('#modal-editar-servicios').modal('show');
}

$.validator.addMethod('filesize', function(value, element, param) {			    
    return this.optional(element) || (element.files[0].size <= param) 
});
$('#form_img, #form_edicion_img').validate({	
	rules: {			
		file_img: {
			required: true, 
			accept: "png|jpe?g|gif", 
			filesize: 1048576
		}			
	},
	invalidHandler: function (event, validator) { //display error alert on form submit   
		$.gritter.removeAll();
		$.gritter.add({                     
            title: '..Mensaje..!',                      
            text: '<i class="icon-cloud purple bigger-230"></i>  El archivo debe ser formato JPG, GIF o PNG, menos de 1 MB  <i class="icon-spinner icon-spin green bigger-230"></i>',                      
            //image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',                        
            sticky: false,                      
            time: 2000,
            
            class_name: 'gritter-error gritter-center'
        });
	},
	submitHandler: function (form) {
		var formObj = new FormData(form); 	
		$.ajax({
			url:'php/servicio.php',
			type: 'POST',
		    processData: false,
		    contentType: false,
			data:formObj,
			success:function(data){	
				data=data.replace("\n","");
				data=data.replace("\n","");
				data=data.replace("  ","");
				var res=data.split(';');
				console.log(res[1]);
				$('#file_img2').attr('src','img/'+res[1]);
				mostrar_servicios()
				$('#form_img').each (function(){
					this.reset();
				});
			}
		});
	}		
});

$('#form-servicios1').validate({
	errorElement: 'span',
	errorClass: 'help-inline',
	focusInvalid: false,
	rules: {
			txt_servicio1: {
				required: true
			},
			txt_descripcion1: {
				required: true				
			},
			txt_otros1: {
				required: true
			},
			txt_archivo: {
				required: true
			}
		},
		messages: {
			txt_servicio1: {
				required: "Por favor, Digite nombre del servicio.",
				existe_serv:'Digite otro servicio ya existe!!!'			
			},
			txt_descripcion1: {
				required: "Por favor, Digite descripción del servicio."
			},
		txt_otros1: {required:"Por favor, Digite otros"},
		txt_archivo: "Seleccione la Imagen"			
	},
	invalidHandler: function (event, validator) { //display error alert on form submit   
		$('.alert-error', $('.login-form')).show();
	},
	highlight: function (e) {
		$(e).closest('.control-group').removeClass('success').addClass('error');
	},
	success: function (e) {
		$(e).closest('.control-group').removeClass('error').addClass('success');
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
		alert(form)
		var formObj = new FormData(form); 				
		$.ajax({
            url: "php/tarifa.php",
            type: "POST",
            data: {modificar_cat:'ok',txt_1:$('#txt_categoria').val(),id:$('#lbl_id_categoria').html()},
            success: function(data)
            {
				mostrar_categoria();
				console.log(data)               
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

					$('#form-categoria').each (function(){
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

$('#btn_servicos').click(function(){
	$.ajax({
	    url: "php/mostrar.php",
	    type: "POST",
	    //data: {registro:reg},        
	    success: function(data)
	    {
	       $('#mostrar_servicios').html(data);
	    }	        
	});
});

function guardar_id(x){
	$.gritter.add({						
		title: '..Mensaje..!',						
		text: 'Datos Seleccionados <i class="icon-spinner icon-spin green bigger-230"></i> ',						
		//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
		sticky: false,						
		time: 600,
		//class_name: 'gritter-center'
	});
	g_edicion('#lbl_servicios',1,x);
	$('#lbl_id_servicio').html(x);
	g_edicion('#alert_descripcion',2,x);
	g_edicion('#lbl_fecha',4,x);
	//g_edicion('#lbl_stado_ser_info',9,x);
	//imagenes

	g_edicion_img(3, x);
	//active 
	$("#btn_servicos").parent().removeClass("active");
	$("#btn_perfil").parent().addClass("active");
	/**/
	
	mostrar_tarifa(x)
	mostrar_horario(x)
	$('#btn_perfil').show();
}
// mostrando categoria en tabla
function mostrar_categoria(){
	$.ajax({
	    url: "php/tarifa.php",
	    type: "POST",
	    data: {mostrar_categoria:'ok'},        
	    success: function(data)
	    {		
	       	$('#tbl_categoria tbody').html(data);	       	
	    }   
	});
}
function mostrar_servicios(){
	$.ajax({
	    url: "php/tarifa.php",
	    type: "POST",
	    data: {mostrar_servicios:'ok'},        
	    success: function(data)
	    {		
	       	$('#tbl_servicios tbody').html(data);	       	
	    }   
	});
}
function g_edicion(elemento, pos, x){
	$.ajax({
	    url: "php/buscar_p.php",
	    type: "POST",
	    data: {id:x,pos:pos},        
	    success: function(data)
	    {		
	       	$(elemento).html(data);	
	    }   
	});
}
function g_edicion_img(pos, x){
	$.ajax({
	    url: "php/buscar_p.php",
	    type: "POST",
	    data: {id:x,pos:pos},        
	    success: function(data)
	    {	
	    	console.log(data);
	    	var valor=data.split(" ");
	    	
	       	$('#img_foto').html('<img id="avatar" src="img/'+valor[2]+'"/>'); 	       		
	    }   
	});
	
}