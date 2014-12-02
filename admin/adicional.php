<?Php
if(!isset($_SESSION))
	{
		session_start();
	}

//::::Por Deivid Criollo::::\\
//::::Adjuncion compacta::::\\
function titulo(){
	print'Quesinor - Admin';
}
//::::Cabecera Menu::::\\
function cabecera_menu(){
//print 'Desarrollado por Deivid';
	print('<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a href="#" class="brand">
					<small>
						<i ><img src="../assets/img/logo.fw.png" width="4%"></i>
						Quesinor - '.$_SESSION["cat_usuario"].' Perfil: '.$_SESSION["nombre_usuario"].'
					</small>
				</a><!--/.brand-->

				<ul class="nav ace-nav pull-right">		
					<li class="light-blue">
						<a data-toggle="dropdown" href="#" class="dropdown-toggle">							
							<span class="user-info">
								<small> '.$_SESSION["usuario"].'</small>
								Bienvenido
							</span>

							<i class="icon-caret-down"></i>
						</a>

						<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
							<li>
								<a href="#">
									<i class="icon-cog"></i>
									Configuracion de la cuenta
								</a>
							</li>

							<li>
								<a href="#">
									<i class="icon-user"></i>
									Perfil
								</a>
							</li>

							<li class="divider"></li>

							<li>
								<a href="../acceso/close.php">
									<i class="icon-off"></i>
									Cerrar Session
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	');
}

//::::FUNCION MENU lateral:::
function menu_lateral(){
	print'
	<a class="menu-toggler" id="menu-toggler" href="#">
			<span class="menu-text"></span>
		</a>
	<div class="sidebar" id="sidebar">
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-small btn-success">
							<i class="icon-signal"></i>
						</button>

						<button class="btn btn-small btn-info">
							<i class="icon-pencil"></i>
						</button>

						<button class="btn btn-small btn-warning">
							<i class="icon-group"></i>
						</button>

						<button class="btn btn-small btn-danger">
							<i class="icon-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!--#sidebar-shortcuts-->

				<ul class="nav nav-list">
					<li class="active">
						<a href="../principal/index.php">
							<i class="icon-dashboard"></i>
							<span class="menu-text"> Principal </span>
						</a>
					</li>

					<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-desktop"></i>
							<span class="menu-text"> Parametros </span>
							<b class="arrow icon-angle-down"></b>
						</a>
						<ul class="submenu">
							<li>
								<a href="../empresa/nuevo.php">
									<i class="icon-double-angle-right"></i>
									Empresa
								</a>
							</li>
							<li>
								<a href="../acceso/nuevo.php">									
									<span class="menu-text"> Usuario </span>
								</a>
							</li>
							<li>
								<a href="../basico/nuevo.php">									
									<span class="menu-text">Basico</span>
								</a>
							</li>						
						</ul>
					</li>	
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-edit"></i>
							<span class="menu-text"> Inventario </span>
							<b class="arrow icon-angle-down"></b>
						</a>
						<ul class="submenu">
							<li>
								<a href="../inventario_empresa/mostrar.php">
									<i class="icon-double-angle-right"></i>
									Materia Empresa
								</a>
							</li>
							<li>
								<a href="../inventario_proveedor/mostrar.php">
									<i class="icon-double-angle-right"></i>
									Materia Prima
								</a>
							</li>							
						</ul>
					</li>
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-edit"></i>
							<span class="menu-text"> Facturación </span>
							<b class="arrow icon-angle-down"></b>
						</a>
						<ul class="submenu">
							<li>
								<a href="../factura_compra/factura_compra.php">
									<i class="icon-double-angle-right"></i>
									Factura Compra
								</a>
							</li>
							<li>
								<a href="../factura_compra/mostrar.php">
									<i class="icon-double-angle-right"></i>
									Mostrar F. Compra
								</a>
							</li>

							<li>
								<a href="../factura_venta/factura_venta.php">
									<i class="icon-double-angle-right"></i>
									Factura Venta
								</a>
							</li>
							<li>
								<a href="../factura_venta/mostrar.php">
									<i class="icon-double-angle-right"></i>
									Mostrar F. Venta
								</a>
							</li>
						</ul>
					</li>

					<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-list-alt"></i>
							<span class="menu-text"> Roles</span>
							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href="../rol_pago/index.php">
									<i class="icon-double-angle-right"></i>
									Personal
								</a>
							</li>
							<li>
								<a href="../rol_pago/rol.php">
									<i class="icon-double-angle-right"></i>
									Rol
								</a>
							</li>
							<li>
								<a href="../rol_pago/control.php">
									<i class="icon-double-angle-right"></i>
									Asistencias
								</a>
							</li>
							
						</ul>
					</li>					
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-fire"></i>
							<span class="menu-text"> Clientes </span>
							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href="../cliente/cliente.php">
									<i class="icon-double-angle-right"></i>
									Clientes
								</a>
							</li>							
						</ul>
					</li>
					<li>
						<a href="#" class="dropdown-toggle">
							<i class=" icon-bar-chart"></i>
							<span class="menu-text"> Proveedores </span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href="../proveedor/proveedor.php">
									<i class="icon-double-angle-right"></i>
									Proveedor
								</a>
							</li>
							<li>
								<a href="../producto_compra/nuevo.php">
									<i class="icon-double-angle-right"></i>
									Producto
								</a>
							</li>							
						</ul>
					</li>
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-laptop"></i>
							<span class="menu-text"> Contabilidad </span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href="../plan_cuenta/plan_cuentas.php">
									<i class="icon-double-angle-right"></i>
									Plan de Cuentas
								</a>
							</li>

							<li>
								<a href="proveedor.php">
									<i class="icon-double-angle-right"></i>
									otros
								</a>
							</li>
						</ul>
					</li>
					
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-credit-card"></i>
							<span class="menu-text"> Cuentas </span>
							<b class="arrow icon-angle-down"></b>
						</a>
						<ul class="submenu">
							<li>
								<a href="../cuentasxcobrar/index.php">
									<i class="icon-double-angle-right"></i>
									X Cobrar
								</a>
							</li>
							
							<li>
								<a href="../cobrarcuenta/index.php">
									<i class="icon-double-angle-right"></i>
									Cobrar Cuenta
								</a>
							</li>

							<li>
								<a href="../cuentasxpagar/index.php">
									<i class="icon-double-angle-right"></i>
									X Pagar
								</a>
							</li>

							<li>
								<a href="../pagarcuenta/index.php">
									<i class="icon-double-angle-right"></i>
									Pagar Cuenta
								</a>
							</li>
							
						</ul>
					</li>
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-credit-card"></i>
							<span class="menu-text"> Productos </span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href="../subir_productos/subir.php">
									<i class="icon-double-angle-right"></i>
									Subir Productos
								</a>
							</li>

							<li>
								<a href="../bajar_productos/bajar.php">
									<i class="icon-double-angle-right"></i>
									Dar De Baja 
								</a>
							</li>
							<li>
								<a href="../producto_empresa/nuevo.php">
									<i class="icon-double-angle-right"></i>
									Crear Producto
								</a>
							</li>
						</ul>
					</li>

					
				</ul><!--/.nav-list-->

				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left"></i>
				</div>
			</div>';
}

?>