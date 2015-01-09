var inputid=0;
$(function(){
	
	$('#btn_m').click(function(){
		
		inputid++;
		var campo = ''
				+'<i class="icon-caret-right blue"></i> <b><i class="icon-time blue"></i> Horario: '+inputid+'</b>'
				+'<div class="row-fluid">'
					+'<div class="span6">'
						+'<div class="control-group"><label class="control-label" for="Opciones Dias">Seleccione dias:</label>'
							+'<div class="controls">'
								+'<div class="span12">'
									+'<select multiple="" class="chzn-select'+inputid+'" id="'+'select'+inputid+'" data-placeholder="Seleccione Días">'												
									+'</select>'
								+'</div>'
							+'</div>'
						+'</div>'
					+'</div>'
					+'<div class="span6">'
						+'<div class="row-fluid">'
							+'<div class="span12">'
								+'<div class="control-group">'
									+'<label class="control-label" for="form-field-tags">Horarios</label>'
									+'<div class="controls">'													
										+'<input class="span5" type="text" id="form-field-tags'+inputid+'" placeholder="Digite hora..." />'													
									+'</div>'
								+'</div>'
							+'</div>'
						+'</div>'
					+'</div>'
				+'</div>';
		$("#obj_contenedor").append(campo);					
		// console.log('inputid: '+inputid)
		//$('.chzn-select'+inputid+"").append("<option value='LUNES' />LUNES");						
		var semana = [ 
			    {"id": 'LUNES', "name": "LUNES"}, 
			    {"id": 'MARTES', "name": "MARTES"},
			    {"id": 'MIERCOLES', "name": "MIERCOLES"},
			    {"id": 'JUEVES', "name": "JUEVES"},
			    {"id": 'VIERNES', "name": "VIERNES"},
			    {"id": 'SABADO', "name": "SABADO"},
			    {"id": 'DOMINGO', "name": "DOMINGO"}
			];

		var myOptions = "<option value></option>";
		for(var i=0; i<semana.length; i++){
		    myOptions +=  '<option value="'+semana[i].id+'">'+semana[i].name+'</option>';
		}
		// uses new "chosen" actualiza con el nuevo señesct"
		$('.chzn-select'+inputid+"").html(myOptions).chosen().trigger("chosen:updated");					
		//we could just set the data-provide="tag" of the element inside HTML, but IE8 fails!
		var tag_input = $("#form-field-tags"+inputid);	
		//alert(tag_input.attr('id'))		
		var regexp = /[0-9]{1,2}[:]{1}[0-9][1,2]/;			
		if(! ( regexp.test(navigator.userAgent)) ){							
			tag_input.tag({placeholder:tag_input.attr('placeholder')});
			//alert('hola '+tag_input.val())
		}							
		else {
			//display a textarea for old IE, because it doesn't support this plugin or another one I tried!							
			tag_input.after('<textarea class="span12" id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="5">'+tag_input.val()+'</textarea>').remove();
			//$('#form-field-tags').autosize({append: "\n"});
		}
	})	
})
$('#btn_guardar_horario').click(function(){
	inputid=0;
	console.log('var inputid: '+inputid)
		// var contenedo=$('#obj_contenedor');
		// console.log(document.getElementById('obj_contenedor').firstChild)			
	for (var i = 1;;i++) {
		console.log('valori: '+i)
		var elem="select"+i+"";
		var elem1="#select"+i+"";
		var elem2="#form-field-tags"+i+"";					
		if (document.getElementById(elem)) {
			console.log(i)
			var valor1=""+$(elem1).val()

			valor1=valor1.replace(" ","")
			valor1=valor1.replace("[","")
			valor1=valor1.replace("]","")

			// co]nsole.log(valor1)
			var valor2=$(elem2).val()
			var id_servicio=$('#lbl_id_servicio').html();	
			var cadena=valor2.split(",");
			var horai=cadena[0];
			var horaf=cadena[1];
			horaf=horaf.replace(" ","");
			$.ajax({
		        url: "php/tarifa.php",
		        type: "POST",
		        data:{g_horario:'ok', id_servicio:id_servicio, dias:valor1,horai:horai,horaf:horaf},			               
		        success: function(data)
		        {			
					// console.log(data)   
					$.gritter.add({						
						title: '..Mensaje..!',						
						text: 'OK: <br><i class="icon-cloud purple bigger-230"></i>  Sus datos fueron almacenados correctamente. <br>',						
						//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
						sticky: false,						
						time: 2000
					});	
					mostrar_horario(id_servicio)						
					$('#obj_contenedor').html('');
		        }			                	        
		    });
		}else{
		 break;
		}
	};
	

});

function mostrar_horario(id){
	$.ajax({
        url: "php/tarifa.php",
        type: "POST",
        data:{mostrar_horario:'ok', id:id},			               
        success: function(data)
        {			
			//console.log(data)   
			$('#tabla_horario tbody').html(data);
        }			                	        
    });
};

// eliminar refgistro tarifa
function h_eliminar(id){
	$.ajax({
        url: "php/tarifa.php",
        type: "POST",
        data:{id:id,h_eliminar:'ok'},			               
        success: function(data)
        {			
			//console.log(data)   
			$('#tabla_tarifa tbody').html(data);
			$.gritter.add({						
				title: '..Mensaje..!',						
				text: 'OK: <br><i class="icon-cloud purple bigger-230"></i>  Sus datos fueron eliminados . <br>',						
				//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
				sticky: false,						
				time: 2000
			});			
			mostrar_horario($('#lbl_id_servicio').html());
        }			                	        
    });
}