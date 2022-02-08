/*=============================================
EDITAR MANTENIMIENTO
=============================================*/
$(document).on("click", ".btnEditarCorrectivo", function(){

	var IdCorrectivo = $(this).attr("IdCorrectivo");

	var datos = new FormData();
	datos.append("IdCorrectivo", IdCorrectivo);

	$.ajax({

		url:"ajax/inv/Correctivo.ajax-inv.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){			
			
			$("#editarMantenimiento").val(respuesta["id_tipo_mantenimiento"]);
			$("#editarNombre").val(respuesta["nombre_mantenimiento"]);
			$("#editarTipo").val(respuesta["tipo"]);
			$("#editarTipos").val(respuesta["tipo_mantenimiento"]);
			$("#editarfechas").val(respuesta["fecha_creacion"]);
			$("#editarTipoActivo").val(respuesta["id_categoria"]);

		}

	});

})
/*=============================================
ELIMINAR MANTENIMINENTO
=============================================*/

$(document).on("click", ".btnEliminarCorrectivo", function(){
 
  var id_correctivo = $(this).attr("IdCorrectivo");
  swal({
    title: '¿Está seguro de Eliminar el Mantenimiento Preventivo/Correctivo?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, eliminar Mantenimiento Preventico/Correctivo!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=ManteCorrectivo-inv&IdCorrectivo="+id_correctivo;

    }


  })

})
