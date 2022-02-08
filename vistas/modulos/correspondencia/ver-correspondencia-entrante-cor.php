<div class="content-wrapper">

  <?php $ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/vistas/modulos/ui/validacion-permiso.php"; 

    include_once $ruta;
  
  ?>

  <section class="content-header">
    
    <h1>
      
        Ver Correspondencia Entrante
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio-cor"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Ver Correspondencia Entrante</li>
    
    </ol>

  </section>

  <section class="content">

    <?php 

      $cantidadCorrespondenciaRec = ControladorCorrespondencia::ctrObtenerCantidadesCorrespondenciaRecibida();
  
    ?>

    <!-- INCLUIMOS MENU DE HV -->
    <?php include_once "ui/menu-cor.php"; ?>

    <div class="panel box box-primary">
      <div class="box-header with-border">
        <h4 class="box-title">
          <a data-toggle="collapse" data-parent="#accordion" style="color: #3c8dbc;" href="#collapseAsignada" class="collapsed" aria-expanded="false">
            Correspondencia Entrante Asignada/Rechazada - <small style="color: #3c8dbc;">Cantidad: <?php echo $cantidadCorrespondenciaRec["CANTIDAD_ASIGNADA"]; ?></small>
          </a>
        </h4>
      </div>
      <div id="collapseAsignada" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
        <div class="box-body">

          <div class="box box-primary">
          
          <div class="box-body">

            <h4>Bandeja Correspondencia Entrante Asignada/Rechazada</h4>
            
            <hr>

            <div class="table-responsive">

            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

              <thead>
                
                <tr>
                  
                  <th style="width:10px">#</th>
                  <th>Asunto</th>
                  <th>Observaciones</th>
                  <th>Proyecto</th>
                  <th>Responsable</th>
                  <th>Tipo Correspondencia</th>
                  <th>Estado Asignacion</th>
                  <th>Acciones</th>
      
                </tr> 
      
              </thead>

              <tbody>

                <?php 

                  $tabla = "correspondencia_recibida";
                  $item = null;
                  $valor = null;

                  $correspondenciaRec = ControladorCorrespondencia::ctrMostrarCorrespondenciaRequerida($tabla, $item, $valor);

                  foreach($correspondenciaRec as $key => $valueCorrespondenciaRec):

                  $itemUsuario = "id_usuario";
                  $valorUsuario = $valueCorrespondenciaRec["id_responsable"];
                  
                  $usuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                  $tablaProyecto = "proyectos_cor";
                  $itemProyecto = "id_proyecto";
                  $valorProyecto = $valueCorrespondenciaRec["id_proyecto"];

                  $proyecto = ControladorParametricasCor::ctrObtenerDatoRequerido($tablaProyecto, $itemProyecto, $valorProyecto);
                
                ?>

                  <?php if($_SESSION["rol_software"] == "administrador" && $valueCorrespondenciaRec["estado_asignacion_cor_recibida"] == "Asignada" || $valueCorrespondenciaRec["estado_asignacion_cor_recibida"] == "Rechazada"): ?>

                    <tr>

                      <td><?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?></td>
                      <td><?php echo $valueCorrespondenciaRec["asunto"]; ?></td>
                      <td><?php echo $valueCorrespondenciaRec["observaciones_cor_recibida"]; ?></td>
                      <td><?php echo $proyecto["nombre_proyecto"]; ?></td>
                      <td><?php echo $usuario["nombres"] . " " . $usuario["apellidos"]; ?></td>
                      <td><?php echo $valueCorrespondenciaRec["tipo_cor_recibida"]; ?></td>
                      <?php if($valueCorrespondenciaRec["estado_asignacion_cor_recibida"] == "Asignada"): ?>

                        <td><button class="btn btn-warning btn-xs"><?php echo $valueCorrespondenciaRec["estado_asignacion_cor_recibida"]; ?></button></td>
                      
                      <?php elseif($valueCorrespondenciaRec["estado_asignacion_cor_recibida"] == "Rechazada"): ?>

                        <td><button class="btn btn-danger btn-xs"><?php echo $valueCorrespondenciaRec["estado_asignacion_cor_recibida"]; ?></button></td>

                      <?php endif ?>

                      <td>
                        
                        <button class="btn btn-info btn-xs btnVerAsignacionCorrespondenciaRecibidaVer" data-toggle="modal" data-target="#modalVerAsignacionCorrespondenciaRecibidaVer" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Ver Correspondencia Asignada"><i class="fa fa-eye"></i></button>
                        <button class="btn btn-warning btn-xs btnEditarResponsableAsignacion" data-toggle="modal" data-target="#modalEditarResponsableAsignacion" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Editar Correspondencia Asignada"><i class="fas fa-user-cog"></i></button>

                      </td>


                    </tr>

                  <?php endif ?>

                <?php endforeach ?>

              </tbody>

            </table>

            </div>

          </div>

          <div class="box-footer">
              
          </div>

        </div>

        </div>
      </div>
    </div>

    <div class="panel box box-success">
      <div class="box-header with-border">
        <h4 class="box-title">
        <a data-toggle="collapse" style="color: #00a65a;" data-parent="#accordion" href="#collapseCorAcep" aria-expanded="false" class="collapsed">
            Correspondencia Entrante Aceptada - <small style="color: #00a65a;">Cantidad: <?php echo $cantidadCorrespondenciaRec["CANTIDAD_ACEPTADA"]; ?></small>
          </a>
        </h4>
      </div>
      <div id="collapseCorAcep" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
        <div class="box-body">
          
        <div class="box box-success">
        
        <div class="box-body">

          <h4>Bandeja Correspondencia Entrante Aceptada</h4>
          
          <hr>

          <div class="table-responsive">

          <table class="table table-bordered table-striped dt-responsive tablasCorrespondenciaRecibida" width="100%">

            <thead>
              
              <tr>
                
                <th style="width:10px">#</th>
                <th>Asunto</th>
                <th>Observaciones</th>
                <th>Proyecto</th>
                <th>Responsable</th>
                <th>Tipo Correspondencia</th>
                <th>Estado Correspondencia</th>
                <th>Re-Asignar</th>
                <th>Acciones</th>
    
              </tr> 
    
            </thead>

            <tbody>

              <?php 

                $tabla = "correspondencia_recibida";
                $item = null;
                $valor = null;

                $correspondenciaRec = ControladorCorrespondencia::ctrMostrarCorrespondenciaRequerida($tabla, $item, $valor);

                foreach($correspondenciaRec as $key => $valueCorrespondenciaRec):

                $itemUsuario = "id_usuario";
                $valorUsuario = $valueCorrespondenciaRec["id_responsable"];
                
                $usuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                $tablaProyecto = "proyectos_cor";
                $itemProyecto = "id_proyecto";
                $valorProyecto = $valueCorrespondenciaRec["id_proyecto"];

                $proyecto = ControladorParametricasCor::ctrObtenerDatoRequerido($tablaProyecto, $itemProyecto, $valorProyecto);
              
              ?>

                <?php if($valueCorrespondenciaRec["estado_asignacion_cor_recibida"] == "Aceptada" || $valueCorrespondenciaRec["estado_asignacion_cor_recibida"] == "Re-Asignada-Rechaza"): ?>

                    <tr>

                      <td><?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?></td>
                      <td><?php echo $valueCorrespondenciaRec["asunto"]; ?></td>
                      <td><?php echo $valueCorrespondenciaRec["observaciones_cor_recibida"]; ?></td>
                      <td><?php echo $proyecto["nombre_proyecto"]; ?></td>
                      <td><?php echo $usuario["nombres"] . " " . $usuario["apellidos"]; ?></td>
                      <td><?php echo $valueCorrespondenciaRec["tipo_cor_recibida"]; ?></td>
                      <td>
                        <?php if($valueCorrespondenciaRec["estado_cor_recibida"] == "Sin Gestion"): ?>

                          <button class="btn btn-warning btn-xs"><?php echo $valueCorrespondenciaRec["estado_cor_recibida"]; ?></button>

                        <?php elseif($valueCorrespondenciaRec["estado_cor_recibida"] == "Gestionada"): ?>

                          <button class="btn btn-success btn-xs"><?php echo $valueCorrespondenciaRec["estado_cor_recibida"]; ?></button>
                        
                        <?php endif ?>

                      </td>
                      
                      <td>
                        

                        <?php if($valueCorrespondenciaRec["estado_cor_recibida"] != "Gestionada"): ?>

                          <button class="btn btn-warning btn-xs btnReAsignarCorrespondenciaRecibida" data-toggle="modal" data-target="#modalReAsignacionCorrespondenciaRecibida" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Re-Asignar Correspondencia Recibida"><i class="fas fa-user-tag"></i></button>
                          <button class="btn btn-warning btn-xs btnReAsignarCorrespondenciaRecibidaProyecto" data-toggle="modal" data-target="#modalReAsignacionCorrespondenciaRecibidaProyecto" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Re-Asignar Correspondencia Recibida"><i class="fas fa-project-diagram"></i></button>

                        <?php else: ?>

                          <button class="btn btn-default btn-xs"><i class="fas fa-user-tag"></i></button>
                          <button class="btn btn-default btn-xs"><i class="fas fa-project-diagram"></i></button>

                        <?php endif ?>

                      </td>

                      <td>

                        <button class="btn btn-info btn-xs btnVerAsignacionCorrespondenciaRecibidaVer" data-toggle="modal" data-target="#modalVerAsignacionCorrespondenciaRecibidaVer" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Ver Correspondencia Asignada"><i class="fa fa-eye"></i></button>

                        <?php if($valueCorrespondenciaRec["tipo_cor_recibida"] == "Radicados/Respuestas" && $valueCorrespondenciaRec["estado_cor_recibida"] != "Gestionada"): ?>

                          <button class="btn btn-success btn-xs btnGestionarRadicadoRespuesta" data-toggle="modal" data-target="#modalGestionarRadicadoRespuesta" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Gestionar Radicado/Respuesta"><i class="fas fa-paste"></i></button>

                        <?php elseif($valueCorrespondenciaRec["tipo_cor_recibida"] == "Facturas/Recibos"): ?>

                          <button class="btn btn-success btn-xs btnEnviarFacturaRecibio" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" data-toggle="modal" data-target="#modalEnviarFacturaReciboGestionAdminFinan" title="Envia Factura/Recibo Gestion Admin/Financiera"><i class="fas fa-cash-register"></i></button>

                        <?php endif ?>

                      </td>

                    </tr>

                <?php endif ?>

              <?php endforeach ?>

            </tbody>

          </table>

          </div>

        </div>

        <div class="box-footer">
            
        </div>

        </div>


        </div>
      </div>
    </div>

      <div class="panel box box-warning">
        <div class="box-header with-border">
          <h4 class="box-title">
            <a data-toggle="collapse" style="color: #f39c12;" data-parent="#accordion" href="#collapseCorReAsig" aria-expanded="false" class="collapsed">
              Correspondencia Entrante Re-Asignada - <small style="color: #f39c12;">Cantidad: <?php echo $cantidadCorrespondenciaRec["CANTIDAD_RE_ASIGNADA"]; ?></small>
            </a>
          </h4>
        </div>
        <div id="collapseCorReAsig" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
          <div class="box-body">

          <div class="box box-warning">
        
            <div class="box-body">

              <h4>Bandeja Correspondencia Entrante Re-Asignada</h4>
              
              <hr>

              <div class="table-responsive">

              <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

                <thead>
                  
                  <tr>
                    
                    <th style="width:10px">#</th>
                    <th>Asunto</th>
                    <th>Observaciones</th>
                    <th>Proyecto</th>
                    <th>Responsable</th>
                    <th>Re-Asignacion</th>
                    <th>Tipo Correspondencia</th>
                    <th>Estado Asignacion</th>
                    <th>Acciones</th>
        
                  </tr> 
        
                </thead>

                <tbody>

                  <?php 

                    $tabla = "correspondencia_recibida";
                    $item = null;
                    $valor = null;

                    $correspondenciaRec = ControladorCorrespondencia::ctrMostrarCorrespondenciaRequerida($tabla, $item, $valor);

                    foreach($correspondenciaRec as $key => $valueCorrespondenciaRec):

                    $itemUsuario = "id_usuario";
                    $valorUsuario = $valueCorrespondenciaRec["id_responsable"];
                    
                    $usuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                    $itemUsuarioReAsign = "id_usuario";
                    $valorUsuarioReAsign = $valueCorrespondenciaRec["id_usuario_re_asignacion_cor_recibida"];
                    
                    $usuarioReAsign = ControladorUsuarios::ctrMostrarUsuarios($itemUsuarioReAsign, $valorUsuarioReAsign);

                    $tablaProyecto = "proyectos_cor";
                    $itemProyecto = "id_proyecto";
                    $valorProyecto = $valueCorrespondenciaRec["id_proyecto"];

                    $proyecto = ControladorParametricasCor::ctrObtenerDatoRequerido($tablaProyecto, $itemProyecto, $valorProyecto);
                  
                  ?>

                    <?php if($valueCorrespondenciaRec["estado_asignacion_cor_recibida"] == "Re-Asignada"): ?>

                      <tr>

                        <td><?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?></td>
                        <td><?php echo $valueCorrespondenciaRec["asunto"]; ?></td>
                        <td><?php echo $valueCorrespondenciaRec["observaciones_cor_recibida"]; ?></td>
                        <td><?php echo $proyecto["nombre_proyecto"]; ?></td>
                        <td><?php echo $usuario["nombres"] . " " . $usuario["apellidos"]; ?></td>
                        <td><?php echo $usuarioReAsign["nombres"] . " " . $usuarioReAsign["apellidos"]; ?></td>
                        <td><?php echo $valueCorrespondenciaRec["tipo_cor_recibida"]; ?></td>
                        <td><button class="btn btn-warning btn-xs"><?php echo $valueCorrespondenciaRec["estado_asignacion_cor_recibida"]; ?></button></td>
                        <td>

                          <button class="btn btn-info btn-xs btnVerAsignacionCorrespondenciaRecibidaVer" data-toggle="modal" data-target="#modalVerAsignacionCorrespondenciaRecibidaVer" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Ver Correspondencia Asignada"><i class="fa fa-eye"></i></button>
                          <button class="btn btn-success btn-xs btnAceptarAsignacionCorrespondenciaReAsign" idUsuarioAcepta="<?php echo $_SESSION["id_usuario"]; ?>" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Aceptar Correspondencia"><i class="fas fa-check"></i></button>
                          <button class="btn btn-danger btn-xs btnRechazarAsignacionCorrespondenciaReAsign" data-toggle="modal" data-target="#modalRechazarAsignacionCorrespondenciaRecibidaReAsign" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Rechazar Correspondencia"><i class="fas fa-times"></i></button>

                        </td>

                      </tr>

                    <?php endif ?>

                  <?php endforeach ?>

                </tbody>

              </table>

              </div>

            </div>

            <div class="box-footer">
                
            </div>

          </div>
            
          </div>

        </div>

      </div>

  </section>

