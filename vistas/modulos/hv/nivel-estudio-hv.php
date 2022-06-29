<div class="content-wrapper">

  <?php 
  
  $ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/vistas/modulos/ui/validacion-permiso.php"; 

  include_once $ruta;

  ?>

  <section class="content-header">
    
    <h1>
      
      Niveles Estudio
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Niveles Estudio</li>
    
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
        <center><h3 class="box-title"><b>NIVELES ESTUDIO</b></h3></center>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">

        <!--<button onclick="mostrarSeleccionNivelEstudio()" class="btn btn-success"><i class="fas fa-calendar-plus"></i> Agregar</button>-->

        <div class="input-group-btn">
            <button type="button" class="btn btn-success dropdown-toggle pull-left" data-toggle="dropdown" aria-expanded="false" style="margin-right: 10px;"><i class="fa fa-plus"></i> Agregar Formaciones
            <span class="fa fa-caret-down"></span></button>
            <ul class="dropdown-menu">
                <li><a data-toggle="modal" data-target="#modalAgregarBachillerato">Bachillerato</a></li>
                <li><a data-toggle="modal" data-target="#modalAgregarTecnicloLaboral">Técnico Laboral</a></li>
                <li><a data-toggle="modal" data-target="#modalAgregarTecProfesional">Formación Tec Profesional</a></li>
                <li><a data-toggle="modal" data-target="#modalAgregarTecnologica">Tecnológica</a></li>
                <li><a data-toggle="modal" data-target="#modalAgregarUniversitaria">Universitaria</a></li>
                <li><a data-toggle="modal" data-target="#modalAgregarEspecializacion">Especialización</a></li>
                <li><a data-toggle="modal" data-target="#modalAgregarMaestria">Maestría</a></li>
                <li><a data-toggle="modal" data-target="#modalAgregarDoctorado">Doctorado</a></li>
                <li><a data-toggle="modal" data-target="#modalAgregarEstudioNoFor">Estudios no Formales</a></li>
            </ul>

            <button type="button" class="btn btn-danger pull-right" onclick="back()"><i class="fa fa-arrow-left"></i> Atras</button>
            
        </div>

        <hr>
          <!-- BUSCAR DATOS PERSONALES CON IDENTIFICACION -->

        <?php 

        $item = "identificacion";
        $valor = $_GET["idIdentificacion"];

        $datosPersonales = ControladorHojaVida::ctrTraerDatosPersonales($item, $valor);
        
        ?>

        <button type="button" class="btn btn-primary btnDatosPersonales" idDatosPersonales="<?php echo $datosPersonales["id_datos_personales"]; ?>"><i class="fas fa-eye"></i> Datos Personales</button>

        <button type="button" class="btn btn-info btnAgregarExperiencia" idIdentificacion="<?php echo $_GET["idIdentificacion"]; ?>"><i class="fas fa-plus"></i> Experiencia Laboral</button>

        <hr>

        <table class="table table-bordered table-striped dt-responsive tablasNivelEstudio" width="100%">
          
          <thead>
            
            <tr>
              
              <th style="width:10px">#</th>
              <th>Identificación</th>
              <th>Titulo Obtenido</th>
              <th>Fecha Finalización Estudio</th>
              <th>Adjunto</th>
              <th>Institución Educativa</th>
              <th>Nivel de Estudio</th>
              <th>Acciones</th>
  
            </tr> 
  
          </thead>
  
          <tbody>

            <?php 
            
            $item = "identificacion_fk";
            $valor = $_GET["idIdentificacion"];

            $nivelesEstudio = ControladorHojaVida::ctrMostrarNivelesEstudios($item, $valor);
            
            foreach($nivelesEstudio as $key => $valueNivelesEstudio): ?>

              <tr>
                <td><?php echo $valueNivelesEstudio["id_nivel_estudio"]; ?></td>
                <td><?php echo $valueNivelesEstudio["identificacion_fk"]; ?></td>
                <td><?php echo $valueNivelesEstudio["titulo_obtenido"]; ?></td>
                <td><?php echo $valueNivelesEstudio["fecha_finalizacion"]; ?></td>
                <td><a href="<?php echo $valueNivelesEstudio["adjunto_diploma"]; ?>" target="_blank"><?php echo $valueNivelesEstudio["nombre_archivo"]; ?></a></td>
                <td>

                    <?php if($valueNivelesEstudio["institucion_educativa_id"] != ""): ?>

                      <?php 
                        
                        $item = "id_institucion";
                        $valor = $valueNivelesEstudio["institucion_educativa_id"];

                        $institucionEducativa = ControladorParametricas::ctrObtenerInstitucionId($item, $valor); ?>

                      <?php echo $institucionEducativa["nombre"]; ?>

                    <?php elseif($valueNivelesEstudio["institucion_educativa_otro"] != ""): ?>

                      <?php echo $valueNivelesEstudio["institucion_educativa_otro"]; ?>
                    
                    <?php else: ?>

                      <?php echo $valueNivelesEstudio["institucion_secundaria"]; ?>

                    <?php endif ?>
                
                </td>
                <td>
                    <?php 
                        $item = "id_nivel";
                        $valor = $valueNivelesEstudio["id_nivel_educativo"];

                        $nivelEstudio = ControladorParametricas::ctrObtenerNivelesEstudios($item, $valor);

                        echo $nivelEstudio["nombre_nivel"];
                    ?>


                </td>
                <td>

                  <button class="btn btn-success btn-xs btnVerNivelEstudio" idNivelEstudioVer="<?php echo $valueNivelesEstudio["id_nivel_estudio"]; ?>" data-toggle="modal" data-target="#modalVerNivelEstudio" title="Ver Nivel Estudio"><i class="fa fa-eye"></i></button>
                  
                  <?php if($_SESSION["rol_software"] == "administrar" || $_SESSION["numero_identificacion"] == $valueNivelesEstudio["identificacion_fk"]): ?>

                    <button class="btn btn-danger btn-xs btnEliminarNivelEstudio" idEliminarNivelEstudio="<?php echo $valueNivelesEstudio["id_nivel_estudio"]; ?>" rutaArchivo="<?php echo $valueNivelesEstudio["adjunto_diploma"]; ?>" rutaArchivoTarjeta="<?php echo $valueNivelesEstudio["adjunto_tarjeta_profesional"]; ?>" idIdentificacion="<?php echo $valueNivelesEstudio["identificacion_fk"]; ?>" title="Eliminar Nivel Estudio"><i class="fa fa-times"></i></button>

                  <?php else: ?>

                    <button class="btn btn-dafault btn-xs" title="Eliminar Nivel Estudio"><i class="fa fa-times"></i></button>

                  <?php endif ?>

                </td>
              </tr>

            <?php endforeach ?>


          </tbody>

        </table>

      </div>
    </div>

  </section>
  

  <?php elseif($_SESSION["permiso_software"] == "soft_hoja_vida" && $_SESSION["rol_software"] == "administrar"): ?>

    <section class="content">

    <?php include_once "ui/menu-hv.php"; ?>

    <div class="box box-primary">
        
      <div class="box-header with-border">
        <center><h3 class="box-title"><b>NIVELES ESTUDIO</b></h3></center>

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

                  <button class="btn btn-success btn-xs btnVerNivelEstudio" idExperienciaLaboralVer="<?php echo $valueExperiencias["id_experiencia_laboral"]; ?>" data-toggle="modal" data-target="#modalVerExperienciaLaboral" title="Ver Experiencia Laboral"><i class="fa fa-eye"></i></button>

                  <button class="btn btn-info btn-xs btnEditarNivelEstudio" idEditarExperienciaLaboral="<?php echo $valueExperiencias["id_experiencia_laboral"]; ?>" data-toggle="modal" data-target="#modalEditarExperienciaLaboral" title="Editar Experiencia Laboral"><i class="fa fa-pencil"></i></button>

                  <button class="btn btn-danger btn-xs btnEliminarNivelEstudio" idEliminarExperienciaLaboral="<?php echo $valueExperiencias["id_experiencia_laboral"]; ?>" rutaArchivo="<?php echo $valueExperiencias["adjunto_certificacion"]; ?>" title="Eliminar Experiencia Laboral"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR FORMACION BACHILLERATO
