/*=============================================
VALIDAMOS QUE SE ESTE CARGANDO UN PDF
=============================================*/
$("#nuevoPdfEntregaEquipo").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf"){

        $("#nuevoPdfEntregaEquipo").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})

/*=============================================
MANTENIMIENTOS DE EQUIPOS 
=============================================*/
$(document).on("click", ".btnAsignarResponsableActivo", function(){

	var idActivo = $(this).attr("idActivo");
	
	var datos = new FormData();
	datos.append("idActivo", idActivo);

	$.ajax({

		url:"ajax/inv/tecnologia.ajax-inv.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			$("#idActivoAsignacion").val(respuesta["id_activos"]);

		}

	})

	$.ajax({

		type: "POST",
		url: "ajax/inv/tecnologia.ajax-inv.php",
		data: "idActivoMostrar="+idActivo,
		success:function(respuesta){

			$("#contenedorInfoActivoTecnologiaAsignacion").html(respuesta);

		}

	})

});


/*=========================
QUITAR ASIGNACION RESPONSABLE ACTIVO
=========================*/
$(document).on("click", ".btnQuitarAsignacionActivo", function(){

	var idActivo = $(this).attr("idActivo");
  
	swal({
		title: '¿Está seguro de eliminar Las asignación al Activo?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar Asignación!'
	}).then(function(result){
  
		if(result.value){

			console.log(idActivo);

			var datos = new FormData();
			datos.append("idActivoQuitarAsignacion", idActivo);

			$.ajax({

				url:"ajax/inv/tecnologia.ajax-inv.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta){


				}

			})

			swal({

				title: "¡La asignación del Activo fue eliminada correctamente!",
				type: "success",
				confirmButtonText: "¡Cerrar!"
				
			}).then(function(result) {
				
				if (result.value) {

					window.location = "tecnologia-inv";

				}

			});
  
  
		}
  
  
	})
  
})


/*=============================================
VER INFORMACION ACTIVO 
=============================================*/
$(document).on("click", ".btnVerInformacionActivoMantenimiento", function(){

	var idActivo = $(this).attr("idActivo");
	
	var datos = new FormData();
	datos.append("idActivo", idActivo);

	$.ajax({

		type: "POST",
		url: "ajax/inv/tecnologia.ajax-inv.php",
		data: "idActivoMostrar="+idActivo,
		success:function(respuesta){

		  $("#contenedorInfoActivo").html(respuesta);

		}

	})

});

/*======================
CAMPO DE VALOR COMERCIAL ACTIVO
=======================*/
$(document).ready(function() {

    $('#nuevoValorComercialActivo').maskMoney();

})

/*======================
CAMPO DE VALOR COMPRA ACTIVO
=======================*/
$(document).ready(function() {

    $('#nuevoValorCompraActivo').maskMoney();

})

/*=============================
MOSTRAR CLASIFICACION ACTIVO
==============================*/
$("#nuevaCategoriaActivoEditar").change(function(){

	var categoriaActivo = $("#nuevaCategoriaActivoEditar").val();

	if(categoriaActivo == 14 || categoriaActivo == 13 || categoriaActivo == 12 || categoriaActivo == 11 || categoriaActivo == 10 || categoriaActivo == 9){

		$("#nuevaClasificacionActivoEditar").val('Muebles y Enseres');


	}else{

		$("#nuevaClasificacionActivoEditar").val('Equipo de computo');

	}

});

/*=============================
MOSTRAR CLASIFICACION ACTIVO
==============================*/
$("#nuevaCategoriaActivo").change(function(){

	var categoriaActivo = $("#nuevaCategoriaActivo").val();

	if(categoriaActivo == 14 || categoriaActivo == 13 || categoriaActivo == 12 || categoriaActivo == 11 || categoriaActivo == 10 || categoriaActivo == 9){

		$("#contenedorClasificacion").html('<input class="form-control" type="text" name="nuevaClasificacionActivo" value="Muebles y Enseres" required readonly>');


	}else{

		$("#contenedorClasificacion").html('<input class="form-control" type="text" name="nuevaClasificacionActivo" value="Equipo de computo" required readonly>');

	}

});

/*=============================================
CAMBIAR ESTADO ACTIVO 
=============================================*/
$(document).on("click", ".btnCambiarEstadoActivo", function(){

	var idActivo = $(this).attr("idActivo");

	var datos = new FormData();
	datos.append("idActivo", idActivo);

	$.ajax({

		type: "POST",
		url: "ajax/inv/tecnologia.ajax-inv.php",
		data: "idActivoMostrar="+idActivo,
		success:function(respuesta){

		  $("#contenedorInfoActivo").html(respuesta);

		}

	})

	$.ajax({

		url:"ajax/inv/tecnologia.ajax-inv.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			$("#idActivoCambioEstado").val(respuesta["id_activos"]);

			if(respuesta["estado_activo"] == "BUENO"){

				$("#estadoActualActivo").html('<a class="btn btn-success">'+respuesta["estado_activo"]+'</a>');


			}else if(respuesta["estado_activo"] == "REGULAR"){

				$("#estadoActualActivo").html('<a class="btn btn-warning">'+respuesta["estado_activo"]+'</a>');

			}else if(respuesta["estado_activo"] == "MALO"){

				$("#estadoActualActivo").html('<a class="btn btn-danger">'+respuesta["estado_activo"]+'</a>');

			}

		

		}

	})

});


