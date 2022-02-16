<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Tablero Software
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Tablero Software</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Bienvenido: <b><?php echo $_SESSION["nombres"] . " " . $_SESSION["apellidos"]; ?></b></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">

      <h4>Software's AGS AMERICAS</h4>

      <hr>

      <?php 

      $perfiles = ControladorPerfilesUsuarios::ctrObtenerPerfilesUsuarios($_SESSION["id_usuario"]);

      foreach ($perfiles as $key => $value):

      ?>

        <?php if($value["nombre_perfil"] == "soft_hoja_vida"): ?>

            <div class="col-lg-3 col-xs-12">
              <div class="thumbnail shadow contenedor">
                <img src="vistas/img/plantilla/hojavida.jpg" alt="soft-hv" class="img-responsive">
                <div class="caption">
                  <h4>Soft. Hoja de Vida</h4>
                  <p>Software para registrar y gestionar hojas de vida.</p>
                  <hr>
                  <p>
                    <a href="inicio-hv" <?php $_SESSION["obtiene_permiso"] = "SI-PERMISO"; ?> class="btn btn-success btn-block" role="button"><i class="fa fa-arrow-circle-right"></i> Ingresar</a> 
                  </p>
                </div>
              </div>
            </div>

        <?php endif ?>

        <?php if($value["nombre_perfil"] == "soft_correspondencia"): ?>

          <div class="col-lg-3 col-xs-12">
            <div class="thumbnail shadow contenedor">
              <img src="vistas/img/plantilla/correspondencia.jpg" alt="soft-correspondencia" class="img-responsive">
              <div class="caption">
                <h4>Soft. Correspondencia</h4>
                <p>Software para Correspondencia.</p>
                <hr>
                <p>
                  <a href="inicio-cor" <?php $_SESSION["obtiene_permiso"] = "SI-PERMISO"; ?> class="btn btn-success btn-block" role="button"><i class="fa fa-arrow-circle-right"></i> Ingresar</a> 
                </p>
              </div>
            </div>
          </div>

        <?php endif ?>

        <?php if($value["nombre_perfil"] == "soft_inventario"): ?>

          <div class="col-lg-3 col-xs-12">
            <div class="thumbnail shadow contenedor">
              <img src="vistas/img/plantilla/inventario.jpg" alt="..." class="img-responsive">
              <div class="caption">
                <h4>Soft. Inventario</h4>
                <p>Software para control de inventarios.</p>
                <hr>
                <p>
                  <a href="inicio-inv" <?php $_SESSION["obtiene_permiso"] = "SI-PERMISO"; ?> class="btn btn-success btn-block" role="button"><i class="fa fa-arrow-circle-right"></i> Ingresar</a> 
                </p>
              </div>
            </div>
          </div>

        <?php endif ?>

      <?php endforeach ?>

      <!-- ====================================
      MOSTRAR PERMISOS NO OBTENIDOS
      ===================================== -->

      <?php 
      
      $registros = ControladorPerfilesUsuarios::ctrObtenerSoftObtenidos($_SESSION["id_usuario"]);

      ?>

      <?php if(!empty($registros)): ?>

        <?php

        /*===========================================
        SI TIENE 1 O MAS PERMISOS MOSTRAMOS LOS SOFWARES QUE NO TIENE
        ============================================*/

        $cadena = "";

        foreach($registros as $key => $valueRegistros){

          $cadena .= $valueRegistros["id_perfil"] . ",";


        }

        $idCortados = substr($cadena, 0, -1);

        $noObtn = ControladorPerfilesUsuarios::ctrObtenerSoftNoObtenidos($idCortados);

        foreach ($noObtn as $key => $value):

        ?>

          <?php if($value["nombre_perfil"] == "soft_hoja_vida"): ?>

              <div class="col-lg-3 col-xs-12">
                <div class="thumbnail shadow contenedor" style="background: #ECEBEB;">
                  <img src="vistas/img/plantilla/hojavida.jpg" style="opacity: 0.5;" alt="soft-hv" class="img-responsive">
                  <div class="caption">
                    <h4>Soft. Hoja de Vida</h4>
                    <p>Software para registrar y gestionar hojas de vida.</p>
                    <hr>
                    <p>
                      <a class="btn btn-default btn-block" role="button"><i class="fa fa-arrow-circle-right"></i> Ingresar</a> 
                    </p>
                  </div>
                </div>
              </div>

          <?php endif ?>

          <?php if($value["nombre_perfil"] == "soft_correspondencia"): ?>

            <div class="col-lg-3 col-xs-12">
              <div class="thumbnail shadow contenedor" style="background: #ECEBEB;">
                <img src="vistas/img/plantilla/correspondencia.jpg" style="opacity: 0.5;" alt="soft-correspondencia" class="img-responsive">
                <div class="caption">
                  <h4>Soft. Correspondencia</h4>
                  <p>Software para Correspondencia.</p>
                  <hr>
                  <p>
                    <a class="btn btn-default btn-block" role="button"><i class="fa fa-arrow-circle-right"></i> Ingresar</a> 
                  </p>
                </div>
              </div>
            </div>

          <?php endif ?>

          <?php if($value["nombre_perfil"] == "soft_inventario"): ?>

            <div class="col-lg-3 col-xs-12">
              <div class="thumbnail shadow contenedor" style="background: #ECEBEB;">
                <img src="vistas/img/plantilla/inventario.jpg" style="opacity: 0.5;" alt="..." class="img-responsive">
                <div class="caption">
                  <h4>Soft. Inventario</h4>
                  <p>Software para control de inventarios.</p>
                  <hr>
                  <p>
                    <a class="btn btn-default btn-block" role="button"><i class="fa fa-arrow-circle-right"></i> Ingresar</a> 
                  </p>
                </div>
              </div>
            </div>
        
          <?php endif ?>

        <?php endforeach ?>

      <?php else: ?>

        <!-- ===================================
        SI NO TIENE NINGUNA PERMISO MOSTRAMOS TODOS LOS SOFTWARES
        ====================================== -->

        <div class="col-lg-3 col-xs-12">
          <div class="thumbnail shadow contenedor" style="background: #ECEBEB;">
            <img src="vistas/img/plantilla/hojavida.jpg" style="opacity: 0.5;" alt="soft-hv" class="img-responsive">
            <div class="caption">
              <h4>Soft. Hoja de Vida</h4>
              <p>Software para registrar y gestionar hojas de vida.</p>
              <hr>
              <p>
                <a class="btn btn-default btn-block" role="button"><i class="fa fa-arrow-circle-right"></i> Ingresar</a> 
              </p>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-xs-12">
          <div class="thumbnail shadow contenedor" style="background: #ECEBEB;">
            <img src="vistas/img/plantilla/correspondencia.jpg" style="opacity: 0.5;" alt="soft-correspondencia" class="img-responsive">
            <div class="caption">
              <h4>Soft. Correspondencia</h4>
              <p>Software para Correspondencia.</p>
              <hr>
              <p>
                <a class="btn btn-default btn-block" role="button"><i class="fa fa-arrow-circle-right"></i> Ingresar</a> 
              </p>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-xs-12">
          <div class="thumbnail shadow contenedor" style="background: #ECEBEB;">
            <img src="vistas/img/plantilla/inventario.jpg" style="opacity: 0.5;" alt="..." class="img-responsive">
            <div class="caption">
              <h4>Soft. Inventario</h4>
              <p>Software para control de inventarios.</p>
              <hr>
              <p>
                <a class="btn btn-default btn-block" role="button"><i class="fa fa-arrow-circle-right"></i> Ingresar</a> 
              </p>
            </div>
          </div>
        </div>


      <?php endif ?>

      </div>

    </div>
    

  </section>

</div>