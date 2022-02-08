<?php

require_once('tcpdf_include.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		// Logo
		$this->SetFont('helveticaBI', '', 8);
		// Title
		// set some text to print
		$txt = <<<EOD
		<table>

			<tr>

				<td align="center" style="width:150px"> &nbsp;<br/><img src="images/bomberosleft.jpg" alt="" width="50" height="50"></td>
				<td valign="center" align="left" style="width:330px; font-size: 90%" >
				REPUBLICA DE COLOMBIA<br/>
				Benemérito Cuerpo de Bomberos Voluntarios de La Tebaida<br/>
				Departamento del Quindio<br/>
				Nit. 890.000.590-3 <br/>
				Entidad Privada sin ánimo de Lucro <br/>
				</td>
				<td style="width:150px" align="center">&nbsp;<img src="images/autopistas.jpeg" alt="" ></td>

			</tr>

		</table>
		EOD;

		// print a block of text using Write()
		$this->writeHTML($txt,false,false,false,false,'');
		
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Impreso por SIA fecha y hora de impresion', 0, false, 'L', 0, '', 0, false, 'T', 'M');
		$this->Cell(0, 10, 'Pagina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ingens Solutions SAS');
$pdf->SetTitle('AtencionPH PDF');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

// set some text to print

$txt = <<<EOD

		<table>

			<tr>
				<td valign="center" align="center" style="width:480px; font-size: 150% ; color:red ; font-weight:bold" >
				FORMULARIO DE ATENCION DE EVENTOS
				</td>
				<td border ="1" valign="center" align="center" style="width:150px; font-size: 90%" >
				<b>RADICADO:</b> 999999999
				</td>
			</tr>
			<tr>
				<td border="1" valign="center" align="center" style="width:50px; font-size: 70%" >
				FECHA
				</td>
				<td border="1" valign="center" align="center" style="width:70px; font-size: 70%" >
				HORA SALIDA
				</td>
				<td border="1" valign="center" align="center" style="width:70px; font-size: 70%" >
				HORA SITIO
				</td>
				<td border="1" valign="center" align="center" style="width:90px; font-size: 70%" >
				HORA REGRESO
				</td>
				<td border="1" valign="center" align="center" style="width:70px; font-size: 70%" >
				KM INICIAL
				</td>
				<td border="1" valign="center" align="center" style="width:70px; font-size: 70%" >
				KM EVENTO
				</td>
				<td border="1" valign="center" align="center" style="width:70px; font-size: 70%" >
				KM FINAL
				</td>
				<td border="1" valign="center" align="center" style="width:70px; font-size: 70%" >
				VEHICULO
				</td>
				<td border="1" valign="center" align="center" style="width:70px; font-size: 70%" >
				PLACA
				</td>
			</tr>
			<tr>
				<td border="1" valign="center" align="center" style="width:50px; font-size: 70%" >
				10-11-1989
				</td>
				<td border="1" valign="center" align="center" style="width:70px; font-size: 70%" >
				00:05
				</td>
				<td border="1" valign="center" align="center" style="width:70px; font-size: 70%" >
				1:00
				</td>
				<td border="1" valign="center" align="center" style="width:90px; font-size: 70%" >
				1:30
				</td>
				<td border="1" valign="center" align="center" style="width:70px; font-size: 70%" >
				999999
				</td>
				<td border="1" valign="center" align="center" style="width:70px; font-size: 70%" >
				999999
				</td>
				<td border="1" valign="center" align="center" style="width:70px; font-size: 70%" >
				999999
				</td>
				<td border="1" valign="center" align="center" style="width:70px; font-size: 70%" >
				AM
				</td>
				<td border="1" valign="center" align="center" style="width:70px; font-size: 70%" >
				BDS234
				</td>
			</tr>
			<tr>
				<td border="1" valign="center" style="width:460px; font-size: 70%" >
				<b> EVENTO:</b> CHOQUE ENTRE DOS CAMIONES 
				</td>
				<td border="1" valign="center" style="width:170px; font-size: 70%" >
				<b> KILOMETRO:</b> 123113
				</td>				
			</tr>
			<tr>
				<td border="1" valign="center" style="width:350px; font-size: 70%" >
				<b> SITIO DEL EVENTO:</b> CURVA GRANDE EN LA VIA A LA COSTA 
				</td>
				<td border="1" valign="center" style="width:280px; font-size: 70%" >
				<b> PUNTO DE REFERENCIA:</b> ENFRENTE DE LA TIENDA DE LA TIA MARTHA
				</td>				
			</tr>







		</table>

		EOD;

		// print a block of text using Write()
$pdf->writeHTML($txt,false,false,false,false,'');
$pdf->Ln(2);
$txt = <<<EOD
		
		<table>
			<tr>
				<td border="1" valign="center" align="center" style="width:630px; font-size: 80% ; font-weight:bold ; background-color:#F35959" >
				INFORMACION DEL VEHICULO
				</td>				
			</tr>
			
			<tr>
				<td border="1" valign="center" align="center" style="width:150px; font-size: 70% ; font-weight:bold" >
				TIPO
				</td>
				<td border="1" valign="center" align="center" style="width:150px; font-size: 70%" >
				CAMION
				</td>
				<td border="1" valign="center" align="center" style="width:120px; font-size: 70% ; font-weight:bold" >
				CONDUCTOR
				</td>
				<td border="1" valign="center" align="center" style="width:210px; font-size: 70%" >
				NICOLAS JOAQUIN VANEGAS MUÑOZ
				</td>

			</tr>

			<tr>
				<td border="1" valign="center" align="center" style="width:150px; font-size: 70% ; font-weight:bold" >
				MARCA
				</td>
				<td border="1" valign="center" align="center" style="width:150px; font-size: 70%" >
				VOLKSWAGEN
				</td>
				<td border="1" valign="center" align="center" style="width:120px; font-size: 70% ; font-weight:bold" >
				DOCUMENTO
				</td>
				<td border="1" valign="center" align="center" style="width:210px; font-size: 70%" >
				CC - 1075239682
				</td>

			</tr>
			<tr>
				<td border="1" valign="center" align="center" style="width:150px; font-size: 70% ; font-weight:bold" >
				MODELO
				</td>
				<td border="1" valign="center" align="center" style="width:150px; font-size: 70%" >
				2021
				</td>
				<td border="1" valign="center" align="center" style="width:50px; font-size: 70% ; font-weight:bold" >
				EDAD
				</td>
				<td border="1" valign="center" align="center" style="width:70px; font-size: 70%" >
				31 AÑOS
				</td>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70% ; font-weight:bold" >
				TELEFONO
				</td>
				<td border="1" valign="center" align="center" style="width:110px; font-size: 70%" >
				3057041749
				</td>

			</tr>
			<tr>
				<td border="1" valign="center" align="center" style="width:150px; font-size: 70% ; font-weight:bold" >
				COLOR
				</td>
				<td border="1" valign="center" align="center" style="width:150px; font-size: 70%" >
				ROJO FERRARI
				</td>
				<td border="1" valign="center" align="center" style="width:120px; font-size: 70% ; font-weight:bold" >
				DIRECCION
				</td>
				<td border="1" valign="center" align="center" style="width:210px; font-size: 70%" >
				CRA 21 # 127D-63 APTO 101
				</td>

			</tr>
			<tr>
				<td border="1" valign="center" align="center" style="width:150px; font-size: 70% ; font-weight:bold" >
				PLACA
				</td>
				<td border="1" valign="center" align="center" style="width:150px; font-size: 70%" >
				DBL341
				</td>
				<td border="1" valign="center" align="center" style="width:120px; font-size: 70% ; font-weight:bold" >
				REMOLQUE
				</td>
				<td border="1" valign="center" align="center" style="width:210px; font-size: 70%" >
				J343242H
				</td>

			</tr>
			<tr>
				<td border="1" valign="center" align="center" style="width:150px; font-size: 70% ; font-weight:bold" >
				No. INTERNO
				</td>
				<td border="1" valign="center" align="center" style="width:150px; font-size: 70%" >
				1234567
				</td>
				<td border="1" valign="center" align="center" style="width:120px; font-size: 70% ; font-weight:bold" >
				RUTA
				</td>
				<td border="1" valign="center" align="center" style="width:210px; font-size: 70%" >
				BOGOTA - CALI - BOGOTA
				</td>

			</tr>

			<tr>
				<td border="1" valign="center" align="center" style="width:150px; font-size: 70% ; font-weight:bold" >
				PRESENTA
				</td>
				<td border="1" valign="center" align="center" style="width:480px; font-size: 70%" >
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquam scelerisque commodo. Suspendisse id lorem aliquam, efficitur lacus ac, semper risus. Duis rutrum nisl id scelerisque varius. Sed vel arcu posuere, feugiat metus sit amet, iaculis sapien. Sed orci mauris, scelerisque a mollis quis, fringilla sit amet velit. Vivamus eget.
				</td>

			</tr>
			<tr>
				<td border="1" valign="center" align="center" style="width:80px; font-size: 70% ; font-weight:bold" >
				TRASLADO
				</td>
				<td border="1" valign="center" align="center" style="width:30px; font-size: 70%" >
				SI
				</td>
				<td border="1" valign="center" align="center" style="width:120px; font-size: 70% ; font-weight:bold" >
				DESTINO
				</td>
				<td border="1" valign="center" align="center" style="width:400px; font-size: 70%" >
				CLINICA DE FRACTURAS EN LA CIUDAD DE BOGOTA CALLE 123 HUS 3423
				</td>

			</tr>

			

	

		</table>


		EOD;

		// print a block of text using Write()
$pdf->writeHTML($txt,false,false,false,false,'');
$pdf->Ln(2);
$txt = <<<EOD
		
		<table>
			<tr>
				<td border="1" valign="center" align="center" style="width:630px; font-size: 80% ; font-weight:bold ; background-color:#F35959" >
				ACOMPAÑANTE 1
				</td>				
			</tr>
			
			<tr>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70% ; font-weight:bold" >
				NOMBRE
				</td>
				<td border="1" valign="center" align="center" style="width:250px; font-size: 70%" >
				NICOLAS JOAQUIN VANEGAS MUÑOZ
				</td>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70% ; font-weight:bold" >
				DOCUMENTO
				</td>
				<td border="1" valign="center" align="center" style="width:180px; font-size: 70%" >
				CC - 1075239682
				</td>

			</tr>
			<tr>
				<td border="1" valign="center" align="center" style="width:50px; font-size: 70% ; font-weight:bold" >
				EDAD
				</td>
				<td border="1" valign="center" align="center" style="width:50px; font-size: 70%" >
				31 AÑOS
				</td>
				<td border="1" valign="center" align="center" style="width:80px; font-size: 70% ; font-weight:bold" >
				TELEFONO
				</td>
				<td border="1" valign="center" align="center" style="width:80px; font-size: 70%" >
				3057041749
				</td>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70% ; font-weight:bold" >
				DIRECCION
				</td>
				<td border="1" valign="center" align="center" style="width:270px; font-size: 70%" >
				CRA 21 # 127 D - 63 APTO 101
				</td>

			</tr>

			<tr>
				<td border="1" valign="center" align="center" style="width:150px; font-size: 70% ; font-weight:bold" >
				PRESENTA
				</td>
				<td border="1" valign="center" align="center" style="width:480px; font-size: 70%" >
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquam scelerisque commodo. Suspendisse id lorem aliquam, efficitur lacus ac, semper risus. Duis rutrum nisl id scelerisque varius. Sed vel arcu posuere, feugiat metus sit amet, iaculis sapien. Sed orci mauris, scelerisque a mollis quis, fringilla sit amet velit. Vivamus eget.
				</td>

			</tr>
			<tr>
				<td border="1" valign="center" align="center" style="width:80px; font-size: 70% ; font-weight:bold" >
				TRASLADO
				</td>
				<td border="1" valign="center" align="center" style="width:30px; font-size: 70%" >
				SI
				</td>
				<td border="1" valign="center" align="center" style="width:120px; font-size: 70% ; font-weight:bold" >
				DESTINO
				</td>
				<td border="1" valign="center" align="center" style="width:400px; font-size: 70%" >
				CLINICA DE FRACTURAS EN LA CIUDAD DE BOGOTA CALLE 123 HUS 3423
				</td>

			</tr>

			

	

		</table>

		<table>
			<tr>
				<td border="1" valign="center" align="center" style="width:630px; font-size: 80% ; font-weight:bold ; background-color:#F35959" >
				ACOMPAÑANTE 2
				</td>				
			</tr>
			
			<tr>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70% ; font-weight:bold" >
				NOMBRE
				</td>
				<td border="1" valign="center" align="center" style="width:250px; font-size: 70%" >
				NICOLAS JOAQUIN VANEGAS MUÑOZ
				</td>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70% ; font-weight:bold" >
				DOCUMENTO
				</td>
				<td border="1" valign="center" align="center" style="width:180px; font-size: 70%" >
				CC - 1075239682
				</td>

			</tr>
			<tr>
				<td border="1" valign="center" align="center" style="width:50px; font-size: 70% ; font-weight:bold" >
				EDAD
				</td>
				<td border="1" valign="center" align="center" style="width:50px; font-size: 70%" >
				31 AÑOS
				</td>
				<td border="1" valign="center" align="center" style="width:80px; font-size: 70% ; font-weight:bold" >
				TELEFONO
				</td>
				<td border="1" valign="center" align="center" style="width:80px; font-size: 70%" >
				3057041749
				</td>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70% ; font-weight:bold" >
				DIRECCION
				</td>
				<td border="1" valign="center" align="center" style="width:270px; font-size: 70%" >
				CRA 21 # 127 D - 63 APTO 101
				</td>

			</tr>

			<tr>
				<td border="1" valign="center" align="center" style="width:150px; font-size: 70% ; font-weight:bold" >
				PRESENTA
				</td>
				<td border="1" valign="center" align="center" style="width:480px; font-size: 70%" >
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquam scelerisque commodo. Suspendisse id lorem aliquam, efficitur lacus ac, semper risus. Duis rutrum nisl id scelerisque varius. Sed vel arcu posuere, feugiat metus sit amet, iaculis sapien. Sed orci mauris, scelerisque a mollis quis, fringilla sit amet velit. Vivamus eget.
				</td>

			</tr>
			<tr>
				<td border="1" valign="center" align="center" style="width:80px; font-size: 70% ; font-weight:bold" >
				TRASLADO
				</td>
				<td border="1" valign="center" align="center" style="width:30px; font-size: 70%" >
				SI
				</td>
				<td border="1" valign="center" align="center" style="width:120px; font-size: 70% ; font-weight:bold" >
				DESTINO
				</td>
				<td border="1" valign="center" align="center" style="width:400px; font-size: 70%" >
				CLINICA DE FRACTURAS EN LA CIUDAD DE BOGOTA CALLE 123 HUS 3423
				</td>

			</tr>

			

	

		</table>

		<table>
			<tr>
				<td border="1" valign="center" align="center" style="width:630px; font-size: 80% ; font-weight:bold ; background-color:#F35959" >
				ACOMPAÑANTE 3
				</td>				
			</tr>
			
			<tr>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70% ; font-weight:bold" >
				NOMBRE
				</td>
				<td border="1" valign="center" align="center" style="width:250px; font-size: 70%" >
				NICOLAS JOAQUIN VANEGAS MUÑOZ
				</td>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70% ; font-weight:bold" >
				DOCUMENTO
				</td>
				<td border="1" valign="center" align="center" style="width:180px; font-size: 70%" >
				CC - 1075239682
				</td>

			</tr>
			<tr>
				<td border="1" valign="center" align="center" style="width:50px; font-size: 70% ; font-weight:bold" >
				EDAD
				</td>
				<td border="1" valign="center" align="center" style="width:50px; font-size: 70%" >
				31 AÑOS
				</td>
				<td border="1" valign="center" align="center" style="width:80px; font-size: 70% ; font-weight:bold" >
				TELEFONO
				</td>
				<td border="1" valign="center" align="center" style="width:80px; font-size: 70%" >
				3057041749
				</td>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70% ; font-weight:bold" >
				DIRECCION
				</td>
				<td border="1" valign="center" align="center" style="width:270px; font-size: 70%" >
				CRA 21 # 127 D - 63 APTO 101
				</td>

			</tr>

			<tr>
				<td border="1" valign="center" align="center" style="width:150px; font-size: 70% ; font-weight:bold" >
				PRESENTA
				</td>
				<td border="1" valign="center" align="center" style="width:480px; font-size: 70%" >
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquam scelerisque commodo. Suspendisse id lorem aliquam, efficitur lacus ac, semper risus. Duis rutrum nisl id scelerisque varius. Sed vel arcu posuere, feugiat metus sit amet, iaculis sapien. Sed orci mauris, scelerisque a mollis quis, fringilla sit amet velit. Vivamus eget.
				</td>

			</tr>
			<tr>
				<td border="1" valign="center" align="center" style="width:80px; font-size: 70% ; font-weight:bold" >
				TRASLADO
				</td>
				<td border="1" valign="center" align="center" style="width:30px; font-size: 70%" >
				SI
				</td>
				<td border="1" valign="center" align="center" style="width:120px; font-size: 70% ; font-weight:bold" >
				DESTINO
				</td>
				<td border="1" valign="center" align="center" style="width:400px; font-size: 70%" >
				CLINICA DE FRACTURAS EN LA CIUDAD DE BOGOTA CALLE 123 HUS 3423
				</td>

			</tr>

			

	

		</table>

		<table>
			<tr>
				<td border="1" valign="center" align="center" style="width:630px; font-size: 80% ; font-weight:bold ; background-color:#F35959" >
				ACOMPAÑANTE 4
				</td>				
			</tr>
			
			<tr>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70% ; font-weight:bold" >
				NOMBRE
				</td>
				<td border="1" valign="center" align="center" style="width:250px; font-size: 70%" >
				NICOLAS JOAQUIN VANEGAS MUÑOZ
				</td>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70% ; font-weight:bold" >
				DOCUMENTO
				</td>
				<td border="1" valign="center" align="center" style="width:180px; font-size: 70%" >
				CC - 1075239682
				</td>

			</tr>
			<tr>
				<td border="1" valign="center" align="center" style="width:50px; font-size: 70% ; font-weight:bold" >
				EDAD
				</td>
				<td border="1" valign="center" align="center" style="width:50px; font-size: 70%" >
				31 AÑOS
				</td>
				<td border="1" valign="center" align="center" style="width:80px; font-size: 70% ; font-weight:bold" >
				TELEFONO
				</td>
				<td border="1" valign="center" align="center" style="width:80px; font-size: 70%" >
				3057041749
				</td>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70% ; font-weight:bold" >
				DIRECCION
				</td>
				<td border="1" valign="center" align="center" style="width:270px; font-size: 70%" >
				CRA 21 # 127 D - 63 APTO 101
				</td>

			</tr>

			<tr>
				<td border="1" valign="center" align="center" style="width:150px; font-size: 70% ; font-weight:bold" >
				PRESENTA
				</td>
				<td border="1" valign="center" align="center" style="width:480px; font-size: 70%" >
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquam scelerisque commodo. Suspendisse id lorem aliquam, efficitur lacus ac, semper risus. Duis rutrum nisl id scelerisque varius. Sed vel arcu posuere, feugiat metus sit amet, iaculis sapien. Sed orci mauris, scelerisque a mollis quis, fringilla sit amet velit. Vivamus eget.
				</td>

			</tr>
			<tr>
				<td border="1" valign="center" align="center" style="width:80px; font-size: 70% ; font-weight:bold" >
				TRASLADO
				</td>
				<td border="1" valign="center" align="center" style="width:30px; font-size: 70%" >
				SI
				</td>
				<td border="1" valign="center" align="center" style="width:120px; font-size: 70% ; font-weight:bold" >
				DESTINO
				</td>
				<td border="1" valign="center" align="center" style="width:400px; font-size: 70%" >
				CLINICA DE FRACTURAS EN LA CIUDAD DE BOGOTA CALLE 123 HUS 3423
				</td>

			</tr>

			

	

		</table>




		EOD;

		// print a block of text using Write()
$pdf->writeHTML($txt,false,false,false,false,'');
$pdf->Ln(2);
$txt = <<<EOD
		
		<table>
			<tr>
				<td border="1" valign="center" align="center" style="width:630px; font-size: 80% ; font-weight:bold ; background-color:#F35959" >
				INFORMACION ADICIONAL
				</td>				
			</tr>
			
			<tr>
				<td border="1" valign="center" align="center" style="width:150px; font-size: 70% ; font-weight:bold" >
				FUNCIONARIO QUE REPORTA
				</td>
				<td border="1" valign="center" align="center" style="width:480px; font-size: 70%" >
				NICOLAS JOAQUIN VANEGAS MUÑOZ
				</td>
				
			</tr>

			<tr>
				<td border="1" valign="center" align="center" style="width:150px; font-size: 70% ; font-weight:bold" >
				INSPECTOR VIAL
				</td>
				<td border="1" valign="center" align="center" style="width:480px; font-size: 70%" >
				NICOLAS JOAQUIN VANEGAS MUÑOZ
				</td>
				

			</tr>
			<tr>
				<td border="1" valign="center" align="center" style="width:150px; font-size: 70% ; font-weight:bold" >
				HOSPITAL QUE RECIBE
				</td>
				<td border="1" valign="center" align="center" style="width:480px; font-size: 70%" >
				HOSPITAL DE FRACTURAS DE BOGOTA VIA A LA COSTA
				</td>

			</tr>
			<tr>
				<td border="1" valign="center" align="center" style="width:150px; font-size: 70% ; font-weight:bold" >
				CONDUCTOR
				</td>
				<td border="1" valign="center" align="center" style="width:200px; font-size: 70%" >
				NICOLAS JOAQUIN VANEGAS MUÑOZ
				</td>
				<td border="1" valign="center" align="center" style="width:80px; font-size: 70% ; font-weight:bold" >
				TRIPULANTE
				</td>
				<td border="1" valign="center" align="center" style="width:200px; font-size: 70%" >
				NICOLAS JOAQUIN VANEGAS MUÑOZ
				</td>

			</tr>
		</table>


		EOD;

		// print a block of text using Write()
$pdf->writeHTML($txt,false,false,false,false,'');

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('atencionphPDF.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
