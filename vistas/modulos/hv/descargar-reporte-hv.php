<?php

/*======================================
CONTROLADORES
=======================================*/
require_once "../../../controladores/hoja-vida.controlador.php";
require_once "../../../controladores/parametricas.controlador.php";
require_once "../../../controladores/reporte-excel.controlador.php";

/*======================================
MODELOS
=======================================*/
require_once "../../../modelos/hoja-vida.modelo.php";
require_once "../../../modelos/parametricas.modelo.php";

$reporteExcelHv = new ControladorReporteExcel();
$reporteExcelHv->ctrGenerarExcelDatosPersonalesTodos2();