======================================-->
<div id="modalAgregarBachillerato" class="modal fade" role="dialog" style="overflow-y: scroll">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Formación Bachillerato</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA INSTITUCION EDUCATIVA -->
            <div class="form-group">
                <label>Institución Educativa:</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="nuevaInstitucionEducativaBachi" onkeyup="mayusculas(this)" required>
                    <input type="hidden" value="<?php echo $_GET["idIdentificacion"]; ?>" name="identificacionBachi">
                    <input type="hidden" value="0" name="nuevoNivelEducacionBachi">
                    <input type="hidden" value="BACHILLER" name="nuevoTituloObtenidoBachi">
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>


            <!-- ENTRADA PARA FECHA DE GRADO -->
            <div class="form-group">
                <label>Fecha de Grado:</label>
                <div class="input-group">
                    <input type="date" class="form-control" name="nuevaFechaGradoBachi" required>
                    <span class="input-group-addon">
                        <i class="fas fa-star"></i>
                    </span>
                </div>
            </div>

            <!-- ENTRADA PARA ADJUNTAR DIPLOMA O ACTA -->
            <div class="form-group">
                <label>Adjunto Diploma/Acta:</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="nuevoArchivoNivelEstudioBachi" name="nuevoArchivoNivelEstudioBachi[]" accept="application/pdf" required>
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>
          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>
            <button type="submit" name="crarFormacionBachi" class="btn btn-success"><i class="fas fa-save"></i> Guardar Formación</button>
        </div>
        <?php 

            if(isset($_POST["crarFormacionBachi"])){

                $crearFormacion = new ControladorHojaVida();
                $crearFormacion->ctrCrearFormacion();

            }
        
        ?>

      </form>
    </div>
  </div>
