<div class="content-wrapper">

  <?php 
    
    $ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/vistas/modulos/ui/validacion-permiso.php"; 

    include_once $ruta;

  ?>

  <section class="content-header">
    
    <h1>
      
      Administración Activos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio-inv"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administración Activos</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- INCLUIMOS MENU DE CORRESPONDENCIA -->
    <?php include_once "ui/menu-inv.php"; ?>

    <div class="box box-info">
        
        <div class="box-header with-border">

          <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarTecnologia"><i class="fas fa-laptop-medical"></i> Agregar Activo</button>

          <a href="vistas/modulos/inv/descargar-reporte-inv.php?reporteInformacionActivos=Todos" class="btn btn-success btn-xs pull-right"><i class="fa fa-file-excel-o"></i> Excel Activos</a>

        </div>

        <div class="box-body">

          <div class="table-responsive">
            
            <table class="table table-bordered table-striped dt-responsive" id="tablaTecnologia" width="100%">
                
                <thead>
                
                    <tr>
                    
                        <th style="width:10px">#</th>
                        <th>Clasificación Activo</th>
                        <th>Categoria Activo</th>
                        <th>Marca</th>
                        <th>Placa</th>
                        <th>Ubicación</th>
                        <th>Proyecto</th>
                        <th>Información Activo</th>
                        <th>Estado Activo</th>
                        <th>Estado</th>
                        <th>Funciones</th>
                        <th>Acciones</th>
        
                    </tr> 
        
                </thead>
        
                <tbody>

                <?php 
                
                $tabla = "tecnologia";
                $item = null;
                $valor = null;
                
                $activos = ControladorCorrectivo::ctrObternerDatoRequerido($tabla, $item, $valor);

                foreach($activos as $key => $valueActivos): 
                    
                    //OBTENER DATOS DE CATEGORIA
                    $tablaCategoria = "par_categoria";
                    $itemCategoria = "id_categoria";
                    $valorCategoria = $valueActivos["categoria"];

                    $categoria = ControladorTecnologia::ctrObternerDatoRequerido($tablaCategoria, $itemCategoria, $valorCategoria);

                    //OBTENDER DATOS DE UBICACION
                    $tablaUbicacion = "par_ubicacion";
                    $itemUbicacion = "id_ubicacion";
                    $valorUbicacion = $valueActivos["ubicacion"];

                    $ubicacion = ControladorTecnologia::ctrObternerDatoRequerido($tablaUbicacion, $itemUbicacion, $valorUbicacion);

                    //OBTENER DATOS DE PROYECTO
                    $tablaProyecto = "par_proyecto";
                    $itemProyecto = "id_proyecto";
                    $valorProyecto = $valueActivos["proyecto"];

                    $proyecto = ControladorTecnologia::ctrObternerDatoRequerido($tablaProyecto, $itemProyecto, $valorProyecto);

                
                ?>

                  <tr>
                      <td><?php echo $valueActivos["id_activos"]; ?></td>
                      <td><?php echo $valueActivos["clasificacion"]; ?></td>
                      <td><?php echo $categoria["categoria"]; ?></td>
                      <td><?php echo $valueActivos["marca"]; ?></td>
                      <td><?php echo $valueActivos["numero_placa"]; ?></td>
                      <td><?php echo $ubicacion["ubicacion"]; ?></td>
                      <td><?php echo $proyecto["proyecto"]; ?></td>
                      <td><button class="btn bg-navy btn-xs btnVerInformacionActivo" idActivo="<?php echo $valueActivos["id_activos"]; ?>" title="Ver Información Activo" data-toggle="modal" data-target="#modalVerInformacionActivo"><i class="fas fa-file-invoice"></i></button></td>

                      <?php if($valueActivos["estado_activo"] == "MALO"): ?>

                        <td><button class="btn btn-danger btn-xs btnCambiarEstadoActivo" idActivo="<?php echo $valueActivos["id_activos"]; ?>" title="Cambiar Estado Activo" data-toggle="modal" data-target="#modalCambiarEstadoActivo"><?php echo $valueActivos["estado_activo"]; ?></button></td>

                      <?php elseif($valueActivos["estado_activo"] == "REGULAR"): ?>

                        <td><a class="btn btn-warning btn-xs btnCambiarEstadoActivo" idActivo="<?php echo $valueActivos["id_activos"]; ?>" title="Cambiar Estado Activo" data-toggle="modal" data-target="#modalCambiarEstadoActivo"><?php echo $valueActivos["estado_activo"]; ?></a></td>
                      
                      <?php elseif($valueActivos["estado_activo"] == "BUENO"): ?>

                        <td><a class="btn btn-success btn-xs btnCambiarEstadoActivo" idActivo="<?php echo $valueActivos["id_activos"]; ?>" title="Cambiar Estado Activo" data-toggle="modal" data-target="#modalCambiarEstadoActivo"><?php echo $valueActivos["estado_activo"]; ?></a></td>

                      <?php endif ?>

                      <?php if($valueActivos["estado"] == 1): ?>

                        <td><a class="btn btn-danger btn-xs">Ocupado</a></td>

                      <?php elseif($valueActivos["estado"] == 0 && $valueActivos["id_responsable"] == null): ?>
                        
                        <td><button class="btn btn-success btn-xs">Libre</button></td>
                      
                      <?php endif ?>
                      
                      <?php if($_SESSION["rol_software"] = "administrar"): ?>

                        <td>
                          
                          <button class="btn btn-success btn-xs btnAgregarMantenimiento" title="Realizar Mantenimiento" idActivo="<?php echo $valueActivos["id_activos"]; ?>" data-toggle="modal" data-target="#modalAgregarMantenimiento"><i class="fas fa-tools"></i></button>


                          <?php if($valueActivos["estado"] == 0): ?>

                            <button class="btn btn-primary btn-xs btnAsignarResponsableActivo" title="Asignar Responsable Activo" idActivo="<?php echo $valueActivos["id_activos"]; ?>" data-toggle="modal" data-target="#modalAgregarAsignacionResponsableActivo"><i class="fas fa-user-plus"></i></button>

                          <?php elseif($valueActivos["estado"] == 1): ?>

                            <button class="btn btn-danger btn-xs btnQuitarAsignacionActivo" idActivo="<?php echo $valueActivos["id_activos"]; ?>" title="Quitar Responsable Activo"><i class="fas fa-user-times"></i></button>

                          <?php endif ?>

                          <a class="btn btn-info btn-xs" href="TCPDF/examples/entregaEquipopdf.php?id=<?php echo $valueActivos["id_activos"]; ?>"  target="_blank" title="Generar .PDF Entrega Equipo"><i class="fa fa-file-pdf-o"></i></a>

                          <a href="vistas/modulos/inv/descargar-reporte-inv.php?reporteMantenimientosEquipo=<?php echo $valueActivos["id_activos"] ?>" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i></a>
                        
                        </td>

                      <?php else: ?>

                        <td><button class="btn btn-default btn-xs"><i class="fas fa-tools"></i></button></td>

                      <?php endif ?>

                      <td>

                        <?php if($_SESSION["rol_software"] = "administrar"): ?>

                          <button class="btn btn-warning btn-xs btnEditarTecnologia" title="Editar Activo" idActivo="<?php echo $valueActivos["id_activos"]; ?>" data-toggle="modal" data-target="#modalEditarTecnologia"><i class="fa fa-pencil"></i></button>                    

                        
                        <?php else: ?>

                          <button class="btn btn-default btn-xs"><i class="fas fa-edit"></i></button>

                        <?php endif ?>
                      </td>

                  </tr>


                <?php endforeach ?>


                </tbody>
        
            </table>

          </div>

        </div>

        <div class="box-footer">
        
        </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR ASIGNACION RESPONSABLE ACTIVO
