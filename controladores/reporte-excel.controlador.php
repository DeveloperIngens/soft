<?php

$ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/extensiones/spout-3.3.0/src/Spout/Autoloader/autoload.php";

require_once $ruta;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;


class ControladorReporteExcel{

    /*==========================
    DESCARGAR INFORMACION DE LOS ACTIVOS
    ============================*/
    static public function ctrGenerarExcelInformacionActivos(){

        if(isset($_GET["reporteInformacionActivos"])){

            $writer = WriterEntityFactory::createCSVWriter();

            $writer->setFieldDelimiter(';');

            $writer->openToBrowser('InformacionActivosInventario.csv');

            $data = array(

                'Número Puesto',
                'Punto Red',
                'Categoría',
                'Marca',
                'Clasificación',
                'Número Placa',
                'Serial',
                'Ubicación',
                'Fecha Adquisición',
                'Proyecto',
                'Estado Activo',
                'Observaciones'

            );

            $rowFromValues = WriterEntityFactory::createRowFromArray($data);    
            $writer->addRow($rowFromValues);

            $informacionTecnologia = ControladorTecnologia::ctrGenerarReporteInformacionActivos();

            foreach($informacionTecnologia as $key => $valueTecnologia){

                $infoDatos = array(

                    $valueTecnologia["numero_puesto"],
                    $valueTecnologia["punto_red"],
                    $valueTecnologia["categoria"],
                    $valueTecnologia["marca"],
                    $valueTecnologia["clasificacion"],
                    $valueTecnologia["numero_placa"],
                    $valueTecnologia["serial"],
                    $valueTecnologia["ubicacion"],
                    $valueTecnologia["fecha_adquisicion"],
                    $valueTecnologia["proyecto"],
                    $valueTecnologia["estado_activo"],
                    $valueTecnologia["observaciones"]

                );

                $rowFromValuesData = WriterEntityFactory::createRowFromArray($infoDatos);
                $writer->addRow($rowFromValuesData);

            }

            $writer->close();

        }

    }

    /*==========================
    DESCARGAR TODA LA INFORMACION DE MANTENIMIENTOS REALIZADOS
    ============================*/
    static public function ctrGenerarExcelMantenimientosEquipo(){

        if(isset($_GET["reporteMantenimientosEquipo"])){

            $writer = WriterEntityFactory::createCSVWriter();

            $writer->setFieldDelimiter(';');
    
            $writer->openToBrowser('InformacionMantenimientosEquipo.csv'); // write data to a file or to a PHP stream -- PARA VALIDADR ERRORES CAMBIAR A ".xls"

            $data = array(

                'Responsable Mantenimiento',
                'Fecha Mantenimiento',
                'Número Placa',
                'Número Serial',
                'Mantenimientos Preventivos',
                'Mantenimientos Correctivos',
                'Observaciónes',
                'Estado Mantenimiento'

            );

            $rowFromValues = WriterEntityFactory::createRowFromArray($data);    
            $writer->addRow($rowFromValues);

            $tabla = "mantenimiento";
            $item = "id_activo";
            $valor = $_GET["reporteMantenimientosEquipo"];

            $informacionMantenimientos = ControladorTecnologia::ctrObtenerDatosRequeridosAll($tabla, $item, $valor);

            foreach($informacionMantenimientos as $key => $valueInformacion){

                if(!empty($valueInformacion["mantenimiento"])){

                    $mantenimientos = explode(",", $valueInformacion["mantenimiento"]);
                    
                    $cadenMantenimientosPreventivos = "";
                    $cadenMantenimientosCorrectivos = "";
                    
                    foreach ($mantenimientos as $key => $value){
                    
                    $item ='id_tipo_mantenimiento';
                    $valor = $value;
                    $IDmantenimiento = ControladorCorrectivo::ctrMostrarCorrectivo($item,$valor);
                    
                        if($IDmantenimiento["tipo_mantenimiento"] == "Preventivo"){
                    
                            $cadenMantenimientosPreventivos .= $IDmantenimiento["nombre_mantenimiento"] . ' - ';
                    
                        }else if($IDmantenimiento["tipo_mantenimiento"] == "Correctivo"){
                    
                            $cadenMantenimientosCorrectivos .= $IDmantenimiento["nombre_mantenimiento"] . ' - ';
                    
                        }
                    
                    }
                    
                }else{
                    
                    $cadenMantenimientosPreventivos = "";
                    $cadenMantenimientosCorrectivos = "";    
                    
                }

                $infoDatos = array(

                    $valueInformacion["responsable"],
                    $valueInformacion["fecha_mante"],
                    $valueInformacion["placa"],
                    $valueInformacion["serial"],
                    $cadenMantenimientosPreventivos,
                    $cadenMantenimientosCorrectivos,
                    $valueInformacion["observaciones"],
                    $valueInformacion["estado_mantenimiento"]

                );

                $rowFromValuesData = WriterEntityFactory::createRowFromArray($infoDatos);
                $writer->addRow($rowFromValuesData);

            }

            $writer->close();


        }

    }

