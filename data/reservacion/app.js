$(function(){
	// inicio llamada de funciones
		cargar_menu()	//cargar informacion de sservicios al menu
		cargar_categoria()	// carga las categorias de los servicios a los selectores
	// fin llama de funciones

    // dar valores iniciales data spiners
         

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
    // fin dar valores de data picker

    // evento boton sigient al seleccionar una hora
    $('#btn_reservar').click(function(){
        var acumu_dc=busca_seleccionado_chek();        
        if(acumu_dc==':)'){     
            // animacion objeto al aparecer
            $('#obj_contenedor_3_museo_matriz').removeClass('hidden').addClass('zoomIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                $(this).removeClass('zoomIn animated');
            });

            // limpiar los objetos
            $('#lbl_subtotal').html('0.00');
            $('#lbl_iva').html('0.00');
            $('#lbl_total').html('0.00');

            // cargar modal.. carga de tabla a a tabla b objetos
            info_tabla();
            //inicializando variable de ojetos a crear : contenedor
            $('#form-v_reserva').html('');
            $.ajax({
                url: "app.php",
                type: "POST",
                data:{obj_tarifa:'ok',tipo:$('#select_tipo_reser_museo').val()},                         
                success: function(data)
                {   
                    console.log(data)
                    var valores=data.split(',');
                    var limite=valores.length;
                    var obje_acu='';
                    var j=0;
                    var k=1;

                    for (var i = 0; i<((limite-1)/2); i++) {
                        if (i==0) {                        
                            var o='<table class="table" center id="t_obj"><thead><tr><th>Servicio</th><th>Precio Persona</th><th>Costos / Precio</th></tr></thead><tbody>';
                            $('#form-v_reserva').append(o);
                        };
                        obje_acu=''
                                        +'<tr><td><div class="control-group">'
                                            +'<label class="control-label" for="form-field-1">'+valores[j]+'</label>'
                                            +'<div class="controls">'
                                            +'<input type="text" id="txt_tarifax'+(i+1)+'">'
                                            +'<input type="text" class="spinner input-mini" display id="txt_tarifa'+(i+1)+'" />'
                                            +'</div>'
                                      +'</div></td>'
                                      +'<td>'
                                      +'<div class="control-group">'
                                        +'<label class="text-info" for="form-field-1" id="lbl_tarifa'+(i+1)+'">'+valores[j]+': '+valores[k]+'</label>'                                    
                                      +'</div>'
                                      +'</td><td><div class="control-group"><label class=" text-success" id="lbl_valores'+(i+1)+'">$: 00.00</label></div></td></tr>'; 
                        j=j+2;
                        k=k+2;
                        $('#form-v_reserva #t_obj tbody').append(obje_acu);
                        // dar valores de entrada a spiners
                        $('#txt_tarifa'+(i+1)+'').ace_spinner({
                            value:0,
                            min:0,
                            max:200,
                            step:1,
                            btn_up_class:'btn-info',
                            btn_down_class:'btn-info'        
                        }).on('change', function(){
                            var cantidad=(this.id).split('');
                            var precio=this.value;
                            var objeto_tex=document.getElementById('lbl_tarifa'+cantidad[10]+'').innerHTML;                        
                            var acumulador=objeto_tex.split(': ');
                            var total=acumulador[1]*precio;
                            document.getElementById('lbl_valores'+cantidad[10]+'').innerHTML='$: '+total.toFixed(2);
                            // var sutotal=$('#lbl_subtotal').html();   
                            resul_infor(i)
                            
                        });
                        $('#txt_tarifax'+(i+1)+'').TouchSpin({
                            verticalbuttons: true,
                            min: 0,
                            max: 20,
                            stepinterval: 1,
                            maxboostedstep: 10000000,
                            prefix: '$',
                            initval:'0'
                        });

                        if (i==(limite-1)) {
                            $('#form-v_reserva').append('</tbody></table>');    
                        };                    
                    };    
                                
                }                                       
            });
        };if (acumu_dc==':(') {
            $.gritter.add({                     
                title: '..Mensaje..!',                      
                text: '<br><i class="icon-cloud purple bigger-230"></i>  Por favor, Seleccione una opcion para continuar con la reservación <br><i class="icon-spinner icon-spin green bigger-230"></i>',                      
                //image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',                        
                sticky: false,                      
                time: 3000
            });

            $('#tabla_horas tbody tr td label input').addClass('animated bounceOut');
            $('#tabla_horas tbody tr td label input').prop("checked", "checked");  
            setTimeout ("renovar()", 1000);
        }
    });
    

    
});
// funcion recargar nuevos valores despues de Seleccione
function reconstruir(i){    
    $("#tabla_horas tbody tr").each(function (index) {
        var campo1, axus=0, campo3;
        $(this).children("td").each(function (index2) {
            switch (index2) {                           
                case 0:                 
                    $(this).children().children().removeAttr('checked');                    
                    break;                
            }        
        });       
    });

    $("#tabla_horas tbody tr").each(function (index) {        
        if (i==index) {
            $(this).children("td").each(function (index2) {
                switch (index2) {                           
                    case 0:                 
                        $(this).children().children().prop("checked", "checked");                    
                        break;                
                }        
            }); 
        }              
    });
}
// permite verficar si el campo del checbock se a seleccionado
function busca_seleccionado_chek(){
    var amd_x=':(';
    $("#tabla_horas tbody tr").each(function (index) {             
        var campo0, campo1, campo2, campo3,campo4;
        $(this).children("td").each(function (index2) {
            switch (index2) {                                 
                case 1:
                    campo1 = $(this).text();
                    break;
                case 2:
                    campo2 = $(this).text();
                    break;
                case 3:
                    campo3 = $(this).text();
                    break;
                case 4:
                    campo4 = $(this).text();
                    break;
                case 0:
                    campo0 = $(this).children().children('input').is(":checked");
                    if (campo0==true) { 
                        amd_x=':)';
                    };
                    break;   
            }                
        });
    });
    return amd_x;
}
// restablece la tabla a su estado natural si no se a seleccionado un checkbox
function info_tabla(){
    $("#tabla_horas_acu tbody").html('');
    $("#tabla_horas tbody tr").each(function (index) {             
        var campo0, campo1, campo2, campo3,campo4;
        $(this).children("td").each(function (index2) {
            switch (index2) {                                 
                case 1:
                    campo1 = $(this).text();
                    break;
                case 2:
                    campo2 = $(this).text();
                    break;
                case 3:
                    campo3 = $(this).text();
                    break;
                case 4:
                    campo4 = $(this).text();
                    break;
                case 0:
                    campo0 = $(this).children().children('input').is(":checked");
                    if (campo0==true) { 
                        var a,b,c,d;
                        $(this).parent().children().each(function(e){
                            switch(e){
                                case 1: 
                                    a=$(this).text();
                                    break;
                                case 2: 
                                    b=$(this).text();
                                    break;
                                case 3: 
                                    c=$(this).text();
                                    break;
                                case 4: 
                                    d=$(this).text();
                                    break;
                            }
                        });                            
                        $('#tabla_horas_acu tbody').append('<tr><td>'+a+'</td><td>'+b+'</td><td>'+c+'</td><td>'+d+'</td></tr>');                      
                    };
                    break;   
            }                
        });
        // console.log(campo0+' '+campo1+' '+campo2)
    });
}
// renueva valores para mostrar en la tabla
function renovar() {
    $('#tabla_horas tbody tr td label input').removeClass('animated bounceOut');
    $('#tabla_horas tbody tr td label input').removeAttr('checked');    
} 
function renovar1() {
    $('#txt_tarifa1').removeClass('animated wobble');
    $('#txt_tarifa2').removeClass('animated wobble');
}
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
