<?php 

require_once "../../controladores/inv/cronograma.controlador-inv.php";
require_once "../../modelos/inv/cronograma.modelo-inv.php";
require_once "../../controladores/inv/Correctivo.Controlador-inv.php";
require_once "../../modelos/inv/Correctivo.modelo-inv.php";

class AjaxMantenimiento{

	/*=============================================
	EDITAR ACTIVO
	=============================================*/	

	public $idMantenimientos;

	public function ajaxEditarMantenimientos(){

		$item = 'id_calendario';

		$valor = $this->idMantenimientos;

		$respuesta = ControladorCronograma::ctrMostrarCronograma($item,$valor);
		
		echo json_encode($respuesta);

	}

	/*=============================================
	ACTIVAR MANTENIMIENTO
	=============================================*/	

	public $IdMantenimiento;
	public $ActivarEstado;


	public function ajaxActivarManteniento(){

		$tabla = "mantenimiento";

		$item1 = "estado";
		$valor1 = $this->ActivarEstado;

		$item2 = "id_calendario";
		$valor2 = $this->IdMantenimiento;

		$respuesta = ModeloCronograma::mdlActualizarMantenimiento($tabla, $item1, $valor1, $item2, $valor2);

		echo json_encode($respuesta);

	}

	/*----------------------------------------
	MOSTRAR MANTENIMIENTOS REALIZADOS
	---------------------------------------*/
	public $DatosCalendario;

	public function ajaxMostrarDatos(){

		$itemCalendario ='id_calendario';
		$valorCalendario = $this->DatosCalendario;

		$Calendario = ControladorCronograma::ctrMostrarCronograma($itemCalendario,$valorCalendario);

		$CadenaCalendario = '';

		if($Calendario["mantenimiento"] != null){

			$mantenimientos = explode(",",$Calendario["mantenimiento"]);

		  	foreach ($mantenimientos as $key => $valueMostar) {

				$itemCorrectivo = "id_tipo_mantenimiento";
				$valorCorrectivo = $valueMostar;
				$Correctivo = ControladorCorrectivo::ctrMostrarCorrectivo($itemCorrectivo,$valorCorrectivo);

				if($Correctivo["tipo_mantenimiento"] == "Preventivo"){

					$CadenaCalendario .='<a class="btn btn-warning btn-xs" style="margin-right: 10px; margin-top: 10px;">'.$Correctivo['nombre_mantenimiento']."</a>";

				}elseif($Correctivo["tipo_mantenimiento"] == "Correctivo"){

					$CadenaCalendario .='<a class="btn btn-info btn-xs" style="margin-right: 10px; margin-top: 10px;">'.$Correctivo['nombre_mantenimiento']."</a>";

				}
		  	
			}
		  	
			echo $CadenaCalendario;

		}else{

			echo $CadenaCalendario .= '<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<i class="icon fa fa-ban"></i> No tiene Mantenimientos Preventivos o Correctivos seleccionados.
		  	</div>';

		}

	}

}

	/*=============================================
	EDITAR MANTENIMIENTOS
	=============================================*/

	if(isset($_POST["idMantenimientos"])){
		
		$EDITAR =  new AjaxMantenimiento(); 
		$EDITAR -> idMantenimientos = $_POST["idMantenimientos"];
		$EDITAR -> ajaxEditarMantenimientos();	 

	}


	/*=============================================
	ACTIVAR MANTENIMIENTOS
	=============================================*/	

	if(isset($_POST["id_calendario"])){

	$activarMante = new AjaxMantenimiento();
	$activarMante -> IdMantenimiento = $_POST["id_calendario"];
	$activarMante -> ActivarEstado = $_POST["ActivarEstado"];
	$activarMante-> ajaxActivarManteniento();

}

	/*--------------------------
	MOSTRAR MANTENIMIENTOS	
	----------------------------*/

	if(isset($_POST['DatosCalendario'])) {
		
		$mostrar = new AjaxMantenimiento();
		$mostrar -> DatosCalendario = $_POST['DatosCalendario'];
		$mostrar -> ajaxMostrarDatos();
	}

/*---------------------------------------
-------------------------*/