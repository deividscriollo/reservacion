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
            //institución
			if (valor_selecion=="20150526092958556483663add0"
                ||valor_selecion=="2015052609301055648372aaa83"
                ||valor_selecion=="201505260930215564837d25753") {
                console.log('test');
                $('#obj_institucion').removeClass('hidden').addClass('zoomIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                  $(this).removeClass('zoomIn animated');
                });
            }else{
                $('#obj_institucion').addClass('zoomOut animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                  $(this).removeClass('zoomOut animated');
                  $(this).addClass('hidden');
                });              
            }        


		});
	// fin selector
    $('#form_1').validate({
        rules: {
            txt_nom_inst: {
                required: true
            },
            select_tipo_reser_museo: {                
                required: true
            }
        },
        messages: {
            txt_nom_inst: {               
                required: 'Por favor, ingrese nombre de la institución'
            },
            select_tipo_reser_museo: {                
                required: 'Seleccione tipo de reservación'
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            $('#obj_contenedor_museo_matriz').removeClass('col-md-offset-5').addClass('slideInRight animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                $(this).removeClass('slideInRight animated');
                $('#obj_contenedor_2_museo_matriz').removeClass('hidden').addClass('zoomIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                });
            });

        }
    });
    // dar valores iniciales de datepicker
    var fec=new Date();
    var acufecha=fec.getDate() + "/" + (fec.getMonth() +1) + "/" + fec.getFullYear();
    var fec=new Date();
    $('#datetimepicker1').datetimepicker({
        viewMode: 'days',
        format: 'DD/MM/YYYY',
        minDate: new Date()
    }).on("dp.change", function(ev) {
        var fe=$('#txt_fecha_origen').val();
        buscar_horas(dia_semana(fe),fe);
    }); 
    
    
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
// busca la hora que esta disponible en esa fecha
function buscar_horas(dia,fe){
    var res=':(';
    $.ajax({
        url: "app.php",
        type: "POST",        
        data:{museo_buscar_horas:'ok',dia:dia,f:fe},                         
        success: function(data)
        {   //console.log(data)   
            $.gritter.removeAll();
            $("#tabla_horas tbody").html('');       
            if (data!=0) {
                $("#tabla_horas tbody").html(data);
            }else{              
                $.gritter.add({
                    title: 'Estimado Cliente',
                    text: 'Lo sentimos, no disponemos horarios para realizar reservaciones en esten día',
                    class_name: 'gritter-info gritter-center',
                    time:20000
                });
            }
            
        }                               
    });
    //return res;
}
//Recibe fecha en formato DD/MM/YYYY  
function dia_semana(fecha){   
    fecha=fecha.split('/');  
    if(fecha.length!=3){
            return null;  
    }  
    //Vector para calcular día de la semana de un año regular.  
    var regular =[0,3,3,6,1,4,6,2,5,0,3,5];   
    //Vector para calcular día de la semana de un año bisiesto.  
    var bisiesto=[0,3,4,0,2,5,0,3,6,1,4,6];   
    //Vector para hacer la traducción de resultado en día de la semana.  
    var semana=['DOMINGO', 'LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO'];  
    //Día especificado en la fecha recibida por parametro.  
    var dia=fecha[0];  
    //Módulo acumulado del mes especificado en la fecha recibida por parametro.  
    var mes=fecha[1]-1;  
    //Año especificado por la fecha recibida por parametros.  
    var anno=fecha[2];  
    //Comparación para saber si el año recibido es bisiesto.  
    if((anno % 4 == 0) && !(anno % 100 == 0 && anno % 400 != 0))  
        mes=bisiesto[mes];  
    else  
        mes=regular[mes];  
    //Se retorna el resultado del calculo del día de la semana.  
    return semana[Math.ceil(Math.ceil(Math.ceil((anno-1)%7)+Math.ceil((Math.floor((anno-1)/4)-Math.floor((3*(Math.floor((anno-1)/100)+1))/4))%7)+mes+dia%7)%7)];  
} 
