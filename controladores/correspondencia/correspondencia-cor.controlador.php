<?php

class ControladorCorrespondencia {

    /*============================
    CANTIDAD EN CORRESPONDENCIA ASIGNADA Y RE-ASIGNADA GLOBAL
    =============================*/
    static public function ctrObtenerCantidadesCorrespondenciaRecibida(){

        $tabla = "correspondencia_recibida";

        $respuesta = ModeloCorrespondencia::mdlObtenerCantidadesCorrespondenciaRecibida($tabla);

        return $respuesta;

    }

    /*============================
    CANTIDAD EN CORRESPONDENCIA ASIGNADA Y RE-ASIGNADA A UN USUARIO
    =============================*/
    static public function ctrObtenerCantidadAsignadaReAsignada($idUsuario){

        $tabla = "correspondencia_recibida";

        $respuesta = ModeloCorrespondencia::mdlObtenerCantidadAsignadaReAsignada($tabla, $idUsuario);

        return $respuesta;

    }


    /*===============================
    GUARDAR GESTION RADICADO/RESPUESTA
    ================================*/
    static public function ctrGuardarGestionRadicadoRespuesta(){

        if(isset($_POST["guardarGestionRadicadoRespuesta"])){

            if(preg_match('/^[-\\(\\)\\=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nuevaObservacionGestionCorRec"]) &&
                preg_match('/^[-\\0-9 ]+$/', $_POST["nuevoCodigoConcecutivoGenerado"])){

                $tabla = "correspondencia_recibida";

                $fechaHoy = date("Y-m-d H:i:s");

                $datos = array(

                    "codigo_concecutivo_generado" => $_POST["nuevoCodigoConcecutivoGenerado"],
                    "observaciones_gestion_cor_recibida" => $_POST["nuevaObservacionGestionCorRec"],
                    "fecha_gestion_cor_recibida" => $fechaHoy,
                    "id_cor_recibida" => $_POST["idCorrespondenRecibidaGestion"],
                    "estado_cor_recibida" => "Gestionada"

                );

                $cargarGestion = ModeloCorrespondencia::mdlGuardarGestionRadicadoRespuesta($tabla, $datos);

                if($cargarGestion == "ok"){

                    echo "<script>

                        swal({

                            type: 'success',
                            title: '¡Se guardo la Gestion al Radicado/Respuesta!',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar'

                        }).then(function(result){

                            if(result.value){
                            
                                window.location = 'correspondencia-recibida-cor';

                            }

                        });
                

                    </script>";

                }


            }else{

                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡El Codigo Consecutivo y Observaciones Gestion no pueden contener caracteres especiales, por favor vuelve a intentarlo!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = 'correspondencia-recibida-cor';

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
                    
                        window.location = 'correspondencia-recibida-cor';

                    }

                });

            </script>";

        }


    }


    /*===============================
    RE-ASIGNACION CORRESPONDENCIA ENTRANTE
    ================================*/
    static public function ctrReAsignarCorEntrante(){

        if(isset($_POST["guardarReAsignacionCorRec"]) || isset($_POST["guardarReAsignacionCorRecPro"])){

            if(preg_match('/^[-\\(\\)\\=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nuevoMoticoReAsignacion"])){

                $tabla = "correspondencia_recibida";

                $datos = array(

                    "id_cor_recibida" => $_POST["idCorrespondenciaRecibidaCorAsig"],
                    "id_usuario_re_asignacion_cor_recibida" => $_POST["nuevoUsuarioReAsignacion"],
                    "motivo_re_asignacion_cor_recibida" => $_POST["nuevoMoticoReAsignacion"],
                    "estado_asignacion_cor_recibida" => "Re-Asignada"

                );

                $reAsignacion = ModeloCorrespondencia::mdlReAsignarCorEntrante($tabla, $datos);

                if($reAsignacion == "ok"){

                    echo "<script>

                        swal({

                            type: 'success',
                            title: '¡Se Re-Asigno la Correspondencia Entrante Correctamente.!',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar'

                        }).then(function(result){

                            if(result.value){
                            
                                window.location = 'correspondencia-recibida-cor';

                            }

                        });
                

                    </script>";

                }

            }else{

                echo "<script>

                    swal({

                        type: 'error',
                        title: 'El Motivo Re-Asignacion no debe contener caracteres especiales!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = 'correspondencia-recibida-cor';

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
                    
                        window.location = 'correspondencia-recibida-cor';

                    }

                });

            </script>";

        }

    }


    /*===============================
    CARGAR RADICADO/RESPUESTA
    ================================*/
    static public function ctrCargarRadicadoRespuesta(){

        if(isset($_POST["cargarFacturaCorRecRad"])){

            if(preg_match('/^[-\\(\\)\\=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nuevoAsuntoCorRecRad"]) &&
                preg_match('/^[-\\(\\)\\=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nuevaObservacionCorRecRad"])){
                
                foreach ($_FILES["nuevoDocumentoProyectoCorRecRad"]["tmp_name"] as $key => $tmp_name) {

                    if($_FILES["nuevoDocumentoProyectoCorRecRad"]["name"][$key]){

                        $numeroAleatorio = rand(100000, 99999999999999);;

                        $filename = $numeroAleatorio . "-" . $_FILES["nuevoDocumentoProyectoCorRecRad"]["name"]["$key"];
                        $source = $_FILES["nuevoDocumentoProyectoCorRecRad"]["tmp_name"][$key];

                        $directorio = '../archivos_soft/Archivos/Correspondencia/CorrespondenciaRecibida/';

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
                
                        $tabla = "correspondencia_recibida";
                    
                        $datos = array(

                            "id_cor_enviada" => $_POST["nuevoRadicadoCorRecRad"],
                            "asunto" => $_POST["nuevoAsuntoCorRecRad"],
                            "observaciones_cor_recibida" => $_POST["nuevaObservacionCorRecRad"],
                            "archivo_adj_recibido" => $target_path,
                            "id_proyecto" => $_POST["idProyectoCorRadProyecto"],
                            "id_responsable" => $_POST["idCorRadResponsable"],
                            "estado_asignacion_cor_recibida" => "Asignada",
                            "id_usuario_creacion" => $_SESSION["id_usuario"],
                            "tipo_cor_recibida" => $_POST["nuevoTipoCorRecRad"]

                        );

                        $cargarRespuestaRad = ModeloCorrespondencia::mdlCargarRadicadoRespuesta($tabla, $datos);

                        if($cargarRespuestaRad == "ok"){

                            echo "<script>

                                swal({

                                    type: 'success',
                                    title: '¡Se cargo Radicado/Respuesta correctamente!',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Cerrar'

                                }).then(function(result){

                                    window.location = 'cargar-correspondencia-recibida-cor';

                                });
                        

                            </script>";

                        }

                    }else{

                        echo "<script>

                            swal({

                                type: 'error',
                                title: '¡Ocurrio un error al carga el archivo, por favor vuelve a intentarlo!',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar'

                            }).then(function(result){

                                window.location = 'cargar-correspondencia-recibida-cor';

                            });

                        </script>";

                    }

                }


            }else{

                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡El Asunto y Observaciones no deben contener caracteres especiales!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        window.location = 'cargar-correspondencia-recibida-cor';

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

                    window.location = 'cargar-correspondencia-recibida-cor';

                });

            </script>";

        }

    }

    /*===============================
    RECHAZAR ASIGNACION CORRESPONDENCIA RECIBIDA RE-ASIGNADA
    ================================*/
    static public function ctrRechazarCorrespondenciaRecibidaReAsign(){

        if(isset($_POST["rechazarAsignacionCorRecReAsign"])){

            if(preg_match('/^[-\\(\\)\\=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["rechazarObservacionesReAsign"])){

                $tabla = "correspondencia_recibida";

                $datos = array(

                    "id_cor_recibida" => $_POST["rechazarIdCorRecibidaReAsign"],
                    "observaciones_asignacion_rechaza" => $_POST["rechazarObservacionesReAsign"],
                    "estado_asignacion_cor_recibida" => 'Re-Asignada-Rechaza'

                );

                $rechazarCor = ModeloCorrespondencia::mdlRechazarCorrespondenciaRecibidaReAsign($tabla, $datos);

                if($rechazarCor == "ok"){

                    echo "<script>

                        swal({

                            type: 'success',
                            title: '¡La Correspondencia Entrante Re-Asignada fue rechazada correctamente!',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar'

                        }).then(function(result){

                            window.location = 'correspondencia-recibida-cor';

                        });
                

                    </script>";

                }


            }else{

                echo "<script>

                    swal({

                        type: 'error',
                        title: 'La Observaciones de Rechazamiento no deben contener caracteres especiales!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        window.location = 'correspondencia-recibida-cor';

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

                    window.location = 'correspondencia-recibida-cor';

                });

            </script>";


        }

    }


    /*===============================
    RECHAZAR ASIGNACION CORRESPONDENCIA RECIBIDA
    ================================*/
    static public function ctrRechazarCorrespondenciaRecibida(){

        if(isset($_POST["rechazarAsignacionCorRec"])){

            if(preg_match('/^[-\\(\\)\\=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["rechazarObservaciones"])){

                $tabla = "correspondencia_recibida";

                $datos = array(

                    "id_cor_recibida" => $_POST["rechazarIdCorRecibida"],
                    "observaciones_asignacion_rechaza" => $_POST["rechazarObservaciones"],
                    "estado_asignacion_cor_recibida" => 'Rechazada'

                );

                $rechazarCor = ModeloCorrespondencia::mdlRechazarCorrespondenciaRecibida($tabla, $datos);

                if($rechazarCor == "ok"){

                    echo "<script>

                        swal({

                            type: 'success',
                            title: '¡La Correspondencia Recibida fue rechazada correctamente!',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar'

                        }).then(function(result){

                            window.location = 'correspondencia-recibida-cor';

                        });
                

                    </script>";

                }


            }else{

                echo "<script>

                    swal({

                        type: 'error',
                        title: 'La Observaciones de Rechazamiento no deben contener caracteres especiales!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        window.location = 'correspondencia-recibida-cor';

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

                    window.location = 'correspondencia-recibida-cor';

                });

            </script>";


        }

    }

    /*===============================
    EDITAR FACTURA/RECIBO RECIBIDA
    ================================*/
    static public function ctrEditarFacturaCorRec(){

        if(isset($_POST["editarCorRec"])){

            if(preg_match('/^[-\\(\\)\\=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["editarAsuntoCorRec"]) &&
                preg_match('/^[-\\(\\)\\=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["editarObservacionesCorRec"])){

                if($_POST["editarProyectoCorRecNuevo"] != ""){

                    $id_proyecto = $_POST["editarProyectoCorRecNuevo"];
                    
                }else{

                    $id_proyecto = $_POST["editarProyectoCorRecAnterior"];

                }

                $tabla = "correspondencia_recibida";

                $datos = array(

                    "id_cor_recibida" => $_POST["idEditarCorRec"],
                    "asunto" => $_POST["editarAsuntoCorRec"],
                    "observaciones_cor_recibida" => $_POST["editarObservacionesCorRec"],
                    "id_proyecto" => $id_proyecto,
                    "id_responsable" => $_POST["editarIdResponsableCorRec"],
                    "estado_asignacion_cor_recibida" => "Asignada",
                    "observaciones_asignacion_rechaza" => null,
                    "tipo_cor_recibida" => $_POST["editarTipoCorRec"]

                );

                $editarCorRec = ModeloCorrespondencia::mdlEditarFacturaCorRec($tabla, $datos);

                if($editarCorRec == "ok"){

                    echo "<script>

                        swal({

                            type: 'success',
                            title: '¡Se la Correspondencia Entrante Correctamente!',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar'

                        }).then(function(result){

                            window.location = 'cargar-correspondencia-recibida-cor';

                        });
                

                    </script>";

                }


            }else{

                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡El Asunto y Observaciones no deben contener caracteres especiales!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        window.location = 'correspondencia-enviada-cor';

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

                    window.location = 'cargar-correspondencia-recibida-cor';

                });

            </script>";

        }

    }

    /*===============================
    CARGAR DOCUMENTO
    ================================*/
    static public function ctrCargarDocumentoCorRec(){

        if(isset($_POST["cargarDocumentoCorRec"])){

            if(preg_match('/^[-\\(\\)\\=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nuevoAsuntoDocCorRec"]) &&
                preg_match('/^[-\\(\\)\\=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nuevaObservacionDocCorRec"])){

                foreach ($_FILES["nuevoDocumentoProyectoDocCorRec"]["tmp_name"] as $key => $tmp_name) {

                    if($_FILES["nuevoDocumentoProyectoDocCorRec"]["name"][$key]){

                        $numeroAleatorio = rand(100000, 99999999999999);;

                        $filename = $numeroAleatorio . "-" . $_FILES["nuevoDocumentoProyectoDocCorRec"]["name"]["$key"];
                        $source = $_FILES["nuevoDocumentoProyectoDocCorRec"]["tmp_name"][$key];

                        $directorio = '../archivos_soft/Archivos/Correspondencia/CorrespondenciaRecibida/';

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

                        $tabla = "correspondencia_recibida";

                        $datos = array(

                            "asunto" => $_POST["nuevoAsuntoDocCorRec"],
                            "observaciones_cor_recibida" => $_POST["nuevaObservacionDocCorRec"],
                            "archivo_adj_recibido" => $target_path,
                            "id_proyecto" => $_POST["nuevoProyectoDocCorRec"],
                            "id_responsable" =>$_POST["idNuevoResponsableProyectoDocCor"],
                            "estado_asignacion_cor_recibida" => "Asignada",
                            "id_usuario_creacion" => $_SESSION["id_usuario"],
                            "tipo_cor_recibida" => $_POST["nuevoTipoDocCorRec"]

                        );

                        $cargarFacturaRecibo = ModeloCorrespondencia::mdlCargarFacturaCorRec($tabla, $datos);

                        if($cargarFacturaRecibo == "ok"){

                            echo "<script>

                                swal({

                                    type: 'success',
                                    title: '¡Se cargo el Documento correctamente!',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Cerrar'

                                }).then(function(result){

                                    window.location = 'cargar-correspondencia-recibida-cor';

                                });
                        

                            </script>";

                        }

                    }else{

                        echo "<script>

                            swal({

                                type: 'error',
                                title: '¡Ocurrio un error al carga el archivo, por favor vuelve a intentarlo!',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar'

                            }).then(function(result){

                                window.location = 'correspondencia-enviada-cor';

                            });

                        </script>";

                    }


                }


            }else{

                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡El Asunto y Observaciones no deben contener caracteres especiales!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        window.location = 'correspondencia-enviada-cor';

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

                    window.location = 'cargar-correspondencia-recibida-cor';

                });

            </script>";

        }

    }

    /*===============================
    CARGAR FACTURA/RECIBO RECIBIDA
    ================================*/
    static public function ctrCargarFacturaCorRec(){

        if(isset($_POST["cargarFacturaCorRec"])){

            if(preg_match('/^[-\\(\\)\\=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nuevoAsuntoCorRec"]) &&
                preg_match('/^[-\\(\\)\\=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nuevaObservacionCorRec"])){

                foreach ($_FILES["nuevoDocumentoProyectoCorRec"]["tmp_name"] as $key => $tmp_name) {

                    if($_FILES["nuevoDocumentoProyectoCorRec"]["name"][$key]){

                        $numeroAleatorio = rand(100000, 99999999999999);;

                        $filename = $numeroAleatorio . "-" . $_FILES["nuevoDocumentoProyectoCorRec"]["name"]["$key"];
                        $source = $_FILES["nuevoDocumentoProyectoCorRec"]["tmp_name"][$key];

                        $directorio = '../archivos_soft/Archivos/Correspondencia/CorrespondenciaRecibida/';

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

                        $tabla = "correspondencia_recibida";

                        $datos = array(

                            "asunto" => $_POST["nuevoAsuntoCorRec"],
                            "observaciones_cor_recibida" => $_POST["nuevaObservacionCorRec"],
                            "archivo_adj_recibido" => $target_path,
                            "id_proyecto" => $_POST["nuevoProyectoCorRec"],
                            "id_responsable" =>$_POST["idNuevoResponsableProyecto"],
                            "estado_asignacion_cor_recibida" => "Asignada",
                            "id_usuario_creacion" => $_SESSION["id_usuario"],
                            "tipo_cor_recibida" => $_POST["nuevoTipoCorRec"]

                        );

                        $cargarFacturaRecibo = ModeloCorrespondencia::mdlCargarFacturaCorRec($tabla, $datos);

                        if($cargarFacturaRecibo == "ok"){

                            echo "<script>

                                swal({

                                    type: 'success',
                                    title: '¡Se cargo la Factura/Recibo correctamente!',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Cerrar'

                                }).then(function(result){

                                    window.location = 'cargar-correspondencia-recibida-cor';

                                });
                        

                            </script>";

                        }

                    }else{

                        echo "<script>

                            swal({

                                type: 'error',
                                title: '¡Ocurrio un error al carga el archivo, por favor vuelve a intentarlo!',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar'

                            }).then(function(result){

                                window.location = 'correspondencia-enviada-cor';

                            });

                        </script>";

                    }


                }


            }else{

                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡El Asunto y Observaciones no deben contener caracteres especiales!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        window.location = 'correspondencia-enviada-cor';

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

                    window.location = 'cargar-correspondencia-recibida-cor';

                });

            </script>";

        }

    }

    /*===============================
    ANULAR/DEVOLVER DOCUMENTO A RADICAR
    ===============================*/
    static public function ctrAnularDevolverDocumentoRadicar(){

        if(isset($_POST["anularDocumentoRadicar"])){

            if(preg_match('/^[-\\(\\)\\=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nuevaObservacionCancelar"])){

                $fechaHoy = date("Y-m-d H:i:s");

                $tabla = "correspondencia_enviada";

                $datos = array(

                    "id_cor_enviado" => $_POST["idEnvioCorrespondenciaCancelar"],
                    "estado" => $_POST["nuevoAccionDocumentoRadicar"],
                    "motivo_anulacion" => $_POST["nuevaObservacionCancelar"],
                    "id_usuario_cancelacion" => $_SESSION["id_usuario"],
                    "fecha_cancelacion" => $fechaHoy

                );

                $anular = ModeloCorrespondencia::mdlAnularDevolverDocumentoRadicar($tabla, $datos);

                if($anular == "ok"){

                    echo "<script>

                        swal({

                            type: 'success',
                            title: '¡Se Anulo/Devolvio correctamente.!',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar'

                        }).then(function(result){

                            window.location = 'correspondencia-enviada-cor';

                        });
                

                    </script>";

                }


            }else{

                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡Las observaciones de la Anulación o Devolución no debe contener caracteres especiales, por favor vuelve a intentarlo.!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        window.location = 'correspondencia-enviada-cor';

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

                    window.location = 'correspondencia-enviada-cor';

                });

            </script>";


        }


    }


    /*===============================
    CARGAR RESPUESTA A RADICADO
    ===============================*/
    static public function ctrCargarRespuestaDocumentoRadicado(){

        if(isset($_POST["cargarDocumentoRespuesta"])){

            if(preg_match('/^[-\\(\\)\\=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nuevoNumeroRadicado"])){

                foreach ($_FILES["nuevoDocumentoCorrespondenciaRespuesta"]["tmp_name"] as $key => $tmp_name) {

                    if($_FILES["nuevoDocumentoCorrespondenciaRespuesta"]["name"][$key]){

                        $filename = $_POST["idEnvioCorrespondenciaRespuesta"] ."-". $_FILES["nuevoDocumentoCorrespondenciaRespuesta"]["name"]["$key"];
                        $source = $_FILES["nuevoDocumentoCorrespondenciaRespuesta"]["tmp_name"][$key];

                        $directorio = '../archivos_soft/Archivos/Correspondencia/CorrespondenciaEnviada/ArchivosRecibidos/';

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

                        $tabla = "correspondencia_enviada";

                        $fechaHoy = date("Y-m-d H:i:s");

                        $datos = array(

                            "id_cor_enviado" => $_POST["idEnvioCorrespondenciaRespuesta"],
                            "archivo_adj_recibido" => $target_path,
                            "radicado" => $_POST["nuevoNumeroRadicado"],
                            "id_usuario_carga_respuesta" => $_SESSION["id_usuario"],
                            "fecha_carga_respuesta" => $fechaHoy,
                            "estado" => "Radicado"

                        );

                        $cargarRespuestaDocumento = ModeloCorrespondencia::mdlCargarRespuestaDocumentoRadicado($tabla, $datos);

                        if($cargarRespuestaDocumento == "ok"){

                            echo "<script>

                                swal({

                                    type: 'success',
                                    title: '¡Se cargo la Respuesta al Documento Radicado.!',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Cerrar'

                                }).then(function(result){

                                    window.location = 'correspondencia-enviada-cor';

                                });
                        

                            </script>";

                        }

                    }else{

                        echo "<script>

                            swal({

                                type: 'error',
                                title: '¡Ocurrio un error al carga el archivo, por favor vuelve a intentarlo!',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar'

                            }).then(function(result){

                                window.location = 'correspondencia-enviada-cor';

                            });

                        </script>";

                    }


                }

            }else{

                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡El Número de Radicado no puede contener caracteres especiales, por favor vuelve a intentarlo!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        window.location = 'correspondencia-enviada-cor';

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

                    window.location = 'correspondencia-enviada-cor';

                });

            </script>";

        }

    }


    /*===============================
    CARGAR DOCUMENTO A RADICAR
    ===============================*/
    static public function ctrCargarDocumentoRadicar(){

        if(isset($_POST["cargarDocumentoRadicar"])){

            if(preg_match('/^[-\\(\\)\\=\\$\\;\\*\\"\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nuevoAsuntoCorrespondencia"])){

                foreach ($_FILES["nuevoDocumentoCorrespondencia"]["tmp_name"] as $key => $tmp_name) {

                    if($_FILES["nuevoDocumentoCorrespondencia"]["name"][$key]){

                        $filename = $_POST["idEnvioCorrespondencia"] ."-". $_FILES["nuevoDocumentoCorrespondencia"]["name"]["$key"];
                        $source = $_FILES["nuevoDocumentoCorrespondencia"]["tmp_name"][$key];

                        $directorio = '../archivos_soft/Archivos/Correspondencia/CorrespondenciaEnviada/ArchivosEnviados/';

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

                        $tabla = "correspondencia_enviada";

                        $fechaHoy = date("Y-m-d H:i:s");

                        $datos = array(

                            "id_cor_enviado" => $_POST["idEnvioCorrespondencia"],
                            "archivo_adj_enviado" => $target_path,
                            "asunto" => $_POST["nuevoAsuntoCorrespondencia"],
                            "estado" => "En radicación",
                            "id_usuario_carga_documento" => $_SESSION["id_usuario"],
                            "fecha_carga_documento" => $fechaHoy

                        );

                        $cargarDocumento = ModeloCorrespondencia::mdlCargarDocumentoRadicar($tabla, $datos);

                        if($cargarDocumento == "ok"){

                            echo "<script>

                                swal({

                                    type: 'success',
                                    title: '¡Se cargo el Documento a Radicar correctamente.!',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Cerrar'

                                }).then(function(result){

                                    window.location = 'correspondencia-enviada-cor';

                                });
                        

                            </script>";

                        }

                    }else{

                        echo "<script>

                            swal({

                                type: 'error',
                                title: '¡Ocurrio un error al carga el archivo, por favor vuelve a intentarlo!',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar'

                            }).then(function(result){

                                window.location = 'correspondencia-enviada-cor';

                            });

                        </script>";

                    }


                }


            }else{

                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡El Asunto no puede contener caracteres especiales, por favor vuelve a intentarlo!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        window.location = 'correspondencia-enviada-cor';

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

                    window.location = 'correspondencia-enviada-cor';

                });

            </script>";

        }

    }

    /*===============================
    CREAR CODIGO CONCECUTIVO MASIVO
    ===============================*/
    static public function ctrCrearCodigoConcecutivoMasivo(){

        if(isset($_POST["crearConcecutivoMasivo"])){

            $tabla = "correspondencia_enviada";

            $tablaConcecutivo = "proyectos_cor";
            $codigoConcecutivo = ControladorCorrespondencia::ctrObtenerCodigoConcecutivo($tablaConcecutivo, $_POST["nuevoProyectoConcecutivoMasivo"]);

            if($codigoConcecutivo["numero_concecutivo"] != ""){

                $ultimoConcecutivo = ModeloCorrespondencia::mdlObtenerUltimoCodigoCorEnviada($_POST["nuevoProyectoConcecutivoMasivo"]);

                $concecutivoConCerosValidacion = substr(str_repeat(0, 4).($codigoConcecutivo["numero_concecutivo"] + 1), - 4);

                $codigoConcecutivoValidacion = $_POST["nuevoPrefijoProyecto"] . "-" . $concecutivoConCerosValidacion;

                if($codigoConcecutivoValidacion > $ultimoConcecutivo["codigo"]){

                    $concecutivoConCeros = substr(str_repeat(0, 4).($codigoConcecutivo["numero_concecutivo"] + 1), - 4);

                    $cantidadConcecutivos = $_POST["cantidadConcecutivosGenerar"];

                    $nuevoNumeroConcecutivo = $concecutivoConCeros + $cantidadConcecutivos - 1;

                    /*=====================
                    ACTUALIZAR CONCECUTIVO
                    ======================*/
                    $tablaActualizar = "proyectos_cor";
                    
                    $datosActualizar = array(

                        "id_proyecto" => $_POST["nuevoProyectoConcecutivoMasivo"],
                        "numero_concecutivo" => $nuevoNumeroConcecutivo

                    );

                    $actualizarConce = ModeloParametricasCor::mdlActualizarConcecutivo($tablaActualizar, $datosActualizar);

                    if($actualizarConce == "ok"){


                        for ($i=0; $i < $cantidadConcecutivos; $i++) { 

                            $codigo = substr(str_repeat(0, 4).($concecutivoConCeros + $i), - 4);
                            $codigoConcecutivo = $_POST["nuevoPrefijoProyecto"] . "-" . $codigo;

                            $datos = array(

                                "codigo" => $codigoConcecutivo,
                                "id_proyecto" => $_POST["nuevoProyectoConcecutivoMasivo"],
                                "id_usuario" => $_SESSION["id_usuario"],
                                "estado" => "Creado"
                
                            );
            
                            $respuesta = ModeloCorrespondencia::mdlCrearCodigoConcecutivo($tabla, $datos);
            
                        }

                        if($respuesta == "ok"){

                            echo "<script>

                                swal({

                                    type: 'success',
                                    title: '¡Se creo el Codigo consecutivo correctamente!',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Cerrar'

                                }).then(function(result){

                                    window.location = 'correspondencia-enviada-cor';

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

                                window.location = 'correspondencia-enviada-cor';

                            });

                        </script>";

                    }

                }else{

                    echo "<script>

                        swal({

                            type: 'error',
                            title: '¡Algo salio mal, al generar el codigo concecutivo, por favor vuelve a intentarlo!',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar'

                        }).then(function(result){

                            window.location = 'correspondencia-enviada-cor';

                        });

                    </script>";

                }

            }else{

                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡El Proyecto no tiene codigo concecutivo, comuniquese con el administrador!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        window.location = 'correspondencia-enviada-cor';

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

                    window.location = 'correspondencia-enviada-cor';

                });

            </script>";
            
        }


    }

    /*===============================
    CREAR CODIGO CONCECUTIVO
    ===============================*/
    static public function ctrCrearCodigoConcecutivo(){

        if(isset($_POST["crearConcecutivo"])){

            $tabla = "correspondencia_enviada";

            //$concecutioConCeros = substr(str_repeat(0, 4).($codigoConcecutivo["numero_concecutivo"] + 1), - 4);
            $tablaConcecutivo = "proyectos_cor";
            $codigoConcecutivo = ControladorCorrespondencia::ctrObtenerCodigoConcecutivo($tablaConcecutivo, $_POST["nuevoProyectoConcecutivo"]);

            if($codigoConcecutivo["numero_concecutivo"] != ""){

                $ultimoConcecutivo = ModeloCorrespondencia::mdlObtenerUltimoCodigoCorEnviada($_POST["nuevoProyectoConcecutivo"]);

                $concecutivoConCerosValidacion = substr(str_repeat(0, 4).($codigoConcecutivo["numero_concecutivo"] + 1), - 4);

                $codigoConcecutivoValidacion = $_POST["nuevoPrefijoProyecto"] . "-" . $concecutivoConCerosValidacion;

                if($codigoConcecutivoValidacion > $ultimoConcecutivo["codigo"]){

                    $concecutioConCeros = substr(str_repeat(0, 4).($codigoConcecutivo["numero_concecutivo"] + 1), - 4);

                    /*=====================
                    ACTUALIZAR CONCECUTIVO
                    ======================*/
                    $tablaActualizar = "proyectos_cor";
                    
                    $datosActualizar = array(

                        "id_proyecto" => $_POST["nuevoProyectoConcecutivo"],
                        "numero_concecutivo" => $concecutioConCeros

                    );

                    $actualizarConce = ModeloParametricasCor::mdlActualizarConcecutivo($tablaActualizar, $datosActualizar);

                    if($actualizarConce == "ok"){

                        $concecutivo = $codigoConcecutivo["prefijo_proyecto"]  . "-" . $concecutioConCeros;

                        $datos = array(

                            "codigo" => $concecutivo,
                            "id_proyecto" => $_POST["nuevoProyectoConcecutivo"],
                            "id_usuario" => $_SESSION["id_usuario"],
                            "estado" => "Creado"
            
                        );

                        $respuesta = ModeloCorrespondencia::mdlCrearCodigoConcecutivo($tabla, $datos);

                        if($respuesta == "ok"){

                            echo "<script>

                                swal({

                                    type: 'success',
                                    title: '¡Se creo el Codigo consecutivo: <br><b>".$concecutivo."</b> <br>correctamente!',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Cerrar'

                                }).then(function(result){

                                    window.location = 'correspondencia-enviada-cor';

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

                                window.location = 'correspondencia-enviada-cor';

                            });

                        </script>";

                    }

                }else{

                    echo "<script>

                        swal({

                            type: 'error',
                            title: '¡Algo salio mal, al generar el codigo concecutivo, por favor vuelve a intentarlo!',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar'

                        }).then(function(result){

                            window.location = 'correspondencia-enviada-cor';

                        });

                    </script>";

                }

            }else{

                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡Algo salio mal, al generar el codigo concecutivo, por favor vuelve a intentarlo!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        window.location = 'correspondencia-enviada-cor';

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

                    window.location = 'correspondencia-enviada-cor';

                });

            </script>";
            
        }


    }

    /*==========================
    OBTENER CODIGO CONCECUTIVO
    ===========================*/
    static public function ctrObtenerCodigoConcecutivo($tabla, $idProyecto){

        $respuesta = ModeloCorrespondencia::mdlObtenerCodigoConcecutivo($tabla, $idProyecto);

        return $respuesta;

    }

    /*==========================
    MOSTRAR CORRESPONDENCIA ENVIADA/RECIBIDA
    ===========================*/
    static public function ctrMostrarCorrespondenciaRequerida($tabla, $item, $valor){

        $respuesta = ModeloCorrespondencia::mdlCorrespondenciaRequerida($tabla, $item, $valor);

        return $respuesta;

    }

}