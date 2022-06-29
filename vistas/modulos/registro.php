<div id="back"></div>
<div class="register-box">
  
  <div class="login-logo">

    <!--<img src="vistas/img/plantilla/Ags_logo.png" class="img-responsive" style="padding:30px 100px 0px 100px">-->

  </div>

  <div class="register-box-body" style="border-radius: 30px;">
    <b><p class="login-box-msg">Registro Hoja de Vida <a style="color: #e0e65e;" href="https://www.agsamericas.com/" target="-blank">AGS AMERICAS</a></p></b>
    <form method="post">

      <div class="form-group has-feedback">

        <input type="text" class="form-control" placeholder="Nombres" name="nombres" required onkeyup="mayusculas(this)">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="text" class="form-control" placeholder="Apellidos" name="apellidos" required onkeyup="mayusculas(this)">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        
      </div>

      <div class="form-group has-feedback">

        <input type="number" class="form-control" placeholder="Número de Identificación" id="numeroIdentificacion" name="numeroIdentficacion" required>
        <span class="glyphicon glyphicon-credit-card form-control-feedback"></span>
        
      </div>

      <div class="form-group has-feedback">

        <input type="email" class="form-control" id="confirmarCorreo1" placeholder="Correo Electronico" name="correo" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        
      </div>

      <div class="form-group has-feedback">

        <input type="email" class="form-control" id="confirmarCorreo2" placeholder="Confirmar Correo Electronico" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        
      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" id="contrasena1" placeholder="Contraseña" name="contrasena" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        
      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" id="contrasena2" placeholder="Confirmar Contraseña" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        
      </div>

      <div class="checkbox">
        <label>
          <input type="checkbox" required class="micheckbox"> Acepta <a href="extensiones/habeas-data.pdf" target="_blank">Terminos y Condiciones</a>
        </label>
      </div>

      <div class="form-group">
          <br>
          <button type="submit" name="crearUsuario" class="btn btn-success btn-block">Registrarse</button>
          <br>
          <p>¿Ya está registrado?<a href="login"> Accede desde aquí</a></p>
          <br>
          <a href="login" class="btn btn-default">Atras</a>

      </div>

      <?php

        if(isset($_POST["crearUsuario"])){


          $registrarse = new ControladorUsuarios();
          $registrarse -> ctrCrearUsuario();

        }
        
      ?>

    </form>

    <hr>
    <font face="arial" size="1">Derechos reservados© 2021 </font>
      <img src="vistas/img/plantilla/ags.png" width="80" height="25" alt="agsamericas"/>
    <font face="arial" size="1"><b>Version 1.0</b></font>

  </div>
</div>

<script>

  $(".register-box-body").on("change", "#confirmarCorreo2", "#confirmarCorreo1", function(){

    $(".alert").remove();

    var correo1 = document.getElementById('confirmarCorreo1').value;
    var correo2 = document.getElementById('confirmarCorreo2').value;

    if(correo1 != correo2){

      $("#confirmarCorreo2").parent().after('<div style="margin-top:25px;" class="alert alert-danger">Los correos escritos son distintos, valida por favor.</div>');

      $("#confirmarCorreo1").val("");
      $("#confirmarCorreo2").val("");

    }

  });

  $(".register-box-body").on("change", "#contrasena2", "#contrasena1", function(){

    $(".alert").remove();

    var contrasena1 = document.getElementById('contrasena1').value;
    var contrasena2 = document.getElementById('contrasena2').value;

    if(contrasena1 != contrasena2){

      $("#contrasena2").parent().after('<div style="margin-top:25px;" class="alert alert-danger">Las contraseñas digitadas no coinciden, por favor vuelve a intentarlo.</div>');

      $("#contrasena1").val("");
      $("#contrasena2").val("");

    }

  });

/*=============================================
REVISAR SI EL CORREO YA EXISTE
=============================================*/
$("#confirmarCorreo1").change(function(){

  $(".alert").remove();

  var correo = $(this).val();

  var datos = new FormData();
  datos.append("validarCorreo", correo);

  $.ajax({
      url:"ajax/usuarios.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success:function(respuesta){
        
        if(respuesta){

          $("#confirmarCorreo1").parent().after('<div class="alert alert-warning">El Correo Electronico ya se encuentra registrado.</div>');

          $("#confirmarCorreo1").val("");

        }

      }

  })
})

/*=============================================
REVISAR SI EL NUMERO IDENTIFICACION EXISTE
=============================================*/
$("#numeroIdentificacion").change(function(){

$(".alert").remove();

var identificacion = $(this).val();

var datos = new FormData();
datos.append("validarIdentificacion", identificacion);

$.ajax({
    url:"ajax/usuarios.ajax.php",
    method:"POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success:function(respuesta){
      
      if(respuesta){

        $("#numeroIdentificacion").parent().after('<div class="alert alert-warning">El Número de Identificación ya se encuentra registrado.</div>');

        $("#numeroIdentificacion").val("");

      }

    }

})
})

</script>

