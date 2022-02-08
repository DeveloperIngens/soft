/*================================
MOSTRAR FORMULARIO EXPERIENCIA LABORAL
=================================*/
function mostrarFormularioExperienciaLaboral(){

    var atributo = document.getElementById("formularioAgregarExperiencia");

    if(atributo.style.display === "none"){

        atributo.style.display = "block";

    }else{

        atributo.style.display = "none";

    }

}

/*======================
CAMPO DE SALARIO O CONTRATO
=======================*/
$(document).ready(function() {

    $('#nuevoValorSalario').maskMoney();

})

/*======================
CAMPO DE SALARIO O CONTRATO EDITAR
=======================*/
$(document).ready(function() {

    $('#editarValorContratoSalario').maskMoney();

})

/*======================
CALCULAR DIAS MESES ANIOS DE DURACION
=======================*/
function calcularDatosFechas(){

    var fechaInicio = $("#nuevaFechaInicioLabor").val();
    var fechaFin = $("#nuevaFechaFinalLabor").val();

    var fechaUno = moment(fechaInicio);
    var fechaDos = moment(fechaFin);

    var duracion = moment.duration(fechaDos.diff(fechaUno));

    var dias = duracion.asDays();
    var meses = duracion.asMonths();
    var anios = duracion.asYears();

    $("#nuevoAniosLaborados").val(anios.toFixed(2));
    $("#nuevoMesesLaborados").val(meses.toFixed(2));
    $("#nuevoDiasLaborados").val(dias);

}

/*======================
CALCULAR DIAS MESES ANIOS DE DURACION EN EDICION
=======================*/
function calcularDatosFechasEditar(){

    var fechaInicio = $("#editarFechaInicioLabor").val();
    var fechaFin = $("#editarFechaFinLabor").val();

    var fechaUno = moment(fechaInicio);
    var fechaDos = moment(fechaFin);

    var duracion = moment.duration(fechaDos.diff(fechaUno));

    var dias = duracion.asDays();
    var meses = duracion.asMonths();
    var anios = duracion.asYears();

    $("#editarTiempoLaboradoAnios").val(anios.toFixed(2));
    $("#editarTiempoLaboradoMeses").val(meses.toFixed(2));
    $("#editarTiempoLaboradoDias").val(dias);

}


/*=============================================
VER EXPERIENCIA LABORAL
=============================================*/
$(document).on("click", ".btnVerExperienciaLaboral", function(){

	var idExperienciaLaboralVer = $(this).attr("idExperienciaLaboralVer");

	var datosVer = new FormData();
	datosVer.append("idExperienciaLaboralVer", idExperienciaLaboralVer);

	$.ajax({

		url:"ajax/experiencias-laborales.ajax.php",
		method: "POST",
		data: datosVer,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

            var datosSector = new FormData();
            datosSector.append('idSector', respuesta["sector_id"]);

            $.ajax({

                url:"ajax/parametricas.ajax.php",
                method: "POST",
                data: datosSector,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                success: function(respuesta){

                    $("#verSector").val(respuesta["nombre"]);


                }

            });


            $("#verEmpresaEntidad").val(respuesta["empresa_entidad"]);
            $("#verCargo").val(respuesta["cargo"]);
            $("#verAreaTrabajo").val(respuesta["area_trabajo"]);
            $("#verValorContratoSalario").val(respuesta["valor_contrato_salario"]);
            $("#verFechaInicioLabor").val(respuesta["fecha_inicio_formato"]);
            $("#verFechaFinLabor").val(respuesta["fecha_fin_formato"]);
            $("#verTiempoLaboradoDias").val(respuesta["tiempo_dias"]);
            $("#verTiempoLaboradoMeses").val(respuesta["tiempo_meses"]);
            $("#verTiempoLaboradoAnios").val(respuesta["tiempo_anios"]);
            $("#verTipoDocumento").val(respuesta["tipo_documento"]);
            $("#archivo").html('<a href="'+respuesta["adjunto_certificacion"]+'" target="_blank">'+respuesta["nombre_archivo"]+'</a>');
            $("#verCertificadoConFunciones").val(respuesta["objeto_contrato"]);

		}

	});

});

