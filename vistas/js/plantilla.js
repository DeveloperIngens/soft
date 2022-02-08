/*=============================================
SideBar Menu
=============================================*/

$('.sidebar-menu').tree();

/*=============================================
Data Table
=============================================*/

$(".tablas").DataTable({

	"language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}

});

$(document).ready(function() {
    $('.select2').select2();
});


/*==================================================
=            BOTON MODAL EDITAR USUARIO            =
==================================================*/

$(".btnEditarUsuarioPropio").click(function(){

	var Usuario= $(this).attr("Usuario");

	var datos = new FormData();
	datos.append("Usuario", Usuario);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarNombreUsuario").val(respuesta["nombre"]);
			$("#editarDocumentoUsuario").val(respuesta["documento"]);
			$("#editarUsuarioPropio").val(respuesta["usuario"]);
			$("#editarCorreoPropio").val(respuesta["mail"]);
			$("#passwordActualUsuario").val(respuesta["password"]);

		}

	});



});

/*=================================
EDITAR USUARIO PROPIO
==================================*/
$(".btnEditarUsuarioPropio").click(function(){

	var idUsuarioEdicion = document.getElementById('idUsuario').value;

	var datos = new FormData();
	datos.append("idUsuarioEdicion", idUsuarioEdicion);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#idUsuario").val(respuesta["id_usuario"]);
			$("#editarNombres").val(respuesta["nombres"]);
			$("#editarApellidos").val(respuesta["apellidos"]);
			$("#editarCorreo").val(respuesta["correo"]);
			$("#contrasenaActual").val(respuesta["contrasena"]);
			$("#editarPerfil").html(respuesta["perfil_ingreso"]);
			$("#editarPerfil").val(respuesta["perfil_ingreso"]);
			$("#editarNumeroIdentificacion").val(respuesta["numero_identificacion"]);

		}

	});



});




/*=============================================
CORRECCIÓN BOTONERAS OCULTAS BACKEND	
=============================================*/

if(window.matchMedia("(max-width:767px)").matches){
	
	$("body").removeClass('sidebar-collapse');

}else{

	$("body").addClass('sidebar-collapse');
}

/*=============================================
CAMPOS DE TEXTO VOLVER MAYUSCULA	
=============================================*/
function mayusculas(e){

	e.value = e.value.toUpperCase();

}

/*=============================================
BOTON VOLVER ATRAS
=============================================*/
function back(){

	history.back();

}

//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' });
//Money Euro
$('[data-mask]').inputmask();