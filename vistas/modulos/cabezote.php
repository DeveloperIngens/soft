 <header class="main-header shadow">
 	
	<!--=====================================
	LOGOTIPO
	======================================-->
	<a href="inicio" class="logo">
		
		<!-- logo mini -->
		<span class="logo-mini"><b>App</b></span>

		<!-- logo normal -->

		<span class="logo-lg"><b>App</b></span>

	</a>

	<!--=====================================
	BARRA DE NAVEGACIÓN
	======================================-->
	<nav class="navbar navbar-static-top" role="navigation">
		
		<!-- Botón de navegación -->

	 	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        	
        	<span class="sr-only">Toggle navigation</span>
      	
      	</a>

		<!-- perfil de usuario -->

		<div class="navbar-custom-menu">
				
			<ul class="nav navbar-nav">

				<li class="dropdown user user-menu">
		            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

						<img src="vistas/img/usuarios/default/anonymous.png" class="user-image">
						<span class="hidden-xs"><?php echo $_SESSION["nombres"]; ?></span>

					</a>
		            <ul class="dropdown-menu">
		              <!-- User image -->
		            	<li class="user-header">
							<img src="vistas/img/usuarios/default/anonymous.png" class="img-circle" alt="User Image">

		                <p>
		                  <?php  echo $_SESSION["nombres"] . " " . $_SESSION["apellidos"]; ?>
		                  <small>Correo: <?php  echo $_SESSION["correo"]; ?></small>	
		                </p>

		              </li>
		              
		              <!-- Menu Footer-->
		              <li class="user-footer">
		                <div class="pull-left">
		                	<button type="button" class="btn btn-primary btn-flat btnEditarUsuarioPropio" Usuario="<?php echo $_SESSION["correo"];?>" data-toggle="modal" data-target="#modalEditarUsuarioPropio"><i class="fas fa-user-edit"></i> Editar</button>
		                  
		                </div>
		                <div class="pull-right">
		                  <a href="salir" class="btn btn-default">Salir</a>
		                </div>
		              </li>
		            </ul>
		          </li>

			</ul>

		</div>

	</nav>

 </header>

 <div id="modalEditarUsuarioPropio" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    	<form role="form" method="post" enctype="multipart/form-data">
	        <div class="modal-header" style="background:#3c8dbc; color:white">

	          <button type="button" class="close" data-dismiss="modal">&times;</button>

	          <h4 class="modal-title">Editar Usuario - <b><?php  echo $_SESSION["nombres"] . " " . $_SESSION["apellidos"]; ?></b></h4>

	        </div>

			<div class="modal-body">

				<div class="box-body">

				<!-- ENTRADA PARA LOS NOMBRES -->
				
				<div class="form-group">
					
					<div class="input-group">
					
					<span class="input-group-addon"><i class="fa fa-user"></i></span> 

					<input type="text" class="form-control input-lg" id="editarNombres" name="editarNombres" value="" onkeyup="mayusculas(this)" required placeholder="Nombres">

					<input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $_SESSION["id_usuario"]; ?>">

					</div>

				</div>

				<!-- ENTRADA PARA LOS APELLIDOS -->
				
				<div class="form-group">
					
					<div class="input-group">
					
					<span class="input-group-addon"><i class="fa fa-user"></i></span> 

					<input type="text" class="form-control input-lg" id="editarApellidos" name="editarApellidos" value="" onkeyup="mayusculas(this)" required placeholder="Apellidos">

					</div>

				</div>

				<!-- ENTRADA PARA LOS APELLIDOS -->
				
				<div class="form-group">
					
					<div class="input-group">
					
					<span class="input-group-addon"><i class="far fa-credit-card"></i></span> 

					<input type="number" class="form-control input-lg" id="editarNumeroIdentificacion" name="editarNumeroIdentificacion" placeholder="Número Identificación"  <?php if($_SESSION["numero_identificacion"] != ""){echo "readonly"; } ?>>

					</div>

				</div>

				<!-- ENTRADA PARA EL CORREO -->

				<div class="form-group">
					
					<div class="input-group">
					
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

					<input type="email" class="form-control input-lg" id="editarCorreo" name="editarCorreo" value="" readonly>

					</div>

				</div>

				<!-- ENTRADA PARA LA CONTRASEÑA -->

				<div class="form-group">
					
					<div class="input-group">
					
					<span class="input-group-addon"><i class="fa fa-lock"></i></span> 

					<input type="password" class="form-control input-lg" name="editarContrasena" placeholder="Escriba la nueva contraseña">

					<input type="hidden" id="contrasenaActual" name="contrasenaActual">

					</div>

				</div>

				</div>

				</div>
	        <div class="modal-footer">

	          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-save"></i> Salir</button>

	          <button type="submit" class="btn btn-success" name="actualizarMiUsuario"><i class="fas fa-save"></i> Actualizar Datos</button>

	        </div>

		     <?php

 			if(isset($_POST["actualizarMiUsuario"])){

				$editarUsuario = new ControladorUsuarios();
				$editarUsuario -> ctrEditarUsuarioPropio();

			}

	        ?> 
    	</form>
      
    </div>

  </div>
</div>

<script type="text/javascript">
  $("document").ready(function () {


  
  });
</script>