/*=============================================
EDITAR EXPERIENCIA LABORAL
=============================================*/
$(document).on("click", ".btnEditarExperienciaLaboral", function(){

	var idEditarExperienciaLaboral = $(this).attr("idEditarExperienciaLaboral");

	var datosVer = new FormData();
	datosVer.append("idEditarExperienciaLaboral", idEditarExperienciaLaboral);

	$.ajax({

		url:"ajax/experiencias-laborales.ajax.php",
		method: "POST",
		data: datosVer,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

            var datosSector = new FormData();
            datosSector.append('idSector', respuesta["sector_id"]);

            $.ajax({

                url:"ajax/parametricas.ajax.php",
                method: "POST",
                data: datosSector,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                success: function(respuesta){

                    $("#editarSector").val(respuesta["id_sector"]);
                    $("#editarSector").html(respuesta["nombre"]);


                }

            });

            $("#editarIdExperienciaLaboral").val(respuesta["id_experiencia_laboral"]);
            $("#idIdentificacionFk").val(respuesta["identificacion_fk"]);
            $("#editarEmpresaEntidad").val(respuesta["empresa_entidad"]);
            $("#editarCargo").val(respuesta["cargo"]);
            $("#editarAreaTrabajo").val(respuesta["area_trabajo"]);
            $("#editarValorContratoSalario").val(respuesta["valor_contrato_salario"]);
            $("#editarFechaInicioLabor").val(respuesta["fecha_inicio"]);
            $("#editarFechaFinLabor").val(respuesta["fecha_fin"]);
            $("#editarTiempoLaboradoDias").val(respuesta["tiempo_dias"]);
            $("#editarTiempoLaboradoMeses").val(respuesta["tiempo_meses"]);
            $("#editarTiempoLaboradoAnios").val(respuesta["tiempo_anios"]);
            $("#editarTipoDocumento").val(respuesta["tipo_documento"]);
            $("#editarTipoDocumento").html(respuesta["tipo_documento"]);
            $("#archivoEditar").html('<a href="'+respuesta["adjunto_certificacion"]+'" target="_blank">'+respuesta["nombre_archivo"]+'</a>');
            $("#editarCertificadoFunciones").val(respuesta["objeto_contrato"]);
            $("#editarCertificadoFunciones").html(respuesta["objeto_contrato"]);
            $("#documentoAntiguo").val(respuesta["adjunto_certificacion"]);
            $("#nombreArchivoAntiguo").val(respuesta["nombre_archivo"]);

		}

	});

});

/*=============================================
ELIMINAR EXPERIENCIA LABORAL
=============================================*/
$(document).on("click", ".btnEliminarExperienciaLaboral", function(){

    var idEliminarExperienciaLaboral = $(this).attr("idEliminarExperienciaLaboral");
    var rutaArchivo = $(this).attr("rutaArchivo");
    var identificacionFk = $(this).attr("idIdentificacion");

    swal({
      title: '¿Está seguro de borrar la Experiencia Laboral?',
      text: "¡Si no lo está puede cancelar la accíón!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar!'
    }).then(function(result){
  
      if(result.value){
  
        window.location = "index.php?ruta=experiencia-laboral-hv&idExperienciaLaboralEliminar="+idEliminarExperienciaLaboral+"&rutaArchivo="+rutaArchivo+"&idIdentificacion="+identificacionFk;
  
      }
  
    })
  
  })

/*=============================================
VALIDAMOS QUE SE ESTE CARGANDO UN PDF
=============================================*/
$("#nuevoDocumentoCertificacion").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf"){

        $("#nuevoDocumentoCertificacion").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})

/*==============================
REDIRECCION A VER DATOS PERSONALES
===============================*/
$(document).on("click", ".btnDatosPersonales", function(){

    var idDatosPersonales = $(this).attr("idDatosPersonales");

    window.location = "index.php?ruta=ver-datos-personales-hv&idDatosPersonales="+idDatosPersonales;

})

$(".tablaExperienciaLaboral").DataTable({

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
    "order": [[6, "desc"]]

});