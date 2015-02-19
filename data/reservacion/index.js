$(function(){   
    
    //
    $('#btn_guardar_reservacion').click(function(){        
        var res_com=$('#lbl_total').html();
        res_com=res_com+0;
        if (res_com!=0) {
            $('#modal-reservacion').modal('hide'); 
        var matriz= new Array();
        var horas='';
        //sacar valores de tarifas y otros elementos
        for (var i = 1; i < 10; i++) {
            if ( document.getElementById( 'txt_tarifa'+i+'' )) {               
                var a ='txt_tarifa'+i+'';
                var b ='lbl_tarifa'+i+'';
                var c ='lbl_valores'+i+'';
                var a1 =document.getElementById( 'txt_tarifa'+i+'' ).value;
                var b1 =document.getElementById( 'lbl_tarifa'+i+'' ).innerHTML;
                var c1 =document.getElementById( 'lbl_valores'+i+'' ).innerHTML;
                matriz[i-1] = new Array(a+':'+a1,b+':'+b1,c+':'+c1);
            }
        };
        var hinicio, hfinal, fecha, dia;
        var acu_fh='';
        var matriz1= new Array();
        // sacar valores de la tabla horaras a reservar
        var i=0;
        $('#tabla_horas_acu tbody tr').each(function(index, element){
            hinicio = $(element).find("td").eq(0).html();
            hfinal = $(element).find("td").eq(1).html();
            fecha = $(element).find("td").eq(2).html();
            dia = $(element).find("td").eq(3).html();
            matriz1[i]=new Array(hinicio,hfinal,fecha,dia);
            i++;
        });
        //sacara valores de total de la reservacion       
        $.ajax({
            url: "reservacion.php",
            type: "POST",
            data:{guardar:'ok',matriz:matriz,horario:matriz1,subtotal:$('#lbl_subtotal').html(),id_servicio:$('#id_servicio').html()},                         
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
                            text: 'Lo sentimos: '+$('#txt_usuario').val()+'<br><i class=" icon-cogs red bigger-230"></i>   Intente mas Tarde . <br><i class="icon-spinner icon-spin red bigger-230"></i>',                       
                            //image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',                        
                            sticky: false,                      
                            time: ''
                        });
                        //redireccionar();
                    }; 
            }                                       
        });   
        };if (res_com==0) {
                $('#txt_tarifa1').addClass('animated wobble');
                $('#txt_tarifa2').addClass('animated wobble');
                $('#txt_tarifa3').addClass('animated wobble');
                $('#txt_tarifa4').addClass('animated wobble');
                setTimeout ("renovar1()", 1000);
        }
    });
    
    function redireccionar() {
        setTimeout("location.href='../reservacion/'", 2000);
    }
    $('#btn_reservar').click(function(){

        // console.log(':)')
        var acumu_dc=busca_seleccionado_chek();
        
        if(acumu_dc==':)'){
            $('#modal-reservacion').modal('show');
            
            // limpiar los objetos
            $('#lbl_subtotal').html('0.00');
            $('#lbl_iva').html('0.00');
            $('#lbl_total').html('0.00');

            // cargar modal.. carga de tabla a a tabla b objetos
            info_tabla();
            //inicializando variable de ojetos a crear : contenedor
            $('#form-v_reserva').html('');
            $.ajax({
                url: "reservacion.php",
                type: "POST",
                data:{obj_tarifa:'ok', id:$('#id_servicio').html()},                         
                success: function(data)
                {   
                    // console.log(data)
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

    
    
	$('#txt_b_servicio').keyup(function(){
		var reg=$('#txt_b_servicio').val();
		// console.log(reg);
		bus_servicio(reg);
	});     
});
function renovar() {
    $('#tabla_horas tbody tr td label input').removeClass('animated bounceOut');
    $('#tabla_horas tbody tr td label input').removeAttr('checked');    
} 
function renovar1() {
    $('#txt_tarifa1').removeClass('animated wobble');
    $('#txt_tarifa2').removeClass('animated wobble');
} 


function resul_infor(lim){    
    //var subtotal=document.getElementById('lbl_subtotal').innerHTML;
    //f_total=total+parseFloat(subtotal);
    //console.log(f_total.toFixed(2));
    //document.getElementById('lbl_subtotal').innerHTML=f_total.toFixed(2)
    var sum=0;
    for (var i = 1; i <=lim; i++) {
        var objeto_ele=document.getElementById('lbl_valores'+i+'').innerHTML
        var x=objeto_ele.split(': ');
        sum=sum+parseFloat(x[1]);       
    };
    var iva=(sum*12)/100;
    var total=iva+sum;
    document.getElementById('lbl_subtotal').innerHTML=sum.toFixed(2);
    document.getElementById('lbl_iva').innerHTML=iva.toFixed(2);
    document.getElementById('lbl_total').innerHTML=total.toFixed(2);
}
function bus_servicio(reg){
	$.ajax({
        url: "reservacion.php",
        type: "POST",
        data:{buscar_servicio:'ok', registro:reg},			               
        success: function(data)
        {			
			 // console.log(data)   
			$('#obj_contenedor_servicios').html(data);
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
    // mostrar tabla de tarifas existentes
    $.ajax({
        url: "reservacion.php",
        type: "POST",
        data:{buscar_inf_serv_h2:'ok', id:id},			               
        success: function(data)
        {			
			// console.log(data)   
			$('#tabla_h_tarifa tbody').html(data);
        }			                	        
    });
    // mostrar galeria
    $.ajax({
        url: "reservacion.php",
        type: "POST",
        data:{mostrar_galeria:'ok', id:id},                         
        success: function(data)
        {           
            // console.log(data)   
            $('#obj_cont_galeria').html(data);
        }                                       
    });
    // mostrar descripcion
    $.ajax({
        url: "reservacion.php",
        type: "POST",
        data:{mostrar_descripcion:'ok', id:id},                         
        success: function(data)
        {           
            // console.log(data)   
            $('#obj_cont_descripcion').html(data);
        }                                       
    });
    // mostrar otros
    $.ajax({
        url: "reservacion.php",
        type: "POST",
        data:{mostrar_otros:'ok', id:id},                         
        success: function(data)
        {           
            // console.log(data)   
            $('#obj_cont_otros').html(data);
        }                                       
    });

    
    // imprimiendo id
    $('#id_servicio').html(id);
    $('#txt_fecha_origen').popover('show');
    $('#modal-servicio').modal('hide');
    $('html,body').animate({scrollTop:'1000px'}, 500);return false;
};
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
            // console.log(campo0+' '+campo1+' '+campo2)
        });
    return amd_x;
    }