/*=============================================
EDITAR ACTIVO 
=============================================*/
$(document).on("click", ".btnEditarTecnologia", function(){

	var idActivo = $(this).attr("idActivo");
	
	var datos = new FormData();
	datos.append("idActivo", idActivo);

	$.ajax({

		url:"ajax/inv/tecnologia.ajax-inv.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){			
 			
			$("#idActivoEditar").val(respuesta["id_activos"]);
			$("#nuevaUbicacionActivoEditar").val(respuesta["ubicacion"]);
			$("#nuevoProyectoActivoEditar").val(respuesta["proyecto"]);
			$("#nuevoNumeroPuestoActivoEditar").val(respuesta["numero_puesto"]);
			$("#nuevoPuntoRedActivoEditar").val(respuesta["punto_red"]);
			$("#nuevaCategoriaActivoEditar").val(respuesta["categoria"]);
			$("#nuevaClasificacionActivoEditar").val(respuesta["clasificacion"]);
			$("#nuevaMarcaActivoEditar").val(respuesta["marca"]);
			$("#nuevoNumeroPlacaActivoEditar").val(respuesta["numero_placa"]);
			$("#nuevoSerialActivoEditar").val(respuesta["serial"]);
			$("#nuevoEstadoActivoEditar").val(respuesta["estado_activo"]);
			$("#nuevoMetodoAdquisicionActivoEditar").val(respuesta["metodo_adquisicion_activo"]);
			$("#nuevoCentroCostosEditar").val(respuesta["centro_costos_activo"]);
			$("#nuevaFechaAdquisicionActivoEditar").val(respuesta["fecha_adquisicion"]);
			$("#nuevaCuentaContableActivoEditar").val(respuesta["cuenta_contable"]);
			$("#nuevoValorCompraActivoEditar").val(respuesta["valor_compra"]);
			$("#nuevoValorComercialActivoEditar").val(respuesta["valor_comercial"]);
			$("#nuevaObservacionActivoEditar").val(respuesta["observaciones"]);

			if(respuesta["id_responsable"] != null){

				var datosUsuario = new FormData();
				datosUsuario.append("idUsuario", respuesta["id_responsable"]);

				$.ajax({

					url:"ajax/usuarios.ajax.php",
					method: "POST",
					data: datosUsuario,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(respuesta){

						$("#responsableAsignadoEditar").val(respuesta["nombres"] + " " + respuesta["apellidos"]);


					}

				})

			}else{

				$("#responsableAsignadoEditar").val('No tiene Responsable Asignado al Activo.');

			}

		}

	})

});

/*=============================================
VER INFORMACION ACTIVO 
=============================================*/
$(document).on("click", ".btnVerInformacionActivoMantenimiento", function(){

	var idActivo = $(this).attr("idActivo");
	
	var datos = new FormData();
	datos.append("idActivo", idActivo);

	$.ajax({

		type: "POST",
		url: "ajax/inv/tecnologia.ajax-inv.php",
		data: "idActivoMostrar="+idActivo,
		success:function(respuesta){

		  $("#contenedorInfoActivo").html(respuesta);

		}

	})

});

/*=============================================
VER INFORMACION ACTIVO 
=============================================*/
$(document).on("click", ".btnVerInformacionActivo", function(){

	var idActivo = $(this).attr("idActivo");

	var datos = new FormData();
	datos.append("idActivo", idActivo);

	$.ajax({

		type: "POST",
		url: "ajax/inv/tecnologia.ajax-inv.php",
		data: "idActivoMostrar="+idActivo,
		success:function(respuesta){

		  $("#contenedorInfoActivoTecnologia").html(respuesta);

		}

	})

});


