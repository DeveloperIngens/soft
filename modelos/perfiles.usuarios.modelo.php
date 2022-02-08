<?php 

require_once "conexion.php";

class ModeloPerfilesUsuarios {


    /*==================================
    OBTENER PERMISOS A SOFTWARE NO OBTENIDO
    ===================================*/
    static public function mdlObtenerSoftNoObtenidos($idUsuario){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM par_perfiles WHERE id_perfil NOT IN ($idUsuario)");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;

    }


    /*==================================
    OBTENER PERMISOS A SOFTWARE OBTENIDO
    ===================================*/
    static public function ctrObtenerSoftObtenidos($idUsuario){

        $stmt = Conexion::conectar()->prepare("SELECT par_perfiles.id_perfil, par_perfiles.nombre_pantalla, nombre_perfil, id_usuario FROM perfiles_usuarios INNER JOIN par_perfiles ON perfiles_usuarios.id_perfil = par_perfiles.id_perfil WHERE id_usuario = $idUsuario");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;

    }


    /*==================================
    VALIDAMOS QUE EL USUARIO NO TENGA EL PERMISO PREVIAMENTE
    ===================================*/
    static public function mdlValidarUsuarioPerfil($tabla, $valor1, $valor2, $valor3){

        if($valor1 != null && $valor2 != null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_usuario = $valor1 AND id_perfil = $valor2 AND id_permiso = $valor3");

            $stmt->execute();

            return $stmt->fetch();

        }

        $stmt->close();

        $stmt = null;

    }


    /*===========================
    INSERTAR ROL DE REGISTRO DE USUARIO DESDE REGISTRO
    ========================*/
    static public function mdlCrearPerfilUsuario($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_perfil, id_usuario, id_permiso) VALUES(:id_perfil, :id_usuario, :id_permiso)");

        $stmt->bindParam(":id_perfil", $datos["id_perfil"], PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":id_permiso", $datos["id_permiso"], PDO::PARAM_STR);

        if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

    }

    /*===========================
    VALIDAR QUE EL USUARIO SOLO TENGA UN REGISTRO DEL USUARIO CON UNICO PERFIL
    ========================*/
    static public function mdlValidarPerfiles($tabla, $idUsuario, $idPerfil){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_perfil = $idPerfil AND id_usuario = $idUsuario");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;


    }

    /*====================================
    OBTENEMOS PERFILES DEL USUARIO
    =====================================*/
    static public function mdlObtenerPerfilesUsuarios($tabla1, $tabla2, $tabla3, $idUsuario){

        $stmt = Conexion::conectar()->prepare("SELECT $tabla1.id_usuario, $tabla1.nombres, $tabla1.apellidos, $tabla3.nombre_perfil, $tabla3.ruta_perfil FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_usuario = $tabla2.id_usuario
        INNER JOIN $tabla3 ON $tabla2.id_perfil = $tabla3.id_perfil WHERE $tabla1.id_usuario = $idUsuario GROUP BY nombre_perfil");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;


    }

    /*===========================
    MOSTRAR TODOS LOS PERFILES
    ===========================*/
    static public function mdlMostrarPerfiles($tabla, $item, $valor){

        if($item != null && $valor != null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();

        }

        $stmt->close();

        $stmt = null;


    }

    /*===========================
    MOSTRAR USUARIOS CON PERFILES INNER JOIN
    ===========================*/
    static public function mdlMostrarUsuariosPerfiles($tabla1, $tabla2, $tabla3, $tabla4, $item, $valor){

        if($item != null && $valor != null){

            $stmt = Conexion::conectar()->prepare("SELECT id_perfil_usuario, nombre_perfil, CONCAT( nombres, ' ', apellidos ) AS nombre_usuario,
            nombre_permiso FROM $tabla1
            INNER JOIN $tabla2 ON $tabla1.id_usuario = $tabla2.id_usuario
            INNER JOIN $tabla3 ON $tabla2.id_permiso = $tabla3 .id_permiso
            INNER JOIN $tabla4 ON $tabla3.id_perfil = $tabla4.id_perfil WHERE $tabla1.$item = :$item");

            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT id_perfil_usuario, nombre_perfil, CONCAT( nombres, ' ', apellidos ) AS nombre_usuario,
            nombre_permiso FROM $tabla1
            INNER JOIN $tabla2 ON $tabla1.id_usuario = $tabla2.id_usuario
            INNER JOIN $tabla3 ON $tabla2.id_permiso = $tabla3 .id_permiso
            INNER JOIN $tabla4 ON $tabla3.id_perfil = $tabla4.id_perfil");

            $stmt->execute();

            return $stmt->fetchAll();

        }

        $stmt->close();

        $stmt = null;

    }

    /*====================================
    TRAER TODOS LOS PERMISOS DE UN PERFIL
    =====================================*/
    static public function mdlTraerPermisosPerfil($tabla1, $tabla2, $valor){

        $stmt = Conexion::conectar()->prepare("SELECT nombre_perfil, id_permiso, nombre_permiso FROM $tabla1
        INNER JOIN $tabla2 ON par_perfiles.id_perfil = par_permisos.id_perfil
        WHERE $tabla2.id_perfil = $valor");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;

    }

    /*==================================
    CREAR USUARIO PERFIL Y PERMISO
    ===================================*/
    static public function mdlCrearUsuarioPerfil($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_perfil, id_usuario, id_permiso) VALUES(:id_perfil, :id_usuario, :id_permiso)");

        $stmt->bindParam(":id_perfil", $datos["id_perfil"], PDO::PARAM_STR);
        $stmt->bindParam(':id_usuario', $datos["id_usuario"], PDO::PARAM_STR);
        $stmt->bindParam(':id_permiso', $datos["id_permiso"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt->close();

        $stmt = null;

    }

    /*============================
    BORRAR PERFIL USUARIO
    =============================*/
    static public function mdlBorrarPerfilUsuario($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_perfil_usuario = :id_perfil_usuario");

        $stmt->bindParam(":id_perfil_usuario", $datos, PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt->close();

        $stmt = null;

    }


}