?php

class ControladorPrestadores{

	/*=============================================
	REGISTRO DE ACTIVOS
	=============================================*/

	static public function ctrCrearActivo(){

		if(isset($_POST["nuevocompra"])){
			
			if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["nuevoPlaca"])&&
			   preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["nuevoTipo"])){ 
			   
				$tabla = "activos";

				$datos = array("bien" => $_POST["nuevobien"],
					           "tipo" => $_POST["nuevoTipo"],
					           "numero_placa" => $_POST["nuevoPlaca"],  
					      		"estado_activo" => $_POST["nuevoestado"],
					       		"valor_activo" => $_POST["nuevocompra"]);
					           

				$respuesta = ModeloPrestadores::mdlIngresarActivo($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El activo ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "prestadores";

						}

					});
				

					</script>';


				}


			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El activo no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "prestadores";

						}

					});
				

				</script>';

			}


		}
		


	}


	/*=============================================
	MOSTRAR ACTIVO
	=============================================*/

	static public function ctrMostrarActivos($item,$valor){

		$tabla = "activos";

		$respuesta = ModeloPrestadores::MdlMostrarActivos($tabla,$item,$valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR ACTIVO
	=============================================*/

	static public function ctrEditarActivo(){
				
	$tabla = "activos";		  

	if(isset($_POST['editarIdActivos'])){

	if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarbien"])&&
		preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editartipo"])){
																				
				$datos = array("bien" => $_POST["editarbien"],
					           "tipo" => $_POST["editartipo"],
					           "numero_placa" => $_POST["editarNumeroplaca"], 
					           "estado_activo" => $_POST["editarestado_activo"],
					       		"valor_activo" => $_POST["editarValoractivo"],
					       		"id_activos"=>$_POST["editarIdActivos"]);

					$respuesta = ModeloPrestadores::mdlEditarActivo($tabla,$datos);
						
					if($respuesta == "ok"){
					
					echo'<script>

					swal({

						  type: "success",
						  title: "El activo ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"

						  }).then(function(result){

									if (result.value) {

									window.location = "prestadores";

									}
								});

					</script>';
				
				}
				
			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El activo no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"

						  }).then(function(result){
							if (result.value) {

							window.location ="prestadores";

							}
						});

			  	</script>';
			  	
			
		}
	}
 }

    /*=============================================
	BORRAR ACTIVO
	=============================================*/

	static public function ctrBorrarActivo(){

		if(isset($_GET["IdActivos"])){

			$tabla ="activos";

			$datos = $_GET["IdActivos"];

			$respuesta = ModeloPrestadores::mdlBorrarActivo($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El activo ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "prestadores";

								}
							})

				</script>';

			}		

		}
	}

	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function ctrMostrarActivoPropio($item, $valor){

		$tabla = "activos";

		$respuesta = ModeloPrestadores::MdlMostrarActivoPropio($tabla, $item, $valor);

		return $respuesta;
	}
	
	/*=============================================
	MOSTRAR PERFILES
	=============================================*/


	static public function ctrMostrarPerfiless(){

		$tabla = "usuarios_perfiles";

		$respuesta = ModeloPrestadores::mdlMostrarPerfilesactivo($tabla);

		return $respuesta;
	}

}







	