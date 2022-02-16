<div class="content-wrapper">

  <?php $ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/vistas/modulos/ui/validacion-permiso.php"; 

  include_once $ruta;

  ?>

  <section class="content-header">
    
    <h1>
      
        Correspondencia Enviada
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio-cor"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Correspondencia Enviada</li>
    
    </ol>

  </section>

  <section class="content">

    <!-- INCLUIMOS MENU DE HV -->
    <?php include_once "ui/menu-cor.php"; ?>

    <div class="box box-primary">

        <div class="box-header with-border">

          <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarConcecutivo"><i class="fa fa-plus"></i> Nuevo Consecutivo</button>

          <button class="btn btn-info" data-toggle="modal" data-target="#modalAgregarConcecutivoMasivo"><i class="fa fa-plus"></i> Nuevo Consecutivo Masivo</button>

        </div>
        
        <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive tablasCorrespondencia" width="100%">
            
            <thead>
            
                <tr>
                
                    <th style="width:10px;">#</th>
                    <th>Asunto</th>
                    <th>Proyecto</th>
                    <th>Código</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th style="width:100px;">Acciones</th>
    
                </tr> 
    
            </thead>
    
            <tbody>

            <?php

            $tabla = "correspondencia_enviada";
            $item = null;
            $valor = null;

            $correspondenciaEnviada = ControladorCorrespondencia::ctrMostrarCorrespondenciaRequerida($tabla, $item, $valor);

            foreach($correspondenciaEnviada as $key => $valueCorresEnv): 

            $tablaProyecto = "proyectos_cor";
            $itemProyecto = "id_proyecto";
            $valorProyecto = $valueCorresEnv["id_proyecto"];

            $proyecto = ControladorParametricasCor::ctrObtenerDatoRequerido($tablaProyecto, $itemProyecto, $valorProyecto);

            $fechaFormato = date_create($valueCorresEnv["fecha_creacion"]);
            $fecha = date_format($fechaFormato, "d-m-Y");
                
            ?>

              <?php if($valueCorresEnv["id_usuario"] == $_SESSION["id_usuario"] || $_SESSION["rol_software"] == "administrador"): ?>

                <tr>

                  <td><?php echo $valueCorresEnv["id_cor_enviado"]; ?></td>
                  <td><?php echo $valueCorresEnv["asunto"]; ?></td>
                  <td><?php echo $proyecto["nombre_proyecto"]; ?></td>
                  <td><?php echo $valueCorresEnv["codigo"]; ?></td>
                  <td data-sort="YYYYMMDD"><?php echo $fecha; ?></td>
                  <td><?php echo $valueCorresEnv["estado"]; ?></td>
                  <td>

                    <button class="btn btn-info btn-xs btnVerDocumentoRadicar" data-toggle="modal" data-target="#modalVerDocumentoRadicar" idCorrespondenciaEnviada="<?php echo $valueCorresEnv["id_cor_enviado"]; ?>" title="Ver Documento Radicar"><i class="fa fa-eye"></i></button>

                    <?php if($valueCorresEnv["estado"] == "Creado" && $valueCorresEnv["id_usuario"] == $_SESSION["id_usuario"] || $valueCorresEnv["estado"] == "Creado" && $_SESSION["rol_software"] == "administrador"): ?>

                      <button class="btn btn-success btn-xs btnCargarDocumentoRadicar" data-toggle="modal" data-target="#modalCargarDocumentoRadicar" idCorrespondenciaEnviada="<?php echo $valueCorresEnv["id_cor_enviado"]; ?>" title="Cargar Documento Radicar"><i class="fas fa-file-export"></i></button>

                      <!--<button class="btn btn-default btn-xs"><i class="fas fa-file-export"></i></button>-->

                    <?php endif ?>

                    <?php if($valueCorresEnv["estado"] == "En radicación" && $valueCorresEnv["id_usuario"] == $_SESSION["id_usuario"] || $valueCorresEnv["estado"] == "En radicación" && $_SESSION["rol_software"] == "administrador"): ?>

                      <button class="btn btn-success btn-xs btnCargarRespuestaRadicado" data-toggle="modal" data-target="#modalCargarRespuestaRadicado" idCorrespondenciaEnviada="<?php echo $valueCorresEnv["id_cor_enviado"]; ?>" title="Respuesta Radicado"><i class="fas fa-reply"></i></button>

                      <!--<button class="btn btn-default btn-xs"><i class="fas fa-reply"></i></button>-->

                    <?php endif ?>

                    <?php if($valueCorresEnv["estado"] == "Creado" || $valueCorresEnv["estado"] == "En radicación" && $valueCorresEnv["id_usuario"] == $_SESSION["id_usuario"] || $valueCorresEnv["estado"] == "Creado" || $valueCorresEnv["estado"] == "En radicación" && $_SESSION["rol_software"] == "administrador"): ?>

                      <button class="btn btn-danger btn-xs btnAnularDocumentoRadicar" data-toggle="modal" data-target="#modalAnularDocumentoRadicacion" idCorrespondenciaEnviada="<?php echo $valueCorresEnv["id_cor_enviado"]; ?>" title="Anular Documento Radicar"><i class="fas fa-ban"></i></button>

                      <!--<button class="btn btn-default btn-xs"><i class="fas fa-ban"></i></button>-->

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
MODAL VER INFORMACION CORRESPONDENCIA
======================================-->

