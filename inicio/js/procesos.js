// Buscando registros seccion nombre usuario
function buscando(registro, campo){
	var result = "" ; 					
	$.ajax({
            url:'php/rev_usu_exi.php',
            async :  false ,   
            type:  'post',
            data: {reg:registro, campo:campo},
            beforeSend: function () {
                //$("#icon_b_usuario").addClass("icon-spinner icon-spin orange bigger-125");
            },
            success : function ( data )  {
            	//$("#icon_b_usuario").addClass("icon-user");		                	
		         result = data ;  
		    } 		                
    	});
	return result ; 
}
			
			$(function(){	
					
				//Validación Existencia nombre usuario
				jQuery.validator.addMethod("exis_usu", function (value, element) {
					var a=value;
					var reg=$('#txt_reg_nom_usuario').val();					
					if (buscando(reg,1)==0) {						
						return true;
					};
					if(buscando(reg,1)!=0){						
						return false;
					};
				}, "Por favor, Eligite otro nombre de usuario.");
				//Validación Existencia correo electronico
				jQuery.validator.addMethod("exis_correo", function (value, element) {
					var a=value;
					var reg=$('#txt_reg_email').val();					
					if (buscando(reg,0)==0) {						
						return true;
					};
					if(buscando(reg,0)!=0){						
						return false;
					};
				}, "Por favor, Digite otro correo ya existes.");
				//Variable Existencia Continual
				var a=0;
				$('#frm-registro').validate({
					errorElement: 'span',
					errorClass: 'help-inline',
					focusInvalid: false,
					rules: {
						txt_reg_email: {
							required: true,
							email:true,
							exis_correo:true
						},
						txt_reg_pass: {
							required: true,
							minlength: 8
						},
						txt_repetir: {
							required: true,
							equalTo: "#txt_reg_pass"
						},
						txt_reg_nom_usuario: {
							required: true,
							exis_usu: true
						},						
						agree: 'required'
					},
			
					messages: {
						txt_reg_email: {
							required: "Por favor, Digite un email.",
							email: "Por favor, Digite un email válido.",
							exis_usu:'Por favor, Digite otro correo ya existes.'
						},
						txt_reg_pass: {
							required: "Por favor, Digite password.",
							minlength: "Por favor, Digite minimo 8 caracteres."
						},
						txt_repetir:{
							required:"Por favor, Digite nuevamente su password",							
							equalTo:"Por favor, Revise su password no coincide"
						},						
						txt_reg_nom_usuario:{
							required:"Por favor, Digite nombre de usuario",
							exis_usu:'Por favor, Digite otro nombre de usuario.'
						},
						agree: "Por favor,  acepte nuestra política."
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
				            url:'php/proceso_g.php',				              
				            type:  'post',
				            data: {
				            	txt_1:$('#txt_reg_nom_usuario').val(),
				            	txt_2:$('#txt_reg_email').val(),
				            	txt_3:$('#txt_reg_pass').val()	
				            },
				            beforeSend: function () {
								$('#icon-tiempo').show();
								$('#icon-derecha').hide();
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
				            success : function ( data )  {				            				                        	
				            	if(data==1){
				            		$.unblockUI();
					            	$.gritter.add({
										title: '<h1 class="icon-ok" style="color: #336699;">Usuario</h1>',
										text: 'Creado con exito le sugerimos revisar su <br>Email: '+$('#txt_reg_email').val()
																													+'<br> Nombre: '+$('#txt_reg_nom_usuario').val(),
										time: 4000
										//class_name: 'gritter-info')
									});
									$('#icon-derecha').show();
									$('#frm-registro').each (function(){
									  this.reset();
									});
					            }if(data==0){
					            	$.gritter.add({
										title: '<h1 style="color: #336699;">Mensaje</h1>',
										text: 'Creado con exito le sugerimos revisar su <br>Email: '+$('#txt_reg_email').val()
																													+'<br> Nombre:'+$('#txt_reg_nom_usuario').val(),
										time: 4000
										//class_name: 'gritter-info')
									});					            	
					            }if(data!=0&&data!=1){
					            	$.gritter.add({
										title: '<h1 style="color: red;">¡¡¡¡¡ Alerta !!!</h1>',
										text: 'problemas, contactar al desarrollador o administrador de sistema',
										time: 4000
										//class_name: 'gritter-info')
									});
					            }
					            $('#icon-tiempo').hide();		
						    } 		                
				    	});
					},					
					invalidHandler: function (form) {
						a++;
						alert('Intento '+a);
					}
				});
			});		