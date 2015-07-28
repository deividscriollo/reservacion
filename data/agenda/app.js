jQuery(function($) {

/* initialize the external events
	-----------------------------------------------------------------*/

	$('#external-events div.external-event').each(function() {
		// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
		// it doesn't need to have a start or end
		var eventObject = {
			title: $.trim($(this).text()) // use the element's text as the event title
		};

		// store the Event Object in the DOM element so we can get to it later
		$(this).data('eventObject', eventObject);

		// make the event draggable using jQuery UI
		$(this).draggable({
			zIndex: 999,
			revert: true,      // will cause the event to go back to its
			revertDuration: 0  //  original position after the drag
		});
	});




	/* initialize the calendar
	-----------------------------------------------------------------*/

	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();


	var calendar = $('#calendar').fullCalendar({
		//isRTL: true,
		defaultDate: new Date(),
		defaultView: "agendaWeek",
		buttonHtml: {
			prev: '<i class="ace-icon fa fa-chevron-left"></i>',
			next: '<i class="ace-icon fa fa-chevron-right"></i>'
		},
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ], 
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: [ 'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
		buttonText: {
			today: 'hoy',
			month: 'mes',
			week: 'semana',
			day: 'día'
		},
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		events: {
			url: 'app.php',
			data:{reservacion_eventos:'ok'},
			type:'POST',
			error: function(data) {
				console.log(data);
			}
		},
		slotDuration: '00:15:00',
		editable: true,
		droppable: true, // this allows things to be dropped onto the calendar !!!
		selectable: true,
		selectHelper: true,
		eventLimit: true, // allow "more" link when too many events
		eventResizeStart: function (event, jsEvent, ui, view) {
	        console.log('RESIZE START ' + event.title);
	        console.log('test');
	    },
	    eventResizeStop: function (event, jsEvent, ui, view) {
	        console.log('RESIZE STOP ' + event.title);

	    },
	    eventResize: function (event, dayDelta, minuteDelta, revertFunc, jsEvent, ui, view) {
	        console.log('RESIZE!! ' + event.title);
	        console.log(dayDelta + ' days'); //this will give the number of days you extended the event
	        console.log(minuteDelta + ' minutes');

	    },
	    eventReceive: function(event){
		   var title = event.title;
		   var start = event.start.format("YYYY-MM-DD[T]HH:MM:SS");
		   console.log('test');
		   $('');
		},
		select: function(start, end, allDay) {
			console.log('test');
			// alert('hola')
			// bootbox.prompt("titulo nueva reservacion:", function(title) {
			// 	if (title !== null) {
			// 		calendar.fullCalendar('renderEvent',
			// 			{
			// 				title: title,
			// 				start: start,
			// 				end: end,
			// 				allDay: allDay
			// 			},
			// 			true // make the event "stick"
			// 		);
			// 	}
			// });

			// calendar.fullCalendar('unselect');
		},
		drop: function(date, allDay, event, dayDelta, minuteDelta, revertFunc) { // this function is called when something is dropped
			 // console.log(event.start.moment().format('MMMM Do YYYY, h:mm:ss a'));
	        // console.log(dayDelta);
	        // console.log(minuteDelta);


			// retrieve the dropped element's stored Event Object
			var originalEventObject = $(this).data('eventObject');
			$('#id_txt_servicio').val($(this).attr("id"));
			var $extraEventClass = $(this).attr('data-class');
			// we need to copy it, so that multiple events don't have a reference to the same object
			var copiedEventObject = $.extend({}, originalEventObject);

			// ------------informacion de hora de inicio-------//
				var fecha=new Date(date);
				var fecha=new Date(fecha.getTime() + (5 * 3600 * 1000));
				var hora=digitos(fecha.getHours())+':'+digitos(fecha.getMinutes());
				var fecha_evento=digitos(fecha.getDate())+'/'+digitos(fecha.getMonth()+1)+'/'+fecha.getFullYear();
				var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
				var dia = diasSemana[fecha.getDay()];
			// .------------fin informacion hora de inicio----------------//
				var idreserva='';
			// -----------save informacion of calendar-------//
				$.ajax({
					url: 'app.php',
					type: 'POST',
					dataType:'json',
					async:false,
					data: {guardar_reservacion:'ok',servicio:$(this).attr("id"),hora_inicio:hora,fecha:fecha_evento,dia:dia},
					success:function(data){
						if (data[1]==0&&data[2]==0) {
							$.gritter.add({
		                        title: '<h1 class="icon-ok" style="color: #FFF;">Reservación creada con éxito</h1>',
		                        text: '',
		                        time: 4000
		                        //class_name: 'gritter-info')
		                    });
		                    $('#id_txt_reservacion').val(data[0]);
		                    idreserva=data[0]
						};
						if (data[1]!=0&&data[2]!=0) {
							$.gritter.add({
		                        title: '<h1 class="icon-ok" style="color: #336699;">Comunicar admin</h1>',
		                        text: 'Proceso fuera de db-56',
		                        time: 4000
		                        //class_name: 'gritter-info')
		                    });
						}
					}
				});
			// -----------end save informacion-------//

			// assign it the date that was reported
			copiedEventObject.start = date;
			copiedEventObject.id=idreserva;

			// copiedEventObject.allDay = allDay;
			if($extraEventClass) copiedEventObject['className'] = [$extraEventClass];

			$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
		},
		eventDragStart: function (event, jsEvent, ui, view) {
			console.log('cogiendo');
		},
		eventDragStop: function (event, jsEvent, ui, view) {
			console.log('soltando');
		},
		eventClick: function(calEvent, jsEvent, view) {
			$('#modal_form').modal('show');
			$('#txt_servicio').val(calEvent.title);
			$('.btn_eliminarevento').attr({id: calEvent.id});
		}

	});
	$('#btn_cliente').click(function(){
		$('#modal_form').modal('hide');
		$('#modal-cliente').modal('show');
	});
	$('#btn_cerrar_modal_buscar').click(function(){
		$('#modal-cliente').modal('hide');
		$('#modal_form').modal('show');
	});
	$('.btn_eliminarevento').click(function() {
		bootbox.confirm("Estás seguro?", function(result) {
			if(result) {
				var procesando=$('.btn_eliminarevento').attr('id');
				console.log(procesando);
				$.ajax({
					url: 'app.php',
					type: 'POST',
					dataType:'json',
					async:false,
					data: {eliminar_evento:':(', id:''+procesando+''},
					success:function(data){
						if (data[0]==0) {
							$('#modal_form').modal('hide');
							$('#calendar').fullCalendar('removeEvents',procesando);
						};
						if (data[0]!=0) {
							$.gritter.add({
		                        title: '<h1 class="icon-ok" style="color: #336699;">Comunicar admin</h1>',
		                        text: 'Proceso fuera de db-56',
		                        time: 4000
		                        //class_name: 'gritter-info')
		                    });
						}
					}
				});
			}
		});
	});
	$('#tbt_clientes').dataTable( {
        language: {
		    "sProcessing":     "Procesando...",
		    "sLengthMenu":     "Mostrar _MENU_ registros",
		    "sZeroRecords":    "No se encontraron resultados",
		    "sEmptyTable":     "Ningún dato disponible en esta tabla",
		    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		    "sInfoPostFix":    "",
		    "sSearch":         "Buscar: ",
		    "sUrl":            "",
		    "sInfoThousands":  ",",
		    "sLoadingRecords": "Cargando...",
		    "oPaginate": {
		        "sFirst":    "Primero",
		        "sLast":     "Último",
		        "sNext":     "Siguiente",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }
		},
		"aLengthMenu": [3]
    });
	generar_registros_cliente();
	function generar_registros_cliente(){
		// generar tableLayout
	    $.ajax({
	        url:'app.php',
	        type:'POST',
	        dataType:'json',
	        data:{mostrar_clientes:':)'},
	        success:function(data){
	        	$('#tbt_clientes').DataTable().clear().draw();
	            var a=1;
	            for (var i=0; i<data.length; i=i+5) {
	                $('#tbt_clientes').dataTable().fnAddData([
	                  data[i+0],
	                  data[i+1],
	                  data[i+2],
	                  data[i+3],
	                  data[i+4]
	                ]);
	            }
	        }
	    });
	}

    $('#btn_buscar_cliente').click(function(){
    	generar_registros_cliente();
    });
    // Existencia de cedula
    function existencia_cedula(reg){
        var result = "" ;
        $.ajax({
            url:'../../inicio/php/rev_usu_exi.php',
            async:  false ,
            type:  'post',
            data: {existencia_cedula:':)',reg:reg},
            success : function ( data )  {
                result=data;
            }
        });
        return result ;
    }
    // busqueda balidacion registro
    function buscando(registro){
        var result = "" ;
        $.ajax({
            url:'../../inicio/php/rev_usu_exi.php',
            async :  false ,
            type:  'post',
            data: {existencia_correo:':)',reg:registro},
            success : function ( data )  {
                 result = data ;
            }
        });
        return result ;
    }
    // Validacion de sedula
    function cedula(reg){
        var result = "" ;
        $.ajax({
                url:'../../utilidades/cedula.php',
                async :  false ,
                type:  'post',
                data: {registro:reg, cedula:reg},
                success : function ( data )  {
                    result=data;
                }
            });
        return result ;
    }
    //Validación Existencia correo electrónico
    jQuery.validator.addMethod("exis_correo", function (value, element) {
        var a=value;
        var reg=$('#txt_reg_email').val();
        if (buscando(reg,0)==0) {
            return true;
        };
        if(buscando(reg,0)!=0){
            return false;
        };
    }, "Por favor, Digite otro correo ya existe!!!.");
    //ValidaciÃ³n cedula valida
    jQuery.validator.addMethod("ced", function (value, element) {
        var reg=$('#txt_reg_ced').val();
        return check_cedula(reg)
        //return false;
    }, "Cedula Incorrecta!!!. :(");
    //Validación existencia cedula valida
    jQuery.validator.addMethod("existencia_ced", function (value, element) {
        var reg=$('#txt_reg_ced').val();
        if (existencia_cedula(reg)==1) {
            return false;
        };
        if (existencia_cedula(reg)!=1) {
            return true;
        };
        //return false;
    }, "El numero de cedula Ya EXISTE !!!. :(");
    // guardar informacion nuevo cliente
    $('#frm-registro').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
            txt_reg_ced:{
                required:true,
                minlength: 10,
                ced:true,
                // maxlength:10,
                existencia_ced:true
            },
            txt_reg_email: {
                email:true,
                exis_correo:true
            },
            txt_reg_nom_usuario: {
                required: true
            },
            txt_tel:{ required:true,number:true}
        },
        messages: {
            txt_reg_ced: {
                required: "Por favor, Digite cedula / ruc.",
                ced: "Por favor, Digite cedula / ruc valido.",
                minlength:'Por favor, Digite minimo 10 caracteres.',
                // maxlength: 'Por favor, Digite maximo 10 caracteres',
                existencia_ced: "El numero de cedula / ruc ya existe."
            },
            txt_reg_email: {
                required: "Por favor, Digite un email.",
                email: "Por favor, Digite un email válido.",
                exis_usu:'Por favor, Digite otro correo ya existes.'
            },
            txt_reg_nom_usuario:{
                required:"Por favor, Digite nombre y apellido"
            },
            // txt_dir:'Por favor, Digíte dirección',
            txt_tel:'Por favor, Digíte numero de teléfono'
        },

        invalidHandler: function (event, validator) { //display error alert on form submit
            $('.alert-error', $('.login-form')).show();
        },

        highlight: function (e) {
            $(e).closest('.control-group').removeClass('success').addClass('error');
        },

        success: function (e) {
            $(e).closest('.control-group').removeClass('error').addClass('success');
            $(e).remove();
        },

        errorPlacement: function (error, element) {
            if(element.is(':checkbox') || element.is(':radio')) {
                var controls = element.closest('.controls');
                if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
            }
            else if(element.is('.select2')) {
                error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            }
            else if(element.is('.chzn-select')) {
                error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
            }
            else error.insertAfter(element);
        },
        submitHandler: function (form) {
            $.ajax({
                url:'app.php',
                type:  'post',
                data: {guardar_cliente:':)',
                    txt_0:$('#txt_reg_ced').val(),
                    txt_1:$('#txt_reg_nom_usuario').val(),
                    txt_2:$('#txt_reg_email').val(),
                    txt_3:$('#txt_dir').val(),
                    txt_4:$('#txt_tel').val()
                },
                success : function ( data )  {
                    console.log(data);
                    console.log(data)
                    $.unblockUI();                                          ;
                    if(data==1){
                        $.unblockUI();
                        $.gritter.add({
                            title: '<h1 class="icon-ok" style="color: #336699;">Cliente</h1>',
                            text: 'Creado con exito',
                            time: 4000
                            //class_name: 'gritter-info')
                        });
                        $('#frm-registro').each (function(){
                          this.reset();
                        });
                    }if(data==0){
                        $.unblockUI();
                        $.gritter.add({
                            title: '<h1 style="color: #336699;">Mensaje</h1>',
                            text: 'MMM.. tenemos Algunos Inconvenientes LO SENTIMOS te sugerimos intentar mas tarde...',
                            time: 4000
                            //class_name: 'gritter-info')
                        });
                    }if(data!=0&&data!=1){
                        $.unblockUI();
                        $.gritter.add({
                            title: '..Mensaje..!',
                            text: 'Lo sentimos: <br><i class=" icon-cogs red bigger-230"></i>   Informe al Administrador . <br><i class="icon-spinner icon-spin red bigger-230"></i> : [',                       
                            sticky: false,
                            time: ''
                        });
                    }
                    $('#icon-tiempo').hide();
                }
            });
        }
    });


});
function check_cedula(cedula){
  var cedula = cedula;
  array = cedula.split( "" );
  num = array.length;
  if ( num == 10 ){
    total = 0;
    digito = (array[9]*1);
    for( i=0; i < (num-1); i++ )
     {
       mult = 0;
       if ( ( i%2 ) != 0 ) {
         total = total + ( array[i] * 1 );
       }
       else
       {
         mult = array[i] * 2;
         if ( mult > 9 )
          total = total + ( mult - 9 );
        else
          total = total + mult;
      }
    }
    decena = total / 10;
    decena = Math.floor( decena );
    decena = ( decena + 1 ) * 10;
    final = ( decena - total );
    if ( ( final == 10 && digito == 0 ) || ( final == digito ) ) {
      return true;
    }
    else
    {
      return false;
    }
  };
  if(num >10) {
  	return validar(cedula);
  };
  if (num<10) {
  	return false;
  }
}
function validar(ruc){
  var number = ruc;
  var dto = number.length;
  var valor;
  var acu=0;
  if(number==""){
   return false;
   }
  else{
   for (var i=0; i<dto; i++){
   valor = number.substring(i,i+1);
   if(valor==0||valor==1||valor==2||valor==3||valor==4||valor==5||valor==6||valor==7||valor==8||valor==9){
    acu = acu+1;
   }
   }
   if(acu==dto){
    while(number.substring(10,13)!=001){
     return false;
     return;
    }
    while(number.substring(0,2)>24){
     return false;
     return;
    }
    return true;
   }
   else{
   return false;
   }
  }
}

function seleccion_cliente(id){
    $.ajax({
        url:'app.php',
        type:'POST',
        dataType:'json',
        data:{llenar_clientes_datos:':)',id:id},
        success:function(data){
        	console.log(data);
            $('#txt_cliente_reserva').val(data[1]);
            $('#id_txt_cliente_reserva').val(id);
            $('#txt_telefono_reserva').val(data[2]);
            $('#txt_direccion_reserva').val(data[3]);
        }
    });
    $('#modal-cliente').modal('hide');
    $('#modal_form').modal('show');
	$.ajax({
	    url:'app.php',
	    type:'POST',
	    dataType:'json',
	    data:{actualizar_clientes_reservacion:':)',id:$('#id_txt_reservacion').val(),id_cliente:id},
	    success:function(data){
	        $('#txt_cliente_reserva').val(data[1]);
	        $('#id_txt_cliente_reserva').val(id);
	        $('#txt_telefono_reserva').val(data[2]);
	        $('#txt_direccion_reserva').val(data[3]);
	    }
	});
}

function digitos(n) {
    return n < 10 ? '0' + n : n;
}