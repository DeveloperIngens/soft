<div class="content-wrapper">

  <?php $ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/vistas/modulos/ui/validacion-permiso.php"; 

  include_once $ruta;

  ?>

  <section class="content-header">
    
    <h1>
      
      Mi Correspondencia Recibida
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio-cor"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Mi Correspondencia Recibida</li>
    
    </ol>

  </section>

  <section class="content">

    <!-- INCLUIMOS MENU DE HV -->
    <?php include_once "ui/menu-cor.php"; ?>


    <div class="box box-success">
        
        <div class="box-body">

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

                  <?php if($valueCorrespondenciaRec["id_responsable"] == $_SESSION["id_usuario"]): ?>

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

                        <button class="btn btn-info btn-xs btnVerAsignacionCorrespondenciaRecibida" data-toggle="modal" data-target="#modalVerAsignacionCorrespondenciaRecibida" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Ver Correspondencia Asignada"><i class="fa fa-eye"></i></button>

                        <?php if($valueCorrespondenciaRec["tipo_cor_recibida"] == "Radicados/Respuestas" && $valueCorrespondenciaRec["estado_cor_recibida"] != "Gestionada"): ?>

                          <button class="btn btn-success btn-xs btnGestionarRadicadoRespuesta" data-toggle="modal" data-target="#modalGestionarRadicadoRespuesta" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Gestionar Radicado/Respuesta"><i class="fas fa-paste"></i></button>

                        <?php elseif($valueCorrespondenciaRec["tipo_cor_recibida"] == "Facturas/Recibos"): ?>

                          <button class="btn btn-success btn-xs btnEnviarFacturaRecibio" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" data-toggle="modal" data-target="#modalEnviarFacturaReciboGestionAdminFinan" title="Envia Factura/Recibo Gestion Admin/Financiera"><i class="fas fa-cash-register"></i></button>

                        <?php endif ?>

                      </td>

                    </tr>

                  <?php endif ?>

                <?php endif ?>

              <?php endforeach ?>

            </tbody>

          </table>

        </div>

        <div class="box-footer">
            
        </div>

      </div>



      <div class="box box-primary">
        
        <div class="box-body">

          <h4>Bandeja Correspondencia Entrante Asignada</h4>

          <hr>

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

                      <button class="btn btn-info btn-xs btnVerAsignacionCorrespondenciaRecibida" data-toggle="modal" data-target="#modalVerAsignacionCorrespondenciaRecibida" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Ver Correspondencia Asignada"><i class="fa fa-eye"></i></button>
                      <button class="btn btn-success btn-xs btnAceptarAsignacionCorrespondencia" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Aceptar Correspondencia"><i class="fas fa-check"></i></button>
                      <button class="btn btn-danger btn-xs btnRechazarAsignacionCorrespondencia" data-toggle="modal" data-target="#modalRechazarAsignacionCorrespondenciaRecibida" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Rechazar Correspondencia"><i class="fas fa-times"></i></button>

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

                      <button class="btn btn-info btn-xs btnVerAsignacionCorrespondenciaRecibidaReAsign" data-toggle="modal" data-target="#modalVerAsignacionCorrespondenciaRecibidaReAsign" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Ver Correspondencia Asignada"><i class="fa fa-eye"></i></button>
                      <button class="btn btn-success btn-xs btnAceptarAsignacionCorrespondenciaReAsign" idUsuarioAcepta="<?php echo $_SESSION["id_usuario"]; ?>" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Aceptar Correspondencia"><i class="fas fa-check"></i></button>
                      <button class="btn btn-danger btn-xs btnRechazarAsignacionCorrespondenciaReAsign" data-toggle="modal" data-target="#modalRechazarAsignacionCorrespondenciaRecibidaReAsign" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Rechazar Correspondencia"><i class="fas fa-times"></i></button>

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
MODAL GESTIONAR RADICADO/RESPUESTA CORRESPONDENCIA ENTRANTE
======================================-->

