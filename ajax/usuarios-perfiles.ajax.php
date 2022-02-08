<?php

require_once "../controladores/perfiles.usuarios.controlador.php";
require_once "../modelos/perfiles.usuarios.modelo.php";

class AjaxUsuariosPerfiles {

    /*================================
    VALIDAR NO REPETIR
    ================================*/
    public $idUsuario;
    public $idPerfil;
    public $idPermiso;

    public function ajaxValidarUsuarioPerfil(){

        $valor1 = $this->idUsuario;
        $valor2 = $this->idPerfil;
        $valor3 = $this->idPermiso;

        $respuesta = ControladorPerfilesUsuarios::ctrValidarUsuarioPerfil($valor1, $valor2, $valor3);

        echo json_encode($respuesta);

    }

    /*================================
    TRAER PERMISOS QUE TIENE EL PERFIL
    ================================*/
    public $idPerfilBuscar;

    public function ajaxTraerPermisosPerfil(){

        $valor = $this->idPerfilBuscar;

        $permisos = ControladorPerfilesUsuarios::ctrTraerPermisosPerfil($valor);

        $cadenaSelect = "";

        foreach($permisos as $key => $value){

            $cadenaSelect = $cadenaSelect . '<option value="'.$value["id_permiso"].'">'.$value["nombre_permiso"].'</option>';

        }



        echo '<option value="">-- Seleccione una opcion --</option>'.$cadenaSelect;

    }

}

if(isset($_POST["idUsuario"]) && isset($_POST["idPerfil"]) && isset($_POST["idPermiso"])){

    $valPerfil = new AjaxUsuariosPerfiles();
    $valPerfil->idUsuario = $_POST["idUsuario"];
    $valPerfil->idPerfil = $_POST["idPerfil"];
    $valPerfil->idPermiso = $_POST["idPermiso"];
    $valPerfil->ajaxValidarUsuarioPerfil();

}

if(isset($_POST["idPerfilBuscar"])){

    $valPermisos = new AjaxUsuariosPerfiles();
    $valPermisos->idPerfilBuscar = $_POST["idPerfilBuscar"];
    $valPermisos->ajaxTraerPermisosPerfil();

}