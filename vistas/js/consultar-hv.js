/*==============================
REDIRECCION A VER DATOS PERSONALES
===============================*/
$(document).on("click", ".btnVerDatosPersonalesNuevaPestania", function(){

    var idDatosPersonales = $(this).attr("idDatosPersonales");

    console.log('Dio click');

    window.open ("index.php?ruta=ver-datos-personales-hv&idDatosPersonales="+idDatosPersonales, "_black");

})



/*==============================
PREVISUALIZAR INFORMACION PERFIL
===============================*/
$(document).on("click", ".btnPrevisualizarPersona", function(){

    var idDatosPersonales = $(this).attr("idDatosPersonales");

    var datosPersonales = new FormData();
    datosPersonales.append('idDatosPersonales', idDatosPersonales);

    $.ajax({

        url: "ajax/datos-personales.ajax.php",
        method: "POST",
        data: datosPersonales,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){

            console.log(respuesta);

            $("#visualizarTipoDocumento").html('<label>Tipo Identificación: </label> '+respuesta["tipo_documento_fk"]+'');
            $("#visualizarNumeroIdentificacion").html('<label>Número Identificación: </label> '+respuesta["identificacion"]+'');
            $("#visualizarNombreCompleto").html('<label>Nombre: </label> '+respuesta["nombres"]+ ' ' +respuesta["apellidos"]+'');
            $("#visualizarDocumentoAdjunto").html('<label>Documento Adjunto:</label><a href="'+respuesta["adjunto_documento"]+'" target="_blank"> '+respuesta["nombre_adjunto_documento"]+'</a>');
            $("#visualizarFechaNacimineto").html('<label>Fecha Nacimiento: </label> '+respuesta["fecha_nacimiento"]+'');
            $("#visualizarProfesion").html('<label>Profesión:</label> '+respuesta["profesion"]+'');
            $("#visualizarCorreo").html('<label>Correo Electrónico:</label> '+respuesta["correo_electronico"]+'');
            $("#visualizarDireccionResidencia").html('<label>Dirección Residencia:</label> '+respuesta["direccion_residencia"]+'');
            $("#visualizarCelular1").html('<label>Número Celular:</label> '+respuesta["numero_celular"]+'');
            $("#visualizarCelular2").html('<label>Número Celular 2:</label> '+respuesta["numero_celular_2"]+'');
            $("#visualizarTelefono").html('<label>Telefono:</label> '+respuesta["numero_telefono"]+'');

            if(respuesta["hv_adjunto_documento"] != null){

                $("#visualizarHojaVida").html('<label>Hoja Vida Adjunto:</label><a href="'+respuesta["hv_adjunto_documento"]+'" target="_blank"> '+respuesta["nombres"] + ' ' + respuesta["apellidos"] +'</a>');

            }else{

                $("#visualizarHojaVida").html('<label>Hoja Vida Adjunto:</label><a> No adjunto Hoja Vida.</a>');

            }


            var datosNacionalidad = new FormData();
            datosNacionalidad.append('nacionalidad', respuesta["nacionalidad_fk"]);

            $.ajax({

                url: "ajax/parametricas.ajax.php",
                method: "POST",
                data: datosNacionalidad,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success:function(respuesta){

                    $("#visualizarNacionalidad").html('<label>Nacionalidad: </label> '+respuesta["pais"]+'');

                }

            })

            if(respuesta["departamento_residencia"] != ""){

                var datosDepartamento = new FormData();
                datosDepartamento.append('departamentoResidencia', respuesta["departamento_residencia"]);

                $.ajax({

                    url: "ajax/parametricas.ajax.php",
                    method: "POST",
                    data: datosDepartamento,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success:function(respuesta){
    
                        $("#visualizarDepartamento").html('<label>Departamento Residencia:</label> '+respuesta["departamento"]+'');
                        $("#visualizarCiudad").html('<label>Ciudad Residencia:</label> '+respuesta["ciudad"]+'');
    
                    }
    
                })                

            }

            var idIdentificacion = respuesta["identificacion"];

            $.ajax({

                type: "POST",
                url: "ajax/niveles-estudios.ajax.php",
                data: "idIdentificacionPersona="+idIdentificacion,
                success:function(respuesta){
        
                    $("#contenedorFormacion").html(respuesta);
        
                }
        
            })

            $.ajax({

                type: "POST",
                url: "ajax/experiencias-laborales.ajax.php",
                data: "idIdentificacionPersona="+idIdentificacion,
                success:function(respuesta){

                    $("#contenedorExperiencias").html(respuesta);

                }

            })


        }

    })

})