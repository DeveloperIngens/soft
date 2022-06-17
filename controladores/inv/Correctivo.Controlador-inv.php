<?php

class ControladorCorrectivo{

	/*=============================================
	CREAR MANTENIMIENTO PREVENTIVO/CORRECTIVO
	=============================================*/
	static public function ctrCrearCorrectivo(){

		if(isset($_POST["nuevoMantenimientos"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoTipo"])){ 
			   
				$tabla = "par_tipo_mantenimiento";
				
				$datos = array(
					"nombre_mantenimiento" => $_POST["nuevoMantenimientos"],
					"tipo" => $_POST["nuevoTipo"],
					"tipo_mantenimiento" => $_POST["nuevoTipos"],
					"id_usuario_creacion" => $_SESSION["id_usuario"],
					"id_categoria" => $_POST["nuevoTipoActivo"]
				);
																    	
					           
				$respuesta = ModeloCorrectivo::mdlIngresarCorrectivo($tabla, $datos);

				if($respuesta == "ok"){
				

					echo '<script>

					swal({

						type: "success",
						title: "¡El Mantenimiento Preventivo/Correctivo ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "ManteCorrectivo-inv";

						}

					});
				

					</script>';


				}


			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El Titulo del Mantenimiento Preventivo/Correctivo no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "ManteCorrectivo-inv";

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
					
						window.location = "ManteCorrectivo-inv";

					}

				});
			

			</script>';

		}
	
	}

	/*=============================================
	MOSTRAR MANTENIMINETOS
	=============================================*/
	static public function ctrMostrarCorrectivo($item , $valor){
		
		$tabla = "par_tipo_mantenimiento";

		$respuesta = ModeloCorrectivo::MdlMostrarCorrectivo($tabla,$item,$valor);

		return $respuesta;

	}

	/*=============================================
	OBTENER DATO REQUERIDO TABLA
	=============================================*/
	static public function ctrObternerDatoRequerido($tabla, $item , $valor){
		
		$respuesta = ModeloCorrectivo::mdlObternerDatoRequerido($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR MANTENIMIENTO PREVENTIVO/CORRECTIVO
	=============================================*/
	static public function ctrEditarMantenimiento(){

		if(isset($_POST["editarCorrectivo"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){

				$tabla = "par_tipo_mantenimiento";

				$datos = array(
					"nombre_mantenimiento" => $_POST["editarNombre"],
					"tipo"=> $_POST['editarTipo'],
					"tipo_mantenimiento"=> $_POST['editarTipos'],
					"id_tipo_mantenimiento" => $_POST["editarMantenimiento"],
					"id_categoria" => $_POST["editarTipoActivo"]
				);

				$respuesta = ModeloCorrectivo::mdlEditarCorrectivo($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script> 
					
					swal({

						type: "success",
						title: "!El Mantenimiento Preventivo/Correctivo se modifico correctamente¡",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

						}).then(function(result){
							if (result.value) {

							window.location = "ManteCorrectivo-inv";

							}

						});

				  	</script>';

				}


			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El Titulo del Mantenimiento Preventivo/Correctivo no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "ManteCorrectivo-inv";

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
					
						window.location = "ManteCorrectivo-inv";

					}

				});
			

			</script>';

		}
				
		
 	}	


    /*=============================================
	BORRAR ACTIVO
	=============================================*/

	static public function ctrBorrarCorrectivo(){

		if(isset($_GET["IdCorrectivo"])){

			$tabla ="par_tipo_mantenimiento";

			$datos = $_GET["IdCorrectivo"];

			$respuesta = ModeloCorrectivo::mdlBorrarCorrecctivo($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({

					type: "success",
					title: "!El Mantenimiento Preventivo/Correctivo fue eliminado correctamente¡",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){

					if (result.value) {

						window.location = "ManteCorrectivo-inv";

					}
				})

				</script>';

			}		

		}
	}
}