<?php

class ControladorUsuarios{

	/*=============================================
	ACTUALIZAR CONTRASEÑA DESPUES DE VERFICACION
	=============================================*/
	static public function ctrActualizarContrasena($idUsuario, $contrasenaNueva){

		$tabla = "usuarios";

		$encriptar = crypt($contrasenaNueva, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

		$respuesta = ModeloUsuarios::mdlActualizarContrasena($tabla, $idUsuario, $encriptar);

		return $respuesta;

	}

	/*=============================================
	VALIDAR CODIGO VERIFICACION
	=============================================*/
	static public function ctrValidarCodigoVerificacion($idUsuario, $codigoVerificacion){

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlValidarCodigoVerificacion($tabla, $idUsuario, $codigoVerificacion);

		return $respuesta;

	}

	/*=============================================
	GUARDAR CODIGO CONTRASENIA
	=============================================*/
	static public function ctrGuardarCodigoContrasena($correo, $codigoContrasena){

		$item = "correo";
		$valor = $correo;

		$infoUsuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

		$tabla = "usuarios";
		$idUsuario = $infoUsuario["id_usuario"];

		$respuesta = ModeloUsuarios::mdlGuardarCodigoContrasena($tabla, $idUsuario, $codigoContrasena);

		return $respuesta;

	}


	/*=============================================
	INGRESO DE USUARIO
	=============================================*/
	static public function ctrIngresoUsuario(){

		if(isset($_POST["ingUsuario"])){

			if(preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $_POST["ingUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

			   	$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "usuarios";

				$item = "correo";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

				if(!empty($respuesta)){

					if($respuesta["correo"] == $_POST["ingUsuario"] && $respuesta["contrasena"] == $encriptar){

						if($respuesta["estado"] == 1){

							$_SESSION["iniciarSesion"] = "ok";
							$_SESSION["id_usuario"] = $respuesta["id_usuario"];
							$_SESSION["correo"] = $respuesta["correo"];
							$_SESSION["nombres"] = $respuesta["nombres"];
							$_SESSION["apellidos"] = $respuesta["apellidos"];
							$_SESSION["metodo_registro"] = $respuesta["metodo_registro"];
							$_SESSION["perfil_ingreso"] = $respuesta["perfil_ingreso"];
							$_SESSION["numero_identificacion"] = $respuesta["numero_identificacion"];
							$_SESSION["permiso_software"] = "";
							$_SESSION["rol_software"] = "";
							$_SESSION["obtiene_permiso"] = "";

							/*============================
							SI EL USUARIO EN EL METODO REGISTRO ES WEB SE LE ASIGNARA SOLO PERMISO PARA ACCEDER A HV
							============================*/
							if($_SESSION["metodo_registro"] == "Web"){

								$tablaPerfil = "perfiles_usuarios";

								$idPerfil = 1;
								$idPermiso = 1;
								$idUsuario = $_SESSION["id_usuario"];

								//COMPROBAMOS QUE NO TENGA EL MISMO ROL CREADO DOS VECES
								$validacion = ModeloPerfilesUsuarios::mdlValidarPerfiles($tablaPerfil, $idUsuario, $idPerfil);

								if(count($validacion) < 1){

									$datosPerfil = array(
										"id_perfil" => $idPerfil,
										"id_usuario" => $idUsuario,
										"id_permiso" => $idPermiso
									);
		
									$perfil = ModeloPerfilesUsuarios::mdlCrearPerfilUsuario($tablaPerfil, $datosPerfil);

								}

							}

							/*=============================================
							REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
							=============================================*/
							date_default_timezone_set('America/Bogota');

							$fecha = date('Y-m-d');
							$hora = date('H:i:s');

							$fechaActual = $fecha.' '.$hora;

							$item1 = "ultima_conexion";
							$valor1 = $fechaActual;

							$item2 = "id_usuario";
							$valor2 = $respuesta["id_usuario"];

							$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

							if($ultimoLogin == "ok"){

								echo '<script>

									window.location = "inicio";

								</script>';


							}
							
						}else{

							echo '<br>
								<div class="alert alert-danger">El usuario aún no está activado</div>';

						}		

					}else{

						echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';

					}

				}else{

					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';

				}

			}

		}

	}

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/
	static public function ctrCrearUsuario(){

		if(	preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombres"]) &&
			preg_match('/^[aa-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["apellidos"]) &&
			preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $_POST["correo"]) &&
			preg_match('/^[a-zA-Z0-9]+$/', $_POST["contrasena"]) &&
			preg_match('/^[0-9]+$/', $_POST["numeroIdentficacion"])){


			
			$tabla = "usuarios";

			$encriptar = crypt($_POST["contrasena"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			$datos = array("nombres" => $_POST["nombres"],
							"apellidos" => $_POST["apellidos"],
							"correo" => $_POST["correo"],
							"contrasena" => $encriptar,
							"numero_identificacion" => $_POST["numeroIdentficacion"],
							"metodo_registro" => "Web",
							"perfil_ingreso" => "Consulta");

			$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

			if($respuesta == "ok"){


				echo '<script>

				swal({

					type: "success",
					title: "¡El usuario ha sido guardado correctamente, por favor Inicie Sesion con los datos almacenados!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "login";

					}

				});
			

				</script>';


			}


		}else{

			echo '<script>

				swal({

					type: "error",
					title: "¡Los Nombres y Apellidos no puede ir vacío o llevar caracteres especiales, o el Número de Identificación no debe contener letras!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "registro";

					}

				});
			

			</script>';

		}


	}

	/*=============================================
	REGISTRO DE USUARIO DENTRO DEL SOFT INTERNO
	=============================================*/
	static public function ctrCrearUsuarioIn(){

		if(	preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			preg_match('/^[aa-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApellido"]) &&
			preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $_POST["nuevoCorreo"]) &&
			preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoContrasena"]) &&
			preg_match('/^[0-9]+$/', $_POST["nuevoNumeroIdentificacion"])){
			
			$tabla = "usuarios";

			$encriptar = crypt($_POST["nuevoContrasena"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			$datos = array("nombres" => $_POST["nuevoNombre"],
							"apellidos" => $_POST["nuevoApellido"],
							"correo" => $_POST["nuevoCorreo"],
							"contrasena" => $encriptar,
							"metodo_registro" => "WebIn",
							"numero_identificacion" => $_POST["nuevoNumeroIdentificacion"],
							"perfil_ingreso" => $_POST["nuevoPerfil"]);

			$respuesta = ModeloUsuarios::mdlIngresarUsuarioIn($tabla, $datos);

			if($respuesta == "ok"){


				echo '<script>

				swal({

					type: "success",
					title: "¡El Usuario ha sido guardado correctamente!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "inicio";

					}

				});
			

				</script>';


			}


		}else{

			echo '<script>

				swal({

					type: "error",
					title: "¡El Nombre, Apellido no puede ir vacío o llevar caracteres especiales o el Número de Identificación no debe contener letras.!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "inicio";

					}

				});
			

			</script>';

		}


	}

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/
	static public function ctrMostrarUsuarios($item, $valor){

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/
	static public function ctrEditarUsuario(){

		if(isset($_POST["editarCorreoAdmin"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombresAdmin"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApellidosAdmin"])){

				$tabla = "usuarios";

				if($_POST["editarContrasenaAdmin"] != ""){

					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarContrasenaAdmin"])){

						$encriptar = crypt($_POST["editarContrasenaAdmin"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					}else{

						echo'<script>

								swal({
									  type: "error",
									  title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result){
										if (result.value) {

										window.location = "usuarios";

										}
									})

						  	</script>';

					}

				}else{

					$encriptar = $_POST["contrasenaActualEditarAdmin"];

				}

				$datos = array("nombres" => $_POST["editarNombresAdmin"],
							   "apellidos" => $_POST["editarApellidosAdmin"],
							   "correo"=> $_POST["editarCorreoAdmin"],
							   "contrasena" => $encriptar,
							   "id_usuario" => $_POST["idUsuarioEditarAdmin"],
							   "perfil_ingreso" => $_POST["editarPerfilAdmin"]);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Usuario ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "usuarios";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "usuarios";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/
	static public function ctrBorrarUsuario(){

		if(isset($_GET["idUsuario"])){

			$tabla ="usuarios";
			$datos = $_GET["idUsuario"];

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El usuario ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "usuarios";

								}
							})

				</script>';

			}		

		}

	}

	/*=============================================
	MOSTRAR USUARIO PROPIO
	=============================================*/
	static public function ctrMostrarUsuariosPropio($item, $valor){

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::MdlMostrarUsuariosPropio($tabla, $item, $valor);

		return $respuesta;
	}


	/*=============================================
	EDITAR USUARIO PROPIO
	=============================================*/
	static public function ctrEditarUsuarioPropio(){

		if(isset($_POST["actualizarMiUsuario"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombres"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApellidos"]) &&
				preg_match('/^[0-9 ]+$/', $_POST["editarNumeroIdentificacion"])){

				$tabla = "usuarios";

				if($_POST["editarContrasena"] != ""){

					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarContrasena"])){

						$encriptar = crypt($_POST["editarContrasena"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					}else{

						echo'<script>

								swal({
									  type: "error",
									  title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result){
										if (result.value) {

										window.location = "inicio";

										}
									})

						  	</script>';

					}

				}else{

					$encriptar = $_POST["contrasenaActual"];

				}

				$datos = array("nombres" => $_POST["editarNombres"],
							   "apellidos" => $_POST["editarApellidos"],
							   "correo" => $_POST["editarCorreo"],
							   "contrasena" => $encriptar,
							   "id_usuario" => $_POST["idUsuario"],
							   "numero_identificacion" => $_POST["editarNumeroIdentificacion"]);

				$respuesta = ModeloUsuarios::mdlEditarUsuarioPropio($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Ha editado su datos correctamente.",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

										window.location = "salir";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

						

							}
						})

			  	</script>';

			}

		}

	}

	static public function ctrMostrarPerfiles(){

		$tabla = "usuarios_perfiles";

		$respuesta = ModeloUsuarios::MdlMostrarPerfiles($tabla);

		return $respuesta;
	}

}
	


