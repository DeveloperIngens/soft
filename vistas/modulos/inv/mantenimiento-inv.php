<div class="content-wrapper">

  <?php 
  
    $ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/vistas/modulos/ui/validacion-permiso.php"; 

    include_once $ruta;
  
  ?>

  <section class="content-header">
    
    <h1>
      
      Administración Mantenimientos Realizados
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio-inv"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administración Mantenimientos Realizados</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- INCLUIMOS MENU DE CORRESPONDENCIA -->
    <?php include_once "ui/menu-inv.php"; ?>

    <div class="box box-info">
        
      <div class="box-body">
          
          <table class="table table-bordered table-striped dt-responsive tablaVerMantenimientos" width="100%">
              
              <thead>
              
                  <tr>
                  
                      <th style="width:10px;">#</th>
                      <th>Responsable</th>
                      <th>Fecha Mantenimiento</th>
                      <th>Fecha Proximo Mantenimiento</th>
                      <th>Número Placa</th>
                      <th>Información Activo</th>
                      <th>Mantenimientos Preventivos</th>
                      <th>Mantenimientos Correctivos</th>
                      <th>Estado Mantenimiento</th>
                      <th style="width: 100px;">Acciones</th>
      
                  </tr> 
      
              </thead>
      
              <tbody>

              <?php 
              
              $tabla = "mantenimiento";
              $item = null;
              $valor = null;
              
              $mantenimietosPreCor = ControladorCorrectivo::ctrObternerDatoRequerido($tabla, $item, $valor);

              foreach($mantenimietosPreCor as $key => $valueMante): 

              ?>

                <?php if($valueMante["estado"] == 1): ?>

                  <tr>
                    
                    <td><?php echo $valueMante["id_calendario"]; ?></td>
                    <td><?php echo $valueMante["responsable"]; ?></td>
                    <td><a class="btn btn-success btn-xs"><?php echo $valueMante["fecha_mante"]; ?></a></td>
                    <td><a class="btn btn-warning btn-xs"><?php echo $valueMante["prox_mante"]; ?></a></td>
                    <td><?php echo $valueMante["placa"]; ?></td>
                    <td><button class="btn bg-navy btn-xs btnVerInformacionActivoMantenimiento" idActivo="<?php echo $valueMante["id_activo"]; ?>" title="Ver Información Activo" data-toggle="modal" data-target="#modalVerInformacionActivoMantenimiento"><i class="fas fa-file-invoice"></i></button></td>
                    <td>
                      <?php 

                        $mantenimientosPreventivo = explode(",", $valueMante["mantenimiento"]);

                        foreach($mantenimientosPreventivo as $key => $valuePreventivo):

                          $tablaPreventivo = "par_tipo_mantenimiento";
                          $itemPreventivo = "id_tipo_mantenimiento";
                          $valorPreventivo = $valuePreventivo;
                          
                          $mantePreventivo = ControladorTecnologia::ctrObternerDatoRequerido($tablaPreventivo, $itemPreventivo, $valorPreventivo);

                      ?>

                      <?php if(!empty($mantePreventivo)): ?>

                        <?php if($mantePreventivo["tipo_mantenimiento"] == "Preventivo"): ?>

                          <a class="btn btn-warning btn-xs" style="margin-bottom: 5px; margin-right: 5px;"><?php echo $mantePreventivo["nombre_mantenimiento"]; ?></a>

                        <?php endif ?>
                      
                      <?php endif ?>

                      <?php endforeach ?>

                    </td>
                    <td>
                      <?php 

                        $mantenimientosCorrectivo = explode(",", $valueMante["mantenimiento"]);

                        foreach($mantenimientosCorrectivo as $key => $valueCorrectivo):

                          $tablaCorrectivo = "par_tipo_mantenimiento";
                          $itemCorrectivo = "id_tipo_mantenimiento";
                          $valorCorrectivo = $valueCorrectivo;
                          
                          $manteCorrectivo = ControladorTecnologia::ctrObternerDatoRequerido($tablaCorrectivo, $itemCorrectivo, $valorCorrectivo);

                      ?>

                      <?php if(!empty($manteCorrectivo)): ?>

                        <?php if($manteCorrectivo["tipo_mantenimiento"] == "Correctivo"): ?>

                          <a class="btn btn-info btn-xs" style="margin-bottom: 5px; margin-right: 5px;"><?php echo $manteCorrectivo["nombre_mantenimiento"]; ?></a>

                        <?php endif ?>
                      
                      <?php endif ?>

                      <?php endforeach ?>

                    </td>
                    
                    <td>
                      
                      <?php if($valueMante["estado_mantenimiento"] == "Pendiente"): ?>

                        <a class="btn btn-warning btn-xs"><?php echo $valueMante["estado_mantenimiento"]; ?></a>

                      <?php elseif($valueMante["estado_mantenimiento"] == "Realizado"): ?>

                        <a class="btn btn-success btn-xs"><?php echo $valueMante["estado_mantenimiento"]; ?></a>

                      <?php endif ?>

                    </td>

                    <td>

                      <?php if($_SESSION["rol_software"] = "administrar"): ?>

                        <?php if($valueMante["estado_mantenimiento"] == "Realizado"): ?>

                          <a class="btn btn-success btn-xs" href="TCPDF/examples/mantenimientoEquipos.php?id=<?php echo $valueMante["id_calendario"]; ?>"  target="_blank" title="Generar .PDF Mantenimiento"><i class="fa fa-file-pdf-o"></i></a>
                        
                        <?php else: ?>

                          <a class="btn btn-default btn-xs"><i class="fa fa-file-pdf-o"></i></a>

                        <?php endif ?>

                        <?php if($valueMante["estado_mantenimiento"] == "Pendiente"): ?>

                          <button class="btn btn-info btn-xs btnRealizarMantenimiento" title="Realizar Mantenimiento" idMantenimiento="<?php echo $valueMante["id_calendario"]; ?>"><i class="fas fa-toolbox"></i></button>

                        <?php else: ?>

                          <button class="btn btn-default btn-xs"><i class="fas fa-toolbox"></i></button>

                        <?php endif ?>

                        <?php if($valueMante["estado_mantenimiento"] == "Realizado"): ?>

                          <button class="btn btn-warning btn-xs btnEditarMantenimiento" data-toggle="modal" data-target="#modalEditarMantenimiento" title="Editar Mantenimiento" idMantenimiento="<?php echo $valueMante["id_calendario"]; ?>" idActivo="<?php echo $valueMante["id_activo"]; ?>"><i class="fas fa-edit"></i></button>

                        <?php else: ?>

                          <button class="btn btn-default btn-xs"><i class="fas fa-edit"></i></button>

                        <?php endif ?>

                        <?php ?>

                        <button class="btn btn-danger btnEliminarMantenimiento btn-xs" title="Eliminar Mantenimiento" idMantenimiento="<?php echo $valueMante["id_calendario"]; ?>"><i class="fa fa-trash"></i></button>
                      
                      <?php else: ?>

                        <button class="btn btn-default btn-xs"><i class="fa fa-file-pdf-o"></i></button>
                        <button class="btn btn-default btn-xs"><i class="fas fa-toolbox"></i></button>
                        <button class="btn btn-default btn-xs"><i class="fa fa-trash"></i></button>

                      <?php endif ?>

                    </td>

                  </tr>

                <?php endif ?>

              <?php endforeach ?>


              </tbody>
      
          </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL INFORMACION ACTIVO
