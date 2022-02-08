<?php

require_once "conexion.php";

class ModeloUsuarios{


	/*=============================================
	ACTUALIZAR CONTRASEÑA DESPUES DE VERFICACION
	=============================================*/
	static public function mdlActualizarContrasena($tabla, $idUsuario, $contrasenaNueva){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET contrasena = '$contrasenaNueva', restauracion_contrasena = NULL WHERE id_usuario = $idUsuario");

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();

		$stmt = null;

	}


	/*=============================================
	VALIDAR CODIGO VERIFICACION
	=============================================*/
	static public function mdlValidarCodigoVerificacion($tabla, $idUsuario, $codigoVerificacion){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_usuario = $idUsuario AND restauracion_contrasena = '$codigoVerificacion'");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	GUARDAR CODIGO CONTRASENIA
	=============================================*/
	static public function mdlGuardarCodigoContrasena($tabla, $idUsuario, $codigoContrasena){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET restauracion_contrasena = '$codigoContrasena' WHERE id_usuario = $idUsuario");

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarUsuarios($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY nombres, apellidos DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function mdlIngresarUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombres, apellidos, correo, contrasena, metodo_registro, numero_identificacion, perfil_ingreso) VALUES (:nombres, :apellidos, :correo, :contrasena, :metodo_registro, :numero_identificacion, :perfil_ingreso)");

		$stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt->bindParam(":contrasena", $datos["contrasena"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_registro", $datos["metodo_registro"], PDO::PARAM_STR);
		$stmt->bindParam(":numero_identificacion", $datos["numero_identificacion"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil_ingreso", $datos["perfil_ingreso"], PDO::PARAM_STR);
				

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	/*=============================================
	REGISTRO DE USUARIO DENTRO DEL SOFT INTERNO
	=============================================*/

	static public function mdlIngresarUsuarioIn($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombres, apellidos, correo, contrasena, metodo_registro, perfil_ingreso, numero_identificacion) VALUES (:nombres, :apellidos, :correo, :contrasena, :metodo_registro, :perfil_ingreso, :numero_identificacion)");

		$stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt->bindParam(":contrasena", $datos["contrasena"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_registro", $datos["metodo_registro"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil_ingreso", $datos["perfil_ingreso"], PDO::PARAM_STR);
		$stmt->bindParam(":numero_identificacion", $datos["numero_identificacion"], PDO::PARAM_STR);
				

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function mdlEditarUsuario($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombres = :nombres, apellidos = :apellidos, contrasena = :contrasena, correo = :correo, perfil_ingreso = :perfil_ingreso WHERE id_usuario = :id_usuario");

		$stmt -> bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
		$stmt -> bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
		$stmt -> bindParam(":contrasena", $datos["contrasena"], PDO::PARAM_STR);
		$stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":perfil_ingreso", $datos["perfil_ingreso"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function mdlBorrarUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}

	static public function mdlPerfilesUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("SELECT usuarios_permisos.usuario,usuarios_perfiles.perfil,usuarios_perfiles.descripcion,usuarios_perfiles.estado FROM $tabla INNER JOIN usuarios_perfiles ON usuarios_permisos.id_perfil=usuarios_perfiles.id_perfil WHERE usuario='$datos' and estado = '1' GROUP BY perfil");

		//$stmt -> bindParam(":usuario", $datos, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlSubPerfilesUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("SELECT usuarios_permisos.usuario,usuarios_perfiles.perfil,usuarios_perfiles.descripcion AS `descripcion perfil`,usuarios_subperfiles.sub_perfil,usuarios_subperfiles.descripcion,usuarios_subperfiles.estado FROM $tabla INNER JOIN usuarios_perfiles ON usuarios_permisos.id_perfil=usuarios_perfiles.id_perfil INNER JOIN usuarios_subperfiles ON usuarios_permisos.id_subperfil=usuarios_subperfiles.id_subperfil WHERE usuario='$datos' AND usuarios_subperfiles.estado='1' GROUP BY sub_perfil");

		//$stmt -> bindParam(":usuario", $datos, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlSesionUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where usuario='$datos'");

		$stmt -> execute();

		$resultado=$stmt -> fetchAll();

		if(sizeof($resultado)>0){

			return 'Loggeado';

			$stmt -> close();

			$stmt = null;

		} else {

			return 'No Loggeado';

			$stmt -> close();

			$stmt = null;

		}

	}

	static public function mdlactivarSesion($tabla, $datos){

		$stmt= Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE usuario='$datos'");

		$stmt->execute();

		$resultado=$stmt -> fetch();

		if($resultado['usuario']!=null){ // existe

			$update = Conexion::conectar()->prepare("UPDATE $tabla SET fecha_log = CURRENT_TIMESTAMP WHERE usuario='$datos' ");

			$update -> execute();


			//return $idefac.'-'.$identificador.'-'.$valor.'-'.$perfil.'-'.$usuario;
		}else{ // no existe

			$insert = Conexion::conectar()->prepare("INSERT INTO $tabla ( `usuario`, `fecha_log`) VALUES( '$datos' ,CURRENT_TIMESTAMP) ");

			$insert -> execute();

			//return $resultado;
		}

	}

	static public function mdleliminarSesion($tabla, $datos){

		$stmt= Conexion::conectar()->prepare("DELETE FROM $tabla WHERE usuario='$datos'");

		$stmt->execute();

		$stmt = null;


	}

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarUsuariosPropio($tabla, $item, $valor){


		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR USUARIO PROPIO
	=============================================*/

	static public function mdlEditarUsuarioPropio($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombres = :nombres, apellidos = :apellidos, correo = :correo, contrasena = :contrasena, numero_identificacion = :numero_identificacion WHERE id_usuario = :id_usuario");

		$stmt -> bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
		$stmt -> bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
		$stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt -> bindParam(":contrasena", $datos["contrasena"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":numero_identificacion", $datos["numero_identificacion"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarPerfiles($tabla){


		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE perfil !='Administrador';");

		$stmt -> execute();

		return $stmt -> fetchAll();		

		$stmt -> close();

		$stmt = null;

	}


}