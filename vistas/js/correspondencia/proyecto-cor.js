/*=============================================
EDITAR PROYECTO
=============================================*/
$(document).on("click", ".btnEditarProyecto", function(){

	var idProyecto = $(this).attr("idProyecto");
	
	var datos = new FormData();
	datos.append("idProyecto", idProyecto);

	$.ajax({

		url:"ajax/correspondencia/proyecto-cor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarNombreProyecto").val(respuesta["nombre_proyecto"]);
			$("#editarPrefijoProyecto").val(respuesta["prefijo_proyecto"]);
			$("#idProyecto").val(respuesta["id_proyecto"]);

			var datosResponsable = new FormData();
			datosResponsable.append("idUsuario", respuesta["id_responsable"]);

			$.ajax({

				url:"ajax/usuarios.ajax.php",
				method: "POST",
				data: datosResponsable,
				cache:false,
				contentType:false,
				processData:false,
				dataType: "json",
				success: function(respuesta){

					$("#editarPersonaResponsable").val(respuesta["id_usuario"]);
					$("#editarPersonaResponsable").html(respuesta["nombres"] + " " + respuesta["apellidos"]);

				}

			})

		}

	});

})


/*=============================================
ELIMINAR PROYECTO
=============================================*/
$(document).on("click", ".btnEliminarProyecto", function(){

    var idProyecto = $(this).attr("idProyecto");

    swal({
		title: '¿Está seguro de eliminar el Proyecto?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar!'
		
    }).then(function(result){
  
      if(result.value){
  
        window.location = "index.php?ruta=proyectos-cor&idProyecto="+idProyecto;
  
      }
  
    })
  
})


/*=============================================
REVISAR SI EL USUARIO YA ESTÁ REGISTRADO
=============================================*/
$("#nuevoPrefijoProyecto").change(function(){

	$(".alert").remove();

	var prefijo = $(this).val();

	var datos = new FormData();
	datos.append("validarPrefijo", prefijo);

	 $.ajax({
	    url:"ajax/correspondencia/proyecto-cor.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoPrefijoProyecto").parent().after('<div class="alert alert-warning">Este Prefijo ya existe, por favor digite otro.</div>');

	    		$("#nuevoPrefijoProyecto").val("");

	    	}

	    }

	})
})