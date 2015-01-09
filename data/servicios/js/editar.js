$(function (){
	
	$('#btn_eliminar').click(function(){
		console.log('accion')
		var id=$('#lbl_id_servicio').html();
		$.ajax({
			url:'php/tarifa.php',
			type:'POST',
			data:{id:id,eliminar_servicio:'ok'},
			success: function(data)
            {
            	if (data==1) {
            		$.gritter.add({						
						title: '..Mensaje..!',						
						text: 'OK: <br><i class="icon-cloud danger bigger-230"></i>  Sus datos fueron eliminados correctamente. <br><i class="icon-spinner icon-spin green bigger-230"></i>',						
						//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
						sticky: false,						
						time: 1000
					});
					setTimeout("location.href = '../servicios/';", 1000);
            	};
            }
		});
	});

});