</div>

<!--=====================================
MODAL CARGAR CORRESPONDENCIA FACTURA/RECIBO
======================================-->
<div id="modalCargarFactura" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Cargar Correspondencia Entrante Facturas/Recibos</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA ASUNTO -->

            <div class="form-group">

              <label>Asunto:</label>

              <input type="text" class="form-control" name="nuevoAsuntoCorRec" required>


            </div>
              
            <!-- ENTRADA PARA OBSERVACIONES -->
            <div class="form-group">
            
              <label>Observaciones:</label>

              <textarea class="form-control" name="nuevaObservacionCorRec" required></textarea>
              

            </div>

            <!-- ENTRADA PARA SELECCION PROYECTO -->
            <div class="form-group">

              <label>Proyecto/Area:</label>

              <select name="nuevoProyectoCorRec" class="form-control" id="nuevoProyectoCorRec" required>

                <option value="">-- Seleccione una opcion --</option>

                <?php 
                
                $tablaProyecto = "proyectos_cor";
                $itemProyecto = null;
                $valorProyecto = null;

                $proyectos = ControladorParametricasCor::ctrObtenerDatoRequerido($tablaProyecto, $itemProyecto, $valorProyecto);
                
                foreach($proyectos as $key => $valueProyectos): ?>

                  <?php if($valueProyectos["id_proyecto"] != 23 && $valueProyectos["id_proyecto"] != 24): ?>

                  <option value="<?php echo $valueProyectos["id_proyecto"]; ?>"><?php echo $valueProyectos["nombre_proyecto"]; ?></option>

                  <?php endif ?>

                <?php endforeach ?>

              </select>

            </div>
            
            <!-- ENTRADA PARA RESPONSABLE PROYECTO -->
            <div id="contenedorResponsable"></div>
            <input type="hidden" id="idNuevoResponsableProyecto" name="idNuevoResponsableProyecto">

            <!-- ENTRADA PARA CARGAR DOCUMENTO -->
            <div class="form-group">

              <label>Adjuntar Factura:</label>

              <input type="file" class="form-control" name="nuevoDocumentoProyectoCorRec[]" id="nuevoDocumentoProyectoCorRec" accept="application/pdf, .doc, .docx" required>

            </div>

            <div class="form-group">

              <label>Tipo Correspondencia Entrante:</label>

              <select class="form-control" name="nuevoTipoCorRec" required>

                <option value="">-- Seleccione una opcion --</option>
                <option value="Facturas/Recibos">Facturas/Recibos</option>
                <option value="Radicados/Respuestas">Radicados/Respuestas</option>

              </select>

            </div>

            <!-- ENTRADA PARA ESTADO ASIGNACION -->
            <div class="form-group">

              <label>Estado Asignación:</label>

              <button class="btn btn-warning">Asignada</button>

            </div>  
            
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>
          <button type="submit" name="cargarFacturaCorRec" class="btn btn-success"><i class="fas fa-save"></i> Guardar Factura</button>
        </div>

        <?php 
        
          if(isset($_POST["cargarFacturaCorRec"])){

            $cargarFactura = new ControladorCorrespondencia();
            $cargarFactura->ctrCargarFacturaCorRec();


          }
        
        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL VER INFORMACION CORRESPONDENCIA
