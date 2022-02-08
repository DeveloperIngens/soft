<?php

session_start();

date_default_timezone_set('America/Bogota');

$fechaActual = date('Y-m-d');

?>

<!DOCTYPE html>
<html>
<head>
  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">

  <title>Soft</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="vistas/img/plantilla/Ingens.ico">

   <!--=====================================
  PLUGINS DE CSS
  ======================================-->

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">
  

  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="vistas/bower_components/select2/dist/css/select2.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
  
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

   <!-- DataTables -->
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">

  <!-- Propio Cuentas -->
  <link rel="stylesheet" href="vistas/dist/css/cuentas.css">


    <!-- fullCalendar -->
  <link rel="stylesheet" href="vistas/bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="vistas/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
  <!--  BOTON de inventario   -->
  <link rel="stylesheet" type="text/css" href="vistas/css/usuarios.css">

  <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->

  <!-- jQuery 3 -->
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>
  
  <!-- Bootstrap 3.3.7 -->
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- FastClick -->
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>
  
  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>

  <!-- DataTables -->
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>

  <!-- fullCalendar -->
  <script src="vistas/bower_components/moment/moment.js"></script>
  <script src="vistas/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>

  <!-- SweetAlert 2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
  <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

  <!-- moment.js -->
  <script src="vistas/bower_components/moment/moment.js"></script>  

  <!-- Signature.js -->
  <script src="vistas/bower_components/signature/signature_pad.js"></script> 

  <!-- FontAwesome -->
  <script src="https://kit.fontawesome.com/81af032b36.js" crossorigin="anonymous"></script>

  <!-- Select2 -->
  <script src="vistas/bower_components/select2/dist/js/select2.full.min.js"></script>

  <!-- InputMask -->
  <script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>

  <!-- maskMoney -->
  <script src="vistas/plugins/maskMoney/jquery.maskMoney.min.js" type="text/javascript"></script>

  <!-- HighCharts -->

  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/data.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
  
</head>

<!--=====================================
CUERPO DOCUMENTO
======================================-->

<body class="hold-transition skin-blue-light sidebar-collapse sidebar-mini login-page">
 
  <?php

   if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

    echo '<div class="wrapper">';
 
     /*=============================================
     CABEZOTE
     =============================================*/
     
      include "modulos/cabezote.php";
 
     /*=============================================
     MENU
     =============================================*/
      include "modulos/menu.php";
     /*=============================================
     CONTENIDO
     =============================================*/
 
     if(isset($_GET["ruta"])){
 
       if($_GET["ruta"] == "inicio" ||
          $_GET["ruta"] == "salir" ||
          $_GET["ruta"] == "usuarios" ||
          $_GET["ruta"] == "usuarios-perfiles"){
 
          include "modulos/".$_GET["ruta"].".php";
 
       }else if($_GET["ruta"] == "inicio-hv" ||
                $_GET["ruta"] == "datos-personales-hv" ||
                $_GET["ruta"] == "consultar-hv" ||
                $_GET["ruta"] == "experiencia-laboral-hv" ||
                $_GET["ruta"] == "admin-datos-personales" ||
                $_GET["ruta"] == "admin-experiencia-laboral-hv" ||
                $_GET["ruta"] == "editar-datos-personales-hv" ||
                $_GET["ruta"] == "ver-datos-personales-hv" ||
                $_GET["ruta"] == "nivel-estudio-hv"){

        include "modulos/hv/".$_GET["ruta"].".php";

      }else if($_GET["ruta"] == "inicio-cor" ||
                $_GET["ruta"] == "proyectos-cor" ||
                $_GET["ruta"] == "correspondencia-enviada-cor" ||
                $_GET["ruta"] == "correspondencia-recibida-cor" ||
                $_GET["ruta"] == "cargar-correspondencia-recibida-cor" ||
                $_GET["ruta"] == "correspondencia-recibida-pendiente-cor" ||
                $_GET["ruta"] == "ver-correspondencia-entrante-cor"){

        include "modulos/correspondencia/".$_GET["ruta"].".php";

      }elseif ($_GET["ruta"] == "inicio-inv"||
               $_GET["ruta"] == "tecnologia-inv"||
               $_GET["ruta"] == "mantenimiento-inv"||
               $_GET["ruta"] == "calendario-inv"||
               $_GET["ruta"] == "ManteCorrectivo-inv" ||
               $_GET["ruta"] == "editar-mantenimiento-inv") {
       
        include "modulos/inv/".$_GET["ruta"].".php";
         
      }else{
 
         include "modulos/404.php";
 
      }
 
    }else{
 
      include "modulos/inicio.php";
 
    }
 
     /*=============================================
     FOOTER
     =============================================*/
 
     include "modulos/footer.php";
 
     echo '</div>';
 
    }else if(isset($_GET["ruta"]) && $_GET["ruta"] == "registro"){

      include "modulos/registro.php";

    }else if(isset($_GET["ruta"]) && $_GET["ruta"] == "restaurar-contrasenia"){

      include_once "modulos/restaurar-contrasenia.php";
      
    }else{
  
      include "modulos/login.php";
  
    }

  ?>


<script src="vistas/js/plantilla.js?v=<?=md5_file('vistas/js/plantilla.js')?>"></script>
<script src="vistas/js/usuarios.js?v=<?=md5_file('vistas/js/usuarios.js')?>"></script>
<script src="vistas/js/usuarios-perfiles.js?v=<?md5_file('vistas/js/usuarios-perfiles.js')?>"></script>
<script src="vistas/js/datos-personales.js?v=<?php md5_file('vistas/js/datos-personales.js')?>"></script>
<script src="vistas/js/experiencias-laborales.js?v=<?php md5_file('vistas/js/experiencias-laborales.js') ?>"></script>
<script src="vistas/js/menu-hv.js?v=<?php md5_file('vistas/js/menu-hv.js') ?>"></script>
<script src="vistas/js/niveles-estudios.js?v=<?php md5_file('vistas/js/niveles-estudios.js') ?>"></script>
<script src="vistas/js/consultar-hv.js?v=<?php md5_file('vistas/js/consultar-hv.js') ?>"></script>
<script src="vistas/js/inv/mantenimiento-inv.js?v=<?php md5_file('vistas/js/inv/mantenimiento-inv.js')?>"></script>
<script src="vistas/js/inv/prestadores-inv.js?v=<?php md5_file('vistas/js/inv/prestadores-inv.js')?>"></script>
<script src="vistas/js/inv/tecnologia-inv.js?v=<?php md5_file('vistas/js/inv/tecnologia-inv.js')?>"></script>
<script src="vistas/js/inv/correctivo.js?v=<?php md5_file('vistas/js/inv/correctivo.js')?>"></script>
<script src="vistas/js/correspondencia/proyecto-cor.js?v=<?php md5_file('vistas/js/correspondencia/proyecto-cor.js')?>"></script>
<script src="vistas/js/correspondencia/correspondencia-cor.js?v=<?php md5_file('vistas/js/correspondencia/correspondencia-cor.js')?>"></script>


</body>
</html>
