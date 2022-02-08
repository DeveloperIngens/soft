/*=============================================
EDITAR MANTENIMIENTO
=============================================*/
$(document).on("click", ".btnEditarMantenimiento", function(){

  var idMantenimiento = $(this).attr("idMantenimiento");
  var idActivo = $(this).attr("idActivo");

  var datos = new FormData();
  datos.append("idMantenimientos", idMantenimiento);

  $.ajax({

    url:"ajax/inv/mantenimiento.ajax-inv.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){

      $("#editarMantenimientoResponsable").val(respuesta["responsable"]);
      $("#fechaMantenimientoEditar").val(respuesta["fecha_mante"]);
      $("#fechaProximoMantenimientoEditar").val(respuesta["prox_mante"]);
      $("#editarObservacionesMantenimiento").val(respuesta["observaciones"]);
      $("#idCalendarioMantenimientoEditar").val(respuesta["id_calendario"]);

      $.ajax({

        type: "POST",
        url: "ajax/inv/mantenimiento.ajax-inv.php",
        data: "DatosCalendario="+respuesta["id_calendario"],
        success:function(respuesta){

          $("#contenedorMantenimientosEditar").html(respuesta);
    
        }

      })


      $.ajax({

        type: "POST",
        url: "ajax/inv/tecnologia.ajax-inv.php",
        data: "idActivoMostrar="+idActivo,
        success:function(respuesta){

          $("#contenedorInfoActivoMantenimientoEditar").html(respuesta);
    
        }
    
      })

      var datosActivo = new FormData();
      datosActivo.append("idActivo", respuesta["id_activo"]);

      $.ajax({

        url:"ajax/inv/tecnologia.ajax-inv.php",
        method: "POST",
        data: datosActivo,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

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

        }

      })

    }

  })

});

/*=============================================
ELIMINAR ACTIVO
=============================================*/
$(document).on("click", ".btnEliminarMantenimiento", function(){

  var placa = $(this).attr("placa");
  var idMantenimiento = $(this).attr("idMantenimiento");

  swal({
    title: '¿Está seguro de Eliminar el Mantenimiento?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, Eliminar Mantenimiento!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=mantenimiento-inv&idMantenimiento="+idMantenimiento;

    }


  })

})

/*=============================================
MANTENIMIENTOS DE EQUIPOS 
=============================================*/
$(document).on("click", ".btnCalendarioMantenimiento", function(){

  var mantenimiento = $(this).attr("idMantenimientos");
  
  var datos = new FormData();
  datos.append("idMantenimientos", mantenimiento);

  $.ajax({

    url:"ajax/inv/mantenimiento.ajax-inv.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
    
      $("#EditarCalendario").val(respuesta["id_calendario"]);
      $("#editarNumeroplacas").val(respuesta["placa"]);  
      $("#editarSerialx").val(respuesta["serial"]);
      $("#editarresponsable").val(respuesta["responsable"]);
      $("#editarfecha_mant").val(respuesta["fecha_mante"]);
      $("#editarprox_mante").val(respuesta["prox_mante"]);
      $("#editarcolor").val(respuesta["color"]);
      $("#editarMantenimiento").val(respuesta["mantenimiento"]);
      $("#editarobservaciones").val(respuesta["observaciones"]);
      $("#editarCorrectivo").val(respuesta["mante_correctivo"]);
      $("#editarFechaCorrectivo").val(respuesta["fecha_correctivo"]);
      }

    })

  });

/*=============================================
EDITAR MANTENIMIENTO
=============================================*/
$(document).on("click", ".btnRealizarMantenimiento", function(){

  var idMantenimiento = $(this).attr("idMantenimiento");

  window.open ("index.php?ruta=editar-mantenimiento-inv&idMantenimientoEditar="+idMantenimiento, "_black");
  

});



/*=============================================
ACTIVAR USUARIO
=============================================*/
$(document).on("click", ".btnActivarMantenimiento", function(){

  var IdMantenimiento = $(this).attr("IdMantenimiento");
  var ActivarEstado = $(this).attr("ActivarEstado");

  var datos = new FormData();
  datos.append("id_calendario", IdMantenimiento);
    datos.append("ActivarEstado", ActivarEstado);

    $.ajax({

      url:"ajax/inv/mantenimiento.ajax-inv.php",
    method: "POST",
    data: datos,
    cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

       swal({
        title: "El mantenimiento ha sido actualizado",
        type: "success",
        confirmButtonText: "¡Cerrar!"
      }).then(function(result) {
        
          if (result.value) {

          window.location = "mantenimiento-inv";

        }

      });

      }

    })

    if(ActivarEstado == 0){

      $(this).removeClass('btn-success');
      $(this).addClass('btn-danger');
      $(this).html('SIN REALIZAR');
      $(this).attr('ActivarEstado',1);

    }else{

      $(this).addClass('btn-success');
      $(this).removeClass('btn-danger');
      $(this).html('REALIZADO');
      $(this).attr('ActivarEstado',0);

    }

})


$(".tablaVerMantenimientos").DataTable({

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
    "order": [[8, "asc"]]

});