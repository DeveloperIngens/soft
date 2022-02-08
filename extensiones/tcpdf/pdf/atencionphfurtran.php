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
				<td align="left" style="width:100px"> <br/><img src="images/escudo.jpg" alt="" width="80" height="50"></td>
				<td valign="center" align="center" style="width:380px; font-size: 80%" >
				REPUBLICA DE COLOMBIA<br/>
				MINISTERIO DE PROTECCION SOCIAL<br/>
				FORMULARIO UNICO DE RECLAMACION DE GASTOS DE TRANSPORTE Y MOVILIZACION DE VICTIMAS - FURTRAN
				</td>
				<td style="width:150px; font-size: 80%" align="center">&nbsp;<br/>Resolucion 01915 28 MAY 2008</td>
			</tr>
			<tr>
			<td style="width:90px; font-size: 80%">Fecha de entrega</td>
			<td border="1" style="width:75px; color:red ; font-size: 80%"> DD-MM-AAAA</td>
			<td style="width:50px"></td>
			<td style="width:20px; font-size: 80%">RG</td>
			<td border="1" style="width:20px"> </td>
			<td style="width:20px"></td>
			<td style="width:75px; font-size: 80%">No. Radicado</td>
			<td border="1" rowspan="3" style="width:280px"></td>
			</tr>
			<tr>
			<td></td>
			</tr>
			<tr>
			<td style="width:100px; font-size: 80%">No. Radicado anterior (respuesta glosa, marcar en RG)</td>
			<td border="1" style="width:210px"></td>
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
$pdf->SetTitle('AtencionPH FURTRAN');

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
$pdf->Ln(11);
$txt = <<<EOD
		
		<table>
			<tr>
				<td border="1" valign="center" align="center" style="width:630px; font-size: 80% ; font-weight:bold ; background-color:#FAF8AB" >
				I. DATOS DEL TRANSPORTADOR (Si es persona natural diligenciar los campos referentes a nombres y apellidos)
				</td>				
			</tr>
			<tr>
			<td></td>
			</tr>
			<tr>
				<td  valign="center" align="left" style="width:230px; font-size: 70%" >
				Nombre Empresa de Transporte Especial o Reclamante
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:390px; font-size: 70%" >
				
				</td>

			</tr>
			
			<tr>
				<td  valign="center" align="left" style="width:230px; font-size: 70%" >
				Código de habilitación Empresa de Transporte Especial
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:250px; font-size: 70%" >
				
				</td>

			</tr>
			<tr>
				<td  style="width:50px"></td>
				<td border="1" valign="center" align="center" style="width:250px; font-size: 70%" >
				
				</td>
				<td  style="width:30px"></td>
				<td border="1" valign="center" align="center" style="width:250px; font-size: 70%" >
				
				</td>
			</tr>
			<tr>
				<td  style="width:50px"></td>
				<td valign="center" align="center" style="width:250px; font-size: 70%" >
				 1er Apellido
				</td>
				<td style="width:30px"></td>
				<td valign="center" align="center" style="width:250px; font-size: 70%" >
				2do Apellido
				</td>
			</tr>
			<tr>
				<td  style="width:50px"></td>
				<td border="1" valign="center" align="center" style="width:250px; font-size: 70%" >
				
				</td>
				<td  style="width:30px"></td>
				<td border="1" valign="center" align="center" style="width:250px; font-size: 70%" >
				
				</td>
			</tr>
			<tr>
				<td  style="width:50px"></td>
				<td valign="center" align="center" style="width:250px; font-size: 70%" >
				 1er Nombre
				</td>
				<td style="width:30px"></td>
				<td valign="center" align="center" style="width:250px; font-size: 70%" >
				2do Nombre
				</td>
			</tr>

			<tr>
				<td valign="center" align="left" style="width:100px; font-size: 70%" >
				Tipo documento
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:30px; font-size: 70%" >
				 NI
				</td>
				<td  style="width:30px"></td>
				<td valign="center" align="left" style="width:100px; font-size: 70%" >
				Numero documento
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70%" >
				 901038661-1
				</td>
			</tr>

			<tr>
				<td  valign="center" align="left" style="width:100px; font-size: 70%" >
				Tipo Servicio
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70%" >
				 AMBULANCIA BASICA
				</td>
				<td  style="width:30px"></td>
				<td  valign="center" align="left" style="width:130px; font-size: 70%" >
				En vehiculo con placa No
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70%" >
				 VAS979
				</td>
			</tr>

			<tr>
				<td  valign="center" align="left" style="width:270px; font-size: 70%" >
				Dirección de la empresa opersona que realiza el transporte:
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:300px; font-size: 70%" >
				 CRA 21 #127D-63 PISO 1
				</td>
			</tr>
			<tr>
				<td  valign="center" align="left" style="width:100px; font-size: 70%" >
				Departamento
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70%" >
				 BOGOTA
				</td>
				<td  style="width:30px"></td>
				<td  valign="center" align="left" style="width:30px; font-size: 70%" >
				Cod
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:30px; font-size: 70%" >
				 20
				</td>
				<td  style="width:30px"></td>
				<td  valign="center" align="left" style="width:100px; font-size: 70%" >
				Telefono o Celular 
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:130px; font-size: 70%" >
				 3057041749
				</td>
			</tr>
			<tr>
				<td  valign="center" align="left" style="width:100px; font-size: 70%" >
				Municipio
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70%" >
				 SANTA MARTA
				</td>
				<td  style="width:30px"></td>
				<td  valign="center" align="left" style="width:30px; font-size: 70%" >
				Cod
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:30px; font-size: 70%" >
				 001
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
				<td border="1" valign="center" align="center" style="width:630px; font-size: 80% ; font-weight:bold ; background-color:#FAF8AB" >
				II. RELACION DE VICTIMAS TRASLADADAS
				</td>				
			</tr>
			<tr>
			<td></td>
			</tr>
			<tr>
				<td border="1" valign="center" align="center" style="width:60px; font-size: 70%" >
				Tipo Doc
				</td>
				<td border="1" valign="center" align="center" style="width:90px; font-size: 70%" >
				No. Documento
				</td>
				<td border="1" valign="center" align="center" style="width:120px; font-size: 70%" >
				Primer Nombre
				</td>
				<td border="1" valign="center" align="center" style="width:120px; font-size: 70%" >
				Segundo Nombre
				</td>
				<td border="1" valign="center" align="center" style="width:120px; font-size: 70%" >
				Primer Apellido
				</td>
				<td border="1" valign="center" align="center" style="width:120px; font-size: 70%" >
				Segundo Apellido
				</td>
				

			</tr>
			<tr>
				<td border="1" valign="center" align="center" style="width:60px; font-size: 70%" >
				CC
				</td>
				<td border="1" valign="center" align="center" style="width:90px; font-size: 70%" >
				1075239682
				</td>
				<td border="1" valign="center" align="center" style="width:120px; font-size: 70%" >
				NICOLAS
				</td>
				<td border="1" valign="center" align="center" style="width:120px; font-size: 70%" >
				JOAQUIN
				</td>
				<td border="1" valign="center" align="center" style="width:120px; font-size: 70%" >
				VANEGAS
				</td>
				<td border="1" valign="center" align="center" style="width:120px; font-size: 70%" >
				MUÑOZ
				</td>
				

			</tr>
			<tr>
				<td  valign="center" align="left" style="width:170px; font-size: 70%" >
				Tipo de evento que sucita la movilización::
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:300px; font-size: 70%" >
				 ACCIDENTE DE TRANSITO
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
				<td border="1" valign="center" align="center" style="width:630px; font-size: 80% ; font-weight:bold ; background-color:#FAF8AB" >
				III. LUGAR EN EL QUE SE RECOGE LA VICTIMA O VICTIMAS
				</td>				
			</tr>
			<tr>
			<td></td>
			</tr>
			<tr>
				<td  valign="center" align="left" style="width:100px; font-size: 70%" >
				Dirección:
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:470px; font-size: 70%" >
				 CRA 21 #127D-63 PISO 1
				</td>
			</tr>
			<tr>
				<td  valign="center" align="left" style="width:100px; font-size: 70%" >
				Departamento
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70%" >
				 BOGOTA
				</td>
				<td  style="width:30px"></td>
				<td  valign="center" align="left" style="width:30px; font-size: 70%" >
				Cod
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:30px; font-size: 70%" >
				 20
				</td>
				<td  style="width:80px"></td>
				<td  valign="center" align="left" style="width:50px; font-size: 70%" >
				Zona 
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:130px; font-size: 70%" >
				 URBANA
				</td>
			</tr>
			<tr>
				<td  valign="center" align="left" style="width:100px; font-size: 70%" >
				Municipio
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70%" >
				 SANTA MARTA
				</td>
				<td  style="width:30px"></td>
				<td  valign="center" align="left" style="width:30px; font-size: 70%" >
				Cod
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:30px; font-size: 70%" >
				 001
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
				<td border="1" valign="center" align="center" style="width:630px; font-size: 80% ; font-weight:bold ; background-color:#FAF8AB" >
				IV. CERTIFICACION DE TRASLADO DE VICTIMAS
				</td>				
			</tr>
			<tr>
			<td  valign="center" align="left" style="font-size: 70%" >La Institución Prestadora de Servicios de Salud certifica que la entidad de Transporte Especial o Persona Natural efectuó el traslado de la víctima a esta IPS</td>
			</tr>
			<tr>
				<td  valign="center" align="left" style="width:100px; font-size: 70%" >
				El día:
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70%" >
				 10-11-1989
				</td>
				<td  style="width:10px"></td>
				<td  valign="center" align="left" style="width:30px; font-size: 70%" >
				a las:
				</td>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70%" >
				 00:05
				</td>
			</tr>
			<tr>
				<td  valign="center" align="left" style="width:240px; font-size: 70%" >
				Nombre IPS que atendió la víctima
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:380px; font-size: 70%" >
				 CLINICA DE LA COSTA EN BOGOTA
				</td>
			</tr>
			<tr>
				<td  valign="center" align="left" style="width:100px; font-size: 70%" >
				Nit
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70%" >
				 901038661-1
				</td>
				<td  style="width:30px"></td>
				<td  valign="center" align="left" style="width:150px; font-size: 70%" >
				
				</td>
				
				<td  valign="center" align="left" style="width:80px; font-size: 70%" >
				Codigo Habilitacion
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:150px; font-size: 70%" >
				 200010026901
				</td>
			</tr>
			<tr>
				<td  valign="center" align="left" style="width:100px; font-size: 70%" >
				Direccion
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:520px; font-size: 70%" >
				 CRA 21 #127D-63 PISO 1
				</td>
			</tr>
			
			<tr>
				<td  valign="center" align="left" style="width:100px; font-size: 70%" >
				Departamento
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70%" >
				 BOGOTA
				</td>
				<td  style="width:30px"></td>
				<td  valign="center" align="left" style="width:30px; font-size: 70%" >
				Cod
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:30px; font-size: 70%" >
				 20
				</td>
				<td  style="width:80px"></td>
				<td  valign="center" align="left" style="width:80px; font-size: 70%" >
				Telefono 
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:150px; font-size: 70%" >
				 3057041749
				</td>
			</tr>

			<tr>
				<td  valign="center" align="left" style="width:100px; font-size: 70%" >
				Municipio
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:100px; font-size: 70%" >
				 SANTA MARTA
				</td>
				<td  style="width:30px"></td>
				<td  valign="center" align="left" style="width:30px; font-size: 70%" >
				Cod
				</td>
				<td  style="width:10px"></td>
				<td border="1" valign="center" align="center" style="width:30px; font-size: 70%" >
				 001
				</td>
				
			</tr>
			<tr>
			<td  valign="center" align="left" style="width:630px ; font-size: 70%" >Como representante legal o Gerente de la Institución Prestadora de Serviicos de Salud, declaró la gavedad de juramento que la información contenidad en este formulario es cierta y podrá se verificada por la Comañía de Seguros, por la Dirección Genereal de Financiamiento, por el Administrador Fiduciario del Fondo de Solidaridad y Garantía FOSYGA, por la Superintendencia Nacional de Salud o la Contraloria Generalde la República de no ser así, acepto todas las consecuencias legales que produzca esta situación.Adicionalmente, manifiesto que la reclamación no ha sido presentada con anterioridad ni se ha recibido pago alguno por las sumas reclamadas.</td>
			</tr>
			<tr>
			<td></td>
			</tr>
			<tr>
				<td valign="center" align="center" style="width:315px; font-size: 90%" >
				&nbsp;<br/><br/><br/><br/><br/>NICOLAS JOAQUIN VANEGAS MUÑOZ
				</td>
				<td align="center" style="width:315px; font-size: 90%" >
				&nbsp;<br/><img src="images/bomberosleft.jpg" alt="" width="80" height="80">
				</td>				
			</tr>
			<tr>
				<td valign="center" align="center" style="width:315px; font-size: 70%" >
				NOMBRE DEL REPRESENTANTE LEGAL O PERSONA RESPONSABLE PARA TRAMITE DE ADMISIONES DE LA IPS
				</td>
				<td valign="center" align="center" style="width:315px; font-size: 70%" >
				FIRMA DEL REPRESENTANTE LEGAL O PERSONA RESPONSABLE PARA TRAMITE DE ADMISIONES DE LA IPS
				</td>				
			</tr>
			<tr>
				<td align="center" style="width:315px; font-size: 90%" >
				&nbsp;<br/><br/><br/><br/><br/>CC 1075239682
				</td>
				<td align="center" style="width:315px; font-size: 90%" >
				&nbsp;<br/><img src="images/bomberosleft.jpg" alt="" width="80" height="80">
				</td>				
			</tr>
			<tr>
				<td valign="center" align="center" style="width:315px; font-size: 70%" >
				TIPO Y NUMERO DE DOCUMENTO DEL REPRESENTANTE LEGAL O PERSONA RESPONSIBLE PARA TRAMITE DE ADMISIONES DE LA IPS
				</td>
				<td valign="center" align="center" style="width:315px; font-size: 70%" >
				FIRMA DEL REPRESENTANTE LEGAL DE LA EMPRESA TRANSPORTADORA O DE LA PERSONA NATURAL QUE REALIZO EL TRANSPORTE
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
