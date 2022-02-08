<?php


class ControladorParametricasCor{

    /*===============================
    TRAER PROYECTOS DE LA AREA
    ===============================*/
    static public function ctrTraerDatoRequeridoTodos($tabla, $item, $valor){

        $respuesta = ModeloParametricasCor::mdlTraerDatoRequeridoTodos($tabla, $item, $valor);

        return $respuesta;

    }


    /*============================
    CREAR PROYECTO
    ==============================*/
    static public function ctrEditarProyecto(){

        if(isset($_POST["editarProyecto"])){

            if(preg_match('/^[-\\(\\)\\=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["editarNombreProyecto"]) &&
                preg_match('/^[-\\(\\)\\=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["editarPrefijoProyecto"])){

                
                $tabla = "proyectos_cor";

                $datos = array(

                    "id_proyecto" => $_POST["idProyecto"],
                    "nombre_proyecto" => $_POST["editarNombreProyecto"],
                    "prefijo_proyecto" => $_POST["editarPrefijoProyecto"],
                    "id_responsable" => $_POST["editarPersonaResponsable"]

                );

                $respuesta = ModeloParametricasCor::mdlEditarProyecto($tabla, $datos);

                if($respuesta == "ok"){

                    echo "<script>

                        swal({

                            type: 'success',
                            title: '¡Se actualizo la informacion del Proyecto correctamente.!',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar'

                        }).then(function(result){

                            if(result.value){
                            
                                window.location = 'proyectos-cor';

                            }

                        });
                

                    </script>";

                }


            }else{

                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡Los campos Nombre Proyecto y Prefijo Proyecto no pueden contener caracteres especiales!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = 'proyectos-cor';

                        }

                    });

                </script>";


            }


        }else{

            echo "<script>

                swal({

                    type: 'error',
                    title: '¡Algo salio mal, por favor vuelve a intentarlo!',
                    showConfirmButton: true,
                    confirmButtonText: 'Cerrar'

                }).then(function(result){

                    if(result.value){
                    
                        window.location = 'proyectos-cor';

                    }

                });

            </script>";

        }

    }

    /*============================
    ELIMINAR PROYECTO
    ==============================*/
    static public function ctrEliminarProyecto(){

        if(isset($_GET["idProyecto"])){

			$tabla ="proyectos_cor";
            $item = "id_proyecto";
			$valor = $_GET["idProyecto"];

			$respuesta = ModeloParametricasCor::mdlEliminarDatoRequerido($tabla, $item, $valor);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "¡El Proyecto se elimino correctamente!",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "proyectos-cor";

								}
							})

				</script>';

			}		

		}

    }


    /*============================
    CREAR PROYECTO
    ==============================*/
    static public function ctrCrearProyecto(){

        if(isset($_POST["crearProyecto"])){

            if(preg_match('/^[-\\(\\)\\=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nuevoNombreProyecto"]) &&
                preg_match('/^[-\\(\\)\\=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nuevoPrefijoProyecto"])){

                
                $tabla = "proyectos_cor";

                $datos = array(

                    "nombre_proyecto" => $_POST["nuevoNombreProyecto"],
                    "prefijo_proyecto" => $_POST["nuevoPrefijoProyecto"],
                    "id_responsable" => $_POST["nuevaPersonaResponsable"],
                    "numero_concecutivo" => "0000"

                );

                $respuesta = ModeloParametricasCor::mdlCrearProyecto($tabla, $datos);

                if($respuesta == "ok"){

                    echo "<script>

                        swal({

                            type: 'success',
                            title: '¡La informacion del Proyecto se guardo correctamente.!',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar'

                        }).then(function(result){

                            if(result.value){
                            
                                window.location = 'proyectos-cor';

                            }

                        });
                

                    </script>";

                }


            }else{

                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡Los campos Nombre Proyecto y Prefijo Proyecto no pueden contener caracteres especiales!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = 'proyectos-cor';

                        }

                    });

                </script>";


            }


        }else{

            echo "<script>

                swal({

                    type: 'error',
                    title: '¡Algo salio mal, por favor vuelve a intentarlo!',
                    showConfirmButton: true,
                    confirmButtonText: 'Cerrar'

                }).then(function(result){

                    if(result.value){
                    
                        window.location = 'proyectos-cor';

                    }

                });

            </script>";

        }

    }

    /*============================
    OBTENER DATO REQUERIDO
    ==============================*/
    static public function ctrObtenerDatoRequerido($tabla, $item, $valor){

        $respuesta = ModeloParametricasCor::mdlObtenerDatoRequerido($tabla, $item, $valor);

        return $respuesta;

    }

}