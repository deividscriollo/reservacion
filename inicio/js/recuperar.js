		//Validación Existencia correo electronico
		jQuery.validator.addMethod("exis_correorecuperar", function (value, element) {
			var a=value;
			var reg=$('#txt_rec_email').val();					
			if (buscando(reg)==0) {						
				return false;
			};
			if(buscando(reg)!=0){						
				return true;
			};
		}, "Por favor, El correo que ingreso no existe verifique!!!.");
		//verificacion de procesos validacion
		$('#frm-recuperar').validate({
		errorElement: 'span',
		errorClass: 'help-inline',
		focusInvalid: false,
		rules: {
			txt_rec_email: {
				required: true,
				email:true,
				exis_correorecuperar:true
			}
		},

		messages: {
			txt_rec_email: {
				required: "Por favor, Digite su correo / email.",
				email: "Por favor, Digite correo ej. 123@ejem.com",
				exis_correorecuperar:'Su correo no existe, verifique y vuelva a intentarlo'

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
                url: 'php/recuperar.php',
				type: 'POST',				
				data: {txt_1: $('#txt_rec_email').val()}, 
				beforeSend: function () {
					$.blockUI({
						message:'<i id="icon-tiempo" class="width-10 icon-spinner red icon-spin bigger-125"></i> Espere un momento...',
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
                success:  function (data) {                              	
                	if (data==0) {
                		$.unblockUI();
                		$.gritter.add({						
							title: '..Mensaje..!',						
							text: 'Intente mas tarde<span class="red">NO</span>.<br><i class="icon-lock red bigger-230"></i>',						
							//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
							sticky: false,						
							time: ''
						});
                	};
                	if (data==1) {
                		$.unblockUI();
                		$.gritter.add({						
							title: '..Mensaje..!',						
							text: 'Por favor: '+$('#txt_usuario').val()+'<br><i class="icon-ok green bigger-230"></i>   revice su correo y sigas las instrucciones.<br><i class="icon-spinner icon-spin green bigger-230"></i> : )',						
							//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
							sticky: false,						
							time: ''
						});
						//redireccionar();
                	};                 	
                	if(data!=0&&data!=1&&data!=2){
                		$.unblockUI();
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
		},
		invalidHandler: function (form) {
			
		}
	});
function redireccionar() {
	setTimeout("location.href='../data'", 5000);
}