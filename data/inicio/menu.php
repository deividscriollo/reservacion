<?php 
//php
function menu(){
	print('<div class="sidebar" id="sidebar">
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					
				</div><!--#sidebar-shortcuts-->

				<ul class="nav nav-list blue">
					<li>
						<a href="../inicio/">
							<i class="icon-desktop pink"></i>
							<span class="menu-text pink"> Escritorio </span>
						</a>
					</li>
					<li>
						<a href="../servicios/">
							<i class="icon-tag blue"></i>
							<span class="menu-text blue"> Servicios </span>
						</a>
					</li>

					<li>
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

					<li>
						<a href="../reservacion/">
							<i class="icon-check green"></i>
							<span class="menu-text green"> Reservación </span>
						</a>
					</li>
				</ul><!--/.nav-list-->
				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left"></i>
				</div>
			</div>');
}
?>