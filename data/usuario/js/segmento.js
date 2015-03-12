$(function(){
	// existencia de datos en la tabla
	function buscando(registro){			
		var result = "" ; 					
		$.ajax({
	            url:'php/mostrar_usuarios.php',
	            async :  false ,   
	            type:  'post',
	            data: {existencia_seg:'ok',reg:registro},            
	            success : function ( data )  {
	            	//$("#icon_b_usuario").addClass("icon-user");		                						         
			         result = data ;  
			    } 		                
	    	});
		return result ; 
	}
	//Validación Existencia correo electronico
	jQuery.validator.addMethod("existe_seg", function (value, element) {
		var a=value;
		var reg=$('#txt_1').val();					
		if (buscando(reg,0)==0) {						
			return true;
		};
		if(buscando(reg,0)!=0){						
			return false;
		};
	}, "Por favor, Digite otro segmento ya existe!!!.");
	$('#form-segmento-usuario').validate({
		errorElement: 'span',
		errorClass: 'help-inline',
		focusInvalid: false,
		rules: {			
			txt_1: {
				required: true,
				existe_seg:true
			}
			// gender: 'required',
			// agree: 'required'
		},

		messages: {
			txt_1: {
				required: "por favor, Digíte nombre del segmento.",
				//email: "Please provide a valid email."
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
				url:'php/mostrar_usuarios.php',
				type:'POST',
				data:{guardar_segmento:'ok',txt_1:$('#txt_1').val()},
				success:function(data){
					console.log(data)
					if (data==0) {
                        $.gritter.add({                     
                            title: '..Mensaje..!',                      
                            text: 'OK: <br><i class="icon-cloud purple bigger-230"></i>  Sus datos se almacenaron con exito. <br><i class="icon-spinner icon-spin green bigger-230"></i>',                      
                            //image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',                        
                            sticky: false,                      
                            time: 2000
                        });
                    };
                     if(data!=0&&data!=1){
                         $.gritter.add({                     
                            title: '..Mensaje..!',                      
                            text: 'Lo sentimos: <br><i class=" icon-cogs red bigger-230"></i>   Intente mas Tarde . <br><i class="icon-spinner icon-spin red bigger-230"></i>',                       
                            //image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',                        
                            sticky: false,                      
                            time: ''
                        });
                     };
                    $('#form-segmento-usuario').each (function(){
                        this.reset();
                    });
                    mostrar_segmentos();
				}
			});
		}		
	});


	$('#form-usuario').validate({
		errorElement: 'span',
		errorClass: 'help-inline',
		focusInvalid: false,
		rules: {			
			txt_cedula: {
				required: true
				//existe_seg:true
			},
			txt_correo: {
				required: true,
				email: true
				//existe_seg:true
			},
			txt_nombre: {
				required: true
				//existe_seg:true
			},
			txt_pass: {
				required: true
				//existe_seg:true
			},
			txt_pass1: {
				required: true,
				equalTo: "#txt_pass"
			}			
		},
		messages: {
			txt_cedula: {
				required: "Por favor, Digíte numero de cedula."
				//email: "Please provide a valid email."
			},
			txt_correo: {
				required: "Por favor, Digíte correo electronico.",
				email: "Por favor, Digíte correo valido."
			},
			txt_nombre: {
				required: "Por favor, Digíte su nombre."
				//email: "Please provide a valid email."
			},
			txt_pass: {
				required: "Por favor, Digíte password / clave."
				//email: "Please provide a valid email."
			},
			txt_pass1: {
				required: "Por favor, Repita Password."
				//email: "Please provide a valid email."
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
				url:'php/mostrar_usuarios.php',
				type:'POST',
				data:{guardar_segmento:'ok',txt_1:$('#txt_1').val()},
				success:function(data){
					console.log(data)
					if (data==0) {
                        $.gritter.add({                     
                            title: '..Mensaje..!',                      
                            text: 'OK: <br><i class="icon-cloud purple bigger-230"></i>  Sus datos se almacenaron con exito. <br><i class="icon-spinner icon-spin green bigger-230"></i>',                      
                            //image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',                        
                            sticky: false,                      
                            time: 2000
                        });
                    };
                     if(data!=0&&data!=1){
                         $.gritter.add({                     
                            title: '..Mensaje..!',                      
                            text: 'Lo sentimos: <br><i class=" icon-cogs red bigger-230"></i>   Intente mas Tarde . <br><i class="icon-spinner icon-spin red bigger-230"></i>',                       
                            //image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',                        
                            sticky: false,                      
                            time: ''
                        });
                     };
                    $('#form-segmento-usuario').each (function(){
                        this.reset();
                    });
                    mostrar_segmentos();
				}
			});
		}		
	});
});
mostrar_segmentos();
function mostrar_segmentos(){
	$.ajax({
		url:'php/mostrar_usuarios.php',
		type:'POST',
		data:{mostrar_seg:'ok'},
		success:function(data){
			//console.log(data)
			$('#con_obj_segmentos').html(data);		

			$('#tree1').ace_tree({
				dataSource: treeDataSource ,
				multiSelect:true,
				loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
				'open-icon' : 'icon-minus',
				'close-icon' : 'icon-plus',
				'selectable' : true,
				'selected-icon' : 'icon-ok',
				'unselected-icon' : 'icon-remove'
			});
			$('#tree2').ace_tree({
				dataSource: treeDataSource ,
				multiSelect:true,
				loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
				'open-icon' : 'icon-minus',
				'close-icon' : 'icon-plus',
				'selectable' : true,
				'selected-icon' : 'icon-ok',
				'unselected-icon' : 'icon-remove'
			});
			$('#tree3').ace_tree({
				dataSource: treeDataSource ,
				multiSelect:true,
				loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
				'open-icon' : 'icon-minus',
				'close-icon' : 'icon-plus',
				'selectable' : true,
				'selected-icon' : 'icon-ok',
				'unselected-icon' : 'icon-remove'
			});
			$('#tree4').ace_tree({
				dataSource: treeDataSource ,
				multiSelect:true,
				loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
				'open-icon' : 'icon-minus',
				'close-icon' : 'icon-plus',
				'selectable' : true,
				'selected-icon' : 'icon-ok',
				'unselected-icon' : 'icon-remove'
			});
			$('#tree5').ace_tree({
				dataSource: treeDataSource ,
				multiSelect:true,
				loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
				'open-icon' : 'icon-minus',
				'close-icon' : 'icon-plus',
				'selectable' : true,
				'selected-icon' : 'icon-ok',
				'unselected-icon' : 'icon-remove'
			});
			$('#tree6').ace_tree({
				dataSource: treeDataSource ,
				multiSelect:true,
				loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
				'open-icon' : 'icon-minus',
				'close-icon' : 'icon-plus',
				'selectable' : true,
				'selected-icon' : 'icon-ok',
				'unselected-icon' : 'icon-remove'
			});
			//console.log(sacarlimite());

			// incidencias en proceso de carga

			var contenedor=document.getElementById('contenedor_'+1+'')
			var nombre_categoria=$(contenedor).children().children().html();			
			var tree_hijo=document.getElementById('tree'+1+'')
				$(tree_hijo).children().next().next().children('.tree-folder-header').children().click(function(){
				console.log($(tree_hijo).parent().parent().parent().parent());
			}); 


			var contenedor=document.getElementById('contenedor_'+2+'')
			var nombre_categoria=$(contenedor).children().children().html();
			var tree_hijo=document.getElementById('tree'+2+'')
				$(tree_hijo).children().next().next().children('.tree-folder-header').children().click(function(){
				console.log($(tree_hijo).parent().parent().parent().parent());
			}); 

			


		}
	});
}
function sacarlimite(){
	var sum=0;
	for (var i = 1; i < 10; i++) {
		if (document.getElementById('contenedor_'+i+'')) {
			sum++;
			var contenedor=document.getElementById('contenedor_'+i+'')
			var nombre_categoria=$(contenedor).children().children().html();
			var tree_hijo=document.getElementById('tree'+i+'')
				$(tree_hijo).children().next().next().children('.tree-folder-header').children().click(function(){
				console.log($(tree_hijo).parent().parent().parent().parent());
			}); 
			//console.log(valores_chec);
		}		
	}
	return sum;
}