</div>

<!--=====================================
MODAL AGREGAR TECNICO LABORAL
======================================-->
<div id="modalAgregarTecnicloLaboral" class="modal fade" role="dialog" style="overflow-y: scroll">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Formación Técnico Laboral</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA TITULO OTORGADO -->
            <div class="form-group">
                <label>Título Otorgado:</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="nuevoTituloOtorgadoTecLaboral" onkeyup="mayusculas(this)" required>
                    <input type="hidden" value="<?php echo $_GET["idIdentificacion"]; ?>" name="identificacionPersona">
                    <input type="hidden" value="1" name="nuevoNivelEducacion">
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>


            <!-- ENTRADA PARA FECHA DE GRADO -->
            <div class="form-group">
                <label>Fecha de Grado:</label>
                <div class="input-group">
                    <input type="date" class="form-control" name="nuevaFechaGradoTecLaboral" required>
                    <span class="input-group-addon">
                        <i class="fas fa-star"></i>
                    </span>
                </div>
            </div>

            <!-- ENTRADA PARA SELECCION DEPARTAMENTO INSTITUCION -->
            <div class="form-group">
                <label>Departamento Institución Educativa:</label>
                <div class="input-group">
                    <select class="form-control nuevoDepartamentoInstitucionTecLaboral select2" style="width: 100%;" name="nuevoDepartamentoInstitucionTecLaboral" required>
                        <option value="">-- Seleccione una opcion --</option>

                        <?php

                            $departamentos = ControladorParametricas::ctrTraerDepartamentosInstituciones();

                            foreach($departamentos as $key => $valueDepartamentos):   
                        
                        ?>

                        <option value="<?php echo $valueDepartamentos["ciudad"] ?>"><?php echo $valueDepartamentos["ciudad"]; ?></option>


                        <?php endforeach ?>

                    </select>
                    <span class="input-group-addon">
                        <i class="fas fa-star"></i>
                    </span>
                </div>
            </div>

            <!-- ENTRADA PARA INSTITUCION EDUCATIVA -->
            <div class="form-group">
                <div id="contenedorInstitucionEducativaTecLaboral"></div>
            </div>
            
            <!-- ENTRADA PARA SELECCION DIPLOMA O ACTA -->
            <div class="form-group">
                <label>Adjunto Diploma/Acta:</label>
                <div class="input-group">
                    <select class="form-control" name="nuevoDiplomaActaTecLaboral" required>
                        <option value="">-- Seleccione una opcion --</option>
                        <option value="Acta">Acta</option>
                        <option value="Diploma">Diploma</option>
                    </select>
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>

            <!-- ENTRADA PARA CARGA ARCHIVO -->
            <div class="form-group">
                <label>Adjunto:</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="nuevoArchivoNivelEstudioTecLaboral" name="nuevoArchivoNivelEstudioTecLaboral[]" accept="application/pdf" required>
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>
            <button type="submit" name="crearFormacionTecniLab" class="btn btn-success"><i class="fas fa-save"></i> Guardar Formación</button>
        </div>
        <?php 

            if(isset($_POST["crearFormacionTecniLab"])){

                $guardarFormacion = new ControladorHojaVida();
                $guardarFormacion->ctrCrearFormacion();

            }
        
        ?>
      </form>
    </div>
  </div>
</div>

