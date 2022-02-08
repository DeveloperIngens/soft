/*=============================================
ELIMINAR NIVEL ESTUDIO
=============================================*/
$(document).on("click", ".btnEliminarNivelEstudio", function(){

    var idEliminarNivelEstudio = $(this).attr("idEliminarNivelEstudio");
    var rutaArchivoDiAc = $(this).attr("rutaArchivo");
    var rutaArchivoTarjeta = $(this).attr("rutaArchivoTarjeta");
    var idIdentificacion = $(this).attr("idIdentificacion");

    swal({
        title: '¿Está seguro de borrar el Nivel Estudio?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, borrar!'
      }).then(function(result){
    
        if(result.value){
    
          window.location = "index.php?ruta=nivel-estudio-hv&idEliminarNivelEstudio="+idEliminarNivelEstudio+"&rutaArchivoDiAc="+rutaArchivoDiAc+"&rutaArchivoTarjeta="+rutaArchivoTarjeta+"&idIdentificacion="+idIdentificacion;
    
        }
    
    })

    
})

/*=============================================
VER NIVEL ESTUDIO
=============================================*/
$(document).on("click", ".btnVerNivelEstudio", function(){

	var idNivelEstudioVer = $(this).attr("idNivelEstudioVer");

	var datosVer = new FormData();
	datosVer.append("idNivelEstudioVer", idNivelEstudioVer);

	$.ajax({

		url:"ajax/niveles-estudios.ajax.php",
		method: "POST",
		data: datosVer,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

            var datosNivelEstudio = new FormData();
            datosNivelEstudio.append("idNivelEducativo", respuesta["id_nivel_educativo"]);

            $.ajax({

                url: "ajax/parametricas.ajax.php",
                method:"POST",
                data: datosNivelEstudio,
                cache:false,
                contentType:false,
                processData:false,
                dataType: "json",
                success: function(respuesta){

                    $("#verNivelEducativo").html('<center><h2><b>'+respuesta["nombre_nivel"]+'</b></h2></center><hr>');

                }

            })

            //console.log(respuesta);

            $("#verTituloOtorgado").val(respuesta["titulo_obtenido"]);
            $("#verFechaGrado").val(respuesta["fecha_finalizacion"]);

            if(respuesta["institucion_educativa_id"] != null){

                var datosDepartamentoInstitucion = new FormData();
                datosDepartamentoInstitucion.append("idDepartamentoInstitucion", respuesta["institucion_educativa_id"]);

                $.ajax({

                    url:"ajax/niveles-estudios.ajax.php",
                    method:"POST",
                    data: datosDepartamentoInstitucion,
                    cache:false,
                    contentType:false,
                    processData:false,
                    dataType: "json",
                    success:function(respuesta){

                        $("#Departamento").html('<label>Departamento Institución Educativa:</label><div class="input-group"><input type="text" class="form-control" value="'+respuesta["ciudad"]+'" readonly><span class="input-group-addon"><i class="fas fa-star"></i></span></div>');

                        $("#Institucion").html('<label>Institución Educativa:</label><div class="input-group"><input type="text" class="form-control" value="'+respuesta["nombre"]+'" readonly><span class="input-group-addon"><i class="fas fa-star"></i></span></div>');

                    }


                })

            }else if(respuesta["institucion_educativa_otro"] != ""){

                $("#Institucion").html('<label>Institución Educativa:</label><div class="input-group"><input type="text" class="form-control" value="'+respuesta["institucion_educativa_otro"]+'" readonly><span class="input-group-addon"><i class="fas fa-star"></i></span></div>');
                $("#Departamento").html('');
            
            }
            
            if(respuesta["institucion_secundaria"] != null){

                $("#Institucion").html('<label>Institución Educativa:</label><div class="input-group"><input type="text" class="form-control" value="'+respuesta["institucion_secundaria"]+'" readonly><span class="input-group-addon"><i class="fas fa-star"></i></span></div>');

            }

            if(respuesta["adjunto_tarjeta_profesional"] != null){

                $("#AdjuntoTarjeta").html('<label>Adjunto Tarjeta Profesional:</label><div class="input-group"><a class="form-control" href="'+respuesta["adjunto_tarjeta_profesional"]+'" target="_blank">'+respuesta["nombre_archivo_tarjeta"]+'</a><span class="input-group-addon"><i class="fas fa-star"></i></span></div>');

            }else{

                $("#AdjuntoTarjeta").html('');

            }
        
            if(respuesta["fecha_expedicion_tarjeta"] != null){

                $("#FechaExpTarjeta").html('<label>Fecha EXP. Tarjeta Profesional:</label><div class="input-group"><input type="date" class="form-control" value="'+respuesta["fecha_expedicion_tarjeta"]+'" readonly><span class="input-group-addon"><i class="fas fa-star"></i></span></div>');

            }else{

                $("#FechaExpTarjeta").html('');

            }

            if(respuesta["fecha_finalizacion_materias"] != null){

                $("#FechaTerMaterias").html('<label>Fecha Terminación Materias:</label><div class="input-group"><input type="date" class="form-control" value="'+respuesta["fecha_finalizacion_materias"]+'" readonly><span class="input-group-addon"><i class="fas fa-star"></i></span></div>');

            }else{

                $("#FechaTerMaterias").html('');

            }

            if(respuesta["documento_adjunto"] != null){

                $("#AdjuntoDiplomaActa").html('<label>Adjunto Diploma/Acta:</label><div class="input-group"><input type="text" class="form-control" value="'+respuesta["documento_adjunto"]+'" readonly><span class="input-group-addon"><i class="fas fa-star"></i></span></div>');

            }else{

                $("#AdjuntoDiplomaActa").html('');

            }

            if(respuesta["adjunto_diploma"] != null){

                $("#AdjuntoDiAc").html('<label>Adjunto:</label><div class="input-group"><a class="form-control" href="'+respuesta["adjunto_diploma"]+'" target="_blank">'+respuesta["nombre_archivo"]+'</a><span class="input-group-addon"><i class="fas fa-star"></i></span></div>')

            }else{

                $("#AdjuntoDiAc").html('');

            }

		}

	});

});




