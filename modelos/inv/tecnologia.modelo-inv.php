<?php

$ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/modelos/conexion.php";

require_once $ruta;

class ModeloTecnologia{


	/*=========================
	DESCARGAR INFORMACION DE LOS ACTIVOS
	=========================*/
	static public function mdlGenerarReporteInformacionActivos($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT numero_puesto, punto_red, par_categoria.categoria, marca, clasificacion, numero_placa, serial, par_ubicacion.ubicacion, fecha_adquisicion, par_proyecto.proyecto, estado_activo, observaciones
		FROM tecnologia JOIN par_categoria ON tecnologia.categoria = par_categoria.id_categoria JOIN par_ubicacion ON tecnologia.ubicacion = par_ubicacion.id_ubicacion JOIN par_proyecto ON tecnologia.proyecto = par_proyecto.id_proyecto");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

		$stmt = null;

	}


	/*=========================
	ASIGNAR RESPONSABLE ACTIVO
	=========================*/
	static public function mdlAsignarResponsableActivo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_responsable = :id_responsable, pdf_entrega_equipo = :pdf_entrega_equipo, estado = :estado WHERE id_activos = :id_activos");

		$stmt->bindParam(":id_responsable", $datos["id_responsable"], PDO::PARAM_STR);
		$stmt->bindParam(":pdf_entrega_equipo", $datos["pdf_entrega_equipo"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":id_activos", $datos["id_activos"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();

		}

		$stmt->close();

		$stmt = null;


	}

	/*=========================
	QUITAR ASIGNACION RESPONSABLE ACTIVO
	=========================*/
	static public function mdlQuitarAsignacionActivo($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = 0, id_responsable = NULL, pdf_entrega_equipo = NULL WHERE $item = :$item");

		$stmt -> bindParam(":". $item,$valor, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();
			
		}

		$stmt->close();

		$stmt = null;

	}


	/*=============================================
	OBTENER DATOS REQUERIDOS TABLAS
	=============================================*/
	static public function mdlObtenerDatosRequeridosAll($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where $item = :$item");
			
		$stmt -> bindParam(":". $item,$valor, PDO::PARAM_STR);

		$stmt -> execute(); 

		return $stmt -> fetchAll();

		$stmt->close();

		$stmt = null;

	}


	/*=============================================
	OBTENER DATO REQUERIDO TABLA
	=============================================*/
	static public function mdlObternerDatoRequerido($tabla, $item, $valor){

		if($item != null){
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where $item = :$item");
			
			$stmt -> bindParam(":". $item,$valor, PDO::PARAM_STR);

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

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function MdlMostrarTecnologia($tabla , $item , $valor ,$perfil){
		
		if($item != null){
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where $item = :$item");
			
			$stmt -> bindParam(":". $item,$valor, PDO::PARAM_STR ,PDO::PARAM_INT);

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
	/*=============================================
	MOSTRAR CATEGORIA
	=============================================*/

	static public function MdlMostrarCategoria($tabla , $item , $valor ,$perfil){
		
		if($item != null){
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where $item = :$item");
			
			$stmt -> bindParam(":". $item,$valor, PDO::PARAM_STR ,PDO::PARAM_INT);

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
	/*=============================================
	MOSTRAR ubicacion
	=============================================*/

	static public function MdlMostrarUbicacion($tabla , $item , $valor ,$perfil){
		
		if($item != null){
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where $item = :$item");
			
			$stmt -> bindParam(":". $item,$valor, PDO::PARAM_STR ,PDO::PARAM_INT);

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
	/*=============================================
	MOSTRAR PROYECTO
	=============================================*/

	static public function MdlMostrarProyecto($tabla , $item , $valor ,$perfil){
		
		if($item != null){
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where $item = :$item");
			
			$stmt -> bindParam(":". $item,$valor, PDO::PARAM_STR ,PDO::PARAM_INT);

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


    /*==================================
	REGISTRO DE ACTIVOS 
	=============================================*/

	static public function mdlIngresarTecnologia($tabla , $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (ubicacion, proyecto, numero_puesto, punto_red, categoria, clasificacion, marca, numero_placa, serial, estado_activo, fecha_adquisicion, cuenta_contable, valor_compra, valor_comercial, observaciones, id_usuario_creacion, metodo_adquisicion_activo, centro_costos_activo) VALUES (:ubicacion, :proyecto, :numero_puesto, :punto_red, :categoria, :clasificacion, :marca, :numero_placa, :serial, :estado_activo, :fecha_adquisicion, :cuenta_contable, :valor_compra, :valor_comercial, :observaciones, :id_usuario_creacion, :metodo_adquisicion_activo, :centro_costos_activo)");


		$stmt->bindParam(":ubicacion", $datos["ubicacion"], PDO::PARAM_STR);
		$stmt->bindParam(":proyecto", $datos["proyecto"], PDO::PARAM_STR);
		$stmt->bindParam(":numero_puesto", $datos["numero_puesto"], PDO::PARAM_STR);
		$stmt->bindParam(":punto_red", $datos["punto_red"], PDO::PARAM_STR);
		$stmt->bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
		$stmt->bindParam(":clasificacion", $datos["clasificacion"], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":numero_placa", $datos["numero_placa"], PDO::PARAM_STR);
		$stmt->bindParam(":serial", $datos["serial"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_activo", $datos["estado_activo"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_adquisicion", $datos["fecha_adquisicion"], PDO::PARAM_STR);
		$stmt->bindParam(":cuenta_contable", $datos["cuenta_contable"], PDO::PARAM_STR);
		$stmt->bindParam(":valor_compra", $datos["valor_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":valor_comercial", $datos["valor_comercial"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario_creacion", $datos["id_usuario_creacion"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_adquisicion_activo", $datos["metodo_adquisicion_activo"], PDO::PARAM_STR);
		$stmt->bindParam(":centro_costos_activo", $datos["centro_costos_activo"], PDO::PARAM_STR);

		
		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();
		
		}

		$stmt->close();
		
		$stmt = null;

	}	

	/*=============================================
	EDITAR ACTIVO
	=============================================*/
	static public function mdlEditarTecnologia($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET ubicacion = :ubicacion, proyecto = :proyecto, numero_puesto = :numero_puesto, punto_red = :punto_red, id_responsable = :id_responsable, categoria = :categoria, clasificacion = :clasificacion, marca = :marca, numero_placa = :numero_placa, serial = :serial, 
		estado_activo = :estado_activo, fecha_adquisicion = :fecha_adquisicion, cuenta_contable = :cuenta_contable, valor_compra = :valor_compra, valor_comercial = :valor_comercial, observaciones = :observaciones, metodo_adquisicion_activo = :metodo_adquisicion_activo, centro_costos_activo = :centro_costos_activo WHERE id_activos = :id_activos");


		$stmt -> bindParam(":ubicacion",$datos["ubicacion"], PDO::PARAM_STR);
		$stmt -> bindParam(":proyecto",$datos["proyecto"], PDO::PARAM_STR);
		$stmt -> bindParam(":numero_puesto",$datos["numero_puesto"], PDO::PARAM_STR);
		$stmt -> bindParam(":punto_red",$datos["punto_red"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_responsable",$datos["id_responsable"], PDO::PARAM_STR);
		$stmt -> bindParam(":categoria",$datos["categoria"], PDO::PARAM_STR);
		$stmt -> bindParam(":clasificacion",$datos["clasificacion"], PDO::PARAM_STR);
		$stmt -> bindParam(":marca",$datos["marca"], PDO::PARAM_STR);
		$stmt -> bindParam(":numero_placa",$datos["numero_placa"], PDO::PARAM_STR);
		$stmt -> bindParam(":serial",$datos["serial"], PDO::PARAM_STR);
		$stmt -> bindParam(":estado_activo",$datos["estado_activo"], PDO::PARAM_STR);
		$stmt -> bindParam(":fecha_adquisicion",$datos["fecha_adquisicion"], PDO::PARAM_STR);
		$stmt -> bindParam(":cuenta_contable",$datos["cuenta_contable"], PDO::PARAM_STR);
		$stmt -> bindParam(":valor_compra",$datos["valor_compra"], PDO::PARAM_STR);
		$stmt -> bindParam(":valor_comercial",$datos["valor_comercial"], PDO::PARAM_STR);
		$stmt -> bindParam(":observaciones",$datos["observaciones"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_activos",$datos["id_activos"], PDO::PARAM_STR);
		$stmt -> bindParam(":metodo_adquisicion_activo",$datos["metodo_adquisicion_activo"], PDO::PARAM_STR);
		$stmt -> bindParam(":centro_costos_activo",$datos["centro_costos_activo"], PDO::PARAM_STR);


		if($stmt -> execute()){

			return "ok";
		
		}else{

			return $stmt->errorInfo();

		}

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	ACTUALIZAR ESTADO
	=============================================*/

	static public function mdlActualizarTecnologia($tabla, $item1, $valor1, $item2, $valor2){

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
	ACTUALIZAR ESTADO ACTIVO
	=============================================*/
	static public function mdlActualizarEstadoActivo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado_activo = :estado_activo WHERE id_activos = :id_activos");

		$stmt->bindParam(":estado_activo", $datos["estado_activo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_activos", $datos["id_activos"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
			
		}

		$stmt->close();

		$stmt = null;


	}

	
	/*=============================================
	BORRAR ACTIVO
	=============================================*/

	static public function mdlBorrarTecnologia($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM tecnologia WHERE id_activos = :id_activos");

		$stmt -> bindParam(":id_activos", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}

	static public function mdlMostrarPerfilesactivo($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE perfil !='administrador';");

		$stmt -> execute();

		return $stmt -> fetchAll();		

		$stmt -> close();

		$stmt = null;

	}


}
