// ------------------star use framework jquery--------------- //
jQuery(function($) {
	// ------------full get user db------//
	$('#tabla_usuarios').dataTable( {
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
		}
	});
	//editables on first profile page
	$.fn.editable.defaults.mode = 'inline';
	$.fn.editableform.loading = "<div class='editableform-loading'><i class='light-blue icon-2x icon-spinner icon-spin'></i></div>";
    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="icon-ok icon-white"></i></button>'+
                                '<button type="button" class="btn editable-cancel"><i class="icon-remove"></i></button>';
	//editables
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
        var reg=$('#txt_correo').val();
        if (buscando(reg,0)==0) {
            return true;
        };
        if(buscando(reg,0)!=0){
            return false;
        };
    }, "Por favor, Digite otro correo ya existe!!!.");
    //ValidaciÃ³n cedula valida
    jQuery.validator.addMethod("ced", function (value, element) {
        var reg=$('#txt_cedula').val();
        return check_cedula(reg)
        //return false;
    }, "Cedula Incorrecta !!!. :(");
    //Validación existencia cedula valida
    jQuery.validator.addMethod("existencia_ced", function (value, element) {
        var reg=$('#txt_cedula').val();
        if (existencia_cedula(reg)==1) {
            return false;
        };
        if (existencia_cedula(reg)!=1) {
            return true;
        };
        //return false;
    }, "El numero de cedula Ya EXISTE !!!. :(");
    // guardar informacion nuevo cliente
	$('#form-nuevo-usuario').validate({
		errorElement: 'span',
		errorClass: 'help-inline',
		focusInvalid: false,
		rules: {
			txt_cedula: {
				required: true,
				minlength: 10,
				maxlength: 10,
                ced:true,
                existencia_ced:true
			},
			txt_correo: {
				required: true,
				email: true,
				exis_correo:true
			},
			txt_nombre: {
				required: true
				//existe_seg:true
			},
			txt_pass: {
				required: true
				//existe_seg:true
			},
			txt_pass1: {
				required: true,
				equalTo: "#txt_pass"
			}
		},
		messages: {
			txt_cedula: {
				required: "Por favor, Digíte numero de cedula.",
				maxlength: 'Campo requerido solo con 10 dígitos',
				minlength: 'Campo requerido solo con 10 dígitos'
			},
			txt_correo: {
				required: "Por favor, Digíte correo electronico.",
				email: "Por favor, Digíte correo valido."
			},
			txt_nombre: {
				required: "Por favor, Digíte su nombre."
				//email: "Please provide a valid email."
			},
			txt_pass: {
				required: "Por favor, Digíte password / clave."
				//email: "Please provide a valid email."
			},
			txt_pass1: {
				equalTo: "Su contraseña no coincide",
				required: "Por favor, Repita Password."
				//email: "Please provide a valid email."
			}
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
				type:'POST',
				data:{guardar_usuario:'ok',cedula:$('#txt_cedula').val(),correo:$('#txt_correo').val(),nombre:$('#txt_nombre').val(),pass:$('#txt_pass').val()},
				success:function(data){
					if (data==0) {
                        $.gritter.add({
                            title: '..Mensaje..!',
                            text: 'OK: <br><i class="icon-cloud purple bigger-230"></i>  <h4>Sus datos se almacenaron con exito. </h4><br><i class="icon-spinner icon-spin green bigger-230"></i></h2>',
                            //image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',
                            sticky: false,
                            time: 2000
                        });
                        $('#form-nuevo-usuario').each (function(){
	                        this.reset();
	                    });
                    };
                     if(data!=0&&data!=1){
                         $.gritter.add({
                            title: '..Mensaje..!',
                            text: 'Lo sentimos: <br><i class=" icon-cogs red bigger-230"></i>   Intente mas Tarde . <br><i class="icon-spinner icon-spin red bigger-230"></i>',
                            //image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',
                            sticky: false,
                            time: ''
                        });
                     };
                    llenado_tabla_usuarios();
				}
			});
		}
	});
	// ------------llamado de funciones fuera------------//
		llenado_tabla_usuarios();

});
// ------------------end use framework jquery--------------- //

