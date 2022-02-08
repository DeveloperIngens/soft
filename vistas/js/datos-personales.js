/*==================================
VAIDAR QUE EL NUMERO DE CEDULA NO SE ENCUENTRA REGISTRADO PREVIAMENTE
===============================*/
$("#nuevoNumeroIdentificacion").change(function(){

    var identificacion = document.getElementById('nuevoNumeroIdentificacion').value;

    var datos = new FormData();
    datos.append('identificacionPersona', identificacion);

    $.ajax({

        url: "ajax/datos-personales.ajax.php",
        method: "POST",
        data: datos,
        cache:false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){

        if(respuesta != ""){

            var idDatosPersonales = respuesta[0]["id_datos_personales"];

            swal({

                type: 'error',
                title: '¡El Número de Identificacion ya se encuentra registrado, sera redireccionado a los datos de ese Número de Identificación!',
                showConfirmButton: true,
                confirmButtonText: 'Cerrar'

            }).then(function(result){

                if(result.value){
                
                    window.location = 'index.php?ruta=ver-datos-personales-hv&idDatosPersonales='+idDatosPersonales;

                }

            });


        }

    }

  })

});

/*=============================================
ELIMINAR DATOS PERSONALES
=============================================*/
$(document).on("click", ".btnEliminarDatosPersonales", function(){

    var datosPersonalesEliminar = $(this).attr("idDatosPersonales");
    var rutaArchivo = $(this).attr("rutaArchivo");

    console.log(datosPersonalesEliminar);
  
    swal({
      title: '¿Está seguro de borrar los Datos Personales?',
      text: "¡Si no lo está puede cancelar la accíón!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Datos Personales!'
    }).then(function(result){
  
      if(result.value){
  
        window.location = "index.php?ruta=datos-personales-hv&idDatosPersonales="+datosPersonalesEliminar;
  
      }
  
    })
  
  })

/*==============================
REDIRECCION A EXPERIENCIA LABORAL
===============================*/
$(document).on("click", ".btnAgregarExperiencia", function(){

    var idIdentificacion = $(this).attr("idIdentificacion");

    window.location = "index.php?ruta=experiencia-laboral-hv&idIdentificacion="+idIdentificacion;

})

/*==============================
REDIRECCION A FORMACION
===============================*/
$(document).on("click", ".btnAgregarFormacion", function(){

    var idIdentificacion = $(this).attr("idIdentificacion");

    window.location = "index.php?ruta=nivel-estudio-hv&idIdentificacion="+idIdentificacion;

})

/*==============================
REDIRECCION A VER DATOS PERSONALES
===============================*/
$(document).on("click", ".btnVerDatosPersonales", function(){

    var idDatosPersonales = $(this).attr("idDatosPersonales");

    window.location = "index.php?ruta=ver-datos-personales-hv&idDatosPersonales="+idDatosPersonales;

})


/*===============================
REDIRECCION A EDICION DE DATOS PERSONALES
=================================*/
$(document).on("click", ".btnEditarDatosPersonales", function(){

    var idDatosPersonales = $(this).attr("idEditar");

    window.location = "index.php?ruta=editar-datos-personales-hv&idDatosPersonales="+idDatosPersonales;

    /*
    var datosPersonales = new FormData();
    datosPersonales.append("idDatosPersonales", idDatosPersonales);

    $.ajax({

        url: "ajax/datos-personales.ajax.php",
        method: "POST",
        data: datosPersonales,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){

            var datosTipoIdentificacion = new FormData();
            datosTipoIdentificacion.append("tipoIdentificacion", respuesta["tipo_documento_fk"]);

            $.ajax({

                url: "ajax/parametricas.ajax.php",
                method: "POST",
                data: datosTipoIdentificacion,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                success:function(respuesta){

                    $("#editarTipoIdentificacionDp").html(respuesta["nombre_tipo_doc"]);
                    $("#editarTipoIdentificacionDp").val(respuesta["id_tipo_doc"]);

                }

            })

            $("#editarNumeroIdentificacionDp").val(respuesta["identificacion"]);
            $("#editarNombresDp").val(respuesta["nombres"]);
            $("#rutaDocumentoAdjuntoDp").val(respuesta["adjunto_documento"]);
            $("#documento").html('<a href="'+respuesta["adjunto_documento"]+'" target="_blank">'+respuesta["nombre_adjunto_documento"]+'</a>');
            $("#editarFechaNaciminetoDp").val(respuesta["fecha_nacimiento"]);

            var datosNacionalidad = new FormData();
            datosNacionalidad.append("nacionalidad", respuesta["nacionalidad_fk"]);

            $.ajax({

                url: "ajax/parametricas.ajax.php",
                method: "POST",
                data: datosNacionalidad,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                success:function(respuesta){

                    $("#editarNacionalidadDp").val(respuesta["cod_pais"]);
                    $("#editarNacionalidadDp").html(respuesta["pais"]);

                }

            })

            if(respuesta["ciudad_residencia"] != ""){

                var datosDepartamentoResidencia = new FormData();
                datosDepartamentoResidencia.append("departamentoResidencia", respuesta["ciudad_residencia"]);

                $.ajax({

                    url: "ajax/parametricas.ajax.php",
                    method: "POST",
                    data: datosDepartamentoResidencia,
                    cache:false,
                    contentType:false,
                    processData:false,
                    dataType:"json",
                    success:function(respuesta){


                    }

                })


            }



        }

    })
    */


})

$("#editarArchivoDocumentoIdentidad").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf"){

        $("#editarArchivoDocumentoIdentidad").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})

$("#editarArchivoDocumentoHojaVida").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf"){

        $("#editarArchivoDocumentoHojaVida").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})


$("#nuevoArchivoDocumentoIdentidad").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf"){

        $("#nuevoArchivoDocumentoIdentidad").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})

$("#nuevoArchivoDocumentoHojaVida").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf"){

        $("#nuevoArchivoDocumentoHojaVida").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})