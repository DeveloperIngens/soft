<div id="back"></div>

<div class="login-box">
  
  <div class="login-logo">

    <!--<img src="vistas/img/plantilla/Ags_logo.png" class="img-responsive" style="padding:30px 100px 0px 100px">-->

  </div>

  <div class="login-box-body shadow" style="border-radius: 30px;">
    <img src="vistas/img/plantilla/ags.png" class="img-responsive" >
    <hr>
    <b><p class="login-box-msg">Bienvenido <a style="color: #e0e65e;" href="https://www.agsamericas.com/" target="-blank">AGS AMERICAS</a></p></b>

    <form method="post">

      <div class="form-group has-feedback">

        <input type="email" class="form-control" placeholder="Correo" name="ingUsuario" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

      </div>

      <div class="form-group">

        <a href="restaurar-contrasenia" class="pull-right">Olvidé mi contraseña</a>

        <br>

      </div>

      <div class="form-group">
       
          <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          <br>
          <small>Puede registrarse y almacenar su hoja de vida.</small>
          <br>
          <br>
          <a href="registro" class="btn btn-success btn-block">Registrar Hoja de Vida</a>

      </div>

      <?php

        $login = new ControladorUsuarios();
        $login -> ctrIngresoUsuario();
        
      ?>

    </form>

    <hr>
    <font face="arial" size="1">Derechos reservados© 2021 </font>
      <img src="vistas/img/plantilla/ags.png" width="80" height="25" alt=""/>
    <font face="arial" size="1"><b>Version 1.0</b></font>

  </div>
  <br>
  <b><center>Realizar Test Velocidad <a href="https://www.speedtest.net/es" target="_blank">Aqui</a></center></b>
</div>