<!--=====================================
MODAL AGREGAR TEC PROFESIONAL
======================================-->
<div id="modalAgregarTecProfesional" class="modal fade" role="dialog" style="overflow-y: scroll">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Formación Técnico Profesional</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA TITULO OTORGADO -->
            <div class="form-group">
                <label>Título Otorgado:</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="nuevoTituloOtorgadoTecPro" onkeyup="mayusculas(this)" required>
                    <input type="hidden" value="<?php echo $_GET["idIdentificacion"]; ?>" name="identificacionPersona">
                    <input type="hidden" value="2" name="nuevoNivelEducacion">
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>


            <!-- ENTRADA PARA FECHA DE GRADO -->
            <div class="form-group">
                <label>Fecha de Grado:</label>
                <div class="input-group">
                    <input type="date" class="form-control" name="nuevaFechaGradoTecPro" required>
                    <span class="input-group-addon">
                        <i class="fas fa-star"></i>
                    </span>
                </div>
            </div>

            <!-- ENTRADA PARA SELECCION DEPARTAMENTO INSTITUCION -->
            <div class="form-group">
                <label>Departamento Institución Educativa:</label>
                <div class="input-group">
                    <select class="form-control nuevoDepartamentoInstitucionTecPro select2" style="width: 100%;" name="nuevoDepartamentoInstitucionTecPro" required>
                        <option value="">-- Seleccione una opcion --</option>

                        <?php

                            $departamentos = ControladorParametricas::ctrTraerDepartamentosInstituciones();

                            foreach($departamentos as $key => $valueDepartamentos):   
                        
                        ?>

                        <option value="<?php echo $valueDepartamentos["ciudad"] ?>"><?php echo $valueDepartamentos["ciudad"]; ?></option>


                        <?php endforeach ?>

                    </select>
                    <span class="input-group-addon">
                        <i class="fas fa-star"></i>
                    </span>
                </div>
            </div>

            <!-- ENTRADA PARA INSTITUCION EDUCATIVA -->
            <div class="form-group">
                <div id="contenedorInstitucionEducativaTecPro"></div>
            </div>
            
            <!-- ENTRADA PARA SELECCION DIPLOMA O ACTA -->
            <div class="form-group">
                <label>Adjunto Diploma/Acta:</label>
                <div class="input-group">
                    <select class="form-control" name="nuevoDiplomaActaTecPro" required>
                        <option value="">-- Seleccione una opcion --</option>
                        <option value="Acta">Acta</option>
                        <option value="Diploma">Diploma</option>
                    </select>
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>

            <!-- ENTRADA PARA CARGA ARCHIVO -->
            <div class="form-group">
                <label>Adjunto:</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="nuevoArchivoNivelEstudioTecPro" name="nuevoArchivoNivelEstudioTecPro[]" accept="application/pdf" required>
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>
            <button type="submit" name="crearFormacionTecniPro" class="btn btn-success"><i class="fas fa-save"></i> Guardar Formación</button>
        </div>
        <?php 

            if(isset($_POST["crearFormacionTecniPro"])){

                $guardarFormacion = new ControladorHojaVida();
                $guardarFormacion->ctrCrearFormacion();

            }
        
        ?>
      </form>
    </div>
  </div>
</div>

<!--=====================================
MODAL AGREGAR TECNOLOGICA
======================================-->
<div id="modalAgregarTecnologica" class="modal fade" role="dialog" style="overflow-y: scroll">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Formación Tecnologica</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA TITULO OTORGADO -->
            <div class="form-group">
                <label>Título Otorgado:</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="nuevoTituloOtorgadoTecnologica" onkeyup="mayusculas(this)" required>
                    <input type="hidden" value="<?php echo $_GET["idIdentificacion"]; ?>" name="identificacionPersona">
                    <input type="hidden" value="3" name="nuevoNivelEducacion">
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>


            <!-- ENTRADA PARA FECHA DE GRADO -->
            <div class="form-group">
                <label>Fecha de Grado:</label>
                <div class="input-group">
                    <input type="date" class="form-control" name="nuevaFechaGradoTecnologica" required>
                    <span class="input-group-addon">
                        <i class="fas fa-star"></i>
                    </span>
                </div>
            </div>

            <!-- ENTRADA PARA SELECCION DEPARTAMENTO INSTITUCION -->
            <div class="form-group">
                <label>Departamento Institución Educativa:</label>
                <div class="input-group">
                    <select class="form-control nuevoDepartamentoInstitucionTecnologica select2" style="width: 100%;" name="nuevoDepartamentoInstitucionTecnologica" required>
                        <option value="">-- Seleccione una opcion --</option>

                        <?php

                            $departamentos = ControladorParametricas::ctrTraerDepartamentosInstituciones();

                            foreach($departamentos as $key => $valueDepartamentos):   
                        
                        ?>

                        <option value="<?php echo $valueDepartamentos["ciudad"] ?>"><?php echo $valueDepartamentos["ciudad"]; ?></option>


                        <?php endforeach ?>

                    </select>
                    <span class="input-group-addon">
                        <i class="fas fa-star"></i>
                    </span>
                </div>
            </div>

            <!-- ENTRADA PARA INSTITUCION EDUCATIVA -->
            <div class="form-group">
                <div id="contenedorInstitucionEducativaTecnologica"></div>
            </div>
            
            <!-- ENTRADA PARA SELECCION DIPLOMA O ACTA -->
            <div class="form-group">
                <label>Adjunto Diploma/Acta:</label>
                <div class="input-group">
                    <select class="form-control" name="nuevoDiplomaActaTecnologica" required>
                        <option value="">-- Seleccione una opcion --</option>
                        <option value="Acta">Acta</option>
                        <option value="Diploma">Diploma</option>
                    </select>
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>

            <!-- ENTRADA PARA CARGA ARCHIVO -->
            <div class="form-group">
                <label>Adjunto:</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="nuevoArchivoNivelEstudioTecnologica" name="nuevoArchivoNivelEstudioTecnologica[]" accept="application/pdf" required>
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>
            <button type="submit" name="crearFormacionTecnologica" class="btn btn-success"><i class="fas fa-save"></i> Guardar Formación</button>
            
            <?php 

              if(isset($_POST["crearFormacionTecnologica"])){

                $crearFormacion = new ControladorHojaVida();
                $crearFormacion->ctrCrearFormacion();

              }
            
            ?>
        </div>
      </form>
    </div>
  </div>