    /*==========================
    DESCARGAR TODA LA INFORMACION DATOS PERSONALES
    ============================*/
    public static function ctrGenerarExcelDatosPersonalesTodos2(){

        if(isset($_GET["reporteTodos"])){

            $writer = WriterEntityFactory::createCSVWriter();

            $writer->setFieldDelimiter(';');
    
            $writer->openToBrowser('InformacionDatosPersonales.csv'); // write data to a file or to a PHP stream -- PARA VALIDADR ERRORES CAMBIAR A ".xls"

            $data = array(

                'Tipo Documento',
                'Identificación',
                'Nombres',
                'Apellidos',
                'Fecha Nacimiento',
                'Correo Electrónico',
                'Dirección Residencia',
                'Número Celular 1',
                'Número Celular 2',
                'Teléfono',
                'Profesión',
                'Nacionalidad',
                'Departamento Residencia',
                'Ciudad Residencia'

            );

            $rowFromValues = WriterEntityFactory::createRowFromArray($data);    
            $writer->addRow($rowFromValues);

            $item = null;
            $valor = null;

            $informacionDatosPersonales = ControladorHojaVida::ctrTraerDatosPersonales($item, $valor);

            foreach($informacionDatosPersonales as $key => $valueInformacion){

                $tablaTipoDoc = "par_tipo_documento";
                $itemTipoDoc = "id_tipo_doc";
                $valorTipoDoc = $valueInformacion["tipo_documento_fk"];

                $tipoDocumento = ControladorParametricas::ctrObtenerDatoRequerido($tablaTipoDoc, $itemTipoDoc, $valorTipoDoc);

                $tablaNacionalidad = "par_pais";
                $itemNacionalidad = "cod_pais";
                $valorNacionalidad = $valueInformacion["nacionalidad_fk"];

                $nacionalidad = ControladorParametricas::ctrObtenerDatoRequerido($tablaNacionalidad, $itemNacionalidad, $valorNacionalidad);

                if($valueInformacion["departamento_residencia"] != ""){

                    $tablaDep = "par_ciudades";
                    $itemDep = "cod_dep";
                    $valorDep = $valueInformacion["departamento_residencia"];

                    $departamento = ControladorParametricas::ctrObtenerDatoRequerido($tablaDep, $itemDep, $valorDep);
                
                }else{

                    $departamento["departamento"] = "";

                }


                if($valueInformacion["ciudad_residencia"] != ""){

                    $tablaCiu = "par_ciudades";
                    $itemCiu = "cod_ciudad";
                    $valorCiu = $valueInformacion["ciudad_residencia"];

                    $ciudad = ControladorParametricas::ctrObtenerDatoRequerido($tablaCiu, $itemCiu, $valorCiu);

                }else{

                    $ciudad["ciudad"] = "";

                }

                $infoDatos = array(

                    $tipoDocumento["nombre_tipo_doc"],
                    $valueInformacion["identificacion"],
                    $valueInformacion["nombres"],
                    $valueInformacion["apellidos"],
                    $valueInformacion["fecha_nacimiento"],
                    $valueInformacion["correo_electronico"],
                    $valueInformacion["direccion_residencia"],
                    $valueInformacion["numero_celular"],
                    $valueInformacion["numero_celular_2"],
                    $valueInformacion["numero_telefono"],
                    $valueInformacion["profesion"],
                    $nacionalidad["pais"],
                    $departamento["departamento"],
                    $ciudad["ciudad"]

                );

                $rowFromValuesData = WriterEntityFactory::createRowFromArray($infoDatos);
                $writer->addRow($rowFromValuesData);

            }

            $writer->close();

        }

    }

}