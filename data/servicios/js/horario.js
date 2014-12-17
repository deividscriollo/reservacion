
			$(function(){
				var inputid=0;
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
					$("#form-field-tags1").click(function(){
						alert('hoal')
					})
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
		