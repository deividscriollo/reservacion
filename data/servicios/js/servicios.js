$('#btn_servicos').click(function(){
	$.ajax({
	    url: "php/mostrar.php",
	    type: "POST",
	    //data: {registro:reg},        
	    success: function(data)
	    {
	       $('#mostrar_servicios').html(data);
	    }	        
	});
});

function guardar_id(x){
	$.gritter.add({						
		title: '..Mensaje..!',						
		text: 'Datos Seleccionados <i class="icon-spinner icon-spin green bigger-230"></i> ',						
		//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
		sticky: false,						
		time: 600,
		//class_name: 'gritter-center'
	});
	g_edicion('#lbl_servicios',1,x);
	$('#lbl_id_servicio').html(x);
	g_edicion('#lbl_descripcion',2,x);
	g_edicion('#lbl_otros',3,x);
	g_edicion('#lbl_fecha',5,x);
	g_edicion('#lbl_stado',6,x);
	//imagenes

	g_edicion_img(4, x);
	//active 
	$("#btn_servicos").parent().removeClass("active");
	$("#btn_perfil").parent().addClass("active");
	/**/
	
	mostrar_tarifa(x)
	mostrar_horario(x)
}

function g_edicion(elemento, pos, x){
	$.ajax({
	    url: "php/buscar_p.php",
	    type: "POST",
	    data: {id:x,pos:pos},        
	    success: function(data)
	    {		
	       	$(elemento).html(data);	       	
	    }   
	});
}
function g_edicion_img(pos, x){
	$.ajax({
	    url: "php/buscar_p.php",
	    type: "POST",
	    data: {id:x,pos:pos},        
	    success: function(data)
	    {	
	    	var valor=data.split(" ");
	    	
	       	$('#img_foto').html('<img id="avatar" class="editable" src="img/'+valor[2]+'"/>'); 
	       	try {//ie8 throws some harmless exception, so let's catch it
			
					//it seems that editable plugin calls appendChild, and as Image doesn't have it, it causes errors on IE at unpredicted points
					//so let's have a fake appendChild for it!
					if( /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ) Image.prototype.appendChild = function(el){}
			
					var last_gritter
					$('#avatar').editable({
						type: 'image',
						name: 'avatar',
						value: null,
						image: {
							//specify ace file input plugin's options here
							btn_choose: 'Change Avatar',
							droppable: true,
							/**
							//this will override the default before_change that only accepts image files
							before_change: function(files, dropped) {
								return true;
							},
							*/
			
							//and a few extra ones here
							name: 'avatar',//put the field name here as well, will be used inside the custom plugin
							max_size: 110000,//~100Kb
							on_error : function(code) {//on_error function will be called when the selected file has a problem
								if(last_gritter) $.gritter.remove(last_gritter);
								if(code == 1) {//file format error
									last_gritter = $.gritter.add({
										title: 'File is not an image!',
										text: 'Please choose a jpg|gif|png image!',
										class_name: 'gritter-error gritter-center'
									});
								} else if(code == 2) {//file size rror
									last_gritter = $.gritter.add({
										title: 'File too big!',
										text: 'Image size should not exceed 100Kb!',
										class_name: 'gritter-error gritter-center'
									});
								}
								else {//other error
								}
							},
							on_success : function() {
								$.gritter.removeAll();
							}
						},
					    url: function(params) {
							// ***UPDATE AVATAR HERE*** //
							//You can replace the contents of this function with examples/profile-avatar-update.js for actual upload
			
			
							var deferred = new $.Deferred
			
							//if value is empty, means no valid files were selected
							//but it may still be submitted by the plugin, because "" (empty string) is different from previous non-empty value whatever it was
							//so we return just here to prevent problems
							var value = $('#avatar').next().find('input[type=hidden]:eq(0)').val();
							if(!value || value.length == 0) {
								deferred.resolve();
								return deferred.promise();
							}
			
			
							//dummy upload
							setTimeout(function(){
								if("FileReader" in window) {
									//for browsers that have a thumbnail of selected image
									var thumb = $('#avatar').next().find('img').data('thumb');
									if(thumb) $('#avatar').get(0).src = thumb;
								}
								
								deferred.resolve({'status':'OK'});
			
								if(last_gritter) $.gritter.remove(last_gritter);
								last_gritter = $.gritter.add({
									title: 'Avatar Updated!',
									text: 'Uploading to server can be easily implemented. A working example is included with the template.',
									class_name: 'gritter-info gritter-center'
								});
								
							 } , parseInt(Math.random() * 800 + 800))
			
							return deferred.promise();
						},
						
						success: function(response, newValue) {
						}
					})
				}catch(e) {}   	
	    }   
	});
	
}