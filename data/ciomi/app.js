//------------------------------inicio proceso museo---------------------//
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
				$('.dc_hover').css({background: 'rgba(255,25,255,0)',color: '#000',})
				$(this).css({
					background: 'rgba(204,204,61,0.7)',
                    color: '#2283C5',
					'border-radius': '5px'
				});
				var id=$(this).attr('id');
				$('#txt_categoria').val(id);
		        // estableciendo total
		         $.ajax({
		            url:'app.php',
		            type:'POST',
		            dataType:'json',
		            data:{mostrar_tarifa_servicios4:':)',id:id},
		            success:function(data){
		                $('#tabla_info_tarifa tbody').html('');
		            	for (var i = 0; i < data.length; i++) {
		            		if (i%2==0) {
		            			$('#tabla_info_tarifa tbody').append(data[i]);
		            		};
		            		if(i%2!=0){
		            			$('#spi_'+data[i]+'').ace_spinner({value:0,min:0,max:200,step:1, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
								.on('change', function(){
									var id=$(this).attr('id').replace('spi_','');
									var precio=$('#pre_'+id).html();
									var precio2=parseFloat(precio);
									var cantidad=$(this).val();
									var cantidad2=parseInt(cantidad);
									$('#total_'+id).html((precio2*cantidad2).toFixed(2));
									valor_subtotal();
								});
		            		}
		            	}
		            }
		        });
			});
        }
    });
    $.ajax({
        url:'app.php',
        type:'POST',
        data:{obj_informacion_museo:':)'},
        success:function(data){
            var data=data.split(';');
            for (var i = 0; i < data.length; i++) {
                var acu='<div class="well">'+data[i]+'</div>';
                $('#obj_informacion_museo').append(acu);
            }
        }
    });
	// inicializacion calendario
	$('.date-picker').keypress(function(event) {
		return false;
	});
	$('.date-picker').bind("cut copy paste",function(e) {
          e.preventDefault();
      });
    var f_=new Date();
	$('.date-picker').datepicker({
        autoclose: true,
        startDate: '+1d',
        endDate: '31/12/'+f_.getFullYear(),
        format: 'dd/mm/yyyy',
	}).change(function(){
		var mes = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
		var fecha=$(this).val();
		var dia_sem=dia_semana(fecha);
		var acu=fecha.split('/');
		buscar_horas(dia_sem,fecha);
		$('#info_fecha').html('<p class="text-success">'+dia_sem+', '+mes[parseInt(acu[1])-1]+' '+acu[0]+' del '+acu[2]+'</p>');
		$('#lbl_fecha_final').html(dia_sem+', '+mes[parseInt(acu[1])-1]+' '+acu[0]+' del '+acu[2]);

	});

	$('#fuelux-wizard').ace_wizard().on('change' , function(e, info){
		$.gritter.removeAll();
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
	                    time:2000
	                });
				}
                return false;
			}
		};
		if (info.step==3) {
			info_tabla()
			var tabla=$('#lbl_total').text();
			$('#lbl_info_total').html(tabla);
			var tabla=parseFloat(tabla);
			if (tabla==0) {
				$.gritter.removeAll();
				$.gritter.add({
                    title: 'Estimado Cliente <span class="icon-user"></span>',
                    text: '<h5>Lo sentimos, Usted debe seleccionar la cantidad para poder continuar con la reservación.</h5>',
                    class_name: 'gritter-info gritter-center',
                    time:20000
                });
                $('.ace-spinner').addClass('animated wobble').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
					$(this).removeClass('animated wobble');
				});
                return false
			};
		}
	}).on('finished', function(e) {
        var fecha=$('#id-date-picker-1').val();
        var horarios = [$('#lbl_info_hora_inicio').text(), $('#lbl_info_hora_fin').text(),fecha,dia_semana(fecha)];
        var tarifas=new Array(5);
        var i=0;
        $('#tabla_info_tarifa tbody tr').each(function () {
            var nombre = $(this).find("td").eq(1).text();
            var cantidad = $(this).find("td").eq(3).html();
            var m=cantidad.split('id="');
            var n=m[1].split('"');
            var cantidad=$('#'+n[0]).val();
            var precio = $(this).find("td").eq(2).text();
            var tot = $(this).find("td").eq(4).text();
            var id_tar=$(this).find("td").eq(4).attr('id');
            tarifas[i]=new Array(nombre,precio,cantidad,tot,id_tar);
            i++;
        });
        // envio de informacion
        $.ajax({
            url: "app.php",
            type: "POST",
            data:{guardar:'ok',tarifas,horarios,total:$('#lbl_info_total').text()},
            beforeSend: function () {
                $.blockUI({
                    message:'<i id="icon-tiempo" class="width-10 icon-spinner red icon-spin bigger-125"></i> <h5>Estamos enviando la información a su correo, espere un momento....</h5>',
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
            success: function(data){
                $.unblockUI();
                if (data==0) {
                    bootbox.dialog("<h4>Su reservación se ha almacenado con éxito, por favor verifique su correo electrónico y siga las instrucciones.!</h4>", [{
                        "label" : "OK",
                        "class" : "btn-small btn-primary",
                        callback: function() {
                            location.href="";
                        }
                        }]
                    );
               };
               if(data!=0&&data!=1&&data!=2){
                    bootbox.dialog("Lo sentimos, comuníquese con un administrador!", [{
                        "label" : "OK",
                        "class" : "btn-small btn-primary",
                        }]
                    );
                };
            }
        });
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

function valor_subtotal(){
    var suma = 0;
	$('#tabla_info_tarifa tbody tr').each(function(){ //filas con clase 'dato', especifica una clase, asi no tomas el nombre de las columnas
	 suma +=parseFloat($(this).find('td').eq(4).text()); //numero de la celda 3
	})
    var total=suma;
    $('#lbl_subtotal').html('<i class="icon-caret-right green"></i> '+total.toFixed(2));
    var v_iva=0;
    var h=parseInt(valor_iva());
    $('#lbl_valor_iva').html('<i class="icon-caret-right green"></i> Iva '+h+'%');
    if (h!=0) {
    	v_iva=(h*total)/100;
    }
    $('#lbl_iva').html('<i class="icon-caret-right green"></i> '+v_iva.toFixed(2));
    $('#lbl_total').html('<i class="icon-caret-right green"></i> '+(total+v_iva).toFixed(2));
}
function valor_iva(){
	var valor=0;
	$.ajax({
        url: "app.php",
        type: "POST",
        async:false,
        data:{impuesto:'ok'},
        success: function(data){
        	valor= data;
        }
    });
    return valor;
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
function info_tabla(){
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
                                    $('#lbl_info_hora_inicio').html(a);
                                    break;
                                case 3:
                                    b=$(this).text();
                                    $('#lbl_info_hora_fin').html(b);
                                    break;
                                case 4:
                                    c=$(this).text();
                                    break;
                                case 5:
                                    d=$(this).text();
                                    break;
                            }
                        });
                    };
                    break;
            }
        });
        // console.log(campo0+' '+campo1+' '+campo2)
    });
}

