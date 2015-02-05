function mostrar_categoria_select(){
		$.ajax({
			url:'php/tarifa.php',
			type:'POST',
			data:{mostrar_categoria_select:'ok'},
			success:function(data){				
				$('#sel_categoria_mostrar').html(data);
				$(".chzn-select").chosen({
					no_results_text: "Lo sentimos no encontrado",
					width: "100%"
				});
				
			}
		});
	}
$(function (){
	mostrar_tarifa();
	mostrar_categoria_select();

	
	function proceso_verificacion_dias_existencia(){
		var id_servicio=$('#lbl_id_servicio').html();
		$.ajax({
			url:'php/tarifa.php',
			type:'POST',
			data:{mostrar_d_disponibles:'ok',id:id_servicio},
			success:function(data){
				$('#obj_select_dias').html(data);
				$("#txt_0_horario").chosen({
				    disable_search_threshold: 10,
				    no_results_text: "Lo sentimos no encontrado",
				    width: "85%"
				});
			}
		});
	}
	$('#btn_modal_hora').click(function(){
		proceso_verificacion_dias_existencia();
	});
	// Creando Objetos para acceso plus
	$('#form-horario').validate({
		errorElement: 'span',
		errorClass: 'help-inline',
		focusInvalid: false,
		rules: {
			txt_0_horario: {
				required: true
			},
			txt_1_horario: {
				required: true
			},
			txt_2_horario: {
				required: true
			},
			txt_3_horario: {
				required: true			
			}
		},

		messages: {
			txt_0_horario: {
				required: 'Por favor, Digíte o seleccione dia de la semana'
			},
			txt_1_horario: {				
				required: ' '
			},
			txt_2_horario: {
				required: ' '			
			},
			txt_3_horario: {
				required: ' '							
			}
			
		},

		invalidHandler: function (event, validator) { //display error alert on form submit   
			console.log($('.alert-error'))
			//$('.alert-error').show();
		},

		highlight: function (e) {
			$(e).closest('.control-group').removeClass('success').addClass('error');
		},
		success: function (e) {
			$(e).closest('.control-group').removeClass('error').addClass('success');
			$(e).remove();
		},
		errorPlacement: function (error, element) {		
			
		},

		submitHandler: function (form) {
			var r=$('#txt_0_horario').val();
			if(r==null){
				//var q=$('#txt_0_horario').children('select div ul li input').css({'border':'red'});
				var q = $('#txt_0_horario').parent().children().next();
				var q = $(q).children().css({'border':'solid 1px #D16E6C'});
				var s=$('#txt_0_horario').parent().parent().parent().prop('class','control-group error');
			}
			if (r!=null) {
				$('#txt_0_horario').parent().parent().parent().prop('class','control-group success');
				var q = $('#txt_0_horario').parent().children().next();
				var q = $(q).children().css({'border':'solid 1px #8BAD4C'});
				var id_servicio=$('#lbl_id_servicio').html();
				var valor1=""+$('#txt_0_horario').val();
				$.ajax({
			        url: "php/tarifa.php",
			        type: "POST",
			        data:{g_horario:'ok', id_servicio:id_servicio, dias:valor1, lapso:$('#txt_1_horario').val(),horai:$('#txt_2_horario').val(),horaf:$('#txt_3_horario').val()},			               
			        success: function(data)
			        {	
			        	if (data==0) {
			        		$.gritter.add({						
								title: '..Mensaje..!',						
								text: 'OK: <br><i class="icon-cloud purple bigger-230"></i>  Sus datos fueron almacenados correctamente. <br>',						
								//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
								sticky: false,						
								time: 2000
							});	
							mostrar_horario(id_servicio)						
							$('#obj_contenedor').html('');
							$('#form-horario').each (function(){
								this.reset();
							});
							$('#txt_0_horario').val('').trigger('liszt:updated');
							proceso_verificacion_dias_existencia();
			        	}
						if (data!=0) {
							$.gritter.add({						
								title: '..Mensaje..!',						
								text: 'TENEMOS INCONVENIENTES INTENTE MAS TARDE<br><i class="icon-cloud purple bigger-230"></i> comuniquese con el administrador <br><i class="icon-spinner icon-spin purple bigger-230"></i> : [',						
								//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
								sticky: false,						
								time: ''
							});	
						}
					}			                	        
			    });			
			}
		},
		invalidHandler: function (form) {
		}
	});

});

