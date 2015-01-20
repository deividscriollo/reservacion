$(function(){
	// console.log('hola');
	actividad_recientes();
	$('#btn_actualizar').click(function(){
		actividad_recientes();
	});
	function actividad_recientes(){
		$.ajax({
			url:'agenda.php',
			type:'POST',
			data:{actividades:'ok'},
			success:function(data){
				$('.dcm').html(data);			
			}
		});
	}	
});