======================================-->
<div id="modalAgregarAsignacionResponsableActivo" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Asignación Responsable Activo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
              
          <div class="row">

            <div class="col-md-6">

              <div class="form-group">
                  
                <label>Responsable Activo:</label>

                <select class="form-control select2" name="nuevoResposableActivoAsignacion" required style="width: 100%;">

                  <option value="">-- Seleccione una opcion --</option>

                  <?php

                  $tablaUsuario = "usuarios";
                  $itemUsuario = null;
                  $valorUsuario = null;

                  $usuarios = ControladorTecnologia::ctrObternerDatoRequerido($tablaUsuario, $itemUsuario, $valorUsuario);
                  
                  foreach($usuarios as $key => $valueUsuario): 
                  
                  ?>

                  <option value="<?php echo $valueUsuario["id_usuario"]; ?>"><?php echo $valueUsuario["nombres"] . " " . $valueUsuario["apellidos"]; ?></option>


                  <?php endforeach ?>


                </select>

                <input type="hidden" name="idActivoAsignacion" id="idActivoAsignacion">

              </div>
                  
            </div>

            <div class="col-md-6">

              <div class="form-group">

                <label>PDF diligenciado Entrega de Equipo:</label>

                <input type="file" class="form-control" name="nuevoPdfEntregaEquipo[]" id="nuevoPdfEntregaEquipo" accept="application/pdf" required>


              </div>
                  
            </div>


          </div>

          <div class="row">

            <div class="col-md-12">

              <div class="panel box box-success">
                <div class="box-header with-border">
                  <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#accordion" style="color: #00a65a;" href="#collapseInfoActivoTecnologiaAsignacion" class="collapsed" aria-expanded="false">
                      Información del Activo
                    </a>
                  </h4>
                </div>
                <div id="collapseInfoActivoTecnologiaAsignacion" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                  <div class="box-body">

                    <div id="contenedorInfoActivoTecnologiaAsignacion"></div>

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

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>

          <button type="submit" name="GuardarAsignacion" class="btn btn-success"><i class="fas fa-save"></i> Guardar Asignación Responsable</button>

        </div>

        <?php 

          if(isset($_POST["GuardarAsignacion"])){

            $asignar = new ControladorTecnologia();
            $asignar->ctrAsignarResponsableActivo();
            
          }
        
        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL AGREGAR ACTIVO
