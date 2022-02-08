<?php	 
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//Codigo para traer los datos
$fecha_actual=date("Y-m-d H:i:s");

//Traer el id especifico 

if(isset($_POST['responsable'])){$nombreUsuario= $_POST['responsable'];}else{$nombreUsuario = null;}
if(isset($_POST['usuario'])){$entrega= $_POST['usuario'];}else{$entrega = null;}
if(isset($_POST['numero_placa'])){$area= $_POST['numero_placa'];}else{$area = null;}
if(isset($_POST['proyecto'])){$proyecto= $_POST['proyecto'];}else{$proyecto = null;}
if(isset($_POST['editarIdActivos'])){$editarIdActivos= $_POST['editarIdActivos'];}else{$editarIdActivos = null;}

if(isset($_POST['mouse']) ){$mouse = "X";}else{$mouse = NULL;}
if(isset($_POST['morral']) ){$morral = "X";}else{$morral = NULL; }
if(isset($_POST['teclado']) ){$teclado = "X";}else{$teclado = NULL;}
if(isset($_POST['otro'])&& !empty($_POST['otro']) ){$otro = $_POST['otro'];}else{$otro = NULL;}

//error al cargar el objeto

/*
//Creamos el objeto 
$objequipo =new Equipos();
//Traemos los datos por el id 
$equipo =$objequipo->get_equipo_byid($editarIdActivos);
*/

// add a page
$pdf->AddPage();

//IMAGEN 
//$img='<td align="center" style="width:150px">&nbsp;<br/><img src="Logo_AGS.png" alt="" width="50" height="50"></td>';

$pdf->Image('Logo_AGS.png', 10, 0, 40, '', '', '', '', false, 100);

$pdf->Image('Logo_AGS.png', 160, 257,40, '', '', '', '', false, 100);

// Pintar la tabla



// create some HTML content
$subtable = '<table border="1" cellspacing="6" cellpadding="4"><tr><td>a</td><td>b</td></tr><tr><td>c</td><td>d</td></tr></table>';

$html = '<h1 align="center">ENTREGA DE EQUIPOS </h1>
<table border="1" cellspacing="3" cellpadding="4">
    
    <tr>
        <th align="center" style="font-weight:bold" >PLACA</th>
        <th align="center" style="font-weight:bold" >RESPONSABLE</th>
        <th align="center" style="font-weight:bold">CLASIFICACION</th>
        <th align="center" style="font-weight:bold" >MARCA</th>
    </tr>
    <tr>
        <th align="center">1659</th>
        <th align="center">PEPITO PEREZ</th>
        <th align="center">EQUIPO DE COMPUTO</th>
        <th align="center">LENOVO</th>    
    </tr>
    <tr>
        <th align="center" style="font-weight:bold">PUESTO</th>
        <th align="center" style="font-weight:bold">SERIAL</th>
        <th align="center" style="font-weight:bold">TIPO</th>
        <th align="center" style="font-weight:bold">PROYECTO</th>  
    </tr>
    <tr>
        <th align="center">95</th>
        <th align="center">PKCAD123548</th>
        <th align="center">PC</th>
        <th align="center">SALUD TOTAL</th>  
    </tr>
    <tr> 
        <th align="center" style="font-weight:bold">UBICACION</th>
        <th align="center" style="font-weight:bold">OBSERVACIONES</th>
        <th align="center" style="font-weight:bold">PUNTO DE RED</th>
        <th align="center" style="font-weight:bold">ESTADO DEL ACTIVO</th>      
    </tr>
    <tr>
        <th align="center">SEDE 68</th>
        <th align="center">N/A</th>
        <th align="center">95</th>
        <th align="center">REGULAR</th>  
    </tr>
    <h3 align="center">PERIFERICOS ADICIONALES </h3>
    <tr>
        <th align="center" style="font-weight:bold">MOUSE</th>
        <th align="center" style="font-weight:bold">TECLADO</th> 
        <th align="center" style="font-weight:bold">MORRAL</th>
        <th align="center" style="font-weight:bold">OTRO</th>
    </tr>
    <tr>
        <th align="center">x</th>
        <th align="center">X</th>
        <th align="center">X</th>
        <th align="center">GUAYA</th>  
    </tr>
    <h3 align="center" >ENTREGA DE EQUIPO </h3>
    <tr>
        <th align="center" style="font-weight:bold">RECIBE </th>
        <th align="center" style="font-weight:bold">ENTREGA </th>
        <th align="center" style="font-weight:bold">FECHA DE ENTREGA :</th> 
    </tr>
    <tr>
        <th align="center">PEPITO PEREZ</th>
        <th align="center">SEBASTIAN CAMARGO</th>
        <th align="center">2021-31-08</th>    
    </tr> 
</table>';


// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
//$pdf->writeHTML($html1, true, false, true, false, '');

// Print some HTML Cells

$html = '<span align="center"> ¬ Certifico que los elementos detallados en el presente documento me han sido entregados para mi cuidado y custodia con el propósito cumplir con las tareas y asignaciones propias de mi cargo en AGS, siendo estos de mi única y exclusiva responsabilidad. Me comprometo a usar correctamente los recursos, y solo para los fines establecidos, a no instalar ni permitir la instalación de software por personal ajeno al grupo interno de trabajo de soporte de TI.</span>';

$pdf->SetFillColor(255,255,0);

$pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'L', true); 

//$pdf->writeHTMLCell(0, 0, '', '', $html1, 'LRTB', 1, 0, true, 'L', true); 

//TITULO
$pdf->Cell(0, 15, 'FIRMA DE QUIEN ENTREGA :', 1, 1, 'A', 0, '', 1);
$pdf->Cell(0, 15, 'FIRMA DE QUIEN RECIBE :', 1, 1, 'A', 0, '', 1);

// reset pointer to the last page
$pdf->lastPage();

//Close and output PDF document
$pdf->Output('ENTREGA_EQUIPOS', 'I');

//============================================================+
// END OF FILE
//============================================================+
