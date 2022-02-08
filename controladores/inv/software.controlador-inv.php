<?php

class ControladorSoftware{


	/*=============================================
	MOSTRAR MANTENIMINETOS
	=============================================*/

	static public function ctrMostrarCorrectivo($item , $valor){
		
		$tabla = "par_correctivo_software";

		$respuesta = ModeloSoftware::MdlMostrarSoftware($tabla,$item,$valor);

		return $respuesta;

	}
}