//----------------------------------fin proceso museo----------------------//


//------------------------------inicio proceso auditorio-------------------//
$(function(){

    $('#id-date-range-picker-1').daterangepicker({
    }).prev().on(ace.click_event, function(){
        $(this).next().focus();
    });
    $('.timer_picker').timepicker({
        minuteStep: 1
    })



    // seleccionando otros
    $('.btn_teatro').click(function(){
        var valor=$(this).attr('id');
        $('#txt_nom_otros_servicios').val(valor);
        $(this).addClass('icon-ok');
        $('.btn_restaurante').removeClass('icon-ok');
        $('.btn_centro').removeClass('icon-ok');
    });
    $('.btn_restaurante').click(function(){
        var valor=$(this).attr('id');
        $('#txt_nom_otros_servicios').val(valor);
        $(this).addClass('icon-ok');
        $('.btn_teatro').removeClass('icon-ok');
        $('.btn_centro').removeClass('icon-ok');
    });
    $('.btn_centro').click(function(){
        var valor=$(this).attr('id');
        $('#txt_nom_otros_servicios').val(valor);
        $(this).addClass('icon-ok');
        $('.btn_restaurante').removeClass('icon-ok');
        $('.btn_teatro').removeClass('icon-ok');
    });
    $('#btn_modal_otros').click(function(){
        console.log($('#txt_nom_otros_servicios').val());
    })
    $('#fuelux-wizard2').ace_wizard().on('change' , function(e, info){
        if (info.step == 1) {
            var valor=$('#txt_nom_otros_servicios').val();
            if (valor!="") {
                console.log('vamos bn');
            }else{
                $.gritter.removeAll();
                $.gritter.add({
                    title: 'Estimado Cliente <span class="icon-user"></span>',
                    text: '<h5>Estimado cliente seleccione un servicio</h5>',
                    class_name: 'gritter-info gritter-center',
                    time:2000
                });
                return false;
            }
        };
        if (info.step==2) {
            var valor=$('#id-date-range-picker-1').val();
            var valor1=$('#txt_time_inicio').val();
            var valor3=$('#txt_time_final').val();
            if (valor!=""&&valor1!=""&&valor3!="") {
                $.ajax({
                    url: "app.php",
                    type: "POST",
                    data:{otros_buscar_tarifa:'ok',id:$('#txt_nom_otros_servicios').val()},
                    success: function(data){
                        $('#tabla_paquetes tbody').html(data);
                    }
                });
            }else{
                $.gritter.removeAll();
                $.gritter.add({
                    title: 'Estimado Cliente <span class="icon-user"></span>',
                    text: '<h5>Estimado cliente ingrese todos los campos</h5>',
                    class_name: 'gritter-info gritter-center',
                    time:2000
                });
                return false;
            }
        };
        if (info.step==3) {
            if (busca_seleccionado_chek2()==':)') {
                console.log('vamos bn');
                var fecha=$('#id-date-range-picker-1').val();
                var hora1=$('#txt_time_inicio').val();
                var hora2=$('#txt_time_final').val();
                var servicio=$('#txt_nom_otros_servicios').val();
                var servicio=$('#'+servicio).text();
                var id_servicio=$('#txt_nom_otros_servicios').val();
                //contruccion
                var f=fecha.split("-")
                var date1 = new Date(f[0]);
                var date2 = new Date(f[1]);
                var diffDays = date2.getDate() - date1.getDate(); 
                $('#lbl_dias_otros').html(diffDays);
                $('#lbl_fecha_final_otros').html(fecha);
                $('#lbl_hora_otros').html(hora1+'||'+hora2);
                $('#lbl_otros').html(servicio);
                $("#tabla_paquetes tbody tr").each(function (index) {
                    var campo0, campo1, campo2, campo3,campo4;
                    $(this).children("td").each(function (index2) {
                        switch (index2) {
                            case 1:
                                campo1=$(this).text();
                            break;
                            case 2:
                                campo2=$(this).text();
                            break;
                            case 3:
                                campo0 = $(this).children().children('input').is(":checked");
                                id=$(this).children().children('input').attr('id');
                                if (campo0==true) {
                                    $('#lbl_paquete_otros').html(campo1);
                                    $('#lbl_total_otros').html(campo2);
                                    $('#txt_id_paquete_tarifa').val(id);
                                };
                                break;
                        }
                    });
                });
            }else{
                $.gritter.removeAll();
                $.gritter.add({
                    title: 'Estimado Cliente <span class="icon-user"></span>',
                    text: '<h5>Estimado cliente seleccione un paquete</h5>',
                    class_name: 'gritter-info gritter-center',
                    time:2000
                });
                return false;
            }
        }
    }).on('finished', function(e) {
        var hora1=$('#txt_time_inicio').val();
        var hora2=$('#txt_time_final').val();
        var id_servicio=$('#txt_nom_otros_servicios').val();
        var id_tar_otros=$('#txt_id_paquete_tarifa').val();
        var fecha=$('#id-date-range-picker-1').val();
        var f=fecha.split("-")
        var formato_f1=f[0].split('/');
        var formato_f2=f[1].split('/');
        // console.log(formato_f1);
        var f1=formato_f1[2]+'-'+formato_f1[0]+'-'+formato_f1[1];
        var f2=formato_f2[2]+'-'+formato_f2[0]+'-'+formato_f2[1];
        var f1=f1.replace(/\s/g, '');
        var f2=f2.replace(/\s/g, '');
        var mk_otros=f1;
        f1=f1+' '+hora1;
        f2=f2+' '+hora2;

        var diasSemana = new Array("DOMINGO","LUNES","MARTES","MIÉRCOLES","JUEVES","VIERNES","SÁBADO");
        var nom_fecha=new Date(f[0]);

        var otros_total=parseFloat($('#lbl_total_otros').html());
        var di_tot=parseInt($('#lbl_dias_otros').html());
        var acu_otros_tot=otros_total*di_tot;
        acu_otros_tot=acu_otros_tot.toFixed(2);


        $.ajax({
            url: "app.php",
            type: "POST",
            data:{guardar_otros:'ok',cant:di_tot,subtot:acu_otros_tot,precio:otros_total,id:id_servicio,h1:f1,h2:f2,fech:mk_otros,dia:diasSemana[nom_fecha.getDay()],it_tar:id_tar_otros,servi:$('#lbl_otros').html()},
            beforeSend: function () {
                $.blockUI({
                    message:'<i id="icon-tiempo" class="width-10 icon-spinner red icon-spin bigger-125"></i> <h5>Estamos enviando la información a su correo, espere un momento....</h5>',
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
            success: function(data){
                $.unblockUI();
                if (data==0) {
                    bootbox.dialog("<h4>Su reservación se ha almacenado con éxito, por favor verifique su correo electrónico y siga las instrucciones.!</h4>", [{
                        "label" : "OK",
                        "class" : "btn-small btn-primary",
                        callback: function() {
                            location.href="";
                        }
                        }]
                    );
               };
               if(data!=0&&data!=1&&data!=2){
                    bootbox.dialog("Lo sentimos, comuníquese con un administrador!", [{
                        "label" : "OK",
                        "class" : "btn-small btn-primary",
                        }]
                    );
                };
            }
        });
    }).on('stepclick', function(e){
        //return false;//prevent clicking on steps
    });
});


function reconstruir2(i){
    $("#tabla_paquetes tbody tr").each(function (index) {
        var campo1, axus=0, campo3;
        $(this).children("td").each(function (index2) {
            switch (index2) {
                case 3:
                    $(this).children().children().removeAttr('checked');
                    break;
            }
        });
    });

    $("#tabla_paquetes tbody tr").each(function (index) {
        if (i==index) {
            $(this).children("td").each(function (index2) {
                switch (index2) {
                    case 3:
                        $(this).children().children().prop("checked", "checked");
                        break;
                }
            });
        }
    });
}
function busca_seleccionado_chek2(){
    var amd_x=':(';
    $("#tabla_paquetes tbody tr").each(function (index) {
        var campo0, campo1, campo2, campo3,campo4;
        $(this).children("td").each(function (index2) {
            switch (index2) {
                case 3:
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
// -------------------------------- fin proceso auditorio----------------------------//
