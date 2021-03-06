$('#form-acceso').validate({
		errorElement: 'span',
		errorClass: 'help-inline',
		focusInvalid: false,
		rules: {
			txt_usuario: {
				required: true,
				email:true				
			},
			txt_pass: {
				required:true
			}
		},

		messages: {
			txt_usuario: {
				required: "Por favor, Digite su correo / email.",
				email: "Por favor, Digite correo ej. 123@ejem.com"

			},
			txt_pass: {
				required:"Por favor, Digite su clave / password"
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
                url: 'php/acceso.php',
				type: 'POST',				
				data: {validar_acceso:'ok', u: $('#txt_usuario').val(), p:$('#txt_pass').val()},                
                success:  function (data) { 
                //alert(data)               	
                	if (data==0) {
                		$.gritter.add({						
							title: '..Mensaje..!',						
							text: 'Su usuario o contraseña no son correctos.<br><i class="icon-lock red bigger-230"></i>',						
							//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
							sticky: false,						
							time: ''
						});
                	};
                	if (data==1) {
                		$.gritter.add({						
							title: '..Mensaje..!',						
							text: 'Bienvenido: '+$('#txt_usuario').val()+'<br><i class="icon-ok green bigger-230"></i>   Por favor espere unos segundos para acceder a la aplicación. <br><i class="icon-spinner icon-spin green bigger-230"></i> : )',						
							//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
							sticky: false,						
							time: ''
						});
						redireccionar();
                	}; 
                	if (data==2) {
                		$.gritter.add({						
							title: '..Mensaje..!',						
							text: 'Ooooo: '+$('#txt_usuario').val()+'<br><i class="icon-cloud purple bigger-230"></i>   Le sugerimos activar su cuenta, por favor revise su correo electrónico y siga las instrucciones. <br><i class="icon-spinner icon-spin purple bigger-230"></i> : [',						
							//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
							sticky: false,						
							time: ''
						});
						//Limpiar formulario
						$('#form-acceso').each (function(){
						  this.reset();
						});					
                	}; 
                	if(data!=0&&data!=1&&data!=2){
                		$.gritter.add({						
							title: '..Mensaje..!',						
							text: 'Lo sentimos: '+$('#txt_usuario').val()+'<br><i class=" icon-cogs red bigger-230"></i>   Informe al Administrador . <br><i class="icon-spinner icon-spin red bigger-230"></i> : [',						
							//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
							sticky: false,						
							time: ''
						});
						//redireccionar();
                	};                
                }
        	});
		}		
	});
function redireccionar() {
	setTimeout("location.href='../data/inicio/'", 300);
}
$(function(){
	$('#btn_ayuda_registro').click(function(){
		mywindow = window.open("ayuda/registro.html", "mywindow", "location=1,status=1,scrollbars=1,  width=400,height=600");
    	mywindow.moveTo(0, 0);
	});
})