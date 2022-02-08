<?php

require_once "../../controladores/inv/tecnolgia.controlador-inv.php";
require_once "../../modelos/inv/tecnologia.modelo-inv.php";

class AjaxTecnologia{

	/*=============================================
	EDITAR ACTIVO
	=============================================*/	
	public $idActivo;

	public function ajaxEditarTecnologia(){

		$item = 'id_activos';

		$valor = $this->idActivo;
		$perfil = null;
	
		$respuesta = ControladorTecnologia::ctrMostrarTecnologia($item,$valor,$perfil);
		
		echo json_encode($respuesta);

	}
	
	/*=============================================
	ACTIVAR ESTADO 
	=============================================*/	
	public $activarTecnologia;
	public $activarId;

	public function ajaxActivarTecnologia(){

		$tabla = "tecnologia";

		$item1 = "estado";
		$valor1 = $this->activarTecnologia;

		$item2 = "id_activos";
		$valor2 = $this->activarId;

		$respuesta = ModeloTecnologia::mdlActualizarTecnologia($tabla, $item1, $valor1, $item2, $valor2);


	}
	
	/*=============================================
	VALIDAR NO REPETIR PLACA
	=============================================*/	
	public $validarTecnologia;

	public function ajaxValidarTecnologia(){

		$item = "numero_placa";

		$valor = $this->validarTecnologia;
		
		$perfil = null;
	
		$respuesta = ControladorTecnologia::ctrMostrarTecnologia($item, $valor , $perfil);

		echo json_encode($respuesta);

	}


	/*=============================================
	MOSTRAR INFORMACION ACTIVO 
	=============================================*/
	public $idActivoMostrar;

	public function ajaxMostrarInformacionActivo(){

		$tabla = "tecnologia";
		$item = "id_activos";
		$valor = $this->idActivoMostrar;

		$respuesta = ControladorTecnologia::ctrObternerDatoRequerido($tabla, $item , $valor);

		$tablaProyecto = "par_proyecto";
		$itemProyecto = "id_proyecto";
		$valorProyecto = $respuesta["proyecto"];

		$proyecto = ControladorTecnologia::ctrObternerDatoRequerido($tablaProyecto, $itemProyecto, $valorProyecto);

		$tablaUbicacion = "par_ubicacion";
		$itemUbicacion = "id_ubicacion";
		$valorUbicacion = $respuesta["ubicacion"];

		$ubicacion = ControladorTecnologia::ctrObternerDatoRequerido($tablaUbicacion, $itemUbicacion, $valorUbicacion);

		$tablaCategoria = "par_categoria";
		$itemCategoria = "id_categoria";
		$valorCategoria = $respuesta["categoria"];

		$categoria = ControladorTecnologia::ctrObternerDatoRequerido($tablaCategoria,$itemCategoria, $valorCategoria);

		$cadenaResponsable = "";

		if($respuesta["id_responsable"] != null){

			$tablaResponsable = "usuarios";
			$itemResponsable = "id_usuario";
			$valorResponsable = $respuesta["id_responsable"];

			$responsable = ControladorTecnologia::ctrObternerDatoRequerido($tablaResponsable, $itemResponsable, $valorResponsable);

			$cadenaResponsable = $responsable["nombres"] . " " . $responsable["apellidos"];

		}else{

			$cadenaResponsable = "No tiene Responsable Asignado el Activo.";

		}

		$cadenaPdfEntregaEquipo = '';

		if($respuesta["pdf_entrega_equipo"] != null){

			$cadenaPdfEntregaEquipo = '<a href="'.$respuesta["pdf_entrega_equipo"].'" target="_blank"><i class="fas fa-file-pdf"></i> PDF Entrega Equipo</a>';

		}else{

			$cadenaPdfEntregaEquipo = 'No tiene PDF Entrega de Equipo cargado.';

		}

		$cadenaActivo = "";

		$cadenaActivo .= '<div class="row">

			<div class="col-md-3">

				<div class="form-group">

					<label>Número Puesto:</label> '.$respuesta["numero_puesto"].'

				</div>
			
			</div>

			<div class="col-md-3">

				<div class="form-group">

					<label>Punto Red:</label> '.$respuesta["punto_red"].'

				</div>
			
			</div>

			<div class="col-md-3">

				<div class="form-group">

					<label>Proyecto:</label> '.$proyecto["proyecto"].'

				</div>
			
			</div>

			<div class="col-md-3">

				<div class="form-group">

					<label>Ubicación:</label> '.$ubicacion["ubicacion"].'

				</div>
			
			</div>
		
		</div>
		
		<hr>
		
		<div class="row">

			<div class="col-md-6">

				<div class="form-group">

					<label>Clasificación Activo:</label> '.$respuesta["clasificacion"].'
				
				</div>
			
			</div>

			<div class="col-md-6">

				<div class="form-group">

					<label>Categoria Activo:</label> '.$categoria["categoria"].'
				
				</div>
			
			</div>
		
		</div>
		
		<hr>
		
		<div class="row">

			<div class="col-md-4">

				<div class="form-group">

					<label>Marca Activo:</label> '.$respuesta["marca"].'
				
				</div>
			
			</div>

			<div class="col-md-4">

				<div class="form-group">

					<label>Número Placa Activo:</label> '.$respuesta["numero_placa"].'
		
				</div>
			
			</div>

			<div class="col-md-4">

				<div class="form-group">

					<label>Serial Activo:</label> '.$respuesta["serial"].'
		
				</div>
			
			</div>
		
		</div>

		<hr>

		<div class="row">

			<div class="col-md-4">

				<div class="form-group">

					<label>Fecha Adquisición Activo:</label> '.$respuesta["fecha_adquisicion"].'

				</div>
			
			</div>

			<div class="col-md-4">

				<div class="form-group">

					<label>Centro Costos Activo:</label> '.$respuesta["centro_costos_activo"].'

				</div>
			
			</div>

			<div class="col-md-4">

				<div class="form-group">

					<label>Metodo Adquisición Activo:</label> '.$respuesta["metodo_adquisicion_activo"].'

				</div>
			
			</div>
		
		</div>

		<hr>

		<div class="row">

			<div class="col-md-6">

				<div class="form-group">

					<label>Valor Compra Activo:</label> '.$respuesta["valor_compra"].'

				</div>
			
			</div>


			<div class="col-md-6">

				<div class="form-group">

					<label>Valor Comercial Activo:</label> '.$respuesta["valor_comercial"].'
		
				</div>
			
			</div>
		
		
		</div>

		<hr>
		
		<div class="row">

			<div class="col-md-6">

				<div class="form-group">

					<label>Responsable Activo:</label> '.$cadenaResponsable.'
				
				</div>
			
			</div>

			<div class="col-md-6">

				<div class="form-group">

					<label>PDF Entrega Equipo:</label> '.$cadenaPdfEntregaEquipo.'
				
				</div>
			
			</div>
		
		</div>';

		echo $cadenaActivo;


	}

