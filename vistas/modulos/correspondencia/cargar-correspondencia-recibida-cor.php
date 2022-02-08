<div class="content-wrapper">

  <?php 
  
    $ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/vistas/modulos/ui/validacion-permiso.php"; 

    include_once $ruta;
  
  ?>

  <section class="content-header">
    
    <h1>
      
        Cargar Correspondencia Entrante
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio-cor"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Cargar Correspondencia Entrante</li>
    
    </ol>

  </section>

  <section class="content">

    <!-- INCLUIMOS MENU DE HV -->
    <?php include_once "ui/menu-cor.php"; ?>

    <div class="box box-primary">
        
        <div class="box-body">

          <div class="input-group-btn">

            <button type="button" class="btn btn-success dropdown-toggle pull-left" data-toggle="dropdown" aria-expanded="false" style="margin-right: 10px;"><i class="fa fa-plus"></i> Cargar Correspondencia Entrante
              <span class="fa fa-caret-down"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a data-toggle="modal" data-target="#modalCargarFactura">Facturas/Recibos</a></li>
                <li><a data-toggle="modal" data-target="#modalCargarRadicadosRespuesta">Radicados/Respuestas</a></li>
                <li><a data-toggle="modal" data-target="#modalCargarDocumento">Documento</a></li>
            </ul>

          </div>

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

                <?php if($valueCorrespondenciaRec["id_usuario_creacion"] == $_SESSION["id_usuario"] && $valueCorrespondenciaRec["estado_asignacion_cor_recibida"] == "Asignada" || $valueCorrespondenciaRec["estado_asignacion_cor_recibida"] == "Rechazada"): ?>

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

                      <button class="btn btn-info btn-xs btnVerAsignacionCorrespondenciaRecibida" data-toggle="modal" data-target="#modalVerAsignacionCorrespondenciaRecibida" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Ver Correspondencia Asignada"><i class="fa fa-eye"></i></button>
                      <button class="btn btn-warning btn-xs btnEditarResponsableAsignacion" data-toggle="modal" data-target="#modalEditarResponsableAsignacion" idCorrespondenciaRecibida="<?php echo $valueCorrespondenciaRec["id_cor_recibida"]; ?>" title="Editar Correspondencia Asignada"><i class="fas fa-user-cog"></i></button>

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

              <input type="text" class="form-control" name="nuevoTipoCorRec" value="Facturas/Recibos" readonly>

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
MODAL CARGAR CORRESPONDENCIA DOCUMENTO
======================================-->
<div id="modalCargarDocumento" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Cargar Correspondencia Entrante Documento</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA ASUNTO -->

            <div class="form-group">

              <label>Asunto:</label>

              <input type="text" class="form-control" name="nuevoAsuntoDocCorRec" required>


            </div>
              
            <!-- ENTRADA PARA OBSERVACIONES -->
            <div class="form-group">
            
              <label>Observaciones:</label>

              <textarea class="form-control" name="nuevaObservacionDocCorRec" required></textarea>
              

            </div>

            <!-- ENTRADA PARA SELECCION PROYECTO -->
            <div class="form-group">

              <label>Proyecto/Area:</label>

              <select name="nuevoProyectoDocCorRec" class="form-control" id="nuevoProyectoDocCorRec" required>

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
            <div id="contenedorResponsableDoc"></div>
            <input type="hidden" id="idNuevoResponsableProyectoDocCor" name="idNuevoResponsableProyectoDocCor">

            <!-- ENTRADA PARA CARGAR DOCUMENTO -->
            <div class="form-group">

              <label>Adjuntar Factura:</label>

              <input type="file" class="form-control" name="nuevoDocumentoProyectoDocCorRec[]" id="nuevoDocumentoProyectoDocCorRec" accept="application/pdf, .doc, .docx" required>

            </div>

            <div class="form-group">

              <label>Tipo Correspondencia Entrante:</label>

              <input type="text" class="form-control" name="nuevoTipoDocCorRec" value="Documento" readonly>

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
          <button type="submit" name="cargarDocumentoCorRec" class="btn btn-success"><i class="fas fa-save"></i> Guardar Factura</button>
        </div>

        <?php 
        
          if(isset($_POST["cargarDocumentoCorRec"])){

            $cargarFactura = new ControladorCorrespondencia();
            $cargarFactura->ctrCargarDocumentoCorRec();


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
                    <option value="Documento">Documento</option>

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

              <input class="form-control" type="text" name="nuevoTipoCorRecRad" readonly value="Radicados/Respuestas">

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