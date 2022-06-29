<?php

class ControladorHojaVida {


    /*=============================
    TRAER TODAS LAS EXPERIENCIAS LABORALES DE LA PERSONA
    =============================*/
    static public function ctrTraerExperienciasPersona($item, $valor){

        $tabla = "experiencia_laboral";

        $respuesta = ModeloHojaVida::mdlTraerExperienciasPersona($tabla, $item, $valor);

        return $respuesta;

    }

    /*=============================
    TRAER TODAS LAS FORMACIONES DE LA PERSONA
    =============================*/
    static public function ctrTraerNivelesEstudiosPersona($item, $valor){

        $tabla = "nivel_estudio";

        $respuesta = ModeloHojaVida::mdlTraerNivelEstudiosPersona($tabla, $item, $valor);

        return $respuesta;

    }

    /*===============================
    VALIDAR SI TIENE HOJA DE VIDA
    =================================*/
    static public function ctrCalcularExperienciaTotal($idIdentificacion){

        $tabla = "experiencia_laboral";

        $respuesta = ModeloHojaVida::mdlCalcularExperienciaTotal($tabla, $idIdentificacion);

        return $respuesta;

    }


    /*===============================
    VALIDAR SI TIENE HOJA DE VIDA
    =================================*/
    static public function ctrValidarExisteHojaVida($correo, $nivelEducacion, $numeroIdentificacion, $palabraClave){

        $tabla = "datos_personales";

        $respuesta = ModeloHojaVida::mdlValidarExisteHojaVida($tabla, $correo, $nivelEducacion, $numeroIdentificacion, $palabraClave);

        return $respuesta;

    }

    /*===============================
    VALIDAR SI TIENE HOJA DE VIDA ID DATOS PERSONALES
    =================================*/
    static public function ctrTraerDatosPersonalesId($buscar){

        $tabla = "datos_personales";

        $respuesta = ModeloHojaVida::mdlTraerDatosPersonalesId($tabla, $buscar);

        return $respuesta;

    }

    /*===============================
    VALIDAR SI TIENE HOJA DE VIDA IDENTIFICACION USUARIO
    =================================*/
    static public function ctrValidarExisteHojaVidaDocumento($buscar){

        $tabla = "datos_personales";

        $respuesta = ModeloHojaVida::mdlValidarExisteHojaVidaDocumento($tabla, $buscar);

        return $respuesta;

    }

    /*==================================
    TRAER DATOS PERSONALES
    ===================================*/
    static public function ctrTraerDatosPersonales($item, $valor){

        $tabla = "datos_personales";

        $respuesta = ModeloHojaVida::mdlTraerDatosPersonales($tabla, $item, $valor);
        
        return $respuesta;

    }

    /*============================
    CANTIDAD HOJAS DE VIDA
    ============================*/
    static public function ctrCantidadHojasVidaRegistrada($item, $valor){

        $tabla = "datos_personales";

        $respuesta = ModeloHojaVida::mdlCantidadHojasVidaRegistrada($tabla, $item, $valor);

        return $respuesta;

    }

