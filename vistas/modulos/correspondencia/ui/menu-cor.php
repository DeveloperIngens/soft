<?php 

$item = "id_usuario";
$valor = $_SESSION["id_usuario"];

$perfilesPermisos = ControladorPerfilesUsuarios::ctrMostrarUsuariosPerfiles($item, $valor);

$cantidadPendientes = ControladorCorrespondencia::ctrObtenerCantidadAsignadaReAsignada($_SESSION["id_usuario"]);

if($cantidadPendientes == false){

    $cantidadPendientes["CANTIDAD_ACEPTADA"] = "0";
    $cantidadPendientes["CANTIDAD_ASIGNADA"] = "0"; 
    $cantidadPendientes["CANTIDAD_RE_ASIGNADA"] = "0";

}

foreach($perfilesPermisos as $key => $value):

?>

    <?php if($value["nombre_perfil"] == "soft_correspondencia" && $value["nombre_permiso"] == "administrador"): ?>

    <?php 
        
        $_SESSION["permiso_software"] = "soft_correspondencia";
        $_SESSION["rol_software"] = "administrador";
        $_SESSION["obtiene_permiso"] = "SI-PERMISO";
        
    ?>

    <div class="box box-primary">
        <ul class="nav nav-tabs">
            <li role="presentation"><a href="inicio-cor">Inicio</a></li>
            <li role="presentation"><a class="dropdown-toggle" data-toggle="dropdown" role="buttton" aria-haspopup="true" aria-expanded="false">Administrar <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li role="presentation"><a href="proyectos-cor"><i class="fas fa-clipboard-list"></i> Proyectos</a></li>
                </ul>
            </li>
            <li role="presentation"><a href="correspondencia-enviada-cor"><i class="fa fa-mail-forward"></i> Correspondencia Enviada</a></li>
            <li role="presentation"><a class="dropdown-toggle" data-toggle="dropdown" role="buttton" aria-haspopup="true" aria-expanded="false">Correspondencia Recibida<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li role="presentation"><a href="cargar-correspondencia-recibida-cor"><i class="fas fa-file-upload"></i> Cargar Correspondencia</a></li>
                    <li role="presentation"><a href="correspondencia-recibida-cor"><i class="fas fa-id-badge"></i> Mi Correspondencia Recibida <span class="label label-success"><?php echo $cantidadPendientes["CANTIDAD_ACEPTADA"]; ?></span>-<span class="label label-primary"><?php echo $cantidadPendientes["CANTIDAD_ASIGNADA"]; ?></span>-<span class="label label-warning"><?php echo $cantidadPendientes["CANTIDAD_RE_ASIGNADA"]; ?></span></a></li>
                    <li role="presentation"><a href="ver-correspondencia-entrante-cor"><i class="fas fa-id-badge"></i> Ver Correspondencia Recibida </a></li>
                </ul>
            </li>
        </ul>
    </div>

    <?php endif ?>

    <?php if($value["nombre_perfil"] == "soft_correspondencia" && $value["nombre_permiso"] == "administrar"): ?>

        <?php 
            
            $_SESSION["permiso_software"] = "soft_correspondencia";
            $_SESSION["rol_software"] = "administrar";
            $_SESSION["obtiene_permiso"] = "SI-PERMISO";
            
        ?>

        <div class="box box-primary">
            <ul class="nav nav-tabs">
                <li role="presentation"><a href="inicio-cor">Inicio</a></li>
                <li role="presentation"><a class="dropdown-toggle" data-toggle="dropdown" role="buttton" aria-haspopup="true" aria-expanded="false">Administrar <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li role="presentation"><a href="proyectos-cor"><i class="fas fa-clipboard-list"></i> Proyectos</a></li>
                    </ul>
                </li>
                <li role="presentation"><a href="correspondencia-enviada-cor"><i class="fa fa-mail-forward"></i> Correspondencia Enviada</a></li>
                <li role="presentation"><a class="dropdown-toggle" data-toggle="dropdown" role="buttton" aria-haspopup="true" aria-expanded="false">Correspondencia Recibida<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <li role="presentation"><a href="cargar-correspondencia-recibida-cor"><i class="fas fa-file-upload"></i> Cargar Correspondencia</a></li>
                        <li role="presentation"><a href="correspondencia-recibida-cor"><i class="fas fa-id-badge"></i> Mi Correspondencia Recibida <span class="label label-success"><?php echo $cantidadPendientes["CANTIDAD_ACEPTADA"]; ?></span>-<span class="label label-primary"><?php echo $cantidadPendientes["CANTIDAD_ASIGNADA"]; ?></span>-<span class="label label-warning"><?php echo $cantidadPendientes["CANTIDAD_RE_ASIGNADA"]; ?></span></a></li>
                    </ul>
                </li>
            </ul>
        </div>


    <?php endif ?>

    <?php if($value["nombre_perfil"] == "soft_correspondencia" && $value["nombre_permiso"] == "administrar-correspondencia-enviada"): ?>

        <?php 
            
            $_SESSION["permiso_software"] = "soft_correspondencia";
            $_SESSION["rol_software"] = "administrar-correspondencia-enviada";
            $_SESSION["obtiene_permiso"] = "SI-PERMISO";
            
        ?>

        <div class="box box-primary">
            <ul class="nav nav-tabs">
                <li role="presentation"><a href="inicio-cor">Inicio</a></li>
                <li role="presentation"><a class="dropdown-toggle" data-toggle="dropdown" role="buttton" aria-haspopup="true" aria-expanded="false">Administrar <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li role="presentation"><a href="proyectos-cor"><i class="fas fa-clipboard-list"></i> Proyectos</a></li>
                    </ul>
                </li>
                <li role="presentation"><a href="correspondencia-enviada-cor"><i class="fa fa-mail-forward"></i> Correspondencia Enviada</a></li>
            </ul>
        </div>


    <?php endif ?>

    <?php if($value["nombre_perfil"] == "soft_correspondencia" && $value["nombre_permiso"] == "administrar-correspondencia-enviada-recibida"): ?>

    <?php 
        
        $_SESSION["permiso_software"] = "soft_correspondencia";
        $_SESSION["rol_software"] = "administrar-correspondencia-enviada-recibida";
        $_SESSION["obtiene_permiso"] = "SI-PERMISO";
        
    ?>

    <div class="box box-primary">
        <ul class="nav nav-tabs">
            <li role="presentation"><a href="inicio-cor">Inicio</a></li>
            <li role="presentation"><a class="dropdown-toggle" data-toggle="dropdown" role="buttton" aria-haspopup="true" aria-expanded="false">Administrar <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li role="presentation"><a href="proyectos-cor"><i class="fas fa-clipboard-list"></i> Proyectos</a></li>
                </ul>
            </li>
            <li role="presentation"><a href="correspondencia-enviada-cor"><i class="fa fa-mail-forward"></i> Correspondencia Enviada</a></li>
            <li role="presentation"><a href="correspondencia-recibida-cor"><i class="fas fa-id-badge"></i> Mi Correspondencia Recibida <span class="label label-success"><?php echo $cantidadPendientes["CANTIDAD_ACEPTADA"]; ?></span>-<span class="label label-primary"><?php echo $cantidadPendientes["CANTIDAD_ASIGNADA"]; ?></span>-<span class="label label-warning"><?php echo $cantidadPendientes["CANTIDAD_RE_ASIGNADA"]; ?></span></a></li>
        </ul>
    </div>


    <?php endif ?>


    <?php if($value["nombre_perfil"] == "soft_correspondencia" && $value["nombre_permiso"] == "cargar-correspondencia-entrante"): ?>

        <?php 
            
            $_SESSION["permiso_software"] = "soft_correspondencia";
            $_SESSION["rol_software"] = "cargar-correspondencia-entrante";
            $_SESSION["obtiene_permiso"] = "SI-PERMISO";
            
        ?>

        <div class="box box-primary">
            <ul class="nav nav-tabs">
                <li role="presentation"><a href="inicio-cor">Inicio</a></li>
                <li role="presentation"><a href="cargar-correspondencia-recibida-cor">Cargar Correspondencia Entrante</a></li>
            </ul>
        </div>        

    <?php endif ?>

<?php endforeach ?>