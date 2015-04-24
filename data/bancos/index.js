$(function(){
	// existencia de datos en la tabla
	function buscando(registro){			
		var result = "" ; 					
		$.ajax({
	            url:'bancos.php',
	            async :  false ,   
	            type:  'post',
	            data: {existencia_bancos:'ok',reg:registro},            
	            success : function ( data )  {
	            	//$("#icon_b_usuario").addClass("icon-user");		                						         
			         result = data ;  
			    } 		                
	    	});
		return result ; 
	}
	//Validación Existencia correo electronico
		jQuery.validator.addMethod("existe_banc", function (value, element) {
			var a=value;
			var reg=$('#txt_n_banco').val();					
			if (buscando(reg,0)==0) {						
				return true;
			};
			if(buscando(reg,0)!=0){						
				return false;
			};
		}, "Por favor, Digite otro banco, ya existe!!!.");
	$('#form_n_bancos').validate({
		errorElement: 'span',
		errorClass: 'help-inline',
		focusInvalid: false,
		rules: {
			txt_n_banco: {
				required: true,
				existe_banc: true			
			}
		},
		messages: {
			txt_n_banco: {
				required: "Por favor, Digíte nombre del banco.",
				existe_banc:'Digite otro banco, ya existe!!!'			
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
                url: "bancos.php",
                type: "POST",
                data:  {guardar:'ok',txt_1:$('#txt_n_banco').val().toUpperCase()},               
                success: function(data)
                {
                   console.log(data);
                   cargar_bancos();
                   if (data==0) {
                   		$.gritter.add({						
							title: '..Mensaje..!',						
							text: 'OK: <br><i class="icon-cloud purple bigger-230"></i>  Sus datos fueron almacenados correctamente. <br><i class="icon-spinner icon-spin green bigger-230"></i>',						
							//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
							sticky: false,						
							time: 2000
						});
						//$('#txt_archivo').ace_file_input();

						$('#form_n_bancos').each (function(){
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
	$('#form_n_cuentas').validate({
		errorElement: 'span',
		errorClass: 'help-inline',
		focusInvalid: false,
		rules: {			
			sel_n_banco:{
				required: true
			},
			txt_n_cuentas: {
				required: true,
				number: true
				// existe_banc: true	
			},
			sel_tipo_cuenta:{
				required:true
			}
		},
		messages: {
			sel_n_banco:{
				required: "Por favor, Seleccione banco."
			},			
			txt_n_cuentas: {
				required: "Por favor, Digíte numero de cuenta.",
				number: "Por favor, Digíte solo numero.",
				// existe_banc:'Digite otro banco, ya existe!!!'			
			},
			sel_tipo_cuenta:{
				required: "Por favor, Seleccione tipo de cuenta."
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
                url: "bancos.php",
                type: "POST",
                data:  {guardar_cuentas:'ok',id:$('#sel_n_banco').val(),txt_1:$('#txt_n_cuentas').val(),txt_2:$('#sel_tipo_cuenta').val()},               
                success: function(data)
                {
                   console.log(data);
                   cargar_cuentas();
                   if (data==0) {
                   		$.gritter.add({						
							title: '..Mensaje..!',						
							text: 'OK: <br><i class="icon-cloud purple bigger-230"></i>  Sus datos fueron almacenados correctamente. <br><i class="icon-spinner icon-spin green bigger-230"></i>',						
							//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
							sticky: false,						
							time: 2000
						});
						//$('#txt_archivo').ace_file_input();

						$('#form_n_cuentas').each (function(){
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
// llamar informacion base de datos tabla
function cargar_bancos(){						
    $.ajax({ 
    	url: "bancos.php",
    	type:'POST',
    	data:{mostrar_bancos:'ok'},
    	success:function(data){
    		$('#tbl_bancos tbody').html(data);
    		$('[data-rel=tooltip]').tooltip();
    		$('.dc_cursor').css({'cursor':'pointer'});
    		
    	}
    });	
}
function cargar_bancos_select(){						
    $.ajax({ 
    	url: "bancos.php",
    	type:'POST',
    	data:{mostrar_bancos_select:'ok'},
    	success:function(data){
    		$('#sel_n_banco').html(data);    		
    	}
    });	
}
function cargar_cuentas(){						
    $.ajax({ 
    	url: "bancos.php",
    	type:'POST',
    	data:{mostrar_cuentas:'ok'},
    	success:function(data){
    		$('#tbl_cuentas tbody').html(data);
    		$('[data-rel=tooltip]').tooltip();
    		$('.dc_cursor').css({'cursor':'pointer'});
    		
    	}
    });	
}			
cargar_bancos();
cargar_cuentas();
cargar_bancos_select();
function dc_bancos_nuevo(){
$('#modal-nuevo_banco').modal('show');
	
}
function dc_cuentas_nuevo(){
	$('#modal-nuevo_cuenta').modal('show');
	cargar_bancos_select();
}
function dc_bancos_modificar(id){	
	$('#modal-editar_banco').modal('show');
}
function dc_bancos_eliminar(id){
	bootbox.confirm("<h1>Seguro desea Eliminar<h1>", function(result) {
		if(result) {
			$.ajax({
		        url: "bancos.php",
		        type: "POST",
		        data:{eliminar_bancos:'ok',id:id},			               
		        success: function(data){
					cargar_bancos();
					$.gritter.add({						
						title: '..Mensaje..!',						
						text: 'OK: <br><i class="icon-cloud purple bigger-230"></i>  Sus datos fueron eliminados . <br>',						
						//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
						sticky: false,						
						time: 2000
					});
		        }			                	        
		    });
		}
	});
}
function dc_cuentas_eliminar(id){
	bootbox.confirm("<h1>Seguro desea Eliminar<h1>", function(result) {
		if(result) {
			$.ajax({
		        url: "bancos.php",
		        type: "POST",
		        data:{eliminar_cuentas:'ok',id:id},			               
		        success: function(data){
					cargar_cuentas();
					$.gritter.add({						
						title: '..Mensaje..!',						
						text: 'OK: <br><i class="icon-cloud purple bigger-230"></i>  Sus datos fueron eliminados . <br>',						
						//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
						sticky: false,						
						time: 2000
					});
		        }			                	        
		    });
		}
	});
}