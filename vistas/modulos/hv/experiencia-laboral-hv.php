<div class="content-wrapper">

  <?php 
  
    $ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/vistas/modulos/ui/validacion-permiso.php"; 

    include_once $ruta;
  
  ?>

  <section class="content-header">
    
    <h1>
      
      Experiencia Laboral
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Experiencia Laboral</li>
    
    </ol>

  </section>

  <?php if(isset($_GET["idIdentificacion"])): ?>

  <!-- Main content -->
  <section class="content">

    <!-- INCLUIMOS MENU DE HV -->
    <?php include_once "ui/menu-hv.php"; ?>

    <!-- Default box -->
    <div class="box box-primary">
        
      <div class="box-header with-border">
        <center><h3 class="box-title"><b>EXPERIENCIAS LABORALES</b></h3></center>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">

        <button onclick="mostrarFormularioExperienciaLaboral()" class="btn btn-success"><i class="fas fa-calendar-plus"></i> Agregar Experiencia Laboral</button>

        <button type="button" class="btn btn-danger pull-right" onclick="back()"><i class="fa fa-arrow-left"></i> Atras</button>

        <hr>

        <!-- BUSCAR DATOS PERSONALES CON IDENTIFICACION -->

        <?php 

          $item = "identificacion";
          $valor = $_GET["idIdentificacion"];

          $datosPersonales = ControladorHojaVida::ctrTraerDatosPersonales($item, $valor);
        ?>

        <button type="button" class="btn btn-primary btnDatosPersonales" idDatosPersonales="<?php echo $datosPersonales["id_datos_personales"]; ?>"><i class="fas fa-eye"></i> Datos Personales</button>

        <button type="button" class="btn btn-info btnAgregarFormacion" idIdentificacion="<?php echo $_GET["idIdentificacion"]; ?>"><i class="fas fa-plus"></i> Formación</button>

        <hr>

        <!-- CALCULAR TIEMPO TOTAL EN EXPERIENCIA -->

        <?php 

          $idIdentificacion = $_GET["idIdentificacion"];

          $experienciaLaboral = ControladorHojaVida::ctrCalcularExperienciaTotal($idIdentificacion);
        
        ?>

        <h4>Tiempo Laborado en Años: <b><?php echo $experienciaLaboral["tiempo_anios"] ?></b> - Tiempo Laborado en Meses: <b><?php echo $experienciaLaboral["tiempo_meses"]; ?></b></h4>

        <hr>

        <table class="table table-bordered table-striped dt-responsive tablaExperienciaLaboral" width="100%">
          
          <thead>
            
            <tr>
              
              <th style="width:10px">#</th>
              <th>Identificación</th>
              <th>Empresa o Entidad Contratante</th>
              <th>Cargo Desempeñado</th>
              <th>Certificado con Funciones</th>
              <th>Fecha Inicio de Labor</th>
              <th>Fecha Final Labor</th>
              <th>Tiempo Laborado en Años</th>
              <th>Certificación Adjunto</th>
              <th>Acciones</th>
  
            </tr> 
  
          </thead>
  
          <tbody>

            <?php 
            
            $item = "identificacion_fk";
            $valor = $_GET["idIdentificacion"];

            $experienciasLaborales = ControladorHojaVida::ctrMostrarExperienciasLaborales($item, $valor);
            
            foreach($experienciasLaborales as $key => $valueExperiencias): ?>

              <tr>
                <td><?php echo $valueExperiencias["id_experiencia_laboral"]; ?></td>
                <td><?php echo $valueExperiencias["identificacion_fk"]; ?></td>
                <td><?php echo $valueExperiencias["empresa_entidad"]; ?></td>
                <td><?php echo $valueExperiencias["cargo"]; ?></td>
                <td><?php echo $valueExperiencias["objeto_contrato"]; ?></td>
                <td><?php echo $valueExperiencias["fecha_inicio_formato"]; ?></td>
                <td data-sort="YYYYMMDD"><?php echo $valueExperiencias["fecha_fin_formato"]; ?></td>
                <td><?php echo $valueExperiencias["tiempo_anios"]; ?></td>
                <td><a class="btn btn-info btn-xs" target="_blank" href="<?php echo $valueExperiencias["adjunto_certificacion"] ?>"><i class="fa fa-file-pdf-o"></i></a></td>
                <td>

                  <button class="btn btn-success btn-xs btnVerExperienciaLaboral" idExperienciaLaboralVer="<?php echo $valueExperiencias["id_experiencia_laboral"]; ?>" data-toggle="modal" data-target="#modalVerExperienciaLaboral" title="Ver Experiencia Laboral"><i class="fa fa-eye"></i></button>

                  <?php if($_SESSION["rol_software"] == "administrar" || $_SESSION["numero_identificacion"] == $valueExperiencias["identificacion_fk"]): ?>

                    <button class="btn btn-info btn-xs btnEditarExperienciaLaboral" idEditarExperienciaLaboral="<?php echo $valueExperiencias["id_experiencia_laboral"]; ?>" data-toggle="modal" data-target="#modalEditarExperienciaLaboral" title="Editar Experiencia Laboral"><i class="fa fa-pencil"></i></button>

                    <button class="btn btn-danger btn-xs btnEliminarExperienciaLaboral" idEliminarExperienciaLaboral="<?php echo $valueExperiencias["id_experiencia_laboral"]; ?>" idIdentificacion="<?php echo $valueExperiencias["identificacion_fk"]; ?>" rutaArchivo="<?php echo $valueExperiencias["adjunto_certificacion"]; ?>" title="Eliminar Experiencia Laboral"><i class="fa fa-times"></i></button>
                  
                  <?php else: ?>

                    <button class="btn btn-default btn-xs" title="Editar Experiencia Laboral"><i class="fa fa-pencil"></i></button>

                    <button class="btn btn-default btn-xs" title="Eliminar Experiencia Laboral"><i class="fa fa-times"></i></button>


                  <?php endif ?>

                </td>
              </tr>

            <?php endforeach ?>


          </tbody>

        </table>

      </div>
    </div>

    <div id="formularioAgregarExperiencia" style="display: none;">
      <div class="box box-primary">
        <div class="box-header with-border">
          <center><h3 class="box-title"><b>CREAR EXPERIENCIA LABORAL</b></h3></center>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-lg-6">
                <label>Empresa o Entidad Contratante:</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="nuevaEmpresaEntiedad" onkeyup="mayusculas(this)" required>

                  <input type="hidden" name="identificacionUsuario" value="<?php echo $_GET["idIdentificacion"]; ?>">
                  <span class="input-group-addon">
                    <i class="fas fa-star"></i>
                  </span>
                </div><!-- /input-group -->
              </div><!-- /.col-lg-6 -->
              <div class="col-lg-6">
                <label>Sector:</label>
                <select class="form-control" name="nuevoSector">

                  <option value="">-- Seleccione una opcion --</option>

                  <?php 
                  
                  $item = null;
                  $valor = null;

                  $sectores = ControladorParametricas::ctrObtenerSectoresLaborales($item, $valor);

                  foreach($sectores as $key => $valueSectores): ?>

                    <option value="<?php echo $valueSectores["id_sector"]; ?>"><?php echo $valueSectores["nombre"]; ?></option>


                  <?php endforeach ?>

                </select>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-4">
                <label>Cargo Desempeñado</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="nuevoCargoDesempeño" onkeyup="mayusculas(this)" required>
                  <span class="input-group-addon">
                    <i class="fas fa-star"></i>
                  </span>
                </div>
              </div>
              <div class="col-lg-4">
                <label>Área de Trabajo:</label>
                <input type="text" class="form-control" name="nuevaAreaTrabajo" onkeyup="mayusculas(this)">
              </div>
              <div class="col-lg-4">
                <label>Valor Contrato y/o Salario:</label>
                <input type="text" class="form-control" name="nuevoValorSalario" id="nuevoValorSalario">
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-6">
                <label>Fecha Inicio de Labor:</label>
                <div class="input-group">
                  <input type="date" min="1950-01-01" class="form-control" name="nuevaFechaInicioLabor" id="nuevaFechaInicioLabor" required>
                  <span class="input-group-addon">
                    <i class="fas fa-star"></i>
                  </span>
                </div>
              </div>
              <div class="col-lg-6">
                <label>Fecha Final de Labor:</label>
                <div class="input-group">
                  <input type="date" min="1950-01-01" class="form-control" name="nuevaFechaFinalLabor" id="nuevaFechaFinalLabor" onblur="calcularDatosFechas();" required>
                  <span class="input-group-addon">
                    <i class="fas fa-star"></i>
                  </span>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-4">
                <label>Tiempo Laborado en Dias:</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="nuevoDiasLaborados" id="nuevoDiasLaborados" readonly>
                  <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </span>
                </div>
              </div>
              <div class="col-lg-4">
                <label>Tiempo Laborado en Meses:</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="nuevoMesesLaborados" id="nuevoMesesLaborados" readonly>
                  <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </span>
                </div>
              </div>
              <div class="col-lg-4">
                <label>Tiempo Laborado en Años:</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="nuevoAniosLaborados" id="nuevoAniosLaborados" readonly>
                  <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </span>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-4">
                <label>Tipo de Documento:</label>
                <div class="input-group">
                  <select class="form-control" name="nuevoTipoDocumento" required>
                    <option value="">-- Seleccione una opcion --</option>
                    <option value="Acta de Liquidación">Acta de Liquidación</option>
                    <option value="Certificación">Certificación</option>
                    <option value="Contrato">Contrato</option>
                  </select>
                  <span class="input-group-addon">
                    <i class="fas fa-star"></i>
                  </span>
                </div>
              </div>
              <div class="col-lg-4">
                <label>Adjunto Certificación:</label>
                <div class="input-group">
                  <input type="file" id="nuevoDocumentoCertificacion" name="nuevoDocumentoCertificacion[]" accept="application/pdf" class="form-control" required>
                  <span class="input-group-addon">
                    <i class="fas fa-star"></i>
                  </span>
                </div>
              </div>
              <div class="col-lg-4">
                <label>Certificado con funciones:</label>
                  <div class="input-group">
                  <select class="form-control" name="nuevoCertificadoFunciones" required>
                    <option value="">-- Seleccione una opcion --</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                  </select>
                  <span class="input-group-addon">
                    <i class="fas fa-star"></i>
                  </span>
                </div>
              </div>
            </div>

            <hr>

            <button type="submit" name="crearExperienciaLaboral" class="btn btn-success"><i class="fa fa-save"></i> Guardar Experiencia Laboral</button>

            <?php 

              if(isset($_POST["crearExperienciaLaboral"])){

                $guardarExperiencia = new ControladorHojaVida();
                $guardarExperiencia->ctrCrearExperienciasLaborales();

              }

            ?>

          </form>
        </div>
      </div>
    </div>
    
  </section>
  

  <?php elseif($_SESSION["permiso_software"] == "soft_hoja_vida" && $_SESSION["rol_software"] == "administrar"): ?>

    <section class="content">

    <?php include_once "ui/menu-hv.php"; ?>

    <div class="box box-primary">
        
      <div class="box-header with-border">
        <center><h3 class="box-title"><b>EXPERIENCIAS LABORALES</b></h3></center>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">

        <button onclick="mostrarFormularioExperienciaLaboral()" class="btn btn-success"><i class="fas fa-calendar-plus"></i> Agregar</button>

        <hr>

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
          
          <thead>
            
            <tr>
              
              <th style="width:10px">#</th>
              <th>Identificación</th>
              <th>Empresa o Entidad Contratante</th>
              <th>Cargo Desempeñado</th>
              <th>Área de Trabajo</th>
              <th>Fecha Inicio de Labor</th>
              <th>Fecha Final Labor</th>
              <th>Tiempo Laborado en Años</th>
              <th>Acciones</th>
  
            </tr> 
  
          </thead>
  
          <tbody>

            <?php 
            
            $item = null;
            $valor = null;

            $experienciasLaborales = ControladorHojaVida::ctrMostrarExperienciasLaborales($item, $valor);
            
            foreach($experienciasLaborales as $key => $valueExperiencias): ?>

              <tr>
                <td><?php echo $valueExperiencias["id_experiencia_laboral"]; ?></td>
                <td><?php echo $valueExperiencias["identificacion_fk"]; ?></td>
                <td><?php echo $valueExperiencias["empresa_entidad"]; ?></td>
                <td><?php echo $valueExperiencias["cargo"]; ?></td>
                <td><?php echo $valueExperiencias["area_trabajo"]; ?></td>
                <td><?php echo $valueExperiencias["fecha_inicio_formato"]; ?></td>
                <td><?php echo $valueExperiencias["fecha_fin_formato"]; ?></td>
                <td><?php echo $valueExperiencias["tiempo_anios"]; ?></td>
                <td>
                  <div class="btn-group">

                    <button class="btn btn-success btn-xs btnVerExperienciaLaboral" idExperienciaLaboralVer="<?php echo $valueExperiencias["id_experiencia_laboral"]; ?>" data-toggle="modal" data-target="#modalVerExperienciaLaboral" title="Ver Experiencia Laboral"><i class="fa fa-eye"></i></button>

                    <button class="btn btn-info btn-xs btnEditarExperienciaLaboral" idEditarExperienciaLaboral="<?php echo $valueExperiencias["id_experiencia_laboral"]; ?>" data-toggle="modal" data-target="#modalEditarExperienciaLaboral" title="Editar Experiencia Laboral"><i class="fa fa-pencil"></i></button>

                    <button class="btn btn-danger btn-xs btnEliminarExperienciaLaboral" idEliminarExperienciaLaboral="<?php echo $valueExperiencias["id_experiencia_laboral"]; ?>" rutaArchivo="<?php echo $valueExperiencias["adjunto_certificacion"]; ?>" title="Eliminar Experiencia Laboral"><i class="fa fa-times"></i></button>

                  </div>
                </td>
              </tr>

            <?php endforeach ?>


          </tbody>

        </table>

      </div>
    </div>

  </section>

  <?php else: ?>

    <section class="content">

      <div class="error-page">
        
        <h2 class="headline text-primary">404</h2> 

        <div class="error-content">

          <h3>

            <i class="fa fa-warning text-primary"></i> 

            Ooops! Página no encontrada.

          </h3>

          <p>
          
            Ingresa al menú lateral y allí podrás encontrar las páginas disponibles. También puedes regresar haciendo <a href="inicio-hv">click aquí.</a>
          
          </p>

        </div>

      </div>  

    </section>
    
  <?php endif ?>
  

