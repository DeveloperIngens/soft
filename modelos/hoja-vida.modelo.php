<?php

require_once "conexion.php";

class ModeloHojaVida {


    /*============================
    CANTIDAD HOJAS DE VIDA
    ============================*/
    static public function mdlCantidadHojasVidaRegistrada($tabla, $item, $valor){

        if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) AS CANTIDAD_HOJAS FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) AS CANTIDAD_HOJAS FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetch();

		}

		$stmt -> close();

		$stmt = null;


    }


    /*=============================
    TRAER TODAS LAS EXPERIENCIAS LABORALES DE LA PERSONA
    =============================*/
    static public function mdlTraerExperienciasPersona($tabla, $item, $valor){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY fecha_fin DESC");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;


    }


    /*=============================
    TRAER TODAS LAS FORMACIONES DE LA PERSONA
    =============================*/
    static public function mdlTraerNivelEstudiosPersona($tabla, $item, $valor){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY fecha_finalizacion DESC");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;


    }

    /*===============================
    VALIDAR SI TIENE HOJA DE VIDA
    =================================*/
    static public function mdlCalcularExperienciaTotal($tabla, $idIdentificacion){

        $stmt = Conexion::conectar()->prepare("SELECT TRUNCATE(SUM(tiempo_anios), 0) AS tiempo_anios, TRUNCATE(SUM(tiempo_meses), 0) AS tiempo_meses FROM $tabla WHERE identificacion_fk = $idIdentificacion;");

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;


    }

    /*===============================
    VALIDAR SI TIENE HOJA DE VIDA
    =================================*/
    static public function mdlValidarExisteHojaVida($tabla, $correo, $nivelEducacion, $numeroIdentificacion, $profesion){

        if($correo != ""){

            $textCorreo = "AND correo_electronico LIKE '%$correo%'";

        }else{

            $textCorreo = "";

        }

        if($nivelEducacion != ""){

            $textNivelEducacion = "AND nivel_estudio.id_nivel_educativo = $nivelEducacion";

        }else{

            $textNivelEducacion = "";

        }

        if($numeroIdentificacion != ""){

            $textNumeroIdentificacion = "AND datos_personales.identificacion LIKE '%$numeroIdentificacion%'";

        }else{

            $textNumeroIdentificacion = "";

        }

        if($profesion != ""){

            $textoProfesion = "AND datos_personales.profesion LIKE '%$profesion%'";

        }else{

            $textoProfesion = "";

        }

        $stmt = Conexion::conectar()->prepare("SELECT
        datos_personales.id_datos_personales,
        datos_personales.nombres,
        datos_personales.apellidos,
        datos_personales.identificacion,
        datos_personales.correo_electronico,
        datos_personales.profesion,
        datos_personales.numero_celular,
        experiencia_laboral.empresa_entidad,
        nivel_estudio.id_nivel_educativo
        FROM
        nivel_estudio
        RIGHT JOIN datos_personales ON nivel_estudio.identificacion_fk = datos_personales.identificacion
        LEFT JOIN experiencia_laboral ON datos_personales.identificacion = experiencia_laboral.identificacion_fk
        WHERE
        datos_personales.identificacion != '' $textCorreo $textNivelEducacion $textNumeroIdentificacion $textoProfesion
        GROUP BY identificacion");
        
        if($stmt->execute()){

            return $stmt->fetchAll();

        }else{

            return "error";

        }

        $stmt->close();

        $stmt = null;

    }

    /*===============================
    VALIDAR SI TIENE HOJA DE VIDA
    =================================*/
    static public function mdlTraerDatosPersonalesId($tabla, $buscar){
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_datos_personales = $buscar");

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;

    }

    /*===============================
    VALIDAR SI TIENE HOJA DE VIDA IDENTIFICACION USUARIO
    =================================*/
    static public function mdlValidarExisteHojaVidaDocumento($tabla, $buscar){
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE identificacion = $buscar");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;

    }

    /*===============================
    CREAR DATOS PERSONALES
    =================================*/
    static public function mdlCrearDatosPersonales($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(tipo_documento_fk, identificacion, nombres, apellidos, adjunto_documento, hv_adjunto_documento, nombre_adjunto_documento, fecha_nacimiento, nacionalidad_fk, departamento_residencia, ciudad_residencia, profesion, correo_electronico, direccion_residencia, numero_celular, numero_celular_2, numero_telefono, usuario_creacion) 
        VALUES (:tipo_documento_fk, :identificacion, :nombres, :apellidos, :adjunto_documento, :hv_adjunto_documento, :nombre_adjunto_documento, :fecha_nacimiento, :nacionalidad_fk, :departamento_residencia, :ciudad_residencia, :profesion, :correo_electronico, :direccion_residencia, :numero_celular, :numero_celular_2, :numero_telefono, :usuario_creacion)");

        $stmt->bindParam(":tipo_documento_fk", $datos["tipo_documento_fk"], PDO::PARAM_STR);
        $stmt->bindParam(":identificacion", $datos["identificacion"], PDO::PARAM_STR);
        $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
        $stmt->bindParam(":adjunto_documento", $datos["adjunto_documento"], PDO::PARAM_STR);
        $stmt->bindParam(":hv_adjunto_documento", $datos["hv_adjunto_documento"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":nacionalidad_fk", $datos["nacionalidad_fk"], PDO::PARAM_STR);
        $stmt->bindParam(":departamento_residencia", $datos["departamento_residencia"], PDO::PARAM_STR);
        $stmt->bindParam(":ciudad_residencia", $datos["ciudad_residencia"], PDO::PARAM_STR);
        $stmt->bindParam(":profesion", $datos["profesion"], PDO::PARAM_STR);
        $stmt->bindParam(":correo_electronico", $datos["correo_electronico"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion_residencia", $datos["direccion_residencia"], PDO::PARAM_STR);
        $stmt->bindParam(":numero_celular", $datos["numero_celular"], PDO::PARAM_STR);
        $stmt->bindParam(":numero_celular_2", $datos["numero_celular_2"], PDO::PARAM_STR);
        $stmt->bindParam(":numero_telefono", $datos["numero_telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario_creacion", $datos["usuario_creacion"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_adjunto_documento", $datos["nombre_adjunto_documento"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt -> close();

        $stmt = null;

    }

    /*===============================
    EDITAR DATOS PERSONALES
    =================================*/
    static public function mdlEditarDatosPersonales($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET tipo_documento_fk = :tipo_documento_fk, identificacion = :identificacion, nombres = :nombres, 
        apellidos = :apellidos, adjunto_documento = :adjunto_documento, hv_adjunto_documento = :hv_adjunto_documento, nombre_adjunto_documento = :nombre_adjunto_documento, fecha_nacimiento = :fecha_nacimiento, 
        nacionalidad_fk = :nacionalidad_fk, departamento_residencia = :departamento_residencia, ciudad_residencia = :ciudad_residencia, profesion = :profesion, 
        correo_electronico = :correo_electronico, direccion_residencia = :direccion_residencia, numero_celular = :numero_celular, numero_celular_2 = :numero_celular_2, 
        numero_telefono = :numero_telefono, usuario_modifico = :usuario_modifico, fecha_modificacion = :fecha_modificacion WHERE id_datos_personales = :id_datos_personales");

        $stmt->bindParam(":tipo_documento_fk", $datos["tipo_documento_fk"], PDO::PARAM_STR);
        $stmt->bindParam(":identificacion", $datos["identificacion"], PDO::PARAM_STR);
        $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
        $stmt->bindParam(":adjunto_documento", $datos["adjunto_documento"], PDO::PARAM_STR);
        $stmt->bindParam(":hv_adjunto_documento", $datos["hv_adjunto_documento"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_adjunto_documento", $datos["nombre_adjunto_documento"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":nacionalidad_fk", $datos["nacionalidad_fk"], PDO::PARAM_STR);
        $stmt->bindParam(":departamento_residencia", $datos["departamento_residencia"], PDO::PARAM_STR);        
        $stmt->bindParam(":ciudad_residencia", $datos["ciudad_residencia"], PDO::PARAM_STR);
        $stmt->bindParam(":profesion", $datos["profesion"], PDO::PARAM_STR);
        $stmt->bindParam(":correo_electronico", $datos["correo_electronico"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion_residencia", $datos["direccion_residencia"], PDO::PARAM_STR);
        $stmt->bindParam(":numero_celular", $datos["numero_celular"], PDO::PARAM_STR);
        $stmt->bindParam(":numero_celular_2", $datos["numero_celular_2"], PDO::PARAM_STR);
        $stmt->bindParam(":numero_telefono", $datos["numero_telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario_modifico", $datos["usuario_modifico"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_modificacion", $datos["fecha_modificacion"], PDO::PARAM_STR);
        $stmt->bindParam(":id_datos_personales", $datos["id_datos_personales"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return $stmt->errorInfo();

        }

        $stmt -> close();

        $stmt = null;

    }

    /*==================================
    TRAER DATOS PERSONALES
    ===================================*/
    static public function mdlTraerDatosPersonales($tabla, $item, $valor){

        if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }

    /*=======================
    VALIDAMOS CUANTAS EXPERIENCIAS TIENE LA PERSONA
    ========================*/
    static public function mdlCantidadExperienciasLaborales($tabla, $identificacion){

        $stmt = Conexion::conectar()->prepare("SELECT count(*) AS cantidad FROM $tabla WHERE identificacion_fk = $identificacion");

        $stmt -> execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;

    }

    /*===============================
    CREAR EXPERIENCIAS LABORALES
    ================================*/
    static public function mdlCrearExperienciasLaborales($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(empresa_entidad, sector_id, cargo, area_trabajo, valor_contrato_salario, 
        fecha_inicio, fecha_fin, tiempo_dias, tiempo_meses, tiempo_anios, tipo_documento, nombre_archivo, adjunto_certificacion, objeto_contrato,
        identificacion_fk, usuario_creacion) VALUES (:empresa_entidad, :sector_id, :cargo, :area_trabajo, :valor_contrato_salario, :fecha_inicio, :fecha_fin,
        :tiempo_dias, :tiempo_meses, :tiempo_anios, :tipo_documento, :nombre_archivo, :adjunto_certificacion, :objeto_contrato, :identificacion_fk, :usuario_creacion)");

        $stmt->bindParam(":empresa_entidad", $datos["empresa_entidad"], PDO::PARAM_STR);
        $stmt->bindParam(":sector_id", $datos["sector_id"], PDO::PARAM_STR);
        $stmt->bindParam(":cargo", $datos["cargo"], PDO::PARAM_STR);
        $stmt->bindParam(":area_trabajo", $datos["area_trabajo"], PDO::PARAM_STR);
        $stmt->bindParam(":valor_contrato_salario", $datos["valor_contrato_salario"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);
        $stmt->bindParam(":tiempo_dias", $datos["tiempo_dias"], PDO::PARAM_STR);
        $stmt->bindParam(":tiempo_meses", $datos["tiempo_meses"], PDO::PARAM_STR);
        $stmt->bindParam(":tiempo_anios", $datos["tiempo_anios"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_documento", $datos["tipo_documento"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_archivo", $datos["nombre_archivo"], PDO::PARAM_STR);
        $stmt->bindParam(":adjunto_certificacion", $datos["adjunto_certificacion"], PDO::PARAM_STR);
        $stmt->bindParam(":objeto_contrato", $datos["objeto_contrato"], PDO::PARAM_STR);
        $stmt->bindParam(":identificacion_fk", $datos["identificacion_fk"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario_creacion", $datos["usuario_creacion"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            var_dump($stmt->errorInfo());

        }

        $stmt -> close();

        $stmt = null;

    }

    /*==============================
    OBTENER EXPERIENCIAS LABORALES
    ===============================*/
    static public function mdlMostrarExperienciasLaborales($tabla, $item, $valor){

        if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha_inicio, '%d-%m-%Y') AS fecha_inicio_formato, DATE_FORMAT(fecha_fin, '%d-%m-%Y') AS fecha_fin_formato FROM $tabla WHERE $item = :$item ORDER BY fecha_fin DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha_inicio, '%d-%m-%Y') AS fecha_inicio_formato, DATE_FORMAT(fecha_fin, '%d-%m-%Y') AS fecha_fin_formato FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }

    /*==============================
    OBTENER NIVELES ESTUDIO
    ===============================*/
    static public function mdlMostrarNivelesEstudios($tabla, $item, $valor){

        if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY fecha_finalizacion DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt = null;

    }

    /*==============================
    VER NIVELES ESTUDIO
    ===============================*/
    static public function mdlVerNivelesEstudios($tabla, $item, $valor){

        if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }

    /*==============================
    OBTENER EXPERIENCIAS LABORALES
    ===============================*/
    static public function mdlMostrarExperienciasLaboralesVer($tabla, $item, $valor){

        if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha_inicio, '%d/%m/%Y') AS fecha_inicio_formato, DATE_FORMAT(fecha_fin, '%d/%m/%Y') AS fecha_fin_formato FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }


    /*===============================
    EDITAR EXPERIENCIAS LABORALES
    ================================*/
    static public function mdlEditarExperienciaLaboral($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET empresa_entidad = :empresa_entidad, sector_id = :sector_id, cargo = :cargo, area_trabajo = :area_trabajo,
        valor_contrato_salario = :valor_contrato_salario, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin, tiempo_dias = :tiempo_dias, tiempo_meses = :tiempo_meses,
        tiempo_anios = :tiempo_anios, tipo_documento = :tipo_documento, nombre_archivo = :nombre_archivo, adjunto_certificacion = :adjunto_certificacion,
        objeto_contrato = :objeto_contrato, identificacion_fk = :identificacion_fk, usuario_modificacion = :usuario_modificacion, fecha_modificacion = :fecha_modificacion
        WHERE id_experiencia_laboral = :id_experiencia_laboral");

        $stmt->bindParam(":empresa_entidad", $datos["empresa_entidad"], PDO::PARAM_STR);
        $stmt->bindParam(":sector_id", $datos["sector_id"], PDO::PARAM_STR);
        $stmt->bindParam(":cargo", $datos["cargo"], PDO::PARAM_STR);
        $stmt->bindParam(":area_trabajo", $datos["area_trabajo"], PDO::PARAM_STR);
        $stmt->bindParam(":valor_contrato_salario", $datos["valor_contrato_salario"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);
        $stmt->bindParam(":tiempo_dias", $datos["tiempo_dias"], PDO::PARAM_STR);
        $stmt->bindParam(":tiempo_meses", $datos["tiempo_meses"], PDO::PARAM_STR);
        $stmt->bindParam(":tiempo_anios", $datos["tiempo_anios"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_documento", $datos["tipo_documento"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_archivo", $datos["nombre_archivo"], PDO::PARAM_STR);
        $stmt->bindParam(":adjunto_certificacion", $datos["adjunto_certificacion"], PDO::PARAM_STR);
        $stmt->bindParam(":objeto_contrato", $datos["objeto_contrato"], PDO::PARAM_STR);
        $stmt->bindParam(":identificacion_fk", $datos["identificacion_fk"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario_modificacion", $datos["usuario_modificacion"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_modificacion", $datos["fecha_modificacion"], PDO::PARAM_STR);
        $stmt->bindParam(":id_experiencia_laboral", $datos["id_experiencia_laboral"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return $stmt->errorInfo();
        }

        $stmt->close();

        $stmt = null;

    }

    /*========================
    ELIMINAR LA EXPERIENCIA LABORAL
    ==========================*/
    static public function mdlBorrarExperienciaLaboral($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_experiencia_laboral = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

    }

    /*========================
    ELIMINAR LA NIVEL ESTUDIO
    ==========================*/
    static public function mdlBorrarNivelEstudio($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_nivel_estudio = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

    }

    /*============================
    CREAR NIVEL EDUCACION 
    =============================*/
    static public function mdlCrearFormacion($tabla, $datos){

        switch($datos["id_nivel_educativo"]){

            /*==========================
            INSERTAR INFORMACION BACHILLER
            ==========================*/
            case 0:

                $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(institucion_secundaria, titulo_obtenido, fecha_finalizacion, adjunto_diploma, nombre_archivo, id_nivel_educativo, identificacion_fk) VALUES (:institucion_secundaria, :titulo_obtenido, :fecha_finalizacion, :adjunto_diploma, :nombre_archivo, :id_nivel_educativo, :identificacion_fk)");

                $stmt->bindParam(":institucion_secundaria", $datos["institucion_secundaria"], PDO::PARAM_STR);
                $stmt->bindParam(":titulo_obtenido", $datos["titulo_obtenido"], PDO::PARAM_STR);
                $stmt->bindParam(":fecha_finalizacion", $datos["fecha_finalizacion"], PDO::PARAM_STR);
                $stmt->bindParam(":adjunto_diploma", $datos["adjunto_diploma"], PDO::PARAM_STR);
                $stmt->bindParam(":nombre_archivo", $datos["nombre_archivo"], PDO::PARAM_STR);
                $stmt->bindParam(":id_nivel_educativo", $datos["id_nivel_educativo"], PDO::PARAM_STR);
                $stmt->bindParam(":identificacion_fk", $datos["identificacion_fk"], PDO::PARAM_STR);

                if($stmt -> execute()){

                    return "ok";
                
                }else{

                    var_dump($stmt->errorInfo());

                }

                $stmt -> close();

                $stmt = null;

            break;


            /*==========================
            INSERTAR INFORMACION TECNICO LABORAL
            ==========================*/
            case 1:

                $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(institucion_educativa_id, institucion_educativa_otro, fecha_finalizacion, adjunto_diploma, nombre_archivo, id_nivel_educativo, identificacion_fk, titulo_obtenido, documento_adjunto) 
                VALUES (:institucion_educativa_id, :institucion_educativa_otro, :fecha_finalizacion, :adjunto_diploma, :nombre_archivo, :id_nivel_educativo, :identificacion_fk, :titulo_obtenido, :documento_adjunto)");

                $stmt->bindParam(":institucion_educativa_id", $datos["institucion_educativa_id"], PDO::PARAM_STR);
                $stmt->bindParam(":institucion_educativa_otro", $datos["institucion_educativa_otro"], PDO::PARAM_STR);
                $stmt->bindParam(":fecha_finalizacion", $datos["fecha_finalizacion"], PDO::PARAM_STR);
                $stmt->bindParam(":adjunto_diploma", $datos["adjunto_diploma"], PDO::PARAM_STR);
                $stmt->bindParam(":nombre_archivo", $datos["nombre_archivo"], PDO::PARAM_STR);
                $stmt->bindParam(":id_nivel_educativo", $datos["id_nivel_educativo"], PDO::PARAM_STR);
                $stmt->bindParam(":identificacion_fk", $datos["identificacion_fk"], PDO::PARAM_STR);
                $stmt->bindParam(":titulo_obtenido", $datos["titulo_obtenido"], PDO::PARAM_STR);
                $stmt->bindParam(":documento_adjunto", $datos["documento_adjunto"], PDO::PARAM_STR);

                // NOSE ESTA GUARDANDO LA INFORMACION DE TEC

                if($stmt -> execute()){

                    return "ok";
                
                }else{

                    return $stmt->errorInfo();

                }

                $stmt -> close();

                $stmt = null;

            break;
            
            /*==========================
            INSERTAR INFORMACION TECNICO PROFESIONAL
            ==========================*/

            case 2:

                $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(institucion_educativa_id, institucion_educativa_otro, fecha_finalizacion, adjunto_diploma, nombre_archivo, id_nivel_educativo, identificacion_fk, titulo_obtenido, documento_adjunto) 
                VALUES (:institucion_educativa_id, :institucion_educativa_otro, :fecha_finalizacion, :adjunto_diploma, :nombre_archivo, :id_nivel_educativo, :identificacion_fk, :titulo_obtenido, :documento_adjunto)");

                $stmt->bindParam(":institucion_educativa_id", $datos["institucion_educativa_id"], PDO::PARAM_STR);
                $stmt->bindParam(":institucion_educativa_otro", $datos["institucion_educativa_otro"], PDO::PARAM_STR);
                $stmt->bindParam(":fecha_finalizacion", $datos["fecha_finalizacion"], PDO::PARAM_STR);
                $stmt->bindParam(":adjunto_diploma", $datos["adjunto_diploma"], PDO::PARAM_STR);
                $stmt->bindParam(":nombre_archivo", $datos["nombre_archivo"], PDO::PARAM_STR);
                $stmt->bindParam(":id_nivel_educativo", $datos["id_nivel_educativo"], PDO::PARAM_STR);
                $stmt->bindParam(":identificacion_fk", $datos["identificacion_fk"], PDO::PARAM_STR);
                $stmt->bindParam(":titulo_obtenido", $datos["titulo_obtenido"], PDO::PARAM_STR);
                $stmt->bindParam(":documento_adjunto", $datos["documento_adjunto"], PDO::PARAM_STR);

                if($stmt -> execute()){

                    return "ok";
                
                }else{

                    return $stmt->errorInfo();

                }

                $stmt -> close();

                $stmt = null;

            break;

            /*==========================
            INSERTAR INFORMACION TECNOLOGO
            ==========================*/
            case 3:

                $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(institucion_educativa_id, institucion_educativa_otro, fecha_finalizacion, adjunto_diploma, nombre_archivo, id_nivel_educativo, identificacion_fk, titulo_obtenido, documento_adjunto) 
                VALUES (:institucion_educativa_id, :institucion_educativa_otro, :fecha_finalizacion, :adjunto_diploma, :nombre_archivo, :id_nivel_educativo, :identificacion_fk, :titulo_obtenido, :documento_adjunto)");

                $stmt->bindParam(":institucion_educativa_id", $datos["institucion_educativa_id"], PDO::PARAM_STR);
                $stmt->bindParam(":institucion_educativa_otro", $datos["institucion_educativa_otro"], PDO::PARAM_STR);
                $stmt->bindParam(":fecha_finalizacion", $datos["fecha_finalizacion"], PDO::PARAM_STR);
                $stmt->bindParam(":adjunto_diploma", $datos["adjunto_diploma"], PDO::PARAM_STR);
                $stmt->bindParam(":nombre_archivo", $datos["nombre_archivo"], PDO::PARAM_STR);
                $stmt->bindParam(":id_nivel_educativo", $datos["id_nivel_educativo"], PDO::PARAM_STR);
                $stmt->bindParam(":identificacion_fk", $datos["identificacion_fk"], PDO::PARAM_STR);
                $stmt->bindParam(":titulo_obtenido", $datos["titulo_obtenido"], PDO::PARAM_STR);
                $stmt->bindParam(":documento_adjunto", $datos["documento_adjunto"], PDO::PARAM_STR);

                if($stmt -> execute()){

                    return "ok";
                
                }else{

                    return $stmt->errorInfo();

                }

                $stmt -> close();

                $stmt = null;

            break;

            /*==========================
            INSERTAR INFORMACION UNIVERSITARIA
            ==========================*/

            case 4:

                $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(institucion_educativa_id, institucion_educativa_otro, fecha_finalizacion, adjunto_diploma, nombre_archivo, id_nivel_educativo, identificacion_fk, titulo_obtenido, documento_adjunto, adjunto_tarjeta_profesional, nombre_archivo_tarjeta, fecha_expedicion_tarjeta, fecha_finalizacion_materias) 
                VALUES (:institucion_educativa_id, :institucion_educativa_otro, :fecha_finalizacion, :adjunto_diploma, :nombre_archivo, :id_nivel_educativo, :identificacion_fk, :titulo_obtenido, :documento_adjunto, :adjunto_tarjeta_profesional, :nombre_archivo_tarjeta, :fecha_expedicion_tarjeta, :fecha_finalizacion_materias)");
                
                $stmt->bindParam(":institucion_educativa_id", $datos["institucion_educativa_id"], PDO::PARAM_STR);
                $stmt->bindParam(":institucion_educativa_otro", $datos["institucion_educativa_otro"], PDO::PARAM_STR);
                $stmt->bindParam(":fecha_finalizacion", $datos["fecha_finalizacion"], PDO::PARAM_STR);
                $stmt->bindParam(":adjunto_diploma", $datos["adjunto_diploma"], PDO::PARAM_STR);
                $stmt->bindParam(":nombre_archivo", $datos["nombre_archivo"], PDO::PARAM_STR);
                $stmt->bindParam(":id_nivel_educativo", $datos["id_nivel_educativo"], PDO::PARAM_STR);
                $stmt->bindParam(":identificacion_fk", $datos["identificacion_fk"], PDO::PARAM_STR);
                $stmt->bindParam(":titulo_obtenido", $datos["titulo_obtenido"], PDO::PARAM_STR);
                $stmt->bindParam(":documento_adjunto", $datos["documento_adjunto"], PDO::PARAM_STR);
                $stmt->bindParam(":adjunto_tarjeta_profesional", $datos["adjunto_tarjeta_profesional"], PDO::PARAM_STR);
                $stmt->bindParam(":nombre_archivo_tarjeta", $datos["nombre_archivo_tarjeta"], PDO::PARAM_STR);
                $stmt->bindParam(":fecha_expedicion_tarjeta", $datos["fecha_expedicion_tarjeta"], PDO::PARAM_STR);
                $stmt->bindParam(":fecha_finalizacion_materias", $datos["fecha_finalizacion_materias"], PDO::PARAM_STR);

                if($stmt -> execute()){

                    return "ok";
                
                }else{

                    var_dump($stmt->errorInfo());

                }

                $stmt -> close();

                $stmt = null;

            break;

            /*==========================
            INSERTAR INFORMACION ESPECIALIZACION
            ==========================*/

            case 5:

                $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(institucion_educativa_id, institucion_educativa_otro, fecha_finalizacion, adjunto_diploma, nombre_archivo, id_nivel_educativo, identificacion_fk, titulo_obtenido, documento_adjunto) 
                VALUES (:institucion_educativa_id, :institucion_educativa_otro, :fecha_finalizacion, :adjunto_diploma, :nombre_archivo, :id_nivel_educativo, :identificacion_fk, :titulo_obtenido, :documento_adjunto)");
                
                $stmt->bindParam(":institucion_educativa_id", $datos["institucion_educativa_id"], PDO::PARAM_STR);
                $stmt->bindParam(":institucion_educativa_otro", $datos["institucion_educativa_otro"], PDO::PARAM_STR);
                $stmt->bindParam(":fecha_finalizacion", $datos["fecha_finalizacion"], PDO::PARAM_STR);
                $stmt->bindParam(":adjunto_diploma", $datos["adjunto_diploma"], PDO::PARAM_STR);
                $stmt->bindParam(":nombre_archivo", $datos["nombre_archivo"], PDO::PARAM_STR);
                $stmt->bindParam(":id_nivel_educativo", $datos["id_nivel_educativo"], PDO::PARAM_STR);
                $stmt->bindParam(":identificacion_fk", $datos["identificacion_fk"], PDO::PARAM_STR);
                $stmt->bindParam(":titulo_obtenido", $datos["titulo_obtenido"], PDO::PARAM_STR);
                $stmt->bindParam(":documento_adjunto", $datos["documento_adjunto"], PDO::PARAM_STR);

                if($stmt -> execute()){

                    return "ok";
                
                }else{

                    return $stmt->errorInfo();

                }

                $stmt -> close();

                $stmt = null;

            break;
            
            /*==========================
            INSERTAR INFORMACION MAESTRIA
            ==========================*/
            case 6:

                $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(institucion_educativa_id, institucion_educativa_otro, fecha_finalizacion, adjunto_diploma, nombre_archivo, id_nivel_educativo, identificacion_fk, titulo_obtenido, documento_adjunto) 
                VALUES (:institucion_educativa_id, :institucion_educativa_otro, :fecha_finalizacion, :adjunto_diploma, :nombre_archivo, :id_nivel_educativo, :identificacion_fk, :titulo_obtenido, :documento_adjunto)");
                
                $stmt->bindParam(":institucion_educativa_id", $datos["institucion_educativa_id"], PDO::PARAM_STR);
                $stmt->bindParam(":institucion_educativa_otro", $datos["institucion_educativa_otro"], PDO::PARAM_STR);
                $stmt->bindParam(":fecha_finalizacion", $datos["fecha_finalizacion"], PDO::PARAM_STR);
                $stmt->bindParam(":adjunto_diploma", $datos["adjunto_diploma"], PDO::PARAM_STR);
                $stmt->bindParam(":nombre_archivo", $datos["nombre_archivo"], PDO::PARAM_STR);
                $stmt->bindParam(":id_nivel_educativo", $datos["id_nivel_educativo"], PDO::PARAM_STR);
                $stmt->bindParam(":identificacion_fk", $datos["identificacion_fk"], PDO::PARAM_STR);
                $stmt->bindParam(":titulo_obtenido", $datos["titulo_obtenido"], PDO::PARAM_STR);
                $stmt->bindParam(":documento_adjunto", $datos["documento_adjunto"], PDO::PARAM_STR);

                if($stmt -> execute()){

                    return "ok";
                
                }else{

                    return $stmt->errorInfo();

                }

                $stmt -> close();

                $stmt = null;

            break;


            /*==========================
            INSERTAR INFORMACION DOCTORADO
            ==========================*/
            case 7:

                $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(institucion_educativa_id, institucion_educativa_otro, fecha_finalizacion, adjunto_diploma, nombre_archivo, id_nivel_educativo, identificacion_fk, titulo_obtenido, documento_adjunto) 
                VALUES (:institucion_educativa_id, :institucion_educativa_otro, :fecha_finalizacion, :adjunto_diploma, :nombre_archivo, :id_nivel_educativo, :identificacion_fk, :titulo_obtenido, :documento_adjunto)");
                
                $stmt->bindParam(":institucion_educativa_id", $datos["institucion_educativa_id"], PDO::PARAM_STR);
                $stmt->bindParam(":institucion_educativa_otro", $datos["institucion_educativa_otro"], PDO::PARAM_STR);
                $stmt->bindParam(":fecha_finalizacion", $datos["fecha_finalizacion"], PDO::PARAM_STR);
                $stmt->bindParam(":adjunto_diploma", $datos["adjunto_diploma"], PDO::PARAM_STR);
                $stmt->bindParam(":nombre_archivo", $datos["nombre_archivo"], PDO::PARAM_STR);
                $stmt->bindParam(":id_nivel_educativo", $datos["id_nivel_educativo"], PDO::PARAM_STR);
                $stmt->bindParam(":identificacion_fk", $datos["identificacion_fk"], PDO::PARAM_STR);
                $stmt->bindParam(":titulo_obtenido", $datos["titulo_obtenido"], PDO::PARAM_STR);
                $stmt->bindParam(":documento_adjunto", $datos["documento_adjunto"], PDO::PARAM_STR);

                if($stmt -> execute()){

                    return "ok";
                
                }else{

                    return $stmt->errorInfo();

                }

                $stmt -> close();

                $stmt = null;

            break;

            case 8:

                $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla( institucion_educativa_otro, fecha_finalizacion, adjunto_diploma, nombre_archivo, id_nivel_educativo, identificacion_fk, titulo_obtenido, documento_adjunto) 
                VALUES (:institucion_educativa_otro, :fecha_finalizacion, :adjunto_diploma, :nombre_archivo, :id_nivel_educativo, :identificacion_fk, :titulo_obtenido, :documento_adjunto)");
                
                $stmt->bindParam(":institucion_educativa_otro", $datos["institucion_educativa_otro"], PDO::PARAM_STR);
                $stmt->bindParam(":fecha_finalizacion", $datos["fecha_finalizacion"], PDO::PARAM_STR);
                $stmt->bindParam(":adjunto_diploma", $datos["adjunto_diploma"], PDO::PARAM_STR);
                $stmt->bindParam(":nombre_archivo", $datos["nombre_archivo"], PDO::PARAM_STR);
                $stmt->bindParam(":id_nivel_educativo", $datos["id_nivel_educativo"], PDO::PARAM_STR);
                $stmt->bindParam(":identificacion_fk", $datos["identificacion_fk"], PDO::PARAM_STR);
                $stmt->bindParam(":titulo_obtenido", $datos["titulo_obtenido"], PDO::PARAM_STR);
                $stmt->bindParam(":documento_adjunto", $datos["documento_adjunto"], PDO::PARAM_STR);

                if($stmt -> execute()){

                    return "ok";
                
                }else{

                    return $stmt->errorInfo();

                }

                $stmt -> close();

                $stmt = null;

            break;

        }



    }

}