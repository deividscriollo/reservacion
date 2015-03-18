			// llamar funcion dcar4gar datos select
			// Buscando registros seccion nombre usuario
			function buscando(registro){			
				var result = "" ; 					
				$.ajax({
		            url:'php/rev_usu_exi.php',
		            async :  false ,   
		            type:  'post',
		            data: {existencia_correo:':)',reg:registro},			            
		            success : function ( data )  {
				         result = data ;  
				    } 		                
		    	});
				return result ; 
			}
			// verificacion robustes de contraseña
			function pass_seguro(reg){			
				var result = "" ; 					
				$.ajax({
					url:'../utilidades/cedula.php',
		            async :  false ,   
		            type:  'post',
		            data: {registro:reg, pass:reg},
		            success : function ( data )  {	
		            	result=data; 
				    } 
				});	
				return result ; 
			}
			// Validacion de sedula
			function cedula(reg){			
				var result = "" ; 					
				$.ajax({
						url:'../utilidades/cedula.php',
			            async :  false ,   
			            type:  'post',
			            data: {registro:reg, cedula:reg},
			            success : function ( data )  {	
			            	result=data; 
					    } 
					});	
				return result ; 
			}
			// Existencia de sedula
			function existencia_cedula(reg){			
				var result = "" ; 					
				$.ajax({
		            url:'php/rev_usu_exi.php',						
		            async:  false ,   
		            type:  'post',
		            data: {existencia_cedula:':)',reg:reg},
		            success : function ( data )  {	
		            	result=data; 
				    } 
				});	
				return result ; 
			}
			$(function(){				
				//Validación existencia cedula valida
				jQuery.validator.addMethod("existencia_ced", function (value, element) {
					
					var reg=$('#txt_reg_ced').val();
					if (existencia_cedula(reg)==1) {						
						return false;
					};
					if (existencia_cedula(reg)!=1) {						
						return true;
					};
					//return false;		
				}, "El numero de cedula Ya EXISTE !!!. :(");
				//Validación cedula valida
				jQuery.validator.addMethod("ced", function (value, element) {
					
					var reg=$('#txt_reg_ced').val();
					if (cedula(reg)==1) {						
						return false;
					};
					if (cedula(reg)!=1) {						
						return true;
					};
					//return false;		
				}, "Cedula Incorrecta!!!. :(");
				//Validación pass robusto
				jQuery.validator.addMethod("pass_r", function (value, element) {
					
					var reg=$('#txt_reg_pass').val();
					if (pass_seguro(reg)==0) {						
						return false;
					};
					if (pass_seguro(reg)!=0) {						
						return true;
					};
					//return false;		
				}, "Password no seguro!!!. :(");

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
				}, "Por favor, Digite otro correo ya existe!!!.");
				//Variable Existencia Continual
				var a=0;
				$('#frm-registro').validate({
					errorElement: 'span',
					errorClass: 'help-inline',
					focusInvalid: false,
					rules: {
						txt_reg_ced:{
							required:true,
							ced:true,
							minlength: 10,
							maxlength:10,
							existencia_ced:true
						},
						txt_reg_email: {
							required: true,
							email:true,
							exis_correo:true
						},
						txt_reg_pass: {
							required: true,
							minlength: 8,
							maxlength: 16,
							pass_r:true
						},
						txt_repetir: {
							required: true,
							equalTo: "#txt_reg_pass"
						},
						txt_reg_nom_usuario: {
							required: true							
						},
						agree:{	required:true	}						
					},			
					messages: {
						txt_reg_ced: {
							required: "Por favor, Digite cedula.",
							minlength:'Por favor, Digite minimo 10 caracteres.',
							maxlength: 'Por favor, Digite maximo 10 caracteres',
							ced: "Por favor, Digite cedula valida."							
						},
						txt_reg_email: {
							required: "Por favor, Digite un email.",
							email: "Por favor, Digite un email válido.",
							exis_usu:'Por favor, Digite otro correo ya existes.'
						},
						txt_reg_pass: {
							required: "Por favor, Digite password.",
							minlength: "Por favor, Digite minimo 8 caracteres.",
							maxlength: "Por favor, Digite maximo de 16 caracteres.",
							pass_r: 'Password no seguro!!!. :('
						},
						txt_repetir:{
							required:"Por favor, Digite nuevamente su password",							
							equalTo:"Por favor, Revise su password no coincide"
						},						
						txt_reg_nom_usuario:{
							required:"Por favor, Digite nombre de usuario",
							
						},
						agree:'Términos y Condiciones para Registro'						
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
				            url:'php/proceso_g.php',				              
				            type:  'post',
				            data: {
				            	txt_0:$('#txt_reg_ced').val(),
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
				            	//alert(data)	
				            	console.log(data)
				            	$.unblockUI();		            		            	;
				            	if(data==1){
				            		$.unblockUI();
					            	$.gritter.add({
										title: '<h1 class="icon-ok" style="color: #336699;">Usuario</h1>',
										text: 'Creado con exito le sugerimos revisar su <br>Email: '+$('#txt_reg_email').val()
																													+'<br> Nombre: '+$('#txt_reg_nom_usuario').val(),
										time: 4000
										//class_name: 'gritter-info')
									});									
									$('#frm-registro').each (function(){
									  this.reset();
									});
					            }if(data==0){
					            	$.unblockUI();
					            	$.gritter.add({
										title: '<h1 style="color: #336699;">Mensaje</h1>',
										text: 'MMM.. tenemos Algunos Inconvenientes LO SENTIMOS te sugerimos intentar mas tarde...',
										time: 4000
										//class_name: 'gritter-info')
									});					            	
					            }if(data!=0&&data!=1){
					            	$.unblockUI();
					            	$.gritter.add({						
										title: '..Mensaje..!',						
										text: 'Lo sentimos: '+$('#txt_usuario').val()+'<br><i class=" icon-cogs red bigger-230"></i>   Informe al Administrador . <br><i class="icon-spinner icon-spin red bigger-230"></i> : [',						
										//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
										sticky: false,						
										time: ''
									});
					            }
					            $('#icon-tiempo').hide();		
						    } 		                
				    	});
					},					
					invalidHandler: function (form) {
						
					}
				});
			});		