</div>

<!--=====================================
MODAL VER EXPERIENCIA LABORAL
======================================-->
<div id="modalVerExperienciaLaboral" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Ver Experiencia Laboral</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

              <div class="col-md-6">

                <!-- ENTRADA PARA VER LA EMPRESA O ENTIDAD -->
                <div class="form-group">
                  
                  <label>Empresa o Entidad Contratante:</label>

                  <div class="input-group"> 

                    <input type="text" class="form-control" name="verEmpresaEntidad" id="verEmpresaEntidad" readonly>

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>

              </div>

              <div class="col-md-6">

                <!-- ENTRADA PARA VER EL CARGO DESEMPEÑADO -->
                <div class="form-group">
                  
                  <label>Cargo Desempeñado:</label>

                  <div class="input-group"> 

                    <input type="text" class="form-control" name="verCargo" id="verCargo" readonly>

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>
                
              </div>

            </div>

            <div class="row">

              <div class="col-md-4">

                <!-- ENTRADA PARA VER EL SECTOR -->
                <div class="form-group">
                      
                  <label>Sector:</label>

                  <div class="input-group"> 

                    <input type="text" class="form-control" name="verSector" id="verSector" readonly>

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>

              </div>

              <div class="col-md-4">

                <!-- ENTRADA PARA VER EL AREA DE TRABAJO -->
                <div class="form-group">
                  
                  <label>Área de Trabajo:</label>

                  <div class="input-group"> 

                    <input type="text" class="form-control" name="verAreaTrabajo" id="verAreaTrabajo" readonly>

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>

              </div>

              <div class="col-md-4">

                <!-- ENTRADA PARA VER EL VALOR CONTRATO O SALARIO -->
                <div class="form-group">
                  
                  <label>Valor Contrato y/o Salario:</label>

                  <div class="input-group"> 

                    <input type="text" class="form-control" name="verValorContratoSalario" id="verValorContratoSalario" readonly>

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>
              
              </div>

            </div>

            <div class="row">

              <div class="col-md-6">

                <!-- ENTRADA PARA VER FECHA INICIO LABOR -->
                <div class="form-group">
                  
                  <label>Fecha Inicio de Labor:</label>

                  <div class="input-group"> 

                    <input type="text" class="form-control" name="verFechaInicioLabor" id="verFechaInicioLabor" readonly>

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>

              </div>

              <div class="col-md-6">

                <!-- ENTRADA PARA VER FECHA FIN LABOR -->
                <div class="form-group">
                  
                  <label>Fecha Fin de Labor:</label>

                  <div class="input-group"> 

                    <input type="text" class="form-control" name="verFechaFinLabor" id="verFechaFinLabor" readonly>

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-md-4">
              <!-- ENTRADA PARA VER TIEMPO LABORADO EN DIAS -->
                <div class="form-group">
                  
                  <label>Tiempo Laborado en Dias:</label>

                  <div class="input-group"> 

                    <input type="text" class="form-control" name="verTiempoLaboradoDias" id="verTiempoLaboradoDias" readonly>

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>

              </div>

              <div class="col-md-4">

                <!-- ENTRADA PARA VER TIEMPO LABORADO EN MESES -->
                <div class="form-group">
                  
                  <label>Tiempo Laborado en Meses:</label>

                  <div class="input-group"> 

                    <input type="text" class="form-control" name="verTiempoLaboradoMeses" id="verTiempoLaboradoMeses" readonly>

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>

              </div>

              <div class="col-md-4">

                <!-- ENTRADA PARA VER TIEMPO LABORADO EN AÑOS -->
                <div class="form-group">
                  
                  <label>Tiempo Laborado en Años:</label>

                  <div class="input-group"> 

                    <input type="text" class="form-control" name="verTiempoLaboradoAnios" id="verTiempoLaboradoAnios" readonly>

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-md-4">

                <!-- ENTRADA PARA VER TIPO DOCUMENTO -->
                <div class="form-group">
                  
                  <label>Tipo de Documento:</label>

                  <div class="input-group"> 

                    <input type="text" class="form-control" name="verTipoDocumento" id="verTipoDocumento" readonly>

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>

              </div>

              <div class="col-md-4">

                <!-- ENTRADA PARA VER ADJUNTO DOCUMENTO -->
                <div class="form-group">
                  
                  <label>Adjunto Certificación:</label>

                  <div id="archivo"></div>

                </div>

              </div>

              <div class="col-md-4">

                <!-- ENTRADA PARA VER CERTIFICADO CON FUNCIONES -->
                <div class="form-group">
                  
                  <label>Certificado con funciones:</label>

                  <div class="input-group"> 

                    <input type="text" class="form-control" name="verCertificadoConFunciones" id="verCertificadoConFunciones" readonly>

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>

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



