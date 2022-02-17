<?php

$ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/modelos/conexion.php";

require_once $ruta;

class ModeloCorrespondencia {

	/*============================
    OBTENER CODIGO ULTIMA CORRESPONDENCIA PROYECTO
    =============================*/
	static public function mdlObtenerUltimoCodigoCorEnviada($idProyecto){

		$stmt = Conexion::conectar()->prepare("SELECT codigo FROM correspondencia_enviada WHERE id_proyecto = $idProyecto ORDER BY codigo DESC LIMIT 1");

		$stmt->execute();

		return $stmt->fetch();

		$stmt = null;

	}


	/*============================
    CANTIDAD EN CORRESPONDENCIA ASIGNADA Y RE-ASIGNADA GLOBAL
    =============================*/
	static public function mdlObtenerCantidadesCorrespondenciaRecibida($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT
		( SELECT COUNT(*) AS CANTIDAD_ASIGNADA FROM $tabla WHERE estado_asignacion_cor_recibida = 'Asignada' OR estado_asignacion_cor_recibida = 'Rechazada' ) AS CANTIDAD_ASIGNADA,
		( SELECT COUNT(*) AS CANTIDAD_RE_ASIGNADA FROM $tabla WHERE estado_asignacion_cor_recibida = 'Re-Asignada' ) AS CANTIDAD_RE_ASIGNADA,
		( SELECT COUNT(*) AS CANTIDAD_ACEPTADA FROM $tabla WHERE estado_cor_recibida != 'Gestionada' AND estado_asignacion_cor_recibida = 'Aceptada' OR estado_asignacion_cor_recibida = 'Re-Asignada-Rechaza' ) AS CANTIDAD_ACEPTADA
		FROM correspondencia_recibida GROUP BY CANTIDAD_RE_ASIGNADA");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;


	}


	/*============================
    CANTIDAD EN CORRESPONDENCIA ASIGNADA Y RE-ASIGNADA A UN USUARIO
    =============================*/
	static public function mdlObtenerCantidadAsignadaReAsignada($tabla, $idUsuario){

		$stmt = Conexion::conectar()->prepare("SELECT (SELECT COUNT(*) AS CANTIDAD_ASIGNADA FROM $tabla WHERE id_responsable = $idUsuario AND estado_asignacion_cor_recibida = 'Asignada') AS CANTIDAD_ASIGNADA, (SELECT COUNT(*) AS CANTIDAD_RE_ASIGNADA FROM $tabla WHERE id_usuario_re_asignacion_cor_recibida = $idUsuario AND estado_asignacion_cor_recibida = 'Re-Asignada') AS CANTIDAD_RE_ASIGNADA, (SELECT COUNT(*) AS CANTIDAD_ACEPTADA FROM $tabla WHERE id_responsable = $idUsuario AND estado_asignacion_cor_recibida = 'Aceptada' OR estado_asignacion_cor_recibida = 'Re-Asignada-Rechaza' AND estado_cor_recibida = 'Sin Gestion' AND estado_cor_recibida != NULL) AS CANTIDAD_ACEPTADA FROM $tabla GROUP BY CANTIDAD_RE_ASIGNADA");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;


	}


	/*===============================
    GUARDAR GESTION RADICADO/RESPUESTA
    ================================*/
	static public function mdlGuardarGestionRadicadoRespuesta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo_concecutivo_generado = :codigo_concecutivo_generado, observaciones_gestion_cor_recibida = :observaciones_gestion_cor_recibida, fecha_gestion_cor_recibida = :fecha_gestion_cor_recibida, estado_cor_recibida = :estado_cor_recibida WHERE id_cor_recibida = :id_cor_recibida");

