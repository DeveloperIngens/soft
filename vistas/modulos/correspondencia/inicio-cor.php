<div class="content-wrapper">

  <?php $ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/vistas/modulos/ui/validacion-permiso.php"; 

    include_once $ruta;
  
  ?>

  <section class="content-header">
    
    <h1>
      
      Tablero Correspondencia
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Tablero Correspondencia</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- INCLUIMOS MENU DE HV -->
    <?php include_once "ui/menu-cor.php"; ?>

    <!-- Default box -->
    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Bienvenido: <b><?php echo $_SESSION["nombres"] . " " . $_SESSION["apellidos"] . " - " . "Software: " . $_SESSION["permiso_software"]; ?></b></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">


      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->