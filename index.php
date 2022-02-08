<?php

/*===============================
CONTROLADORES HV
===============================*/
require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/perfiles.usuarios.controlador.php";
require_once "controladores/parametricas.controlador.php";
require_once "controladores/hoja-vida.controlador.php";
require_once "controladores/reporte-excel.controlador.php";
require_once "controladores/correo.controlador.php";
require_once "controladores/reportes.controlador.php";

/*==============================
MODELOS HV
===============================*/
require_once "modelos/usuarios.modelo.php";
require_once "modelos/perfiles.usuarios.modelo.php";
require_once "modelos/parametricas.modelo.php";
require_once "modelos/hoja-vida.modelo.php";
require_once "modelos/reportes.modelo.php";

/*===============================
CONTROLADORES CORRESPONDENCIA
===============================*/
require_once "controladores/correspondencia/parametricas-cor.controlador.php";
require_once "controladores/correspondencia/correspondencia-cor.controlador.php";

/*==============================
MODELOS CORRESPONDENCIA
===============================*/
require_once "modelos/correspondencia/parametricas-cor.modelo.php";
require_once "modelos/correspondencia/correspondencia-cor.modelo.php";

/*===============================
CONTROLADORES INVENTARIO
===============================*/
require_once "controladores/inv/cronograma.controlador-inv.php";
require_once "controladores/inv/tecnolgia.controlador-inv.php";
require_once "controladores/inv/Correctivo.Controlador-inv.php";
require_once "controladores/inv/software.controlador-inv.php";

/*===============================
MODELOS INVENTARIO
===============================*/
require_once "modelos/inv/cronograma.modelo-inv.php";
require_once "modelos/inv/tecnologia.modelo-inv.php";
require_once "modelos/inv/Correctivo.modelo-inv.php";
require_once "modelos/inv/par_software.modelo-inv.php";


$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();