		$stmt->bindParam("codigo_concecutivo_generado", $datos["codigo_concecutivo_generado"], PDO::PARAM_STR);
		$stmt->bindParam("observaciones_gestion_cor_recibida", $datos["observaciones_gestion_cor_recibida"], PDO::PARAM_STR);
		$stmt->bindParam("fecha_gestion_cor_recibida", $datos["fecha_gestion_cor_recibida"], PDO::PARAM_STR);
		$stmt->bindParam("id_cor_recibida", $datos["id_cor_recibida"], PDO::PARAM_STR);
		$stmt->bindParam("estado_cor_recibida", $datos["estado_cor_recibida"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();

		}

		$stmt->close();

		$stmt = null;


	}


	/*===============================
    RE-ASIGNACION CORRESPONDENCIA ENTRANTE
    ================================*/
	static public function mdlReAsignarCorEntrante($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_usuario_re_asignacion_cor_recibida = :id_usuario_re_asignacion_cor_recibida, motivo_re_asignacion_cor_recibida = :motivo_re_asignacion_cor_recibida, estado_asignacion_cor_recibida = :estado_asignacion_cor_recibida, observaciones_asignacion_rechaza = NULL WHERE id_cor_recibida = :id_cor_recibida");

		$stmt->bindParam(":id_usuario_re_asignacion_cor_recibida", $datos["id_usuario_re_asignacion_cor_recibida"], PDO::PARAM_STR);
		$stmt->bindParam(":motivo_re_asignacion_cor_recibida", $datos["motivo_re_asignacion_cor_recibida"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cor_recibida", $datos["id_cor_recibida"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_asignacion_cor_recibida", $datos["estado_asignacion_cor_recibida"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();		

		}

		$stmt->close();

		$stmt = null;

	}


	/*===============================
    CARGAR RADICADO/RESPUESTA
    ================================*/
	static public function mdlCargarRadicadoRespuesta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_cor_enviada, asunto, observaciones_cor_recibida, archivo_adj_recibido, id_proyecto, id_responsable, estado_asignacion_cor_recibida, id_usuario_creacion, tipo_cor_recibida) VALUES (:id_cor_enviada, :asunto, :observaciones_cor_recibida, :archivo_adj_recibido, :id_proyecto, :id_responsable, :estado_asignacion_cor_recibida, :id_usuario_creacion, :tipo_cor_recibida)");

		$stmt->bindParam(":id_cor_enviada", $datos["id_cor_enviada"], PDO::PARAM_STR);
		$stmt->bindParam(":asunto", $datos["asunto"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones_cor_recibida", $datos["observaciones_cor_recibida"], PDO::PARAM_STR);
		$stmt->bindParam(":archivo_adj_recibido", $datos["archivo_adj_recibido"], PDO::PARAM_STR);
		$stmt->bindParam(":id_proyecto", $datos["id_proyecto"], PDO::PARAM_STR);
		$stmt->bindParam(":id_responsable", $datos["id_responsable"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_asignacion_cor_recibida", $datos["estado_asignacion_cor_recibida"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario_creacion", $datos["id_usuario_creacion"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_cor_recibida", $datos["tipo_cor_recibida"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();

		}

		$stmt->close();

		$stmt = null;

	}


	/*===========================
    RECHAZAR ASIGNACION CORRESPONDENCIA RECIBIDA
    ============================*/
	static public function mdlRechazarCorrespondenciaRecibida($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado_asignacion_cor_recibida = :estado_asignacion_cor_recibida, observaciones_asignacion_rechaza = :observaciones_asignacion_rechaza WHERE id_cor_recibida = :id_cor_recibida");

		$stmt -> bindParam(":estado_asignacion_cor_recibida", $datos["estado_asignacion_cor_recibida"], PDO::PARAM_STR);
		$stmt -> bindParam(":observaciones_asignacion_rechaza", $datos["observaciones_asignacion_rechaza"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_cor_recibida", $datos["id_cor_recibida"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();

		}

		$stmt->close();

		$stmt = null;

	}

	/*===========================
    RECHAZAR ASIGNACION CORRESPONDENCIA RECIBIDA RE-ASIGNADA
    ============================*/
	static public function mdlRechazarCorrespondenciaRecibidaReAsign($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado_asignacion_cor_recibida = :estado_asignacion_cor_recibida, observaciones_asignacion_rechaza = :observaciones_asignacion_rechaza WHERE id_cor_recibida = :id_cor_recibida");

		$stmt -> bindParam(":estado_asignacion_cor_recibida", $datos["estado_asignacion_cor_recibida"], PDO::PARAM_STR);
		$stmt -> bindParam(":observaciones_asignacion_rechaza", $datos["observaciones_asignacion_rechaza"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_cor_recibida", $datos["id_cor_recibida"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();

		}

		$stmt->close();

		$stmt = null;

	}


	/*===========================
    ACEPTAR ASIGNACION CORRESPONDENCIA RECIBIDA
    ============================*/
	static public function mdlAceptarCorrespondenciaRecibida($tabla, $item, $valor){

		$hoy = date("Y-m-d H:i:s");

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado_asignacion_cor_recibida = 'Aceptada', estado_cor_recibida = 'Sin Gestion', fecha_acepta_asignacion = '$hoy' WHERE $item = :$item");

		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();

		}

		$stmt->close();

		$stmt = null;


	}

	/*===========================
    ACEPTAR ASIGNACION CORRESPONDENCIA RECIBIDA RE-ASIGNADA
    ============================*/
	static public function mdlAceptarCorrespondenciaRecibidaReAsign($tabla, $item, $valor, $idUsuario){

		$hoy = date("Y-m-d H:i:s");

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado_asignacion_cor_recibida = 'Aceptada', estado_cor_recibida = 'Sin Gestion', fecha_acepta_asignacion = '$hoy', id_responsable = $idUsuario, id_usuario_re_asignacion_cor_recibida = NULL, motivo_re_asignacion_cor_recibida = NULL, observaciones_asignacion_rechaza = NULL WHERE $item = :$item");

		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();

		}

		$stmt->close();

		$stmt = null;


	}


	/*===============================
    EDITAR FACTURA/RECIBO RECIBIDA
    ================================*/
	static public function mdlEditarFacturaCorRec($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET asunto = :asunto, observaciones_cor_recibida = :observaciones_cor_recibida, id_proyecto = :id_proyecto, id_responsable = :id_responsable, estado_asignacion_cor_recibida = :estado_asignacion_cor_recibida, observaciones_asignacion_rechaza = :observaciones_asignacion_rechaza, tipo_cor_recibida = :tipo_cor_recibida WHERE id_cor_recibida = :id_cor_recibida");

		$stmt->bindParam(":asunto", $datos["asunto"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones_cor_recibida", $datos["observaciones_cor_recibida"], PDO::PARAM_STR);
		$stmt->bindParam(":id_proyecto", $datos["id_proyecto"], PDO::PARAM_STR);
		$stmt->bindParam(":id_responsable", $datos["id_responsable"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_asignacion_cor_recibida", $datos["estado_asignacion_cor_recibida"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cor_recibida", $datos["id_cor_recibida"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones_asignacion_rechaza", $datos["observaciones_asignacion_rechaza"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_cor_recibida", $datos["tipo_cor_recibida"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();

		}

		$stmt -> close();

		$stmt = null;
        
    }


	/*===============================
    CARGAR FACTURA/RECIBO RECIBIDA
    ================================*/
	static public function mdlCargarFacturaCorRec($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(asunto, observaciones_cor_recibida, archivo_adj_recibido, id_proyecto, id_responsable, tipo_cor_recibida, estado_asignacion_cor_recibida, id_usuario_creacion) VALUES (:asunto, :observaciones_cor_recibida, :archivo_adj_recibido, :id_proyecto, :id_responsable, :tipo_cor_recibida, :estado_asignacion_cor_recibida, :id_usuario_creacion)");

		$stmt->bindParam(":asunto", $datos["asunto"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones_cor_recibida", $datos["observaciones_cor_recibida"], PDO::PARAM_STR);
		$stmt->bindParam(":archivo_adj_recibido", $datos["archivo_adj_recibido"], PDO::PARAM_STR);
		$stmt->bindParam(":id_proyecto", $datos["id_proyecto"], PDO::PARAM_STR);
		$stmt->bindParam(":id_responsable", $datos["id_responsable"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_asignacion_cor_recibida", $datos["estado_asignacion_cor_recibida"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario_creacion", $datos["id_usuario_creacion"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_cor_recibida", $datos["tipo_cor_recibida"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();

		}

		$stmt -> close();

		$stmt = null;

	}


	/*===============================
    ANULAR/DEVOLVER DOCUMENTO A RADICAR
    ===============================*/
	static public function mdlAnularDevolverDocumentoRadicar($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado, motivo_anulacion = :motivo_anulacion, id_usuario_cancelacion = :id_usuario_cancelacion, fecha_cancelacion = :fecha_cancelacion WHERE id_cor_enviado = :id_cor_enviado");

		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":motivo_anulacion", $datos["motivo_anulacion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario_cancelacion", $datos["id_usuario_cancelacion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_cancelacion", $datos["fecha_cancelacion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cor_enviado", $datos["id_cor_enviado"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();

		}

		$stmt -> close();

		$stmt = null;

	}


	/*===============================
    CARGAR RESPUESTA A RADICADO
    ===============================*/
	static public function mdlCargarRespuestaDocumentoRadicado($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado, archivo_adj_recibido = :archivo_adj_recibido, radicado = :radicado, id_usuario_carga_respuesta = :id_usuario_carga_respuesta, fecha_carga_respuesta = :fecha_carga_respuesta WHERE id_cor_enviado = :id_cor_enviado");

		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":archivo_adj_recibido", $datos["archivo_adj_recibido"], PDO::PARAM_STR);
		$stmt->bindParam(":radicado", $datos["radicado"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario_carga_respuesta", $datos["id_usuario_carga_respuesta"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_carga_respuesta", $datos["fecha_carga_respuesta"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cor_enviado", $datos["id_cor_enviado"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();

		}

		$stmt -> close();

		$stmt = null;

	}


	/*===============================
    CARGAR DOCUMENTO A RADICAR
    ===============================*/
	static public function mdlCargarDocumentoRadicar($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET archivo_adj_enviado = :archivo_adj_enviado, asunto = :asunto, estado = :estado, id_usuario_carga_documento = :id_usuario_carga_documento, fecha_carga_documento = :fecha_carga_documento WHERE id_cor_enviado = :id_cor_enviado");

		$stmt->bindParam(":archivo_adj_enviado", $datos["archivo_adj_enviado"], PDO::PARAM_STR);
		$stmt->bindParam(":asunto", $datos["asunto"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario_carga_documento", $datos["id_usuario_carga_documento"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_carga_documento", $datos["fecha_carga_documento"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cor_enviado", $datos["id_cor_enviado"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();

		}

		$stmt -> close();

		$stmt = null;


	}


	/*===============================
    CREAR CODIGO CONCECUTIVO
    ===============================*/
	static public function mdlCrearCodigoConcecutivo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_proyecto, id_usuario, estado) VALUES (:codigo, :id_proyecto, :id_usuario, :estado)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_proyecto", $datos["id_proyecto"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();

		}

		$stmt -> close();

		$stmt = null;

	}


	/*==========================
    OBTENER CODIGO CONCECUTIVO
    ===========================*/
	static public function mdlObtenerCodigoConcecutivo($tabla, $idProyecto){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_proyecto = $idProyecto");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}


    /*==========================
    MOSTRAR CORRESPONDENCIA ENVIADA/RECIBIDA
    ===========================*/
    static public function mdlCorrespondenciaRequerida($tabla, $item, $valor){

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

}