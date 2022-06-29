<div class="content-wrapper">

  <?php 
  
    $ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/vistas/modulos/ui/validacion-permiso.php"; 

    include_once $ruta;
  
  ?>

  <section class="content-header">
    
    <h1>
      
      Consultar Hoja de Vida
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Consultar Hoja de Vida</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- INCLUIMOS MENU DE HV -->
    <?php include_once "ui/menu-hv.php"; ?>

    <!-- Default box -->
    <div class="box">
      
      <div class="box-body">
        <form method="post">

          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                  <label>Número Identificación:</label>
                  <input type="number" name="buscarNumeroIdentificacion" class="form-control">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                  <label>Correo Electronico:</label>
                  <input type="text" name="buscarCorreo" class="form-control">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                  <label>Niveles Educación:</label>
                  <select class="form-control" name="buscarNivelEducacion">

                    <option value="">-- Seleccione una opcion --</option>

                    <?php

                    $item = null;
                    $valor = null;

                    $nivelesEducativos = ControladorParametricas::ctrObtenerNivelesEstudios($item, $valor);

                    foreach($nivelesEducativos as $key => $valueNivelesEstudios):?>

                    <option value="<?php echo $valueNivelesEstudios["id_nivel"]; ?>"><?php echo $valueNivelesEstudios["nombre_nivel"]; ?></option>


                    <?php endforeach ?>

                  </select>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                  <label>Palabras Clave:</label>
                  <input type="text" name="buscarPalabra" class="form-control">
              </div>
            </div>
          </div>

          <button type="search" name="buscarHoja" class="btn btn-success"><i class="fa fa-search"></i> Buscar</button>
            
          <?php 

              if(isset($_POST["buscarHoja"])){


                $correo = $_POST["buscarCorreo"];
                $nivelEducacion = $_POST["buscarNivelEducacion"];
                $numeroIdentificacion = $_POST["buscarNumeroIdentificacion"];
                $palabraClave = $_POST["buscarPalabra"];

                $resultados = ControladorHojaVida::ctrValidarExisteHojaVida($correo, $nivelEducacion, $numeroIdentificacion, $palabraClave);

              }
          
          ?>
            
        </form>
      </div>

    </div>

    <div class="box">
        
      <div class="box-header with-border">
        <h5><b>Descargar Excel Toda Información: </b><a href="vistas/modulos/hv/descargar-reporte-hv.php?reporteTodos=Informacion Datos Personales" class="btn btn-info btn-xs"><i class="fa fa-file-excel-o"></i></a></h5>
        <hr>
        <h3 class="box-title">Hojas de Vida encontradas: <b></b></h3>
        <hr>
        <?php if(isset($_POST["buscarCorreo"]) || isset($_POST["buscarNivelEducacion"]) || isset($_POST["buscarNumeroIdentificacion"])): ?>

          <h5><b>Datos Buscados:</b>
            <br>
            <br>

            <?php if(isset($_POST["buscarNumeroIdentificacion"]) && $_POST["buscarNumeroIdentificacion"] != ""): ?>

            <button class="btn btn-success btn-xs">Número Identificación: <b><?php echo $_POST["buscarNumeroIdentificacion"]; ?></b></button>

            <?php endif ?>

            <?php if(isset($_POST["buscarCorreo"]) && $_POST["buscarCorreo"] != ""): ?>

              <button class="btn btn-success btn-xs">Correo Electronico: <b><?php echo $_POST["buscarCorreo"]; ?></b></button>

            <?php endif ?>

            <?php if(isset($_POST["buscarNivelEducacion"]) && $_POST["buscarNivelEducacion"] != ""): ?>

            <?php 
              
              $item = "id_nivel";
              $valor = $_POST["buscarNivelEducacion"];

              $nivel = ControladorParametricas::ctrObtenerNivelesEstudios($item, $valor);
              
            ?>

            <button class="btn btn-success btn-xs">Nivel Educación: <b><?php echo $nivel["nombre_nivel"]; ?></b></button>

            <?php endif ?>

            <?php if(isset($_POST["buscarPalabra"]) && $_POST["buscarPalabra"] != ""): ?>

              <button class="btn btn-success btn-xs">Palabra Clave: <b><?php echo $_POST["buscarPalabra"]; ?></b></button>

            <?php endif ?>

          </h5>

        <?php endif ?>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Numero Documento</th>
                    <th>Correos</th>
                    <th>Empresa o Entidad</th>
                    <th>Profesión</th>
                    <th>Celular</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

              <?php if(isset($_POST["buscarHoja"])): ?>

                <?php foreach($resultados as $keyResultados => $valueResultados): ?>

                    <tr>
                        <td><?php echo $valueResultados["id_datos_personales"]; ?></td>
                        <td><?php echo $valueResultados["nombres"]; ?></td>
                        <td><?php echo $valueResultados["apellidos"]; ?></td>
                        <td><?php echo $valueResultados["identificacion"]; ?></td>
                        <td><?php echo $valueResultados["correo_electronico"]; ?></td>
                        <td><?php echo $valueResultados["empresa_entidad"]; ?></td>
                        <td><?php echo $valueResultados["profesion"]; ?></td>
                        <td><?php echo $valueResultados["numero_celular"]; ?></td>
                        <td>
                          <button class="btn btn-info btn-xs btnPrevisualizarPersona" idDatosPersonales="<?php echo $valueResultados["id_datos_personales"]; ?>" data-toggle="modal" data-target="#modalVerHojaVida"><i class="fa fa-eye"></i></button>
                          <!--<button class="btn btn-success btn-xs btnVerDatosPersonalesNuevaPestania" idDatosPersonales="<?php echo $valueResultados["id_datos_personales"]; ?>"></button>-->
                          <a class="btn btn-success btn-xs" target="_blank" href="index.php?ruta=ver-datos-personales-hv&idDatosPersonales=<?php echo $valueResultados["id_datos_personales"]; ?>"><i class="fa fa-arrow-right"></i></a>
                        </td>

                    </tr>

                <?php endforeach ?>

              <?php endif ?>

            </tbody>

        </table>

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

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalVerHojaVida" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Ver Hoja Vida</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
          
            <!-- BOX DE DATOS PERSONALES -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Datos Personales</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="input-group">
                      <div id="visualizarTipoDocumento"></div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="input-group">
                      <div id="visualizarNumeroIdentificacion"></div>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="input-group">
                      <div id="visualizarNombreCompleto"></div>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="input-group">
                      <div id="visualizarDocumentoAdjunto"></div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="input-group">
                      <div id="visualizarFechaNacimineto"></div>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="input-group">
                      <div id="visualizarNacionalidad"></div>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="input-group">
                      <div id="visualizarDepartamento"></div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="input-group">
                      <div id="visualizarCiudad"></div>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="input-group">
                      <div id="visualizarProfesion"></div>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="input-group">
                      <div id="visualizarCorreo"></div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="input-group">
                      <div id="visualizarDireccionResidencia"></div>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-lg-4">
                    <div class="input-group">
                      <div id="visualizarCelular1"></div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <div id="visualizarCelular2"></div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <div id="visualizarTelefono"></div>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="input-group">
                      <div id="visualizarHojaVida"></div>
                    </div>
                  </div>
                </div>
                <br>
              </div>
            </div>
            
            <div class="box box-warning collapsed-box">
              <div class="box-header with-border">
                  <h3 class="box-title">Formaciónes Educativas</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                  </div>
              </div>

              <div class="box-body">
                <div id="contenedorFormacion"></div>
              </div>

            </div>

            <div class="box box-info collapsed-box">
              <div class="box-header with-border">
                  <h3 class="box-title">Experiencias Laborales</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                  </div>
              </div>

              <div class="box-body">
                <div id="contenedorExperiencias"></div>
              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger btn-block" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>

        </div>

      </form>

    </div>

  </div>

</div>