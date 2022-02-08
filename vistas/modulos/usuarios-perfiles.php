<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administracion Usuarios - Perfil
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Usuarios - Perfil</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarPerfilUsuario">
          
            <i class="fas fa-user-lock"></i>

            Asignar Usuario - Perfil

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre Usuario</th>
           <th>Perfil</th>
           <th>Permiso</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php 
        
        $item = null;
        $valor = null;

        $usuariosPerfiles = ControladorPerfilesUsuarios::ctrMostrarUsuariosPerfiles($item, $valor);

        foreach($usuariosPerfiles as $key => $value): ?>
          <tr>
            <td><?php echo $value["id_perfil_usuario"]; ?></td>
            <td><?php echo $value["nombre_usuario"]; ?></td>
            <td><?php echo $value["nombre_perfil"]; ?></td>
            <td><?php echo $value["nombre_permiso"]; ?></td>
            <td><button class="btn btn-danger btn-xs btnEliminarPerfilUsuario" idPerfilUsuario="<?php echo $value["id_perfil_usuario"]; ?>" title="Eliminar Perfil Usuario"><i class="fa fa-times"></i></button></td>
          </tr>
        
        <?php endforeach ?>


        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarPerfilUsuario" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Asignar Usuario - Perfil</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA SELECCION USUARIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <select name="nuevoUsuario" style="width: 100%;" class="form-control select2" id="nuevoUsuario" required>

                    <option value="">-- Seleccione un Usuario --</option>

                    <?php 
                    
                    $item = null;
                    $valor = null;

                    $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item,$valor);
                    
                    foreach($usuarios as $key => $value): ?>

                        <option value="<?php echo $value["id_usuario"]; ?>"><?php echo $value["nombres"] . " " . $value["apellidos"]; ?></option>

                    <?php endforeach ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCION PERFIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fas fa-user-lock"></i></span>

                <select name="nuevoPerfil" class="form-control" id="nuevoPerfil" required>

                    <option value="">-- Seleccione un Software --</option>

                    <?php 
                    
                    $item = null;
                    $valor = null;

                    $perfiles = ControladorPerfilesUsuarios::ctrMostrarPerfiles($item, $valor);
                    
                    foreach($perfiles as $key => $value): ?>

                        <option value="<?php echo $value["id_perfil"]; ?>"><?php echo $value["nombre_perfil"]; ?></option>

                    <?php endforeach ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCION PERMISOS -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fas fa-user-lock"></i></span>

                <select name="nuevoPermiso" class="form-control" id="nuevoPermiso" required>

                </select>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>

          <button type="submit" name="crearUsuarioPerfil" class="btn btn-success"><i class="fas fa-save"></i> Guardar Asignacion</button>

        </div>

        <?php

          if(isset($_POST["crearUsuarioPerfil"])){

            $crearUsuario = new ControladorPerfilesUsuarios();
            $crearUsuario -> crearUsuarioPerfil();
          
          }
        ?>

      </form>

    </div>

  </div>

</div>

<?php

  $borrarPerfilUsuario = new ControladorPerfilesUsuarios();
  $borrarPerfilUsuario->ctrBorrarPerfilUsuario();

?>