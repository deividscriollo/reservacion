$(function(){

    $('#btn_reservar').click(function(){
        //inicializando variable de ojetos a crear : contenedor
        $('#form-v_reserva').html('');
        $.ajax({
            url: "reservacion.php",
            type: "POST",
            data:{obj_tarifa:'ok', id:$('#id_servicio').html()},                         
            success: function(data)
            {         
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
                        info_tabla();
                    });

                    if (i==(limite-1)) {
                        $('#form-v_reserva').append('</tbody></table>');    
                    };                    
                };    
                            
            }                                       
        });
    });
    
	$('#txt_b_servicio').keyup(function(){
		var reg=$('#txt_b_servicio').val();
		// console.log(reg);
		bus_servicio(reg);
	});    
});
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
			// console.log(data)   
			$('#tabla_h_tarifa tbody').html(data);
        }			                	        
    });
    // imprimiendo id
    $('#id_servicio').html(id)
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