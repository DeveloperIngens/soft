<?php


class ModeloReportes{

    /*==================================
    OBTENER EQUIPOS PROPIOS O ARRENDADO ESTADO DE CONDICION
    ===================================*/
    static public function mdlObtenerEquiposEstadoCondicion($tabla){

        $stmt = Conexion::conectar()->prepare("SELECT centro_costos_activo, estado_activo, metodo_adquisicion_activo, COUNT( estado_activo ) AS cantidad_estado FROM $tabla GROUP BY centro_costos_activo, estado_activo, metodo_adquisicion_activo");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;

    }


    /*==================================
    OBTENER EQUIPOS PROPIOS O ARRENDADO COMPUTADORES PANTALLA PORTATIL
    ===================================*/
    static public function mdlObtenerEquiposPcDatos($tabla1, $tabla2){

        $stmt = Conexion::conectar()->prepare("SELECT centro_costos_activo, $tabla2.categoria, SUM(CASE WHEN metodo_adquisicion_activo = 'Propio' AND centro_costos_activo = 'Consorcio' OR metodo_adquisicion_activo = 'Propio' AND centro_costos_activo = 'Ags Americas' THEN 1 ELSE 0 END) AS propio, SUM(CASE WHEN metodo_adquisicion_activo = 'Rentado' AND centro_costos_activo = 'Consorcio' OR metodo_adquisicion_activo = 'Rentado' AND centro_costos_activo = 'Ags Americas' THEN 1 ELSE 0 END) AS rentado FROM $tabla1 JOIN $tabla2 ON $tabla1.categoria = $tabla2.id_categoria WHERE
        $tabla2.id_categoria IN (3,4,8,22) GROUP BY centro_costos_activo, $tabla2.categoria");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;

    }


    /*==================================
    OBTENER EQUIPOS PROPIOS O ARRENDADO
    ===================================*/
    static public function mdlObtenerEquiposPropiosArrendados($tabla){

        $stmt = Conexion::conectar()->prepare("SELECT centro_costos_activo,
        SUM(CASE WHEN metodo_adquisicion_activo = 'Propio' AND centro_costos_activo = 'Consorcio' OR metodo_adquisicion_activo = 'Propio' AND centro_costos_activo = 'Ags Americas' THEN 1 ELSE 0 END) AS propio,
        SUM(CASE WHEN metodo_adquisicion_activo = 'Rentado' AND centro_costos_activo = 'Consorcio' OR metodo_adquisicion_activo = 'Rentado' AND centro_costos_activo = 'Ags Americas' THEN 1 ELSE 0 END) AS rentado FROM $tabla GROUP BY centro_costos_activo");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;

    }

    /*==================================
    OBTENER EQUIPOS PROPIOS O ARRENDADO
    ===================================*/
    static public function mdlObtenerPropiosRentadosCategoria($tabla1, $tabla2){

        $stmt = Conexion::conectar()->prepare("SELECT $tabla2.categoria, IF(estado=1, 'Ocupado', 'Libre') AS estado, COUNT( estado ) AS cantidad_estado FROM $tabla1 JOIN $tabla2 ON $tabla1.categoria = $tabla2.id_categoria GROUP BY $tabla2.categoria, estado ORDER BY $tabla2.categoria DESC");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;

    }
    
}