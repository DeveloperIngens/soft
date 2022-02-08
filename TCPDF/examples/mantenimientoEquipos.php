<?php

//TRAE LOS VALORES DEL LA TABLA MANTENIMIENTO
require_once "../../controladores/inv/cronograma.controlador-inv.php";
require_once "../../modelos/inv/cronograma.modelo-inv.php";

//TRAE LOS VALORES DE LA TABLA PAR_TIPO_MANTENIMIENTO
require_once "../../controladores/inv/Correctivo.Controlador-inv.php";
require_once "../../modelos/inv/Correctivo.modelo-inv.php"; 

//TRAE LOS VALORES DE LA TABLA DE ACTIVOS FIJOS 
require_once "../../controladores/inv/tecnolgia.controlador-inv.php";
require_once "../../modelos/inv/tecnologia.modelo-inv.php";

class MantenimientoPdf{

public $id;

public function ImprimirPdf(){

//TRAER INFORMACION DE LA ENTREGA DE EQUIPOS

$itemActivo = "id_calendario";
$valorActivo = $this->id;
$mante = ControladorCronograma::ctrMostrarCronograma($itemActivo,$valorActivo);

//TRAER INFORMACION DEL ACTIVO
$tablaActivo = "tecnologia";
$itemActivo = "id_activos";
$valorActivo = $mante["id_activo"];

$activo = ControladorTecnologia::ctrObternerDatoRequerido($tablaActivo, $itemActivo, $valorActivo);

//TRAER INFORMACION CATEGORIA ACTIVO
$tablaCategoria = "par_categoria";
$itemCategoria = "id_categoria";
$valorCategoria = $activo["categoria"];

$categoria = ControladorTecnologia::ctrObternerDatoRequerido($tablaCategoria, $itemCategoria, $valorCategoria);

//TRAER INFORMACION UBICACION ACTIVO
$tablaUbicacion = "par_ubicacion";
$itemUbicacion = "id_ubicacion";
$valorUbicacion = $activo["ubicacion"];

$ubicacion = ControladorTecnologia::ctrObternerDatoRequerido($tablaUbicacion, $itemUbicacion, $valorUbicacion);

//TRAER INFORMACION PROYECTO
$tablaProyecto = "par_proyecto";
$itemProyecto = "id_proyecto";
$valorProyecto = $activo["proyecto"];

$proyecto = ControladorTecnologia::ctrObternerDatoRequerido($tablaProyecto, $itemProyecto, $valorProyecto);

if(!empty($mante["mantenimiento"])){

$mantenimientos = explode(",", $mante["mantenimiento"]);

$cadenMantenimientosPreventivos = "";
$cadenMantenimientosCorrectivos = "";

foreach ($mantenimientos as $key => $value){

$item ='id_tipo_mantenimiento';
$valor = $value;
$IDmantenimiento = ControladorCorrectivo::ctrMostrarCorrectivo($item,$valor);

    if($IDmantenimiento["tipo_mantenimiento"] == "Preventivo"){

        $cadenMantenimientosPreventivos .= $IDmantenimiento["nombre_mantenimiento"] . '<br>';

    }else if($IDmantenimiento["tipo_mantenimiento"] == "Correctivo"){

        $cadenMantenimientosCorrectivos .= $IDmantenimiento["nombre_mantenimiento"] . '<br>';

    }

}

}else{

$cadenMantenimientosPreventivos = "";
$cadenMantenimientosCorrectivos = "";    

}

require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

// add a page (left page)
$pdf->AddPage();

$pdf->Image('../../vistas/img/plantilla/Logo_AGS.jpg', 20, 13, 20, '22', '', '', '', false, 100);

//$pdf->Image('../../vistas/img/plantilla/Logo_AGS.jpg', 160, 257,40, '', '', '', '', false, 100);

$fecha_actual=date("Y-m-d");

date_default_timezone_set('America/Bogota');  

$hora=date('h:i a');

$entrega ='AREA DE SISTEMAS';

$bloque0 = <<<EOF

    <table style="padding: 5px;">

        <thead>
        
            <tr>
                <td style="border: 1px solid #666; background-color:white; width:130px; justify-content: center;"></td>
                <td style="border: 1px solid #666; background-color:white; text-align: center; width:410px; justify-content: center;"><div><h3>MANTENIMIENTO EQUIPO</h3></div></td>
            </tr>

        </thead>

    </table>
    <br>
    <br>
    <br>
    <br>
EOF;

$pdf->writeHTML($bloque0, false, false, false, false, '');

$bloque00 = <<<EOF

    <table style="padding: 5px; text-align: center;">

        <thead>

        <tr>

            <td style="border: 1px solid #666; background-color: #BCBCBC; width:540px;" colspan="4"><b style="text-align: center;">INFORMACIÓN MANTENIMIENTO</b></td>

        </tr>

        </thead>

    </table>
    <br>
    <br>

EOF;

$pdf->writeHTML($bloque00, false, false, false, false, '');

$bloque01 = <<<EOF

    <table style="padding: 5px; text-align: center;">

        <tbody>

            <tr>

                <td style="border: 1px solid #666; background-color: #BCBCBC; width:135px;">Fecha Mantenimiento:</td>
                <td style="border: 1px solid #666; background-color: white; width:135px;">$mante[fecha_mante]</td>
                <td style="border: 1px solid #666; background-color: #BCBCBC; width:135px;">Fecha Próximo Mantenimiento:</td>
                <td style="border: 1px solid #666; background-color: white; width:135px;">$mante[prox_mante]</td>

            </tr>

            <tr>

                <td style="border: 1px solid #666; background-color: #BCBCBC; width:210px;">Responsable Mantenimiento:</td>
                <td style="border: 1px solid #666; background-color: white; width:330px; text-align: center;">$mante[responsable]</td>

            </tr>

            <tr>

                <td style="border: 1px solid #666; background-color: #BCBCBC; width:135px;">Fecha Creación:</td>
                <td style="border: 1px solid #666; background-color: white; width:135px;">$fecha_actual</td>
                <td style="border: 1px solid #666; background-color: #BCBCBC; width:135px;">Hora Creación:</td>
                <td style="border: 1px solid #666; background-color: white; width:135px;">$hora</td>
            
            </tr>
        
        </tbody>
    
    </table>
    <br>
    <br>


EOF;

$pdf->writeHTML($bloque01, false, false, false, false, '');


$bloque02 = <<<EOF

    <table style="padding: 5px; text-align: center;">

        <thead>

            <tr>

                <td style="border: 1px solid #666; background-color: #BCBCBC; width:540px;" colspan="4"><b style="text-align: center;">DATOS ACTIVO</b></td>

            </tr>

        </thead>

    </table>
    <br>
    <br>

EOF;

$pdf->writeHTML($bloque02, false, false, false, false, '');

$bloque03 = <<<EOF

    <table style="padding: 5px; text-align: center;">

        <tbody>

            <tr>

                <td style="border: 1px solid #666; background-color: #BCBCBC; width:135px;">Categoria Activo:</td>
                <td style="border: 1px solid #666; background-color: white; width:135px;">$categoria[categoria]</td>
                <td style="border: 1px solid #666; background-color: #BCBCBC; width:135px;">Ubicación Activo:</td>
                <td style="border: 1px solid #666; background-color: white; width:135px;">$ubicacion[ubicacion]</td>

            </tr>

            <tr>

                <td style="border: 1px solid #666; background-color: #BCBCBC; width:135px;">Proyecto Activo:</td>
                <td style="border: 1px solid #666; background-color: white; width:135px;">$proyecto[proyecto]</td>
                <td style="border: 1px solid #666; background-color: #BCBCBC; width:135px;">Marca Activo:</td>
                <td style="border: 1px solid #666; background-color: white; width:135px;">$activo[marca]</td>

            </tr>

            <tr>

                <td style="border: 1px solid #666; background-color: #BCBCBC; width:135px;">Placa Activo:</td>
                <td style="border: 1px solid #666; background-color: white; width:135px;">$activo[numero_placa]</td>
                <td style="border: 1px solid #666; background-color: #BCBCBC; width:135px;">Serial Activo:</td>
                <td style="border: 1px solid #666; background-color: white; width:135px;">$activo[serial]</td>
            
            </tr>
        
        </tbody>
    
    </table>
    <br>
    <br>
    <br>
    <br>

EOF;

$pdf->writeHTML($bloque03, false, false, false, false, '');


$bloque04 = <<<EOF

    <table style="padding: 5px; text-align: center;">

        <thead>

            <tr>

                <td style="border: 1px solid #666; background-color: #BCBCBC; width:540px;" colspan="4"><b style="text-align: center;">MANTENIMIENTOS REALIZADOS</b></td>

            </tr>

        </thead>

    </table>
    <br>
    <br>

EOF;

$pdf->writeHTML($bloque04, false, false, false, false, '');

$bloque05 = <<<EOF

    <table style="padding: 5px; text-align: center;">

        <tbody>

            <tr>

                <th style="border: 1px solid #666; background-color: #BCBCBC; width:270px;">Mantenimientos Preventivos</th>
                <th style="border: 1px solid #666; background-color: #BCBCBC; width:270px;">Mantenimientos Correctivos</th>

            </tr>

            <tr>

                <td style="border: 1px solid #666; background-color: white; width:270px;">$cadenMantenimientosPreventivos</td>
                <td style="border: 1px solid #666; background-color: white; width:270px;">$cadenMantenimientosCorrectivos</td>

            </tr>

        </tbody>

    </table>
    <br>
    <br>


EOF;

$pdf->writeHTML($bloque05, false, false, false, false, '');

$pdf->AddPage();

$bloque06 = <<<EOF

    <table style="padding: 5px; text-align: center;">

        <thead>

            <tr>

                <td style="border: 1px solid #666; background-color: #BCBCBC; width:540px;" colspan="4"><b style="text-align: center;">OBSERVACIÓNES MANTENIMIENTO</b></td>

            </tr>

        </thead>

    </table>
    <br>
    <br>

EOF;

$pdf->writeHTML($bloque06, false, false, false, false, '');

$bloque07 = <<<EOF

    <table style="padding: 5px;">

        <tbody>

            <tr>

                <td style="border: 1px solid #666; background-color: white; width:540px; height: 100px;">$mante[observaciones]</td>

            </tr>

        </tbody>

    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>


EOF;

$pdf->writeHTML($bloque07, false, false, false, false, '');

$bloque08 = <<<EOF

    <table style="padding: 5px; text-align: center">

        <tbody>

            <tr>

                <td style="border-top: 1px solid #666; background-color: white; width:180px; height: 20px;"><b>Firma Área Sistemas</b></td>
                <td style="width:180px;"></td>
                <td style="border-top: 1px solid #666; background-color: white; width:180px; height: 20px;"><b>Firma Responsable Equipo</b></td>

            </tr>

        </tbody>

    </table>

EOF;

$pdf->writeHTML($bloque08, false, false, false, false, '');

// ---------------------------------------------
/*========================
SALIDA DEL ARCHIVO
========================*/
$pdf->Output('manteniento.pdf');

//============================================================+
// END OF FILE
//============================================================+
}


}

$factura = new MantenimientoPdf();
$factura -> id = $_GET["id"];
$factura -> ImprimirPdf();