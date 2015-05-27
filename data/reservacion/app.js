$(function(){
	// inicio llamada de funciones
		cargar_menu()	//cargar informacion de sservicios al menu
		cargar_categoria()	// carga las categorias de los servicios a los selectores
	// fin llama de funciones


	// botones 
		$('#btn_modal_info').click(function(){
			$('#modal-museo').modal('show');
		});		
	// fin botones

	// selector 
		$('#select_tipo_reser_museo').change(function(){
			var valor_selecion=$(this).val();
			alert(valor_selecion)

		});
	// fin selector
	
});
// cargar obj_img_servicios
function cargar_menu(){
    $.ajax({
        url: "app.php",
        type: "POST",
        data:{obj_img_servicios:'ok'},
        dataType:'json',
        success:function(data){
        	// console.log(data);
        	var alertas = 	['alert-success','alert-info','alert-warning','alert-danger'];
        	var alertas = 	['alert-success','alert-info','alert-warning','alert-danger'];

        	// centro de convencione
        	$('#obj_arrieros_img').attr('src','../servicios/img/'+data[3]);
    		$('#obj_arrieros_nom').html(data[1]);
    			// proceso menu nombre del servicio
    			// $('#obj_menu_arrieros').html(data[1]);    		

        	// museo
    		$('#obj_museo_img').attr('src','../servicios/img/'+data[14]);
    		$('#obj_museo_nom').html(data[12]);
    			// proceso menu nombre del servicio
    			// $('#obj_menu_museo').html(data[12]);
    			$('#obj_title_museo').html(data[12]);   
    			$('#obj_info_museo').attr('src','../servicios/img/'+data[14]);
    			$('#obj_info_museo_nom').html(data[12]);
    			var acu_museo_descripcion=data[13].split(';');
    			for (var i = 0; i < acu_museo_descripcion.length; i++) {
    				var aleatorio=Math.floor((Math.random() * 3) + 0);    				
    				$('#obj_info_museo_alert').append('<div class="alert '+alertas[aleatorio]+'" role="alert">'+acu_museo_descripcion[i]+'</div>');
	        	}

    		// posada
    		$('#obj_posada_img').attr('src','../servicios/img/'+data[25]);
    		$('#obj_posada_nom').html(data[23]);
    			// proceso menu nombre del servicio
    			// $('#obj_menu_posada').html(data[23]);

    		// club
    		$('#obj_club_img').attr('src','../servicios/img/'+data[36]);
    		$('#obj_club_nom').html(data[34]);
    			// proceso menu nombre del servicio
    			// $('#obj_menu_club').html(data[34]);
        }
    });
}  
// cargar select categoria museos
function cargar_categoria(){
	 $.ajax({
        url: "app.php",
        type: "POST",
        data:{cargar_categoria_servicios:'ok'},
        // dataType:'json',
        success:function(data){
        	$('#select_tipo_reser_museo').html(data);	
        }
       });	
}
