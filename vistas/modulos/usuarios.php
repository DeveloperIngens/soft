<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Usuarios
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Usuarios</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarUsuario">
          
          <i class="fas fa-user-plus"></i>

          Agregar usuario

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Correo</th>
           <th>Estado</th>
           <th>Perfil</th>
           <th>Último login</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php 
        
        $item = null;
        $valor = null;
        
        $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        foreach($usuarios as $key => $value): 
        
        ?>

          <?php if($value["id_usuario"] != $_SESSION["id_usuario"]): ?>

          <tr>

            <td><?php echo $value["id_usuario"] ?></td>
            <td><?php echo $value["nombres"]." ". $value["apellidos"]; ?></td>
            <td><?php echo $value["correo"] ?></td>

            <?php if($value["estado"] != 0): ?>

              <td><button class="btn btn-success btn-xs btnActivar" idUsuario="<?php echo $value["id_usuario"]; ?>" estadoUsuario="0">Activado</button></td>

            <?php else: ?>

              <td><button class="btn btn-danger btn-xs btnActivar" idUsuario="<?php echo $value["id_usuario"]; ?>" estadoUsuario="1">Desactivado</button></td>

            <?php endif ?>

            <td><?php echo $value["perfil_ingreso"]; ?></td>

            <td><?php echo $value["ultima_conexion"]; ?></td>

            <td>
              
              <div class="btn-group">

                <button class="btn btn-warning btn-xs btnEditarUsuario" idUsuario="<?php echo $value["id_usuario"]; ?>" data-toggle="modal" data-target="#modalEditarUsuario" title="Editar Usuario"><i class="fa fa-pencil"></i></button>

                <button class="btn btn-danger btn-xs btnEliminarUsuario" idUsuario="<?php echo $value["id_usuario"]; ?>" title="Eliminar Usuario"><i class="fa fa-times"></i></button>

              </div>

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
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarUsuario" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required onkeyup="mayusculas(this)">

              </div>

            </div>

            <!-- ENTRADA PARA LOS APELLIDOS -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoApellido" placeholder="Ingresar apellido" required onkeyup="mayusculas(this)">

              </div>

            </div>

            <!-- ENTRADA PARA IDENTIFICACION USUARIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="far fa-credit-card"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoNumeroIdentificacion" id="nuevoNumeroIdentificacionAdmin" placeholder="Ingresar Número Identificación" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL CORREO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-at"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoCorreo" placeholder="Ingresar Correo" id="nuevoCorreo" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" name="nuevoContrasena" placeholder="Ingresar contraseña" required>

              </div>

            </div>

            <!-- ENTRADA SELECCION PERFIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fas fa-user-lock"></i></span>

                <select class="form-control input-lg" name="nuevoPerfil" id="nuevoPerfil" required>

                  <option value="">-- Seleccione una opcion --</option>

                  <option value="Administrador">Administrador</option>

                  <option value="Consulta">Consulta</option>

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

          <button type="submit" name="crearUsuario" class="btn btn-success"><i class="fas fa-save"></i> Guardar Usuario</button>

        </div>

        <?php

          if(isset($_POST["crearUsuario"])){

            $crearUsuario = new ControladorUsuarios();
            $crearUsuario -> ctrCrearUsuarioIn();
          
          }
        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarUsuario" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA LOS NOMBRES -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="editarNombresAdmin" name="editarNombresAdmin" value="" required>

                <input type="hidden" id="idUsuarioEditarAdmin" name="idUsuarioEditarAdmin">

              </div>

            </div>

            <!-- ENTRADA PARA LOS APELLIDOS -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> 

                <input type="text" class="form-control input-lg" id="editarApellidosAdmin" name="editarApellidosAdmin" value="" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL CORREO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" id="editarCorreoAdmin" name="editarCorreoAdmin" value="" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" name="editarContrasenaAdmin" placeholder="Escriba la nueva contraseña">

                <input type="hidden" id="contrasenaActualEditarAdmin" name="contrasenaActualEditarAdmin">

              </div>

            </div>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fas fa-user-lock"></i></span>

                <select class="form-control input-lg" name="editarPerfilAdmin" required>

                  <option id="editarPerfilAdmin" value=""></option>

                  <optgroup label="Selecciona una opcion"></optgroup>

                  <option value="Administrador">Administrador</option>

                  <option value="Consulta">Consulta</option>

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

          <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Modificar Usuario</button>

        </div>

     <?php

          $editarUsuario = new ControladorUsuarios();
          $editarUsuario -> ctrEditarUsuario();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrarUsuario = new ControladorUsuarios();
  $borrarUsuario -> ctrBorrarUsuario();

?> 