/*================================
MOSTRAR SELECCION NIVEL ESTUDIO
=================================*/
function mostrarSeleccionNivelEstudio(){

    var atributo = document.getElementById("seleccionarNivelEstudio");

    if(atributo.style.display === "none"){

        atributo.style.display = "block";

    }else{

        atributo.style.display = "none";

    }

}


/*==================================
VAIDAR QUE EL NUMERO DE CEDULA NO SE ENCUENTRA REGISTRADO PREVIAMENTE
===============================*/
function mostrarFormularios(){

    var nivelFormacion = $("#nuevoNivelEstudio").val();
    
    if(nivelFormacion == 0){

        $("#formularioBachillerato").css("display", "block");
        $("#formularioTecnicoLaboral").css("display", "none");
        $("#formularioTecProfesional").css("display", "none");


    }else if(nivelFormacion == 1){

        $("#formularioBachillerato").css("display", "none");
        $("#formularioTecnicoLaboral").css("display", "block");
        $("#formularioTecProfesional").css("display", "none");

    }else if(nivelFormacion == 2){

        $("#formularioBachillerato").css("display", "none");
        $("#formularioTecnicoLaboral").css("display", "none");
        $("#formularioTecProfesional").css("display", "block");

    }


}

$(".nuevoDepartamentoInstitucion").change(function(){

    var departamentoInstitucion = $(".nuevoDepartamentoInstitucion").val();

    $.ajax({

        type: "POST",
        url: "ajax/parametricas.ajax.php",
        data: "idDepartamentoInstitucion="+$('.nuevoDepartamentoInstitucion').val(),
        success:function(respuesta){

            $("#contenedorInstitucionEducativa").html(respuesta);

        }

    })

})

$(".nuevoDepartamentoInstitucionTecLaboral").change(function(){

    var departamentoInstitucion = $(".nuevoDepartamentoInstitucionTecLaboral").val();

    $.ajax({

        type: "POST",
        url: "ajax/parametricas.ajax.php",
        data: "idDepartamentoInstitucion="+$('.nuevoDepartamentoInstitucionTecLaboral').val(),
        success:function(respuesta){

            $("#contenedorInstitucionEducativaTecLaboral").html(respuesta);

        }

    })

})

$(".nuevoDepartamentoInstitucionTecPro").change(function(){

    var departamentoInstitucion = $(".nuevoDepartamentoInstitucionTecPro").val();

    $.ajax({

        type: "POST",
        url: "ajax/parametricas.ajax.php",
        data: "idDepartamentoInstitucion="+$('.nuevoDepartamentoInstitucionTecPro').val(),
        success:function(respuesta){

            $("#contenedorInstitucionEducativaTecPro").html(respuesta);

        }

    })

})

