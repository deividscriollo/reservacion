var DataSourceTree = function(options) {
	this._data 	= options.data;
	this._delay = options.delay;
}

DataSourceTree.prototype.data = function(options, callback) {
	var self = this;
	var $data = null;

	if(!("name" in options) && !("type" in options)){
		$data = this._data;//the root tree
		callback({ data: $data });
		return;
	}
	else if("type" in options && options.type == "folder") {
		if("additionalParameters" in options && "children" in options.additionalParameters)
			$data = options.additionalParameters.children;
		else $data = {}//no data
	}
	
	if($data != null)//this setTimeout is only for mimicking some random delay
		setTimeout(function(){callback({ data: $data });} , parseInt(Math.random() * 500) + 200);

	//we have used static data here
	//but you can retrieve your data dynamically from a server using ajax call
	//checkout examples/treeview.html and examples/treeview.js for more info
};

var tree_data = {
	'Menu' : {name: 'Menu', type: 'folder'}
}
tree_data['Menu']['additionalParameters'] = {
	'children' : {
		'1' : {name: 'Home', type: 'item'},
		'2' : {name: 'Servicios', type: 'item'},
		'3' : {name: 'Bancos', type: 'item'},
		'4' : {name: 'Pago Bancos', type: 'item'},
		'5' : {name: 'Calendario', type: 'item'},
		'6' : {name: 'Reservaciones', type: 'item'},
		'7' : {name: 'Reportes', type: 'item'},
		'8' : {name: 'Configuración', type: 'item'},
		'9' : {name: 'Usuario', type: 'item'}
	}
}
function resultado_data(){
	var datos;
	$.ajax({
		url:'php/mostrar_usuarios.php',
		type:'POST',
		async:false,
		dataType: 'json',
		data:{mostrar_seg_menu:'ok'},
		success:function(data){
			for (var i = 0; i < data.length; i++) {
				console.log(data[1])
			}
		}
	});
	return datos;
}

var treeDataSource = new DataSourceTree({data: tree_data});
//verificarmarcador_segmentos()
function verificarmarcador_segmentos(){
	var contenedor = document.getElementById('con_obj_segmentos');
	//console.log(contenedor.search('row-fluid'))
	// $("#con_obj_segmentos").each(function(){
	// 	console.log($(this));
       

 //    });
    var limite=0;
    var sum=0;
	
	console.log(limite)
}
$(function(){
	//verificarmarcador_segmentos();
})