$(function(){
	$('#form-tarifa').validate({
					errorElement: 'span',
					errorClass: 'help-inline',
					focusInvalid: false,
					rules: {
						t_nombre: {
							required: true						
						},						
						t_precio: {
							required: true,
							number: true					
						}

					},
			
					messages: {
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
			                data:{tarifa:$('#t_nombre').val().toUpperCase(), precio: $('#t_precio').val(),guardar:'ok',id:$('#lbl_id_servicio').html()},			               
			                success: function(data)
			                {			
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

									$('#form-tarifa').each (function(){
										this.reset();
									});
									mostrar_tarifa($('#lbl_id_servicio').html());
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
					},
					invalidHandler: function (form) {						
					}
				});
});
// mostrar tabla tarifa
function mostrar_tarifa(id){	
	$.ajax({
        url: "php/tarifa.php",
        type: "POST",
        data:{mostrar:'ok', id:id},			               
        success: function(data)
        {			
			//console.log(data)   
			$('#tabla_tarifa tbody').html(data);
        }			                	        
    });
}
// eliminar refgistro tarifa
function t_eliminar(id){
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