</div>

<!--=====================================
MODAL AGREGAR UNIVERSITARIA
======================================-->
<div id="modalAgregarUniversitaria" class="modal fade" role="dialog" style="overflow-y: scroll">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Formación Universitaria</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA TITULO OTORGADO -->
            <div class="form-group">
                <label>Título Otorgado:</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="nuevoTituloOtorgadoUni" onkeyup="mayusculas(this)" required>
                    <input type="hidden" value="<?php echo $_GET["idIdentificacion"]; ?>" name="identificacionPersona">
                    <input type="hidden" value="4" name="nuevoNivelEducacion">
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>


            <!-- ENTRADA PARA FECHA DE GRADO -->
            <div class="form-group">
                <label>Fecha de Grado:</label>
                <div class="input-group">
                    <input type="date" class="form-control" name="nuevaFechaGradoUni" required>
                    <span class="input-group-addon">
                        <i class="fas fa-star"></i>
                    </span>
                </div>
            </div>

            <!-- ENTRADA PARA SELECCION DEPARTAMENTO INSTITUCION -->
            <div class="form-group">
                <label>Departamento Institución Educativa:</label>
                <div class="input-group">
                    <select class="form-control nuevoDepartamentoInstitucionUni select2" style="width: 100%;" name="nuevoDepartamentoInstitucionUni" required>
                        <option value="">-- Seleccione una opcion --</option>

                        <?php

                            $departamentos = ControladorParametricas::ctrTraerDepartamentosInstituciones();

                            foreach($departamentos as $key => $valueDepartamentos):   
                        
                        ?>

                        <option value="<?php echo $valueDepartamentos["ciudad"] ?>"><?php echo $valueDepartamentos["ciudad"]; ?></option>


                        <?php endforeach ?>

                    </select>
                    <span class="input-group-addon">
                        <i class="fas fa-star"></i>
                    </span>
                </div>
            </div>

            <!-- ENTRADA PARA INSTITUCION EDUCATIVA -->
            <div class="form-group">
                <div id="contenedorInstitucionEducativaUni"></div>
            </div>

            <!-- ENTRADA PARA ADJUNTAR TARJETA PROFESIONAL -->
            <div class="form-group">
                <label>Adjunto Tarjeta Profesional:</label>
                <input type="file" class="form-control" id="nuevoArchivoTarjetaProfesionalUni" name="nuevoArchivoTarjetaProfesionalUni[]" accept="application/pdf">
            </div>

            <!-- ENTRADA PARA FECHA EXP TARJETA PROFESIONAL -->
            <div class="form-group">
                <label>Fecha EXP. Tarjeta Profesional:</label>
                <input type="date" class="form-control" name="nuevaFechaExpTarjetaUni">
            </div>

            <!-- ENTRADA PARA FECHA EXP TARJETA PROFESIONAL -->
            <div class="form-group">
                <label>Fecha Terminación Materias:</label>
                <input type="date" class="form-control" name="nuevaFechaTerminacionMateriasUni">
            </div>
            
            <!-- ENTRADA PARA SELECCION DIPLOMA O ACTA -->
            <div class="form-group">
                <label>Adjunto Diploma/Acta:</label>
                <div class="input-group">
                    <select class="form-control" name="nuevoDiplomaActaUni" required>
                        <option value="">-- Seleccione una opcion --</option>
                        <option value="Acta">Acta</option>
                        <option value="Diploma">Diploma</option>
                    </select>
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>

            <!-- ENTRADA PARA CARGA ARCHIVO -->
            <div class="form-group">
                <label>Adjunto:</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="nuevoArchivoNivelEstudioUni" name="nuevoArchivoNivelEstudioUni[]" accept="application/pdf" required>
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>
            <button type="submit" name="crearFormacionUniversitaria" class="btn btn-success"><i class="fas fa-save"></i> Guardar Formación</button>
            <?php 

              if(isset($_POST["crearFormacionUniversitaria"])){

                $crearFormacion = new ControladorHojaVida();
                $crearFormacion->ctrCrearFormacion();

              }
            
            ?>
        </div>
      </form>
    </div>
  </div>