	/*=============================================
	OBTENER MANTENIMIENTOS DE LA CATEGORIA PREVENTIVOS
	=============================================*/
	public $idCategoriaPreven;

	public function ajaxObtenerMantenimientosCategoriaPreventivos(){

		$tabla = "par_tipo_mantenimiento";
		$item = "id_categoria";
		$valor = $this->idCategoriaPreven;

		$cadenaMantenimientos = '';

		$informacionPreven = ControladorTecnologia::ctrObtenerDatosRequeridosAll($tabla, $item, $valor);

		if(!empty($informacionPreven)){

			foreach($informacionPreven as $key => $valuePreventivos){

				if($valuePreventivos["tipo_mantenimiento"] == "Preventivo"){

					$cadenaMantenimientos .= '<div class="checkbox"><label><input type="checkbox" name="nuevoManteninimientoPreventivo[]" value="'.$valuePreventivos["id_tipo_mantenimiento"].'">'.$valuePreventivos["nombre_mantenimiento"].'</label></div>';

				}

			}

			echo $cadenaMantenimientos;

		}else{
			echo '<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<i class="icon fa fa-ban"></i> No tiene Mantenimientos Preventivos Asociados a la Categoría del activo
		  	</div>';
			//echo '<div class="alert alert-danger" role="alert">No tiene Mantenimientos Preventivos Asociados a la Categoría del activo</div>';

		}

	}

	/*=============================================
	OBTENER MANTENIMIENTOS DE LA CATEGORIA
	=============================================*/
	public $idCategoriaCorrec;

