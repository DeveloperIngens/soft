<div class="content-wrapper">

  <?php $ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/vistas/modulos/ui/validacion-permiso.php"; 

    include_once $ruta;
  
  ?>

  <section class="content-header">
    
    <h1>
      
      Proyectos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio-cor"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Proyectos</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- INCLUIMOS MENU DE CORRESPONDENCIA -->
    <?php include_once "ui/menu-cor.php"; ?>

    <div class="box box-info">
        
        <div class="box-header with-border">

            <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarProyecto"><i class="fas fa-clipboard-list"></i> Agregar Proyecto</button>

        </div>

        <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                
                <thead>
                
                    <tr>
                    
                        <th style="width:10px">#</th>
                        <th>Nombre Proyecto</th>
                        <th>Prefijo Proyecto</th>
                        <th>Número Concecutivo</th>
                        <th>Responsable</th>
                        <th>Acciones</th>
        
                    </tr> 
        
                </thead>
        
                <tbody>

                <?php 
                
                $tabla = "proyectos_cor";
                $item = null;
                $valor = null;
                
                $proyectos = ControladorParametricasCor::ctrObtenerDatoRequerido($tabla, $item, $valor);

                foreach($proyectos as $key => $valueProyectos): 
                    
                    //OBTENER DATOS DE RESPONSABLES

                    $tablaResponsable = "usuarios";
                    $itemResponsable = "id_usuario";
                    $valorResponsable = $valueProyectos["id_responsable"];

                    $datoResponsable = ControladorParametricasCor::ctrObtenerDatoRequerido($tablaResponsable, $itemResponsable, $valorResponsable);
                
                ?>

                    <tr>

                        <td><?php echo $valueProyectos["id_proyecto"]; ?></td>
                        <td><?php echo $valueProyectos["nombre_proyecto"]; ?></td>
                        <td><?php echo $valueProyectos["prefijo_proyecto"]; ?></td>
                        <td><?php echo $valueProyectos["numero_concecutivo"]; ?></td>
                        <td><?php echo $datoResponsable["correo"]; ?></td>
                        <td>
                          <?php if($_SESSION["rol_software"] = "administrar"): ?>

                              <button class="btn btn-danger btn-xs btnEliminarProyecto" idProyecto="<?php echo $valueProyectos["id_proyecto"]; ?>"><i class="fa fa-trash"></i></button>
                              <button class="btn btn-info btn-xs btnEditarProyecto" idProyecto="<?php echo $valueProyectos["id_proyecto"]; ?>" data-toggle="modal" data-target="#modalEditarProyecto"><i class="fas fa-edit"></i></button>
                          
                          <?php else: ?>

                              <button class="btn btn-default btn-xs"><i class="fa fa-trash"></i></button>
                              <button class="btn btn-default btn-xs"><i class="fas fa-edit"></i></button>

                          <?php endif ?>
                        </td>

                    </tr>


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
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarProyecto" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Proyecto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

                <!-- ENTRADA PARA NOMBRE PROYECTO -->
                <div class="form-group">
                
                    <label>Nombre Proyecto:</label>

                    <div class="input-group"> 

                        <input type="text" class="form-control" name="nuevoNombreProyecto" onkeyup="mayusculas(this)" required>

                        <span class="input-group-addon"><i class="fas fa-star"></i></span>

                    </div>

                </div>

                <!-- ENTRADA PARA PREFIJO PROYECTO -->
                <div class="form-group">
                
                    <label>Prefijo Proyecto:</label>

                    <div class="input-group"> 
                        
                        <input type="text" class="form-control" name="nuevoPrefijoProyecto" onkeyup="mayusculas(this)" id="nuevoPrefijoProyecto" required>

                        <span class="input-group-addon"><i class="fas fa-star"></i></span>

                    </div>

                </div>


                <!-- ENTRADA PARA SELECCION RESPONSABLE -->

                <div class="form-group">

                    <label>Responsable</label>
                    
                    <div class="input-group">

                        <select class="form-control" name="nuevaPersonaResponsable" required>


                            <option value="">-- Seleccione una opcion --</option>

                            <?php 
                            
                            $itemUsuario = null;
                            $valorUsuario = null;

                            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);
                            
                            foreach($usuarios as $key => $valueUsuarios): ?>

                                <option value="<?php echo $valueUsuarios["id_usuario"]; ?>"><?php echo $valueUsuarios["nombres"] . " " . $valueUsuarios["apellidos"];   ?></option>

                            <?php endforeach ?>


                        </select>

                        <span class="input-group-addon"><i class="fas fa-star"></i></span>

                    </div>
                </div>


          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>

          <button type="submit" name="crearProyecto" class="btn btn-success"><i class="fas fa-save"></i> Guardar Proyecto</button>

        </div>

        <?php

          if(isset($_POST["crearProyecto"])){

            $crearProyecto = new ControladorParametricasCor();
            $crearProyecto->ctrCrearProyecto();
          
          }
        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalEditarProyecto" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Proyecto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

                <!-- ENTRADA PARA NOMBRE PROYECTO -->
                <div class="form-group">
                
                    <label>Nombre Proyecto:</label>

                    <div class="input-group"> 

                        <input type="text" class="form-control" name="editarNombreProyecto" onkeyup="mayusculas(this)" id="editarNombreProyecto" required>

                        <input type="hidden" name="idProyecto" id="idProyecto">

                        <span class="input-group-addon"><i class="fas fa-star"></i></span>

                    </div>

                </div>

                <!-- ENTRADA PARA PREFIJO PROYECTO -->
                <div class="form-group">
                
                    <label>Prefijo Proyecto:</label>

                    <div class="input-group"> 
                        
                        <input type="text" class="form-control" name="editarPrefijoProyecto" onkeyup="mayusculas(this)" id="editarPrefijoProyecto" readonly>

                        <span class="input-group-addon"><i class="fas fa-star"></i></span>

                    </div>

                </div>

                <!-- ENTRADA PARA SELECCION RESPONSABLE -->

                <div class="form-group">

                    <label>Responsable</label>
                    
                    <div class="input-group">

                        <select class="form-control" name="editarPersonaResponsable" required>

                            <option id="editarPersonaResponsable"></option>

                            <optgroup label="-- Mas Opciones --"></optgroup>

                            <?php 
                            
                            $itemUsuario = null;
                            $valorUsuario = null;

                            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);
                            
                            foreach($usuarios as $key => $valueUsuarios): ?>

                                <option value="<?php echo $valueUsuarios["id_usuario"]; ?>"><?php echo $valueUsuarios["nombres"] . " " . $valueUsuarios["apellidos"];   ?></option>

                            <?php endforeach ?>


                        </select>

                        <span class="input-group-addon"><i class="fas fa-star"></i></span>

                    </div>
                </div>


          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>

          <button type="submit" name="editarProyecto" class="btn btn-success"><i class="fas fa-save"></i> Guardar Proyecto</button>

        </div>

        <?php

          if(isset($_POST["editarProyecto"])){

            $editarProyecto = new ControladorParametricasCor();
            $editarProyecto->ctrEditarProyecto();
          
          }
        ?>

      </form>

    </div>

  </div>

</div>

<?php 

    $eliminarProyecto = new ControladorParametricasCor();
    $eliminarProyecto->ctrEliminarProyecto();

?>