$(".nuevoDepartamentoInstitucionTecnologica").change(function(){

    var departamentoInstitucion = $(".nuevoDepartamentoInstitucionTecnologica").val();

    $.ajax({

        type: "POST",
        url: "ajax/parametricas.ajax.php",
        data: "idDepartamentoInstitucion="+$('.nuevoDepartamentoInstitucionTecnologica').val(),
        success:function(respuesta){

            $("#contenedorInstitucionEducativaTecnologica").html(respuesta);

        }

    })

})

$(".nuevoDepartamentoInstitucionUni").change(function(){

    var departamentoInstitucion = $(".nuevoDepartamentoInstitucionUni").val();

    $.ajax({

        type: "POST",
        url: "ajax/parametricas.ajax.php",
        data: "idDepartamentoInstitucion="+$('.nuevoDepartamentoInstitucionUni').val(),
        success:function(respuesta){

            $("#contenedorInstitucionEducativaUni").html(respuesta);

        }

    })

})

$(".nuevoDepartamentoInstitucionEsp").change(function(){

    var departamentoInstitucion = $(".nuevoDepartamentoInstitucionEsp").val();

    $.ajax({

        type: "POST",
        url: "ajax/parametricas.ajax.php",
        data: "idDepartamentoInstitucion="+$('.nuevoDepartamentoInstitucionEsp').val(),
        success:function(respuesta){

            $("#contenedorInstitucionEducativaEsp").html(respuesta);

        }

    })

})

$(".nuevoDepartamentoInstitucionMae").change(function(){

    var departamentoInstitucion = $(".nuevoDepartamentoInstitucionMae").val();

    $.ajax({

        type: "POST",
        url: "ajax/parametricas.ajax.php",
        data: "idDepartamentoInstitucion="+$('.nuevoDepartamentoInstitucionMae').val(),
        success:function(respuesta){

            $("#contenedorInstitucionEducativaMae").html(respuesta);

        }

    })

})

$(".nuevoDepartamentoInstitucionDoc").change(function(){

    var departamentoInstitucion = $(".nuevoDepartamentoInstitucionDoc").val();

    $.ajax({

        type: "POST",
        url: "ajax/parametricas.ajax.php",
        data: "idDepartamentoInstitucion="+$('.nuevoDepartamentoInstitucionDoc').val(),
        success:function(respuesta){

            $("#contenedorInstitucionEducativaDoc").html(respuesta);

        }

    })

})

/*=======================================
VALIDACION DE QUE SE ENVIAR ARCHIVOS PDF
========================================*/
$("#nuevoArchivoNivelEstudioBachi").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf"){

        $("#nuevoArchivoNivelEstudioBachi").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})

$("#nuevoArchivoNivelEstudioTecLaboral").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf"){

        $("#nuevoArchivoNivelEstudioTecLaboral").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})

$("#nuevoArchivoNivelEstudioTecPro").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf"){

        $("#nuevoArchivoNivelEstudioTecPro").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})

$("#nuevoArchivoNivelEstudioTecnologica").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf"){

        $("#nuevoArchivoNivelEstudioTecnologica").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})

$("#nuevoArchivoNivelEstudioTecnologica").change(function(){

    var imagen = this.files[0];

    console.log(imagen);

    if(imagen["type"] != "application/pdf"){

        $("#nuevoArchivoNivelEstudioTecnologica").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }   

})

$("#nuevoArchivoTarjetaProfesionalUni").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf"){

        $("#nuevoArchivoTarjetaProfesionalUni").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})

$("#nuevoArchivoNivelEstudioUni").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf"){

        $("#nuevoArchivoNivelEstudioUni").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})

$("#nuevoArchivoTarjetaProfesionalEsp").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf"){

        $("#nuevoArchivoTarjetaProfesionalEsp").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})

$("#nuevoArchivoNivelEstudioEsp").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf"){

        $("#nuevoArchivoNivelEstudioEsp").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})

$("#nuevoArchivoTarjetaProfesionalMae").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf"){

        $("#nuevoArchivoTarjetaProfesionalMae").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})

$("#nuevoArchivoNivelEstudioMae").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf"){

        $("#nuevoArchivoNivelEstudioMae").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})

$("#nuevoArchivoTarjetaProfesionalDoc").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf"){

        $("#nuevoArchivoTarjetaProfesionalDoc").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})

$("#nuevoArchivoNivelEstudioDoc").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf"){

        $("#nuevoArchivoNivelEstudioDoc").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})

$("#nuevoArchivoNivelEstudioEstNoFor").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf"){

        $("#nuevoArchivoNivelEstudioEstNoFor").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})