<div id="modalEnviarFacturaReciboGestionAdminFinan" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Enviar Factura/Recibo a Gestion Administrativa y Financiera</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group">
              
              <label>Proyecto/Area:</label>

              <input type="text" class="form-control" value="Gestión Administrativa y Financiera">

            </div>

            <div class="form-group">

              <label>Observaciones Factura/Recibo para Gestion Administrativa y Financiera:</label>

              <textarea class="form-control" name="nuevaObservacionGestionCorRec" required rows="8"></textarea>

            </div>

            <hr>
            <hr>
            <!-- ENTRADA PARA ASUNTO -->

            <div class="form-group">

              <label>Asunto:</label>

              <div id="envAsuntoCorRecibida"></div>
              <input type="hidden" name="" id="">

            </div>
              
            <!-- ENTRADA PARA VER OBSERVACIONES -->
            <div class="form-group">
            
              <label>Observaciones:</label>

              <div id="envObservacionesCorRecibida"></div>              

            </div>

            <!-- ENTRADA PARA VER PROYECTO -->
            <div class="form-group">

              <label>Proyecto/Area:</label>

              <div id="envProyectoAreaCorRecibida"></div>

            </div>
            
            <!-- ENTRADA PARA VER EL RESPONSABLE -->
            <div class="form-group">

              <label>Responsable:</label>

              <div id="envResponsableCorRecibida"></div>

            </div>

            <div class="form-group">

              <label>Tipo Correspondencia Entrante:</label>

              <div id="envTipoCorrespondencia"></div>

            </div>

            <!-- ENTRADA PARA CARGAR DOCUMENTO -->
            <div class="form-group">

              <label>Adjuntar Factura/Recibo:</label>

              <div id="envDocumentoAdjuntoCorRecibida"></div>

            </div>

            <!-- ENTRADA PARA ESTADO ASIGNACION -->
            <div class="form-group">

              <label>Estado Asignación:</label>

              <div id="envEstadoAsignacionCorRecibida"></div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>
          
          <button type="submit" name="guardarGestionRadicadoRespuesta" class="btn btn-success"><i class="fas fa-save"></i> Re-Asignacion Correspondencia</button>

        </div>

        <?php 

          if(isset($_POST["guardarGestionRadicadoRespuesta"])){

            $guardarGestion = new ControladorCorrespondencia();

          }
        
        ?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL GESTIONAR RADICADO/RESPUESTA CORRESPONDENCIA ENTRANTE
======================================-->

