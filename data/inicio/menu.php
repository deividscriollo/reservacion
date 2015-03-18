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

				<ul class="nav nav-list blue">
					<li ';if ($acus[3]=='inicio') {print("class=active");}print'>
						<a href="../inicio/">
							<i class="icon-desktop pink"></i>
							<span class="menu-text pink"> Home </span>
						</a>
					</li>
					<li ';if ($acus[3]=='servicios') {print("class=active");}print'>
						<a href="../servicios/">
							<i class="icon-tag blue"></i>
							<span class="menu-text blue"> Servicios </span>
						</a>
					</li>
					<li ';if ($acus[3]=='bancos') {print("class=active");}print'>
						<a href="../bancos/">
							<i class="icon-money green"></i>
							<span class="menu-text blue"> Bancos </span>
						</a>
					</li>
					<li ';if ($acus[3]=='reserva_banco') {print("class=active");}print'>
						<a href="../reserva_banco/">
							<i class=" icon-credit-card red"></i>
							<span class="menu-text red"> Pago Bancos </span>
						</a>
					</li>

					<li ';if ($acus[3]=='agenda') {print("class=active");}print'>
						<a href="../agenda/">
							<i class="icon-calendar purple"></i>

							<span class="menu-text purple">
								Calendario
								<span class="badge badge-transparent tooltip-error" title="2&nbsp;Eventos&nbsp;Importantes">
									<i class="icon-warning-sign purple bigger-130"></i>
								</span>
							</span>
						</a>
					</li>

					<li ';if ($acus[3]=='reserva') {print("class=active");}print'>
						<a href="../reserva/">
							<i class="icon-building blue"></i>

							<span class="menu-text blue">
								Reservar
								<span class="badge badge-transparent tooltip-error">
									
								</span>
							</span>
						</a>
					</li>

					<li ';if ($acus[3]=='reservacion') {print("class=active");}print'>
						<a href="../reservacion/">
							<i class="icon-check green"></i>
							<span class="menu-text green"> Reservación </span>
						</a>
					</li>
					<li ';if ($acus[3]=='reportes') {print("class=active");}print'>
						<a href="../reportes/">
							<i class="icon-print pink"></i>
							<span class="menu-text pink"> Reportes </span>
						</a>
					</li>
					<li ';if ($acus[3]=='confirmacion') {print("class=active");}print'>
						<a href="../confirmacion/">
							<i class="icon-laptop purple"></i>
							<span class="menu-text purple"> Confirmación </span>
						</a>
					</li>

					<li ';if ($acus[3]=='usuario') {print("class=active");}print'>
						<a href="../usuario/">
							<i class="icon-user orange"></i>
							<span class="menu-text orange"> Usuario </span>
						</a>
					</li>
					<li ';if ($acus[3]=='factura') {print("class=active");}print'>
						<a href="../factura/">
							<i class="icon-book blue"></i>
							<span class="menu-text blue"> Factura </span>
						</a>
					</li>
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
						<a href="../reservacion/">
							<i class="icon-check green"></i>
							<span class="menu-text green"> Reservación </span>
						</a>
					</li>
					<li ';if ($acus[3]=='reserva_banco') {print("class=active");}print'>
						<a href="../reserva_banco/">
							<i class=" icon-credit-card red"></i>
							<span class="menu-text red"> Pago Bancos </span>
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
							Fabrica Imbabura
						</small>
					</a><!--/.brand-->

					<ul class="nav ace-nav pull-right">
						
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
									<a href="#">
										<i class="icon-cog"></i>
										Configurar
									</a>
								</li>

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