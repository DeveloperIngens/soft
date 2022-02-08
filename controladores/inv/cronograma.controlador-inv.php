<?php  

class ControladorCronograma{

	/*=============================================
	REALIZAR MANTENIMIENTO PROGRAMADO
	=============================================*/
	static public function ctrRealizarMantenimientoProgramado(){

		if(isset($_POST["realizarMantenimientoProgramado"])){

			if(preg_match('/^[=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nuevoObservacionesMantenimientoProgramado"])){

				$cadena = '';

				if(!empty($_POST["nuevoManteninimientoPreventivo"])){

					foreach ($_POST["nuevoManteninimientoPreventivo"] as $key => $value) {

						$cadena .=  $value .",";
							
					}

				}

				$cadena2 ='';


				if(!empty($_POST["nuevoManteninimientoCorrectivo"])){

					foreach ($_POST["nuevoManteninimientoCorrectivo"] as $key2 => $value2) {

						$cadena2 .= $value2 .",";
					}

				}

				$cadenaMezcla = $cadena.$cadena2;

				$cadenaFinal = substr($cadenaMezcla, 0, -1);

				$tabla = "mantenimiento";
				
				$datos = array(
					"id_calendario" => $_POST["idCalendarioMantenimiento"],
					"id_activo" => $_POST["idActivoMantenimiento"],
					"responsable" => $_POST["nuevoResponsableMantenimientoVer"],
					"fecha_mante" => $_POST["fechaMantenimientoRealizadoVer"],
					"mantenimiento"=>$cadenaFinal,
					"prox_mante"=>$_POST["fechaProximoMantenimiento"],
					"observaciones"=>$_POST["nuevoObservacionesMantenimientoProgramado"],
					"placa" => $_POST["numeroPlacaMantenimiento"],	
					"serial" => $_POST["numeroSerialMantenimiento"],
					"color"=>$_POST["colorEventoMantenimiento"],
					"estado_mantenimiento" => "Realizado"
				);

				$fechaProxMante = date("Y-m-d",strtotime($_POST["fechaProximoMantenimiento"]."+ 6 month"));


				$datos2= array(

					"fecha_mante" => $_POST["fechaProximoMantenimiento"],
					"prox_mante" => $fechaProxMante,
					"placa" => $_POST["numeroPlacaMantenimiento"],
					"serial" => $_POST["numeroSerialMantenimiento"],
					"color" => $_POST["colorEventoMantenimiento"],
					"id_usuario_creacion" => $_SESSION["id_usuario"],
					"id_activo" => $_POST["idActivoMantenimiento"],
					"estado_mantenimiento" => "Pendiente"
					
				);

				$respuesta = ModeloCronograma::mdlRealizarMantenimientoProgramado($tabla , $datos , $datos2);

				if($respuesta == "ok"){
				

					echo '<script>

					swal({

						type: "success",
						title: "¡El Mantenimiento ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "mantenimiento-inv";

						}

					});
				

					</script>';

				}



			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡Las Observaciones del Mantenimiento no pueden contener caracteres especiales, por favor vuelve a intentarlo!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "mantenimiento-inv";

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
					
						window.location = "mantenimiento-inv";

					}

				});
			

