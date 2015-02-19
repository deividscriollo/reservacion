	// buscando existencia de tarifa en la categoria existente
	function buscando_tar(registro,a,id){
		var result = "" ; 					
		$.ajax({
	            url:'php/tarifa.php',
	            async: false,
	            type:  'post',
	            data: {existencia_tarifa:'ok',reg:registro,id:id},            
	            success : function ( data )  {
	            	//$("#icon_b_usuario").addClass("icon-user");		                						         
			         result = parseInt(data);  
			         console.log(result)
			    } 		                
	    	});
		return result ; 
	}
$(function(){	
	//Validación Existencia correo electronico
	jQuery.validator.addMethod("existe_tar", function (value, element) {
		var a=value;
		var reg=$('#t_nombre').val();
		var id=$('#sel_categoria').val();
		if (buscando_tar(reg,0,id)==0) {						
			return true;
		};
		if(buscando_tar(reg,0,id)!=0){						
			return false;
		};
	}, "Digite otra tarifa, ya existe!!!.");
	$('#form-tarifa').validate({
		errorElement: 'span',
		errorClass: 'help-inline',
		focusInvalid: false,
		rules: {
			sel_categoria:{
				required:true
			},
			t_nombre: {
				required: true,
				existe_tar: true					
			},						
			t_precio: {
				required: true,
				number: true					
			}
		},

		messages: {
			sel_categoria:{
				required: "Por favor, Seleccione categoría de la tarifa."
			},
			t_nombre: {
				required: "Por favor, Digíte nombre de la tarifa."
			},
			t_precio: {
				required: "Por favor, Digíte precio.",
				number: "Por favor, Digíte solo numero."					
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
			$.ajax({
                url: "php/tarifa.php",
                type: "POST",
                data:{guardar:'ok',tarifa:$('#t_nombre').val().toUpperCase(),cat:$('#sel_categoria').val(), precio: $('#t_precio').val(),id:$('#lbl_id_servicio').html()},			               
                success: function(data)
                {			
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

						$('#form-tarifa').each (function(){
							this.reset();
						});

						mostrar_tarifa($('#lbl_id_servicio').html());
						mostrar_categoria_select()
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
// mostrar tabla tarifa
function mostrar_tarifa(id){	
	$.ajax({
        url: "php/tarifa.php",
        type: "POST",
        data:{mostrar_tarifa:'ok', id:id},			               
        success: function(data)
        {			
			//console.log(data)   
			$('#tabla_tarifa tbody').html(data);
        }			                	        
    });
}
// eliminar refgistro tarifa
function t_eliminar(id){
	bootbox.confirm("<h1>EN PROCESO<h1>", function(result) {
		if(result) {
			$.ajax({
		        url: "php/tarifa.php",
		        type: "POST",
		        data:{id:id,eliminar:'ok'},			               
		        success: function(data)
		        {			
					//console.log(data)   
					$('#tabla_tarifa tbody').html(data);
					$.gritter.add({						
						title: '..Mensaje..!',						
						text: 'OK: <br><i class="icon-cloud purple bigger-230"></i>  Sus datos fueron eliminados correctamente. <br>',						
						//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
						sticky: false,						
						time: 2000
					});			
					mostrar_tarifa($('#lbl_id_servicio').html());
		        }			                	        
		    });
		}
	});
}