======================================-->
<div id="modalAgregarTecnologia" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Activo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

              <div class="col-md-4">

                <div class="form-group">

                  <label>Ubicación Activo:</label>

                  <select class="form-control" name="nuevaUbicacionActivo" required>

                    <option value="">-- Seleccione una opcion --</option>

                    <?php 
                    
                    $tablaUbicacion = "par_ubicacion";
                    $itemUbicacion = null;
                    $valorUbicacion = null;

                    $ubicaciones = ControladorTecnologia::ctrObternerDatoRequerido($tablaUbicacion, $itemUbicacion, $valorUbicacion);
                    
                    foreach($ubicaciones as $key => $valueUbicacion): 
                    
                    ?>

                    <option value="<?php echo $valueUbicacion["id_ubicacion"]; ?>"><?php echo $valueUbicacion["ubicacion"]; ?></option>


                    <?php endforeach ?>

                  </select>

                </div>

              </div>

              <div class="col-md-4">

                <div class="form-group">

                  <label>Proyecto Activo:</label>

                  <select class="form-control" name="nuevoProyectoActivo" required>

                    <option value="">-- Seleccione una opcion --</option>

                    <?php 
                    
                    $tablaProyecto = "par_proyecto";
                    $itemProyecto = null;
                    $valorProyecto = null;

                    $proyectos = ControladorTecnologia::ctrObternerDatoRequerido($tablaProyecto, $itemProyecto, $valorProyecto);
                    
                    foreach($proyectos as $key => $valueProyecto): 
                    
                    ?>

                    <option value="<?php echo $valueProyecto["id_proyecto"]; ?>"><?php echo $valueProyecto["proyecto"]; ?></option>


                    <?php endforeach ?>

                  </select>

                </div>


              </div>

              <div class="col-md-2">

                <div class="form-group">
                  
                  <label>Número Puesto:</label>
                  
                  <input type="text" class="form-control" name="nuevoNumeroPuestoActivo" placeholder="Número de Puesto..." required>

                </div>

              </div>

              <div class="col-md-2">

                <div class="form-group">
                  
                  <label>Punto Red:</label>
                  
                  <input type="text" class="form-control" name="nuevoPuntoRedActivo" placeholder="Número de Punto Red...">

                </div>

              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <label>Categoria Activo:</label>

                  <select class="form-control" name="nuevaCategoriaActivo" id="nuevaCategoriaActivo" required>

                    <option value="">-- Seleccione una opcion --</option>

                    <?php

                    $tablaCategoria = "par_categoria";
                    $itemCategoria = null;
                    $valorCategoria = null;

                    $categorias = ControladorTecnologia::ctrObternerDatoRequerido($tablaCategoria, $itemCategoria, $valorCategoria);
                    
                    foreach($categorias as $key => $valueCategoria):
                    
                    ?>

                    <option value="<?php echo $valueCategoria["id_categoria"]; ?>"><?php echo $valueCategoria["categoria"]; ?></option>


                    <?php endforeach ?>


                  </select>

                </div>


              </div>

              <div class="col-md-6">

                <div class="form-group">

                  <label>Clasificación Activo:</label>

                  <div id="contenedorClasificacion"></div>

                </div>


              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-12">

                <div class="form-group">

                  <label>Marca Activo:</label>

                  <input type="text" class="form-control" name="nuevaMarcaActivo" onkeyup="mayusculas(this)" placeholder="Marca del Activo..." required>

                </div>

              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-4">

                <div class="form-group">

                  <label>Número Placa Activo:</label>

                  <input type="text" class="form-control" name="nuevoNumeroPlacaActivo" id="nuevoNumeroPlacaActivo" placeholder="Número Placa..." required onkeyup="mayusculas(this)">

                </div>

              </div>

              <div class="col-md-4">

                <div class="form-group">

                  <label>Serial Activo:</label>

                  <input type="text" class="form-control" name="nuevoSerialActivo" placeholder="Número Serial..." required onkeyup="mayusculas(this)">

                </div>

              </div>

              <div class="col-md-4">

                <div class="form-group">

                  <label>Estado Activo:</label>

                  <select class="form-control" name="nuevoEstadoActivo" required>

                    <option value="">-- Seleccione una opcion --</option>

                    <option value="BUENO">BUENO</option>
                    <option value="REGULAR">REGULAR</option>
                    <option value="MALO">MALO</option>

                  </select>

                </div>


              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-4">

                <div class="form-group">

                  <label>Fecha Adquisición Activo:</label>

                  <input type="date" class="form-control" name="nuevaFechaAdquisicionActivo" required>

                </div>
              
              </div>

              <div class="col-md-4">

                <div class="form-group">

                  <label>Centro Costos Activo:</label>

                  <select class="form-control" name="nuevoCentroCostos" id="nuevoCentroCostos" required>

                      <option>-- Seleccione una opcion --</option>

                      <option value="Ags Americas">Ags Americas</option>
                      <option value="Consorcio">Consorcio</option>

                  </select>

                </div>
              
              </div>

              <div class="col-md-4">

                <div class="form-group">

                  <label>Metodo Adquisición Activo:</label>

                  <select class="form-control" name="nuevoMetodoAdquisicionActivo" id="nuevoMetodoAdquisicionActivo" required>

                      <option>-- Seleccione una opcion --</option>

                      <option value="Propio">Propio</option>
                      <option value="Rentado">Rentado</option>

                  </select>

                </div>
              
              </div>


            </div>

            <hr>

            <div class="row">

              <div class="col-md-4">

                <div class="form-group">

                  <label>Cuenta Contable Activo</label>

                  <input type="text" class="form-control" name="nuevaCuentaContableActivo" data-inputmask="'mask':'9999999999'" data-mask>

                </div>


              </div>

              <div class="col-md-4">

                <div class="form-group">

                  <label>Valor Compra Activo:</label>

                  <input type="text" class="form-control" name="nuevoValorCompraActivo" id="nuevoValorCompraActivo">

                </div>

              </div>

              <div class="col-md-4">

                <div class="form-group">

                  <label>Valor Comercial Activo:</label>

                  <input type="text" class="form-control" name="nuevoValorComercialActivo" id="nuevoValorComercialActivo">

                </div>


              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-12">

                <div class="form-group">

                  <label>Observaciónes Activo:</label>

                  <textarea class="form-control" name="nuevaObservacionActivo" required rows="5" onkeyup="mayusculas(this)"></textarea>

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

          <button type="submit" name="GuardarActivo" class="btn btn-success"><i class="fas fa-save"></i> Guardar Activo</button>

        </div>

        <?php

          if (isset($_POST["GuardarActivo"])){

            $CrearTecnologia = new ControladorTecnologia();
            $CrearTecnologia -> ctrCrearTecnologia();
            
          }

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR ACTIVO
======================================-->
<div id="modalEditarTecnologia" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Activo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

              <div class="col-md-4">

                <div class="form-group">

                  <label>Ubicación Activo:</label>

                  <select class="form-control" name="nuevaUbicacionActivoEditar" id="nuevaUbicacionActivoEditar" required>

                    <option value="">-- Seleccione una opcion --</option>

                    <?php 
                    
                    $tablaUbicacion = "par_ubicacion";
                    $itemUbicacion = null;
                    $valorUbicacion = null;

                    $ubicaciones = ControladorTecnologia::ctrObternerDatoRequerido($tablaUbicacion, $itemUbicacion, $valorUbicacion);
                    
                    foreach($ubicaciones as $key => $valueUbicacion): 
                    
                    ?>

                    <option value="<?php echo $valueUbicacion["id_ubicacion"]; ?>"><?php echo $valueUbicacion["ubicacion"]; ?></option>


                    <?php endforeach ?>

                  </select>

                  <input type="hidden" name="idActivoEditar" id="idActivoEditar">

                </div>

              </div>

              <div class="col-md-4">

                <div class="form-group">

                  <label>Proyecto Activo:</label>

                  <select class="form-control" name="nuevoProyectoActivoEditar" id="nuevoProyectoActivoEditar" required>

                    <option value="">-- Seleccione una opcion --</option>

                    <?php 
                    
                    $tablaProyecto = "par_proyecto";
                    $itemProyecto = null;
                    $valorProyecto = null;

                    $proyectos = ControladorTecnologia::ctrObternerDatoRequerido($tablaProyecto, $itemProyecto, $valorProyecto);
                    
                    foreach($proyectos as $key => $valueProyecto): 
                    
                    ?>

                    <option value="<?php echo $valueProyecto["id_proyecto"]; ?>"><?php echo $valueProyecto["proyecto"]; ?></option>


                    <?php endforeach ?>

                  </select>

                </div>


              </div>

              <div class="col-md-2">

                <div class="form-group">
                  
                  <label>Número Puesto:</label>
                  
                  <input type="text" class="form-control" name="nuevoNumeroPuestoActivoEditar" id="nuevoNumeroPuestoActivoEditar" required>

                </div>

              </div>

              <div class="col-md-2">

                <div class="form-group">
                  
                  <label>Punto Red:</label>
                  
                  <input type="text" class="form-control" name="nuevoPuntoRedActivoEditar" id="nuevoPuntoRedActivoEditar">

                </div>

              </div>

            </div>

            <hr>

            <div class="row">
              
              <div class="col-md-6">

                <label>Responsable Asignado:</label>

                <input type="text" class="form-control" name="responsableAsignadoEditar" id="responsableAsignadoEditar" readonly>


              </div>


              <div class="col-md-6">

                <div class="form-group">
              
                  <label>Nuevo Responsable Activo:</label>

                  <select class="form-control select2" name="nuevoResposableActivoEditar" style="width: 100%;">
                    
                    <option value="">-- Seleccione una opcion --</option>

                    <?php

                    $tablaUsuario = "usuarios";
                    $itemUsuario = null;
                    $valorUsuario = null;

                    $usuarios = ControladorTecnologia::ctrObternerDatoRequerido($tablaUsuario, $itemUsuario, $valorUsuario);
                    
                    foreach($usuarios as $key => $valueUsuario): 
                    
                    ?>

                    <option value="<?php echo $valueUsuario["id_usuario"]; ?>"><?php echo $valueUsuario["nombres"] . " " . $valueUsuario["apellidos"]; ?></option>


                    <?php endforeach ?>


                  </select>


                </div>

              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <label>Categoria Activo:</label>

                  <select class="form-control" name="nuevaCategoriaActivoEditar" id="nuevaCategoriaActivoEditar" required>

                    <option value="">-- Seleccione una opcion --</option>

                    <?php

                    $tablaCategoria = "par_categoria";
                    $itemCategoria = null;
                    $valorCategoria = null;

                    $categorias = ControladorTecnologia::ctrObternerDatoRequerido($tablaCategoria, $itemCategoria, $valorCategoria);
                    
                    foreach($categorias as $key => $valueCategoria):
                    
                    ?>

                    <option value="<?php echo $valueCategoria["id_categoria"]; ?>"><?php echo $valueCategoria["categoria"]; ?></option>


                    <?php endforeach ?>


                  </select>

                </div>


              </div>

              <div class="col-md-6">

                <div class="form-group">

                  <label>Clasificación Activo:</label>

                  <input class="form-control" type="text" name="nuevaClasificacionActivoEditar" id="nuevaClasificacionActivoEditar" required readonly>

                </div>


              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-12">

                <div class="form-group">

                  <label>Marca Activo:</label>

                  <input type="text" class="form-control" name="nuevaMarcaActivoEditar" id="nuevaMarcaActivoEditar" onkeyup="mayusculas(this)" required>

                </div>

              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-4">

                <div class="form-group">

                  <label>Número Placa Activo:</label>

                  <input type="text" class="form-control" name="nuevoNumeroPlacaActivoEditar" id="nuevoNumeroPlacaActivoEditar" required>

                </div>

              </div>

              <div class="col-md-4">

                <div class="form-group">

                  <label>Serial Activo:</label>

                  <input type="text" class="form-control" name="nuevoSerialActivoEditar" id="nuevoSerialActivoEditar" required onkeyup="mayusculas(this)">

                </div>

              </div>

              <div class="col-md-4">

                <div class="form-group">

                  <label>Estado Activo:</label>

                  <select class="form-control" name="nuevoEstadoActivoEditar" id="nuevoEstadoActivoEditar" required>

                    <option value="">-- Seleccione una opcion --</option>

                    <option value="BUENO">BUENO</option>
                    <option value="REGULAR">REGULAR</option>
                    <option value="MALO">MALO</option>

                  </select>

                </div>


              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-4">

                <div class="form-group">

                  <label>Fecha Adquisición Activo:</label>

                  <input type="date" class="form-control" name="nuevaFechaAdquisicionActivoEditar" id="nuevaFechaAdquisicionActivoEditar" required>

                </div>

              </div>

              <div class="col-md-4">

                <div class="form-group">

                  <label>Centro Costos Activo:</label>

                  <select class="form-control" name="nuevoCentroCostosEditar" id="nuevoCentroCostosEditar" required>

                      <option>-- Seleccione una opcion --</option>

                      <option value="Ags Americas">Ags Americas</option>
                      <option value="Consorcio">Consorcio</option>

                  </select>

                </div>
              
              </div>

              <div class="col-md-4">

                <div class="form-group">

                  <label>Metodo Adquisición Activo:</label>

                  <select class="form-control" name="nuevoMetodoAdquisicionActivoEditar" id="nuevoMetodoAdquisicionActivoEditar" required>

                    <option value="">-- Seleccione una opcion --</option>

                    <option value="Propio">Propio</option>
                    <option value="Rentado">Rentado</option>

                  </select>

                </div>

              </div>


            </div>

            <hr>

            <div class="row">

              <div class="col-md-4">

                <div class="form-group">

                  <label>Cuenta Contable Activo</label>

                  <input type="text" class="form-control" name="nuevaCuentaContableActivoEditar" id="nuevaCuentaContableActivoEditar" data-inputmask="'mask':'9999999999'" data-mask>

                </div>


              </div>

              <div class="col-md-4">

                <div class="form-group">

                  <label>Valor Compra Activo:</label>

                  <input type="text" class="form-control" name="nuevoValorCompraActivoEditar" id="nuevoValorCompraActivoEditar">

                </div>

              </div>

              <div class="col-md-4">

                <div class="form-group">

                  <label>Valor Comercial Activo:</label>

                  <input type="text" class="form-control" name="nuevoValorComercialActivoEditar" id="nuevoValorComercialActivoEditar">

                </div>


              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-12">

                <div class="form-group">

                  <label>Observaciónes Activo:</label>

                  <textarea class="form-control" name="nuevaObservacionActivoEditar" id="nuevaObservacionActivoEditar" required rows="5" onkeyup="mayusculas(this)"></textarea>

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

          <button type="submit" name="EditarActivo" class="btn btn-success"><i class="fas fa-save"></i> Guardar Activo</button>

        </div>

        <?php

          if (isset($_POST["EditarActivo"])){

            $CrearTecnologia = new ControladorTecnologia();
            $CrearTecnologia -> ctrEditarTecnologia();
            
          }

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL CAMBIAR ESTADO ACTIVO
======================================-->
<div id="modalCambiarEstadoActivo" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Cambiar Estado Activo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <label>Estado Activo Actual:</label>

                  <div id="estadoActualActivo"></div>

                  <input type="hidden" name="idActivoCambioEstado" id="idActivoCambioEstado">

                </div>

              </div>

              <div class="col-md-6">

                <div class="form-group">

                  <label>Nuevo Estado Activo:</label>

                  <select class="form-control" name="nuevoEstadoActivo" required>

                    <option value="">-- Seleccione una opcion --</option>

                    <option value="BUENO">BUENO</option>
                    <option value="REGULAR">REGULAR</option>
                    <option value="MALO">MALO</option>

                  </select>

                </div>

              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-12">

                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" style="color: #00a65a;" href="#collapseInfoActivoCambioEstado" class="collapsed" aria-expanded="false">
                        Información del Activo
                      </a>
                    </h4>
                  </div>
                  <div id="collapseInfoActivoCambioEstado" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
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

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>

          <button type="submit" name="cambiarEstadoActivo" class="btn btn-success"><i class="fas fa-save"></i> Guardar Activo</button>

        </div>

        <?php

          if (isset($_POST["cambiarEstadoActivo"])){

            $actualizarTecno = new ControladorTecnologia();
            $actualizarTecno->ctrActualizarEstadoActivo();
            
          }

        ?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL AGREGAR MANTENIMIENTO
