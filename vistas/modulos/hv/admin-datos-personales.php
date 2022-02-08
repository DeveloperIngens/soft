<div class="content-wrapper">

  <?php 
  
    $ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/vistas/modulos/ui/validacion-permiso.php"; 

    include_once $ruta;
  
  ?>

  <section class="content-header">
    
    <h1>
      
      Crear Datos Personales
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio-hv"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear Datos Personales </li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- INCLUIMOS MENU DE HV -->
    <?php include_once "ui/menu-hv.php"; ?>

    <!-- Default box -->
    <div class="box box-primary">
      <form method="post" enctype="multipart/form-data">
      <div class="box-header with-border text-center">
        <h1 class="box-title"><b>DATOS PERSONALES</b></h1>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
          <small>Los campos que tienen <i class="fas fa-star"></i> son campos obligatorios para su diligenciamiento.</small>
        </div>
        <hr>
        <div class="row">
          <div class="col-lg-6">
            <label>Tipo Identificación:</label>
            <div class="input-group">
              <select class="form-control" name="nuevoTipoIdentificacion" required>
                <option value="">-- Seleccione una opcion --</option>
                <?php 
                
                $tiposDocumentos = ControladorParametricas::ctrMostrarTiposDocumentos();
                
                foreach($tiposDocumentos as $keyTipoDocumentos => $valueTipoDocumento): ?>

                  <option value="<?php echo $valueTipoDocumento["id_tipo_doc"]; ?>"><?php echo $valueTipoDocumento["nombre_tipo_doc"]; ?></option>

                <?php endforeach ?>

              </select>
              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
          <div class="col-lg-6">
            <label>Número de Identificación:</label>
            <div class="input-group">
              <input type="text" class="form-control" name="nuevoNumeroIdentificacion" id="nuevoNumeroIdentificacion">
              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
        </div>
        <br>
        <div class="row">
          <div class="col-lg-6">
            <label>Nombres:</label>
            <div class="input-group">
              <input type="text" class="form-control" name="nuevosNombres" required onkeyup="mayusculas(this)">
              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
          <div class="col-lg-6">
            <label>Apellidos:</label>
            <div class="input-group">
              <input type="text" class="form-control" name="nuevosApellidos" required onkeyup="mayusculas(this)">
              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
        </div>
        <br>
        <div class="row">
          <div class="col-lg-6">
            <label>Adjuntar PDF Documento Identificación</label>
            <div class="input-group">
              <input type="file" name="nuevoArchivoDocumentoIdentidad[]" id="nuevoArchivoDocumentoIdentidad" accept="application/pdf" class="form-control" required>
              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div>
          </div>

          <div class="col-lg-6">
            <label>Fecha Nacimiento:</label>
            <div class="input-group">
              <input type="date" class="form-control" min="1950-01-01" max="2003-12-31" name="nuevoFechaNacimiento" required>
              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-12">
            <label>Nacionalidad:</label>
            <div class="input-group">
              <select class="form-control" id="nuevaNacionalidad" name="nuevaNacionalidad" required>
                <option value="">-- Seleccione una opcion --</option>
                <?php 
                
                $nacionalidades = ControladorParametricas::ctrMostrarPaises();

                foreach($nacionalidades as $keyNacionalidades => $valueNacionalidades): ?>

                  <option value="<?php echo $valueNacionalidades["cod_pais"]; ?>"><?php echo $valueNacionalidades["pais"]; ?></option>

                <?php endforeach ?>

              </select>

              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
        </div>
        <br>
        <div class="row">
          <div class="departamentoSeleccionado">  
            <div id="DepartamentoCiudad"></div>
          </div>
          <div id="Ciudad"></div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-6">
            <label>Profesión:</label>
            <div class="input-group">
              <input type="text" class="form-control" name="nuevaProfesion" required onkeyup="mayusculas(this)">
              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div>
          </div>

          <div class="col-lg-6">
            <label>Adjuntar PDF Hoja de Vida:</label>
            <div class="input-group">
              <input type="file" name="nuevoArchivoDocumentoHojaVida[]" id="nuevoArchivoDocumentoHojaVida" accept="application/pdf" class="form-control" required>
              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div>
          </div>

        </div>
        <br>
        <div class="row">
          <div class="col-lg-6">
            <label>Correo Electrónico:</label>
            <div class="input-group">
              <input type="email" class="form-control" name="nuevoCorreoElectronico" required>
              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
          <div class="col-lg-6">
            <label>Dirección Residencia:</label>
            <input type="text" class="form-control" name="nuevaDireccionResidencia" onkeyup="mayusculas(this)">
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-4">
            <label>Número Celular:</label>
            <div class="input-group">
              <input type="text" class="form-control" name="nuevoCelular" data-inputmask="'mask':'999 999 9999'" data-mask required>
              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
          <div class="col-lg-4">
            <label>Número Celular 2:</label>
            <div class="input-group">
            <input type="text" class="form-control" name="nuevoCelular2" data-inputmask="'mask':'999 999 9999'" data-mask required>
              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div>
          </div>
          <div class="col-lg-4">
            <label>Teléfono:</label>
            <input type="text" class="form-control" name="nuevoTelefono" data-inputmask="'mask':'999 9999'" data-mask>
          </div>
        </div>

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        
        <button type="submit" name="crearDatosAdicionales" class="btn btn-success"><i class="fas fa-save"></i> Guardar Información</button>

      </div>
      <?php 

        if(isset($_POST["crearDatosAdicionales"])){

          $crearDatosPersonales = new ControladorHojaVida();
          $crearDatosPersonales->ctrCrearDatosPersonalesAdmin();

        }
      
      ?>
      </form>
    </div>
  </section>
</div>

<script>
/*===================================
TRAER DEPARTAMENTOS DE PAIS SELECCION SOLO ES COLOMBIA
===================================*/
$("#nuevaNacionalidad").change(function(){

var nacionalidad = document.getElementById('nuevaNacionalidad').value;

var cadena;

if(nacionalidad == "CO"){

    cadena = 
      '<div class="col-lg-6">'+
        '<label>Departamento Residencia:</label>'+
        '<div class="input-group">'+
          '<select class="form-control" name="nuevoDepartamentoResidencia" id="nuevoDepartamentoResidencia" required>'+
          '<option value="">-- Seleccione una opcion --</option>'+
          <?php 
          
          $departamentos = ControladorParametricas::ctrTraerDepartamentos();
          
          foreach($departamentos as $keyDepartamentos => $valueDepartamentos): ?>

            '<option value="<?php echo $valueDepartamentos["cod_dep"] ?>"><?php echo $valueDepartamentos["departamento"]; ?></option>'+

          <?php endforeach ?>
          '</select>'+
          '<span class="input-group-addon">'+
            '<i class="fas fa-star"></i>'+
          '</span>'+
        '</div>'+
      '</div>';

}else{

    cadena = "";
    $("#Ciudad").html("");

}

$("#DepartamentoCiudad").html(cadena);


});

/*===================================
TRAER CIUDADES DE DEPARTAMENTO SELECCIONADO
===================================*/
$(".departamentoSeleccionado").change(function(){

  var departamentoResidencia = document.getElementById('nuevoDepartamentoResidencia').value;

  if(departamentoResidencia != ""){

    $.ajax({

      type: "POST",
      url: "ajax/parametricas.ajax.php",
      data: "idDepartamento="+departamentoResidencia,
      success:function(respuesta){

          $("#Ciudad").html(respuesta);

      }

    });

  }else{

    $("#Ciudad").html("");

  }

});

</script>