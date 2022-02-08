<div class="content-wrapper">

    <?php 
  
        $ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/vistas/modulos/ui/validacion-permiso.php"; 

        include_once $ruta;
  
    ?>

  <section class="content-header">
    
    <h1>
      
      Editar Mantenimiento
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio-inv"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Editar Mantenimiento</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- INCLUIMOS MENU DE CORRESPONDENCIA -->
    <?php include_once "ui/menu-inv.php"; ?>



    <div class="box box-info">

        <form role="form" method="post" enctype="multipart/form-data">

            <div class="box-header with-border">

                <h3><center><b>REALIZAR MANTENIMIENTO PROGRAMADO</b></center></h3>

            </div>
            
            <div class="box-body">

                

                <?php 
                
                //OBTENER INFORMACION MANTENIMIENTO
                $tablaMantenimiento = "mantenimiento";
                $itemMantenimiento = "id_calendario";
                $valorMantenimiento = $_GET["idMantenimientoEditar"];

                $mantenimiento = ControladorTecnologia::ctrObternerDatoRequerido($tablaMantenimiento, $itemMantenimiento, $valorMantenimiento);

                //OBTENER INFORMACION ACTIVO
                $tablaActivo = "tecnologia";
                $itemActivo = "id_activos";
                $valorActivo = $mantenimiento["id_activo"];

                $activo = ControladorTecnologia::ctrObternerDatoRequerido($tablaActivo, $itemActivo, $valorActivo);

                //OBTENER INFORMACION PROYECTO
                $tablaProyecto = "par_proyecto";
                $itemProyecto = "id_proyecto";
                $valorProyecto = $activo["proyecto"];

                $proyecto = ControladorTecnologia::ctrObternerDatoRequerido($tablaProyecto, $itemProyecto, $valorProyecto);

                //OBTENER INFORMACION CATEGORIA
                $tablaCategoria = "par_categoria";
                $itemCategoria = "id_categoria";
                $valorCategoria = $activo["categoria"];

                $categoria = ControladorTecnologia::ctrObternerDatoRequerido($tablaCategoria, $itemCategoria, $valorCategoria);

                //OBTENER INFORMACION UBICACION
                $tablaUbicacion = "par_ubicacion";
                $itemUbicacion = "id_ubicacion";
                $valorUbicacion = $activo["ubicacion"];

                $ubicacion = ControladorTecnologia::ctrObternerDatoRequerido($tablaUbicacion, $itemUbicacion, $valorUbicacion);

                ?>

                <div class="row">

                    <div class="col-md-4">

                        <!-- ENTRADA PARA EL RESPONSABLE -->
                        
                        <div class="form-group">

                            <label>Responsable del Mantenimiento:</label>
                            
                            <div class="input-group">
                            
                                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                                <input type="text" class="form-control" name="nuevoResponsableMantenimientoVer" value="<?php echo $_SESSION["nombres"] . " " . $_SESSION["apellidos"]; ?>" required readonly>

                                <input type="hidden" name="idCalendarioMantenimiento" value="<?php echo $mantenimiento["id_calendario"]; ?>">

                                <input type="hidden" id="editarIdActivosss" name="editarIdActivosss">

                                <input type="hidden" id="idActivoMantenimiento" name="idActivoMantenimiento" value="<?php echo $activo["id_activos"]; ?>">

                                <input type="hidden" name="numeroPlacaMantenimiento" id="numeroPlacaMantenimiento" value="<?php echo $activo["numero_placa"]; ?>">

                                <input type="hidden" name="numeroSerialMantenimiento" id="numeroSerialMantenimiento" value="<?php echo $activo["serial"]; ?>">

                                <input type="hidden" name="colorEventoMantenimiento" id="colorEventoMantenimiento" value="<?php echo $mantenimiento["color"]; ?>">

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label>Fecha Mantenimiento:</label>
                            
                            <div class="input-group">
                                
                            <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span> 

                            <input type="date" class="form-control" name="fechaMantenimientoRealizadoVer" required readonly value="<?php echo $mantenimiento["fecha_mante"]; ?>">

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <!-- ENTRADA PARA LA  PROXIMA FECHA DE MANTENIMIENTO-->

                        <div class="form-group">

                            <label>Fecha de Proximo Mantenimiento:</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span> 

                                <input type="date" class="form-control"  name="fechaProximoMantenimiento" id="fechanueva" value="<?php echo $mantenimiento["prox_mante"]; ?>" readonly required>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="row">

                <div class="col-md-12">

                    <div class="panel box box-success">
                    <div class="box-header with-border">
                        <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" style="color: #00a65a;" href="#collapseInfoActivoEditar" class="collapsed" aria-expanded="false">
                            Información del Activo
                        </a>
                        </h4>
                    </div>
                    <div id="collapseInfoActivoEditar" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        <div class="box-body">

                        <div class="row">

                        <div class="col-md-3">

                            <div class="form-group">

                                <label>Número Puesto:</label> <?php echo $activo["numero_puesto"]; ?>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                <label>Punto Red:</label> <?php echo $activo["punto_red"]; ?>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                <label>Proyecto:</label> <?php echo $proyecto["proyecto"]; ?>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                <label>Ubicación:</label> <?php echo $ubicacion["ubicacion"]; ?>

                            </div>

                        </div>

                        </div>

                        <hr>

                        <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Clasificación Activo:</label> <?php echo $activo["clasificacion"]; ?>
                            
                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Categoria Activo:</label> <?php echo $categoria["categoria"]; ?>
                            
                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Marca Activo:</label> <?php echo $activo["marca"]; ?>
                            
                            </div>

                        </div>

                        </div>

                        <hr>

                        <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Número Placa Activo:</label> <?php echo $activo["numero_placa"]; ?>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Serial Activo:</label> <?php echo $activo["serial"]; ?>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Modelo Activo:</label> <?php echo $activo["modelo"]; ?>

                            </div>

                        </div>

                        </div>

                        <hr>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Valor Compra Activo:</label> <?php echo $activo["valor_compra"]; ?>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Valor Comercial Activo:</label> <?php echo $activo["valor_comercial"]; ?>

                                </div>

                            </div>

                        </div>

                        <hr>

                        <div class="row">

                        <div class="col-md-3">

                            <div class="form-group">

                                <label>Procesador Activo:</label> <?php echo $activo["procesador"]; ?>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                <label>Memoria RAM Activo:</label> <?php echo $activo["memoria_ram"]; ?>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                <label>Capacidad Disco Activo:</label> <?php echo $activo["capacidad_disco"]; ?>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                <label>Versión Oficce Activo:</label> <?php echo $activo["version_office"]; ?>

                            </div>

                        </div>

                        </div>

                        </div>
                    </div>
                    </div>

                </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="panel box box-warning">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" style="color: #f39c11;" href="#collapseMantePreventivos" class="collapsed" aria-expanded="false">
                                    Mantenimientos Preventivos
                                </a>
                                </h4>
                            </div>
                            <div id="collapseMantePreventivos" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="box-body">

                                    <div class="form-group">

                                        <?php

                                        $tablaPreventivo = "par_tipo_mantenimiento";
                                        $itemPreventivo = "id_categoria";
                                        $valorPreventivo = $activo["categoria"];

                                        $preventivos = ControladorTecnologia::ctrObtenerDatosRequeridosAll($tablaPreventivo, $itemPreventivo, $valorPreventivo);
                                        
                                        foreach($preventivos as $key => $valuePreventivo):
                                        
                                        ?>

                                            <?php if($valuePreventivo["tipo_mantenimiento"] == "Preventivo"): ?>

                                                <div class="checkbox"><label><input type="checkbox" name="nuevoManteninimientoPreventivo[]" value="<?php echo $valuePreventivo["id_tipo_mantenimiento"]; ?>"><?php echo $valuePreventivo["nombre_mantenimiento"]; ?></label></div>

                                            <?php endif ?>


                                        <?php endforeach ?>
                                        

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel box box-info">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" style="color: #00c0ef;" href="#collapseMantenimientoCorrectivo" class="collapsed" aria-expanded="false">
                                    Mantenimientos Correctivos
                                </a>
                                </h4>
                            </div>
                            <div id="collapseMantenimientoCorrectivo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="box-body">

                                    <div class="form-group">

                                        <?php

                                        $tablaPreventivo = "par_tipo_mantenimiento";
                                        $itemPreventivo = "id_categoria";
                                        $valorPreventivo = $activo["categoria"];

                                        $correctivos = ControladorTecnologia::ctrObtenerDatosRequeridosAll($tablaPreventivo, $itemPreventivo, $valorPreventivo);

                                        foreach($correctivos as $key => $valueCorrectivo):

                                        ?>

                                            <?php if($valueCorrectivo["tipo_mantenimiento"] == "Correctivo"): ?>

                                                <div class="checkbox"><label><input type="checkbox" name="nuevoManteninimientoCorrectivo[]" value="<?php echo $valueCorrectivo["id_tipo_mantenimiento"]; ?>"><?php echo $valueCorrectivo["nombre_mantenimiento"]; ?></label></div>

                                            <?php endif ?>


                                        <?php endforeach ?>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-12">

                        <!-- ENTRADA PARA LAS OBSERVACIONES  -->
                        <div class="form-group">
                            <label>Observaciones del Mantenimiento:</label>
                            <div class="input-group">              
                                <span class="input-group-addon"><i class="fa fa-book"></i></span> 
                                <textarea type="text" rows="8" class="form-control" name="nuevoObservacionesMantenimientoProgramado" id="nuevoObservacionesMantenimientoProgramado" required onkeyup="mayusculas(this)"></textarea>
                            </div>
                        </div>

                    </div>


                </div>
                

            </div>

            <div class="box-footer">

                <button type="submit" name="realizarMantenimientoProgramado" class="btn btn-success pull-left"><i class="fas fa-save"></i> Guardar Mantenimiento</button>

                <button type="submit" name="realizarMantenimientoProgramado" class="btn btn-success pull-right"><i class="fas fa-save"></i> Guardar Mantenimiento</button>
            
            </div>

            <?php 

                if(isset($_POST["realizarMantenimientoProgramado"])){

                    $realizarMantenimiento = new ControladorCronograma();
                    $realizarMantenimiento->ctrRealizarMantenimientoProgramado();

                }

            
            ?>

        </form>

    </div>

  </section>

</div>