<div id="modalVerDocumentoRadicar" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Detalle Documento Radicar</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

              <div class="col-md-4">

                <!-- VER PROYECTO -->
                <div class="form-group">

                  <label>Proyecto:</label>

                  <div id="detalleProyecto"></div>

                </div>

              </div>

              <div class="col-md-4">
                  
                <!-- VER CODIGO CONCECUTIVO -->
                <div class="form-group">
                
                  <label>Codigo:</label>
                  
                  <div id="detalleCodigoConsecutivo"></div>

                </div>

              </div>

              <div class="col-md-4">

                <!-- VER ESTADO CONCECUTIVO -->
                <div class="form-group">

                  <label>Estado:</label>

                  <div id="detalleEstado"></div>

                </div>

              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-6">
                <!-- VER ASUNTO CONCECUTIVO -->
                <div id="detalleAsunto"></div>

              </div>

              <div class="col-md-6">

                <!-- VER NUMERO RADICADO CONCECUTIVO -->
                <div id="detalleNumeroRadicado"></div>

              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-6">
                <!-- VER DOCUMENTO ENVIADO CONCECUTIVO -->
                <div id="detalleDocumentoEnviado"></div>

              </div>

              <div class="col-md-6">

                <!-- VER DOCUMENTO RECIBIDO CONCECUTIVO -->
                <div id="detalleDocumentoRecibido"></div>
              
              </div>

            </div>

            <div class="row">

                <div class="col-md-12">

                <div id="motivoAnulacionDevuelto"></div>

                </div>

            </div>

            
            <hr>

            <div class="row">

              <div class="col-md-6">

                <!-- VER USUARIO QUE ENVIO CONCECUTIVO -->

                <div id="detalleUsuarioEnvio"></div>

              </div>

              <div class="col-md-6">

                <!-- VER FECHA ENVIO CONCECUTIVO -->

                <div id="detalleFechaEnvio"></div>
              
              </div>

            </div>

            <hr>

            <!-- BOX DE DATOS PERSONALES -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Trazabilidad del Consecutivo</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="input-group">
                      <div id="detalleTituloCarga"></div>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="input-group">
                      <div id="detalleUsuarioCargaRadicar"></div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="input-group">
                      <div id="detalleFechaCargaRadicar"></div>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="input-group">
                      <div id="detalleTituloRespuesta"></div>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="input-group">
                      <div id="detalleUsuarioCargaRespuesta"></div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="input-group">
                      <div id="detalleFechaCargaRespuesta"></div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="input-group">
                      <div id="detalleTituloAnulacion"></div>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="input-group">
                      <div id="detalleUsuarioCargaAnulacion"></div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="input-group">
                      <div id="detalleFechaCargaAnulacion"></div>
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
MODAL GENERAR CODIGO CONCECUTIVO MASIVO
======================================-->