======================================-->
<div id="modalVerInformacionActivoMantenimiento" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Ver Información Activo Mantenimiento</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
              
          <div class="row">

            <div class="col-md-12">

              <div class="panel box box-success">
                <div class="box-header with-border">
                  <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#accordion" style="color: #00a65a;" href="#collapseInfoActivo" class="collapsed" aria-expanded="false">
                      Información del Activo
                    </a>
                  </h4>
                </div>
                <div id="collapseInfoActivo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                  <div class="box-body">

                    <div id="contenedorInfoActivo"></div>

                  </div>
                </div>
              </div>

            </div>

          </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger btn-block" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL INFORMACION ACTIVO
======================================-->
<div id="modalEditarMantenimiento" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Mantenimiento</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

              <div class="col-md-4">

                  <!-- ENTRADA PARA EL RESPONSABLE -->
                  
                  <div class="form-group">

                      <label>Responsable del Mantenimiento:</label>
                      
                      <div class="input-group">
                      
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                          <input type="text" class="form-control" name="editarMantenimientoResponsable" id="editarMantenimientoResponsable" required readonly>

                          <input type="hidden" name="idCalendarioMantenimientoEditar" id="idCalendarioMantenimientoEditar">

                      </div>

                  </div>

              </div>

              <div class="col-md-4">

                  <div class="form-group">

                      <label>Fecha Mantenimiento:</label>
                      
                      <div class="input-group">
                          
                      <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span> 

                      <input type="date" class="form-control" name="fechaMantenimientoEditar" id="fechaMantenimientoEditar" required readonly>

                      </div>

                  </div>

              </div>

              <div class="col-md-4">

                  <!-- ENTRADA PARA LA  PROXIMA FECHA DE MANTENIMIENTO-->

                  <div class="form-group">

                      <label>Fecha de Proximo Mantenimiento:</label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span> 

                          <input type="date" class="form-control" name="fechaProximoMantenimientoEditar" id="fechaProximoMantenimientoEditar" readonly required>

                      </div>

                  </div>

              </div>

            </div>

            <hr>
              
            <div class="row">

              <div class="col-md-12">

                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" style="color: #00a65a;" href="#collapseInfoActivoTecnologiaEditar" class="collapsed" aria-expanded="false">
                        Información del Activo
                      </a>
                    </h4>
                  </div>
                  <div id="collapseInfoActivoTecnologiaEditar" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="box-body">

                      <div id="contenedorInfoActivoMantenimientoEditar"></div>

                    </div>
                  </div>
                </div>

              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-12">

                <label>Mantenimientos Realizados Seleccionados:</label>

                <div id="contenedorMantenimientosEditar"></div>


              </div>

            </div>

            <hr>

            <label>Cambiar Mantenimientos Preventivos/Correctivos Realizados:</label>

            <!-- Entrada para seleccionar los mantenimientos -->
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

                        <div id="contenedorMantenimientosPreventivos"></div>

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

                        <div id="contenedorMantenimientosCorrectivos"></div>

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
                    <textarea type="text" rows="8" class="form-control" name="editarObservacionesMantenimiento" id="editarObservacionesMantenimiento" required onkeyup="mayusculas(this)"></textarea>
                  </div>
                </div>


              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>

          <button type="submit" name="editarMantenimiento" class="btn btn-success"><i class="fas fa-save"></i> Guardar Mantenimiento</button>

        </div>

        <?php 

          if(isset($_POST["editarMantenimiento"])){

            $editarMantenimiento = new ControladorCronograma();
            $editarMantenimiento->CtrEditarMantenimiento();


          }
        
        ?>

      </form>

    </div>

  </div>

</div>

<?php 

$objborrar = new ControladorCronograma();
$objborrar -> CtrBorrarMantenimiento();

 ?>