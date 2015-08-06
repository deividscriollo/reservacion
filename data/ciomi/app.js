$(function() {
	//----------llenado categoria----------//
	$.ajax({
        url:'app.php',
        type:'POST',
        data:{obj_tipo_reservacion:':)'},
        success:function(data){
        	$('#obj_tipo_reservacion').html(data);
        	var oldie = /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase());
			$('.easy-pie-chart.percentage').each(function(){
				$(this).easyPieChart({
					barColor: $(this).data('color'),
					trackColor: '#EEEEEE',
					scaleColor: false,
					lineCap: 'butt',
					lineWidth: 8,
					animate: oldie ? false : 1000,
					size:75
				}).css('color', $(this).data('color'));
			});
			$('.dc_hover').mouseover(function(){
				$(this).addClass('animated rubberBand').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
					$(this).removeClass('animated rubberBand');
				});
			});
			$('.dc_hover').click(function(dc){
				$('.dc_hover').css({background: 'rgba(255,25,255,0)'})
				$(this).css({
					background: 'rgba(25,25,25,0.03)',
					'border-radius': '5px'
				});
				var id=$(this).attr('id');
				$('#txt_categoria').val(id);
				// estableciendo nombre
				$.ajax({
		            url:'app.php',
		            type:'POST',
		            data:{mostrar_tarifa_servicios:':)',id:id},
		            success:function(data){
		                $('#obj_tarifas_nombre').html(data);
		            }
		        });
		        // estableciendo precio
		        $.ajax({
		            url:'app.php',
		            type:'POST',
		            data:{mostrar_tarifa_servicios2:':)',id:id},
		            success:function(data){
		                $('#obj_tarifas_precio').html(data);
		            }
		        });
		        // estableciendo cantidad
		        $.ajax({
		            url:'app.php',
		            type:'POST',
		            dataType:'json',
		            data:{mostrar_tarifa_servicios3:':)',id:id},
		            success:function(data){
		                var acumulador='';
		                var sumador='';
		                for (var i = 0; i < data.length; i=i+3) {
		                    var iden='';
		                    $.ajax({
		                        url:'app.php',
		                        type:'POST',
		                        async:false,
		                        dataType:'json',
		                        data:{mostrar_reservacion_tarifa:':)',id_reservacion:data[i+2], id_tarifa:data[i+0]},
		                        success:function(response){
		                            iden=response;
		                        }
		                    });
		                    acumulador+='<li id="'+data[0+i]+'"> <span class="editable" id="lbl_'+data[i+0]+','+data[2+i]+'" onclick="ejemplo(event)">'+iden[0]+'</span> </li>';
		                    sumador+='<li id="tot_'+data[0+i]+'">'+iden[1]+'</li>';
		                    // subtotal(data[i+2]+','+iden[1]);
		                }

		                $('#obj_tarifas_cantidad').html(acumulador);
		                $('#obj_tarifas_total').html(sumador);
		            }
		        });
			});
        }
    });
	// inicializacion calendario
	$('.date-picker').keypress(function(event) {
		return false;
	});
	$('.date-picker').bind("cut copy paste",function(e) {
          e.preventDefault();
      });
	$('.date-picker').datepicker({
		endDate: '+7d',
        autoclose: true,
        startDate: '+1d',
        format: 'dd/mm/yyyy',
	}).change(function(){
		var mes = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
		var fecha=$(this).val();
		var dia_sem=dia_semana(fecha);
		var acu=fecha.split('/');
		buscar_horas(dia_sem,fecha);
		$('#info_fecha').html('<p class="text-success">'+dia_sem+', '+mes[parseInt(acu[1])]+' '+acu[0]+' del '+acu[2]+'</p>');

	});

	$('[data-rel=tooltip]').tooltip();
	$(".select2").css('width','150px').select2({allowClear:true})
	.on('change', function(){
		$(this).closest('form').validate().element($(this));
	});
	var $validation = false;
	$('#fuelux-wizard').ace_wizard().on('change' , function(e, info){
		var categoria=$('#txt_categoria').val();
		if (info.step == 1) {
			if (categoria=='') {
				$.gritter.removeAll();
				$.gritter.add({
                    title: 'Estimado Cliente <span class="icon-user"></span>',
                    text: '<h5>Estimado cliente seleccione un tipo de reservación</h5>',
                    class_name: 'gritter-info gritter-center',
                    time:2000
                });
                $('.dc_hover').addClass('animated rubberBand').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
					$(this).removeClass('animated rubberBand');
				});
                return false;
			}
			if (categoria!='') {
				$.gritter.removeAll();
				return true;
			}
		}
		if (info.step==2) {
			var fecha=$('.date-picker').val();
			if (fecha=='') {
				$.gritter.removeAll();
				$.gritter.add({
                    title: 'Estimado Cliente <span class="icon-user"></span>',
                    text: '<h5>Estimado cliente seleccione una fecha</h5>',
                    class_name: 'gritter-info gritter-center',
                    time:2000
                });
                $('.date-picker').addClass('animated bounceInLeft').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
					$(this).removeClass('animated bounceInLeft');
				});
                return false;
			};
			if (busca_seleccionado_chek()==':(') {
				$.gritter.removeAll();console.log($('#tabla_horas >tbody >tr').length);
				if ($('#tabla_horas >tbody >tr').length != 0){
				    $.gritter.add({
	                    title: 'Estimado Cliente <span class="icon-user"></span>',
	                    text: '<h5>Estimado cliente seleccione un horario</h5>',
	                    class_name: 'gritter-info gritter-center',
	                    time:2000
	                });
	                $('#tabla_horas tbody tr td label input').addClass('animated bounceOut');
	                $('#tabla_horas tbody tr td label input').prop("checked", "checked");  
	                setTimeout ("renovar()", 1000);
				};
				if ($('#tabla_horas >tbody >tr').length == 0) {
					$.gritter.add({
                    title: 'Estimado Cliente <span class="icon-user"></span>',
                    text: '<h5>Lo sentimos, no disponemos de horarios para realizar reservaciones en este día.</h5>',
                    class_name: 'gritter-info gritter-center',
                    time:20000
                });
				}
                return false;
			}
		}
	}).on('finished', function(e) {
		bootbox.dialog("Thank you! Your information was successfully saved!", [{
			"label" : "OK",
			"class" : "btn-small btn-primary",
			}]
		);
	}).on('stepclick', function(e){
		//return false;//prevent clicking on steps
	});

})

// funciones adicionales
function buscar_horas(dia,fe){
    var res=':(';
    $.ajax({
        url: "app.php",
        type: "POST",
        data:{museo_buscar_horas:'ok',dia:dia,f:fe},
        success: function(data){
            $.gritter.removeAll();
            $("#tabla_horas tbody").html('');
            if (data!=0) {
                $("#tabla_horas tbody").html(data);
            }else{
                $.gritter.add({
                    title: 'Estimado Cliente <span class="icon-user"></span>',
                    text: '<h5>Lo sentimos, no disponemos de horarios para realizar reservaciones en este día.</h5>',
                    class_name: 'gritter-info gritter-center',
                    time:20000
                });
            }
        }
    });
    //return res;
}
// renueva su estado base
function renovar() {
    $('#tabla_horas tbody tr td label input').removeClass('animated bounceOut');
    $('#tabla_horas tbody tr td label input').removeAttr('checked');    
}
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