<div id="modalAgregarConcecutivoMasivo" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Generar Concecutivo Masivo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA SELECCION PROYECTO -->
            <div class="form-group">
            
                <label>Proyecto:</label>

                <select name="nuevoProyectoConcecutivoMasivo" id="nuevoProyectoConcecutivoMasivo" class="form-control" required>

                    <option value="">-- Seleccione una opcion --</option>

                    <?php 
                    
                    $tabla = "proyectos_cor";
                    $item = null;
                    $valor = null;

                    $proyectos = ControladorParametricasCor::ctrObtenerDatoRequerido($tabla, $item, $valor);
                    
                    foreach($proyectos as $key => $valueProyectos): ?>

                        <option value="<?php echo $valueProyectos["id_proyecto"]; ?>"><?php echo $valueProyectos["nombre_proyecto"]; ?></option>

                    <?php endforeach ?>

                </select>

            </div>
            
            <div id="contenedorCodigoMasivo"></div>

            <div class="form-group">
                <label>Cantidad Concecutivos:</label>
                <input type="number" class="form-control" name="cantidadConcecutivosGenerar" max="999" required>
            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>

          <button type="submit" name="crearConcecutivoMasivo" class="btn btn-success"><i class="fas fa-save"></i> Guardar Consecutivo</button>

        </div>

        <?php

          if(isset($_POST["crearConcecutivoMasivo"])){

            $crearCod = new ControladorCorrespondencia();
            $crearCod->ctrCrearCodigoConcecutivoMasivo();
          
          }
        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL GENERAR CODIGO CONCECUTIVO
======================================-->

<div id="modalAgregarConcecutivo" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Generar Concecutivo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA SELECCION PROYECTO -->
            <div class="form-group">
            
                <label>Proyecto:</label>

                <select name="nuevoProyectoConcecutivo" id="nuevoProyectoConcecutivo" class="form-control" required>

                    <option value="">-- Seleccione una opcion --</option>

                    <?php 
                    
                    $tabla = "proyectos_cor";
                    $item = null;
                    $valor = null;

                    $proyectos = ControladorParametricasCor::ctrObtenerDatoRequerido($tabla, $item, $valor);
                    
                    foreach($proyectos as $key => $valueProyectos): ?>

                        <option value="<?php echo $valueProyectos["id_proyecto"]; ?>"><?php echo $valueProyectos["nombre_proyecto"]; ?></option>

                    <?php endforeach ?>

                </select>

            </div>
            
            <div id="contenedorCodigo"></div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>

          <button type="submit" name="crearConcecutivo" class="btn btn-success"><i class="fas fa-save"></i> Guardar Consecutivo</button>

        </div>

        <?php

          if(isset($_POST["crearConcecutivo"])){

            $crearCod = new ControladorCorrespondencia();
            $crearCod->ctrCrearCodigoConcecutivo();
          
          }
        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL CARGAR DOCUMENTO A RADICAR
======================================-->

<div id="modalCargarDocumentoRadicar" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Cargar Documento a Radicar</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

              <div class="col-md-6">
                <!-- ENTRADA PARA VER CODIGO CONCECUTIVO -->
                <div class="form-group">
                
                  <label>Codigo:</label>
                  
                  <div id="verCodigoConsecutivo"></div>

                  <input type="hidden" name="idEnvioCorrespondencia" id="idEnvioCorrespondencia">

                </div>

              </div>

              <div class="col-md-6">

                <!-- ENTRADA PARA VER PROYECTO -->

                <div class="form-group">

                  <label>Proyecto:</label>

                  <div id="verProyecto"></div>

                </div>

              </div>

            </div>

            <div class="row">
            
              <div class="col-md-12">

                <div class="form-group">

                  <label>Asunto:</label>

                  <textarea class="form-control" rows="3" name="nuevoAsuntoCorrespondencia" onkeyup="mayusculas(this)" required></textarea>

                </div>

              </div>

            </div>

            <hr>

            <div class="form-group">

              <label>Documento:</label>

              <input type="file" class="form-control" name="nuevoDocumentoCorrespondencia[]" id="nuevoDocumentoCorrespondencia" accept="application/pdf, .docx, .doc" required>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <label>Usuario que envia:</label>

                  <div id="verUsuario"></div>

                </div>

              </div>

              <div class="col-md-6">

                <div class="form-group">

                  <label>Fecha:</label>

                  <div id="verFecha"></div>

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

          <button type="submit" name="cargarDocumentoRadicar" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>

        </div>

        <?php

          if(isset($_POST["cargarDocumentoRadicar"])){

            $cargarDoc = new ControladorCorrespondencia();
            $cargarDoc->ctrCargarDocumentoRadicar();
          
          }
        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL CARGAR DOCUMENTO RESPUESTA
