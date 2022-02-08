<?php

class ControladorPerfilesUsuarios{

    /*==================================
    OBTENER PERMISOS A SOFTWARE NO OBTENIDO
    ===================================*/
    static public function ctrObtenerSoftNoObtenidos($idUsuario){

        $respuesta = ModeloPerfilesUsuarios::mdlObtenerSoftNoObtenidos($idUsuario);

        return $respuesta;

    }


    /*==================================
    OBTENER PERMISOS A SOFTWARE OBTENIDO
    ===================================*/
    static public function ctrObtenerSoftObtenidos($idUsuario){

        $respuesta = ModeloPerfilesUsuarios::ctrObtenerSoftObtenidos($idUsuario);

        return $respuesta;

    }


    /*==================================
    VALIDAMOS QUE EL USUARIO NO TENGA EL PERMISO PREVIAMENTE
    ===================================*/
    static public function ctrValidarUsuarioPerfil($valor1, $valor2, $valor3){

        $tabla = "perfiles_usuarios";

        $respuesta = ModeloPerfilesUsuarios::mdlValidarUsuarioPerfil($tabla, $valor1, $valor2, $valor3);

        return $respuesta;

    }

    /*====================================
    OBTENEMOS PERFILES DEL USUARIO
    =====================================*/
    static public function ctrObtenerPerfilesUsuarios($idUsuario){

        $tabla1 = "usuarios";
        $tabla2 = "perfiles_usuarios";
        $tabla3 = "par_perfiles";

        $respuesta = ModeloPerfilesUsuarios::mdlObtenerPerfilesUsuarios($tabla1, $tabla2, $tabla3, $idUsuario);

        return $respuesta;

    }

    /*===========================
    MOSTRAR TODOS LOS PERFILES
    ===========================*/
    static public function ctrMostrarPerfiles($item, $valor){

        $tabla = "par_perfiles";

        $respuesta = ModeloPerfilesUsuarios::mdlMostrarPerfiles($tabla, $item, $valor);

        return $respuesta;

    }

    /*===========================
    MOSTRAR USUARIOS CON PERFILES INNER JOIN
    ===========================*/
    static public function ctrMostrarUsuariosPerfiles($item, $valor){

        $tabla1 = "usuarios";
        $tabla2 = "perfiles_usuarios";
        $tabla3 = "par_permisos";
        $tabla4 = "par_perfiles";

        $respuesta = ModeloPerfilesUsuarios::mdlMostrarUsuariosPerfiles($tabla1, $tabla2, $tabla3, $tabla4, $item, $valor);

        return $respuesta;

    }

    /*====================================
    TRAER TODOS LOS PERMISOS DE UN PERFIL
    =====================================*/
    static public function ctrTraerPermisosPerfil($valor){

        $tabla1 = "par_perfiles";
        $tabla2 = "par_permisos";

        $respuesta = ModeloPerfilesUsuarios::mdlTraerPermisosPerfil($tabla1, $tabla2, $valor);

        return $respuesta;

    }

    /*==================================
    CREAR USUARIO PERFIL Y PERMISO
    ===================================*/
    static public function crearUsuarioPerfil(){

        if(isset($_POST["nuevoUsuario"])){

            $tabla = "perfiles_usuarios";

            $datos = array(

                "id_perfil" => $_POST["nuevoPerfil"],
                "id_usuario" => $_POST["nuevoUsuario"],
                "id_permiso" => $_POST["nuevoPermiso"]

            );

            $respuesta = ModeloPerfilesUsuarios::mdlCrearUsuarioPerfil($tabla, $datos);

            if($respuesta == "ok"){

                echo '<script>

					swal({

						type: "success",
						title: "¡Se asigno el Perfil correctamente al Usuario!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuarios-perfiles";

						}

					});
				

			    </script>';

            }

        }else{

            echo '<script>
            
                swal({

                    type: "error",
                    title: "¡Ocurrio un error por favor vuelve a intentarlo!.",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                }).then(function(result){

                    if(result.value){

                        window.location = "usuarios-perfiles";

                    }

                });
            
            </script>';


        }

    }

    /*============================
    BORRAR PERFIL USUARIO
    =============================*/
    static public function ctrBorrarPerfilUsuario(){

        if(isset($_GET["idPerfilUsuario"])){

            $tabla = "perfiles_usuarios";

            $datos = $_GET["idPerfilUsuario"];

            $respuesta = ModeloPerfilesUsuarios::mdlBorrarPerfilUsuario($tabla, $datos);

            if($respuesta == "ok"){

                echo '<script>

                    swal({

                        type: "success",
                        title: "El Perfil Usuario ha sido eliminado correctamente.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){

                            window.location = "usuarios-perfiles";

                        }

                    })
                
                </script>';

            }

        }

    }


}