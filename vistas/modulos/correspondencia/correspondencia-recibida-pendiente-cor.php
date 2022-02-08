<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
        Correspondencia Entrante Pendiente Aceptar
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio-cor"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Correspondencia Entrante Pendiente Aceptar</li>
    
    </ol>

  </section>

  <section class="content">

    <!-- INCLUIMOS MENU DE HV -->
    <?php include_once "ui/menu-cor.php"; ?>

    <div class="box box-primary">
        
        <div class="box-body">

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

                <?php if($valueCorrespondenciaRec["estado_asignacion_cor_recibida"] == "Asignada" && $valueCorrespondenciaRec["id_responsable"] == $_SESSION["id_usuario"]): ?>

                  <tr>

                    <td><?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?></td>
                    <td><?php echo $valueCorrespondenciaRec["asunto"]; ?></td>
                    <td><?php echo $valueCorrespondenciaRec["observaciones_cor_recibida"]; ?></td>
                    <td><?php echo $proyecto["nombre_proyecto"]; ?></td>
                    <td><?php echo $usuario["nombres"] . " " . $usuario["apellidos"]; ?></td>
                    <td><?php echo $valueCorrespondenciaRec["tipo_cor_recibida"]; ?></td>
                    <td><button class="btn btn-warning btn-xs"><?php echo $valueCorrespondenciaRec["estado_asignacion_cor_recibida"]; ?></button></td>
                    <td>
                        <div class="btn-group">

                          <button class="btn btn-info btn-xs btnVerAsignacionCorrespondenciaRecibida" data-toggle="modal" data-target="#modalVerAsignacionCorrespondenciaRecibida" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Ver Correspondencia Asignada"><i class="fa fa-eye"></i></button>
                          <button class="btn btn-success btn-xs btnAceptarAsignacionCorrespondencia" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Aceptar Correspondencia"><i class="fas fa-check"></i></button>
                          <button class="btn btn-danger btn-xs btnRechazarAsignacionCorrespondencia" data-toggle="modal" data-target="#modalRechazarAsignacionCorrespondenciaRecibida" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Rechazar Correspondencia"><i class="fas fa-times"></i></button>

                        </div>
                    </td>

                  </tr>

                <?php endif ?>

              <?php endforeach ?>

            </tbody>

          </table>

        </div>

        <div class="box-footer">
            
        </div>

    </div>

    <div class="box box-warning">
        
        <div class="box-body">

          <h4>Bandeja Correspondencia Entrante Re-Asignada</h4>
          
          <hr>

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

                <?php if($valueCorrespondenciaRec["estado_asignacion_cor_recibida"] == "Re-Asignada" && $valueCorrespondenciaRec["id_usuario_re_asignacion_cor_recibida"] == $_SESSION["id_usuario"]): ?>

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
                        <div class="btn-group">

                          <button class="btn btn-info btn-xs btnVerAsignacionCorrespondenciaRecibidaReAsign" data-toggle="modal" data-target="#modalVerAsignacionCorrespondenciaRecibidaReAsign" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Ver Correspondencia Asignada"><i class="fa fa-eye"></i></button>
                          <button class="btn btn-success btn-xs btnAceptarAsignacionCorrespondenciaReAsign" idUsuarioAcepta="<?php echo $_SESSION["id_usuario"]; ?>" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Aceptar Correspondencia"><i class="fas fa-check"></i></button>
                          <button class="btn btn-danger btn-xs btnRechazarAsignacionCorrespondenciaReAsign" data-toggle="modal" data-target="#modalRechazarAsignacionCorrespondenciaRecibidaReAsign" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Rechazar Correspondencia"><i class="fas fa-times"></i></button>

                        </div>
                    </td>

                  </tr>

                <?php endif ?>

              <?php endforeach ?>

            </tbody>

          </table>

        </div>

        <div class="box-footer">
            
        </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL VER INFORMACION CORRESPONDENCIA RE-ASIGNADA
======================================-->

