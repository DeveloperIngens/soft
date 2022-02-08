/*=============================================
REDIRECCIONAR A EXPERIENCIA LABORAL USUARIO
=============================================*/
$(document).on("click", "#redireccionExperienciaLaboralUsuario", function(){

    var identificacionPersona = $(this).attr("identificacionPersona");

    window.location = "index.php?ruta=experiencia-laboral-hv&idIdentificacion="+identificacionPersona;

})

/*=============================================
REDIRECCIONAR A FORMACION USUARIO
=============================================*/
$(document).on("click", "#redireccionFormacionUsuario", function(){

    var identificacionPersona = $(this).attr("identificacionPersona");

    window.location = "index.php?ruta=nivel-estudio-hv&idIdentificacion="+identificacionPersona;

})