//-------------star function of javascript----------------//
function seleccion_usuario_nuevo(){
	$('#modal_nuevo').modal('show');
}
function llenado_tabla_usuarios(){
	$.ajax({
        url:'app.php',
        type:'POST',
        dataType:'json',
        data:{mostrar_usuarios:':)'},
        success:function(data){
        	$('#tabla_usuarios').DataTable().clear().draw();
            var a=1;
            for (var i=0; i<data.length; i=i+4) {
                $('#tabla_usuarios').dataTable().fnAddData([
					a,
					data[i+0],
					data[i+1],
					data[i+2],
					'**********',
					data[i+3]
                ]);
                a++;
            }
        }
    });
}
function seleccion_usuario_eliminar(id){
	bootbox.confirm("<h2>ESTA SEGURO QUE DESEA ELIMINAR..!!!</h2>", function(result) {
		if(result) {
			$.ajax({
				url:'app.php',
				type: 'POST',
				data:{eliminar_usuario:'ok',id:id},
				success:function(data){
					console.log(data);
					if (data==0) {
						$.gritter.add({
	                        title: '..Mensaje..!',
	                        text: 'OK: <br><i class="icon-cloud important bigger-230"></i>  <h4>Usuario Eliminado. </h4><br><i class="icon-spinner icon-spin green bigger-230"></i></h2>',
	                        //image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',
	                        sticky: false,
	                        time: 2000
	                    });
	                    llenado_tabla_usuarios();
					}else{
						 $.gritter.add({
                            title: '..Mensaje..!',
                            text: 'Lo sentimos: <br><i class=" icon-cogs red bigger-230"></i>   Intente mas Tarde . <br><i class="icon-spinner icon-spin red bigger-230"></i>',
                            //image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',
                            sticky: false,
                            time: ''
                        });
					}
				}
			});
		}
	});

}
function seleccion_usuario_editar(id){
	$('#modal_editar').modal('show');
	var acudata;
	//editables on first profile page
	$.ajax({
		url:'app.php',
		type: 'POST',
		async:false,
		dataType:'json',
		data:{info_usuario:'ok',id:id},
		success:function(data){
			acudata=data;
		}
	});
	console.log(acudata);

	$('#lbl_nombre').html(acudata[1]);

    $('#lbl_nombre').editable({
    	value:acudata[1],
		type: 'text',
		url: 'app.php',
	    pk: id,
	    name:'actualizar_usuario_nombre',
	    success: function(response, newValue) {
	       console.log(response);
	       llenado_tabla_usuarios();
	    },
	    validate: function(value) {
		    if($.trim(value) == '') {
		        return 'Por favor, digite nombre, campo requerido';
		    }
		},
    });
    $('#lbl_cedula').html(acudata[0]);
    $('#lbl_cedula').editable({
    	value:acudata[0],
		type: 'text',
		url: 'app.php',
	    pk: id,
	    name:'actualizar_usuario_cedula',
	    success: function(response, newValue) {
	       console.log(response);
	       llenado_tabla_usuarios();
	    },
	    validate: function(value) {
		    if($.trim(value) == '') {
		        return 'Por favor, digite nombre, campo requerido';
		    }
		    if (check_cedula(value)!=true) {
		    	return 'Por favor, Digite cedula valida, campo requerido';
		    }
		},
    });
    $('#lbl_correo').html(acudata[2]);
    $('#lbl_correo').editable({
    	value:acudata[2],
		type: 'email',
		url: 'app.php',
	    pk: id,
	    name:'actualizar_usuario_correo',
	    success: function(response, newValue) {
	       console.log(response);
	       llenado_tabla_usuarios();
	    },
	    validate: function(value) {
		    if($.trim(value) == '') {
		        return 'Por favor, digite nombre, campo requerido';
		    }
		    if (check_cedula(value)!=true) {
		    	return 'Por favor, Digite cedula valida, campo requerido';
		    }
		},
    });
}
function seleccion_privilegio(id){
	$('#modal_privilegio').modal('show');
	$('#txt_id_usuario').val(id);
	$.ajax({
        url:'app.php',
        type:'POST',
        async:false,
        data:{mostrar_privilegio_usuario:':)', id:id},
		success:function(data){
			$('#obj_privilegio_usuario').html(data);
			// addicion procesos de verificacion de accesos
			$('#btn_servicios').on('click', function(){
				var res='';	$validation = this.checked; if(this.checked) {res='TRUE';	}else {res='FALSE';}
				$.ajax({ url:'app.php', type:'POST',  data:{btn_privilegios:':)',id:id,pro:'SERVICIOS:'+res,pos:1}
			    });
			});
			$('#btn_bancos').on('click', function(){
				var res='';	$validation = this.checked; if(this.checked) {res='TRUE';	}else {res='FALSE';}
				$.ajax({ url:'app.php', type:'POST',  data:{btn_privilegios:':)',id:id,pro:'BANCOS:'+res,pos:2}
			    });
			});
			$('#btn_agenda').on('click', function(){
				var res='';	$validation = this.checked; if(this.checked) {res='TRUE';	}else {res='FALSE';}
				$.ajax({ url:'app.php', type:'POST',  data:{btn_privilegios:':)',id:id,pro:'AGENDA:'+res,pos:3}
			    });
			});
			$('#btn_correo').on('click', function(){
				var res='';	$validation = this.checked; if(this.checked) {res='TRUE';	}else {res='FALSE';}
				$.ajax({ url:'app.php', type:'POST',  data:{btn_privilegios:':)',id:id,pro:'CORREO:'+res,pos:4}
			    });
			});
			$('#btn_reserva').on('click', function(){
				var res='';	$validation = this.checked; if(this.checked) {res='TRUE';	}else {res='FALSE';}
				$.ajax({ url:'app.php', type:'POST',  data:{btn_privilegios:':)',id:id,pro:'RESERVA:'+res,pos:5}
			    });
			});
			$('#btn_reportes').on('click', function(){
				var res='';	$validation = this.checked; if(this.checked) {res='TRUE';	}else {res='FALSE';}
				$.ajax({ url:'app.php', type:'POST',  data:{btn_privilegios:':)',id:id,pro:'REPORTES:'+res,pos:6}
			    });
			});
			$('#btn_confirmacion').on('click', function(){
				var res='';	$validation = this.checked; if(this.checked) {res='TRUE';	}else {res='FALSE';}
				$.ajax({ url:'app.php', type:'POST',  data:{btn_privilegios:':)',id:id,pro:'CONFIRMACIOn:'+res,pos:7}
			    });
			});
			$('#btn_usr').on('click', function(){
				var res='';	$validation = this.checked; if(this.checked) {res='TRUE';	}else {res='FALSE';}
				$.ajax({ url:'app.php', type:'POST',  data:{btn_privilegios:':)',id:id,pro:'URS:'+res,pos:8}
			    });
			});
			$('#btn_factura').on('click', function(){
				var res='';	$validation = this.checked; if(this.checked) {res='TRUE';	}else {res='FALSE';}
				$.ajax({ url:'app.php', type:'POST',  data:{btn_privilegios:':)',id:id,pro:'FACTURA:'+res,pos:9}
			    });
			});
			$('#btn_peticion').on('click', function(){
				var res='';	$validation = this.checked; if(this.checked) {res='TRUE';	}else {res='FALSE';}
				$.ajax({ url:'app.php', type:'POST',  data:{btn_privilegios:':)',id:id,pro:'PETICION:'+res,pos:10}
			    });
			});
			$('#btn_spt').on('click', function(){
				var res='';	$validation = this.checked; if(this.checked) {res='TRUE';	}else {res='FALSE';}
				$.ajax({ url:'app.php', type:'POST',  data:{btn_privilegios:':)',id:id,pro:'SPT:'+res,pos:11}
			    });
			});
		}
    });

}
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
  	return false
  };
  if (num<10) {
  	return false;
  }
}

//-------------end function of javascript----------------//