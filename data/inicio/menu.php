<?php
if(!isset($_SESSION))
	{
		session_start();
	}
//php
function menu(){
$url = $_SERVER['PHP_SELF'];
$acus=parse_url($url, PHP_URL_PATH);
$acus=split('/', $acus);
	if ($_SESSION['nivel']!='CLIENTE') {
		print'<div class="sidebar" id="sidebar">
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
				</div><!--#sidebar-shortcuts-->
				<ul class="nav nav-list blue">';
				require_once('../../admin/class.php');
				$dc_class=new constante();
				$resultado = $dc_class->consulta("	SELECT ACCESOS FROM SEG.SEGMENTO S, SEG.USUARIO U WHERE U.ID=S.ID_USUARIO AND U.ID='$_SESSION[id]'");
				while ($row=$dc_class->fetch_array($resultado)) {
					print'<li ';if ($acus[3]=='inicio') {print("class=active");}print'>
						<a href="../inicio/">
							<i class="icon-desktop pink"></i>
							<span class="menu-text pink"> Inicio </span>
						</a></li>';

					$acu=str_replace('{', '', $row[0]);
					$acu=str_replace('}', '', $acu);
					$acu=split(',', $acu);
						$sum=$acu[0];	$sum=split(':',$sum);	$var='';
						if ($sum[1]=='TRUE'){
							print'<li ';if ($acus[3]=='servicios') {print("class=active");}print'>
									<a href="../servicios/">
										<i class="icon-tag blue"></i>
										<span class="menu-text blue"> Servicios </span>
									</a></li>';
						}
						$sum=$acu[1];	$sum=split(':',$sum);	$var='';
						if ($sum[1]=='TRUE'){
							print'<li ';if ($acus[3]=='bancos') {print("class=active");}print'>
								<a href="../bancos/">
									<i class="icon-money green"></i>
									<span class="menu-text blue"> Bancos </span>
								</a></li>';
						}
						$sum=$acu[2];	$sum=split(':',$sum);	$var='';
						if ($sum[1]=='TRUE'){
							print'<li ';if ($acus[3]=='agenda') {print("class=active");}print'>
									<a href="../agenda/">
										<i class="icon-calendar purple"></i>

										<span class="menu-text purple">
											Agenda
										</span>
									</a></li>';
						}
						$sum=$acu[3];	$sum=split(':',$sum);	$var='';
						if ($sum[1]=='TRUE'){
							print'<li ';if ($acus[3]=='correo') {print("class=active");}print'>
								<a href="../correo/">
									<i class="icon-envelope-alt pink"></i>
									<span class="menu-text pink">
										Correo
									</span>
								</a></li>';
						}
						$sum=$acu[4];	$sum=split(':',$sum);	$var='';
						if ($sum[1]=='TRUE'){
							print'<li ';if ($acus[3]=='correo') {print("class=active");}print'>
								<a href="../correo/">
									<i class="icon-envelope-alt pink"></i>
									<span class="menu-text pink">
										Correo
									</span>
								</a></li>';
						}
						$sum=$acu[5];	$sum=split(':',$sum);	$var='';
						if ($sum[1]=='TRUE'){
							print'<li ';if ($acus[3]=='reserva') {print("class=active");}print'>
								<a href="../reserva/">
									<i class="icon-building blue"></i>

									<span class="menu-text blue">
										Reservar
										<span class="badge badge-transparent tooltip-error">

										</span>
									</span>
								</a></li>';
						}
						$sum=$acu[6];	$sum=split(':',$sum);	$var='';
						if ($sum[1]=='TRUE'){
							print'<li ';if ($acus[3]=='reportes') {print("class=active");}print'>
								<a href="../reportes/">
									<i class="icon-print pink"></i>
									<span class="menu-text pink"> Reportes </span>
								</a></li>';
						}
						$sum=$acu[7];	$sum=split(':',$sum);	$var='';
						if ($sum[1]=='TRUE'){
							print'<li ';if ($acus[3]=='confirmacion') {print("class=active");}print'>
								<a href="../confirmacion/">
									<i class="icon-laptop purple"></i>
									<span class="menu-text purple"> Confirmación </span>
								</a></li>';
						}
						$sum=$acu[8];	$sum=split(':',$sum);	$var='';
						if ($sum[1]=='TRUE'){
							print'<li ';if ($acus[3]=='usr') {print("class=active");}print'>
								<a href="../usr/">
									<i class="icon-user orange"></i>
									<span class="menu-text orange"> Usuario </span>
								</a></li>';
						}
						$sum=$acu[9];	$sum=split(':',$sum);	$var='';
						if ($sum[1]=='TRUE'){
							print'<li ';if ($acus[3]=='factura') {print("class=active");}print'>
									<a href="../factura/">
										<i class="icon-book blue"></i>
										<span class="menu-text blue"> Factura </span>
									</a></li>';
							}
						}
		print'
			</ul><!--/.nav-list-->
			<div class="sidebar-collapse" id="sidebar-collapse">
				<i class="icon-double-angle-left"></i>
			</div>
		</div>';
	}
if ($_SESSION['nivel']=='CLIENTE') {
	print'<div class="sidebar" id="sidebar">
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">

				</div><!--#sidebar-shortcuts-->

				<ul class="nav nav-list blue">
					<li ';if ($acus[3]=='inicio') {print("class=active");}print'>
						<a href="../inicio/">
							<i class="icon-desktop pink"></i>
							<span class="menu-text pink"> Home </span>
						</a>
					</li>
					<li ';if ($acus[3]=='reservacion') {print("class=active");}print'>
						<a href="../ciomi/">
							<i class="icon-check green"></i>
							<span class="menu-text green"> Crear Reservación </span>
						</a>
					</li>
					<li ';if ($acus[3]=='reserva_banco') {print("class=active");}print'>
						<a href="../reserva_banco/">
							<i class=" icon-credit-card red"></i>
							<span class="menu-text red"> Pago Bancos </span>
						</a>
					</li>
					<li ';if ($acus[3]=='reserva_banco') {print("class=active");}print'>
						<a href="../reserva_banco/">
							<i class=" icon-list purple"></i>
							<span class="menu-text purple"> Historial </span>
						</a>
					</li>
				</ul><!--/.nav-list-->
				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left"></i>
				</div>
			</div>';
}

}
function menunav(){

	print('<div class="navbar">
			<div class="red navbar-inner">
				<div class="container-fluid">
					<a href="../inicio/" class="brand">
						<small>
							<i class="icon-home"></i>
							Fábrica Imbabura
						</small>
					</a><!--/.brand-->

					<ul class="nav ace-nav pull-right">
						<li class="red">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class=" icon-info-sign icon-animated-bell"></i> Ayuda
							</a>
						</li>
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<span class="user-info">
									<small>Bienvenido,</small>
									'.strtolower($_SESSION["nivel"]).'
								</span>
							</a>
						</li>
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="../assets/avatars/user.jpg" alt="'.$_SESSION['nom'].'" />
								<span class="user-info">
									<small>Bienvenido,</small>
									'.$_SESSION["nom"].'
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
								<li>
									<a href="../inicio/perfil.php">
										<i class="icon-user"></i>
										Perfil
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="../inicio/salir.php">
										<i class="icon-off"></i>
										Cerrar  Session
									</a>
								</li>
							</ul>
						</li>
					</ul><!--/.ace-nav-->
				</div><!--/.container-fluid-->
			</div><!--/.navbar-inner-->
		</div>');
}
?>