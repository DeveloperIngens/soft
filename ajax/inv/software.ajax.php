<?php 

require_once "../../controladores/inv/software.controlador-inv.php";
require_once "../../modelos/inv/par_software.modelo-inv.php";

class AjaxSoftware{

	/*=============================================
	EDITAR ACTIVO
	=============================================*/	

	public $IdCorrectivo;

	public function ajaxEditarMantenimientos(){

		$item = 'id_mantecorrectivo';

		$valor = $this->IdCorrectivo;
	
		$respuesta = ControladorCorrectivo::ctrMostrarCorrectivo($item,$valor);
		
		echo json_encode($respuesta);

	}
}

	/*=============================================
	EDITAR MANTENIMIENTOS
	=============================================*/

	if(isset($_POST["IdCorrectivo"])){
		
		$EDITAR =  new AjaxCorrectivo(); 
		$EDITAR -> IdCorrectivo = $_POST["IdCorrectivo"];
		$EDITAR -> ajaxEditarMantenimientos();	 

	}
