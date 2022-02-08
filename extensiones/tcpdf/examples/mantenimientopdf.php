<?php

require("../../fpdf/fpdf.php");
require("../../Equipos.php");

class PDF extends FPDF
{
	var $widths;
	var $aligns;

	function SetWidths($w)
	{

		$this->widths=$w;
	}

	function SetAligns($a)
	{

		$this->aligns=$a;
	}

	function Row($data)
	{

		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=8*$nb;

		$this->CheckPageBreak($h);

		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';

			$x=$this->GetX();
			$y=$this->GetY();


			$this->Rect($x,$y,$w,$h);

			$this->MultiCell($w,8,$data[$i],0,$a,'true');

			$this->SetXY($x+$w,$y);
		}

		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{

		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function NbLines($w,$txt)
	{

		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}

	function Header()
	{
		// Logo
    $this->Image('../../vistas/img/plantilla/Logo_AGS.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(50);
    // Título
    $this->Cell(100,10,'FORMATO MANTENIMIENTO DE EQUIPOS ',0,0,'C');
    // Salto de línea
    $this->Ln(20);
		$this->SetFont('Arial','',14);
		
		$this->Ln(10);
	}

	function Footer()
	{
			// Logo
		$this->Image('../../vistas/img/plantilla/Logo_AGS.png',10,280,33);
		$this->SetY(-15);
		$this->SetFont('Arial','B',10);
		$this->Cell(50);
		$this->Cell(100,10,'FORMATO MANTENIMIENTO DE EQUIPOS ',0,0,'C');

	}

}
$fecha_Actual = date("d-m-Y");
// Obtenemos el id del equipo

if(isset($_POST['responsable'])){$nombreUsuario= $_POST['responsable'];}
else{$nombreUsuario = null;}
if(isset($_POST['usuario'])){$entrega= $_POST['usuario'];}else{$entrega = null;}
if(isset($_POST['numero_placa'])){$area= $_POST['numero_placa'];}else{$area = null;}
if(isset($_POST['proyecto'])){$proyecto= $_POST['proyecto'];}else{$proyecto = null;}
if(isset($_POST['editarIdActivos'])){$editarIdActivos= $_POST['editarIdActivos'];}
else{$editarIdActivos = null;}


if(isset($_POST['mouse']) ){$mouse = "X";}else{$mouse = NULL;}
if(isset($_POST['morral']) ){$morral = "X";}else{$morral = NULL; }
if(isset($_POST['teclado']) ){$teclado = "X";}else{$teclado = NULL;}
if(isset($_POST['lapiz']) ){$lapiz = "X";}else{$lapiz = NULL;}
if(isset($_POST['borrador']) ){$borrador = "X";}else{$borrador = NULL;}
if(isset($_POST['pencil']) ){$pencil = "X";}else{$pencil = NULL;}
if(isset($_POST['cable']) ){$cable = "X";}else{$cable = NULL;}
if(isset($_POST['conexion']) ){$conexion = "X";}else{$conexion = NULL;}
if(isset($_POST['software']) ){$software = "X";}else{$software = NULL;}
if(isset($_POST['disco']) ){$disco = "X";}else{$disco = NULL;}
if(isset($_POST['otro'])&& !empty($_POST['otro']) ){$otro = $_POST['otro'];}else{$otro = NULL;}
//$equipo_id = $_POST['serial'];
// Creamos nuestro objeto equipo
$objequipo = new Equipos();
// obtenemos los datos del equipo por el id
$equipo = $objequipo->get_equipo_byid($editarIdActivos);
//var_dump($equipo);
// obtenemos los datos del equipo por el id
// Creamos nuestro objeto pdf
$pdf = new Pdf();
// Agregamos una pagina al archivo
$pdf->AddPage();
// Personalizamos los margenes
$pdf->SetMargins(20,20,20);
// Creamos un espacio
$pdf->Ln(10);
// Definimos la fuente y tamaño
$pdf->SetFont('Arial','B',12);
// Creamos una celda para mostrar la información
//$pdf->SetWidths(array(190));
$pdf->SetFont('Arial','B',10);

$pdf->SetTextColor(0);
//$this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $pdf->Cell(40);
    // Título
	$pdf->SetFillColor(234,234,234);
    $pdf->Cell(100,10,'DATOS DEL EQUIPO',0,0,'C');
$pdf->Ln(10);

$pdf->Row(array('DATOS DEL EQUIPO'));
$pdf->SetWidths(array(40, 50, 50, 50,10));
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(231,231,231);
$pdf->SetTextColor(0);
$pdf->Row(array('PLACA AGS', 'RESPONSABLE', 'CLASIFICACION', 'MARCA',''));
$pdf->SetWidths(array(40, 50, 50, 50,10));
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);
$pdf->Row(array($equipo['numero_placa'], $equipo['responsable'], 
$equipo['clasificacion'], $equipo['marca'],''));
$pdf->SetWidths(array(30, 45, 20, 40,55));
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(231,231,231);
$pdf->SetTextColor(0);
$pdf->Row(array('PUESTO', 'SERIAL', 'CLASE', 'PROYECTO','UBICACION'));
$pdf->SetWidths(array(30, 45, 20, 40,55));
$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);
$pdf->Row(array($equipo['numero_puesto'], $equipo['serial'], $equipo['categoria'],$equipo['proyecto'],$equipo['ubicacion']));
	$pdf->SetWidths(array(190));
	$pdf->SetFont('Arial','B',10);
	$pdf->SetFillColor(231,231,231);
	$pdf->SetTextColor(0);
	$pdf->Row(array('ESPECIFICACION'));
	$pdf->SetWidths(array(50, 50, 50, 50, 40));
	$pdf->SetFont('Arial','B',10);
	$pdf->SetFillColor(231,231,231);
	$pdf->SetTextColor(0);
	$pdf->Row(array('OBSERVACIONES', 'PUNTO DE RED' , 'ESTADO DEL ACTIVO'));

