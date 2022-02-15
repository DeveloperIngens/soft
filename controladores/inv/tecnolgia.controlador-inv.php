<?php

class ControladorTecnologia{

	/*=========================
	DESCARGAR INFORMACION DE LOS ACTIVOS
	=========================*/
	static public function ctrGenerarReporteInformacionActivos(){

		$tabla = "tecnologia";

		$respuesta = ModeloTecnologia::mdlGenerarReporteInformacionActivos($tabla);

		return $respuesta;

	}

	/*=========================
	ASIGNAR RESPONSABLE ACTIVO
	=========================*/
	static public function ctrAsignarResponsableActivo(){

		if(isset($_POST["GuardarAsignacion"])){

			foreach ($_FILES["nuevoPdfEntregaEquipo"]["type"] as $key => $tipo) {

				$mimeArchivo = $tipo;

			}

			if($mimeArchivo == "application/pdf"){

				foreach ($_FILES["nuevoPdfEntregaEquipo"]["tmp_name"] as $key => $tmp_name) {
					
					if($_FILES["nuevoPdfEntregaEquipo"]["name"][$key]){

						$numeroAleatorio = rand(100000, 99999999999999);;

                        $filename = $numeroAleatorio . "-" . $_FILES["nuevoPdfEntregaEquipo"]["name"]["$key"];
                        $source = $_FILES["nuevoPdfEntregaEquipo"]["tmp_name"][$key];

						$directorio = '../archivos_soft/Archivos/Inventario/EntregasEquipos/';

						if(!file_exists($directorio)){

							mkdir($directorio, 0777, true) or die("Fallo creacion carpeta");

						}

						$dir = opendir($directorio);
						$target_path = $directorio.$filename;

						if(move_uploaded_file($source, $target_path)){

							$resultadoArchivo = "ok";

						}else{

							$resultadoArchivo = "error";

						}

						closedir($dir);


						$tabla = "tecnologia";

						$datos = array(

							"id_activos" => $_POST["idActivoAsignacion"],
							"id_responsable" => $_POST["nuevoResposableActivoAsignacion"],
							"pdf_entrega_equipo" => $target_path,
							"estado" => "1"

						);

						$respuesta = ModeloTecnologia::mdlAsignarResponsableActivo($tabla, $datos);

						if($respuesta == "ok"){

							echo "<script>

								swal({

									type: 'success',
									title: '!La Asignacion al Activo fue realizada correctamente!',
									showConfirmButton: true,
									confirmButtonText: 'Cerrar'

								}).then(function(result){

									if(result.value){
									
										window.location = 'tecnologia-inv';

									}

								});
						

							</script>";


						}


					}

				}


			}else{
				
				echo "<script>

					swal({

						type: 'error',
						title: '¡El formato del archivo no es valido, recuerde que debe ser en formato .PDF!',
						showConfirmButton: true,
						confirmButtonText: 'Cerrar'

					}).then(function(result){

						if(result.value){
						
							window.location = 'datos-personales-hv';

						}

					});

				</script>";

			}

		}else{

			echo '<script>

				swal({

					type: "error",
					title: "¡Algo salio mal, por favor vuelve a intentarlo!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "tecnologia-inv";

					}

				});
			

			</script>';

		}

	}

	/*=========================
	QUITAR ASIGNACION RESPONSABLE ACTIVO
	=========================*/
	static public function ctrQuitarAsignacionActivo($item, $valor){

		$tabla = "tecnologia";

		$respuesta = ModeloTecnologia::mdlQuitarAsignacionActivo($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	REGISTRO DE ACTIVOS
	=============================================*/
	static public function ctrCrearTecnologia(){

		if(isset($_POST["GuardarActivo"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNumeroPuestoActivo"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaClasificacionActivo"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaMarcaActivo"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNumeroPlacaActivo"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoSerialActivo"])&&
	  			preg_match('/^[=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nuevaObservacionActivo"])){ 
	   
				$tabla = "tecnologia";

				$datos = array(
					"ubicacion" => $_POST["nuevaUbicacionActivo"],
					"proyecto" => $_POST["nuevoProyectoActivo"],
					"numero_puesto" => $_POST["nuevoNumeroPuestoActivo"],
					"punto_red" => $_POST["nuevoPuntoRedActivo"],
					"categoria" => $_POST["nuevaCategoriaActivo"], 
					"clasificacion" => $_POST["nuevaClasificacionActivo"],
					"marca" => $_POST["nuevaMarcaActivo"],
					"numero_placa" => $_POST["nuevoNumeroPlacaActivo"],
					"serial" => $_POST["nuevoSerialActivo"],
					"estado_activo" => $_POST["nuevoEstadoActivo"],
					"fecha_adquisicion" => $_POST["nuevaFechaAdquisicionActivo"],
					"cuenta_contable" => $_POST["nuevaCuentaContableActivo"],
					"valor_compra" => $_POST["nuevoValorCompraActivo"],
					"valor_comercial" => $_POST["nuevoValorComercialActivo"],
					"observaciones" => $_POST["nuevaObservacionActivo"],
					"id_usuario_creacion"=> $_SESSION["id_usuario"],
					"metodo_adquisicion_activo" => $_POST["nuevoMetodoAdquisicionActivo"],
					"centro_costos_activo" => $_POST["nuevoCentroCostos"]
				);
					       		
					
				$respuesta = ModeloTecnologia::mdlIngresarTecnologia($tabla, $datos);

				var_dump($respuesta);

				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El Activo ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "tecnologia-inv";

						}

					});
				

					</script>';


				}


			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El Activo no puede ir vacío o contener caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "tecnologia-inv";

						}

					});
				

				</script>';

			}

		}else{

			echo '<script>

				swal({

					type: "error",
					title: "¡Algo salio mal, por favor vuelve a intentarlo!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "tecnologia-inv";

					}

				});
			

			</script>';

		}
	
	}

	/*=============================================
	MOSTRAR ACTIVO
	=============================================*/
	static public function ctrMostrarTecnologia($item , $valor , $perfil){
		
		$tabla = "tecnologia";
		//$tabla1 ="par_categoria";
		//$tabla3 ="par_ubicacion";
		//$tabla4 ="par_proyecto";

		$respuesta = ModeloTecnologia::MdlMostrarTecnologia($tabla,$item,$valor,$perfil);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR CATEGORIA
	=============================================*/
	static public function ctrMostrarParametricas($item , $valor , $perfil){
		
		$tabla = "par_categoria";

		$respuesta = ModeloTecnologia::MdlMostrarCategoria($tabla,$item,$valor,$perfil);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR UBICACION
	=============================================*/
	static public function ctrMostarUbicacion($item , $valor , $perfil){
		
		$tabla = "par_ubicacion";

		$respuesta = ModeloTecnologia::MdlMostrarCategoria($tabla,$item,$valor,$perfil);

		return $respuesta;

	}
	
	/*=============================================
	MOSTRAR PROYECTO
	=============================================*/
	static public function ctrMostrarProyecto($item , $valor , $perfil){
		
		$tabla = "par_proyecto";

		$respuesta = ModeloTecnologia::MdlMostrarProyecto($tabla,$item,$valor,$perfil);

		return $respuesta;

	}


	/*=============================================
	EDITAR ACTIVO
	=============================================*/
	static public function ctrEditarTecnologia(){

		if(isset($_POST["EditarActivo"])){

			if(preg_match('/^[=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNumeroPuestoActivoEditar"])&&
				preg_match('/^[=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaClasificacionActivoEditar"])&&
				preg_match('/^[=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaMarcaActivoEditar"])&&
				preg_match('/^[=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNumeroPlacaActivoEditar"])&&
				preg_match('/^[=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoSerialActivoEditar"])&&
			  	preg_match('/^[=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nuevaObservacionActivoEditar"])){

				if(isset($_POST["nuevoResposableActivoEditar"]) && $_POST["nuevoResposableActivoEditar"] != ""){

					$idResponsable = $_POST["nuevoResposableActivoEditar"];

				}else{

					if($_POST["responsableAsignadoEditar"] == "No tiene Responsable Asignado al Activo."){

						$idResponsable = null;

					}else{

						$idResponsable = $_POST["responsableAsignadoEditar"];


					}

				}

				
				$tabla = "tecnologia";

				$datos = array(

					"ubicacion" => $_POST["nuevaUbicacionActivoEditar"],
					"proyecto" => $_POST["nuevoProyectoActivoEditar"],
					"numero_puesto" => $_POST["nuevoNumeroPuestoActivoEditar"],
					"punto_red" => $_POST["nuevoPuntoRedActivoEditar"],
					"id_responsable" => $idResponsable, 
					"categoria" => $_POST["nuevaCategoriaActivoEditar"], 
					"clasificacion" => $_POST["nuevaClasificacionActivoEditar"],
					"marca" => $_POST["nuevaMarcaActivoEditar"],
					"numero_placa" => $_POST["nuevoNumeroPlacaActivoEditar"],
					"serial" => $_POST["nuevoSerialActivoEditar"],
					"estado_activo" => $_POST["nuevoEstadoActivoEditar"],
					"fecha_adquisicion" => $_POST["nuevaFechaAdquisicionActivoEditar"],
					"cuenta_contable" => $_POST["nuevaCuentaContableActivoEditar"],
					"valor_compra" => $_POST["nuevoValorCompraActivoEditar"],
					"valor_comercial" => $_POST["nuevoValorComercialActivoEditar"],
					"observaciones" => $_POST["nuevaObservacionActivoEditar"],
					"id_activos" => $_POST["idActivoEditar"],
					"metodo_adquisicion_activo" => $_POST["nuevoMetodoAdquisicionActivoEditar"],
					"centro_costos_activo" => $_POST["nuevoCentroCostosEditar"]

				);

				$actulizarActivo = ModeloTecnologia::mdlEditarTecnologia($tabla, $datos);

				if($actulizarActivo == "ok"){

					echo '<script>

						swal({

							type: "success",
							title: "¡El Activo ha sido guardado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "tecnologia-inv";

							}

						});
				

					</script>';

				}


			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El Activo no puede ir vacío o contener caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "tecnologia-inv";

						}

					});
				

				</script>';

			}


		}else{

			echo '<script>

				swal({

					type: "error",
					title: "¡Algo salio mal, por favor vuelve a intentarlo!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "tecnologia-inv";

					}

				});
			

			</script>';

		}
				
	
	}	


    /*=============================================
	BORRAR ACTIVO
	=============================================*/

	static public function ctrBorrarTecnologia(){

		if(isset($_GET["IdActivos"])){

			$tabla ="tecnologia";

			$datos = $_GET["IdActivos"];

			$respuesta = ModeloTecnologia::mdlBorrarTecnologia($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El activo ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "tecnologia-inv";

								}
							})

				</script>';

			}		

		}
	}

	/*=============================================
	OBTENER DATO REQUERIDO TABLA
	=============================================*/
	static public function ctrObternerDatoRequerido($tabla, $item , $valor){
		
		$respuesta = ModeloTecnologia::mdlObternerDatoRequerido($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	OBTENER DATOS REQUERIDOS TABLAS
	=============================================*/
	static public function ctrObtenerDatosRequeridosAll($tabla, $item, $valor){

		$respuesta = ModeloTecnologia::mdlObtenerDatosRequeridosAll($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	ACTUALIZAR ESTADO ACTIVO
	=============================================*/
	static public function ctrActualizarEstadoActivo(){

		if(isset($_POST["cambiarEstadoActivo"])){

			$tabla = "tecnologia";

			$datos = array(

				"id_activos" => $_POST["idActivoCambioEstado"],
				"estado_activo" => $_POST["nuevoEstadoActivo"]

			);

			$actualizarEstadoActivo = ModeloTecnologia::mdlActualizarEstadoActivo($tabla, $datos);

			if($actualizarEstadoActivo == "ok"){

				echo '<script>

					swal({

						type: "success",
						title: "¡El Activo ha sido actualizado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						window.location = "tecnologia-inv";

					});
				

				</script>';

			}

			
		}else{

			echo '<script>

				swal({

					type: "error",
					title: "¡Algo salio mal, por favor vuelve a intentarlo!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "tecnologia-inv";

					}

				});
			

			</script>';

		}

	}

}