</div>

<!--=====================================
MODAL AGREGAR ESPECIALIZACION
======================================-->
<div id="modalAgregarEspecializacion" class="modal fade" role="dialog" style="overflow-y: scroll">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Formación Especialización</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA TITULO OTORGADO -->
            <div class="form-group">
                <label>Título Otorgado:</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="nuevoTituloOtorgadoEsp" onkeyup="mayusculas(this)" required>
                    <input type="hidden" value="<?php echo $_GET["idIdentificacion"]; ?>" name="identificacionPersona">
                    <input type="hidden" value="5" name="nuevoNivelEducacion">
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>


            <!-- ENTRADA PARA FECHA DE GRADO -->
            <div class="form-group">
                <label>Fecha de Grado:</label>
                <div class="input-group">
                    <input type="date" class="form-control" name="nuevaFechaGradoEsp" required>
                    <span class="input-group-addon">
                        <i class="fas fa-star"></i>
                    </span>
                </div>
            </div>

            <!-- ENTRADA PARA SELECCION DEPARTAMENTO INSTITUCION -->
            <div class="form-group">
                <label>Departamento Institución Educativa:</label>
                <div class="input-group">
                    <select class="form-control nuevoDepartamentoInstitucionEsp select2" style="width: 100%;" name="nuevoDepartamentoInstitucionEsp" required>
                        <option value="">-- Seleccione una opcion --</option>

                        <?php

                            $departamentos = ControladorParametricas::ctrTraerDepartamentosInstituciones();

                            foreach($departamentos as $key => $valueDepartamentos):   
                        
                        ?>

                        <option value="<?php echo $valueDepartamentos["ciudad"] ?>"><?php echo $valueDepartamentos["ciudad"]; ?></option>


                        <?php endforeach ?>

                    </select>
                    <span class="input-group-addon">
                        <i class="fas fa-star"></i>
                    </span>
                </div>
            </div>

            <!-- ENTRADA PARA INSTITUCION EDUCATIVA -->
            <div class="form-group">
                <div id="contenedorInstitucionEducativaEsp"></div>
            </div>

            <!-- ENTRADA PARA SELECCION DIPLOMA O ACTA -->
            <div class="form-group">
                <label>Adjunto Diploma/Acta:</label>
                <div class="input-group">
                    <select class="form-control" name="nuevoDiplomaActaEsp" required>
                        <option value="">-- Seleccione una opcion --</option>
                        <option value="Acta">Acta</option>
                        <option value="Diploma">Diploma</option>
                    </select>
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>

            <!-- ENTRADA PARA CARGA ARCHIVO -->
            <div class="form-group">
                <label>Adjunto:</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="nuevoArchivoNivelEstudioEsp" name="nuevoArchivoNivelEstudioEsp[]" accept="application/pdf" required>
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>
            <button type="submit" name="crearFormacionEspecializacion" class="btn btn-success"><i class="fas fa-save"></i> Guardar Formación</button>

            <?php 
            
              if(isset($_POST["crearFormacionEspecializacion"])){

                $crearFormacion = new ControladorHojaVida();
                $crearFormacion->ctrCrearFormacion();


              }
            
            ?>

        </div>
      </form>
    </div>
  </div>
</div>