<div id="modalVerAsignacionCorrespondenciaRecibidaReAsign" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Ver Re-Asignacion Correspondencia Entrante</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA ASUNTO -->

            <div class="form-group">

              <label>Asunto:</label>

              <div id="verAsuntoCorRecibidaReAsig"></div>

            </div>
              
            <!-- ENTRADA PARA VER OBSERVACIONES -->
            <div class="form-group">
            
              <label>Observaciones:</label>

              <div id="verObservacionesCorRecibidaReAsig"></div>              

            </div>

            <!-- ENTRADA PARA VER PROYECTO -->
            <div class="form-group">

              <label>Proyecto/Area:</label>

              <div id="verProyectoAreaCorRecibidaReAsig"></div>

            </div>
            
            <!-- ENTRADA PARA VER EL RESPONSABLE -->
            <div class="form-group">

              <label>Responsable:</label>

              <div id="verResponsableCorRecibidaReAsig"></div>

            </div>

            <div class="form-group">

              <label>Tipo Correspondencia Entrante:</label>

              <div id="verTipoCorrespondenciaReAsig"></div>

            </div>

            <!-- ENTRADA PARA CARGAR DOCUMENTO -->
            <div class="form-group">

              <label>Adjuntar Factura/Recibo:</label>

              <div id="verDocumentoAdjuntoCorRecibidaReAsig"></div>

            </div>

            <!-- ENTRADA PARA ESTADO ASIGNACION -->
            <div class="form-group">

              <label>Estado Asignación:</label>

              <div id="verEstadoAsignacionCorRecibidaReAsig"></div>

            </div>

            <div class="form-group">

              <div id="verRadicadoRespuestaReAsig"></div>

            </div>

            <div class="form-group">
              
              <div id="contenedorInformacionUsuarioReAsignacion"></div>
              <div id="contenedorInformacionReAsignacion"></div>

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

            <!-- ENTRADA PARA ASUNTO -->

            <div class="form-group">

              <label>Asunto:</label>

              <div id="verAsuntoCorRecibida"></div>

            </div>
              
            <!-- ENTRADA PARA VER OBSERVACIONES -->
            <div class="form-group">
            
              <label>Observaciones:</label>

              <div id="verObservacionesCorRecibida"></div>              

            </div>

            <div class="form-group">

              <div id="verRadicadoRespuesta"></div>

            </div>

            <!-- ENTRADA PARA VER PROYECTO -->
            <div class="form-group">

              <label>Proyecto/Area:</label>

              <div id="verProyectoAreaCorRecibida"></div>

            </div>
            
            <!-- ENTRADA PARA VER EL RESPONSABLE -->
            <div class="form-group">

              <label>Responsable:</label>

              <div id="verResponsableCorRecibida"></div>

            </div>

            <div class="form-group">

              <label>Tipo Correspondencia Entrante:</label>

              <div id="verTipoCorrespondencia"></div>

            </div>

            <!-- ENTRADA PARA CARGAR DOCUMENTO -->
            <div class="form-group">

              <label>Adjuntar Factura/Recibo:</label>

              <div id="verDocumentoAdjuntoCorRecibida"></div>

            </div>

            <!-- ENTRADA PARA ESTADO ASIGNACION -->
            <div class="form-group">

              <label>Estado Asignación:</label>

              <div id="verEstadoAsignacionCorRecibida"></div>

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
MODAL RECHAZAR CORRESPONDENCIA ASIGNADA
======================================-->

