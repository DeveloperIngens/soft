<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">

			<li>

				<a href="inicio">

					<i class="fa fa-home"></i>
					<span>Inicio</span>

				</a>

			</li>

			<?php if($_SESSION["perfil_ingreso"] == "Administrador"): ?>

				<li class="treeview"> 
					<a href="#">
						<i class="fa fa-gears"></i>
						<span>Configurar</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li>
							<a href="usuarios">
								<i class="fa fa-users"></i>
								<span>Usuarios</span>
							</a>
						</li>
						<li>
							<a href="usuarios-perfiles">
								<i class="fa fa-users"></i>
								<span>Usuarios - Perfiles</span>
							</a>
						</li>
					</ul>
				</li>
			
			<?php endif ?>

		</ul>
	 </section>
</aside>