<!--=====================================
MODAL AGREGAR MAESTRIA
======================================-->
<div id="modalAgregarMaestria" class="modal fade" role="dialog" style="overflow-y: scroll">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Formación Maestría</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA TITULO OTORGADO -->
            <div class="form-group">
                <label>Título Otorgado:</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="nuevoTituloOtorgadoMae" onkeyup="mayusculas(this)" required>
                    <input type="hidden" value="<?php echo $_GET["idIdentificacion"]; ?>" name="identificacionPersona">
                    <input type="hidden" value="6" name="nuevoNivelEducacion">
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>


            <!-- ENTRADA PARA FECHA DE GRADO -->
            <div class="form-group">
                <label>Fecha de Grado:</label>
                <div class="input-group">
                    <input type="date" class="form-control" name="nuevaFechaGradoMae" required>
                    <span class="input-group-addon">
                        <i class="fas fa-star"></i>
                    </span>
                </div>
            </div>

            <!-- ENTRADA PARA SELECCION DEPARTAMENTO INSTITUCION -->
            <div class="form-group">
                <label>Departamento Institución Educativa:</label>
                <div class="input-group">
                    <select class="form-control nuevoDepartamentoInstitucionMae select2" style="width: 100%;" name="nuevoDepartamentoInstitucionMae" required>
                        <option value="">-- Seleccione una opcion --</option>

                        <?php

                            $departamentos = ControladorParametricas::ctrTraerDepartamentosInstituciones();

                            foreach($departamentos as $key => $valueDepartamentos):   
                        
                        ?>

                        <option value="<?php echo $valueDepartamentos["ciudad"] ?>"><?php echo $valueDepartamentos["ciudad"]; ?></option>


                        <?php endforeach ?>

                    </select>
                    <span class="input-group-addon">
                        <i class="fas fa-star"></i>
                    </span>
                </div>
            </div>

            <!-- ENTRADA PARA INSTITUCION EDUCATIVA -->
            <div class="form-group">
                <div id="contenedorInstitucionEducativaMae"></div>
            </div>

            <!-- ENTRADA PARA SELECCION DIPLOMA O ACTA -->
            <div class="form-group">
                <label>Adjunto Diploma/Acta:</label>
                <div class="input-group">
                    <select class="form-control" name="nuevoDiplomaActaMae" required>
                        <option value="">-- Seleccione una opcion --</option>
                        <option value="Acta">Acta</option>
                        <option value="Diploma">Diploma</option>
                    </select>
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>

            <!-- ENTRADA PARA CARGA ARCHIVO -->
            <div class="form-group">
                <label>Adjunto:</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="nuevoArchivoNivelEstudioMae" name="nuevoArchivoNivelEstudioMae[]" accept="application/pdf" required>
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>
            <button type="submit" name="crearFormacionMaestria" class="btn btn-success"><i class="fas fa-save"></i> Guardar Formación</button>
        </div>
        <?php

          if(isset($_POST["crearFormacionMaestria"])){

            $crearFormacion =  new ControladorHojaVida();
            $crearFormacion->ctrCrearFormacion();

          }
        
        ?>
      </form>
    </div>
  </div>
</div>


<!--=====================================
MODAL AGREGAR DOCTORADO
======================================-->
<div id="modalAgregarDoctorado" class="modal fade" role="dialog" style="overflow-y: scroll">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Formación Doctorado</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA TITULO OTORGADO -->
            <div class="form-group">
                <label>Título Otorgado:</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="nuevoTituloOtorgadoDoc" onkeyup="mayusculas(this)" required>
                    <input type="hidden" value="<?php echo $_GET["idIdentificacion"]; ?>" name="identificacionPersona">
                    <input type="hidden" value="7" name="nuevoNivelEducacion">
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>


            <!-- ENTRADA PARA FECHA DE GRADO -->
            <div class="form-group">
                <label>Fecha de Grado:</label>
                <div class="input-group">
                    <input type="date" class="form-control" name="nuevaFechaGradoDoc" required>
                    <span class="input-group-addon">
                        <i class="fas fa-star"></i>
                    </span>
                </div>
            </div>

            <!-- ENTRADA PARA SELECCION DEPARTAMENTO INSTITUCION -->
            <div class="form-group">
                <label>Departamento Institución Educativa:</label>
                <div class="input-group">
                    <select class="form-control nuevoDepartamentoInstitucionDoc select2" style="width: 100%;" name="nuevoDepartamentoInstitucionDoc" required>
                        <option value="">-- Seleccione una opcion --</option>

                        <?php

                            $departamentos = ControladorParametricas::ctrTraerDepartamentosInstituciones();

                            foreach($departamentos as $key => $valueDepartamentos):   
                        
                        ?>

                        <option value="<?php echo $valueDepartamentos["ciudad"] ?>"><?php echo $valueDepartamentos["ciudad"]; ?></option>


                        <?php endforeach ?>

                    </select>
                    <span class="input-group-addon">
                        <i class="fas fa-star"></i>
                    </span>
                </div>
            </div>

            <!-- ENTRADA PARA INSTITUCION EDUCATIVA -->
            <div class="form-group">
                <div id="contenedorInstitucionEducativaDoc"></div>
            </div>

            <!-- ENTRADA PARA SELECCION DIPLOMA O ACTA -->
            <div class="form-group">
                <label>Adjunto Diploma/Acta:</label>
                <div class="input-group">
                    <select class="form-control" name="nuevoDiplomaActaDoc" required>
                        <option value="">-- Seleccione una opcion --</option>
                        <option value="Acta">Acta</option>
                        <option value="Diploma">Diploma</option>
                    </select>
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>

            <!-- ENTRADA PARA CARGA ARCHIVO -->
            <div class="form-group">
                <label>Adjunto:</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="nuevoArchivoNivelEstudioDoc" name="nuevoArchivoNivelEstudioDoc[]" accept="application/pdf" required>
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>
            <button type="submit" name="crearFormacionDoctorado" class="btn btn-success"><i class="fas fa-save"></i> Guardar Formación</button>

            <?php 

              if(isset($_POST["crearFormacionDoctorado"])){

                $crearFormacion = new ControladorHojaVida();
                $crearFormacion->ctrCrearFormacion();


              }
            
            ?>
        </div>
      </form>
    </div>
  </div>
