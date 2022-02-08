/*===========================================
REVISAR SI EL USUARIO YA TIENE ASIGNADO ESE PERMISO
============================================*/
/*
$("#modalAgregarPerfilUsuario").on("change", "#nuevoPerfil", "#nuevoUsuario", function(){

    $(".alert").remove();

    var idPerfil = document.getElementById('nuevoPerfil').value;
    var idUsuario = document.getElementById('nuevoUsuario').value;
    var idPermiso = document.getElementById('nuevoPermiso').value;

    var datos = new FormData();
    datos.append("idUsuario", idUsuario);
    datos.append("idPerfil", idPerfil);
    datos.append("idPermiso", idPermiso);

    $.ajax({

        url: "ajax/usuarios-perfiles.ajax.php",
        method: "POST",
        data: datos,
        cache:false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            
            if(respuesta){

                $("#nuevoUsuario").parent().after('<div style="margin-top:25px;" class="alert alert-danger">El Usuario ya cuenta con este perfil</div>');

                $("#nuevoPerfil").val("");

                $("#nuevoUsuario").val("");

                $("#nuevoPermiso").val("");

            }

        }

    })

});

*/

/*
$("#modalAgregarPerfilUsuario").on("change", "#nuevoPerfil", "#nuevoPermiso", function(){

    $(".alert").remove();

    var idPerfil = document.getElementById('nuevoPerfil').value;
    var idUsuario = document.getElementById('nuevoUsuario').value;
    var idPermiso = document.getElementById('nuevoPermiso').value;

    var datos = new FormData();
    datos.append("idUsuario", idUsuario);
    datos.append("idPerfil", idPerfil);
    datos.append("idPermiso", idPermiso);

    $.ajax({

        url: "ajax/usuarios-perfiles.ajax.php",
        method: "POST",
        data: datos,
        cache:false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            
            if(respuesta){

                $("#nuevoUsuario").parent().after('<div style="margin-top:25px;" class="alert alert-danger">El Usuario ya cuenta con este perfil</div>');

                $("#nuevoPerfil").val("");

                $("#nuevoUsuario").val("");

                $("#nuevoPermiso").val("");

            }

        }

    })

});
*/

/*===========================================
REVISAR SI EL USUARIO YA TIENE ASIGNADO ESE PERMISO
============================================*/
/*

$("#modalAgregarPerfilUsuario").on("change", "#nuevoUsuario", "#nuevoPerfil", function(){

    $(".alert").remove();

    var idPerfil = document.getElementById('nuevoPerfil').value;
    var idUsuario = document.getElementById('nuevoUsuario').value;
    var idPermiso = document.getElementById('nuevoPermiso').value;

    var datos = new FormData();
    datos.append("idUsuario", idUsuario);
    datos.append("idPerfil", idPerfil);
    datos.append("idPermiso", idPermiso);

    $.ajax({

        url: "ajax/usuarios-perfiles.ajax.php",
        method: "POST",
        data: datos,
        cache:false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            
            if(respuesta){

                $("#nuevoUsuario").parent().after('<div style="margin-top:25px;" class="alert alert-danger">El Usuario ya cuenta con este perfil</div>');

                $("#nuevoPerfil").val("");

                $("#nuevoUsuario").val("");

                $("#nuevoPermiso").val("");

            }

        }

    })

});

*/

/*

$("#modalAgregarPerfilUsuario").on("change", "#nuevoUsuario", "#nuevoPermiso", function(){

    $(".alert").remove();

    var idPerfil = document.getElementById('nuevoPerfil').value;
    var idUsuario = document.getElementById('nuevoUsuario').value;
    var idPermiso = document.getElementById('nuevoPermiso').value;

    var datos = new FormData();
    datos.append("idUsuario", idUsuario);
    datos.append("idPerfil", idPerfil);
    datos.append("idPermiso", idPermiso);

    $.ajax({

        url: "ajax/usuarios-perfiles.ajax.php",
        method: "POST",
        data: datos,
        cache:false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            
            if(respuesta){

                $("#nuevoUsuario").parent().after('<div style="margin-top:25px;" class="alert alert-danger">El Usuario ya cuenta con este perfil</div>');

                $("#nuevoPerfil").val("");

                $("#nuevoUsuario").val("");

                $("#nuevoPermiso").val("");

            }

        }

    })

});

*/

/*===========================================
REVISAR SI EL USUARIO YA TIENE ASIGNADO ESE PERMISO
============================================*/

$("#modalAgregarPerfilUsuario").on("change", "#nuevoPermiso", "#nuevoUsuario", function(){

    $(".alert").remove();

    var idPerfil = document.getElementById('nuevoPerfil').value;
    var idUsuario = document.getElementById('nuevoUsuario').value;
    var idPermiso = document.getElementById('nuevoPermiso').value;

    var datos = new FormData();
    datos.append("idUsuario", idUsuario);
    datos.append("idPerfil", idPerfil);
    datos.append("idPermiso", idPermiso);

    $.ajax({

        url: "ajax/usuarios-perfiles.ajax.php",
        method: "POST",
        data: datos,
        cache:false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            
            if(respuesta){

                $("#nuevoUsuario").parent().after('<div style="margin-top:25px;" class="alert alert-danger">El Usuario ya cuenta con el Permiso seleccionado.</div>');

                $("#nuevoPerfil").val("");

                $("#nuevoUsuario").val("");

                $("#nuevoPermiso").val("");

            }

        }

    })

});
/*===========================================
REVISAR SI EL USUARIO YA TIENE ASIGNADO ESE PERMISO
============================================*/

$("#modalAgregarPerfilUsuario").on("change", "#nuevoPermiso", "#nuevoPerfil", function(){

    $(".alert").remove();

    var idPerfil = document.getElementById('nuevoPerfil').value;
    var idUsuario = document.getElementById('nuevoUsuario').value;
    var idPermiso = document.getElementById('nuevoPermiso').value;

    var datos = new FormData();
    datos.append("idUsuario", idUsuario);
    datos.append("idPerfil", idPerfil);
    datos.append("idPermiso", idPermiso);

    $.ajax({

        url: "ajax/usuarios-perfiles.ajax.php",
        method: "POST",
        data: datos,
        cache:false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            
            if(respuesta){

                $("#nuevoPerfil").val("");

                $("#nuevoUsuario").val("");

                $("#nuevoPermiso").val("");

            }

        }

    })

});

/*===================================
TRAEMOS PERMISOS DEL PERFIL Y LOS ENVIAMOS AL SELECT DE PERMISOS
====================================*/
$("#nuevoPerfil").change(function(){

    $.ajax({

        type: "POST",
        url: "ajax/usuarios-perfiles.ajax.php",
        data: "idPerfilBuscar="+$('#nuevoPerfil').val(),
        success:function(respuesta){

            $("#nuevoPermiso").html(respuesta);

        }

    })

});

/*===========================
ELIMINAR PERFIL USUARIO, PERMISO
============================*/
$(document).on("click", ".btnEliminarPerfilUsuario", function(){

    var idPerfilUsuario = $(this).attr("idPerfilUsuario");

    swal({

        title: '¿Está seguro de borrar el Perfil Usuario?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Perfil Usuario'
    
    }).then(function(result){

        if(result.value){

            window.location = "index.php?ruta=usuarios-perfiles&idPerfilUsuario="+idPerfilUsuario;

        }

    })

});