<div id="modalRechazarAsignacionCorrespondenciaRecibida" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Rechazar Correspondencia Entrante</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA ASUNTO -->

            <div class="form-group">

              <label>Asunto:</label>

              <div id="recharzarAsuntoCorRecibida"></div>
              <input type="hidden" id="rechazarIdCorRecibida" name="rechazarIdCorRecibida">

            </div>
              
            <!-- ENTRADA PARA VER OBSERVACIONES -->
            <div class="form-group">
            
              <label>Observaciones:</label>

              <div id="rechazarObservacionesCorRecibida"></div>              

            </div>

            <!-- ENTRADA PARA VER PROYECTO -->
            <div class="form-group">

              <label>Proyecto/Area:</label>

              <div id="rechazarProyectoAreaCorRecibida"></div>

            </div>
            
            <!-- ENTRADA PARA VER EL RESPONSABLE -->
            <div class="form-group">

              <label>Responsable:</label>

              <div id="rechazarResponsableCorRecibida"></div>

            </div>

            <div class="form-group">

              <label>Tipo Correspondencia:</label>

              <div id="rechazarTipoCorrespondencia"></div>

            </div>

            <!-- ENTRADA PARA CARGAR DOCUMENTO -->
            <div class="form-group">

              <label>Adjuntar Factura/Recibo:</label>

              <div id="rechazarDocumentoAdjuntoCorRecibida"></div>

            </div>

            <hr>

            <div class="form-group">

              <label>Observaciones de Rechazamiento de Correspondencia Recibida</label>

              <textarea class="form-control" name="rechazarObservaciones" rows="8" required></textarea>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>
          
          <button type="submit" name="rechazarAsignacionCorRec" class="btn btn-success"><i class="fas fa-save"></i> Rechazar Correspondencia</button>

        </div>

        <?php 

          if(isset($_POST["rechazarAsignacionCorRec"])){

            $rechazarAsig = new ControladorCorrespondencia();
            $rechazarAsig->ctrRechazarCorrespondenciaRecibida();

          }
        
        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL RECHAZAR CORRESPONDENCIA RE-ASIGNADA
======================================-->

<div id="modalRechazarAsignacionCorrespondenciaRecibidaReAsign" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Rechazar Correspondencia Entrante Re-Asignada</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA ASUNTO -->

            <div class="form-group">

              <label>Asunto:</label>

              <div id="recharzarAsuntoCorRecibidaReAsign"></div>
              <input type="hidden" id="rechazarIdCorRecibidaReAsign" name="rechazarIdCorRecibidaReAsign">

            </div>
              
            <!-- ENTRADA PARA VER OBSERVACIONES -->
            <div class="form-group">
            
              <label>Observaciones:</label>

              <div id="rechazarObservacionesCorRecibidaReAsign"></div>              

            </div>

            <!-- ENTRADA PARA VER PROYECTO -->
            <div class="form-group">

              <label>Proyecto/Area:</label>

              <div id="rechazarProyectoAreaCorRecibidaReAsign"></div>

            </div>
            
            <!-- ENTRADA PARA VER EL RESPONSABLE -->
            <div class="form-group">

              <label>Responsable:</label>

              <div id="rechazarResponsableCorRecibidaReAsign"></div>

            </div>

            <div class="form-group">

              <label>Tipo Correspondencia:</label>

              <div id="rechazarTipoCorrespondenciaReAsign"></div>

            </div>

            <!-- ENTRADA PARA CARGAR DOCUMENTO -->
            <div class="form-group">

              <label>Adjuntar Factura/Recibo:</label>

              <div id="rechazarDocumentoAdjuntoCorRecibidaReAsign"></div>

            </div>

            <hr>

            <div class="form-group">

              <label>Observaciones de Rechazamiento de Correspondencia Recibida Re-Asignada</label>

              <textarea class="form-control" name="rechazarObservacionesReAsign" rows="8" required></textarea>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>
          
          <button type="submit" name="rechazarAsignacionCorRecReAsign" class="btn btn-success"><i class="fas fa-save"></i> Rechazar Correspondencia Re-Asignada</button>

        </div>

        <?php 

          if(isset($_POST["rechazarAsignacionCorRecReAsign"])){

            $rechazarAsigReAsign = new ControladorCorrespondencia();
            $rechazarAsigReAsign->ctrRechazarCorrespondenciaRecibidaReAsign();

          }
        
        ?>

      </form>

    </div>

  </div>

</div>