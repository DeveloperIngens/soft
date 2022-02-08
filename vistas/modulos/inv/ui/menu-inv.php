<?php 

$item = "id_usuario";
$valor = $_SESSION["id_usuario"];

$perfilesPermisos = ControladorPerfilesUsuarios::ctrMostrarUsuariosPerfiles($item, $valor);

foreach($perfilesPermisos as $key => $value):

?>

    <?php if($value["nombre_perfil"] == "soft_inventario" && $value["nombre_permiso"] == "administrar"): ?>

        <?php 
            
            $_SESSION["permiso_software"] = "soft_inventario";
            $_SESSION["rol_software"] = "administrar";
            
        ?>

        <div class="box box-primary">
            <ul class="nav nav-tabs">
                <li role="presentation"><a href="inicio-inv">Inicio</a></li>
                <li role="presentation"><a href="tecnologia-inv">Activos Fijos</a></li>
                <li role="presentation"><a href="mantenimiento-inv">Mantenimientos</a></li>
                <li role="presentation"><a href="ManteCorrectivo-inv">Mantenimientos Preventivos/Correctivos</a></li>
                <li role="presentation"><a href="calendario-inv">Calendario Mantenimiento</a></li>
            </ul>
        </div>

    <?php endif ?>

    <?php if($value["nombre_perfil"] == "soft_inventario" && $value["nombre_permiso"] == "administrativo"): ?>

        <?php 
            
            $_SESSION["permiso_software"] = "soft_inventario";
            $_SESSION["rol_software"] = "administrativo";
            
        ?>

        <div class="box box-primary">
            <ul class="nav nav-tabs">
                <li role="presentation"><a href="inicio-inv">Inicio</a></li>
                <li role="presentation"><a href="tecnologia-inv">Activos Fijos</a></li>
                <li role="presentation"><a href="mantenimiento-inv">Mantenimientos</a></li>
                <li role="presentation"><a href="ManteCorrectivo-inv">Mantenimientos Preventivos/Correctivos</a></li>
                <li role="presentation"><a href="calendario-inv">Calendario Mantenimiento</a></li>
            </ul>
        </div>

    <?php endif ?>

    <?php if($value["nombre_perfil"] == "soft_inventario" && $value["nombre_permiso"] == "consulta"): ?>

        <?php 
            
            $_SESSION["permiso_software"] = "soft_inventario";
            $_SESSION["rol_software"] = "consulta";
            
        ?>

        <div class="box box-primary">
            <ul class="nav nav-tabs">
                <li role="presentation"><a href="inicio-inv">Inicio</a></li>
                <li role="presentation"><a href="tecnologia-inv">Activos Fijos</a></li>
                <li role="presentation"><a href="mantenimiento-inv">Mantenimientos</a></li>
                <li role="presentation"><a href="ManteCorrectivo-inv">Mantenimientos Preventivos/Correctivos</a></li>
                <li role="presentation"><a href="calendario-inv">Calendario Mantenimiento</a></li>
            </ul>
        </div>        

    <?php endif ?>

    <?php if($value["nombre_perfil"] == "soft_inventario" && $value["nombre_permiso"] == "tecnologia"): ?>

        <?php 
            
            $_SESSION["permiso_software"] = "soft_inventario";
            $_SESSION["rol_software"] = "tecnologia";
            
        ?>

        <div class="box box-primary">
            <ul class="nav nav-tabs">
                <li role="presentation"><a href="inicio-inv">Inicio</a></li>
                <li role="presentation"><a href="tecnologia-inv">Activos Fijos</a></li>
                <li role="presentation"><a href="mantenimiento-inv">Mantenimientos</a></li>
                <li role="presentation"><a href="ManteCorrectivo-inv">Mantenimientos Preventivos/Correctivos</a></li>
                <li role="presentation"><a href="calendario-inv">Calendario Mantenimiento</a></li>
            </ul>
        </div>        

    <?php endif ?>

<?php endforeach ?>