======================================-->

<div id="modalCargarRespuestaRadicado" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Respuesta Radicado</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

              <div class="col-md-2">
                <!-- ENTRADA PARA VER CODIGO CONCECUTIVO -->
                <div class="form-group">
                
                  <label>Codigo:</label>
                  
                  <div id="respuestaCodigoConsecutivo"></div>

                  <input type="hidden" name="idEnvioCorrespondenciaRespuesta" id="idEnvioCorrespondenciaRespuesta">

                </div>

              </div>

              <div class="col-md-4">

                <!-- ENTRADA PARA VER PROYECTO -->

                <div class="form-group">

                  <label>Proyecto:</label>

                  <div id="verProyectoRespuesta"></div>

                </div>

              </div>

              <div class="col-md-6">

                <div class="form-group">

                  <label>Asunto:</label>

                  <div id="verAsuntoRespuesta"></div>

                </div>

              </div>

            </div>

            <div class="form-group">

              <label>Documento Enviado:</label>

              <div id="documentoEnviado"></div>

            </div>

            <hr>

            <div class="form-group">

              <label>Número de Radicado:</label>

              <input type="text" class="form-control" name="nuevoNumeroRadicado" onkeyup="mayusculas(this)" required>

            </div>

            <div class="form-group">

              <label>Documento Respuesta:</label>

              <input type="file" class="form-control" name="nuevoDocumentoCorrespondenciaRespuesta[]" id="nuevoDocumentoCorrespondenciaRespuesta" accept="application/pdf, .doc, .docx" required>

            </div>

            <hr>

            <div class="form-group">

              <label>Usuario que envia:</label>

              <div id="verUsuarioRespuesta"></div>

            </div>

            <div class="form-group">

              <label>Fecha:</label>

              <div id="verFechaRespuesta"></div>

            </div>


          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>

          <button type="submit" name="cargarDocumentoRespuesta" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>

        </div>

        <?php

          if(isset($_POST["cargarDocumentoRespuesta"])){

            $cargarRespuesta = new ControladorCorrespondencia();
            $cargarRespuesta->ctrCargarRespuestaDocumentoRadicado();
          
          }
        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL ANULAR DOCUENTO A RADICAR
======================================-->

<div id="modalAnularDocumentoRadicacion" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Devolver/Anular</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

              <div class="col-md-6">
                <!-- ENTRADA PARA VER CODIGO CONCECUTIVO -->
                <div class="form-group">
                
                  <label>Codigo:</label>
                  
                  <div id="cancelarCodigoConsecutivo"></div>

                  <input type="hidden" name="idEnvioCorrespondenciaCancelar" id="idEnvioCorrespondenciaCancelar">

                </div>

              </div>

              <div class="col-md-6">

                <!-- ENTRADA PARA VER PROYECTO -->

                <div class="form-group">

                  <label>Proyecto:</label>

                  <div id="verProyectoCancelar"></div>

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-md-12">

                <div class="form-group">

                  <label>Asunto:</label>

                  <div id="verAsuntoCancelar"></div>


                </div>

              </div>

            </div>

            <hr>

            <div class="form-group">

              <label>Accion:</label>

              <select class="form-control" name="nuevoAccionDocumentoRadicar" required>

                <option value="">-- Seleccione una opcion --</option>

                <option value="Anulado">Anulado</option>

                <option value="Devuelto">Devuelto</option>

              </select>

            </div>

            <div class="form-group">

              <label>Observaciones:</label>

              <textarea class="form-control" name="nuevaObservacionCancelar" onkeyup="mayusculas(this)" rows="4" required></textarea>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <label>Usuario que envia:</label>

                  <div id="verUsuarioCancelar"></div>

                </div>

              </div>

              <div class="col-md-6">

                <div class="form-group">

                  <label>Fecha:</label>

                  <div id="verFechaCancelar"></div>

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

          <button type="submit" name="anularDocumentoRadicar" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>

        </div>

        <?php

          if(isset($_POST["anularDocumentoRadicar"])){

            $anular = new ControladorCorrespondencia();
            $anular->ctrAnularDevolverDocumentoRadicar();
          
          }
        ?>

      </form>

    </div>

  </div>

</div>