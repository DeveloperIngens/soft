<?php 

require_once "../../controladores/inv/Correctivo.Controlador-inv.php";
require_once "../../modelos/inv/Correctivo.modelo-inv.php";

class AjaxCorrectivo{

	/*=============================================
	EDITAR MANTENIMIENTO PREVENTIVO/CORRECTIVO
	=============================================*/
	public $IdCorrectivo;

	public function ajaxEditarMantenimientos(){

		$item = 'id_tipo_mantenimiento';

		$valor = $this->IdCorrectivo;
	
		$respuesta = ControladorCorrectivo::ctrMostrarCorrectivo($item,$valor);
		
		echo json_encode($respuesta);

	}

	/*=============================================
	ACTIVAR MANTENIMIENTO
	=============================================*/	

	public $idCorrectivo;
	public $ActivarMante;


	public function ajaxActivarManteniento(){

		$tabla = "par_tipo_mantenimineto";

		$item1 = "estado";
		$valor1 = $this->ActivarMante;

		$item2 = "id_tipo_mantenimiento";
		$valor2 = $this->idCorrectivo;

		$respuesta = ModeloCronograma::mdlActualizarMantenimiento($tabla, $item1, $valor1, $item2, $valor2);

		echo json_encode($respuesta);

	}

	/*=============================================
	OBTENER DATO REQUERIDO
	=============================================*/
	public $tablaRequerido;
	public $itemRequerido;
	public $valorRequerido;

	public function ajaxObtenerDatoRequerido(){

		$tabla = $this->tablaRequerido;
		$item = $this->itemRequerido;
		$valor = $this->valorRequerido;

		$obtenerDato = ControladorCorrectivo::ctrObternerDatoRequerido($tabla, $item, $valor);

		echo json_encode($obtenerDato);

	}


}

	/*=============================================
	OBTENER DATO REQUERIDO
	=============================================*/
	if(isset($_POST["idTipoMantenimiento"])){

		$obtenerDato = new AjaxCorrectivo();
		$obtenerDato->tablaRequerido = $_POST["tablaRequerido"];
		$obtenerDato->itemRequerido = $_POST["itemRequerido"];
		$obtenerDato->valorRequerido = $_POST["idTipoMantenimiento"];
		$obtenerDato->ajaxObtenerDatoRequerido();


	}


	/*=============================================
	EDITAR MANTENIMIENTOS
	=============================================*/

	if(isset($_POST["IdCorrectivo"])){
		
		$EDITAR =  new AjaxCorrectivo(); 
		$EDITAR -> IdCorrectivo = $_POST["IdCorrectivo"];
		$EDITAR -> ajaxEditarMantenimientos();	 

	}


	/*=============================================
	ACTIVAR MANTENIMIENTOS
	=============================================*/	

	if(isset($_POST["id_tipo_mantenimiento"])){

		$activarMante = new AjaxCorrectivo();
		$activarMante -> IdMantenimiento = $_POST["id_tipo_mantenimiento"];
		$activarMante -> ActivarEstado = $_POST["ActivarEstado"];
		$activarMante-> ajaxActivarManteniento();

	}

