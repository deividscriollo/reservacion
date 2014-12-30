$(function(){
	$('#txt_b_servicio').keyup(function(){
		var reg=$('#txt_b_servicio').val();
		// console.log(reg);
		bus_servicio(reg);
	});
});
function bus_servicio(reg){
	$.ajax({
        url: "reservacion.php",
        type: "POST",
        data:{buscar_servicio:'ok', registro:reg},			               
        success: function(data)
        {			
			// console.log(data)   
			$('#tabla_servicios tbody').html(data);
        }			                	        
    });
};
function btn_select_servicio(id){	
	//  buscar_inf_serv_h
	$.ajax({
        url: "reservacion.php",
        type: "POST",
        data:{buscar_inf_serv_h:'ok', id:id},			               
        success: function(data)
        {			
			// console.log(data)   
			$('#tabla_h_ser tbody').html(data);
        }			                	        
    });
    // 
    $.ajax({
        url: "reservacion.php",
        type: "POST",
        data:{buscar_inf_serv_h2:'ok', id:id},			               
        success: function(data)
        {			
			console.log(data)   
			$('#tabla_h_tarifa tbody').html(data);
        }			                	        
    });
};
