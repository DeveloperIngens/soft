<?php if(!isset($_GET["idUsuario"])): ?>

<div id="back"></div>

<div class="login-box">
  
  <div class="login-logo">

    <!--<img src="vistas/img/plantilla/Ags_logo.png" class="img-responsive" style="padding:30px 100px 0px 100px">-->

  </div>

  <div class="login-box-body shadow" style="border-radius: 30px;">
    <img src="vistas/img/plantilla/ags.png" class="img-responsive" >
    <hr>
    <b><p class="login-box-msg">Restauración de Contraseña</p></b>

    <form method="post">

        <div class="form-group has-feedback">

            <input type="email" class="form-control" placeholder="Correo" name="correoEnvia" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>

        </div>

        <center><button class="btn btn-success btn-xs" name="enviarCorreo"><i class="fa fa-send-o"></i> Enviar Codigo</button></center>

        <?php

        if(isset($_POST["enviarCorreo"])):

            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $codigoContrasena = substr(str_shuffle($permitted_chars), 0, 15);

            $correo = $_POST["correoEnvia"];

            $item = "correo";
		    $valor = $correo;

		    $infoUsuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

            $idUsuario = $infoUsuario["id_usuario"];

            $guarDatos = ControladorUsuarios::ctrGuardarCodigoContrasena($correo, $codigoContrasena);

            $enviarCorreo = ControladorCorreo::ctrCorreoCodigoVerificacion($correo, $codigoContrasena);

        ?>

            <?php 

                if($enviarCorreo == "ok"){

                    echo "<script>

                        swal({

                            type: 'success',
                            title: '¡Se envio el Codigo de Verificación a el correo digitado para la restauración de la contraseña!',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar'

                        }).then(function(result){

                            if(result.value){
                            
                                window.location = 'index.php?ruta=restaurar-contrasenia&idUsuario=".$infoUsuario["id_usuario"]."';

                            }

                        });


                    </script>";


                }

            ?>

        <?php endif ?>


    </form>

    <hr>
    <font face="arial" size="1">Derechos reservados© 2021 </font>
      <img src="vistas/img/plantilla/ags.png" width="80" height="25" alt=""/>
    <font face="arial" size="1"><b>Version 1.0</b></font>

  </div>
  <br>
  <b><center>Realizar Test Velocidad <a href="https://www.speedtest.net/es" target="_blank">Aqui</a></center></b>
</div>

<?php endif ?>

<?php if(isset($_GET["idUsuario"])): ?>

<div id="back"></div>

<div class="login-box">
  
  <div class="login-logo">

    <!--<img src="vistas/img/plantilla/Ags_logo.png" class="img-responsive" style="padding:30px 100px 0px 100px">-->

  </div>

  <div class="login-box-body shadow" style="border-radius: 30px;">
    <img src="vistas/img/plantilla/ags.png" class="img-responsive" >
    <hr>
    <b><p class="login-box-msg">Restauración de Contraseña</p></b>

    <form method="post">

        <div class="form-group has-feedback">

            <input type="text" class="form-control" placeholder="Código Verficicacion" name="codigoVeri" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>

        </div>

        <center><button class="btn btn-success btn-xs" name="validarCodigo"><i class="fa fa-send-o"></i> Validar Código</button></center>

        <?php

        if(isset($_POST["validarCodigo"])):

            $idUsuario = $_GET["idUsuario"];
            $codigoVerificacion = $_POST["codigoVeri"];

            $respuestaValidacion = ControladorUsuarios::ctrValidarCodigoVerificacion($idUsuario, $codigoVerificacion);

            if(!empty($respuestaValidacion)){

                $permitted_chars = '0123456789';
                $codigoContrasena = substr(str_shuffle($permitted_chars), 0, 10);

                $cadenaContrasenia = "AGSAMERICAS".$codigoContrasena;

                $actualizarContrasena = ControladorUsuarios::ctrActualizarContrasena($idUsuario, $cadenaContrasenia);

                $enviarCorreo = ControladorCorreo::ctrCorreoNuevaContrasena($idUsuario, $cadenaContrasenia);

                echo "<script>

                    swal({

                        type: 'success',
                        title: '¡Se envio a su correo la nueva contraseña con la cual tendra acceso al Software!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = 'login';

                        }

                    });


                </script>";

            }else{

                echo "<script>

                    swal({

                        type: 'error',
                        title: '¡El Código de Verificación no es correcto.!',
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = 'index.php?ruta=restaurar-contrasenia&idUsuario=".$idUsuario."';

                        }

                    });


                </script>";

            }


        ?>

        <?php endif ?>


    </form>

    <hr>
    <font face="arial" size="1">Derechos reservados© 2021 </font>
      <img src="vistas/img/plantilla/ags.png" width="80" height="25" alt=""/>
    <font face="arial" size="1"><b>Version 1.0</b></font>

  </div>
  <br>
  <b><center>Realizar Test Velocidad <a href="https://www.speedtest.net/es" target="_blank">Aqui</a></center></b>
</div>


<?php endif ?>