</div>


<!--=====================================
MODAL AGREGAR ESTUDIOS NO FORMALES
======================================-->
<div id="modalAgregarEstudioNoFor" class="modal fade" role="dialog" style="overflow-y: scroll">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Formación Estudios no Formales</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA TITULO OTORGADO -->
            <div class="form-group">
                <label>Título Otorgado:</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="nuevoTituloOtorgadoEstNoFor" onkeyup="mayusculas(this)" required>
                    <input type="hidden" value="<?php echo $_GET["idIdentificacion"]; ?>" name="identificacionPersona">
                    <input type="hidden" value="8" name="nuevoNivelEducacion">
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>


            <!-- ENTRADA PARA FECHA DE GRADO -->
            <div class="form-group">
                <label>Fecha de Grado:</label>
                <div class="input-group">
                    <input type="date" class="form-control" name="nuevaFechaGradoEstNoFor" required>
                    <span class="input-group-addon">
                        <i class="fas fa-star"></i>
                    </span>
                </div>
            </div>
            
            <div class="form-group">
                <label>Institución Educativa:</label>
                <div class="input-group">
                  <input class="form-control" type="text" name="nuevaInstitucionEducativaEstNoFor" onkeyup="mayusculas(this)" required>
                  <span class="input-group-addon">
                    <i class="fa fa-star"></i>
                  </span>
                </div>
            </div>

            <!-- ENTRADA PARA SELECCION DIPLOMA O ACTA -->
            <div class="form-group">
                <label>Adjunto Diploma/Acta:</label>
                <div class="input-group">
                    <select class="form-control" name="nuevoDiplomaActaEstNoFor" required>
                        <option value="">-- Seleccione una opcion --</option>
                        <option value="Acta">Acta</option>
                        <option value="Diploma">Diploma</option>
                    </select>
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>

            <!-- ENTRADA PARA CARGA ARCHIVO -->
            <div class="form-group">
                <label>Adjunto:</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="nuevoArchivoNivelEstudioEstNoFor" name="nuevoArchivoNivelEstudioEstNoFor[]" accept="application/pdf" required>
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Salir</button>
            <button type="submit" name="crearFormacionNoFormal" class="btn btn-success"><i class="fas fa-save"></i> Guardar Formación</button>

            <?php 

              if(isset($_POST["crearFormacionNoFormal"])){

                $crearFormacion = new ControladorHojaVida();
                $crearFormacion->ctrCrearFormacion();

              }
              
            ?>
        </div>
      </form>
    </div>
  </div>
</div>


<!--=====================================
MODAL VER ESTUDIO
======================================-->
<div id="modalVerNivelEstudio" class="modal fade" role="dialog" style="overflow-y: scroll">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ver Nivel Estudio</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
                <div id="verNivelEducativo"></div>
            </div>


            <div class="row">

              <div class="col-md-6">

                <!-- ENTRADA PARA TITULO OTORGADO -->
                <div class="form-group">
                    <label>Título Otorgado:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="verTituloOtorgado" readonly>
                        <span class="input-group-addon">
                            <i class="fa fa-star"></i>
                        </span>
                    </div>
                </div>

              </div>

              <div class="col-md-6">

                <!-- ENTRADA PARA FECHA DE GRADO -->
                <div class="form-group">
                    <label>Fecha de Grado:</label>
                    <div class="input-group">
                        <input type="date" class="form-control" id="verFechaGrado" readonly>
                        <span class="input-group-addon">
                            <i class="fas fa-star"></i>
                        </span>
                    </div>
                </div>

              </div>

            </div>

            <div class="form-group">

              <div id="Departamento"></div>
              
            </div>



            <div>
            
              <div id="Institucion"></div>
            
            </div>

            <hr>

            <div class="form-group">

              <div id="AdjuntoTarjeta"></div>

            </div>

            
            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <div id="FechaExpTarjeta"></div>

                </div>

              </div>

              <div class="col-md-6">

                <div class="form-group">

                  <div id="FechaTerMaterias"></div>

                </div>

              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <div id="AdjuntoDiplomaActa"></div>

                </div>

              </div>

              <div class="col-md-6">

                <div class="form-group">

                  <div id="AdjuntoDiAc"></div>

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

<?php 

  $eliminarNivelEstudio = new ControladorHojaVida();
  $eliminarNivelEstudio->ctrBorrarNivelEstudio();
    
?>