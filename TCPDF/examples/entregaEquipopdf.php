<?php

require_once "../../controladores/inv/tecnolgia.controlador-inv.php";
require_once "../../modelos/inv/tecnologia.modelo-inv.php";

class ImprimirPdfEntregaEquipo{

public $id;


public function traerImpresionPdfEntragaEquipo(){

//TRAER INFORMACION DE LA ENTREGA DE EQUIPOS

$itemActivo = "id_activos";
$valorActivo = $this->id;
$perfil='usuario';
$activos = ControladorTecnologia::ctrMostrarTecnologia($itemActivo,$valorActivo,$perfil);


$itemCate ='id_categoria';
$valorCate =$activos['categoria'];
$perf1 ='usuario'; 
$categoria = ControladorTecnologia::ctrMostrarParametricas($itemCate,$valorCate,$perf1); 

$itemProyecto ='id_proyecto';
$valorProyecto=$activos['proyecto'];
$perfilProyecto ='usuario';
$proyecto = ControladorTecnologia::ctrMostrarProyecto($itemProyecto,$valorProyecto,$perfilProyecto);

$itemUbicacion = 'id_ubicacion';
$valorUbicacion =$activos['ubicacion'];
$perfilUbicacion='usuario';
$ubicacion= ControladorTecnologia::ctrMostarUbicacion($itemUbicacion,$valorUbicacion,$perfilUbicacion);


$cadenaResponsable = "";

if($activos["id_responsable"] != null){
//OBTENER DATOS RESPONSABLE
$tablaResponsable = "usuarios";
$itemResponsable = "id_usuario";
$valorResponsable = $activos["id_responsable"];

$responsable = ControladorTecnologia::ctrObternerDatoRequerido($tablaResponsable, $itemResponsable, $valorResponsable);

$cadenaResponsable = $responsable["nombres"] . " " . $responsable["apellidos"];

}else{

$cadenaResponsable = "No tiene Responsable Asignado el Activo.";

}


require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

// add a page (left page)
$pdf->AddPage();

$pdf->Image('../../vistas/img/plantilla/Logo_AGS.jpg', 20, 12, 20, '', '', '', '', false, 100);

//$pdf->Image('../../vistas/img/plantilla/Logo_AGS.jpg', 160, 257,40, '', '', '', '', false, 100);

date_default_timezone_set('America/Bogota');  

$fecha_actual=date("Y-m-d");

$hora=date('h:i a');

$entrega ='AREA DE SISTEMAS';

$bloque1 = <<<EOF

    <table style="padding: 5px; text-align: center;">

        <thead>
        
            <tr>
                <td style="border: 1px solid #666; background-color:white; width:130px; height:40px;"></td>
                <td style="border: 1px solid #666; background-color:#BCBCBC;text-align:center; width:410px;" colspan="2"><b>ENTREGA DE EQUIPOS</b></td>
            </tr>

        </thead>

    </table>
EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

$bloque2 = <<<EOF
<br>
<br>
<table style="padding: 5px; text-align: center;">

    <thead>
        <tr>
            <th colspan="4" style="border: 1px solid #666; background-color:#BCBCBC; text-align:center; width:540px;"><b>DATOS DEL COLABORADOR</b></th>
            
        </tr>
    </thead>
    
    <tbody>

        <tr>

            <td style="border: 1px solid #666; background-color:#BCBCBC; width:160px;">Nombre Usuario</td>
            <td style="border: 1px solid #666; background-color:white;text-align:center; width:380px;"></td>
           
        </tr>
         <tr>

            <td style="border: 1px solid #666; background-color:#BCBCBC; width:160px;">Ubicación</td>
            <td style="border: 1px solid #666; background-color:white;text-align:center; width:380px;">$ubicacion[ubicacion]</td>
           
        </tr>
         <tr>

            <td style="border: 1px solid #666; background-color:#BCBCBC; width:160px;">Área/Proyecto</td>
            <td style="border: 1px solid #666; background-color:white;text-align:center; width:380px;">$proyecto[proyecto]</td>
           
        </tr>
        <tr>

            <td style="border: 1px solid #666; background-color:#BCBCBC; width:160px;">Número Puesto</td>
            <td style="border: 1px solid #666; background-color:white;text-align:center; width:380px;">$activos[numero_puesto]</td>
           
        </tr>
         <tr>

            <td style="border: 1px solid #666; background-color:#BCBCBC; width:160px;">Fecha Entrega</td>
            <td style="border: 1px solid #666; background-color:white;text-align:center; width:380px;">$fecha_actual</td>
           
        </tr>   

    </tbody>


</table>


EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

$bloque3 = <<<EOF
<br>
<br>
<table style="padding: 5px; text-align: center;">

    <thead>
        <tr>
            <th colspan="4" style="border: 1px solid #666; background-color:#BCBCBC; text-align:center; width:540px;"><b>DATOS DEL EQUIPO</b></th>
            
        </tr>
    </thead>
    
    <tbody>

        <tr>

            <td style="border: 1px solid #666; background-color:#BCBCBC; width:135px;">Número Placa</td>
            <td style="border: 1px solid #666; background-color:white;text-align:center; width:135px;">$activos[numero_placa]</td>
            <td style="border: 1px solid #666; background-color:#BCBCBC; width:135px;">Número Serial</td>
            <td style="border: 1px solid #666; background-color:white;text-align:center; width:135px;">$activos[serial]</td>
           
        </tr>
        
        <tr>

            <td style="border: 1px solid #666; background-color:#BCBCBC; width:135px;">Estado Activo</td>
            <td style="border: 1px solid #666; background-color:white;text-align:center; width:135px;">$activos[estado_activo]</td>
            <td style="border: 1px solid #666; background-color:#BCBCBC; width:135px;">Marca</td>
            <td style="border: 1px solid #666; background-color:white;text-align:center; width:135px;">$activos[marca]</td>
           
           
        </tr>
        
        <tr>

            <td style="border: 1px solid #666; background-color:#BCBCBC; width:270px;" colspan="2">Categoría</td>
            <td style="border: 1px solid #666; background-color:white;text-align:center; width:270px;" colspan="2">$categoria[categoria]</td>
           
           
        </tr>

    </tbody>


</table>


EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');

$bloque5 = <<<EOF
    <table>

        <tr>

            <td style="width:540px"></td>

        </tr>

    </table>

    <table style="font-size:10px; padding:5px 10px;">
        <tr>

            <td style="border: 1px solid #666; background-color:white; width:540px"><strong>Certifico que los elementos detallados en el presente documento me han sido entregados para mi cuidado y custodia con el propósito cumplir con las tareas y asignaciones propias de mi cargo en AGS, siendo estos de mi única y exclusiva responsabilidad. Me comprometo a usar correctamente los recursos, y solo para los fines establecidos, a no instalar ni permitir la instalación de software por personal ajeno al grupo interno de trabajo de soporte de TI ,Todos los daños causados a la hora de devolver el equipo se tomaran por parte de la persona que firmo este documento.</strong> </td>                      

        </tr>

    </table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');
$bloque6 = <<<EOF
<br>
<br>
<table style="padding: 5px;">

    <thead>
        <tr>
            <th colspan="4" style="border: 1px solid #666; background-color:#BCBCBC; text-align:center; width:540px;"><b>ENTREGA DE EQUIPO</b></th>
            
        </tr>
    </thead>
    
    <tbody>

        <tr>

            <td style="border: 1px solid #666; background-color:#BCBCBC;text-align:center; width:270px;">RECIBE</td>
            <td style="border: 1px solid #666; background-color:#BCBCBC;text-align:center; width:270px;">ENTREGA</td>
        
           
        </tr>
         <tr>

            <td style="border: 1px solid #666; background-color:white; width:270px;">Nombre:</td>
            <td style="border: 1px solid #666; background-color:white; width:270px;">Nombre:</td>
           
           
           
        </tr>
         <tr>

            <td style="border: 1px solid #666; background-color:white; width:270px;">Firma:</td>
            <td style="border: 1px solid #666; background-color:white; width:270px;">Firma:</td>
           
           
           
        </tr>
           <tr>

            <td style="border: 1px solid #666; background-color:white; width:270px;">Fecha: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  $fecha_actual</td>
           
            <td style="border: 1px solid #666; background-color:white; width:270px;">Fecha: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  $fecha_actual</td>
        
           
           
        </tr>
               
    </tbody>


</table>


EOF;
$pdf->writeHTML($bloque6, false, false, false, false, '');
$bloque7 = <<<EOF
<br>
<br>
<table style="padding: 5px;">

    <thead>
        <tr>
            <th colspan="4" style="border: 1px solid #666; background-color:#BCBCBC; text-align:center; width:540px;"><b>DEVOLUCION DE EQUIPO</b></th>
            
        </tr>
    </thead>
    
    <tbody>

        <tr>

            <td style="border: 1px solid #666; background-color:#BCBCBC;text-align:center; width:270px;">RECIBE</td>
            <td style="border: 1px solid #666; background-color:#BCBCBC;text-align:center; width:270px;">ENTREGA</td>
        
           
        </tr>
         <tr>

            <td style="border: 1px solid #666; background-color:white; width:270px;">Nombre:</td>
            <td style="border: 1px solid #666; background-color:white; width:270px;">Nombre:</td>
           
           
           
        </tr>
         <tr>

            <td style="border: 1px solid #666; background-color:white; width:270px;">Firma:</td>
            <td style="border: 1px solid #666; background-color:white; width:270px;">Firma:</td>
           
           
           
        </tr>
           <tr>

            <td style="border: 1px solid #666; background-color:white; width:270px;">Fecha:</td>
            <td style="border: 1px solid #666; background-color:white; width:270px;">Fecha:</td>
        
           
           
        </tr>
               
    </tbody>


</table>


EOF;
$pdf->writeHTML($bloque7, false, false, false, false, '');

/*========================
SALIDA DEL ARCHIVO
========================*/
$pdf->Output('PlacaEquipo ='.$activos["numero_placa"].'.pdf');

//============================================================+
// END OF FILE
//============================================================+
}
}

$factura = new ImprimirPdfEntregaEquipo();
$factura -> id = $_GET["id"];
$factura -> traerImpresionPdfEntragaEquipo();