======================================-->
<div id="modalVerAsignacionCorrespondenciaRecibida" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Ver Asignacion Correspondencia Entrante</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

              <div class="col-md-6">

                <!-- ENTRADA PARA ASUNTO -->

                <div class="form-group">

                  <label>Asunto:</label>

                  <div id="verAsuntoCorRecibida"></div>

                </div>

              </div>

              <div class="col-md-6">
                  
                <!-- ENTRADA PARA VER OBSERVACIONES -->
                <div class="form-group">
                
                  <label>Observaciones:</label>

                  <div id="verObservacionesCorRecibida"></div>              

                </div>

              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-6">

                <!-- ENTRADA PARA VER PROYECTO -->
                <div class="form-group">

                  <label>Proyecto/Area:</label>

                  <div id="verProyectoAreaCorRecibida"></div>

                </div>
              
              </div>

              <div class="col-md-6">
                
                <!-- ENTRADA PARA VER EL RESPONSABLE -->
                <div class="form-group">

                  <label>Responsable:</label>

                  <div id="verResponsableCorRecibida"></div>

                </div>

              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <label>Tipo Correspondencia Entrante:</label>

                  <div id="verTipoCorrespondencia"></div>

                </div>

              </div>

              <div class="col-md-6">

                <!-- ENTRADA PARA CARGAR DOCUMENTO -->
                <div class="form-group">

                  <label>Documento Adjunto Correspondencia Recibida:</label>

                  <div id="verDocumentoAdjuntoCorRecibida"></div>

                </div>

              </div>

            </div>

            <!-- ENTRADA PARA ESTADO ASIGNACION -->
            <div class="form-group">

              <label>Estado Asignación:</label>

              <div id="verEstadoAsignacionCorRecibida"></div>

            </div>

            <div class="form-group">

              <div id="verRadicadoRespuesta"></div>

            </div>
            

            <!-- VER OBSERVACIONES DE RECHAZAMIENTO -->
            <div class="form-group">

              <div id="verObservacionesRechazamiento"></div>
            
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
MODAL EDITAR RESPONSABLE CORRESPONDENCIA RECIBIDA
======================================-->
<div id="modalEditarResponsableAsignacion" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Correspondencia Entrante Factura/Recibo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA ASUNTO -->

            <div class="form-group">

              <label>Asunto:</label>

              <input type="text" class="form-control" name="editarAsuntoCorRec" id="editarAsuntoCorRec" required>

              <input type="hidden" name="editarIdResponsableCorRec" id="editarIdResponsableCorRec">

              <input type="hidden" name="idEditarCorRec" id="idEditarCorRec">

            </div>
              
            <!-- ENTRADA PARA VER OBSERVACIONES -->

            <div class="form-group">
            
              <label>Observaciones:</label>

              <textarea class="form-control" name="editarObservacionesCorRec" id="editarObservacionesCorRec"></textarea>

            </div>

            <!-- ENTRADA PARA VER PROYECTO -->
            <hr>

            <div class="form-group">

              <label>Proyecto/Area:</label>

              <input type="text" class="form-control" id="editarProyectoCorRecAnterior" name="editarProyectoCorRecAnterior" readonly>

            </div>

            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <label>Proyecto/Area Cambio:</label>

                  <select class="form-control" name="editarProyectoCorRecNuevo" id="editarProyectoCorRecNuevo" required>

                    <option value="">-- Seleccione una opcion --</option>

                    <?php 
                    
                    $tablaProyecto = "proyectos_cor";
                    $itemProyecto = null;
                    $valorProyecto = null;

                    $proyectos = ControladorParametricasCor::ctrObtenerDatoRequerido($tablaProyecto, $itemProyecto, $valorProyecto);
                    
                    foreach($proyectos as $key => $valueProyectos): ?>

                      <?php if($valueProyectos["id_proyecto"] != 23 && $valueProyectos["id_proyecto"] != 24): ?>

                      <option value="<?php echo $valueProyectos["id_proyecto"]; ?>"><?php echo $valueProyectos["nombre_proyecto"]; ?></option>

                      <?php endif ?>

                    <?php endforeach ?>

                  </select>

                </div>

              </div>

              <div class="col-md-6">
                
                <!-- ENTRADA PARA VER EL RESPONSABLE -->
                <div class="form-group">
                  
                  <label>Responsable:</label>

                  <input type="text" class="form-control" name="editarResponsableCorRec" id="editarResponsableCorRec" readonly>

                </div>

              </div>

            </div>

            <div class="row">
                
              <div class="col-md-6">

                <div class="form-group">

                  <label>Tipo Correspondencia Entrante:</label>

                  <select class="form-control" name="editarTipoCorRec" required>

                    <option id="editarTipoCorRec"></option>
                    <optgroup label="-- Mas Opciones --"></optgroup>
                    <option value="Facturas/Recibos">Facturas/Recibos</option>
                    <option value="Radicados/Respuestas">Radicados/Respuestas</option>

                  </select>

                </div>

              </div>

              <div class="col-md-6">

                <!-- ENTRADA PARA CARGAR DOCUMENTO -->
                <div class="form-group">

                  <label>Documento Adjunto Correspondencia Recibida:</label>

                  <div id="editarDocumentoAdjuntoCorRecibida"></div>

                </div>

              </div>

            </div>

            <hr>

            <!-- ENTRADA PARA ESTADO ASIGNACION -->
            <div class="form-group">

              <label>Estado Asignación:</label>

              <div id="editarEstadoAsignacionCorRecibida"></div>

            </div>  

            <!-- ENTRADA PARA OBSERVACION RECHAZAMIENTO -->
            <div class="form-group">

              <div id="editarObservacionRechazamiento"></div>

            </div>  
            
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>
          <button type="submit" name="editarCorRec" class="btn btn-success"><i class="fas fa-save"></i> Guardar Factura/Recibo</button>

          <?php 

            if(isset($_POST["editarCorRec"])){

              $editarCorRec = new ControladorCorrespondencia();
              $editarCorRec->ctrEditarFacturaCorRec();

            }
          
          ?>

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL CARGAR CORRESPONDENCIA FACTURA/RECIBO
======================================-->
<div id="modalCargarRadicadosRespuesta" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Cargar Correspondencia Entrante Radicados/Respuestas</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA ASUNTO -->

            <div class="form-group">

              <label>Asunto:</label>

              <input type="text" class="form-control" name="nuevoAsuntoCorRecRad" required>


            </div>
              
            <!-- ENTRADA PARA OBSERVACIONES -->
            <div class="form-group">
            
              <label>Observaciones:</label>

              <textarea class="form-control" name="nuevaObservacionCorRecRad" required></textarea>
              
            </div>

            <div class="form-group">

              <label>Radicación Enviada:</label>

              <select class="form-control select2" style="width: 100%;" name="nuevoRadicadoCorRecRad" id="nuevoRadicadoCorRecRad" required>

                <option>-- Seleccione una opcion --</option>

                <?php 
                
                $tabla = "correspondencia_enviada";
                $item = null;
                $valor = null;

                $correspondenciaEnviada = ControladorCorrespondencia::ctrMostrarCorrespondenciaRequerida($tabla, $item, $valor);

                foreach($correspondenciaEnviada as $key => $valueCorEnv): ?>

                  <?php if($valueCorEnv["estado"] == "Radicado"): ?>
                  
                    <option value="<?php echo $valueCorEnv["id_cor_enviado"]; ?>"><?php echo $valueCorEnv["codigo"] . " - " . $valueCorEnv["radicado"]; ?></option>
                  
                  <?php endif ?>

                <?php endforeach ?>

              </select>

            </div>

            <!--  ENTRADA DE PROYECTO -->
            <div class="form-group">

                <div id="contenedorCorRecRadProyecto"></div>
                <input type="hidden" name="idProyectoCorRadProyecto" id="idProyectoCorRadProyecto">
                <input type="hidden" name="idCorRadResponsable" id="idCorRadResponsable">
                  
            </div>

            <!--  ENTRADA DE RESPONSABLE -->
            <div class="form-group">

                <div id="contenedorCorRecRadResponsable"></div>
                
            </div>

            <!-- ENTRADA PARA CARGAR DOCUMENTO -->
            <div class="form-group">

              <label>Adjuntar Documento:</label>

              <input type="file" class="form-control" name="nuevoDocumentoProyectoCorRecRad[]" id="nuevoDocumentoProyectoCorRecRad" accept="application/pdf, .doc, .docx" required>

            </div>

            <div class="form-group">

              <label>Tipo Correspondencia Entrante:</label>

              <select class="form-control" name="nuevoTipoCorRecRad" required>

                <option value="">-- Seleccione una opcion --</option>
                <option value="Facturas/Recibos">Facturas/Recibos</option>
                <option value="Radicados/Respuestas">Radicados/Respuestas</option>

              </select>

            </div>

            <!-- ENTRADA PARA ESTADO ASIGNACION -->
            <div class="form-group">

              <label>Estado Asignación:</label>

              <button class="btn btn-warning">Asignada</button>

            </div> 

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>
          <button type="submit" name="cargarFacturaCorRecRad" class="btn btn-success"><i class="fas fa-save"></i> Guardar Radicado/Respuesta</button>
        </div>

        <?php 
        
          if(isset($_POST["cargarFacturaCorRecRad"])){

            $cargarRadicadoRes = new ControladorCorrespondencia();
            $cargarRadicadoRes->ctrCargarRadicadoRespuesta();

          }
        
        ?>

      </form>

    </div>

  </div>