    /*===============================
    CREAR DATOS PERSONALES
    =================================*/
    static public function ctrCrearDatosPersonales(){

        if(isset($_POST["crearDatosAdicionales"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevosNombres"]) &&
                preg_match('/^[0-9]+$/', $_POST["nuevoNumeroIdentificacion"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevosApellidos"]) &&
                preg_match('/^[(\\)\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaProfesion"]) &&
                preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $_POST["nuevoCorreoElectronico"]) &&
                preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccionResidencia"]) &&
                preg_match('/^[0-9 ]+$/', $_POST["nuevoCelular"])){
                
                foreach ($_FILES["nuevoArchivoDocumentoIdentidad"]["type"] as $key => $tipo) {

                    $mimeArchivo = $tipo;

                }

                if($mimeArchivo == "application/pdf"){

                    foreach ($_FILES["nuevoArchivoDocumentoIdentidad"]["tmp_name"] as $key => $tmp_name) {
                        
                        if($_FILES["nuevoArchivoDocumentoIdentidad"]["name"][$key]){

                            foreach ($_FILES["nuevoArchivoDocumentoHojaVida"]["tmp_name"] as $key => $tmp_name) {

                                if($_FILES["nuevoArchivoDocumentoHojaVida"]["name"][$key]){

                                    $_FILES["nuevoArchivoDocumentoIdentidad"]["name"]["$key"] = "DI-".$_POST["nuevoNumeroIdentificacion"].".pdf";

                                    $filename = $_FILES["nuevoArchivoDocumentoIdentidad"]["name"]["$key"];
                                    $source = $_FILES["nuevoArchivoDocumentoIdentidad"]["tmp_name"][$key];

                                    $_FILES["nuevoArchivoDocumentoHojaVida"]["name"]["$key"] = "HV-".$_POST["nuevoNumeroIdentificacion"].".pdf";

                                    $filenameHv = $_FILES["nuevoArchivoDocumentoHojaVida"]["name"]["$key"];
                                    $sourceHv = $_FILES["nuevoArchivoDocumentoHojaVida"]["tmp_name"][$key];

                                    $directorio = '../archivos_soft/Archivos/AdjuntosDoc/';

                                    if(!file_exists($directorio)){

                                        mkdir($directorio, 0777, true) or die("Fallo creacion carpeta");

                                    }

                                    $directorioHv = '../archivos_soft/Archivos/AdjuntosHV/';

                                    if(!file_exists($directorioHv)){

                                        mkdir($directorioHv, 0777, true) or die("Fallo creacion carpeta");

                                    }

                                    $dir = opendir($directorio);
                                    $target_path = $directorio.$filename;

                                    if(move_uploaded_file($source, $target_path)){

                                        $resultadoArchivo = "ok";

                                    }else{

                                        $resultadoArchivo = "error";

                                    }

                                    closedir($dir);

                                    $dirHv = opendir($directorioHv);
                                    $target_pathHv = $directorioHv.$filenameHv;

                                    if(move_uploaded_file($sourceHv, $target_pathHv)){

                                        $resultadoArchivo = "ok";

                                    }else{

                                        $resultadoArchivo = "error";

                                    }

                                    closedir($dirHv);


                                    /*===================================
                                    VALIDAMOS SELECT QUE SE GENERAN SI SON DEL PAIS DE COLOMBIA
                                    ====================================*/
                                    if(isset($_POST["nuevoDepartamentoResidencia"])){

                                        $nuevoDepartamentoResidencia = $_POST["nuevoDepartamentoResidencia"];

                                    }else{

                                        $nuevoDepartamentoResidencia = "";

                                    }

                                    if(isset($_POST["nuevaCiudadResidencia"])){

                                        $nuevaCiudadResidencia = $_POST["nuevaCiudadResidencia"];

                                    }else{

                                        $nuevaCiudadResidencia = "";

                                    }

                                    $tabla = "datos_personales";

                                    $datos = array(

                                        "tipo_documento_fk" => $_POST["nuevoTipoIdentificacion"],
                                        "identificacion" => $_POST["nuevoNumeroIdentificacion"],
                                        "nombres" => $_POST["nuevosNombres"],
                                        "apellidos" => $_POST["nuevosApellidos"],
                                        "adjunto_documento" => $target_path,
                                        "hv_adjunto_documento" => $target_pathHv,
                                        "nombre_adjunto_documento" => $filename,
                                        "fecha_nacimiento" => $_POST["nuevoFechaNacimiento"],
                                        "nacionalidad_fk" => $_POST["nuevaNacionalidad"],
                                        "departamento_residencia" => $nuevoDepartamentoResidencia,
                                        "ciudad_residencia" => $nuevaCiudadResidencia,
                                        "profesion" => $_POST["nuevaProfesion"],
                                        "correo_electronico" => $_POST["nuevoCorreoElectronico"],
                                        "direccion_residencia" => $_POST["nuevaDireccionResidencia"],
                                        "numero_celular" => $_POST["nuevoCelular"],
                                        "numero_celular_2" => $_POST["nuevoCelular2"],
                                        "numero_telefono" => $_POST["nuevoTelefono"],
                                        "usuario_creacion" => $_SESSION["correo"]

                                    );


                                    $respuesta = ModeloHojaVida::mdlCrearDatosPersonales($tabla, $datos);

                                    if($respuesta == "ok"){

                                        echo "<script>

                                            swal({

                                                type: 'success',
                                                title: '¡Sus Datos Personales fueron guardados correctamente.!',
                                                showConfirmButton: true,
                                                confirmButtonText: 'Cerrar'

                                            }).then(function(result){

                                                if(result.value){
                                                
                                                    window.location = 'datos-personales-hv';

                                                }

                                            });
                                    

                                        </script>";


                                    }

                                }

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

                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡Error/es en el Formulario!',
                        html: '<b>Tenga en cuenta las siguientes recomendaciones:</b><br><br>'+
                                '1 - Los campos Nombres, Apellidos y Profesión no deben contener caracteres especiales.<br><br>'+
                                '2 - Los campos Número Celular, Número Celular 2 y Telefono no deben contener letras',
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
					title: "¡Ocurrio un error inesperado por favor, vuelve a intentarlo!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "datos-personales-hv";

					}

				});
			

			</script>';

        }

    }

    /*===============================
    EDITAR DATOS PERSONALES
    =================================*/
    public static function ctrEditarDatosPersonales(){

        if(isset($_POST["editarDatosPersonales"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombres"]) &&
                preg_match('/^[0-9]+$/', $_POST["editarNumeroIdentificacion"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApellidos"]) &&
                preg_match('/^[(\\)\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarProfesion"]) &&
                preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $_POST["editarCorreoElectronico"]) &&
                preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarDireccionResidencia"]) &&
                preg_match('/^[0-9 ]+$/', $_POST["editarCelular"]) &&
                preg_match('/^[0-9 ]+$/', $_POST["editarCelular2"]) &&
                preg_match('/^[0-9 ]+$/', $_POST["editarTelefono"]) &&
                isset($_POST["documentoAntiguo"])){
                


                    foreach ($_FILES["editarArchivoDocumentoIdentidad"]["type"] as $key => $tipo) {

                        $mimeArchivo = $tipo;
    
                    }

                    foreach ($_FILES["editarArchivoDocumentoIdentidad"]["name"] as $key => $nombre) {

                        $nombreArchivo = $nombre;
    
                    }
    
                    if($nombreArchivo != ""){

                        if($mimeArchivo == "application/pdf"){
    
                            foreach ($_FILES["editarArchivoDocumentoIdentidad"]["tmp_name"] as $key => $tmp_name) {
                                
                                if($_FILES["editarArchivoDocumentoIdentidad"]["name"][$key]){
        
                                    $_FILES["editarArchivoDocumentoIdentidad"]["name"]["$key"] = "DI-".$_POST["editarNumeroIdentificacion"].".pdf";
        
                                    $filename = $_FILES["editarArchivoDocumentoIdentidad"]["name"]["$key"];
                                    $source = $_FILES["editarArchivoDocumentoIdentidad"]["tmp_name"][$key];
        
                                    $directorio = '../archivos_soft/Archivos/AdjuntosDoc/';
        
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
        
                                }else{
    
                                    $target_path = $_POST["documentoAntiguo"];
                                    $filename = $_POST["nombreDocumento"];
    
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

                        $target_path = $_POST["documentoAntiguo"];
                        $filename = $_POST["nombreDocumento"];


                    }

                    foreach ($_FILES["editarArchivoDocumentoHojaVida"]["name"] as $key => $nombre) {

                        $nombreArchivoHv = $nombre;
    
                    }

                    if($nombreArchivoHv != ""){

    
                        foreach ($_FILES["editarArchivoDocumentoHojaVida"]["tmp_name"] as $key => $tmp_name) {
                            
                            if($_FILES["editarArchivoDocumentoHojaVida"]["name"][$key]){
    
                                $_FILES["editarArchivoDocumentoHojaVida"]["name"]["$key"] = "HV-".$_POST["editarNumeroIdentificacion"].".pdf";
    
                                $filenameHv = $_FILES["editarArchivoDocumentoHojaVida"]["name"]["$key"];
                                $sourceHv = $_FILES["editarArchivoDocumentoHojaVida"]["tmp_name"][$key];
    
                                $directorioHv = '../archivos_soft/Archivos/AdjuntosHV/';
    
                                if(!file_exists($directorioHv)){
    
                                    mkdir($directorioHv, 0777, true) or die("Fallo creacion carpeta");
    
                                }
    
                                $dirHv = opendir($directorioHv);
                                $target_pathHv = $directorioHv.$filenameHv;
    
                                if(move_uploaded_file($sourceHv, $target_pathHv)){
    
                                    $resultadoArchivo = "ok";
    
                                }else{
    
                                    $resultadoArchivo = "error";
    
                                }
    
                                closedir($dirHv);
    
                            }else{

                                $target_pathHv = $_POST["documentoAntiguoHv"];

                            }

                        }
        

                    }else{

                        $target_pathHv = $_POST["documentoAntiguoHv"];

                    }
                

                    /*===================================
                    VALIDAMOS SELECT QUE SE GENERAN SI SON DEL PAIS DE COLOMBIA
                    ====================================*/
                    if(isset($_POST["nuevaNacionalidad"]) && $_POST["nuevaNacionalidad"] != ""){

                        $nuevaNacionalidad = $_POST["nuevaNacionalidad"];


                    }else{

                        $nuevaNacionalidad = $_POST["editarNacionalidad"];


                    }

                    if($nuevaNacionalidad == "CO"){

                        if(isset($_POST["nuevoDepartamentoResidencia"]) && $_POST["nuevoDepartamentoResidencia"] != ""){

                            $nuevoDepartamentoResidencia = $_POST["nuevoDepartamentoResidencia"];
        
                        }else{
        
                            $nuevoDepartamentoResidencia = $_POST["editarDepartamentoResidencia"];
        
                        }
        
                        if(isset($_POST["nuevaCiudadResidencia"]) && $_POST["nuevaCiudadResidencia"] != ""){
        
                            $nuevaCiudadResidencia = $_POST["nuevaCiudadResidencia"];
        
                        }else{
        
                            $nuevaCiudadResidencia = $_POST["editarCiudadResidencia"];
        
                        }


                    }else{

                        $nuevoDepartamentoResidencia = "";

                        $nuevaCiudadResidencia = "";

                    }

                    $fechaActual = date('Y-m-d');

                    $tabla = "datos_personales";

                    $datos = array(

                        "tipo_documento_fk" => $_POST["editarTipoIdentificacion"],
                        "identificacion" => $_POST["editarNumeroIdentificacion"],
                        "nombres" => $_POST["editarNombres"],
                        "apellidos" => $_POST["editarApellidos"],
                        "adjunto_documento" => $target_path,
                        "hv_adjunto_documento" => $target_pathHv,
                        "nombre_adjunto_documento" => $filename,
                        "fecha_nacimiento" => $_POST["editarFechaNacimiento"],
                        "nacionalidad_fk" => $nuevaNacionalidad,
                        "departamento_residencia" => $nuevoDepartamentoResidencia,
                        "ciudad_residencia" => $nuevaCiudadResidencia,
                        "profesion" => $_POST["editarProfesion"],
                        "correo_electronico" => $_POST["editarCorreoElectronico"],
                        "direccion_residencia" => $_POST["editarDireccionResidencia"],
                        "numero_celular" => $_POST["editarCelular"],
                        "numero_celular_2" => $_POST["editarCelular2"],
                        "numero_telefono" => $_POST["editarTelefono"],
                        "usuario_modifico" => $_SESSION["correo"],
                        "fecha_modificacion" => $fechaActual,
                        "id_datos_personales" => $_POST["idDatosPersonalesEditar"]

                    );

                    $respuesta = ModeloHojaVida::mdlEditarDatosPersonales($tabla, $datos);

                    var_dump($respuesta);

                    if($respuesta == "ok"){

                        echo "<script>

                            swal({

                                type: 'success',
                                title: '¡Los Datos Personales fueron actualizados.!',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar'

                            }).then(function(result){

                                if(result.value){
                                
                                    window.location = 'index.php?ruta=ver-datos-personales-hv&idDatosPersonales=".$_POST["idDatosPersonalesEditar"]."';

                                }

                            });
                    

                        </script>";


                    }
        

            }else{

                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡Error/es en el Formulario!',
                        html: '<b>Tenga en cuenta las siguientes recomendaciones:</b><br><br>'+
                                '1 - Los campos Nombres, Apellidos y Profesión no deben contener caracteres especiales.<br><br>'+
                                '2 - Los campos Número Celular, Número Celular 2 y Telefono no deben contener letras',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = 'index.php?ruta=ver-datos-personales-hv&idDatosPersonales=".$_POST["idDatosPersonalesEditar"]."';

                        }

                    });

			    </script>";

            }

        }else{

            echo '<script>

				swal({

					type: "error",
					title: "¡Ocurrio un error inesperado por favor, vuelve a intentarlo!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "datos-personales-hv";

					}

				});
			

			</script>';

        }

    }

    /*===============================
    CREAR DATOS PERSONALES
    =================================*/
    public static function ctrCrearDatosPersonalesAdmin(){

        if(isset($_POST["crearDatosAdicionales"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevosNombres"]) &&
                preg_match('/^[0-9]+$/', $_POST["nuevoNumeroIdentificacion"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevosApellidos"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaProfesion"]) &&
                preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $_POST["nuevoCorreoElectronico"]) &&
                preg_match('/^[0-9 ]+$/', $_POST["nuevoCelular"])){
                
                foreach ($_FILES["nuevoArchivoDocumentoIdentidad"]["type"] as $key => $tipo) {

                    $mimeArchivo = $tipo;

                }

                if($mimeArchivo == "application/pdf"){

                    foreach ($_FILES["nuevoArchivoDocumentoIdentidad"]["tmp_name"] as $key => $tmp_name) {
                        
                        if($_FILES["nuevoArchivoDocumentoIdentidad"]["name"][$key]){

                            foreach($_FILES["nuevoArchivoDocumentoHojaVida"]["tmp_name"] as $key => $tmp_name){

                                if($_FILES["nuevoArchivoDocumentoHojaVida"]["name"][$key]){

                                    $_FILES["nuevoArchivoDocumentoIdentidad"]["name"]["$key"] = "DI-".$_POST["nuevoNumeroIdentificacion"].".pdf";

                                    $filename = $_FILES["nuevoArchivoDocumentoIdentidad"]["name"]["$key"];
                                    $source = $_FILES["nuevoArchivoDocumentoIdentidad"]["tmp_name"][$key];

                                    $_FILES["nuevoArchivoDocumentoHojaVida"]["name"]["$key"] = "HV-".$_POST["nuevoNumeroIdentificacion"].".pdf";

                                    $filenameHv = $_FILES["nuevoArchivoDocumentoHojaVida"]["name"]["$key"];
                                    $sourceHv = $_FILES["nuevoArchivoDocumentoHojaVida"]["tmp_name"][$key];

                                    $directorio = '../archivos_soft/Archivos/AdjuntosDoc/';

                                    $directorioHv = '../archivos_soft/Archivos/AdjuntosHV/';


                                    if(!file_exists($directorio)){

                                        mkdir($directorio, 0777, true) or die("Fallo creacion carpeta");

                                    }

                                    if(!file_exists($directorioHv)){

                                        mkdir($directorioHv, 0777, true) or die("Fallo creacion carpeta");

                                    }

                                    $dir = opendir($directorio);
                                    $target_path = $directorio.$filename;

                                    $dirHv = opendir($directorioHv);
                                    $target_pathHv = $directorioHv.$filenameHv;

                                    if(move_uploaded_file($source, $target_path)){

                                        $resultadoArchivo = "ok";

                                    }else{

                                        $resultadoArchivo = "error";

                                    }

                                    closedir($dir);

                                    if(move_uploaded_file($sourceHv, $target_pathHv)){

                                        $resultadoArchivo = "ok";

                                    }else{

                                        $resultadoArchivo = "error";

                                    }

                                    closedir($dirHv);


                                    /*===================================
                                    VALIDAMOS SELECT QUE SE GENERAN SI SON DEL PAIS DE COLOMBIA
                                    ====================================*/
                                    if(isset($_POST["nuevoDepartamentoResidencia"])){

                                        $nuevoDepartamentoResidencia = $_POST["nuevoDepartamentoResidencia"];

                                    }else{

                                        $nuevoDepartamentoResidencia = "";

                                    }

                                    if(isset($_POST["nuevaCiudadResidencia"])){

                                        $nuevaCiudadResidencia = $_POST["nuevaCiudadResidencia"];

                                    }else{

                                        $nuevaCiudadResidencia = "";

                                    }

                                    $tabla = "datos_personales";

                                    $datos = array(

                                        "tipo_documento_fk" => $_POST["nuevoTipoIdentificacion"],
                                        "identificacion" => $_POST["nuevoNumeroIdentificacion"],
                                        "nombres" => $_POST["nuevosNombres"],
                                        "apellidos" => $_POST["nuevosApellidos"],
                                        "adjunto_documento" => $target_path,
                                        "hv_adjunto_documento" => $target_pathHv,
                                        "nombre_adjunto_documento" => $filename,
                                        "fecha_nacimiento" => $_POST["nuevoFechaNacimiento"],
                                        "nacionalidad_fk" => $_POST["nuevaNacionalidad"],
                                        "departamento_residencia" => $nuevoDepartamentoResidencia,
                                        "ciudad_residencia" => $nuevaCiudadResidencia,
                                        "profesion" => $_POST["nuevaProfesion"],
                                        "correo_electronico" => $_POST["nuevoCorreoElectronico"],
                                        "direccion_residencia" => $_POST["nuevaDireccionResidencia"],
                                        "numero_celular" => $_POST["nuevoCelular"],
                                        "numero_celular_2" => $_POST["nuevoCelular2"],
                                        "numero_telefono" => $_POST["nuevoTelefono"],
                                        "usuario_creacion" => $_SESSION["correo"]

                                    );


                                    $respuesta = ModeloHojaVida::mdlCrearDatosPersonales($tabla, $datos);

                                    if($respuesta == "ok"){

                                        echo "<script>

                                            swal({

                                                type: 'success',
                                                title: '¡Sus Datos Personales fueron guardados correctamente.!',
                                                showConfirmButton: true,
                                                confirmButtonText: 'Cerrar'

                                            }).then(function(result){

                                                if(result.value){
                                                
                                                    window.location = 'index.php?ruta=nivel-estudio-hv&idIdentificacion=".$datos["identificacion"]."';

                                                }

                                            });
                                    

                                        </script>";


                                    }

                                }

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
                            
                                window.location = 'admin-datos-personales';

                            }

                        });

			        </script>";

                }



            }else{

                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡Error/es en el Formulario!',
                        html: '<b>Tenga en cuenta las siguientes recomendaciones:</b><br><br>'+
                                '1 - Los campos Nombres, Apellidos y Profesión no deben contener caracteres especiales.<br><br>'+
                                '2 - Los campos Número Celular, Número Celular 2 y Telefono no deben contener letras',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = 'admin-datos-personales';

                        }

                    });

			    </script>";

            }

        }else{

            echo '<script>

				swal({

					type: "error",
					title: "¡Ocurrio un error inesperado por favor, vuelve a intentarlo!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "admin-datos-personales";

					}

				});
			

			</script>';

        }

    }

    /*===============================
    CREAR EXPERIENCIAS LABORALES
    ================================*/
    static public function ctrCrearExperienciasLaborales(){

        if(isset($_POST["crearExperienciaLaboral"])){

            if(isset($_POST["identificacionUsuario"])){

                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaEmpresaEntiedad"]) &&
                    preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCargoDesempeño"])){

                    foreach ($_FILES["nuevoDocumentoCertificacion"]["type"] as $key => $tipo) {

                        $mimeArchivo = $tipo;

                    }

                    if($mimeArchivo == "application/pdf"){

                        foreach ($_FILES["nuevoDocumentoCertificacion"]["tmp_name"] as $key => $tmp_name) {
                            
                            if($_FILES["nuevoDocumentoCertificacion"]["name"][$key]){

                                $tablaConsultar = "experiencia_laboral";
                                $identificacion = $_POST["identificacionUsuario"];

                                $resultadoConsulta = ModeloHojaVida::mdlCantidadExperienciasLaborales($tablaConsultar, $identificacion);

                                $contadorArchivo = $resultadoConsulta["cantidad"] + 1;


                                $_FILES["nuevoDocumentoCertificacion"]["name"]["$key"] = "CL-".$_POST["identificacionUsuario"]."-".$contadorArchivo.".pdf";

                                $filename = $_FILES["nuevoDocumentoCertificacion"]["name"]["$key"];
                                $source = $_FILES["nuevoDocumentoCertificacion"]["tmp_name"][$key];

                                $directorio = '../archivos_soft/Archivos/AdjuntosCerti/';

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

                                $tabla = "experiencia_laboral";

                                $datos = array(

                                    "empresa_entidad" => $_POST["nuevaEmpresaEntiedad"],
                                    "sector_id" => $_POST["nuevoSector"],
                                    "cargo" => $_POST["nuevoCargoDesempeño"],
                                    "area_trabajo" => $_POST["nuevaAreaTrabajo"],
                                    "valor_contrato_salario" => $_POST["nuevoValorSalario"],
                                    "fecha_inicio" => $_POST["nuevaFechaInicioLabor"],
                                    "fecha_fin" => $_POST["nuevaFechaFinalLabor"],
                                    "tiempo_dias" => $_POST["nuevoDiasLaborados"],
                                    "tiempo_meses" => $_POST["nuevoMesesLaborados"],
                                    "tiempo_anios" => $_POST["nuevoAniosLaborados"],
                                    "tipo_documento" => $_POST["nuevoTipoDocumento"],
                                    "nombre_archivo" => $filename,
                                    "adjunto_certificacion" => $target_path,
                                    "objeto_contrato" => $_POST["nuevoCertificadoFunciones"],
                                    "identificacion_fk" => $_POST["identificacionUsuario"],
                                    "usuario_creacion" => $_SESSION["correo"]

                                );

                                $respuesta = ModeloHojaVida::mdlCrearExperienciasLaborales($tabla, $datos);


                                if($respuesta == "ok"){

                                    echo "<script>

                                        swal({

                                            type: 'success',
                                            title: '¡La Experiencia Laboral fue guardada correctamente!',
                                            showConfirmButton: true,
                                            confirmButtonText: 'Cerrar'

                                        }).then(function(result){

                                            if(result.value){
                                            
                                                window.location = 'index.php?ruta=experiencia-laboral-hv&idIdentificacion=".$datos["identificacion_fk"]."';

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
                                
                                    window.location = 'index.php?ruta=experiencia-laboral-hv&idIdentificacion=".$_POST["identificacionUsuario"]."';

                                }

                            });

                        </script>";

                    }


                }else{

                    echo "<script>

                        swal({

                            type: 'error',
                            title: '¡Error/es en el Formulario!',
                            html: '<b>Tenga en cuenta las siguientes recomendaciones:</b><br><br>'+
                                    '1 - Los campos Empresa o Entidad Contratante, Cargo Desempeñado y Area de Trabajo no deben contener caracteres especiales.<br><br>'+
                                    '2 - El campo Valor Contrato y/o Salario no deben contener letras ni caracteres especiales',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar'

                        }).then(function(result){

                            if(result.value){
                            
                                window.location = 'index.php?ruta=experiencia-laboral-hv&idIdentificacion=".$_POST["identificacionUsuario"]."';

                            }

                        });

                    </script>";

                }


            }else{

                echo '<script>

                    swal({

                        type: "error",
                        title: "¡No ha seleccionado la Persona a la que se le creara la Experiencia Laboral!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = "inicio-hv";

                        }

                    });
			

			    </script>';


            }

        }else{

            echo '<script>

				swal({

					type: "error",
					title: "¡Ocurrio un error inesperado por favor, vuelve a intentarlo!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "datos-personales-hv";

					}

				});
			

			</script>';

        }


    }

    /*===============================
    CREAR EXPERIENCIAS LABORALES
    ================================*/
    static public function ctrEditarExperienciaLaboral(){

        if(isset($_POST["editarExperienciaLaboral"])){

            if(isset($_POST["idIdentificacionFk"])){

                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarEmpresaEntidad"]) &&
                    preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCargo"])){

                    foreach ($_FILES["editarDocumentoCertificacion"]["type"] as $key => $tipo) {

                        $mimeArchivo = $tipo;

                    }

                    foreach($_FILES["editarDocumentoCertificacion"]["name"] as $key => $nombre){

                        $nombreArchivo = $nombre;

                    }

                    if($nombreArchivo != ""){

                        if($mimeArchivo == "application/pdf"){

                            foreach ($_FILES["editarDocumentoCertificacion"]["tmp_name"] as $key => $tmp_name) {
                                
                                if($_FILES["editarDocumentoCertificacion"]["name"][$key]){

                                    $filename = $_POST["nombreArchivoAntiguo"];
                                    $source = $_FILES["editarDocumentoCertificacion"]["tmp_name"][$key];

                                    $directorio = '../archivos_soft/Archivos/AdjuntosCerti/';

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


                                }else{

                                    $target_path = $_POST["documentoAntiguo"];
                                    $filename = $_POST["nombreArchivoAntiguo"];

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
                                    
                                        window.location = window.location = 'index.php?ruta=experiencia-laboral-hv&idIdentificacion=".$_POST["idIdentificacionFk"]."';

                                    }

                                });

                            </script>";

                        }

                    }else{

                        $target_path = $_POST["documentoAntiguo"];
                        $filename = $_POST["nombreArchivoAntiguo"];                        

                    }

                    $fechaActual = date('Y-m-d');

                    $tabla = "experiencia_laboral";

                    $datos = array(

                        "empresa_entidad" => $_POST["editarEmpresaEntidad"],
                        "sector_id" => $_POST["editarSector"],
                        "cargo" => $_POST["editarCargo"],
                        "area_trabajo" => $_POST["editarAreaTrabajo"],
                        "valor_contrato_salario" => $_POST["editarValorContratoSalario"],
                        "fecha_inicio" => $_POST["editarFechaInicioLabor"],
                        "fecha_fin" => $_POST["editarFechaFinLabor"],
                        "tiempo_dias" => $_POST["editarTiempoLaboradoDias"],
                        "tiempo_meses" => $_POST["editarTiempoLaboradoMeses"],
                        "tiempo_anios" => $_POST["editarTiempoLaboradoAnios"],
                        "tipo_documento" => $_POST["editarTipoDocumento"],
                        "nombre_archivo" => $filename,
                        "adjunto_certificacion" => $target_path,
                        "objeto_contrato" => $_POST["editarCertificadoFunciones"],
                        "identificacion_fk" => $_POST["idIdentificacionFk"],
                        "usuario_modificacion" => $_SESSION["correo"],
                        "fecha_modificacion" => $fechaActual,
                        "id_experiencia_laboral" => $_POST["editarIdExperienciaLaboral"]

                    );

                    $respuesta = ModeloHojaVida::mdlEditarExperienciaLaboral($tabla, $datos);

                    if($respuesta == "ok"){

                        echo "<script>

                            swal({

                                type: 'success',
                                title: '¡La Experiencia Laboral fue guardada correctamente!',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar'

                            }).then(function(result){

                                if(result.value){
                                
                                    window.location = 'index.php?ruta=experiencia-laboral-hv&idIdentificacion=".$datos["identificacion_fk"]."';

                                }

                            });
                    

                        </script>";


                    }


                }else{

                    echo "<script>

                        swal({

                            type: 'error',
                            title: '¡Error/es en el Formulario!',
                            html: '<b>Tenga en cuenta las siguientes recomendaciones:</b><br><br>'+
                                    '1 - Los campos Empresa o Entidad Contratante, Cargo Desempeñado y Area de Trabajo no deben contener caracteres especiales.<br><br>'+
                                    '2 - El campo Valor Contrato y/o Salario no deben contener letras ni caracteres especiales',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar'

                        }).then(function(result){

                            if(result.value){
                            
                                window.location = 'index.php?ruta=experiencia-laboral-hv&idIdentificacion=".$_POST["idIdentificacionFk"]."';

                            }

                        });

                    </script>";

                }


            }else{

                echo '<script>

                    swal({

                        type: "error",
                        title: "¡No ha seleccionado la Persona a la que se le creara la Experiencia Laboral!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = "inicio-hv";

                        }

                    });
			

			    </script>';


            }

        }else{

            echo '<script>

				swal({

					type: "error",
					title: "¡Ocurrio un error inesperado por favor, vuelve a intentarlo!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "experiencia-laboral-hv";

					}

				});
			

			</script>';

        }


    }


    /*==============================
    OBTENER EXPERIENCIAS LABORALES
    ===============================*/
    static public function ctrMostrarExperienciasLaborales($item, $valor){

        $tabla = "experiencia_laboral";

        $respuesta = ModeloHojaVida::mdlMostrarExperienciasLaborales($tabla, $item, $valor);

        return $respuesta;

    }

    /*==============================
    OBTENER NIVELES ESTUDIO
    ===============================*/
    static public function ctrMostrarNivelesEstudios($item, $valor){

        $tabla = "nivel_estudio";

        $respuesta = ModeloHojaVida::mdlMostrarNivelesEstudios($tabla, $item, $valor);

        return $respuesta;

    }

    /*==============================
    VER NIVELES ESTUDIO
    ===============================*/
    static public function ctrVerNivelesEstudios($item, $valor){

        $tabla = "nivel_estudio";

        $respuesta = ModeloHojaVida::mdlVerNivelesEstudios($tabla, $item, $valor);

        return $respuesta;

    }

    /*==============================
    OBTENER EXPERIENCIAS LABORALES
    ===============================*/
    static public function ctrMostrarExperienciasLaboralesVer($item, $valor){

        $tabla = "experiencia_laboral";

        $respuesta = ModeloHojaVida::mdlMostrarExperienciasLaboralesVer($tabla, $item, $valor);

        return $respuesta;

    }

    /*========================
    ELIMINAR LA EXPERIENCIA LABORAL
    ==========================*/
    static public function ctrEliminarExperienciaLaboral(){

        if(isset($_GET["idExperienciaLaboralEliminar"])){

            $tabla = "experiencia_laboral";

            $datos = $_GET["idExperienciaLaboralEliminar"];
            $rutaArchivo = $_GET["rutaArchivo"];
            $idIdentificacion = $_GET["idIdentificacion"];

            if($rutaArchivo != ""){

                unlink($rutaArchivo);

            }

            $respuesta = ModeloHojaVida::mdlBorrarExperienciaLaboral($tabla, $datos);

            if($respuesta == "ok"){

                echo "<script>

                    swal({

                        type: 'success',
                        title: '¡La Experiencia Laboral fue eliminada correctamente!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = 'index.php?ruta=experiencia-laboral-hv&idIdentificacion=".$idIdentificacion."';

                        }

                    });
            

                </script>";


            }


        }

    }


    /*============================
    CREAR NIVEL EDUCACION - FORMACION
    =============================*/
    static public function ctrCrearFormacion(){

        $tabla = "nivel_estudio";

        if(isset($_POST["crarFormacionBachi"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaInstitucionEducativaBachi"])){

                foreach ($_FILES["nuevoArchivoNivelEstudioBachi"]["type"] as $key => $tipo) {

                    $mimeArchivo = $tipo;

                }

                if($mimeArchivo == "application/pdf"){

                    foreach ($_FILES["nuevoArchivoNivelEstudioBachi"]["tmp_name"] as $key => $tmp_name) {
                        
                        if($_FILES["nuevoArchivoNivelEstudioBachi"]["name"][$key]){

                            $tablaConsultar = "nivel_estudio";
                            $identificacion = $_POST["identificacionBachi"];

                            $resultadoConsulta = ModeloHojaVida::mdlCantidadExperienciasLaborales($tablaConsultar, $identificacion);

                            $contadorArchivo = $resultadoConsulta["cantidad"] + 1;

                            $_FILES["nuevoArchivoNivelEstudioBachi"]["name"]["$key"] = "DPAC-".$_POST["identificacionBachi"]."-".$contadorArchivo.".pdf";

                            $filename = $_FILES["nuevoArchivoNivelEstudioBachi"]["name"]["$key"];
                            $source = $_FILES["nuevoArchivoNivelEstudioBachi"]["tmp_name"][$key];

                            $directorio = '../archivos_soft/Archivos/AdjuntosDipActas/';

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

                            $datos = array(

                                "institucion_secundaria" => $_POST["nuevaInstitucionEducativaBachi"],
                                "fecha_finalizacion" => $_POST["nuevaFechaGradoBachi"],
                                "adjunto_diploma" => $target_path,
                                "nombre_archivo" => $filename,
                                "id_nivel_educativo" => $_POST["nuevoNivelEducacionBachi"],
                                "identificacion_fk" => $_POST["identificacionBachi"],
                                "titulo_obtenido" => $_POST["nuevoTituloObtenidoBachi"]
            
                            );

                            $respuesta = ModeloHojaVida::mdlCrearFormacion($tabla, $datos);

                            if($respuesta == "ok"){

                                echo "<script>

                                    swal({

                                        type: 'success',
                                        title: '¡La Formación fue guardada correctamente!',
                                        showConfirmButton: true,
                                        confirmButtonText: 'Cerrar'

                                    }).then(function(result){

                                        if(result.value){
                                            
                                            window.location = 'index.php?ruta=nivel-estudio-hv&idIdentificacion=".$datos["identificacion_fk"]."';

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

            }

        }else if(isset($_POST["crearFormacionTecniLab"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoTituloOtorgadoTecLaboral"])){

                foreach ($_FILES["nuevoArchivoNivelEstudioTecLaboral"]["type"] as $key => $tipo) {

                    $mimeArchivo = $tipo;

                }

                if($mimeArchivo == "application/pdf"){

                    foreach ($_FILES["nuevoArchivoNivelEstudioTecLaboral"]["tmp_name"] as $key => $tmp_name) {
                        
                        if($_FILES["nuevoArchivoNivelEstudioTecLaboral"]["name"][$key]){

                            $tablaConsultar = "nivel_estudio";
                            $identificacion = $_POST["identificacionPersona"];

                            $resultadoConsulta = ModeloHojaVida::mdlCantidadExperienciasLaborales($tablaConsultar, $identificacion);

                            $contadorArchivo = $resultadoConsulta["cantidad"] + 1;

                            $_FILES["nuevoArchivoNivelEstudioTecLaboral"]["name"]["$key"] = "DPAC-".$_POST["identificacionPersona"]."-".$contadorArchivo.".pdf";

                            $filename = $_FILES["nuevoArchivoNivelEstudioTecLaboral"]["name"]["$key"];
                            $source = $_FILES["nuevoArchivoNivelEstudioTecLaboral"]["tmp_name"][$key];

                            $directorio = '../archivos_soft/Archivos/AdjuntosDipActas/';

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

                            if(isset($_POST["nuevaInstitucionEducativaOtro"])){

                                $campoInstitucionOtro = $_POST["nuevaInstitucionEducativaOtro"];

                            }else{

                                $campoInstitucionOtro = "";

                            }

                            $datos = array(

                                "institucion_educativa_id" => $_POST["nuevaInstitucionEducativa"],
                                "institucion_educativa_otro" => $campoInstitucionOtro,
                                "fecha_finalizacion" => $_POST["nuevaFechaGradoTecLaboral"],
                                "adjunto_diploma" => $target_path,
                                "nombre_archivo" => $filename,
                                "id_nivel_educativo" => $_POST["nuevoNivelEducacion"],
                                "identificacion_fk" => $_POST["identificacionPersona"],
                                "titulo_obtenido" => $_POST["nuevoTituloOtorgadoTecLaboral"],
                                "documento_adjunto" => $_POST["nuevoDiplomaActaTecLaboral"],
            
                            );

                            $respuesta = ModeloHojaVida::mdlCrearFormacion($tabla, $datos);

                            if($respuesta == "ok"){

                                echo "<script>

                                    swal({

                                        type: 'success',
                                        title: '¡La Formación fue guardada correctamente!',
                                        showConfirmButton: true,
                                        confirmButtonText: 'Cerrar'

                                    }).then(function(result){

                                        if(result.value){
                                        
                                            window.location = 'index.php?ruta=nivel-estudio-hv&idIdentificacion=".$datos["identificacion_fk"]."';

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

                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡El Titulo Otorgado no puede contener caracteres especiales.!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = 'index.php?ruta=nivel-estudio-hv&idIdentificacion=".$_POST["identificacionPersona"]."';

                        }

                    });

                    
                </script>";


            }

        }else if(isset($_POST["crearFormacionTecniPro"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoTituloOtorgadoTecPro"])){

                foreach ($_FILES["nuevoArchivoNivelEstudioTecPro"]["type"] as $key => $tipo) {

                    $mimeArchivo = $tipo;

                }

                if($mimeArchivo == "application/pdf"){

                    foreach ($_FILES["nuevoArchivoNivelEstudioTecPro"]["tmp_name"] as $key => $tmp_name) {
                        
                        if($_FILES["nuevoArchivoNivelEstudioTecPro"]["name"][$key]){

                            $tablaConsultar = "nivel_estudio";
                            $identificacion = $_POST["identificacionPersona"];

                            $resultadoConsulta = ModeloHojaVida::mdlCantidadExperienciasLaborales($tablaConsultar, $identificacion);

                            $contadorArchivo = $resultadoConsulta["cantidad"] + 1;

                            $_FILES["nuevoArchivoNivelEstudioTecPro"]["name"]["$key"] = "DPAC-".$_POST["identificacionPersona"]."-".$contadorArchivo.".pdf";

                            $filename = $_FILES["nuevoArchivoNivelEstudioTecPro"]["name"]["$key"];
                            $source = $_FILES["nuevoArchivoNivelEstudioTecPro"]["tmp_name"][$key];

                            $directorio = '../archivos_soft/Archivos/AdjuntosDipActas/';

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

                            if(isset($_POST["nuevaInstitucionEducativaOtro"])){

                                $campoInstitucionOtro = $_POST["nuevaInstitucionEducativaOtro"];

                            }else{

                                $campoInstitucionOtro = "";

                            }

                            $datos = array(

                                "institucion_educativa_id" => $_POST["nuevaInstitucionEducativa"],
                                "institucion_educativa_otro" => $campoInstitucionOtro,
                                "fecha_finalizacion" => $_POST["nuevaFechaGradoTecPro"],
                                "adjunto_diploma" => $target_path,
                                "nombre_archivo" => $filename,
                                "id_nivel_educativo" => $_POST["nuevoNivelEducacion"],
                                "identificacion_fk" => $_POST["identificacionPersona"],
                                "titulo_obtenido" => $_POST["nuevoTituloOtorgadoTecPro"],
                                "documento_adjunto" => $_POST["nuevoDiplomaActaTecPro"],
            
                            );

                            $respuesta = ModeloHojaVida::mdlCrearFormacion($tabla, $datos);

                            if($respuesta == "ok"){

                                echo "<script>

                                    swal({

                                        type: 'success',
                                        title: '¡La Formación fue guardada correctamente!',
                                        showConfirmButton: true,
                                        confirmButtonText: 'Cerrar'

                                    }).then(function(result){

                                        if(result.value){
                                        
                                            window.location = 'index.php?ruta=nivel-estudio-hv&idIdentificacion=".$datos["identificacion_fk"]."';

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

                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡El Titulo Otorgado no puede contener caracteres especiales.!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = 'index.php?ruta=nivel-estudio-hv&idIdentificacion=".$_POST["identificacionPersona"]."';

                        }

                    });

                    
                </script>";

            }

        }else if(isset($_POST["crearFormacionTecnologica"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoTituloOtorgadoTecnologica"])){

                foreach ($_FILES["nuevoArchivoNivelEstudioTecnologica"]["type"] as $key => $tipo) {

                    $mimeArchivo = $tipo;

                }

                if($mimeArchivo == "application/pdf"){

                    foreach ($_FILES["nuevoArchivoNivelEstudioTecnologica"]["tmp_name"] as $key => $tmp_name) {
                        
                        if($_FILES["nuevoArchivoNivelEstudioTecnologica"]["name"][$key]){

                            $tablaConsultar = "nivel_estudio";
                            $identificacion = $_POST["identificacionPersona"];

                            $resultadoConsulta = ModeloHojaVida::mdlCantidadExperienciasLaborales($tablaConsultar, $identificacion);

                            $contadorArchivo = $resultadoConsulta["cantidad"] + 1;

                            $_FILES["nuevoArchivoNivelEstudioTecnologica"]["name"]["$key"] = "DPAC-".$_POST["identificacionPersona"]."-".$contadorArchivo.".pdf";

                            $filename = $_FILES["nuevoArchivoNivelEstudioTecnologica"]["name"]["$key"];
                            $source = $_FILES["nuevoArchivoNivelEstudioTecnologica"]["tmp_name"][$key];

                            $directorio = '../archivos_soft/Archivos/AdjuntosDipActas/';

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

                            if(isset($_POST["nuevaInstitucionEducativaOtro"])){

                                $campoInstitucionOtro = $_POST["nuevaInstitucionEducativaOtro"];

                            }else{

                                $campoInstitucionOtro = "";

                            }

                            $datos = array(

                                "institucion_educativa_id" => $_POST["nuevaInstitucionEducativa"],
                                "institucion_educativa_otro" => $campoInstitucionOtro,
                                "fecha_finalizacion" => $_POST["nuevaFechaGradoTecnologica"],
                                "adjunto_diploma" => $target_path,
                                "nombre_archivo" => $filename,
                                "id_nivel_educativo" => $_POST["nuevoNivelEducacion"],
                                "identificacion_fk" => $_POST["identificacionPersona"],
                                "titulo_obtenido" => $_POST["nuevoTituloOtorgadoTecnologica"],
                                "documento_adjunto" => $_POST["nuevoDiplomaActaTecnologica"],
            
                            );

                            $respuesta = ModeloHojaVida::mdlCrearFormacion($tabla, $datos);

                            if($respuesta == "ok"){

                                echo "<script>

                                    swal({

                                        type: 'success',
                                        title: '¡La Formación fue guardada correctamente!',
                                        showConfirmButton: true,
                                        confirmButtonText: 'Cerrar'

                                    }).then(function(result){

                                        if(result.value){
                                        
                                            window.location = 'index.php?ruta=nivel-estudio-hv&idIdentificacion=".$datos["identificacion_fk"]."';

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

                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡El Titulo Otorgado no puede contener caracteres especiales.!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = 'index.php?ruta=nivel-estudio-hv&idIdentificacion=".$_POST["identificacionPersona"]."';

                        }

                    });

                    
                </script>";

            }

        }else if(isset($_POST["crearFormacionUniversitaria"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoTituloOtorgadoUni"])){


                foreach ($_FILES["nuevoArchivoNivelEstudioUni"]["type"] as $key => $tipo) {

                    $mimeArchivo = $tipo;

                }

                if($mimeArchivo == "application/pdf"){

                    foreach ($_FILES["nuevoArchivoNivelEstudioUni"]["tmp_name"] as $key => $tmp_name) {
                        
                        if($_FILES["nuevoArchivoNivelEstudioUni"]["name"][$key]){

                            $tablaConsultar = "nivel_estudio";
                            $identificacion = $_POST["identificacionPersona"];

                            $resultadoConsulta = ModeloHojaVida::mdlCantidadExperienciasLaborales($tablaConsultar, $identificacion);

                            $contadorArchivo = $resultadoConsulta["cantidad"] + 1;

                            $_FILES["nuevoArchivoNivelEstudioUni"]["name"]["$key"] = "DPAC-".$_POST["identificacionPersona"]."-".$contadorArchivo.".pdf";

                            $filename = $_FILES["nuevoArchivoNivelEstudioUni"]["name"]["$key"];
                            $source = $_FILES["nuevoArchivoNivelEstudioUni"]["tmp_name"][$key];

                            $directorio = '../archivos_soft/Archivos/AdjuntosDipActas/';

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



                            foreach ($_FILES["nuevoArchivoTarjetaProfesionalUni"]["type"] as $key => $tipo) {

                                $mimeArchivo = $tipo;
            
                            }

                            if($mimeArchivo == "application/pdf"){

                                foreach ($_FILES["nuevoArchivoTarjetaProfesionalUni"]["tmp_name"] as $key => $tmp_name) {
                                    
                                    if($_FILES["nuevoArchivoTarjetaProfesionalUni"]["name"][$key]){
            
                                        $tablaConsultar = "nivel_estudio";
                                        $identificacion = $_POST["identificacionPersona"];
            
                                        $resultadoConsulta = ModeloHojaVida::mdlCantidadExperienciasLaborales($tablaConsultar, $identificacion);
            
                                        $contadorArchivo = $resultadoConsulta["cantidad"] + 2;
            
                                        $_FILES["nuevoArchivoTarjetaProfesionalUni"]["name"]["$key"] = "TP-".$_POST["identificacionPersona"]."-".$contadorArchivo.".pdf";
            
                                        $filenameTarjeta = $_FILES["nuevoArchivoTarjetaProfesionalUni"]["name"]["$key"];
                                        $sourceTarjeta = $_FILES["nuevoArchivoTarjetaProfesionalUni"]["tmp_name"][$key];
            
                                        $directorioTarjeta = '../archivos_soft/Archivos/AdjuntosDipActas/';
            
                                        if(!file_exists($directorio)){
            
                                            mkdir($directorio, 0777, true) or die("Fallo creacion carpeta");
            
                                        }
            
                                        $dirTarjeta = opendir($directorioTarjeta);
                                        $target_path_tarjeta = $directorioTarjeta.$filenameTarjeta;
            
                                        if(move_uploaded_file($sourceTarjeta, $target_path_tarjeta)){
            
                                            $resultadoArchivo = "ok";
            
                                        }else{
            
                                            $resultadoArchivo = "error";
            
                                        }
            
                                        closedir($dirTarjeta);
            
                                    }
            
                                }
            
            
                            }else{
                                
                                $target_path_tarjeta = "";
                                $filenameTarjeta = "";
                              
                            }

                            if(isset($_POST["nuevaInstitucionEducativaOtro"])){

                                $campoInstitucionOtro = $_POST["nuevaInstitucionEducativaOtro"];

                            }else{

                                $campoInstitucionOtro = "";

                            }

                            if(isset($_POST["nuevaFechaExpTarjetaUni"])){

                                $fechaExpedicionTarjeta = $_POST["nuevaFechaExpTarjetaUni"];

                            }else{

                                $fechaExpedicionTarjeta = "";

                            }

                            if(isset($_POST["nuevaFechaTerminacionMateriasUni"])){

                                $fechaFinalizacionMaterias = $_POST["nuevaFechaTerminacionMateriasUni"];

                            }else{

                                $fechaFinalizacionMaterias =  "";

                            }

                            $datos = array(

                                "institucion_educativa_id" => $_POST["nuevaInstitucionEducativa"],
                                "institucion_educativa_otro" => $campoInstitucionOtro,
                                "fecha_finalizacion" => $_POST["nuevaFechaGradoUni"],
                                "adjunto_diploma" => $target_path,
                                "nombre_archivo" => $filename,
                                "id_nivel_educativo" => $_POST["nuevoNivelEducacion"],
                                "identificacion_fk" => $_POST["identificacionPersona"],
                                "titulo_obtenido" => $_POST["nuevoTituloOtorgadoUni"],
                                "documento_adjunto" => $_POST["nuevoDiplomaActaUni"],
                                "adjunto_tarjeta_profesional" => $target_path_tarjeta,
                                "nombre_archivo_tarjeta" => $filenameTarjeta,
                                "fecha_expedicion_tarjeta" => $fechaExpedicionTarjeta,
                                "fecha_finalizacion_materias" => $fechaFinalizacionMaterias
            
                            );

                            $respuesta = ModeloHojaVida::mdlCrearFormacion($tabla, $datos);

                            if($respuesta == "ok"){

                                echo "<script>

                                    swal({

                                        type: 'success',
                                        title: '¡La Formación fue guardada correctamente!',
                                        showConfirmButton: true,
                                        confirmButtonText: 'Cerrar'

                                    }).then(function(result){

                                        if(result.value){
                                        
                                            window.location = 'index.php?ruta=nivel-estudio-hv&idIdentificacion=".$datos["identificacion_fk"]."';

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

                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡El Titulo Otorgado no puede contener caracteres especiales.!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = 'index.php?ruta=nivel-estudio-hv&idIdentificacion=".$_POST["identificacionPersona"]."';

                        }

                    });

                    
                </script>";

            }

        }else if(isset($_POST["crearFormacionEspecializacion"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoTituloOtorgadoEsp"])){


                foreach ($_FILES["nuevoArchivoNivelEstudioEsp"]["type"] as $key => $tipo) {

                    $mimeArchivo = $tipo;

                }

                if($mimeArchivo == "application/pdf"){

                    foreach ($_FILES["nuevoArchivoNivelEstudioEsp"]["tmp_name"] as $key => $tmp_name) {
                        
                        if($_FILES["nuevoArchivoNivelEstudioEsp"]["name"][$key]){

                            $tablaConsultar = "nivel_estudio";
                            $identificacion = $_POST["identificacionPersona"];

                            $resultadoConsulta = ModeloHojaVida::mdlCantidadExperienciasLaborales($tablaConsultar, $identificacion);

                            $contadorArchivo = $resultadoConsulta["cantidad"] + 1;

                            $_FILES["nuevoArchivoNivelEstudioEsp"]["name"]["$key"] = "DPAC-".$_POST["identificacionPersona"]."-".$contadorArchivo.".pdf";

                            $filename = $_FILES["nuevoArchivoNivelEstudioEsp"]["name"]["$key"];
                            $source = $_FILES["nuevoArchivoNivelEstudioEsp"]["tmp_name"][$key];

                            $directorio = '../archivos_soft/Archivos/AdjuntosDipActas/';

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

                            if(isset($_POST["nuevaInstitucionEducativaOtro"])){

                                $campoInstitucionOtro = $_POST["nuevaInstitucionEducativaOtro"];

                            }else{

                                $campoInstitucionOtro = "";

                            }

                            $datos = array(

                                "institucion_educativa_id" => $_POST["nuevaInstitucionEducativa"],
                                "institucion_educativa_otro" => $campoInstitucionOtro,
                                "fecha_finalizacion" => $_POST["nuevaFechaGradoEsp"],
                                "adjunto_diploma" => $target_path,
                                "nombre_archivo" => $filename,
                                "id_nivel_educativo" => $_POST["nuevoNivelEducacion"],
                                "identificacion_fk" => $_POST["identificacionPersona"],
                                "titulo_obtenido" => $_POST["nuevoTituloOtorgadoEsp"],
                                "documento_adjunto" => $_POST["nuevoDiplomaActaEsp"]
            
                            );

                            $respuesta = ModeloHojaVida::mdlCrearFormacion($tabla, $datos);


                            if($respuesta == "ok"){

                                echo "<script>

                                    swal({

                                        type: 'success',
                                        title: '¡La Formación fue guardada correctamente!',
                                        showConfirmButton: true,
                                        confirmButtonText: 'Cerrar'

                                    }).then(function(result){

                                        if(result.value){
                                        
                                            window.location = 'index.php?ruta=nivel-estudio-hv&idIdentificacion=".$datos["identificacion_fk"]."';

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

                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡El Titulo Otorgado no puede contener caracteres especiales.!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = 'index.php?ruta=nivel-estudio-hv&idIdentificacion=".$_POST["identificacionPersona"]."';

                        }

                    });

                    
                </script>";

            }


        }else if(isset($_POST["crearFormacionMaestria"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoTituloOtorgadoMae"])){


                foreach ($_FILES["nuevoArchivoNivelEstudioMae"]["type"] as $key => $tipo) {

                    $mimeArchivo = $tipo;

                }

                if($mimeArchivo == "application/pdf"){

                    foreach ($_FILES["nuevoArchivoNivelEstudioMae"]["tmp_name"] as $key => $tmp_name) {
                        
                        if($_FILES["nuevoArchivoNivelEstudioMae"]["name"][$key]){

                            $tablaConsultar = "nivel_estudio";
                            $identificacion = $_POST["identificacionPersona"];

                            $resultadoConsulta = ModeloHojaVida::mdlCantidadExperienciasLaborales($tablaConsultar, $identificacion);

                            $contadorArchivo = $resultadoConsulta["cantidad"] + 1;

                            $_FILES["nuevoArchivoNivelEstudioMae"]["name"]["$key"] = "DPAC-".$_POST["identificacionPersona"]."-".$contadorArchivo.".pdf";

                            $filename = $_FILES["nuevoArchivoNivelEstudioMae"]["name"]["$key"];
                            $source = $_FILES["nuevoArchivoNivelEstudioMae"]["tmp_name"][$key];

                            $directorio = '../archivos_soft/Archivos/AdjuntosDipActas/';

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

                            if(isset($_POST["nuevaInstitucionEducativaOtro"])){

                                $campoInstitucionOtro = $_POST["nuevaInstitucionEducativaOtro"];

                            }else{

                                $campoInstitucionOtro = "";

                            }

                            $datos = array(

                                "institucion_educativa_id" => $_POST["nuevaInstitucionEducativa"],
                                "institucion_educativa_otro" => $campoInstitucionOtro,
                                "fecha_finalizacion" => $_POST["nuevaFechaGradoMae"],
                                "adjunto_diploma" => $target_path,
                                "nombre_archivo" => $filename,
                                "id_nivel_educativo" => $_POST["nuevoNivelEducacion"],
                                "identificacion_fk" => $_POST["identificacionPersona"],
                                "titulo_obtenido" => $_POST["nuevoTituloOtorgadoMae"],
                                "documento_adjunto" => $_POST["nuevoDiplomaActaMae"]
            
                            );


                            $respuesta = ModeloHojaVida::mdlCrearFormacion($tabla, $datos);

                            if($respuesta == "ok"){

                                echo "<script>

                                    swal({

                                        type: 'success',
                                        title: '¡La Formación fue guardada correctamente!',
                                        showConfirmButton: true,
                                        confirmButtonText: 'Cerrar'

                                    }).then(function(result){

                                        if(result.value){
                                        
                                            window.location = 'index.php?ruta=nivel-estudio-hv&idIdentificacion=".$datos["identificacion_fk"]."';

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

                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡El Titulo Otorgado no puede contener caracteres especiales.!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = 'index.php?ruta=nivel-estudio-hv&idIdentificacion=".$_POST["identificacionPersona"]."';

                        }

                    });

                    
                </script>";

            }

        }else if(isset($_POST["crearFormacionDoctorado"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoTituloOtorgadoDoc"])){


                foreach ($_FILES["nuevoArchivoNivelEstudioDoc"]["type"] as $key => $tipo) {

                    $mimeArchivo = $tipo;

                }

                if($mimeArchivo == "application/pdf"){

                    foreach ($_FILES["nuevoArchivoNivelEstudioDoc"]["tmp_name"] as $key => $tmp_name) {
                        
                        if($_FILES["nuevoArchivoNivelEstudioDoc"]["name"][$key]){

                            $tablaConsultar = "nivel_estudio";
                            $identificacion = $_POST["identificacionPersona"];

                            $resultadoConsulta = ModeloHojaVida::mdlCantidadExperienciasLaborales($tablaConsultar, $identificacion);

                            $contadorArchivo = $resultadoConsulta["cantidad"] + 1;

                            $_FILES["nuevoArchivoNivelEstudioDoc"]["name"]["$key"] = "DPAC-".$_POST["identificacionPersona"]."-".$contadorArchivo.".pdf";

                            $filename = $_FILES["nuevoArchivoNivelEstudioDoc"]["name"]["$key"];
                            $source = $_FILES["nuevoArchivoNivelEstudioDoc"]["tmp_name"][$key];

                            $directorio = '../archivos_soft/Archivos/AdjuntosDipActas/';

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

                            if(isset($_POST["nuevaInstitucionEducativaOtro"])){

                                $campoInstitucionOtro = $_POST["nuevaInstitucionEducativaOtro"];

                            }else{

                                $campoInstitucionOtro = "";

                            }

                            $datos = array(

                                "institucion_educativa_id" => $_POST["nuevaInstitucionEducativa"],
                                "institucion_educativa_otro" => $campoInstitucionOtro,
                                "fecha_finalizacion" => $_POST["nuevaFechaGradoDoc"],
                                "adjunto_diploma" => $target_path,
                                "nombre_archivo" => $filename,
                                "id_nivel_educativo" => $_POST["nuevoNivelEducacion"],
                                "identificacion_fk" => $_POST["identificacionPersona"],
                                "titulo_obtenido" => $_POST["nuevoTituloOtorgadoDoc"],
                                "documento_adjunto" => $_POST["nuevoDiplomaActaDoc"]
            
                            );


                            $respuesta = ModeloHojaVida::mdlCrearFormacion($tabla, $datos);

                            if($respuesta == "ok"){

                                echo "<script>

                                    swal({

                                        type: 'success',
                                        title: '¡La Formación fue guardada correctamente!',
                                        showConfirmButton: true,
                                        confirmButtonText: 'Cerrar'

                                    }).then(function(result){

                                        if(result.value){
                                        
                                            window.location = 'index.php?ruta=nivel-estudio-hv&idIdentificacion=".$datos["identificacion_fk"]."';

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


                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡El Titulo Otorgado no puede contener caracteres especiales.!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = 'index.php?ruta=nivel-estudio-hv&idIdentificacion=".$_POST["identificacionPersona"]."';

                        }

                    });

                    
                </script>";

            }

        }else if(isset($_POST["crearFormacionNoFormal"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoTituloOtorgadoEstNoFor"])){

                foreach ($_FILES["nuevoArchivoNivelEstudioEstNoFor"]["type"] as $key => $tipo) {

                    $mimeArchivo = $tipo;

                }

                if($mimeArchivo == "application/pdf"){

                    foreach ($_FILES["nuevoArchivoNivelEstudioEstNoFor"]["tmp_name"] as $key => $tmp_name) {
                        
                        if($_FILES["nuevoArchivoNivelEstudioEstNoFor"]["name"][$key]){

                            $tablaConsultar = "nivel_estudio";
                            $identificacion = $_POST["identificacionPersona"];

                            $resultadoConsulta = ModeloHojaVida::mdlCantidadExperienciasLaborales($tablaConsultar, $identificacion);

                            $contadorArchivo = $resultadoConsulta["cantidad"] + 1;

                            $_FILES["nuevoArchivoNivelEstudioEstNoFor"]["name"]["$key"] = "DPAC-".$_POST["identificacionPersona"]."-".$contadorArchivo.".pdf";

                            $filename = $_FILES["nuevoArchivoNivelEstudioEstNoFor"]["name"]["$key"];
                            $source = $_FILES["nuevoArchivoNivelEstudioEstNoFor"]["tmp_name"][$key];

                            $directorio = '../archivos_soft/Archivos/AdjuntosDipActas/';

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
                        
                            $datos = array(

                                "institucion_educativa_otro" => $_POST["nuevaInstitucionEducativaEstNoFor"],
                                "fecha_finalizacion" => $_POST["nuevaFechaGradoEstNoFor"],
                                "adjunto_diploma" => $target_path,
                                "nombre_archivo" => $filename,
                                "id_nivel_educativo" => $_POST["nuevoNivelEducacion"],
                                "identificacion_fk" => $_POST["identificacionPersona"],
                                "titulo_obtenido" => $_POST["nuevoTituloOtorgadoEstNoFor"],
                                "documento_adjunto" => $_POST["nuevoDiplomaActaTecLaboral"],
            
                            );

                            $respuesta = ModeloHojaVida::mdlCrearFormacion($tabla, $datos);

                            if($respuesta == "ok"){

                                echo "<script>

                                    swal({

                                        type: 'success',
                                        title: '¡La Formación fue guardada correctamente!',
                                        showConfirmButton: true,
                                        confirmButtonText: 'Cerrar'

                                    }).then(function(result){

                                        if(result.value){
                                        
                                            window.location = 'index.php?ruta=nivel-estudio-hv&idIdentificacion=".$datos["identificacion_fk"]."';

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

                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡El Titulo Otorgado no puede contener caracteres especiales.!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = 'index.php?ruta=nivel-estudio-hv&idIdentificacion=".$_POST["identificacionPersona"]."';

                        }

                    });

                    
                </script>";

            }


        }
        
    }


    /*==============================
    BORRAR NIVEL ESTUDIO
    ==============================*/
    static public function ctrBorrarNivelEstudio(){

        if(isset($_GET["idEliminarNivelEstudio"])){

            $tabla = "nivel_estudio";

            $datos = $_GET["idEliminarNivelEstudio"];
            $rutaArchivoDiAc = $_GET["rutaArchivoDiAc"];
            $rutaArchivoTarjeta = $_GET["rutaArchivoTarjeta"];
            $idIdentificacion = $_GET["idIdentificacion"];

            if($rutaArchivoDiAc != ""){

                unlink($rutaArchivoDiAc);

            }

            if($rutaArchivoTarjeta != ""){

                unlink($rutaArchivoTarjeta);

            }

            $respuesta = ModeloHojaVida::mdlBorrarNivelEstudio($tabla, $datos);

            if($respuesta == "ok"){

                echo "<script>

                    swal({

                        type: 'success',
                        title: '¡El Nivel de Estudio fue eliminado correctamente!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = 'index.php?ruta=nivel-estudio-hv&idIdentificacion=".$idIdentificacion."';

                        }

                    });
            

                </script>";


            }


        }


    }

    /*========================
    ELIMINAR DATOS PERSONALES
    ==========================*/
    static public function ctrEliminarDatosPersonales(){

        if(isset($_GET["idDatosPersonales"])){

            $tabla = "datos_personales";

            $datos = $_GET["idDatosPersonales"];
            $rutaArchivo = $_GET["rutaArchivo"];

            if($rutaArchivo != ""){

                unlink($rutaArchivo);

            }

            $respuesta = ModeloHojaVida::mdlBorrarExperienciaLaboral($tabla, $datos);

            if($respuesta == "ok"){

                echo "<script>

                    swal({

                        type: 'success',
                        title: '¡La Experiencia Laboral fue eliminada correctamente!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = 'datos-personales-hv';

                        }

                    });
            

                </script>";


            }


        }

    }

}