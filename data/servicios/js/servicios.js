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
		time: 1000
	});
	g_edicion('#lbl_servicios',1,x);

	g_edicion('#lbl_descripcion',2,x);
	g_edicion('#lbl_otros',3,x);
	g_edicion('#lbl_fecha',5,x);
	g_edicion('#lbl_stado',6,x);
			
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