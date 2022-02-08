<div class="content-wrapper">

  <?php 
    
    $ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/vistas/modulos/ui/validacion-permiso.php"; 

    include_once $ruta;

  ?>

  <section class="content-header">
    
    <h1>
      
      Administración Mantenimientos Preventivos - Correctivos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio-inv"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administración Mantenimientos Preventivos - Correctivos</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- INCLUIMOS MENU DE CORRESPONDENCIA -->
    <?php include_once "ui/menu-inv.php"; ?>

    <div class="box box-info">
        
        <div class="box-header with-border">

            <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarMantenimientos"><i class="fas fa-tools"></i> Agregar Mantenimiento Preventivo/Correctivo</button>

        </div>

        <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                
                <thead>
                
                    <tr>
                    
                        <th style="width:10px">#</th>
                        <th>Categoria</th>
                        <th>Nombre Mantenimiento</th>
                        <th>Tipo Mantenimiento</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
        
                    </tr> 
        
                </thead>
        
                <tbody>

                <?php 
                
                $tabla = "par_tipo_mantenimiento";
                $item = null;
                $valor = null;
                
                $mantenimietosPreCor = ControladorCorrectivo::ctrObternerDatoRequerido($tabla, $item, $valor);

                foreach($mantenimietosPreCor as $key => $valueMante): 
                    
                    //OBTENER DATOS DE RESPONSABLES

                    $tablaResponsable = "usuarios";
                    $itemResponsable = "id_usuario";
                    $valorResponsable = $valueMante["id_usuario_creacion"];

                    $datoResponsable = ControladorParametricasCor::ctrObtenerDatoRequerido($tablaResponsable, $itemResponsable, $valorResponsable);

                    $tablaCategoria = "par_categoria";
                    $itemCategoria = "id_categoria";
                    $valorCategoria = $valueMante["id_categoria"];

                    $categoria = ControladorTecnologia::ctrObternerDatoRequerido($tablaCategoria, $itemCategoria, $valorCategoria);
                
                ?>

                  <?php if($valueMante["estado"] == 1): ?>

                    <tr>
                        <td><?php echo $valueMante["id_tipo_mantenimiento"]; ?></td>
                        <td><?php echo $categoria["categoria"]; ?></td>
                        <td><?php echo $valueMante["nombre_mantenimiento"]; ?></td>
                        <td><?php echo $valueMante["tipo"]; ?></td>
                        <td><?php echo $valueMante["tipo_mantenimiento"]; ?></td>
                        <td>
                          <?php if($_SESSION["rol_software"] = "administrar"): ?>

                            <button class="btn btn-info btnEditarCorrectivo btn-xs" title="Editar Mantenimiento" IdCorrectivo="<?php echo $valueMante["id_tipo_mantenimiento"] ?>" data-toggle="modal" data-target="#modalEditarCorrectivo"><i class="fa fa-pencil"></i></button>                
                            <button class="btn btn-danger btnEliminarCorrectivo btn-xs" title="Eliminar Mantenimiento" IdCorrectivo="<?php echo $valueMante["id_tipo_mantenimiento"] ?>"><i class="fa fa-times"></i></button>
                          
                          <?php else: ?>

                              <button class="btn btn-default btn-xs"><i class="fa fa-trash"></i></button>
                              <button class="btn btn-default btn-xs"><i class="fas fa-edit"></i></button>

                          <?php endif ?>
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
MODAL CREAR MANTENIMIENTOS PREVENTIVOS/CORRECTIVOS
======================================-->