======================================-->
<div id="modalAgregarMantenimiento" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Mantenimiento</h4>

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

                      <input type="text" class="form-control" name="nuevoResponsableMantenimiento" placeholder="Ingresar responsable del mantenimiento" value="<?php echo $_SESSION["nombres"] . " " . $_SESSION["apellidos"]; ?>" required readonly>

                      <input type="hidden" id="editarIdActivosss" name="editarIdActivosss">

                      <input type="hidden" id="mantenimientoIdActivo" name="mantenimientoIdActivo">

                      <input type="hidden" name="numeroPlacaMantenimiento" id="numeroPlacaMantenimiento">

                      <input type="hidden" name="numeroSerialMantenimiento" id="numeroSerialMantenimiento">

                  </div>

                </div>
              
              </div>

              <div class="col-md-4">

                <div class="form-group">

                  <label>Fecha Mantenimiento:</label>
                  
                  <div class="input-group">
                      
                    <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span> 

                    <input type="date" class="form-control" name="fechaMantenimientoRealizado" id="nuevofecha_mant" required readonly value="<?php $fecha_actual = date("d-m-Y"); echo date("Y-m-d",strtotime($fecha_actual)); ?>">

                  </div>

                </div>

              </div>

              <div class="col-md-4">

                <!-- ENTRADA PARA LA  PROXIMA FECHA DE MANTENIMIENTO-->

                <div class="form-group">

                  <label>Fecha de Proximo Mantenimiento:</label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span> 

                    <input type="date" class="form-control"  name="fechaProximoMantenimiento" id="fechanueva" value="<?php  $fecha_actual = date("d-m-Y"); echo date("Y-m-d",strtotime($fecha_actual."+ 6 month")); ?>" readonly required>

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
                      <a data-toggle="collapse" data-parent="#accordion" style="color: #00a65a;" href="#collapseInfoActivo" class="collapsed" aria-expanded="false">
                        Información del Activo
                      </a>
                    </h4>
                  </div>
                  <div id="collapseInfoActivo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="box-body">

                      <div id="contenedorInfoActivoMantenimiento"></div>

                    </div>
                  </div>
                </div>

              </div>

            </div>

            <hr>

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

            <hr>
            
            <div class="row">

              <div class="col-md-8">

                <!-- ENTRADA PARA LAS OBSERVACIONES  -->
                <div class="form-group">
                  <label>Observaciones del Mantenimiento:</label>
                  <div class="input-group">              
                    <span class="input-group-addon"><i class="fa fa-book"></i></span> 
                    <textarea type="text" rows="8" class="form-control" name="nuevaObservacionesMantenimiento" id="nuevaObservaciones" placeholder="Ingresar las observaciones" required onkeyup="mayusculas(this)"></textarea>
                  </div>
                </div>

              </div>

              <div class="col-md-4">

                <!-- ENTRADA PARA EL COLOR  -->

                <div class="form-group">

                  <label>Color Evento:</label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-superpowers"></i></span> 

                    <input type="color" class="form-control" name="nuevoColorMantenimiento" id="nuevocolor" placeholder="Ingresar el color del activo" required>

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

          <button type="submit" name="cargarMantenimiento" class="btn btn-success"><i class="fas fa-save"></i> Guardar Mantenimiento</button>

        </div>

        <?php

          if(isset($_POST["cargarMantenimiento"])){

            $crearUsuario = new ControladorCronograma();
            $crearUsuario -> ctrCrearMantenimiento();

          }

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL INFORMACION ACTIVO
======================================-->
<div id="modalVerInformacionActivo" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Ver Información Activo</h4>

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
                    <a data-toggle="collapse" data-parent="#accordion" style="color: #00a65a;" href="#collapseInfoActivoTecnologia" class="collapsed" aria-expanded="false">
                      Información del Activo
                    </a>
                  </h4>
                </div>
                <div id="collapseInfoActivoTecnologia" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                  <div class="box-body">

                    <div id="contenedorInfoActivoTecnologia"></div>

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