<!--=====================================
MODAL EDITAR EXPERIENCIA LABORAL
======================================-->
<div id="modalEditarExperienciaLaboral" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Experiencia Laboral</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

              <div class="col-md-6">

                <!-- ENTRADA PARA VER LA EMPRESA O ENTIDAD -->
                <div class="form-group">
                  
                  <label>Empresa o Entidad Contratante:</label>

                  <div class="input-group"> 

                    <input type="text" class="form-control" name="editarEmpresaEntidad" id="editarEmpresaEntidad" onkeyup="mayusculas(this)">

                    <input type="hidden" id="editarIdExperienciaLaboral" name="editarIdExperienciaLaboral">

                    <input type="hidden" id="idIdentificacionFk" name="idIdentificacionFk">

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>
              </div>

              <div class="col-md-6">

                <!-- ENTRADA PARA VER EL CARGO DESEMPEÑADO -->
                <div class="form-group">
                  
                  <label>Cargo Desempeñado:</label>

                  <div class="input-group"> 

                    <input type="text" class="form-control" name="editarCargo" id="editarCargo" onkeyup="mayusculas(this)">

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-md-4">

                <!-- ENTRADA PARA VER EL SECTOR -->
                <div class="form-group">
                  
                  <label>Sector:</label>

                  <div class="input-group"> 

                    <select class="form-control" name="editarSector">

                      <option id="editarSector"></option>

                      <optgroup label="-- Seleccione una opcion --"></optgroup>

                      <?php 
                      
                      $item = null;
                      $valor = null;

                      $sectores = ControladorParametricas::ctrObtenerSectoresLaborales($item, $valor);

                      foreach($sectores as $key => $valueSectores): ?>

                        <option value="<?php echo $valueSectores["id_sector"]; ?>"><?php echo $valueSectores["nombre"]; ?></option>


                      <?php endforeach ?>

                    </select>

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>

              </div>

              <div class="col-md-4">

                <!-- ENTRADA PARA VER EL AREA DE TRABAJO -->
                <div class="form-group">
                  
                  <label>Área de Trabajo:</label>

                  <div class="input-group"> 

                    <input type="text" class="form-control" name="editarAreaTrabajo" id="editarAreaTrabajo" onkeyup="mayusculas(this)">

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>

              </div>

              <div class="col-md-4">

                <!-- ENTRADA PARA VER EL VALOR CONTRATO O SALARIO -->
                <div class="form-group">
                  
                  <label>Valor Contrato y/o Salario:</label>

                  <div class="input-group"> 

                    <input type="text" class="form-control" name="editarValorContratoSalario" id="editarValorContratoSalario">

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-md-6">

                <!-- ENTRADA PARA VER FECHA INICIO LABOR -->
                <div class="form-group">
                  
                  <label>Fecha Inicio de Labor:</label>

                  <div class="input-group"> 

                    <input type="date" class="form-control" name="editarFechaInicioLabor" id="editarFechaInicioLabor" >

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>

              </div>

              <div class="col-md-6">

                <!-- ENTRADA PARA VER FECHA FIN LABOR -->
                <div class="form-group">
                  
                  <label>Fecha Fin de Labor:</label>

                  <div class="input-group"> 

                    <input type="date" class="form-control" name="editarFechaFinLabor" id="editarFechaFinLabor" onblur="calcularDatosFechasEditar()">

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>

              </div>

            </div>

            <!-- ENTRADA PARA VER TIEMPO LABORADO EN DIAS -->

            <div class="row">

              <div class="col-md-4">

                <div class="form-group">
                  
                  <label>Tiempo Laborado en Dias:</label>

                  <div class="input-group"> 

                    <input type="text" class="form-control" name="editarTiempoLaboradoDias" id="editarTiempoLaboradoDias" readonly>

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>
                
              </div>


              <!-- ENTRADA PARA VER TIEMPO LABORADO EN MESES -->
              <div class="col-md-4">

                <div class="form-group">
                  
                  <label>Tiempo Laborado en Meses:</label>

                  <div class="input-group"> 

                    <input type="text" class="form-control" name="editarTiempoLaboradoMeses" id="editarTiempoLaboradoMeses" readonly>

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>

              </div>

              <!-- ENTRADA PARA VER TIEMPO LABORADO EN AÑOS -->

              <div class="col-md-4">

                <div class="form-group">
                  
                  <label>Tiempo Laborado en Años:</label>

                  <div class="input-group"> 

                    <input type="text" class="form-control" name="editarTiempoLaboradoAnios" id="editarTiempoLaboradoAnios" readonly>

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-md-6">

                <!-- ENTRADA PARA VER TIPO DOCUMENTO -->
                <div class="form-group">
                  
                  <label>Tipo de Documento:</label>

                  <div class="input-group"> 

                    <select class="form-control" name="editarTipoDocumento">

                        <option id="editarTipoDocumento"></option>

                        <optgroup label="-- Seleccione una opcion --"></optgroup>

                        <option value="Acta de Liquidación">Acta de Liquidación</option>
                        <option value="Certificación">Certificación</option>
                        <option value="Contrato">Contrato</option>

                    </select>

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>

              </div>

              <div class="col-md-6">

                <!-- ENTRADA PARA VER CERTIFICADO CON FUNCIONES -->
                <div class="form-group">
                  
                  <label>Certificado con funciones:</label>

                  <div class="input-group"> 
                    
                    <select class="form-control" name="editarCertificadoFunciones">

                        <option id="editarCertificadoFunciones"></option>

                        <optgroup label="-- Seleccione una opcion --"></optgroup>

                        <option value="Si">Si</option>
                        <option value="No">No</option>

                    </select>

                    <span class="input-group-addon"><i class="fas fa-star"></i></span>

                  </div>

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-md-6">

                <!-- ENTRADA PARA VER ADJUNTO DOCUMENTO -->
                <div class="form-group">
                  
                  <label>Adjunto Certificación:</label>

                  <div id="archivoEditar"></div>
                  <input type="hidden" name="documentoAntiguo" id="documentoAntiguo">
                  <input type="hidden" name="nombreArchivoAntiguo" id="nombreArchivoAntiguo">

                </div>

              </div>

              <div class="col-md-6">

                <div class="form-group">
                    <label>Actualizar Adjunto Certificación:</label>
                    <input type="file" name="editarDocumentoCertificacion[]" accept="application/pdf" class="form-control">
                </div>

              </div>

            </div>
            
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>

          <button type="submit" name="editarExperienciaLaboral" class="btn btn-success"><i class="fas fa-save"></i> Guardar Experiencia Laboral</button>

        </div>

        <?php 
        
            if(isset($_POST["editarExperienciaLaboral"])){

              $editarExp = new ControladorHojaVida();
              $editarExp->ctrEditarExperienciaLaboral();

            }
        
        ?>

      </form>

    </div>

  </div>

</div>


<?php 

  $eliminarExperienciaLaboral = new ControladorHojaVida();
  $eliminarExperienciaLaboral->ctrEliminarExperienciaLaboral();

?>