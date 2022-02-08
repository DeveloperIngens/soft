<?php

$ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/modelos/conexion.php";

require_once $ruta;


class ModeloCronograma{

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function MostrarCronograma($tabla,$item,$valor){
	
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
	REALIZAR MANTENIMIENTO PROGRAMADO
	=============================================*/
	static public function mdlRealizarMantenimientoProgramado($tabla , $datos , $datos2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET responsable = :responsable, mantenimiento = :mantenimiento, observaciones = :observaciones, estado_mantenimiento = :estado_mantenimiento WHERE id_calendario = :id_calendario");

		$stmt->bindParam(":responsable", $datos["responsable"], PDO::PARAM_STR);
		$stmt->bindParam(":mantenimiento", $datos["mantenimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_mantenimiento", $datos["estado_mantenimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":id_calendario", $datos["id_calendario"], PDO::PARAM_STR);


		if(!empty($datos2)){

			$stmt2 = Conexion::conectar()->prepare("INSERT INTO $tabla(fecha_mante, prox_mante, serial, placa, id_activo, color, id_usuario_creacion, estado_mantenimiento) VALUES (:fecha_mante, :prox_mante, :serial, :placa, :id_activo, :color, :id_usuario_creacion, :estado_mantenimiento)");

			$stmt2->bindParam(":fecha_mante", $datos2["fecha_mante"], PDO::PARAM_STR);
			$stmt2->bindParam(":serial", $datos2["serial"], PDO::PARAM_STR);
			$stmt2->bindParam(":placa", $datos2["placa"], PDO::PARAM_STR);
			$stmt2->bindParam(":color", $datos2["color"], PDO::PARAM_STR);
			$stmt2->bindParam(":id_activo", $datos2["id_activo"], PDO::PARAM_STR);
			$stmt2->bindParam(":id_usuario_creacion", $datos2["id_usuario_creacion"], PDO::PARAM_STR);
			$stmt2->bindParam(":prox_mante", $datos2["prox_mante"], PDO::PARAM_STR);
			$stmt2->bindParam(":estado_mantenimiento", $datos2["estado_mantenimiento"], PDO::PARAM_STR);


			if($stmt2->execute()){

				"ok";

			}else{

				"error";
			}
		}

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}


	/*=============================================
	REGISTRO DE EVENTOS
	=============================================*/
	static public function mdlIngresarCronograma($tabla, $datos, $datos2){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (responsable, fecha_mante, prox_mante, mantenimiento, placa, serial,  observaciones, color, id_activo, id_usuario_creacion, estado_mantenimiento) VALUES (:responsable, :fecha_mante, :prox_mante, :mantenimiento, :placa, :serial, :observaciones, :color, :id_activo, :id_usuario_creacion, :estado_mantenimiento)");

		$stmt->bindParam(":responsable", $datos["responsable"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_mante", $datos["fecha_mante"], PDO::PARAM_STR);
		$stmt->bindParam(":prox_mante", $datos["prox_mante"], PDO::PARAM_STR);
		$stmt->bindParam(":mantenimiento", $datos["mantenimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":placa", $datos["placa"], PDO::PARAM_STR);
		$stmt->bindParam(":serial", $datos["serial"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":color", $datos["color"], PDO::PARAM_STR);
		$stmt->bindParam(":id_activo", $datos["id_activo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario_creacion", $datos["id_usuario_creacion"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_mantenimiento", $datos["estado_mantenimiento"], PDO::PARAM_STR);


		if(!empty($datos2)){

			$stmt2 = Conexion::conectar()->prepare("INSERT INTO $tabla(fecha_mante, prox_mante, serial, placa, id_activo, color, id_usuario_creacion, estado_mantenimiento) VALUES (:fecha_mante, :prox_mante, :serial, :placa, :id_activo, :color, :id_usuario_creacion, :estado_mantenimiento)");

			$stmt2->bindParam(":fecha_mante", $datos2["fecha_mante"], PDO::PARAM_STR);
			$stmt2->bindParam(":serial", $datos2["serial"], PDO::PARAM_STR);
			$stmt2->bindParam(":placa", $datos2["placa"], PDO::PARAM_STR);
			$stmt2->bindParam(":color", $datos2["color"], PDO::PARAM_STR);
			$stmt2->bindParam(":id_activo", $datos2["id_activo"], PDO::PARAM_STR);
			$stmt2->bindParam(":id_usuario_creacion", $datos2["id_usuario_creacion"], PDO::PARAM_STR);
			$stmt2->bindParam(":prox_mante", $datos2["prox_mante"], PDO::PARAM_STR);
			$stmt2->bindParam(":estado_mantenimiento", $datos2["estado_mantenimiento"], PDO::PARAM_STR);


			if($stmt2->execute()){

				"ok";

			}else{

				"error";
			}
		}

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}
	/*=============================================
	REGISTRO DE EVENTOS EN EL CALENDARIO
	=============================================*/

	static public function mdlIngresarCalendario($tabla, $datos, $datos2){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (responsable,fecha_mante, prox_mante , mantenimiento , placa , serial,  observaciones ,color ) VALUES (:responsable ,:fecha_mante , :prox_mante, :mantenimiento , :placa , :serial , :observaciones ,:color )");

		$stmt->bindParam(":responsable", $datos["responsable"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_mante", $datos["fecha_mante"], PDO::PARAM_STR);
		$stmt->bindParam(":prox_mante", $datos["prox_mante"], PDO::PARAM_STR);
		$stmt->bindParam(":mantenimiento", $datos["mantenimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":placa", $datos["placa"], PDO::PARAM_STR);
		$stmt->bindParam(":serial", $datos["serial"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":color", $datos["color"], PDO::PARAM_STR);

		if(!empty($datos)){

			$stmt2 = Conexion::conectar()->prepare("INSERT INTO $tabla(fecha_mante, serial, placa , mantenimiento , color) VALUES (:fecha_mante, :serial, :placa ,:mantenimiento ,:color )");

			$stmt2->bindParam(":fecha_mante", $datos2["fecha_mante"], PDO::PARAM_STR);
			$stmt2->bindParam(":serial", $datos2["serial"], PDO::PARAM_STR);
			$stmt2->bindParam(":placa", $datos2["placa"], PDO::PARAM_STR);
			$stmt2->bindParam(":mantenimiento", $datos2["mantenimiento"], PDO::PARAM_STR);
			$stmt2->bindParam(":color", $datos2["color"], PDO::PARAM_STR);
			
			if($stmt2->execute()){

				"ok";

			}else{

				"error";
			}



		}


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}



	/*=============================================
	REGISTRO PROXIMA FECHA
	=============================================*/
	static public function MdlProximos( $tabla, $fecha_mante,$serial,$placa) {

		$solucion = Conexion::conectar()->prepare("INSERT INTO $tabla (prox_mante , serial, placa) values ($fecha_mante , $serial , $placa) " );

		if ($solucion->execute()) {
			return"ok";
		}else{
			var_dump($solucion->errorInfo());
		}
		$solucion->close();

		$solucion=null;
	}

	/*----------
	EDITAR MANTENIMIENTO DESDE EL CALENDARIO
	------------------------------------------------------------*/
	static PUBLIC function MdlEditarMantenimientos($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET responsable=:responsable, fecha_mante=:fecha_mante, prox_mante=:prox_mante , mantenimiento=:mantenimiento , placa=:placa , serial=:serial , observaciones=:observaciones , color=:color where id_calendario=:id_calendario");

		$stmt->bindParam(":responsable", $datos["responsable"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_mante", $datos["fecha_mante"], PDO::PARAM_STR);
		$stmt->bindParam(":prox_mante", $datos["prox_mante"], PDO::PARAM_STR);
		$stmt->bindParam(":mantenimiento", $datos["mantenimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":placa", $datos["placa"], PDO::PARAM_STR);		
		$stmt->bindParam(":serial", $datos["serial"], PDO::PARAM_STR);		
		$stmt->bindParam(":color", $datos["color"], PDO::PARAM_STR);			
		$stmt->bindParam(":id_calendario" , $datos["id_calendario"],PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;


	}

	/*=============================================
	EDITAR MANTENIMIENTO
	=============================================*/
	static PUBLIC function MdlEditarMante($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET mantenimiento = :mantenimiento, observaciones = :observaciones WHERE id_calendario = :id_calendario");

		$stmt->bindParam(":mantenimiento", $datos["mantenimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":id_calendario" , $datos["id_calendario"],PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;


	}


	/*=============================================
	BORRAR MANTENIMIENTO
	=============================================*/
	static public function mdlBorrarMantenimiento($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = 0 WHERE id_calendario = :id_calendario");

		$stmt -> bindParam(":id_calendario", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}

	/*=============================================
	ACTUALIZAR MANTENIMIENTO
	=============================================*/
	static public function mdlActualizarMantenimiento($tabla, $item1, $valor1, $item2, $valor2){

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

}