//($pantalla_id != null) ? $pantalla['marca'] : 'N/A';

$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);
$pdf->Row(array($equipo['observaciones'],$equipo['punto_red'],$equipo['estado_activo']));
$pdf->SetWidths(array(190));
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(231,231,231);
$pdf->SetTextColor(0);
$pdf->Row(array('MANTENIMIENTOS A REALIZAR'));
$pdf->SetWidths(array(50, 50, 50, 40,10));
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(231,231,231);
$pdf->SetTextColor(0);
$pdf->Row(array('Creacion de punto de restauracion', 'Eliminacion de archivos temporales', 'Limpieza de pantallas','Limpieza de pantallas','Limpieza de perifericos','Analisis profundo de antivirus', 'Liberacion de espacio en disco duro','Verificacion de conexiones','Eliminacion de cookies','Actualizacion manual de antivirus','Eliminacion de virus spyware y malware y posibles amenazas','OBSERVACIONES',''));
$pdf->SetWidths(array(50, 50, 50, 40, 50));
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);
$pdf->Row(array($mouse , $teclado , $morral ,$lapiz , $borrador ,$pencil ,$cable ,$conexion ,$software , $disco ,$otro));
$pdf->SetWidths(array(190));
/*$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(231,231,231);
$pdf->SetTextColor(0);
$pdf->Row(array(''));

$pdf->SetWidths(array(190));
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(234,234,234);
$pdf->SetTextColor(0);
$pdf->Row(array('DATOS'));

$pdf->SetWidths(array(100,100));
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(231,231,231);
$pdf->SetTextColor(0);
$pdf->Row(array('UBICACION'));

$pdf->SetWidths(array(100,100));
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);
$pdf->Row(array($equipo['ubicacion']));*/

$pdf->SetWidths(array(190));
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(231,231,231);
$pdf->SetTextColor(0);
$pdf->Row(array('ENTREGA'));
$pdf->SetWidths(array(190));
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(231,231,231);
$pdf->SetTextColor(0);
$pdf->Row(array('FECHA DE ENTREGA'));
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);
$pdf->Row(array($fecha_Actual));
$pdf->SetWidths(array(100,100));
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(231,231,231);
$pdf->SetTextColor(0);
$pdf->Row(array('RECIBE:','ENTREGA:'));
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);
$pdf->Row(array($entrega , $entrega));
$pdf->SetWidths(array(100,100));
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(231,231,231);
$pdf->SetTextColor(0);
$pdf->Row(array('FIRMA:','FIRMA:'));
$pdf->SetWidths(array(100,100));
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);
$pdf->Row(array(' ','' ));
$pdf->SetWidths(array(190));
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(231,231,231);
$pdf->SetTextColor(0);
//$pdf->Row(array(utf8_decode('Certifico que los elementos detallados en el presente documento, me han sido entregados para mi cuidado y custodia con el propósito de cumplir con las tareas y asignaciones propias de mi cargo en AGS, siendo estos de mi única y exclusiva responsabilidad. Me comprometo a usar correctamente los recursos, y solo para los fines establecidos, a no instalar ni permitir la instalación de software por personal ajeno al grupo interno de trabajo de soporte de TI.')));
$pdf->SetWidths(array(190));
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);
$pdf->Row(array('' ));
$pdf->SetWidths(array(190));
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);
$pdf->Row(array('FIRMA'));


$i = 0;
// listamos las consultas
$n=0;

// Salida del archivo y nombre

// PONER EL NOMBRE DEL ARCHIVO PARA PODER TRAER LOS DATOS EN EL PDF;

$Archivo = "mantenimientopdf/".$equipo['numero_placa'].".pdf";

//$Archivo = header("Location : http:/localhost/INVENTARIO/vistas/modulos/REPORTEpdf/
	//".$equipo['numero_placa'].".pdf");
 
//var_dump($nombreArchivo);
$pdf->Output($Archivo,'F');

$Archivo = "vistas/modulos/".$Archivo; 

?>
<div class="alert alert-success" role="alert">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong></strong>
	<span class="text text-center"><a href="<?php  echo $Archivo; ?>" class="btn btn-info text-center" target="_blank"><i class="glyphicon glyphicon-print"></i> Imprimir </a></span>
</div>
				  
				 