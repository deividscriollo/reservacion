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
	alert('hola mundo'+x)
}