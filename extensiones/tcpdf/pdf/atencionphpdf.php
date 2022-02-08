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
		<table border="1">

			<tr>

				<td align="center" style="width:150px"> &nbsp;<br/><img src="images/bomberosleft.jpg" alt="" width="50" height="50"></td>
				<td valign="center" align="center" style="width:330px; font-size: 90%" >
				REPUBLICA DE COLOMBIA<br/>
				Benemérito Cuerpo de Bomberos Voluntarios de La Tebaida<br/>
				Departamento del Quindio<br/>
				Nit. 890.000.590-3 <br/>
				Entidad Privada sin ánimo de Lucro <br/>
				Código de Habilitación: SDSQ 6340101616-601-818
				</td>
				<td style="width:150px" align="center">&nbsp;<br/><img src="images/bomberosrigth.jpg" alt="" width="50" height="50"></td>

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

		<table border="1">
			<tr>
				<td valign="center" align="center" style="width:480px; font-size: 90% ; font-weight:bold" >
				HISTORIA CLÍNICA DE ANTENCIÓN PREHOSPITALARIA
				</td>
				<td valign="center" align="center" style="width:150px; font-size: 90%" >
				<b>NUAP:</b> 999.999.999
				</td>
			</tr>
			<tr>
				<td valign="center" align="center" style="width:480px; font-size: 90% ; font-weight:bold" >
				I. ANAMNESIS
				</td>
				<td valign="center" style="width:75px; font-size: 90% ; font-weight:bold"  >
				 PRIORIDAD:
				</td>
				<td valign="center" align="center" style="width:75px; font-size: 90%" >
				AMARILLO
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:480px; font-size: 90%" >
				<b> QUIEN INFORMA EL EVENTO:</b> NOOMBRE DE LA PERSONA QUE INFORMA
				</td>
				<td valign="center" style="width:150px; font-size: 90%" >
				<b> HORA SALIDA:</b> 01:59:00
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:480px; font-size: 90%" >
				<b> NOMBRE PACIENTE/VÍCTIMA:</b> NOOMBRES Y APELLIDOS DE LA VICTIMA
				</td>
				<td valign="center" style="width:150px; font-size: 90%" >
				<b> DOC:</b> CC - 10751239682
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:200px; font-size: 90%" >
				<b> FECHA NACIMIENTO:</b> 1989-11-10
				</td>
				<td valign="center" style="width:120px; font-size: 90%" >
				<b> EDAD:</b> 31 AÑOS
				</td>
				<td valign="center" style="width:160px; font-size: 90%" >
				<b> SEXO:</b> MASCULINO
				</td>
				<td valign="center" style="width:150px; font-size: 90%" >
				<b> ESTADO CIVIL:</b>
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:480px; font-size: 90%" >
				<b> DOMICILIO:</b> CRA 21 # 127D 63 APTO 101
				</td>
				<td valign="center" style="width:150px; font-size: 90%" >
				<b> TELEFONO:</b> 3057041749
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:200px; font-size: 90%" >
				<b> OCUPACION:</b> INDEPENDIENTE
				</td>
				<td valign="center" style="width:190px; font-size: 90%" >
				<b> EPS:</b> EPS SANITAS
				</td>
				<td valign="center" style="width:240px; font-size: 90%" >
				<b> ASEGURADOR:</b> ALLIANZ COLOMBIA
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:320px; font-size: 90%" >
				<b> ACOMPAÑANTE:</b> GAIA MARIA - 1075239682
				</td>
				<td valign="center" style="width:160px; font-size: 90%" >
				<b> PARENTESCO:</b> MASCOTA
				</td>
				<td valign="center" style="width:150px; font-size: 90%" >
				<b> TELEFONO:</b> 3057041749
				</td>
			</tr>

			<tr>
				<td valign="center" align="center" style="width:630px; font-size: 90% ; font-weight:bold" >
				II. MOTIVO DE ATENCIÓN
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:630px; font-size: 90%" >
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquam scelerisque commodo. Suspendisse id lorem aliquam, efficitur lacus ac, semper risus. Duis rutrum nisl id scelerisque varius. Sed vel arcu posuere, feugiat metus sit amet, iaculis sapien. Sed orci mauris, scelerisque a mollis quis, fringilla sit amet velit. Vivamus eget.
				</td>
				
			</tr>

			<tr>
				<td valign="center" align="center" style="width:630px; font-size: 90% ; font-weight:bold" >
				III. EXAMEN FÍSICO
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> F.C:</b> 40
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> F.R:</b> 10
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> T.A:</b> 11/199
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> SPO<sub>2</sub>:</b> 1
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> T<sup>o</sup>:</b> 20
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:126px; font-size: 90% ; font-weight:bold" >
				GLASGOW
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> RO:</b> 1
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> RV:</b> 2
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> RM:</b> 1
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> TOTAL:</b> 4
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:210px; font-size: 90% ; font-weight:bold" >
				 ALERGIAS
				</td>
				<td valign="center" style="width:210px; font-size: 90% ; font-weight:bold" >
				 PATOLOGIAS
				</td>
				<td valign="center" style="width:210px; font-size: 90% ; font-weight:bold" >
				 MEDICAMENTOS
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:210px; font-size: 90%" >
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquam scelerisque commodo. Suspendisse id lorem aliquam, efficitur lacus ac, semper risus. Duis rutrum nisl id scelerisque varius. Sed vel arcu posuere, feugiat metus sit amet, iaculis sapien. Sed orci mauris, scelerisque a mollis quis, fringilla sit amet velit. Vivamus eget.
				</td>
				<td valign="center" style="width:210px; font-size: 90%" >
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquam scelerisque commodo. Suspendisse id lorem aliquam, efficitur lacus ac, semper risus. Duis rutrum nisl id scelerisque varius. Sed vel arcu posuere, feugiat metus sit amet, iaculis sapien. Sed orci mauris, scelerisque a mollis quis, fringilla sit amet velit. Vivamus eget.
				</td>
				<td valign="center" style="width:210px; font-size: 90%" >
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquam scelerisque commodo. Suspendisse id lorem aliquam, efficitur lacus ac, semper risus. Duis rutrum nisl id scelerisque varius. Sed vel arcu posuere, feugiat metus sit amet, iaculis sapien. Sed orci mauris, scelerisque a mollis quis, fringilla sit amet velit. Vivamus eget.
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:210px; font-size: 90% ; font-weight:bold" >
				 LIVIDEZ
				</td>
				<td valign="center" style="width:210px; font-size: 90% ; font-weight:bold" >
				 LLENADO CAPILAR
				</td>
				<td valign="center" style="width:210px; font-size: 90% ; font-weight:bold" >
				 ANTECEDENTES
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:210px; font-size: 90%" >
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquam scelerisque commodo. Suspendisse id lorem aliquam, efficitur lacus ac, semper risus.
				</td>
				<td valign="center" style="width:210px; font-size: 90%" >
				Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</td>
				<td valign="center" style="width:210px; font-size: 90%" >
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquam scelerisque commodo. Suspendisse id lorem aliquam, efficitur lacus ac, semper risus. Duis rutrum nisl id scelerisque varius. Sed vel arcu posuere, feugiat metus sit amet, iaculis sapien. Sed orci mauris, scelerisque a mollis quis, fringilla sit amet velit. Vivamus eget.
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> ESCORIACIÓN:</b> NO
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> LACERACIÓN:</b> NO
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> CONTUSIÓN:</b> NO
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> TRAUMA:</b> NO
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> AVULSION:</b> NO
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> HERIDA ABIERTA:</b> NO
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> AMPUTACIÓN:</b> NO
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> DEFORMIDAD:</b> NO
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> POLITRAUMA:</b> NO
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> HEMORRAGIA:</b> NO
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> FRACTURA</b> NO
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> QUEMADURA:</b> NO
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> EMPALAMIENTO:</b> NO
				</td>
				<td valign="center" style="width:252px; font-size: 90%" >
				<b> HEMATOMA:</b> NO
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:630px; font-size: 90% ; font-weight:bold" >
				 OBSERVACIONES EXAMEN FISICO
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:630px; font-size: 90%" >
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquam scelerisque commodo. Suspendisse id lorem aliquam, efficitur lacus ac, semper risus. Duis rutrum nisl id scelerisque varius. Sed vel arcu posuere, feugiat metus sit amet, iaculis sapien. Sed orci mauris, scelerisque a mollis quis, fringilla sit amet velit. Vivamus eget.
				</td>
			</tr>

			<tr>
				<td valign="center" align="center" style="width:630px; font-size: 90% ; font-weight:bold" >
				IV. PROCEDIMIENTOS REALIZADOS AL PACIENTE
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> MONITOREO:</b> SI
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> HEMOSTASIA:</b> NO
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> RCP:</b> NO
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> OXIGENACIÓN:</b> NO
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> GLUCOMETRIA:</b> SI
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> INMOVILIZACION:</b> SI
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> ASEPSIA:</b> NO
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> DESFRIBILACIÓN:</b> NO
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> INTUBACIÓN:</b> NO
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> CURACIÓN:</b> SI
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> VENDAJE:</b> SI
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> COLLAR CERVI:</b> NO
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> LIQUIDOS:</b> NO
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> DEXTROSA:</b> 10%
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> PARTO:</b> SI
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:630px; font-size: 90% ; font-weight:bold" >
				 DESCRIPCION DE LOS PROCEDIMIENTOS REALIZADOS
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:630px; font-size: 90%" >
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquam scelerisque commodo. Suspendisse id lorem aliquam, efficitur lacus ac, semper risus. Duis rutrum nisl id scelerisque varius. Sed vel arcu posuere, feugiat metus sit amet, iaculis sapien. Sed orci mauris, scelerisque a mollis quis, fringilla sit amet velit. Vivamus eget.

				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquam scelerisque commodo. Suspendisse id lorem aliquam, efficitur lacus ac, semper risus. Duis rutrum nisl id scelerisque varius. Sed vel arcu posuere, feugiat metus sit amet, iaculis sapien. Sed orci mauris, scelerisque a mollis quis, fringilla sit amet velit. Vivamus eget.

				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquam scelerisque commodo. Suspendisse id lorem aliquam, efficitur lacus ac, semper risus. Duis rutrum nisl id scelerisque varius. Sed vel arcu posuere, feugiat metus sit amet, iaculis sapien. Sed orci mauris, scelerisque a mollis quis, fringilla sit amet velit. Vivamus eget.

				</td>				
			</tr>

			<tr>
				<td valign="center" align="center" style="width:630px; font-size: 90% ; font-weight:bold" >
				V. INSUMOS UTILIZADOS EN LA ATENCION
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:630px; font-size: 90%" >
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquam scelerisque commodo. Suspendisse id lorem aliquam, efficitur lacus ac, semper risus. Duis rutrum nisl id scelerisque varius. Sed vel arcu posuere, feugiat metus sit amet, iaculis sapien. Sed orci mauris, scelerisque a mollis quis, fringilla sit amet velit. Vivamus eget.
				</td>				
			</tr>

			<tr>
				<td valign="center" align="center" style="width:630px; font-size: 90% ; font-weight:bold" >
				VI. EXAMEN FÍSICO RUTA
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> F.C:</b> 40
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> F.R:</b> 10
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> T.A:</b> 11/199
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> SPO<sub>2</sub>:</b> 1
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> T<sup>o</sup>:</b> 20
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:126px; font-size: 90% ; font-weight:bold" >
				GLASGOW
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> RO:</b> 1
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> RV:</b> 2
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> RM:</b> 1
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> TOTAL:</b> 4
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:630px; font-size: 90% ; font-weight:bold" >
				 OBSERVACIONES EXAMEN FISICO RUTA
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:630px; font-size: 90%" >
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquam scelerisque commodo. Suspendisse id lorem aliquam, efficitur lacus ac, semper risus. Duis rutrum nisl id scelerisque varius. Sed vel arcu posuere, feugiat metus sit amet, iaculis sapien. Sed orci mauris, scelerisque a mollis quis, fringilla sit amet velit. Vivamus eget.
				</td>
			</tr>

			<tr>
				<td valign="center" align="center" style="width:630px; font-size: 90% ; font-weight:bold" >
				VII. TRASLADO ASISTTENCIAL BASICO
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:320px; font-size: 90%" >
				<b> TRANSPORTADO A:</b> A LA CASA DE LA ESQUINA
				</td>
				<td valign="center" style="width:160px; font-size: 90%" >
				<b> MUNICIPIO:</b> BOGOTA, D.C.
				</td>
				<td valign="center" style="width:150px; font-size: 90%" >
				<b> DPTO:</b> BOGOTA
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:130px; font-size: 90%" >
				<b> CODIGO CRUE</b> 131313
				</td>
				<td valign="center" style="width:200px; font-size: 90%" >
				<b> HORA INICIO TRASLADO:</b> 11:22:00
				</td>
				<td valign="center" style="width:300px; font-size: 90%" >
				<b> FECHA Y HORA LLEGADA IPS:</b> 2021-05-05 11:22:00
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:630px; font-size: 90%" >
				<b> ESTADO EN QUE SE ENTREGA:</b> VIVO
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:365px; font-size: 90%" >
				<b> NOMBRE QUIEN RECIBE:</b> GAIA MARIA VANEGAS
				</td>
				<td valign="center" style="width:265px; font-size: 90%" >
				<b> DOCUMENTO:</b> 1234567654321
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:365px; font-size: 90%" >
				<b> CARGO:</b> MASCOTA
				</td>
				<td valign="center" style="width:265px; font-size: 90%" >
				<b> RG.MD:</b> 1234567654321
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:630px; font-size: 90% ; font-weight:bold" >
				 OBSERVACIÓN TRASLADO
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:630px; font-size: 90%" >
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquam scelerisque commodo. Suspendisse id lorem aliquam, efficitur lacus ac, semper risus. Duis rutrum nisl id scelerisque varius. Sed vel arcu posuere, feugiat metus sit amet, iaculis sapien. Sed orci mauris, scelerisque a mollis quis, fringilla sit amet velit. Vivamus eget.
				</td>
			</tr>

			<tr>
				<td valign="center" align="center" style="width:630px; font-size: 90% ; font-weight:bold" >
				VIII. EXAMEN FÍSICO FINAL
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> F.C:</b> 40
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> F.R:</b> 10
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> T.A:</b> 11/199
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> SPO<sub>2</sub>:</b> 1
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> T<sup>o</sup>:</b> 20
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:126px; font-size: 90% ; font-weight:bold" >
				GLASGOW
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> RO:</b> 1
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> RV:</b> 2
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> RM:</b> 1
				</td>
				<td valign="center" style="width:126px; font-size: 90%" >
				<b> TOTAL:</b> 4
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:630px; font-size: 90% ; font-weight:bold" >
				 OBSERVACIONES EXAMEN FISICO FINAL
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:630px; font-size: 90%" >
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquam scelerisque commodo. Suspendisse id lorem aliquam, efficitur lacus ac, semper risus. Duis rutrum nisl id scelerisque varius. Sed vel arcu posuere, feugiat metus sit amet, iaculis sapien. Sed orci mauris, scelerisque a mollis quis, fringilla sit amet velit. Vivamus eget.
				</td>
			</tr>

			<tr>
				<td valign="center" align="center" style="width:630px; font-size: 90% ; font-weight:bold" >
				IX. DATOS DEL EVENTO O ACCIDENTE DE TRANSITO
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:630px; font-size: 90%" >
				<b> CAUSA QUE ORIGINA LA ATENCIÓN:</b> ACCIENTE DE TRANSITO
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:255px; font-size: 90%" >
				<b> MODO SERVICIO:</b> SENCILLO
				</td>
				<td valign="center" style="width:375px; font-size: 90%" >
				<b> UBICACIÓN O ZONA EVENTO:</b> URBANO			
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:630px; font-size: 90%" >
				<b> DIRECCION DEL EVENTO:</b> CALLE 1 CARRERA 2 
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:160px; font-size: 90%" >
				<b> MUNICIPIO:</b> BOGOTA, D.C.
				</td>
				<td valign="center" style="width:150px; font-size: 90%" >
				<b> DPTO:</b> BOGOTA
				</td>
				<td valign="center" style="width:320px; font-size: 90%" >
				<b> CALIDAD PACIENTE O VICTIMA:</b> CONDUCTOR
				</td>
			</tr>
			<tr>
				<td valign="center" style="width:370px; font-size: 90%" >
				<b> CONDUCTOR:</b> NOMBRE1 APELLIDO1 APELLIDO2 
				</td>
				<td valign="center" style="width:160px; font-size: 90%" >
				<b> DOCUMENTO:</b> 10756792932
				</td>
				<td valign="center" style="width:100px; font-size: 90%" >
				<b> PLACA:</b> BGH234
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:405px; font-size: 90%" >
				<b> ASEGURADORA SOAT:</b> ALLIANZ COLOMBIA
				</td>
				<td valign="center" style="width:225px; font-size: 90%" >
				<b> POLIZA SOAT:</b> SOAT123113
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:630px; font-size: 90% ; font-weight:bold" >
				 DATOS DEL PERSONAL Y AMBULANCIA QUE ATIENDE EL EVENTO
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:375px; font-size: 90%" >
				<b> NUMERO INTERNO MOVIL:</b> M13
				</td>
				<td valign="center" style="width:255px; font-size: 90%" >
				<b> PLACA DE LA MOVIL:</b> HBG123
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:320px; font-size: 90%" >
				<b> NOMBRE T.A.P.H:</b> NICOLAS VANEGAS MUÑOZ
				</td>
				<td valign="center" style="width:160px; font-size: 90%" >
				<b> DOCUMENTO:</b> 1075239682
				</td>
				<td valign="center" style="width:150px; font-size: 90%" >
				<b> REGISTRO:</b> 1075239682
				</td>				
			</tr>

			<tr>
				<td valign="center" align="center" style="width:630px; font-size: 90% ; font-weight:bold" >
				X. OBSERVACIONES FINALES
				</td>				
			</tr>
			<tr>
				<td valign="center" style="width:630px; font-size: 90%" >
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquam scelerisque commodo. Suspendisse id lorem aliquam, efficitur lacus ac, semper risus. Duis rutrum nisl id scelerisque varius. Sed vel arcu posuere, feugiat metus sit amet, iaculis sapien. Sed orci mauris, scelerisque a mollis quis, fringilla sit amet velit. Vivamus eget.
				</td>
			</tr>

			<tr>
				<td valign="center" align="center" style="width:630px; font-size: 90% ; font-weight:bold" >
				XI. FIRMAS
				</td>				
			</tr>
			<tr>
				<td align="center" style="width:315px; font-size: 90%" >
				&nbsp;<br/><img src="images/bomberosleft.jpg" alt="" width="100" height="100">
				</td>
				<td align="center" style="width:315px; font-size: 90%" >
				&nbsp;<br/><img src="images/bomberosleft.jpg" alt="" width="100" height="100">
				</td>				
			</tr>
			<tr>
				<td valign="center" align="center" style="width:315px; font-size: 90% ; font-weight:bold" >
				FIRMA PACIENTE
				</td>
				<td valign="center" align="center" style="width:315px; font-size: 90% ; font-weight:bold" >
				FIRMA ACOMPAÑANTE
				</td>				
			</tr>
			<tr>
				<td align="center" style="width:315px; font-size: 90%" >
				&nbsp;<br/><img src="images/bomberosleft.jpg" alt="" width="100" height="100">
				</td>
				<td align="center" style="width:315px; font-size: 90%" >
				&nbsp;<br/><img src="images/bomberosleft.jpg" alt="" width="100" height="100">
				</td>				
			</tr>
			<tr>
				<td valign="center" align="center" style="width:315px; font-size: 90% ; font-weight:bold" >
				RECIBE IPS
				</td>
				<td valign="center" align="center" style="width:315px; font-size: 90% ; font-weight:bold" >
				REFERENCIA
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
