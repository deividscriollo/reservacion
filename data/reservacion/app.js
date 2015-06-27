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

    // guardando reservaciones
    $('#btn_guardar_reservacion').click(function(){ 
        var res_com=$('#lbl_total').html();
        res_com=res_com+0;
        if (res_com!=0) {
            $('#modal-reservacion').modal('hide'); 
            var matriz= new Array();
            var horas='';
            var resX=buscar_n_tarifa(i);
            var resX=resX.split(';');
            //sacar valores de tarifas y otros elementos
            for (var i = 1; i < 10; i++) {
                if ( document.getElementById( 'txt_tarifax'+i+'' )) {               
                    var a ='txt_tarifax'+i+'';
                    var b ='lbl_tarifa'+i+'';
                    var c ='lbl_valores'+i+'';
                    var d1='nom_tar';
                    var a1 =document.getElementById( 'txt_tarifax'+i+'' ).value;
                    var b1 =document.getElementById( 'lbl_tarifa'+i+'' ).innerHTML;
                    var c1 =document.getElementById( 'lbl_valores'+i+'' ).innerHTML; 
                    console.log(resX[i]);   
                    matriz[i-1] = new Array(a1,b1,c1,resX[i-1]);
                }
            };
            var hinicio, hfinal, fecha, dia;
            var acu_fh='';
            var matriz1= new Array();
            // sacar valores de la tabla horaras a reservar
            var i=0;
            $('#tabla_horas_acu tbody tr').each(function(index, element){
                hinicio = $(element).find("td").eq(1).html();
                hfinal = $(element).find("td").eq(2).html();
                fecha = $(element).find("td").eq(3).html();
                dia = $(element).find("td").eq(4).html();
                matriz1[i]=new Array(hinicio,hfinal,fecha,dia);                
                i++;
            });
            //sacara valores de total de la reservacion       
            $.ajax({
                url: "app.php",
                type: "POST",
                data:{guardar:'ok',matriz:matriz,horario:matriz1,subtotal:$('#lbl_subtotal').html(),id_servicio:$('#id_servicio').html(),txt_institucion:$('#txt_nom_inst').val()},                         
                beforeSend: function () {                             
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
                success: function(data)
                {           
                    // console.log(data) 
                    $.unblockUI();   
                    if (data==0) {
                        $.gritter.add({                     
                            title: '..Mensaje..!',                      
                            text: 'OK: <br><i class="icon-cloud purple bigger-230"></i>  Su reservacion se ha realizado con exito. por favor verifique su correo y siga las instrucciones <br><i class="icon-spinner icon-spin green bigger-230"></i>',                      
                            //image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',                        
                            sticky: false,                      
                            time: 2000
                        });
                   };
                   if(data!=0&&data!=1&&data!=2){
                            $.gritter.add({                     
                                title: '..Mensaje..!',                      
                                text: 'Lo sentimos,<br><i class=" icon-cogs red bigger-230"></i>   Intente mas Tarde . <br><i class="icon-spinner icon-spin red bigger-230"></i>',                       
                                //image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',                        
                                sticky: false,                      
                                time: ''
                            });
                            //redireccionar();
                        }; 
                }                                       
            });   
            };if (res_com==0) {              
                $('#txt_tarifax1').addClass('zoomIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                    $(this).removeClass('zoomIn animated');
                }); 
                $('#txt_tarifax2').addClass('zoomIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                    $(this).removeClass('zoomIn animated');
                });
                $('#txt_tarifax3').addClass('zoomIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                    $(this).removeClass('zoomIn animated');
                });
                $('#txt_tarifax4').addClass('zoomIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                    $(this).removeClass('zoomIn animated');
                });
                $('#txt_tarifax5').addClass('zoomIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                    $(this).removeClass('zoomIn animated');
                });
                $('#txt_tarifax6').addClass('zoomIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                    $(this).removeClass('zoomIn animated');
                });
                $('#txt_tarifax7').addClass('zoomIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                    $(this).removeClass('zoomIn animated');
                });
            }
    });
	// selector 
		$('#select_tipo_reser_museo').change(function(){
			var valor_selecion=$(this).val();
            //institución
			if (valor_selecion=="20150526092958556483663add0"
                ||valor_selecion=="2015052609301055648372aaa83"
                ||valor_selecion=="201505260930215564837d25753") {
                // console.log('test');
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
    
    // inicializacion de tabla
    $('#tabla_hsoras').scrollTableBody({
        thead_height:   '30px',
        tbody_height:   '80px',
        tfoot_height:   '20px',
        head_bgcolor:   'transparent',
        foot_bgcolor:   'transparent'
    });


    // accion de boton regresar
    $('#btn_atras_reservar').on('click',function(){        
        $('#obj_contenedor_museo_matriz').removeClass('hidden');
        $('#obj_contenedor_2_museo_matriz').addClass('hidden');       
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
// funcion recargar nuevos valores despues de Seleccione
function reconstruir(i){    
    $("#tabla_horas tbody tr").each(function (index) {
        var campo1, axus=0, campo3;
        $(this).children("td").each(function (index2) {
            switch (index2) {                           
                case 1:                 
                    $(this).children().children().removeAttr('checked');                    
                    break;                
            }        
        });       
    });

    $("#tabla_horas tbody tr").each(function (index) {        
        if (i==index) {
            $(this).children("td").each(function (index2) {
                switch (index2) {                           
                    case 1:                 
                        $(this).children().children().prop("checked", "checked");                    
                        break;                
                }        
            }); 
        }              
    });
}
// reestructurar su forma de tabla_hsoras
function buscar_n_tarifa(){
    var x=0;
    var result='';
    $("#t_obj tbody tr").each(function (index) {             
        var campo0;
        $(this).children("td").each(function (index2) {
            switch (index2) {                                 
                case 0:   
                    result=result+ $(this).text()+';';
                break;  
            }                
        });
        x++;
    });    
    return result;
}
// verificacion de existencia de impuesto "iva"
function impuesto_museo() {
    var result
    $.ajax({
        url: "app.php",
        type: "POST",
        data:{impuesto_museo:'ok'},
        dataType:'json',
        async:false,
        success:function(data){
            result= data;
        }
    });
    return result;
}
// permite verficar si el campo del checbock se a seleccionado
function busca_seleccionado_chek(){
    var amd_x=':(';
    $("#tabla_horas tbody tr").each(function (index) {             
        var campo0, campo1, campo2, campo3,campo4;
        $(this).children("td").each(function (index2) {
            switch (index2) {                                 
                case 2:
                    campo1 = $(this).text();
                    break;
                case 3:
                    campo2 = $(this).text();
                    break;
                case 4:
                    campo3 = $(this).text();
                    break;
                case 5:
                    campo4 = $(this).text();
                    break;
                case 1:
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
// estable las caracteristicas de formacion de sub tota e inpuestos
function resul_infor(lim){    
    var sum=0;
    for (var i = 1; i <=lim; i++) {
        var objeto_ele=document.getElementById('lbl_valores'+i+'').innerHTML
        var x=objeto_ele.split(': ');
        sum=sum+parseFloat(x[1]);       
    };
    var impuesto=impuesto_museo();
    var iva;
    if (impuesto[0]=='SI') {
        iva=(sum*impuesto[1])/100; 
        $('#lbl_inf_iva').html('Iva '+impuesto[1]+' %: $');   
    }else{
        iva=0;
        $('#lbl_inf_iva').html('Iva: $');   
    }    
    
    var total=iva+sum;
    document.getElementById('lbl_subtotal').innerHTML=sum.toFixed(2);
    document.getElementById('lbl_iva').innerHTML=iva.toFixed(2);
    document.getElementById('lbl_total').innerHTML=total.toFixed(2);
}


// restablece la tabla a su estado natural si no se a seleccionado un checkbox
function info_tabla(){
    $("#tabla_horas_acu tbody").html('');
    $("#tabla_horas tbody tr").each(function (index) {             
        var campo0, campo1, campo2, campo3,campo4;
        $(this).children("td").each(function (index2) {
            switch (index2) {                                 
                case 2:
                    campo1 = $(this).text();
                    break;
                case 3:
                    campo2 = $(this).text();
                    break;
                case 4:
                    campo3 = $(this).text();
                    break;
                case 5:
                    campo4 = $(this).text();
                    break;
                case 1:
                    campo0 = $(this).children().children('input').is(":checked");
                    if (campo0==true) { 
                        var a,b,c,d;
                        $(this).parent().children().each(function(e){
                            switch(e){
                                case 2: 
                                    a=$(this).text();
                                    break;
                                case 3: 
                                    b=$(this).text();
                                    break;
                                case 4: 
                                    c=$(this).text();
                                    break;
                                case 5: 
                                    d=$(this).text();
                                    break;
                            }
                        });                            
                        $('#tabla_horas_acu tbody').append('<tr><td>1</td><td>'+a+'</td><td>'+b+'</td><td>'+c+'</td><td>'+d+'</td></tr>');                      
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
                 $("#tabla_horas tbody").html('<tr>lo sentimos no disponemos algun horario en esta fecha, por favos seleccione otra fecha para poder verificarla</tr>');          
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
// inicializacion al wizard
$(document).ready(function() {
    // methodos de validacion adicionales
    jQuery.validator.addMethod("verficar_check", function (value, element) {
        alert('hola')
        // var a=value;
        // var reg=$('#txt_n_banco').val();                    
        // if (buscando(reg,0)==0) {                       
        //     return true;
        // };
        // if(buscando(reg,0)!=0){                     
          return false;
        // };
    }, "Por favor, Digite otro banco, ya existe!!!.");
    acumu_dc=busca_seleccionado_chek();
    var $validator = $("#commentForm").validate({
          rules: {
            txt_nom_inst: {
                required: true
            },
            verficar_check:{
                verficar_check:true
            },
            select_tipo_reser_museo: {                
                required: true
            },
            txt_fecha_origen:{
                required:true
            }
            },
            messages: {
                txt_nom_inst: {               
                    required: 'Por favor, ingrese nombre de la institución'
                },
                select_tipo_reser_museo: {                
                    required: 'Seleccione tipo de reservación'
                },
                txt_fecha_origen: {               
                    required: 'Por favor, seleccione la fecha a reservar'
                },

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
            }
        });
 
        $('#rootwizard').bootstrapWizard({
            'tabClass': 'nav nav-pills',
            'onPrevious': function(tab, navigation, index) {
                if (index!=2) {
                    $('#btn_sigiente').show();
                }
            },
            'onNext': function(tab, navigation, index) {
                var $valid = $("#commentForm").valid();
                if(!$valid) {
                    $validator.focusInvalid();
                    return false;
                }
                var acumu_dc=busca_seleccionado_chek();                        
                
                if (index==2) { 
                    $('#btn_sigiente').hide();
                    if (acumu_dc==':(') {
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
                        return false;                        
                    }
                    if (acumu_dc==':)') {
                        // limpiar los objetos
                        $('#lbl_subtotal').html('0.00');
                        $('#lbl_iva').html('0.00');
                        $('#lbl_total').html('0.00');

                        // cargar modal.. carga de tabla a a tabla b objetos
                        info_tabla();
                        // limpiar contenedor
                        $('#form-v_reserva').html('');
                        // llamado y formacion de  estructuras
                        $.ajax({
                            url: "app.php",
                            type: "POST",
                            data:{obj_tarifa:'ok',tipo:$('#select_tipo_reser_museo').val()},                         
                            success: function(data)
                            {   
                                var valores=data.split(',');
                                var limite=valores.length;
                                var obje_acu='';
                                var j=0;
                                var k=1;

                                for (var i = 0; i<((limite-1)/2); i++) {
                                    if (i==0) {                        
                                        var o=' <table class="table" center id="t_obj">'
                                                    +'<thead>'
                                                        +'<tr>'
                                                            +'<th>N. Tarifa</th>'
                                                            +'<th>Precio x persona</th>'
                                                            +'<th>Cantidad</th>'
                                                            +'<th>Total</th>'
                                                        +'</tr>'
                                                    +'</thead>'
                                               +'<tbody>';
                                        $('#form-v_reserva').append(o);
                                    };
                                    obje_acu=''
                                                    +'<tr>'
                                                        +'<td>'+valores[j]+'</td>'
                                                        +'<td>'+'<label class="text-info" id="lbl_tarifa'+(i+1)+'">'+valores[k]+'</label>'+'</td>'
                                                        +'<td>'
                                                            +'<div class="controls dc_opt">'
                                                            +'<input type="text" class="dc_spiner" id="txt_tarifax'+(i+1)+'">'
                                                            +'</div>'
                                                        +'</td>'
                                                        +'<td>'+'<label class="text-success" id="lbl_valores'+(i+1)+'">$: 00.00</label>'+'</td>'
                                                    +'<tr>'; 
                                    j=j+2;
                                    k=k+2;
                                    $('#form-v_reserva #t_obj tbody').append(obje_acu);
                                    
                                    $('#txt_tarifax'+(i+1)+'').TouchSpin({
                                        verticalbuttons: true,
                                        min: 0,
                                        max: 20,
                                        stepinterval: 1,
                                        maxboostedstep: 10000000,
                                        prefix: '$',
                                        initval:'0'
                                    }).on('touchspin.on.startspin', function () {                                        
                                        var cantidad=(this.id).split('');
                                        var precio=$(this).val();
                                        var objeto_tex=document.getElementById('lbl_tarifa'+cantidad[11]+'').innerHTML;    
                                        var total=objeto_tex*precio;                                        
                                        total=total.toFixed(2);
                                        // console.log(total);
                                        // console.log('#lbl_valores'+cantidad[11]+'');
                                        document.getElementById('lbl_valores'+cantidad[11]+'').innerHTML='$: '+total;
                                        // var sutotal=$('#lbl_subtotal').html();   
                                        resul_infor(i)
                                    });

                                    if (i==(limite-1)) {
                                        $('#form-v_reserva').append('</tbody></table>');    
                                    };                    
                                };    
                                            
                            }                                       
                        });
                    }
                }
            },
            onTabClick:function(tab, navigation, index) {                
                return false;
            }
        });
});