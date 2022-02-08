<?php

/*======================================
CONTROLADORES
=======================================*/
require "../../../controladores/inv/Correctivo.Controlador-inv.php";
require "../../../controladores/inv/cronograma.controlador-inv.php";
require "../../../controladores/inv/tecnolgia.controlador-inv.php";
require "../../../controladores/reporte-excel.controlador.php";

/*======================================
MODELOS
=======================================*/

require "../../../modelos/inv/Correctivo.modelo-inv.php";
require "../../../modelos/inv/cronograma.modelo-inv.php";
require "../../../modelos/inv/tecnologia.modelo-inv.php";

$reporteExcelMantenimientos = new ControladorReporteExcel();
$reporteExcelMantenimientos->ctrGenerarExcelMantenimientosEquipo();

$reporteInformacionActivos = new ControladorReporteExcel();
$reporteInformacionActivos->ctrGenerarExcelInformacionActivos();