			</script>';

		}

	}


	/*=============================================
	CREAR MANTENIMIENTOS
	=============================================*/
	static public function ctrCrearMantenimiento(){

		if(isset($_POST["nuevoResponsableMantenimiento"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoResponsableMantenimiento"]) &&
				preg_match('/^[=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nuevaObservacionesMantenimiento"])){

				$cadena = '';	

				foreach ($_POST["nuevoManteninimientoPreventivo"] as $key => $value) {

					$cadena .=  $value .",";
						
				}

				$cadena2 ='';

				foreach ($_POST["nuevoManteninimientoCorrectivo"] as $key2 => $value2) {

					$cadena2 .= $value2 .",";
				}

				$cadenaMezcla = $cadena.$cadena2;

				$cadenaFinal = substr($cadenaMezcla, 0, -1);

				$tabla = "mantenimiento";
				
				$datos = array(
					"id_activo" => $_POST["mantenimientoIdActivo"],
					"responsable" => $_POST["nuevoResponsableMantenimiento"],
					"fecha_mante" => $_POST["fechaMantenimientoRealizado"],
					"mantenimiento"=>$cadenaFinal,
					"prox_mante"=>$_POST["fechaProximoMantenimiento"],
					"observaciones"=>$_POST["nuevaObservacionesMantenimiento"],
					"placa" => $_POST["numeroPlacaMantenimiento"],	
					"serial" => $_POST["numeroSerialMantenimiento"],
					"color"=>$_POST["nuevoColorMantenimiento"],
					"id_usuario_creacion" => $_SESSION["id_usuario"],
					"estado_mantenimiento" => "Realizado");

				$fechaProxMante = date("Y-m-d",strtotime($_POST["fechaProximoMantenimiento"]."+ 6 month"));


				$datos2= array(

					"fecha_mante" => $_POST["fechaProximoMantenimiento"],
					"prox_mante" => $fechaProxMante,
					"placa" => $_POST["numeroPlacaMantenimiento"],
					"serial" => $_POST["numeroSerialMantenimiento"],
					"color" => $_POST["nuevoColorMantenimiento"],
					"id_usuario_creacion" => $_SESSION["id_usuario"],
					"id_activo" => $_POST["mantenimientoIdActivo"],
					"estado_mantenimiento" => "Pendiente"
					
				);

					
				$respuesta = ModeloCronograma::mdlIngresarCronograma($tabla , $datos , $datos2);

				if($respuesta == "ok"){
				

					echo '<script>

					swal({

						type: "success",
						title: "¡El Mantenimiento ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "mantenimiento-inv";

						}

					});
				

					</script>';

				}

			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡Las Observaciones del Mantenimiento no pueden contener caracteres especiales, por favor vuelve a intentarlo!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "mantenimiento-inv";

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
	FECHAS DE MANTENIMIENTOS	
	=============================================*/
	static public function CtrProximoMantenimiento($fecha_mante,$serial,$placa){

		$tabla="mantenimiento";

		$datos=array('prox_mante'=>$fecha_mante,
					'placa'=>$placa,
					'serial'=>$serial);

		$respuesta =ModeloCronograma::MdlProximos( $tabla, $fecha_mante,$serial,$placa);
		
	}

/*--------------------------------------
	EDITAR MANTENIMIENTOS 
	---------------------------*/
	static public function CtrEditarMantenimiento(){

		if(isset($_POST["editarMantenimiento"])){

			if(preg_match('/^[=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["editarObservacionesMantenimiento"])){ 

				$cadena = '';

				if(!empty($_POST["nuevoManteninimientoPreventivo"])){

					foreach ($_POST["nuevoManteninimientoPreventivo"] as $key => $value) {

						$cadena .=  $value .",";
							
					}

				}

				$cadena2 ='';


				if(!empty($_POST["nuevoManteninimientoCorrectivo"])){

					foreach ($_POST["nuevoManteninimientoCorrectivo"] as $key2 => $value2) {

						$cadena2 .= $value2 .",";
					}

				}

				$cadenaMezcla = $cadena.$cadena2;

				$cadenaFinal = substr($cadenaMezcla, 0, -1);


				$tabla = "mantenimiento";
				
				$datos = array(

					"mantenimiento" => $cadenaFinal,
					"observaciones" => $_POST["editarObservacionesMantenimiento"],
					"id_calendario" => $_POST["idCalendarioMantenimientoEditar"]

				);

				$respuesta = ModeloCronograma::MdlEditarMante($tabla , $datos);			

				if($respuesta == "ok"){
				

					echo '<script>

					swal({

						type: "success",
						title: "¡El Mantenimiento ha sido actualizado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "mantenimiento-inv";

						}

					});
				

					</script>';

				}

			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El Mantenimiento no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "mantenimiento-inv";

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
		CREAR MANTENIMIENTO DESDE ELCALENDARIO
	=============================================*/

	static public function CtrEditarMantenimineto(){

		if(isset($_POST["editarresponsable"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarresponsable"])&&
			 	preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarprox_mante"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNumeroplacas"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarobservaciones"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarcolor"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarSerialx"])){ 

				$cadena='';

				foreach ($_POST["editarMantenimiento"] as $key => $value) {

					$cadena .= $value .",";
						
				}
			   
				$tabla = "mantenimiento";
				
				$datos = array("responsable" => $_POST["editarresponsable"],
								"fecha_mante" => $_POST["editarfecha_mant"],
								"mantenimiento"=>$cadena,
								"prox_mante"=>$_POST["editarprox_mante"],
								"observaciones"=>$_POST["editarobservaciones"],
								"placa" => $_POST["editarNumeroplacas"],	
					       		"serial" => $_POST["editarSerialx"],
					       		"color"=>$_POST["editarcolor"],					       		
					       		"id_calendario"=>$_POST["EditarCalendario"]);

				$respuesta = ModeloCronograma::MdlEditarMantenimientos($tabla , $datos );			

				if($respuesta == "ok"){
				

					echo '<script>

					swal({

						type: "success",
						title: "¡El mantenimiento ha sido editado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "mantenimiento-inv";

						}

					});
				

					</script>';

				}

			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El mantenimiento no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "mantenimiento-inv";

						}

					});
				

				</script>';

			}

		}

	}


    /*=============================================
	BORRAR MANTENIMIENTO 
	=============================================*/

	static public function CtrBorrarMantenimiento(){

		if(isset($_GET["idMantenimiento"])){

			$tabla = "mantenimiento";

			$datos = $_GET["idMantenimiento"];

			$respuesta = ModeloCronograma::mdlBorrarMantenimiento($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "¡El Mantenimiento ha sido eliminado correctamente!",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "mantenimiento-inv";

								}
							})

				</script>';

			}		

		}
	}

/*=============================================
	MOSTRAR
	=============================================*/

	static public function ctrMostrarCronograma($item ,$valor){
		
		$tabla = "mantenimiento";

		$respuesta = ModeloCronograma::MostrarCronograma($tabla,$item,$valor);

		return $respuesta;

	}

}

