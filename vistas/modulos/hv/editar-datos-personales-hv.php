
<!--=========================================
TIENE DATOS PERSONALES EXISTENTES
============================================-->

<div class="content-wrapper">

<?php 
  
    $ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/vistas/modulos/ui/validacion-permiso.php"; 

    include_once $ruta;
  
?>

<section class="content-header">

</section>

<section class="content">

<!-- INCLUIMOS MENU DE HV -->
<?php include_once "ui/menu-hv.php"; ?>

<!-- Default box -->
<div class="box box-primary">
    <form method="post" enctype="multipart/form-data">

    <?php

        $resultados = ControladorHojaVida::ctrTraerDatosPersonalesId($_GET["idDatosPersonales"]);

    ?>

    <div class="box-header with-border text-center">
    <h1 class="box-title"><b>EDITAR DATOS PERSONALES</b></h1>
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
              <select class="form-control" name="editarTipoIdentificacion" required>

                <?php

                  $tabla = "par_tipo_documento";
                  $item = "id_tipo_doc";
                  $valor = $resultados["tipo_documento_fk"];

                  $tipoDocumento = ControladorParametricas::ctrObtenerDatoRequerido($tabla, $item, $valor);
                
                ?>

                <option value="<?php echo $tipoDocumento["id_tipo_doc"]; ?>"><?php echo $tipoDocumento["nombre_tipo_doc"]; ?></option>
                
                <optgroup label="-- Seleccione una opcion -"></optgroup>

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
              <input type="text" class="form-control" name="editarNumeroIdentificacion" value="<?php echo $resultados["identificacion"]; ?>" readonly>
              <input type="hidden" name="idDatosPersonalesEditar" value="<?php echo $resultados["id_datos_personales"]; ?>">
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
              <input type="text" class="form-control" name="editarNombres" required onkeyup="mayusculas(this)" value="<?php echo $resultados["nombres"]; ?>">
              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
          <div class="col-lg-6">
            <label>Apellidos:</label>
            <div class="input-group">
              <input type="text" class="form-control" name="editarApellidos" required onkeyup="mayusculas(this)" value="<?php echo $resultados["apellidos"]; ?>">
              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
        </div>
        <br>
        <div class="row">
          <div class="col-lg-3">
            <label>Documento Adjunto de Identificación</label>
            <div class="input-group">
              <a class="form-control" href="<?php echo $resultados["adjunto_documento"]; ?>" target="_blank"><?php echo $resultados["nombre_adjunto_documento"]; ?></a>
              <input type="hidden" value="<?php echo $resultados["adjunto_documento"]; ?>" name="documentoAntiguo">
              <input type="hidden" value="<?php echo $resultados["nombre_adjunto_documento"]; ?>" name="nombreDocumento">
              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div>
          </div>

          <div class="col-lg-3">
            <label>Actualizar PDF Documento Identificación</label>
            <div class="input-group">
              <input type="file" name="editarArchivoDocumentoIdentidad[]" id="editarArchivoDocumentoIdentidad" accept="application/pdf" class="form-control">
              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div>
          </div>

          <div class="col-lg-6">
            <label>Fecha Nacimiento:</label>
            <input type="date" class="form-control" min="1950-01-01" max="2003-12-31" name="editarFechaNacimiento" value="<?php echo $resultados["fecha_nacimiento"]; ?>">
          </div>
        </div>
        <br>
        <hr>
        <center><h4>DATOS DE RESIDENCIA</h4></center>
        <div class="row">
          <div class="col-lg-12">
            <label>Nacionalidad:</label>
            <div class="input-group">
              <select class="form-control" id="editarNacionalidad" name="editarNacionalidad" readonly>
                <?php

                  $tabla = "par_pais";
                  $item = "cod_pais";
                  $valor = $resultados["nacionalidad_fk"];

                  $nacionalidad = ControladorParametricas::ctrObtenerDatoRequerido($tabla, $item, $valor);

                ?>

                <option value="<?php echo $nacionalidad["cod_pais"]; ?>"><?php echo $nacionalidad["pais"]; ?></option>
                
              </select>

              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
        </div>
        <br>
        <div class="row">
        <?php if($resultados["departamento_residencia"] != ""): ?>

          <div class="col-lg-6">
            <label>Departamento Residencia:</label>
            <div class="input-group">
              <select class="form-control" id="editarDepartamentoResidencia" name="editarDepartamentoResidencia" readonly>
                <?php

                  $tabla = "par_ciudades";
                  $item = "cod_dep";
                  $valor = $resultados["departamento_residencia"];

                  echo $valor;

                  $departamento = ControladorParametricas::ctrObtenerDatoRequerido($tabla, $item, $valor);

                ?>

                <option value="<?php echo $departamento["cod_dep"]; ?>"><?php echo $departamento["departamento"]; ?></option>
                
              </select>

              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div>
          </div>

        <?php endif ?>

        <?php if($resultados["ciudad_residencia"] != ""): ?>
          <div class="col-lg-6">
            <label>Ciudad Residencia:</label>
            <div class="input-group">
              <select class="form-control" id="editarCiudadResidencia" name="editarCiudadResidencia" readonly>
                <?php

                  $tabla = "par_ciudades";
                  $item = "cod_ciudad";
                  $valor = $resultados["ciudad_residencia"];

                  echo $valor;

                  $ciudad = ControladorParametricas::ctrObtenerDatoRequerido($tabla, $item, $valor);

                ?>

                <option value="<?php echo $ciudad["cod_ciudad"]; ?>"><?php echo $ciudad["ciudad"]; ?></option>
                
              </select>

              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div>
          </div>

        <?php endif ?>
        </div>
        <br>
        <hr>
        <center><h4>CAMBIAR DATOS DE RESIDENCIA</h4></center>
        <div class="row">
          <div class="col-lg-12">
            <label>Nacionalidad:</label>
            <div class="input-group">
              <select class="form-control" id="nuevaNacionalidad" name="nuevaNacionalidad">
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
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="departamentoSeleccionado">  
            <div id="DepartamentoCiudad"></div>
          </div>
          <div id="Ciudad"></div>
        </div>
        <hr>
        <br>
        <div class="row">
          <div class="col-lg-6">
            <label>Profesión:</label>
            <div class="input-group">
              <input type="text" class="form-control" name="editarProfesion" required onkeyup="mayusculas(this)" value="<?php echo $resultados["profesion"]; ?>">
              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div>
          </div>

          <?php if($resultados["hv_adjunto_documento"] != null): ?>

            <div class="col-lg-3">
              <label>Documento Hoja de Vida Adjunta:</label>
              <div class="input-group">
                <a href="<?php echo $resultados["hv_adjunto_documento"]; ?>" target="_blank">Hoja Vida <?php echo $resultados["nombres"] . " " . $resultados["apellidos"]; ?></a>
                <input type="hidden" value="<?php echo $resultados["hv_adjunto_documento"]; ?>" name="documentoAntiguoHv">
              </div>
            </div>

          <?php else: ?>

            <div class="col-lg-3">
              <label>Documento Hoja de Vida Adjunta:</label>
              <div class="input-group">
                <a>No Adjunto Hoja de Vida</a>
                <input type="hidden" value="" name="documentoAntiguoHv">
              </div>
            </div>

          <?php endif ?>

          <div class="col-lg-3">
            <label>Actualizar PDF Hoja de Vida:</label>
            <div class="input-group">
              <input type="file" name="editarArchivoDocumentoHojaVida[]" id="editarArchivoDocumentoHojaVida" accept="application/pdf" class="form-control">
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
              <input type="email" class="form-control" name="editarCorreoElectronico" required value="<?php echo $resultados["correo_electronico"]; ?>">
              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
          <div class="col-lg-6">
            <label>Dirección Residencia:</label>
            <div class="input-group">
              <input type="text" class="form-control" name="editarDireccionResidencia" onkeyup="mayusculas(this)" required value="<?php echo $resultados["direccion_residencia"]; ?>">
              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-4">
            <label>Número Celular:</label>
            <div class="input-group">
              <input type="text" class="form-control" name="editarCelular" data-inputmask="'mask':'999 999 9999'" data-mask required value="<?php echo $resultados["numero_celular"]; ?>">
              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
          <div class="col-lg-4">
            <label>Número Celular 2:</label>
            <div class="input-group">
            <input type="text" class="form-control" name="editarCelular2" data-inputmask="'mask':'999 999 9999'" data-mask required value="<?php echo $resultados["numero_celular_2"]; ?>">
              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div>
          </div>
          <div class="col-lg-4">
            <label>Teléfono:</label>
            <div class="input-group">
              <input type="text" class="form-control" name="editarTelefono" data-inputmask="'mask':'999 9999'" data-mask required value="<?php echo $resultados["numero_telefono"]; ?>">
              <span class="input-group-addon">
                <i class="fas fa-star"></i>
              </span>
            </div>
          </div>
        </div>

      </div>
    <!-- /.box-body -->
    <div class="box-footer">
    
    <button type="submit" name="editarDatosPersonales" class="btn btn-success"><i class="fa fa-save"></i> Actualizar Información</button>

    <?php 

      if(isset($_POST["editarDatosPersonales"])){

        $editarDt = new ControladorHojaVida();
        $editarDt->ctrEditarDatosPersonales();

      }
    
    ?>

    </div>
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