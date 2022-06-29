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

    $valueHojaVida = ControladorHojaVida::ctrTraerDatosPersonalesId($_GET["idDatosPersonales"]);

    ?>

    <div class="box-header with-border text-center">
    <h1 class="box-title"><b>DATOS PERSONALES - <?php echo $valueHojaVida["nombres"] . " " . $valueHojaVida["apellidos"]; ?> </b></h1>
    </div>
    <div class="box-body">
    <div class="row">
        <div class="col-lg-6">
        <label>Tipo Identificación:</label>
        <div class="input-group">
            <input type="text" class="form-control" name="verTipoIdentificacion" id="verTipoIdentificacion" value="<?php echo $valueHojaVida["tipo_documento_fk"]; ?>" readonly>
            <span class="input-group-addon">
            <i class="fas fa-star"></i>
            </span>
        </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-6">
        <label>Número de Identificación:</label>
        <div class="input-group">
            <input type="text" class="form-control" name="verNumeroIdentificacion" value="<?php echo $valueHojaVida["identificacion"]; ?>" readonly>
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
            <input type="text" class="form-control" name="verNombres" id="verNombres" value="<?php echo $valueHojaVida["nombres"]; ?>" required readonly>
            <span class="input-group-addon">
            <i class="fas fa-star"></i>
            </span>
        </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-6">
        <label>Apellidos:</label>
        <div class="input-group">
            <input type="text" class="form-control" name="verApellidos" id="verApellidos" value="<?php echo $valueHojaVida["apellidos"]; ?>" required readonly>
            <span class="input-group-addon">
            <i class="fas fa-star"></i>
            </span>
        </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
    </div>
    <br>
    <div class="row">
        <div class="col-lg-6">
            <label>Adjunto PDF Documento Identificación</label>
            <div class="input-group">
                <a class="form-control" target="_blank" href="<?php echo $valueHojaVida["adjunto_documento"]; ?>"><?php echo $valueHojaVida["nombre_adjunto_documento"]; ?></a>
                <span class="input-group-addon">
                <i class="fas fa-star"></i>
                </span>
            </div>
        </div>

        <div class="col-lg-6">
        <label>Fecha Nacimiento:</label>
        <input type="date" class="form-control" min="1950-01-01" max="2003-12-31" name="verFechaNacimiento" value="<?php echo $valueHojaVida["fecha_nacimiento"]; ?>" readonly>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
        <label>Nacionalidad:</label>
        <div class="input-group">

            <?php 

            $codigo = $valueHojaVida["nacionalidad_fk"];

            $pais = ControladorParametricas::ctrObtenerPaisBuscado($codigo);

            ?>

            <input type="text" class="form-control" value="<?php echo $pais["pais"]; ?>" name="verPais" readonly>
            <span class="input-group-addon">
            <i class="fas fa-star"></i>
            </span>
        </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
    </div>
    <br>

    <div class="row">
        <?php if($valueHojaVida["departamento_residencia"] != ""): ?>

        <div class="col-lg-6">
            <label>Departamento Residencia:</label>
            <div class="input-group">

            <?php

                $campo = "cod_dep";
                $codigoDepartamento = $valueHojaVida["departamento_residencia"];

                $departamento = ControladorParametricas::ctrObtenerDepartamentoCiudad($campo, $codigoDepartamento);

            ?>

            <input type="text" class="form-control" name="verDepartamentoResidencia" value="<?php echo $departamento["departamento"]; ?>" readonly>
            <span class="input-group-addon">
                <i class="fas fa-star"></i>
            </span>
            </div>
        </div>

        <?php endif ?>

        <?php if($valueHojaVida["ciudad_residencia"] != ""): ?>

        <div class="col-lg-6">
            <label>Ciudad Residencia:</label>
            <div class="input-group">

            <?php

                $campo = "cod_ciudad";
                $codigoCiudad = $valueHojaVida["ciudad_residencia"];

                $ciudad = ControladorParametricas::ctrObtenerDepartamentoCiudad($campo, $codigoCiudad);

            ?>

            <input type="text" class="form-control" name="verDepartamentoResidencia" value="<?php echo $ciudad["ciudad"]; ?>" readonly>
            <span class="input-group-addon">
                <i class="fas fa-star"></i>
            </span>
            </div>
        </div>
        <?php endif ?>

    </div>

    <br>
    <div class="row">
        <div class="col-lg-6">
            <label>Profesión:</label>
            <div class="input-group">
                <input type="text" class="form-control" name="verProfesion" required readonly value="<?php echo $valueHojaVida["profesion"]; ?>">
                <span class="input-group-addon">
                <i class="fas fa-star"></i>
                </span>
            </div>
        </div>

        <div class="col-lg-6">
            <label>Adjunto PDF Hoja de Vida:</label>
            <div class="input-group">
                <a class="form-control" target="_blank" href="<?php echo $valueHojaVida["hv_adjunto_documento"]; ?>">Hoja de Vida - <?php echo $valueHojaVida["nombres"] . " " . $valueHojaVida["apellidos"]; ?></a>
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
            <input type="email" class="form-control" name="verCorreoElectronico" required readonly value="<?php echo $valueHojaVida["correo_electronico"]; ?>">
            <span class="input-group-addon">
            <i class="fas fa-star"></i>
            </span>
        </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-6">
        <label>Dirección Residencia:</label>
        <div class="input-group">
            <input type="text" class="form-control" name="verDireccionResidencia" readonly required value="<?php echo $valueHojaVida["direccion_residencia"]; ?>">
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
            <input type="text" class="form-control" name="verCelular" readonly data-inputmask="'mask':'999 999 9999'" data-mask required value="<?php echo $valueHojaVida["numero_celular"]; ?>">
            <span class="input-group-addon">
            <i class="fas fa-star"></i>
            </span>
        </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-4">
        <label>Número Celular 2:</label>
        <input type="text" class="form-control" name="verCelular2" data-inputmask="'mask':'999 999 9999'" data-mask required readonly value="<?php echo $valueHojaVida["numero_celular_2"]; ?>">
        </div>
        <div class="col-lg-4">
        <label>Teléfono:</label>
            <input type="text" class="form-control" name="nuevoTelefono" data-inputmask="'mask':'999 9999'" data-mask required readonly value="<?php echo $valueHojaVida["numero_telefono"]; ?>">
        </div>
    </div>

    </div>
    <!-- /.box-body -->
    <div class="box-footer">
    
        <button type="button" idEditar="<?php echo $valueHojaVida["id_datos_personales"]; ?>" class="btn btn-primary btnEditarDatosPersonales" data-toggle="modal" data-target="#modalEditarDatosPersonales"><i class="fa fa-pencil"></i> Editar Información</button>
        <button type="button" idIdentificacion="<?php echo $valueHojaVida["identificacion"] ?>" class="btn btn-info btnAgregarFormacion"><i class="fas fa-user-graduate"></i> Agregar Formación</button>
        <button type="button" idIdentificacion="<?php echo $valueHojaVida["identificacion"] ?>" class="btn btn-info btnAgregarExperiencia"><i class="fas fa-user-tie"></i> Agregar Experiencia</button>
        <a class="btn btn-danger pull-right" href="consultar-hv"><i class="fa fa-arrow-left"></i> Atras</a>
        
    </div>
    </form>
</div>

</section>

</div>
<script>
    
    function back(){

        history.back();

    }

</script>