</div>


<div id="modalVerAsignacionCorrespondenciaRecibidaVer" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Ver Correspondencia Entrante</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <div class="row">

              <div class="col-md-6">

                <!-- ENTRADA PARA ASUNTO -->

                <div class="form-group">

                  <label>Asunto:</label>

                  <div id="verAsuntoCorRecibidaReAsigAdmin"></div>

                  </div>

                </div>

              <div class="col-md-6">

                <!-- ENTRADA PARA VER OBSERVACIONES -->
                <div class="form-group">
            
                  <label>Observaciones:</label>

                  <div id="verObservacionesCorRecibidaReAsigAdmin"></div>              

                </div>

              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-6">

                <!-- ENTRADA PARA VER PROYECTO -->
                <div class="form-group">

                  <label>Proyecto/Area:</label>

                  <div id="verProyectoAreaCorRecibidaReAsigAdmin"></div>

                </div>


              </div>

              <div class="col-md-6">

                <!-- ENTRADA PARA VER EL RESPONSABLE -->
                <div class="form-group">

                  <label>Responsable:</label>

                  <div id="verResponsableCorRecibidaReAsigAdmin"></div>

                </div>

              </div>

            </div>
            
            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <label>Tipo Correspondencia Entrante:</label>

                  <div id="verTipoCorrespondenciaReAsigAdmin"></div>

                </div>

              </div>

              <div class="col-md-6">

                <!-- ENTRADA PARA CARGAR DOCUMENTO -->
                <div class="form-group">

                  <label>Documento Adjunto:</label>

                  <div id="verDocumentoAdjuntoCorRecibidaReAsigAdmin"></div>

                </div>

              </div>

            </div>

            <hr>

            <!-- ENTRADA PARA ESTADO ASIGNACION -->
            <div class="form-group">

              <label>Estado Asignación:</label>

              <div id="verEstadoAsignacionCorRecibidaReAsigAdmin"></div>

            </div>

            <div class="form-group">

              <div id="verRadicadoRespuestaReAsigAdmin"></div>

            </div>

            <div class="form-group">
              
              <div id="verObservacionesGestionRadicadoRespuestaAdmin"></div>
              
            </div>

            <div class="form-group">
              
              <div id="contenedorInformacionUsuarioReAsignacionAdmin"></div>
              <div id="contenedorInformacionReAsignacionAdmin"></div>

            </div>

            <div class="form-group">
              
              <div id="tituloRechazamiento"></div>
              <div id="verUsuarioRechazamientoAdmin"></div>
              <div id="verObservacionesRechazamientoAdmin"></div>
              
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