	public function ajaxObtenerMantenimientosCategoriaCorrectivos(){

		$tabla = "par_tipo_mantenimiento";
		$item = "id_categoria";
		$valor = $this->idCategoriaCorrec;

		$cadenaMantenimientos = '';

		$informacionCorrec = ControladorTecnologia::ctrObtenerDatosRequeridosAll($tabla, $item, $valor);

		if(!empty($informacionCorrec)){

			foreach($informacionCorrec as $key => $valueCorrectivos){

				if($valueCorrectivos["tipo_mantenimiento"] == "Correctivo"){

					$cadenaMantenimientos .= '<div class="checkbox"><label><input type="checkbox" name="nuevoManteninimientoCorrectivo[]" value="'.$valueCorrectivos["id_tipo_mantenimiento"].'">'.$valueCorrectivos["nombre_mantenimiento"].'</label></div>';

				}

			}

			echo $cadenaMantenimientos;

		}else{
			echo '<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<i class="icon fa fa-ban"></i> No tiene Mantenimientos Correctivos Asociados a la Categoría del activo
		  	</div>';
			//echo '<div class="alert alert-danger" role="alert">No tiene Mantenimientos Preventivos Asociados a la Categoría del activo</div>';

		}

	}

	/*=========================
	QUITAR ASIGNACION RESPONSABLE ACTIVO
	=========================*/
	public $idActivoQuitarAsignacion;

	public function ajaxQuitarAsignacionActivo(){

		$item = "id_activos";
		$valor = $this->idActivoQuitarAsignacion;

		$quitarAsignacionActivo = ControladorTecnologia::ctrQuitarAsignacionActivo($item, $valor);
		
		return json_encode($quitarAsignacionActivo);

	}

}

/*=============================================
OBTENER MANTENIMIENTOS DE LA CATEGORIA PREVENTIVOS
=============================================*/
if(isset($_POST["idCategoriaPreven"])){

	$obtenerManCategoria = new AjaxTecnologia();
	$obtenerManCategoria->idCategoriaPreven = $_POST["idCategoriaPreven"];
	$obtenerManCategoria->ajaxObtenerMantenimientosCategoriaPreventivos();

}

/*=============================================
OBTENER MANTENIMIENTOS DE LA CATEGORIA CORRECTIVOS
=============================================*/
if(isset($_POST["idCategoriaCorrec"])){

	$obtenerManCategoria = new AjaxTecnologia();
	$obtenerManCategoria->idCategoriaCorrec = $_POST["idCategoriaCorrec"];
	$obtenerManCategoria->ajaxObtenerMantenimientosCategoriaCorrectivos();

}

/*=============================================
VALIDAR NUMERO DE PLACA 
=============================================*/

if(isset($_POST["validarTecnologia"])){

	$validarTecnologia = new AjaxTecnologia();
	$validarTecnologia -> validarTecnologia = $_POST["validarTecnologia"];
	$validarTecnologia -> ajaxValidarTecnologia();

}

/*=============================================
EDITAR ACTIVOS 
=============================================*/
if(isset($_POST["idActivo"])){
	
	$objTecnologia =  new AjaxTecnologia(); 
	$objTecnologia -> idActivo = $_POST["idActivo"];
	$objTecnologia -> ajaxEditarTecnologia();	 

}

/*=============================================
MOSTRAR INFORMACION ACTIVO 
=============================================*/
if(isset($_POST["idActivoMostrar"])){
	
	$objTecnologiaMostrar =  new AjaxTecnologia(); 
	$objTecnologiaMostrar -> idActivoMostrar = $_POST["idActivoMostrar"];
	$objTecnologiaMostrar -> ajaxMostrarInformacionActivo();	 

}

/*=============================================
ACTIVAR ACTIVOS
=============================================*/

if(isset($_POST['activarTecnologia'])){

	$activarTecnologia = new AjaxTecnologia();
	$activarTecnologia -> activarTecnologia =$_POST['activarTecnologia'];
	$activarTecnologia -> activarId=$_POST['activarId'];
	$activarTecnologia ->ajaxActivarTecnologia();

}
  
/*=========================
QUITAR ASIGNACION RESPONSABLE ACTIVO
=========================*/
if(isset($_POST["idActivoQuitarAsignacion"])){

	$quitarAsignacion = new AjaxTecnologia();
	$quitarAsignacion->idActivoQuitarAsignacion = $_POST["idActivoQuitarAsignacion"];
	$quitarAsignacion->ajaxQuitarAsignacionActivo();

}