<div id="modalGestionarRadicadoRespuesta" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Gestionar Radicado/Respuesta Correspondencia Entrante</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
            
            <div class="form-group">
              
              <label>Codigo Concecutivo:</label><small> (Codigo generado para dar respuesta)</small>

              <input type="text" class="form-control" name="nuevoCodigoConcecutivoGenerado" placeholder="330-001" required>

            </div>

            <div class="form-group">

              <label>Observaciones Gestion Radicado/Respuesta Correspondencia Entrante:</label>

              <textarea class="form-control" name="nuevaObservacionGestionCorRec" required rows="8"></textarea>

            </div>

            <hr>
            <hr>
            <!-- ENTRADA PARA ASUNTO -->

            <div class="form-group">

              <label>Asunto:</label>

              <div id="gesAsuntoCorRecibida"></div>
              <input type="hidden" name="idCorrespondenRecibidaGestion" id="idCorrespondenRecibidaGestion">

            </div>
              
            <!-- ENTRADA PARA VER OBSERVACIONES -->
            <div class="form-group">
            
              <label>Observaciones:</label>

              <div id="gesObservacionesCorRecibida"></div>              

            </div>

            <!-- ENTRADA PARA VER PROYECTO -->
            <div class="form-group">

              <label>Proyecto/Area:</label>

              <div id="gesProyectoAreaCorRecibida"></div>

            </div>
            
            <!-- ENTRADA PARA VER EL RESPONSABLE -->
            <div class="form-group">

              <label>Responsable:</label>

              <div id="gesResponsableCorRecibida"></div>

            </div>

            <div class="form-group">

              <label>Tipo Correspondencia Entrante:</label>

              <div id="gesTipoCorrespondencia"></div>

            </div>

            <!-- ENTRADA PARA CARGAR DOCUMENTO -->
            <div class="form-group">

              <label>Adjuntar Factura/Recibo:</label>

              <div id="gesDocumentoAdjuntoCorRecibida"></div>

            </div>

            <!-- ENTRADA PARA ESTADO ASIGNACION -->
            <div class="form-group">

              <label>Estado Asignación:</label>

              <div id="gesEstadoAsignacionCorRecibida"></div>

            </div>

            <div class="form-group">

              <div id="gesRadicadoRespuesta"></div>

            </div>
            
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>
          
          <button type="submit" name="guardarGestionRadicadoRespuesta" class="btn btn-success"><i class="fas fa-save"></i> Re-Asignacion Correspondencia</button>

        </div>

        <?php 

          if(isset($_POST["guardarGestionRadicadoRespuesta"])){

            $guardarGestion = new ControladorCorrespondencia();
            $guardarGestion->ctrGuardarGestionRadicadoRespuesta();

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

                  <label>Adjuntar Factura/Recibo:</label>

                  <div id="verDocumentoAdjuntoCorRecibida"></div>

                </div>

              </div>
            
            </div>

            <hr>

            <!-- ENTRADA PARA ESTADO ASIGNACION -->
            <div class="form-group">

              <label>Estado Asignación:</label>

              <div id="verEstadoAsignacionCorRecibida"></div>

            </div>

            <div class="form-group">

              <div id="verRadicadoRespuesta"></div>

            </div>

            <div class="form-group">
              
              <div id="verUsuarioRechazamiento"></div>
              <div id="verObservacionesRechazamiento"></div>
              
            </div>

            <div class="form-group">
              
              <div id="verObservacionesGestionRadicadoRespuesta"></div>
              
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
MODAL RE-ASIGNAR CORRESPONENCIA RECIBIDA USUARIO
======================================-->
<div id="modalReAsignacionCorrespondenciaRecibida" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Re-Asignar Correspondencia Entrante Usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <center><h4 class="text-bold">Re-Asignacion Correspondencia Entrante</h4></center>

            <div class="form-group">

              <label>Usuario:</label>

              <select name="nuevoUsuarioReAsignacion" class="form-control select2" style="width: 100%;" id="nuevoUsuarioReAsignacion" required>

              <option value="">-- Seleccione un Usuario --</option>

                <?php 
                
                $item = null;
                $valor = null;

                $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                
                foreach($usuarios as $key => $value): ?>

                    <option value="<?php echo $value["id_usuario"]; ?>"><?php echo $value["nombres"] . " " . $value["apellidos"]; ?></option>

                <?php endforeach ?>

              </select>

            </div>

            <div class="form-group">

              <label>Motivo Re-Asignacion Correspondencia Entrante:</label>

              <textarea class="form-control" name="nuevoMoticoReAsignacion" rows="8" required></textarea>


            </div>

            <hr>

            <!-- ENTRADA PARA ASUNTO -->
            
            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <label>Asunto:</label>

                  <div id="reAsigAsuntoCorRecibida"></div>

                  <input type="hidden" name="idCorrespondenciaRecibidaCorAsig" id="idCorrespondenciaRecibidaCorAsig">

                </div>

              </div>

              <div class="col-md-6">
                  
                <!-- ENTRADA PARA VER OBSERVACIONES -->
                <div class="form-group">
                
                  <label>Observaciones:</label>

                  <div id="reAsigObservacionesCorRecibida"></div>              

                </div>

              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-6">

                <!-- ENTRADA PARA VER PROYECTO -->
                <div class="form-group">

                  <label>Proyecto/Area:</label>

                  <div id="reAsigProyectoAreaCorRecibida"></div>

                </div>

              </div>

              <div class="col-md-6">
                
                <!-- ENTRADA PARA VER EL RESPONSABLE -->
                <div class="form-group">

                  <label>Responsable:</label>

                  <div id="reAsigResponsableCorRecibida"></div>

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <label>Tipo Correspondencia Entrante:</label>

                  <div id="reAsigTipoCorrespondencia"></div>

                </div>

              </div>

              <div class="col-md-6">

                <!-- ENTRADA PARA CARGAR DOCUMENTO -->
                <div class="form-group">

                  <label>Adjuntar Factura/Recibo:</label>

                  <div id="reAsigDocumentoAdjuntoCorRecibida"></div>

                </div>
                  
              </div>

            </div>

            <hr>

            <!-- ENTRADA PARA ESTADO ASIGNACION -->
            <div class="form-group">

              <label>Estado Asignación:</label>

              <div id="reAsigEstadoAsignacionCorRecibida"></div>

            </div>

            <div class="form-group">

              <div id="reAsigRadicadoRespuesta"></div>

            </div>
            
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>
          
          <button type="submit" name="guardarReAsignacionCorRec" class="btn btn-success"><i class="fas fa-save"></i> Re-Asignacion Correspondencia</button>

        </div>

        <?php 

          if(isset($_POST["guardarReAsignacionCorRec"])){

            $reAsignar = new ControladorCorrespondencia();
            $reAsignar->ctrReAsignarCorEntrante();

          }
        
        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL RE-ASIGNAR CORRESPONENCIA RECIBIDA PROYECTO
======================================-->
<div id="modalReAsignacionCorrespondenciaRecibidaProyecto" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Re-Asignar Correspondencia Entrante Proyecto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <center><h4 class="text-bold">Re-Asignacion Correspondencia Entrante Proyecto</h4></center>

            <div class="form-group">

            <label>Proyecto/Area:</label>

            <select name="nuevoProyectoCorRecReAsig" class="form-control" id="nuevoProyectoCorRecReAsig" required>

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

            <div id="contenedorResponsable"></div>

            <div class="form-group">

              <label>Motivo Re-Asignacion Correspondencia Entrante:</label>

              <textarea class="form-control" name="nuevoMoticoReAsignacion" rows="8" required></textarea>


            </div>

            <hr>

            <div class="row">

              <div class="col-md-6">

                <!-- ENTRADA PARA ASUNTO -->

                <div class="form-group">

                  <label>Asunto:</label>

                  <div id="reAsigAsuntoCorRecibidaPro"></div>

                  <input type="hidden" name="idCorrespondenciaRecibidaCorAsig" id="idCorrespondenciaRecibidaCorAsigPro">
                  <input type="hidden" name="nuevoUsuarioReAsignacion" id="idUsuarioCorrespondenciaCorAsig">

                </div>

              </div>

              <div class="col-md-6">
                  
                <!-- ENTRADA PARA VER OBSERVACIONES -->
                <div class="form-group">
                
                  <label>Observaciones:</label>

                  <div id="reAsigObservacionesCorRecibidaPro"></div>              

                </div>

              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-6">

                <!-- ENTRADA PARA VER PROYECTO -->
                <div class="form-group">

                  <label>Proyecto/Area:</label>

                  <div id="reAsigProyectoAreaCorRecibidaPro"></div>

                </div>

              </div>

              <div class="col-md-6">
                
                <!-- ENTRADA PARA VER EL RESPONSABLE -->
                <div class="form-group">

                  <label>Responsable:</label>

                  <div id="reAsigResponsableCorRecibidaPro"></div>

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <label>Tipo Correspondencia Entrante:</label>

                  <div id="reAsigTipoCorrespondenciaPro"></div>

                </div>

              </div>

              <div class="col-md-6">

                <!-- ENTRADA PARA CARGAR DOCUMENTO -->
                <div class="form-group">

                  <label>Adjuntar Factura/Recibo:</label>

                  <div id="reAsigDocumentoAdjuntoCorRecibidaPro"></div>

                </div>

              </div>

            </div>

            <hr>

            <!-- ENTRADA PARA ESTADO ASIGNACION -->
            <div class="form-group">

              <label>Estado Asignación:</label>

              <div id="reAsigEstadoAsignacionCorRecibidaPro"></div>

            </div>

            <div class="form-group">

              <div id="reAsigRadicadoRespuestaPro"></div>

            </div>
            
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>
          
          <button type="submit" name="guardarReAsignacionCorRecPro" class="btn btn-success"><i class="fas fa-save"></i> Re-Asignacion Correspondencia</button>

        </div>

        <?php 

          if(isset($_POST["guardarReAsignacionCorRecPro"])){

            $reAsignar = new ControladorCorrespondencia();
            $reAsignar->ctrReAsignarCorEntrante();

          }
        
        ?>

      </form>

    </div>

  </div>

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


            <div class="row">

              <div class="col-md-6">

                <!-- ENTRADA PARA ASUNTO -->

                <div class="form-group">

                  <label>Asunto:</label>

                  <div id="verAsuntoCorRecibidaReAsig"></div>

                  </div>

                </div>

              <div class="col-md-6">

                <!-- ENTRADA PARA VER OBSERVACIONES -->
                <div class="form-group">
            
                  <label>Observaciones:</label>

                  <div id="verObservacionesCorRecibidaReAsig"></div>              

                </div>

              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-6">

                <!-- ENTRADA PARA VER PROYECTO -->
                <div class="form-group">

                  <label>Proyecto/Area:</label>

                  <div id="verProyectoAreaCorRecibidaReAsig"></div>

                </div>


              </div>

              <div class="col-md-6">

                <!-- ENTRADA PARA VER EL RESPONSABLE -->
                <div class="form-group">

                  <label>Responsable:</label>

                  <div id="verResponsableCorRecibidaReAsig"></div>

                </div>

              </div>

            </div>
            
            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <label>Tipo Correspondencia Entrante:</label>

                  <div id="verTipoCorrespondenciaReAsig"></div>

                </div>

              </div>

              <div class="col-md-6">

                <!-- ENTRADA PARA CARGAR DOCUMENTO -->
                <div class="form-group">

                  <label>Adjuntar Factura/Recibo:</label>

                  <div id="verDocumentoAdjuntoCorRecibidaReAsig"></div>

                </div>

              </div>

            </div>

            <hr>

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

            <div class="row">

              <div class="col-md-6">

                <!-- ENTRADA PARA ASUNTO -->

                <div class="form-group">

                  <label>Asunto:</label>

                  <div id="recharzarAsuntoCorRecibida"></div>
                  <input type="hidden" id="rechazarIdCorRecibida" name="rechazarIdCorRecibida">

                </div>
              
              </div>

              <div class="col-md-6">
                  
                <!-- ENTRADA PARA VER OBSERVACIONES -->
                <div class="form-group">
                
                  <label>Observaciones:</label>

                  <div id="rechazarObservacionesCorRecibida"></div>              

                </div>

              </div>

            </div>

            <hr>


            <div class="row">

              <div class="col-md-6">

                <!-- ENTRADA PARA VER PROYECTO -->
                <div class="form-group">

                  <label>Proyecto/Area:</label>

                  <div id="rechazarProyectoAreaCorRecibida"></div>

                </div>

              </div>

              <div class="col-md-6">
                
                <!-- ENTRADA PARA VER EL RESPONSABLE -->
                <div class="form-group">

                  <label>Responsable:</label>

                  <div id="rechazarResponsableCorRecibida"></div>

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <label>Tipo Correspondencia:</label>

                  <div id="rechazarTipoCorrespondencia"></div>

                </div>

              </div>

              <div class="col-md-6">

                <!-- ENTRADA PARA CARGAR DOCUMENTO -->
                <div class="form-group">

                  <label>Adjuntar Factura/Recibo:</label>

                  <div id="rechazarDocumentoAdjuntoCorRecibida"></div>

                </div>

              </div>

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

            <div class="row">

              <div class="col-md-6">

                <!-- ENTRADA PARA ASUNTO -->
                <div class="form-group">

                  <label>Asunto:</label>

                  <div id="recharzarAsuntoCorRecibidaReAsign"></div>
                  <input type="hidden" id="rechazarIdCorRecibidaReAsign" name="rechazarIdCorRecibidaReAsign">

                </div>

              </div>

              <div class="col-md-6">
                  
                <!-- ENTRADA PARA VER OBSERVACIONES -->
                <div class="form-group">
                
                  <label>Observaciones:</label>

                  <div id="rechazarObservacionesCorRecibidaReAsign"></div>              

                </div>

              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-6">

                <!-- ENTRADA PARA VER PROYECTO -->
                <div class="form-group">

                  <label>Proyecto/Area:</label>

                  <div id="rechazarProyectoAreaCorRecibidaReAsign"></div>

                </div>

              </div>

              <div class="col-md-6">
                
                <!-- ENTRADA PARA VER EL RESPONSABLE -->
                <div class="form-group">

                  <label>Responsable:</label>

                  <div id="rechazarResponsableCorRecibidaReAsign"></div>

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <label>Tipo Correspondencia:</label>

                  <div id="rechazarTipoCorrespondenciaReAsign"></div>

                </div>

              </div>

              <div class="col-md-6">

                <!-- ENTRADA PARA CARGAR DOCUMENTO -->
                <div class="form-group">

                  <label>Adjuntar Factura/Recibo:</label>

                  <div id="rechazarDocumentoAdjuntoCorRecibidaReAsign"></div>

                </div>

              </div>

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