/*=============================================
MANTENIMIENTOS DE EQUIPOS 
=============================================*/
$(document).on("click", ".btnAgregarMantenimiento", function(){

	var idActivo = $(this).attr("idActivo");
	
	var datos = new FormData();
	datos.append("idActivo", idActivo);

	$.ajax({

		url:"ajax/inv/tecnologia.ajax-inv.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

		
			$("#mantenimientoIdActivo").val(respuesta["id_activos"]);
			$("#editarIdActivosss").val(respuesta["id_activos"]);
			$("#editarNumeroplacas").val(respuesta["numero_placa"]);	
			$("#editarSerialx").val(respuesta["serial"]);
			$("#mantenimientoCategoriaActivo").val(respuesta["categoria"]);
			$("#numeroPlacaMantenimiento").val(respuesta["numero_placa"]);
			$("#numeroSerialMantenimiento").val(respuesta["serial"]);


			var idCategoria = respuesta["categoria"];

			$.ajax({

				type: "POST",
				url: "ajax/inv/tecnologia.ajax-inv.php",
				data: "idCategoriaPreven="+idCategoria,
				success:function(respuesta){

					$("#contenedorMantenimientosPreventivos").html(respuesta);

				}

			})

			$.ajax({

				type: "POST",
				url: "ajax/inv/tecnologia.ajax-inv.php",
				data: "idCategoriaCorrec="+idCategoria,
				success:function(respuesta){

					$("#contenedorMantenimientosCorrectivos").html(respuesta);

				}

			})


			$.ajax({

				type: "POST",
				url: "ajax/inv/tecnologia.ajax-inv.php",
				data: "idActivoMostrar="+idActivo,
				success:function(respuesta){

					$("#contenedorInfoActivoMantenimiento").html(respuesta);
		
				}
		
			})

		}

	})

});


/*=============================================
ELIMINAR ACTIVO
=============================================*/

$(document).on("click", ".btnEliminarTecnologia", function(){
  
  var puesto = $(this).attr("numeropuesto");
  var placa = $(this).attr("placa");
  var id_activos = $(this).attr("IdActivos");

  swal({
    title: '¿Está seguro de borrar el activo?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar activo!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=tecnologia-inv&numeropuesto="+puesto+"&placa="+placa+"&IdActivos="+id_activos;

    }


  })

})

/*=============================================
ACTIVAR ACITVO
=============================================*/
$(document).on("click", ".btnActivarTecnologia", function(){

	var idActivo = $(this).attr("idActivo");
	var estadoActivo = $(this).attr("estadoTecnologia");
	
	var datos = new FormData();
 	datos.append("activarId", idActivo);
  	datos.append("activarTecnologia", estadoActivo);

  	$.ajax({

	  url:"ajax/inv/tecnologia.ajax-inv.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){
		
      		 swal({
		      	title: "El activo ha sido actualizado",
		      	type: "success",
		      	confirmButtonText: "¡Cerrar!"
		    	}).then(function(result) {
		        
		        	if (result.value) {

		        	window.location = "tecnologia-inv";

		        }

		      });


		}
      

  	})

  	if(estadoActivo == 0){

  		$(this).removeClass('btn-danger');
  		$(this).addClass('btn-success');
  		$(this).html('LIBRE');
  		$(this).attr('estadoTecnologia',1);

  	}else{
		
  		$(this).addClass('btn-danger');
  		$(this).removeClass('btn-success');
  		$(this).html('OCUPADO');
  		$(this).attr('estadoTecnologia',0);

  	}

})

/*=============================================
REVISAR SI LA PLACA YA ESTÁ REGISTRADA
=============================================*/
/*
$("#nuevoNumeroPlacaActivoEditar").change(function(){

	$(".alert").remove();

	var numero_placa = $(this).val();

	var datos = new FormData();
	
	datos.append("validarTecnologia", numero_placa);

	 $.ajax({
	    url:"ajax/inv/tecnologia.ajax-inv.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoNumeroPlacaActivoEditar").parent().after('<div class="alert alert-warning">Este número de Placa ya se encuentra registrada.</div>');

	    		$("#nuevoNumeroPlacaActivoEditar").val("");            

	    	}

	    }

	})

})

*/


/*=============================================
REVISAR SI LA PLACA YA ESTÁ REGISTRADA
=============================================*/

$("#nuevoNumeroPlacaActivo").change(function(){

	$(".alert").remove();

	var numero_placa = $(this).val();

	var datos = new FormData();
	
	datos.append("validarTecnologia", numero_placa);

	 $.ajax({
	    url:"ajax/inv/tecnologia.ajax-inv.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoNumeroPlacaActivo").parent().after('<div class="alert alert-warning">Este número de Placa ya se encuentra registrada.</div>');

	    		$("#nuevoNumeroPlacaActivo").val("");            

	    	}

	    }

	})
})


var table = $('#tablaTecnologia').DataTable({

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

	},
	orderCellsTop: true,
	fixedHeader: true,
	columnDefs: [
		{ orderable: false, targets: [11] }
	],
	ordering: false,
	

});

$('#tablaTecnologia thead tr').clone(true).appendTo( '#tablaTecnologia thead' );

$('#tablaTecnologia thead tr:eq(1) th').each( function (i) {

	var title = $(this).text();
	$(this).html( '<input type="text" class="form-control" placeholder="Buscar..." />' );

	$( 'input', this ).on( 'keyup change', function () {

		if(table.column(i).search() !== this.value){

			table
				.column(i)
				.search( this.value )
				.draw();

		}

	})

})