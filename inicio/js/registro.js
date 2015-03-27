$('#form-acceso').validate({
		errorElement: 'span',
		errorClass: 'help-inline',
		focusInvalid: false,
		rules: {
			txt_usuario: {
				required: true							
			},
			txt_pass: {
				required:true
			}
		},

		messages: {
			txt_usuario: {
				required: "Por favor, Digite usuario."
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
				data: {txt_1: $('#txt_usuario').val(),txt_2: $('#txt_pass').val()},
			})
			$.ajax({
                url: 'php/acceso.php',
				type: 'POST',				
				data: {txt_1: $('#txt_usuario').val(),txt_2: $('#txt_pass').val()},                
                success:  function (data) {
                	if (data==0) {
                		$.gritter.add({						
							title: '..Mensaje..!',						
							text: 'Su usuario O contraseña <span class="red">NO</span> son correctos.<br><i class="icon-lock red bigger-230"></i>',						
							//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
							sticky: false,						
							time: ''
						});
                	};
                	if (data==1) {
                		$.gritter.add({						
							title: '..Mensaje..!',						
							text: 'Bienvenido: '+$('#txt_usuario').val()+'<br><i class="icon-ok green bigger-230"></i>   Por favor dame unos segundos para acceder a la aplicación por favor. <br><i class="icon-spinner icon-spin green bigger-230"></i> : )',						
							//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
							sticky: false,						
							time: ''
						});
						//redireccionar();
                	};                
                }
        	});
		},
		invalidHandler: function (form) {
			
		}
	});
function redireccionar() {
	setTimeout("location.href='../data'", 1000);
}