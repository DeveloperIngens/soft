<div class="content-wrapper">

  <?php 
  
  $ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/vistas/modulos/ui/validacion-permiso.php"; 

  include_once $ruta;

  ?>

  <section class="content-header">
    
    <h1> 
      
      Tablero Hoja de Vida
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Tablero Hoja de Vida</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- INCLUIMOS MENU DE HV -->
    <?php include_once "ui/menu-hv.php"; ?>

    <!-- Default box -->
    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Bienvenido: <b><?php echo $_SESSION["nombres"] . " " . $_SESSION["apellidos"] . " - " . " Software: " . $_SESSION["permiso_software"];?></b></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">

      <?php if($value["nombre_perfil"] == "soft_hoja_vida" && $value["nombre_permiso"] == "administrar"): ?>

        <div class="row">

          <div class="col-md-3 col-sm-6 col-xs-12">

            <div class="info-box bg-aqua">

              <span class="info-box-icon"><i class="ion ion-document"></i></span>

              <?php  
              
              $item = null;
              $valor = null;

              $cantidadRegistrosHv = ControladorHojaVida::ctrCantidadHojasVidaRegistrada($item, $valor);
              
              ?>

              <div class="info-box-content">

                <span class="info-box-text">Hojas de Vida Registradas</span>
                <span class="info-box-number"><?php echo number_format($cantidadRegistrosHv["CANTIDAD_HOJAS"], 0); ?></span>

              </div>
            </div>

          </div>

        </div>

      <?php endif ?>


      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->