<div id="modalAgregarMantenimientos" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Crear Mantenimiento Preventivo/Correctivo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">
              <div class="col-md-12">
                <!-- ENTRADA PARA EL NOMBRE DE LOS MANTENIMIENTOS -->
                <div class="form-group">
                  <label>Categoria Activo:</label>
                  <div class="input-group">              
                    <span class="input-group-addon"><i class="fab fa-elementor"></i></span> 
                    <select class="form-control" name="nuevoTipoActivo" required>

                      <option value="">-- Seleccione una opcion --</option>

                      <?php 
                      
                      $tabla = "par_categoria";
                      $item = null;
                      $valor = null;

                      $categoriasActivos = ControladorTecnologia::ctrObternerDatoRequerido($tabla, $item, $valor);
                      
                      foreach($categoriasActivos as $key => $valueCategoria): ?>

                        <option value="<?php echo $valueCategoria["id_categoria"]; ?>"><?php echo $valueCategoria["categoria"]; ?></option>

                      <?php endforeach ?>

                    </select>
                  </div>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-md-12">
                <!-- ENTRADA PARA EL NOMBRE DE LOS MANTENIMIENTOS -->
                <div class="form-group">
                  <label>Titulo Mantenimiento Preventivo/Correctivo:</label>
                  <div class="input-group">              
                    <span class="input-group-addon"><i class="fas fa-tools"></i></span> 
                    <input type="text" class="form-control" name="nuevoMantenimientos" id="nuevoMantenimientos" placeholder="Ingresar Titulo del Mantenimiento" required onkeyup="mayusculas(this)">
                  </div>
                </div>
              </div>
            </div>


            <div class="row">

              <div class="col-md-6">
                <!-- ENTRADA TIPO DE MANTENIMINETO -->
                <div class="form-group">
                  <label>Tipo Mantenimiento:</label>
                  <div class="input-group">                  
                    <span class="input-group-addon"><i class="fa fa-windows"></i></span>
                    <select name="nuevoTipo" id="nuevoTipo" class="form-control" required>
                      <option value="">-- Seleccione una opcion --</option>
                      <option value="Hardware">Hardware</option>
                      <option value="Software">Software</option>
                    </select>
                  </div>
                </div>

              </div>

              <div class="col-md-6">
                <!-- ENTRADA PARA PARA  EL TIPO DE MANTENIMIENTO (CORRECTIVO,PREVENTIVO) -->
                <div class="form-group">
                  <label>Clase Mantenivimiento:</label>
                  <div class="input-group">                  
                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                    <select name="nuevoTipos" id="nuevoTipos" class="form-control" required>
                      <option value="">-- Seleccione una opcion --</option>
                      <option value="Preventivo">Preventivo</option>
                      <option value="Correctivo">Correctivo</option>
                    </select>
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

          <button type="submit" name="Agregar" class="btn btn-success"><i class="fas fa-save"></i> Guardar Mantenimiento</button>

        </div>

        <?php

           if(isset($_POST["Agregar"])){

            $AgregarCorrectivo = new ControladorCorrectivo();
            $AgregarCorrectivo ->ctrCrearCorrectivo();
          
          
          }
        ?>

      </form>

    </div>

  </div>

</div> 

<!--=====================================
MODAL EDITAR MANTENIMIENTOS PREVENTIVO CORRECTIVO
======================================-->

<div id="modalEditarCorrectivo" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Mantenimiento Preventivo/Correctivo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <div class="row">

              <div class="col-md-12">

                <div class="form-group">
                  <label>Categoria Activo:</label>
                  <div class="input-group">              
                    <span class="input-group-addon"><i class="fab fa-elementor"></i></span> 
                    <select class="form-control" name="editarTipoActivo" id="editarTipoActivo" required>

                      <option value="">-- Seleccione una opcion --</option>

                      <?php 
                      
                      $tabla = "par_categoria";
                      $item = null;
                      $valor = null;
                      $categoriasActivos = ControladorTecnologia::ctrObternerDatoRequerido($tabla, $item, $valor);
                      
                      foreach($categoriasActivos as $key => $valueCategoria): ?>

                        <option value="<?php echo $valueCategoria["id_categoria"]; ?>"><?php echo $valueCategoria["categoria"]; ?></option>

                      <?php endforeach ?>

                    </select>
                  </div>
                </div>


              </div>

            </div>

            <div class="row">

              <div class="col-md-12">

                <!-- ENTRADA PARA EL NOMBRE DE LOS MANTENIMIENTOS -->
                <div class="form-group">  
                  <label>Titulo Mantenimiento Preventivo/Correctivo:</label>          
                  <div class="input-group">              
                    <span class="input-group-addon"><i class="fas fa-tools"></i></span> 
                    <input type="text" class="form-control" name="editarNombre" id="editarNombre" placeholder="Ingresar nombre del mantenimiento" required>
                    <input type="hidden" name="editarMantenimiento" id="editarMantenimiento" value="">
                  </div>
                </div>

              </div>

            </div>


          <div class="row">

            <div class="col-md-6">

              <!-- ENTRADA TIPO DE MANTENIMINETO -->
              <div class="form-group"> 
                <label>Tipo Mantenimiento:</label>
                <div class="input-group">                  
                  <span class="input-group-addon"><i class="fa fa-windows"></i></span>
                  <select name="editarTipo" id="editarTipo" class="form-control" required>
                    <option value="">-- Seleccione una opcion --</option>
                    <option value="Hardware">Hardware</option>
                    <option value="Software">Software</option>
                  </select>
                </div>
              </div>

            </div>

            <div class="col-md-6">
              
              <!-- ENTRADA PARA PARA  EL TIPO DE MANTENIMIENTO (CORRECTIVO,PREVENTIVO) -->
              <div class="form-group"> 
                <label>Clase Mantenimiento:</label>
                <div class="input-group">                  
                  <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                  <select name="editarTipos" id="editarTipos" class="form-control" required>
                    <option value="">-- Seleccione una opcion --</option>
                    <option value="Preventivo">Preventivo</option>
                    <option value="Correctivo">Correctivo</option>
                  </select>
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
          <button type="submit" name="editarCorrectivo"  class="btn btn-success"><i class="fas fa-save"></i> Editar Mantenimiento</button>
        </div>

        <?php

           if(isset($_POST["editarCorrectivo"])){

            $EditarCorrectivo = new ControladorCorrectivo();
            $EditarCorrectivo -> ctrEditarMantenimiento();          
          
          }
        ?>

      </form>

    </div>

  </div>

</div> 

<?php 

  $borra = new ControladorCorrectivo();
  $borra->ctrBorrarCorrectivo();

?>
      