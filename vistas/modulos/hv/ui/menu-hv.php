<?php 

$item = "id_usuario";
$valor = $_SESSION["id_usuario"];

$perfilesPermisos = ControladorPerfilesUsuarios::ctrMostrarUsuariosPerfiles($item, $valor);

foreach($perfilesPermisos as $key => $value):

?>

    <?php if($value["nombre_perfil"] == "soft_hoja_vida" && $value["nombre_permiso"] == "consulta-creacion"): ?>

        <?php 
            
            $_SESSION["permiso_software"] = "soft_hoja_vida";
            $_SESSION["rol_software"] = "consulta-creacion";
            $_SESSION["obtiene_permiso"] = "SI-PERMISO";
            
        ?>

        <div class="box box-primary">
            <ul class="nav nav-tabs">
                <li role="presentation"><a href="inicio-hv">Inicio</a></li>
                <li role="presentation"><a href="datos-personales-hv">Mis Datos Personales</a></li>
                <li role="presentation"><a id="redireccionFormacionUsuario" identificacionPersona="<?php echo $_SESSION["numero_identificacion"]; ?>">Mis Formaciónes</a></li>
                <li role="presentation"><a id="redireccionExperienciaLaboralUsuario" identificacionPersona="<?php echo $_SESSION["numero_identificacion"]; ?>">Mis Experiencias Laborales</a></li>
            </ul>
        </div>

    <?php endif ?>

    <?php if($value["nombre_perfil"] == "soft_hoja_vida" && $value["nombre_permiso"] == "administrar"): ?>

        <?php 
            
            $_SESSION["permiso_software"] = "soft_hoja_vida";
            $_SESSION["rol_software"] = "administrar";
            $_SESSION["obtiene_permiso"] = "SI-PERMISO";
            
        ?>

        <div class="box box-primary">
            <ul class="nav nav-tabs">
                <li role="presentation"><a href="inicio-hv">Inicio</a></li>
                <li role="presentation"><a class="dropdown-toggle" data-toggle="dropdown" role="buttton" aria-haspopup="true" aria-expanded="false">Administrar <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li role="presentation"><a href="admin-datos-personales">Crear Datos Personales</a></li>
                    </ul>
                </li>
                <li role="presentation"><a href="datos-personales-hv">Mis Datos Personales</a></li>
                <li role="presentation"><a id="redireccionFormacionUsuario" identificacionPersona="<?php echo $_SESSION["numero_identificacion"]; ?>">Mis Formaciónes</a></li>
                <li role="presentation"><a id="redireccionExperienciaLaboralUsuario" identificacionPersona="<?php echo $_SESSION["numero_identificacion"]; ?>">Mis Experiencias Laborales</a></li>
                <li role="presentation"><a href="consultar-hv">Consultar Hoja Vida</a></li>
            </ul>
        </div>

    <?php endif ?>

    <?php if($value["nombre_perfil"] == "soft_hoja_vida" && $value["nombre_permiso"] == "consulta"): ?>

        <?php 
            
            $_SESSION["permiso_software"] = "soft_hoja_vida";
            $_SESSION["rol_software"] = "consulta";
            $_SESSION["obtiene_permiso"] = "SI-PERMISO";
            
        ?>

        <div class="box box-primary">
            <ul class="nav nav-tabs">
                <li role="presentation"><a href="inicio-hv">Inicio</a></li>
                <li role="presentation"><a href="consultar-hv">Consultar Hoja Vida</a></li>
            </ul>
        </div>        

    <?php endif ?>

<?php endforeach ?>