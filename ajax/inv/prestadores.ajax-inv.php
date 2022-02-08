<?php

require_once "../../controladores/prestadores.controlador.php";
require_once "../../modelos/prestadores.modelo.php";

class AjaxPrestadores{

	/*=============================================
	EDITAR ACTIVO
	=============================================*/	

	public $idActivo;

	public function ajaxEditarActivo(){

		$item = 'id_activos';

		$valor = $this->idActivo;
	
		$respuesta = ControladorPrestadores::ctrMostrarActivos($item,$valor);
		
		echo json_encode($respuesta);

	}
	/*=============================================
	ACTIVAR ESTADO 
	=============================================*/	

	public $activarActivo;
	public $activarId;


	public function ajaxActivarActivo(){

		$tabla = "activos";

		$item1 = "estado";
		$valor1 = $this->activarActivo;

		$item2 = "id_activos";
		$valor2 = $this->activarId;

		$respuesta = ModeloPrestadores::mdlActualizarActivo($tabla, $item1, $valor1, $item2, $valor2);


	}
	
	/*=============================================
	VALIDAR NO REPETIR ACTIVO
	=============================================*/	

	public $validarActivo;

	public function ajaxValidarActivo(){

		$item = "activos";
		$valor = $this->validarActivo;

		$respuesta = ControladorPrestadores::ctrMostrarActivos($item, $valor);

		echo json_encode($respuesta);

	}
}

	/*=============================================
	VALIDAR 
	=============================================*/

	if(isset( $_POST["validarActivo"])){

	$valUsuario = new AjaxPrestadores();
	$valUsuario -> validarActivo = $_POST["validarActivo"];
	$valUsuario -> ajaxValidarActivo();

	}

	if(isset($_POST["idActivo"])){
		
		
		$objActivo =  new AjaxPrestadores(); 
		$objActivo -> idActivo = $_POST["idActivo"];
		$objActivo -> ajaxEditarActivo();	 

	}

	if(isset($_POST['activarActivo'])){
    $activarActivo = new AjaxPrestadores();
    $activarActivo -> activarActivo=$_POST['activarActivo'];
    $activarActivo -> activarId=$_POST['activarId'];
    $activarActivo ->ajaxActivarActivo();
   }
	
			

