/*===========================
VER CORRESPONDENCIA RECIBIDA ADMINISTRADOR
============================*/
$(document).on("click", ".btnVerAsignacionCorrespondenciaRecibidaVer", function(){

	var idCorrespondenciaRecibida = $(this).attr("idCorrespondenciaRecibida");

	var datos = new FormData();
	datos.append("idCorrespondenciaRecibida", idCorrespondenciaRecibida);

	$.ajax({

		url:"ajax/correspondencia/correspondencia-cor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

            $("#verAsuntoCorRecibidaReAsigAdmin").html('<div>'+respuesta["asunto"]+'</div>');
            $("#verObservacionesCorRecibidaReAsigAdmin").html('<div>'+respuesta["observaciones_cor_recibida"]+'</div>');
            $("#verDocumentoAdjuntoCorRecibidaReAsigAdmin").html('<a target="_blank" href="'+respuesta["archivo_adj_recibido"]+'">Documento Adjunto</a>');
            $("#verTipoCorrespondenciaReAsigAdmin").html('<div>'+respuesta["tipo_cor_recibida"]+'</div>');
            
            if(respuesta["estado_asignacion_cor_recibida"] == "Asignada"){

                $("#verEstadoAsignacionCorRecibidaReAsigAdmin").html('<div><button class="btn btn-warning">'+respuesta["estado_asignacion_cor_recibida"]+'</button></div>');

            }else if(respuesta["estado_asignacion_cor_recibida"] == "Rechazada"){
                
                $("#verEstadoAsignacionCorRecibidaReAsigAdmin").html('<div><button class="btn btn-danger">'+respuesta["estado_asignacion_cor_recibida"]+'</button></div>');

            }else if(respuesta["estado_asignacion_cor_recibida"] == "Aceptada"){

                $("#verEstadoAsignacionCorRecibidaReAsigAdmin").html('<div><button class="btn btn-success">'+respuesta["estado_asignacion_cor_recibida"]+'</button></div>');

            }else if(respuesta["estado_asignacion_cor_recibida"] == "Re-Asignada-Rechaza"){

                $("#verEstadoAsignacionCorRecibidaReAsigAdmin").html('<div><button class="btn btn-danger">'+respuesta["estado_asignacion_cor_recibida"]+'</button></div>');

            }else if(respuesta["estado_asignacion_cor_recibida"] == "Re-Asignada"){

                $("#verEstadoAsignacionCorRecibidaReAsigAdmin").html('<div><button class="btn btn-warning">'+respuesta["estado_asignacion_cor_recibida"]+'</button></div>');

            }

            if(respuesta["observaciones_asignacion_rechaza"] != null){

                $("#verObservacionesRechazamientoAdmin").html('<label>Observaciones de Rechazamiento de Correspondencia Recibida:</label><div>'+respuesta["observaciones_asignacion_rechaza"]+'</div>')

            }else{

                $("#verObservacionesRechazamientoAdmin").html('');
             
            }

            if(respuesta["codigo_concecutivo_generado"] != null){

                $("#verObservacionesGestionRadicadoRespuestaAdmin").html('<hr><hr><center><h4><b>Detalle Gestion</b></h4></center>'+
                '<label>Concecutivo Generado: </label> ' + respuesta["codigo_concecutivo_generado"]+
                '<br><label>Observaciones Gestion Radicado/Respuesta:</label><br>'+respuesta["observaciones_gestion_cor_recibida"]+
                '<br><label>Fecha Realización Gestión:</label> ' + respuesta["fecha_gestion_cor_recibida"]);

            }else{

                $("#verObservacionesGestionRadicadoRespuestaAdmin").html('');
             
            }

            if(respuesta["id_cor_enviada"] != null){

                var datosCorrespondenciaEnviada = new FormData();
                datosCorrespondenciaEnviada.append("idCorrespondenciaEnviada", respuesta["id_cor_enviada"]);

                $.ajax({

                    url:"ajax/correspondencia/correspondencia-cor.ajax.php",
                    method: "POST",
                    data: datosCorrespondenciaEnviada,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta){

                        $("#verRadicadoRespuestaReAsigAdmin").html('<div class="panel box box-success"><div class="box-header with-border"><h4 class="box-title"><a data-toggle="collapse" style="color: #00a65a;" data-parent="#accordion" href="#collapseOne">Respuesta a Correspondencia Enviada</a></h4></div><div id="collapseOne" class="panel-collapse collapse in"><div class="box-body">'+

                        '<div><label>Asunto:</label> ' + respuesta["asunto"]+'</div>'+
                        '<div><label>Codigo:</label> ' + respuesta["codigo"]+'</div>'+
                        '<div><label>Radicado:</label> ' + respuesta["radicado"]+'</div>'+
                        '<div><label>Documento Radicado Enviado:</label> ' + '<a target="_blank" href="'+respuesta["archivo_adj_recibida"]+'"><i class="fa fa-file-pdf-o"></i> Documento Radicado Enviado</a></div>' +
                        '<div><label>Fecha Radicacion:</label> ' + respuesta["fecha_carga_respuesta"]+'</div>'+
                        
                        '</div></div></div>');

                    }

                })

            }else{

                $("#verRadicadoRespuestaReAsigAdmin").html('');

            }


            var datosProyecto = new FormData();
            datosProyecto.append("idProyecto", respuesta["id_proyecto"]);

            $.ajax({

                url:"ajax/correspondencia/proyecto-cor.ajax.php",
                method: "POST",
                data: datosProyecto,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#verProyectoAreaCorRecibidaReAsigAdmin").html('<div>'+respuesta["nombre_proyecto"]+'</div>');

                }


            })

            var datosResponsable = new FormData();
            datosResponsable.append("idUsuario", respuesta["id_responsable"]);

            $.ajax({

                url:"ajax/usuarios.ajax.php",
                method: "POST",
                data: datosResponsable,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#verResponsableCorRecibidaReAsigAdmin").html('<div>'+respuesta["nombres"] + " " + respuesta["apellidos"]+'</div>')

                }

            })

            if(respuesta["id_usuario_re_asignacion_cor_recibida"] != null){
                
                var datosReAsign = new FormData();
                datosReAsign.append("idUsuario", respuesta["id_usuario_re_asignacion_cor_recibida"]);

                $.ajax({

                    url:"ajax/usuarios.ajax.php",
                    method: "POST",
                    data: datosReAsign,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta){

                        $("#contenedorInformacionUsuarioReAsignacionAdmin").html('<hr><hr><center><h4><b>Motivo Re-Asignacion Correspondencia Entrante</b></h4></center>'+
                        '<label>Usuario Re-Asignacion:</label> ' +respuesta["nombres"] + " " + respuesta["apellidos"]);

                    }

                })

                $("#contenedorInformacionReAsignacionAdmin").html('<label>Motivo Re-Asignacion Correspondencia Entrante:</label><br>' + respuesta["motivo_re_asignacion_cor_recibida"]);

            }else{

                $("#contenedorInformacionUsuarioReAsignacionAdmin").html('');
                $("#contenedorInformacionReAsignacionAdmin").html('');

            }

            if(respuesta["observaciones_asignacion_rechaza"] != null){

                $("#tituloRechazamiento").html('<hr><hr><center><h4><b>Motivo Rechaza Correspondencia Entrante</b></h4></center>');

                if(respuesta["id_usuario_re_asignacion_cor_recibida"] != null){

                    var datosUsuarioRechaza = new FormData();
                    datosUsuarioRechaza.append("idUsuario", respuesta["id_usuario_re_asignacion_cor_recibida"]);

                    $.ajax({

                        url:"ajax/usuarios.ajax.php",
                        method: "POST",
                        data: datosUsuarioRechaza,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function(respuesta){

                            $("#verUsuarioRechazamientoAdmin").html('<label>Nombre Usuario Rechaza:</label> '+respuesta["nombres"] + " " + respuesta["apellidos"]);

                        }

                    })

                }else{

                    $("#verObservacionesRechazamientoAdmin").html('');

                }

                $("#verObservacionesRechazamientoAdmin").html('<label>Observaciones de Rechazamiento de Correspondencia Recibida:</label><div>'+respuesta["observaciones_asignacion_rechaza"]+'</div>')

            }else{

                $("#verObservacionesRechazamientoAdmin").html('');
                $("#verUsuarioRechazamientoAdmin").html('');
                $("#tituloRechazamiento").html('');
             
            }

		}

	});

})


/*==================================
GESTION CORRESPONDENCIA ENTRANTE FACTURAS/RECIBOS
==================================*/
$(document).on("click", ".btnGestionarRadicadoRespuesta", function(){

	var idCorrespondenciaRecibida = $(this).attr("idCorrespondenciaRecibida");

	var datos = new FormData();
	datos.append("idCorrespondenciaRecibida", idCorrespondenciaRecibida);

	$.ajax({

		url:"ajax/correspondencia/correspondencia-cor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

            $("#gesAsuntoCorRecibida").html('<div>'+respuesta["asunto"]+'</div>');
            $("#gesObservacionesCorRecibida").html('<div>'+respuesta["observaciones_cor_recibida"]+'</div>');
            $("#gesDocumentoAdjuntoCorRecibida").html('<a target="_blank" href="'+respuesta["archivo_adj_recibido"]+'">Documento Adjunto</a>');
            $("#gesTipoCorrespondencia").html('<div>'+respuesta["tipo_cor_recibida"]+'</div>');
            $("#idCorrespondenRecibidaGestion").val(respuesta["id_cor_recibida"]);
            
            if(respuesta["estado_asignacion_cor_recibida"] == "Asignada"){

                $("#gesEstadoAsignacionCorRecibida").html('<div><a class="btn btn-warning">'+respuesta["estado_asignacion_cor_recibida"]+'</a></div>');

            }else if(respuesta["estado_asignacion_cor_recibida"] == "Rechazada"){
                
                $("#gesEstadoAsignacionCorRecibida").html('<div><a class="btn btn-danger">'+respuesta["estado_asignacion_cor_recibida"]+'</a></div>');

            }else if(respuesta["estado_asignacion_cor_recibida"] == "Aceptada"){

                $("#gesEstadoAsignacionCorRecibida").html('<div><a class="btn btn-success">'+respuesta["estado_asignacion_cor_recibida"]+'</a></div>');

            }else if(respuesta["estado_asignacion_cor_recibida"] == "Re-Asignada"){

                $("#gesEstadoAsignacionCorRecibida").html('<div><a class="btn btn-warning">'+respuesta["estado_asignacion_cor_recibida"]+'</a></div>');

            }else if(respuesta["estado_asignacion_cor_recibida"] == "Re-Asignada-Rechaza"){

                $("#gesEstadoAsignacionCorRecibida").html('<div><a class="btn btn-danger">'+respuesta["estado_asignacion_cor_recibida"]+'</a></div>');

            }

            if(respuesta["id_cor_enviada"] != null){

                var datosCorrespondenciaEnviada = new FormData();
                datosCorrespondenciaEnviada.append("idCorrespondenciaEnviada", respuesta["id_cor_enviada"]);

                $.ajax({

                    url:"ajax/correspondencia/correspondencia-cor.ajax.php",
                    method: "POST",
                    data: datosCorrespondenciaEnviada,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta){

                        $("#gesRadicadoRespuesta").html('<div class="panel box box-success"><div class="box-header with-border"><h4 class="box-title"><a data-toggle="collapse" style="color: #00a65a" data-parent="#accordion" href="#collapseOne">Respuesta a Correspondencia Enviada</a></h4></div><div id="collapseOne" class="panel-collapse collapse in"><div class="box-body">'+

                        '<div><label>Asunto:</label> ' + respuesta["asunto"]+'</div>'+
                        '<div><label>Codigo:</label> ' + respuesta["codigo"]+'</div>'+
                        '<div><label>Radicado:</label> ' + respuesta["radicado"]+'</div>'+
                        '<div><label>Documento Radicado Enviado:</label> ' + '<a target="_blank" href="'+respuesta["archivo_adj_recibida"]+'"><i class="fa fa-file-pdf-o"></i> Documento Radicado Enviado</a></div>' +
                        '<div><label>Fecha Radicacion:</label> ' + respuesta["fecha_carga_respuesta"]+'</div>'+
                        
                        '</div></div></div>');

                    }

                })

            }else{

                $("#gesRadicadoRespuesta").html('');

            }


            var datosProyecto = new FormData();
            datosProyecto.append("idProyecto", respuesta["id_proyecto"]);

            $.ajax({

                url:"ajax/correspondencia/proyecto-cor.ajax.php",
                method: "POST",
                data: datosProyecto,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#gesProyectoAreaCorRecibida").html('<div>'+respuesta["nombre_proyecto"]+'</div>');

                }


            })

            var datosResponsable = new FormData();
            datosResponsable.append("idUsuario", respuesta["id_responsable"]);

            $.ajax({

                url:"ajax/usuarios.ajax.php",
                method: "POST",
                data: datosResponsable,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#gesResponsableCorRecibida").html('<div>'+respuesta["nombres"] + " " + respuesta["apellidos"]+'</div>')

                }

            })

            if(respuesta["id_usuario_re_asignacion_cor_recibida"] != null){
                
                var datosReAsign = new FormData();
                datosReAsign.append("idUsuario", respuesta["id_usuario_re_asignacion_cor_recibida"]);

                $.ajax({

                    url:"ajax/usuarios.ajax.php",
                    method: "POST",
                    data: datosReAsign,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta){

                        $("#contenedorInformacionUsuarioReAsignacion").html('<hr><hr><center><h4><b>Motivo Re-Asignacion Correspondencia Entrante</b></h4></center>'+
                        '<label>Usuario Re-Asignacion:</label> ' +respuesta["nombres"] + " " + respuesta["apellidos"]);

                    }

                })

                $("#contenedorInformacionReAsignacion").html('<label>Motivo Re-Asignacion Correspondencia Entrante:</label><br>' + respuesta["motivo_re_asignacion_cor_recibida"]);

            }else{

                $("#contenedorInformacionUsuarioReAsignacion").html('');
                $("#contenedorInformacionReAsignacion").html('');

            }

		}

	});

})

/*===========================
MOSTRAR RESPONSABLE DEL PROYECTO
============================*/
$("#nuevoProyectoCorRecReAsig").change(function(){

    var idProyecto = document.getElementById('nuevoProyectoCorRecReAsig').value;

    var datos = new FormData();
    datos.append("idProyecto", idProyecto);

    $.ajax({

        url: "ajax/correspondencia/proyecto-cor.ajax.php",
        method: "POST",
        data: datos,
        cache:false,
        contentType: false,
        processData:false,
        dataType: "json",
        success: function(respuesta){

            $("#idNuevoResponsableProyecto").val(respuesta["id_responsable"]);
            $("#idUsuarioCorrespondenciaCorAsig").val(respuesta["id_responsable"]);

            var datosUsuario = new FormData();
            datosUsuario.append("idUsuario", respuesta["id_responsable"]);

            $.ajax({

                url: "ajax/usuarios.ajax.php",
                method: "POST",
                data: datosUsuario,
                cache:false,
                contentType: false,
                processData:false,
                dataType: "json",
                success: function(respuestaUsuario){

                    $("#contenedorResponsable").html('<div class="form-group"><label>Responsable Proyecto/Area:</label><input type="text" name="nuevoUsuarioReAsignacion" class="form-control" value="'+ respuestaUsuario["nombres"] + " " + respuestaUsuario["apellidos"] +'" readonly></div>');
                    
                }

            })

        }

    })

})

/*===========================
VER CORRESPONDENCIA RECIBIDA
============================*/
$(document).on("click", ".btnReAsignarCorrespondenciaRecibidaProyecto", function(){

	var idCorrespondenciaRecibida = $(this).attr("idCorrespondenciaRecibida");

	var datos = new FormData();
	datos.append("idCorrespondenciaRecibida", idCorrespondenciaRecibida);

	$.ajax({

		url:"ajax/correspondencia/correspondencia-cor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

            $("#idCorrespondenciaRecibidaCorAsigPro").val(respuesta["id_cor_recibida"]);
            $("#reAsigAsuntoCorRecibidaPro").html('<div>'+respuesta["asunto"]+'</div>');
            $("#reAsigObservacionesCorRecibidaPro").html('<div>'+respuesta["observaciones_cor_recibida"]+'</div>');
            $("#reAsigDocumentoAdjuntoCorRecibidaPro").html('<a target="_blank" href="'+respuesta["archivo_adj_recibido"]+'">Documento Adjunto</a>');
            $("#reAsigTipoCorrespondenciaPro").html('<div>'+respuesta["tipo_cor_recibida"]+'</div>');

            if(respuesta["estado_asignacion_cor_recibida"] == "Asignada"){

                $("#reAsigEstadoAsignacionCorRecibidaPro").html('<div><a class="btn btn-warning">'+respuesta["estado_asignacion_cor_recibida"]+'</a></div>');

            }else if(respuesta["estado_asignacion_cor_recibida"] == "Rechazada"){
                
                $("#reAsigEstadoAsignacionCorRecibidaPro").html('<div><a class="btn btn-danger">'+respuesta["estado_asignacion_cor_recibida"]+'</a></div>');

            }else if(respuesta["estado_asignacion_cor_recibida"] == "Aceptada"){

                $("#reAsigEstadoAsignacionCorRecibidaPro").html('<div><a class="btn btn-success">'+respuesta["estado_asignacion_cor_recibida"]+'</a></div>');

            }else if(respuesta["estado_asignacion_cor_recibida"] == "Re-Asignada-Rechaza"){

                $("#reAsigEstadoAsignacionCorRecibidaPro").html('<div><a class="btn btn-danger">'+respuesta["estado_asignacion_cor_recibida"]+'</a></div>');

            }

            if(respuesta["observaciones_asignacion_rechaza"] != null){

                $("#reAsigObservacionesRechazamientoPro").html('<label>Observaciones de Rechazamiento de Correspondencia Recibida:</label><div>'+respuesta["observaciones_asignacion_rechaza"]+'</div>')

            }else{

                $("#reAsigObservacionesRechazamientoPro").html('');
             
            }

            if(respuesta["id_cor_enviada"] != null){

                var datosCorrespondenciaEnviada = new FormData();
                datosCorrespondenciaEnviada.append("idCorrespondenciaEnviada", respuesta["id_cor_enviada"]);

                $.ajax({

                    url:"ajax/correspondencia/correspondencia-cor.ajax.php",
                    method: "POST",
                    data: datosCorrespondenciaEnviada,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta){

                        $("#reAsigRadicadoRespuestaPro").html('<div class="panel box box-success"><div class="box-header with-border"><h4 class="box-title"><a data-toggle="collapse" style="color: #00a65a;" data-parent="#accordion" href="#collapsePro">Respuesta a Correspondencia Enviada</a></h4></div><div id="collapsePro" class="panel-collapse collapse in"><div class="box-body">'+

                        '<div><label>Asunto:</label> ' + respuesta["asunto"]+'</div>'+
                        '<div><label>Codigo:</label> ' + respuesta["codigo"]+'</div>'+
                        '<div><label>Radicado:</label> ' + respuesta["radicado"]+'</div>'+
                        '<div><label>Documento Radicado Enviado:</label> ' + '<a target="_blank" href="'+respuesta["archivo_adj_recibida"]+'"><i class="fa fa-file-pdf-o"></i> Documento Radicado Enviado</a></div>' +
                        '<div><label>Fecha Radicacion:</label> ' + respuesta["fecha_carga_respuesta"]+'</div>'+
                        
                        '</div></div></div>');

                    }

                })

            }else{

                $("#reAsigRadicadoRespuestaPro").html('');

            }


            var datosProyecto = new FormData();
            datosProyecto.append("idProyecto", respuesta["id_proyecto"]);

            $.ajax({

                url:"ajax/correspondencia/proyecto-cor.ajax.php",
                method: "POST",
                data: datosProyecto,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#reAsigProyectoAreaCorRecibidaPro").html('<div>'+respuesta["nombre_proyecto"]+'</div>');

                }


            })

            var datosResponsable = new FormData();
            datosResponsable.append("idUsuario", respuesta["id_responsable"]);

            $.ajax({

                url:"ajax/usuarios.ajax.php",
                method: "POST",
                data: datosResponsable,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#reAsigResponsableCorRecibidaPro").html('<div>'+respuesta["nombres"] + " " + respuesta["apellidos"]+'</div>')

                }

            })

		}

	});

})

/*===========================
RECHAZAR ASIGNACION CORRESPONDENCIA RECIBIDA RE-ASIGNADA
============================*/
$(document).on("click", ".btnRechazarAsignacionCorrespondenciaReAsign", function(){

	var idCorrespondenciaRecibida = $(this).attr("idCorrespondenciaRecibida");

	var datos = new FormData();
	datos.append("idCorrespondenciaRecibida", idCorrespondenciaRecibida);

	$.ajax({

		url:"ajax/correspondencia/correspondencia-cor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

            $("#rechazarIdCorRecibidaReAsign").val(respuesta["id_cor_recibida"]);
            $("#recharzarAsuntoCorRecibidaReAsign").html('<div>'+respuesta["asunto"]+'</div>');
            $("#rechazarObservacionesCorRecibidaReAsign").html(respuesta["observaciones_cor_recibida"]);
            $("#rechazarDocumentoAdjuntoCorRecibidaReAsign").html('<a target="_blank" href="'+respuesta["archivo_adj_recibido"]+'">Documento Adjunto</a>');
            $("#rechazarTipoCorrespondenciaReAsign").html('<div>'+respuesta["tipo_cor_recibida"]+'</div>');

            var datosProyecto = new FormData();
            datosProyecto.append("idProyecto", respuesta["id_proyecto"]);

            $.ajax({

                url:"ajax/correspondencia/proyecto-cor.ajax.php",
                method: "POST",
                data: datosProyecto,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#rechazarProyectoAreaCorRecibidaReAsign").html('<div>'+respuesta["nombre_proyecto"]+'</div>');

                }


            })

            var datosResponsable = new FormData();
            datosResponsable.append("idUsuario", respuesta["id_responsable"]);

            $.ajax({

                url:"ajax/usuarios.ajax.php",
                method: "POST",
                data: datosResponsable,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#rechazarResponsableCorRecibidaReAsign").html('<div>'+respuesta["nombres"] + " " + respuesta["apellidos"]+'</div>');

                }

            })

		}

	});

})


/*===========================
ACEPTAR ASIGNACION CORRESPONDENCIA RECIBIDA RE-ASIGNACION
============================*/
$(document).on("click", ".btnAceptarAsignacionCorrespondenciaReAsign", function(){

    var idCorrespondenciaRecibida = $(this).attr("idCorrespondenciaRecibida");
    var idUsuarioAcepta = $(this).attr("idUsuarioAcepta");

    var datos = new FormData();
    datos.append("idCorrespondenciaRecibidaAceptaReAsign", idCorrespondenciaRecibida);
    datos.append("idUsuarioAcepta", idUsuarioAcepta);

    swal({
        title: '!¿Desea Aceptar la Correspodencia Recibida Re-Asignada?!',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, Aceptar Correspondencia Re-Asignada!'
    }).then(function(result){
    
        if(result.value){

            $.ajax({

                url: "ajax/correspondencia/correspondencia-cor.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){
            
                    swal({
                        title: "!Acepto la Correspondencia Asignada correctamente, fue movida a su bandeja de Correspondencia Recibida!",
                        type: "success",
                        confirmButtonText: "¡Cerrar!"

                    }).then(function(result) {
                        
                            if (result.value) {
        
                                window.location = "correspondencia-recibida-cor";
        
                            }
        
                    });

                
                }

            })
    
        }
    
    })

})


/*===========================
VER CORRESPONDENCIA RECIBIDA RE-ASIGNADA
============================*/
$(document).on("click", ".btnVerAsignacionCorrespondenciaRecibidaReAsign", function(){

	var idCorrespondenciaRecibida = $(this).attr("idCorrespondenciaRecibida");

	var datos = new FormData();
	datos.append("idCorrespondenciaRecibida", idCorrespondenciaRecibida);

	$.ajax({

		url:"ajax/correspondencia/correspondencia-cor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

            $("#verAsuntoCorRecibidaReAsig").html('<div>'+respuesta["asunto"]+'</div>');
            $("#verObservacionesCorRecibidaReAsig").html('<div>'+respuesta["observaciones_cor_recibida"]+'</div>');
            $("#verDocumentoAdjuntoCorRecibidaReAsig").html('<a target="_blank" href="'+respuesta["archivo_adj_recibido"]+'">Documento Adjunto</a>');
            $("#verTipoCorrespondenciaReAsig").html('<div>'+respuesta["tipo_cor_recibida"]+'</div>');
            
            if(respuesta["estado_asignacion_cor_recibida"] == "Asignada"){

                $("#verEstadoAsignacionCorRecibidaReAsig").html('<div><a class="btn btn-warning">'+respuesta["estado_asignacion_cor_recibida"]+'</a></div>');

            }else if(respuesta["estado_asignacion_cor_recibida"] == "Rechazada"){
                
                $("#verEstadoAsignacionCorRecibidaReAsig").html('<div><a class="btn btn-danger">'+respuesta["estado_asignacion_cor_recibida"]+'</a></div>');

            }else if(respuesta["estado_asignacion_cor_recibida"] == "Aceptada"){

                $("#verEstadoAsignacionCorRecibidaReAsig").html('<div><a class="btn btn-success">'+respuesta["estado_asignacion_cor_recibida"]+'</a></div>');

            }else if(respuesta["estado_asignacion_cor_recibida"] == "Re-Asignada"){

                $("#verEstadoAsignacionCorRecibidaReAsig").html('<div><a class="btn btn-warning">'+respuesta["estado_asignacion_cor_recibida"]+'</a></div>');

            }

            if(respuesta["observaciones_asignacion_rechaza"] != null){

                var datosUsuarioRechaza = new FormData();
                datosUsuarioRechaza.append("idUsuario", respuesta["id_usuario_re_asignacion_cor_recibida"]);

                $.ajax({

                    url:"ajax/usuarios.ajax.php",
                    method: "POST",
                    data: datosUsuarioRechaza,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta){

                        $("#verUsuarioRechazamiento").html('<hr><hr><center><h4><b>Motivo Rechaza Correspondencia Entrante</b></h4></center><label>Nombre Usuario Rechaza:</label> '+respuesta["nombres"] + " " + respuesta["apellidos"]);

                    }

                })

                $("#verObservacionesRechazamientoReAsig").html('<label>Observaciones de Rechazamiento de Correspondencia Recibida:</label><div>'+respuesta["observaciones_asignacion_rechaza"]+'</div>')

            }else{

                $("#verObservacionesRechazamientoReAsig").html('');
                $("#verUsuarioRechazamiento").html('');
             
            }

            if(respuesta["id_cor_enviada"] != null){

                var datosCorrespondenciaEnviada = new FormData();
                datosCorrespondenciaEnviada.append("idCorrespondenciaEnviada", respuesta["id_cor_enviada"]);

                $.ajax({

                    url:"ajax/correspondencia/correspondencia-cor.ajax.php",
                    method: "POST",
                    data: datosCorrespondenciaEnviada,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta){

                        $("#verRadicadoRespuestaReAsig").html('<div class="panel box box-success"><div class="box-header with-border"><h4 class="box-title"><a data-toggle="collapse" style="color: #00a65a;" data-parent="#accordion" href="#collapseOne">Respuesta a Correspondencia Enviada</a></h4></div><div id="collapseOne" class="panel-collapse collapse in"><div class="box-body">'+

                        '<div><label>Asunto:</label> ' + respuesta["asunto"]+'</div>'+
                        '<div><label>Codigo:</label> ' + respuesta["codigo"]+'</div>'+
                        '<div><label>Radicado:</label> ' + respuesta["radicado"]+'</div>'+
                        '<div><label>Documento Radicado Enviado:</label> ' + '<a target="_blank" href="'+respuesta["archivo_adj_recibida"]+'"><i class="fa fa-file-pdf-o"></i> Documento Radicado Enviado</a></div>' +
                        '<div><label>Fecha Radicacion:</label> ' + respuesta["fecha_carga_respuesta"]+'</div>'+
                        
                        '</div></div></div>');

                    }

                })

            }else{

                $("#verRadicadoRespuestaReAsig").html('');

            }


            var datosProyecto = new FormData();
            datosProyecto.append("idProyecto", respuesta["id_proyecto"]);

            $.ajax({

                url:"ajax/correspondencia/proyecto-cor.ajax.php",
                method: "POST",
                data: datosProyecto,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#verProyectoAreaCorRecibidaReAsig").html('<div>'+respuesta["nombre_proyecto"]+'</div>');

                }


            })

            var datosResponsable = new FormData();
            datosResponsable.append("idUsuario", respuesta["id_responsable"]);

            $.ajax({

                url:"ajax/usuarios.ajax.php",
                method: "POST",
                data: datosResponsable,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#verResponsableCorRecibidaReAsig").html('<div>'+respuesta["nombres"] + " " + respuesta["apellidos"]+'</div>')

                }

            })

            if(respuesta["id_usuario_re_asignacion_cor_recibida"] != null){
                
                var datosReAsign = new FormData();
                datosReAsign.append("idUsuario", respuesta["id_usuario_re_asignacion_cor_recibida"]);

                $.ajax({

                    url:"ajax/usuarios.ajax.php",
                    method: "POST",
                    data: datosReAsign,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta){

                        $("#contenedorInformacionUsuarioReAsignacion").html('<hr><hr><center><h4><b>Motivo Re-Asignacion Correspondencia Entrante</b></h4></center>'+
                        '<label>Usuario Re-Asignacion:</label> ' +respuesta["nombres"] + " " + respuesta["apellidos"]);

                    }

                })

                $("#contenedorInformacionReAsignacion").html('<label>Motivo Re-Asignacion Correspondencia Entrante:</label><br>' + respuesta["motivo_re_asignacion_cor_recibida"]);

            }else{

                $("#contenedorInformacionUsuarioReAsignacion").html('');
                $("#contenedorInformacionReAsignacion").html('');

            }

		}

	});

})

/*===========================
VER CORRESPONDENCIA RECIBIDA
============================*/
$(document).on("click", ".btnReAsignarCorrespondenciaRecibida", function(){

	var idCorrespondenciaRecibida = $(this).attr("idCorrespondenciaRecibida");

	var datos = new FormData();
	datos.append("idCorrespondenciaRecibida", idCorrespondenciaRecibida);

	$.ajax({

		url:"ajax/correspondencia/correspondencia-cor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

            $("#idCorrespondenciaRecibidaCorAsig").val(respuesta["id_cor_recibida"]);
            $("#reAsigAsuntoCorRecibida").html('<div>'+respuesta["asunto"]+'</div>');
            $("#reAsigObservacionesCorRecibida").html('<div>'+respuesta["observaciones_cor_recibida"]+'</div>');
            $("#reAsigDocumentoAdjuntoCorRecibida").html('<a target="_blank" href="'+respuesta["archivo_adj_recibido"]+'">Documento Adjunto</a>');
            $("#reAsigTipoCorrespondencia").html('<div>'+respuesta["tipo_cor_recibida"]+'</div>');
            
            if(respuesta["estado_asignacion_cor_recibida"] == "Asignada"){

                $("#reAsigEstadoAsignacionCorRecibida").html('<div><a class="btn btn-warning">'+respuesta["estado_asignacion_cor_recibida"]+'</a></div>');

            }else if(respuesta["estado_asignacion_cor_recibida"] == "Rechazada"){
                
                $("#reAsigEstadoAsignacionCorRecibida").html('<div><a class="btn btn-danger">'+respuesta["estado_asignacion_cor_recibida"]+'</a></div>');

            }else if(respuesta["estado_asignacion_cor_recibida"] == "Aceptada"){

                $("#reAsigEstadoAsignacionCorRecibida").html('<div><a class="btn btn-success">'+respuesta["estado_asignacion_cor_recibida"]+'</a></div>');

            }else if(respuesta["estado_asignacion_cor_recibida"] == "Re-Asignada-Rechaza"){

                $("#reAsigEstadoAsignacionCorRecibida").html('<div><a class="btn btn-danger">'+respuesta["estado_asignacion_cor_recibida"]+'</a></div>');

            }

            if(respuesta["observaciones_asignacion_rechaza"] != null){

                $("#reAsigObservacionesRechazamiento").html('<label>Observaciones de Rechazamiento de Correspondencia Recibida:</label><div>'+respuesta["observaciones_asignacion_rechaza"]+'</div>')

            }else{

                $("#reAsigObservacionesRechazamiento").html('');
             
            }

            if(respuesta["id_cor_enviada"] != null){

                var datosCorrespondenciaEnviada = new FormData();
                datosCorrespondenciaEnviada.append("idCorrespondenciaEnviada", respuesta["id_cor_enviada"]);

                $.ajax({

                    url:"ajax/correspondencia/correspondencia-cor.ajax.php",
                    method: "POST",
                    data: datosCorrespondenciaEnviada,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta){

                        $("#reAsigRadicadoRespuesta").html('<div class="panel box box-success"><div class="box-header with-border"><h4 class="box-title"><a data-toggle="collapse" style="color: #00a65a;" data-parent="#accordion" href="#collapseOne">Respuesta a Correspondencia Enviada</a></h4></div><div id="collapseOne" class="panel-collapse collapse in"><div class="box-body">'+

                        '<div><label>Asunto:</label> ' + respuesta["asunto"]+'</div>'+
                        '<div><label>Codigo:</label> ' + respuesta["codigo"]+'</div>'+
                        '<div><label>Radicado:</label> ' + respuesta["radicado"]+'</div>'+
                        '<div><label>Documento Radicado Enviado:</label> ' + '<a target="_blank" href="'+respuesta["archivo_adj_recibida"]+'"><i class="fa fa-file-pdf-o"></i> Documento Radicado Enviado</a></div>' +
                        '<div><label>Fecha Radicacion:</label> ' + respuesta["fecha_carga_respuesta"]+'</div>'+
                        
                        '</div></div></div>');

                    }

                })

            }else{

                $("#reAsigRadicadoRespuesta").html('');

            }


            var datosProyecto = new FormData();
            datosProyecto.append("idProyecto", respuesta["id_proyecto"]);

            $.ajax({

                url:"ajax/correspondencia/proyecto-cor.ajax.php",
                method: "POST",
                data: datosProyecto,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#reAsigProyectoAreaCorRecibida").html('<div>'+respuesta["nombre_proyecto"]+'</div>');

                }


            })

            var datosResponsable = new FormData();
            datosResponsable.append("idUsuario", respuesta["id_responsable"]);

            $.ajax({

                url:"ajax/usuarios.ajax.php",
                method: "POST",
                data: datosResponsable,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#reAsigResponsableCorRecibida").html('<div>'+respuesta["nombres"] + " " + respuesta["apellidos"]+'</div>')

                }

            })

		}

	});

})

/*===========================
MOSTRAR RESPONSABLE DEL PROYECTO CUANDO SELECCIONA EL RADICADO
============================*/
$("#nuevoRadicadoCorRecRad").change(function(){

    var idCorrespondenciaEnviada = document.getElementById('nuevoRadicadoCorRecRad').value;
    
    var datos = new FormData();
    datos.append("idCorrespondenciaEnviada", idCorrespondenciaEnviada);

    $.ajax({

        url:"ajax/correspondencia/correspondencia-cor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

            $("#idProyectoCorRadProyecto").val(respuesta["id_proyecto"]);

            var datosProyecto = new FormData();
            datosProyecto.append('idProyecto', respuesta["id_proyecto"]);

            $.ajax({

                url:"ajax/correspondencia/proyecto-cor.ajax.php",
                method: "POST",
                data: datosProyecto,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#idCorRadResponsable").val(respuesta["id_responsable"]);

                    if(respuesta != false){

                        $("#contenedorCorRecRadProyecto").html('<label>Proyecto: </label> '+respuesta["nombre_proyecto"]);

                    }else{

                        $("#contenedorCorRecRadProyecto").html('');

                    }

                    var datosUsuario = new FormData();
                    datosUsuario.append('idUsuario', respuesta["id_responsable"]);

                    $.ajax({

                        url:"ajax/usuarios.ajax.php",
                        method: "POST",
                        data: datosUsuario,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function(respuesta){

                            if(respuesta != false){

                                $("#contenedorCorRecRadResponsable").html('<label>Responsable:</label> ' + respuesta["nombres"] + " " + respuesta["apellidos"]);

                            }else{

                                $("#contenedorCorRecRadResponsable").html('');

                            }

                        }

                    })

                }

            })

        }

    })

})

/*===========================
RECHAZAR ASIGNACION CORRESPONDENCIA RECIBIDA
============================*/
$(document).on("click", ".btnRechazarAsignacionCorrespondencia", function(){

	var idCorrespondenciaRecibida = $(this).attr("idCorrespondenciaRecibida");

	var datos = new FormData();
	datos.append("idCorrespondenciaRecibida", idCorrespondenciaRecibida);

	$.ajax({

		url:"ajax/correspondencia/correspondencia-cor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

            $("#rechazarIdCorRecibida").val(respuesta["id_cor_recibida"]);
            $("#recharzarAsuntoCorRecibida").html('<div>'+respuesta["asunto"]+'</div>');
            $("#rechazarObservacionesCorRecibida").html(respuesta["observaciones_cor_recibida"]);
            $("#rechazarDocumentoAdjuntoCorRecibida").html('<a target="_blank" href="'+respuesta["archivo_adj_recibido"]+'">Documento Adjunto</a>');
            $("#rechazarTipoCorrespondencia").html('<div>'+respuesta["tipo_cor_recibida"]+'</div>');

            var datosProyecto = new FormData();
            datosProyecto.append("idProyecto", respuesta["id_proyecto"]);

            $.ajax({

                url:"ajax/correspondencia/proyecto-cor.ajax.php",
                method: "POST",
                data: datosProyecto,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#rechazarProyectoAreaCorRecibida").html('<div>'+respuesta["nombre_proyecto"]+'</div>');

                }


            })

            var datosResponsable = new FormData();
            datosResponsable.append("idUsuario", respuesta["id_responsable"]);

            $.ajax({

                url:"ajax/usuarios.ajax.php",
                method: "POST",
                data: datosResponsable,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#rechazarResponsableCorRecibida").html('<div>'+respuesta["nombres"] + " " + respuesta["apellidos"]+'</div>');

                }

            })

		}

	});

})

/*===========================
ACEPTAR ASIGNACION CORRESPONDENCIA RECIBIDA
============================*/
$(document).on("click", ".btnAceptarAsignacionCorrespondencia", function(){

    var idCorrespondenciaRecibida = $(this).attr("idCorrespondenciaRecibida");

    var datos = new FormData();
    datos.append("idCorrespondenciaRecibidaAcepta", idCorrespondenciaRecibida);

    swal({
        title: '!¿Desea Aceptar la Correspodencia Recibida Asignada?!',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, Aceptar Correspondencia!'
    }).then(function(result){
    
        if(result.value){

            $.ajax({

                url: "ajax/correspondencia/correspondencia-cor.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){
            
                    swal({
                        title: "!Acepto la Correspondencia Asignada correctamente, fue movida a su bandeja de Correspondencia Recibida!",
                        type: "success",
                        confirmButtonText: "¡Cerrar!"

                    }).then(function(result) {
                        
                            if (result.value) {
        
                                window.location = "correspondencia-recibida-cor";
        
                            }
        
                    });

                
                }

            })
    
        }
    
    })

})


/*===========================
MOSTRAR RESPONSABLE DEL PROYECTO
============================*/
$("#editarProyectoCorRecNuevo").change(function(){

    var idProyecto = document.getElementById('editarProyectoCorRecNuevo').value;

    var datos = new FormData();
    datos.append("idProyecto", idProyecto);

    $.ajax({

        url: "ajax/correspondencia/proyecto-cor.ajax.php",
        method: "POST",
        data: datos,
        cache:false,
        contentType: false,
        processData:false,
        dataType: "json",
        success: function(respuesta){

            $("#editarIdResponsableCorRec").val(respuesta["id_responsable"]);

            var datosUsuario = new FormData();
            datosUsuario.append("idUsuario", respuesta["id_responsable"]);

            $.ajax({

                url: "ajax/usuarios.ajax.php",
                method: "POST",
                data: datosUsuario,
                cache:false,
                contentType: false,
                processData:false,
                dataType: "json",
                success: function(respuestaUsuario){

                    $("#editarResponsableCorRec").val(respuestaUsuario["nombres"] + " " + respuestaUsuario["apellidos"]);
                    
                }

            })

        }

    })

})

/*===========================
EDITAR CORRESPONDENCIA RECIBIDA
============================*/
$(document).on("click", ".btnEditarResponsableAsignacion", function(){

	var idCorrespondenciaRecibida = $(this).attr("idCorrespondenciaRecibida");

	var datos = new FormData();
	datos.append("idCorrespondenciaRecibida", idCorrespondenciaRecibida);

	$.ajax({

		url:"ajax/correspondencia/correspondencia-cor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

            $("#idEditarCorRec").val(respuesta["id_cor_recibida"]);
            $("#editarAsuntoCorRec").val(respuesta["asunto"]);
            $("#editarObservacionesCorRec").html(respuesta["observaciones_cor_recibida"]);
            $("#editarDocumentoAdjuntoCorRecibida").html('<a target="_blank" href="'+respuesta["archivo_adj_recibido"]+'">Documento Adjunto</a>');
            $("#editarTipoCorRec").val(respuesta["tipo_cor_recibida"]);
            $("#editarTipoCorRec").html(respuesta["tipo_cor_recibida"]);
            
            if(respuesta["observaciones_asignacion_rechaza"] != null){

                $("#editarObservacionRechazamiento").html('<label>Observaciones de Rechazamiento de Correspondencia Recibida:</label><div>'+respuesta["observaciones_asignacion_rechaza"]+'</div>')

            }else{

                $("#editarObservacionRechazamiento").html('')
             
            }
            
            if(respuesta["estado_asignacion_cor_recibida"] == "Asignada"){

                $("#editarEstadoAsignacionCorRecibida").html('<div><a class="btn btn-warning">'+respuesta["estado_asignacion_cor_recibida"]+'</a></div>');

            }else if(respuesta["estado_asignacion_cor_recibida"] == "Rechazada"){

                $("#editarEstadoAsignacionCorRecibida").html('<div><a class="btn btn-danger">'+respuesta["estado_asignacion_cor_recibida"]+'</a></div>');

            }


            var datosProyecto = new FormData();
            datosProyecto.append("idProyecto", respuesta["id_proyecto"]);

            $.ajax({

                url:"ajax/correspondencia/proyecto-cor.ajax.php",
                method: "POST",
                data: datosProyecto,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#editarProyectoCorRecAnterior").val(respuesta["nombre_proyecto"]);

                }


            })

            var datosResponsable = new FormData();
            datosResponsable.append("idUsuario", respuesta["id_responsable"]);

            $.ajax({

                url:"ajax/usuarios.ajax.php",
                method: "POST",
                data: datosResponsable,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#editarResponsableCorRec").val(respuesta["nombres"] + " " + respuesta["apellidos"]);

                }

            })

		}

	});

})


/*===========================
VER CORRESPONDENCIA RECIBIDA
============================*/
$(document).on("click", ".btnVerAsignacionCorrespondenciaRecibida", function(){

	var idCorrespondenciaRecibida = $(this).attr("idCorrespondenciaRecibida");

	var datos = new FormData();
	datos.append("idCorrespondenciaRecibida", idCorrespondenciaRecibida);

	$.ajax({

		url:"ajax/correspondencia/correspondencia-cor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

            $("#verAsuntoCorRecibida").html('<div>'+respuesta["asunto"]+'</div>');
            $("#verObservacionesCorRecibida").html('<div>'+respuesta["observaciones_cor_recibida"]+'</div>');
            $("#verDocumentoAdjuntoCorRecibida").html('<a target="_blank" href="'+respuesta["archivo_adj_recibido"]+'">Documento Adjunto</a>');
            $("#verTipoCorrespondencia").html('<div>'+respuesta["tipo_cor_recibida"]+'</div>');
            
            if(respuesta["estado_asignacion_cor_recibida"] == "Asignada"){

                $("#verEstadoAsignacionCorRecibida").html('<div><button class="btn btn-warning">'+respuesta["estado_asignacion_cor_recibida"]+'</button></div>');

            }else if(respuesta["estado_asignacion_cor_recibida"] == "Rechazada"){
                
                $("#verEstadoAsignacionCorRecibida").html('<div><button class="btn btn-danger">'+respuesta["estado_asignacion_cor_recibida"]+'</button></div>');

            }else if(respuesta["estado_asignacion_cor_recibida"] == "Aceptada"){

                $("#verEstadoAsignacionCorRecibida").html('<div><button class="btn btn-success">'+respuesta["estado_asignacion_cor_recibida"]+'</button></div>');

            }else if(respuesta["estado_asignacion_cor_recibida"] == "Re-Asignada-Rechaza"){

                $("#verEstadoAsignacionCorRecibida").html('<div><button class="btn btn-danger">'+respuesta["estado_asignacion_cor_recibida"]+'</button></div>');

            }

            if(respuesta["observaciones_asignacion_rechaza"] != null){

                var datosUsuarioRechaza = new FormData();
                datosUsuarioRechaza.append("idUsuario", respuesta["id_usuario_re_asignacion_cor_recibida"]);

                $.ajax({

                    url:"ajax/usuarios.ajax.php",
                    method: "POST",
                    data: datosUsuarioRechaza,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta){

                        $("#verUsuarioRechazamiento").html('<hr><hr><center><h4><b>Motivo Rechaza Correspondencia Entrante</b></h4></center><label>Nombre Usuario Rechaza:</label> '+respuesta["nombres"] + " " + respuesta["apellidos"]);

                    }

                })

                $("#verObservacionesRechazamiento").html('<label>Observaciones de Rechazamiento de Correspondencia Recibida:</label><div>'+respuesta["observaciones_asignacion_rechaza"]+'</div>')

            }else{

                $("#verObservacionesRechazamiento").html('');
                $("#verUsuarioRechazamiento").html('');
             
            }

            if(respuesta["codigo_concecutivo_generado"] != null){

                $("#verObservacionesGestionRadicadoRespuesta").html('<hr><hr><center><h4><b>Detalle Gestion</b></h4></center>'+
                '<label>Concecutivo Generado: </label> ' + respuesta["codigo_concecutivo_generado"]+
                '<br><label>Observaciones Gestion Radicado/Respuesta:</label><br>'+respuesta["observaciones_gestion_cor_recibida"]+
                '<br><label>Fecha Realización Gestión:</label> ' + respuesta["fecha_gestion_cor_recibida"]);

            }else{

                $("#verObservacionesGestionRadicadoRespuesta").html('');
             
            }

            if(respuesta["id_cor_enviada"] != null){

                var datosCorrespondenciaEnviada = new FormData();
                datosCorrespondenciaEnviada.append("idCorrespondenciaEnviada", respuesta["id_cor_enviada"]);

                $.ajax({

                    url:"ajax/correspondencia/correspondencia-cor.ajax.php",
                    method: "POST",
                    data: datosCorrespondenciaEnviada,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta){

                        $("#verRadicadoRespuesta").html('<div class="panel box box-success"><div class="box-header with-border"><h4 class="box-title"><a data-toggle="collapse" style="color: #00a65a;" data-parent="#accordion" href="#collapseVerAsig">Respuesta a Correspondencia Enviada</a></h4></div><div id="collapseVerAsig" class="panel-collapse collapse in"><div class="box-body">'+

                        '<div><label>Asunto:</label> ' + respuesta["asunto"]+'</div>'+
                        '<div><label>Codigo:</label> ' + respuesta["codigo"]+'</div>'+
                        '<div><label>Radicado:</label> ' + respuesta["radicado"]+'</div>'+
                        '<div><label>Documento Radicado Enviado:</label> ' + '<a target="_blank" href="'+respuesta["archivo_adj_recibida"]+'"><i class="fa fa-file-pdf-o"></i> Documento Radicado Enviado</a></div>' +
                        '<div><label>Fecha Radicacion:</label> ' + respuesta["fecha_carga_respuesta"]+'</div>'+
                        
                        '</div></div></div>');

                    }

                })

            }else{

                $("#verRadicadoRespuesta").html('');

            }


            var datosProyecto = new FormData();
            datosProyecto.append("idProyecto", respuesta["id_proyecto"]);

            $.ajax({

                url:"ajax/correspondencia/proyecto-cor.ajax.php",
                method: "POST",
                data: datosProyecto,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#verProyectoAreaCorRecibida").html('<div>'+respuesta["nombre_proyecto"]+'</div>');

                }


            })

            var datosResponsable = new FormData();
            datosResponsable.append("idUsuario", respuesta["id_responsable"]);

            $.ajax({

                url:"ajax/usuarios.ajax.php",
                method: "POST",
                data: datosResponsable,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#verResponsableCorRecibida").html('<div>'+respuesta["nombres"] + " " + respuesta["apellidos"]+'</div>')

                }

            })

		}

	});

})

/*===========================
MOSTRAR RESPONSABLE DEL PROYECTO
============================*/
$("#nuevoProyectoCorRec").change(function(){

    var idProyecto = document.getElementById('nuevoProyectoCorRec').value;

    var datos = new FormData();
    datos.append("idProyecto", idProyecto);

    $.ajax({

        url: "ajax/correspondencia/proyecto-cor.ajax.php",
        method: "POST",
        data: datos,
        cache:false,
        contentType: false,
        processData:false,
        dataType: "json",
        success: function(respuesta){

            $("#idNuevoResponsableProyecto").val(respuesta["id_responsable"]);

            var datosUsuario = new FormData();
            datosUsuario.append("idUsuario", respuesta["id_responsable"]);

            $.ajax({

                url: "ajax/usuarios.ajax.php",
                method: "POST",
                data: datosUsuario,
                cache:false,
                contentType: false,
                processData:false,
                dataType: "json",
                success: function(respuestaUsuario){

                    $("#contenedorResponsable").html('<div class="form-group"><label>Responsable Proyecto/Area:</label><input type="text" name="nuevoResponsableCorRec" class="form-control" value="'+ respuestaUsuario["nombres"] + " " + respuestaUsuario["apellidos"] +'" readonly></div>');
                    
                }

            })

        }

    })

})

/*===========================
MOSTRAR RESPONSABLE DEL PROYECTO
============================*/
$("#nuevoProyectoDocCorRec").change(function(){

    var idProyecto = document.getElementById('nuevoProyectoDocCorRec').value;

    var datos = new FormData();
    datos.append("idProyecto", idProyecto);

    $.ajax({

        url: "ajax/correspondencia/proyecto-cor.ajax.php",
        method: "POST",
        data: datos,
        cache:false,
        contentType: false,
        processData:false,
        dataType: "json",
        success: function(respuesta){

            $("#idNuevoResponsableProyectoDocCor").val(respuesta["id_responsable"]);

            var datosUsuario = new FormData();
            datosUsuario.append("idUsuario", respuesta["id_responsable"]);

            $.ajax({

                url: "ajax/usuarios.ajax.php",
                method: "POST",
                data: datosUsuario,
                cache:false,
                contentType: false,
                processData:false,
                dataType: "json",
                success: function(respuestaUsuario){

                    $("#contenedorResponsableDoc").html('<div class="form-group"><label>Responsable Proyecto/Area:</label><input type="text" name="nuevoResponsableCorRec" class="form-control" value="'+ respuestaUsuario["nombres"] + " " + respuestaUsuario["apellidos"] +'" readonly></div>');
                    
                }

            })

        }

    })

})

/*===========================
DETALLER DOCUMENTO RADICAR
============================*/
$(document).on("click", ".btnVerDocumentoRadicar", function(){

	var idCorrespondenciaEnviada = $(this).attr("idCorrespondenciaEnviada");

	var datos = new FormData();
	datos.append("idCorrespondenciaEnviada", idCorrespondenciaEnviada);

	$.ajax({

		url:"ajax/correspondencia/correspondencia-cor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

            $("#detalleCodigoConsecutivo").html('<div>'+respuesta["codigo"]+'</div>');
            $("#detalleFechaEnvio").html('<div class="form-group"><label>Fecha Creación:</label><div>'+respuesta["fecha_creacion"]+'</div></div>');
            $("#idEnvioCorrespondenciaCancelar").val(respuesta["id_cor_enviado"]);
            $("#detalleEstado").html('<div>'+respuesta["estado"]+'</div>');

            if(respuesta["asunto"] != null){

                $("#detalleAsunto").html('<div class="form-group"><label>Asunto:</label><div>'+respuesta["asunto"]+'</div></div>');

            }else{

                $("#detalleAsunto").html('');

            }

            if(respuesta["motivo_anulacion"] != null){

                $("#motivoAnulacionDevuelto").html('<hr><div class="form-group"><label>Motivo Anulación/Devolución:</label> <br>'+respuesta["motivo_anulacion"]+'</div>');

            }else{

                $("#motivoAnulacionDevuelto").html('');

            }

            if(respuesta["radicado"] != null){

                $("#detalleNumeroRadicado").html('<div class="form-group"><label>Número Radicado:</label><div>'+respuesta["radicado"]+'</div></div>');

            }else{

                $("#detalleNumeroRadicado").html('');

            }

            if(respuesta["archivo_adj_enviado"] != null && respuesta["archivo_adj_enviado"] != ""){

                $("#detalleDocumentoEnviado").html('<div class="form-group"><label>Documento Enviado:</label><div><a target="_blank" href="'+respuesta["archivo_adj_enviado"]+'"><i class="fa fa-file-pdf-o"></i> Documento Enviado</a></div></div>');

            }else{

                $("#detalleDocumentoEnviado").html('');

            }

            if(respuesta["archivo_adj_recibido"] != null && respuesta["archivo_adj_recibido"] != ""){

                $("#detalleDocumentoRecibido").html('<div class="form-group"><label>Documento Recibido:</label><div><a target="_blank" href="'+respuesta["archivo_adj_recibido"]+'"><i class="fa fa-file-pdf-o"></i> Documento Recibido</a></div></div>');

            }else{

                $("#detalleDocumentoRecibido").html('');

            }

            
            var datosProyecto = new FormData();
            datosProyecto.append("idProyecto", respuesta["id_proyecto"]);

            $.ajax({

                url:"ajax/correspondencia/proyecto-cor.ajax.php",
                method: "POST",
                data: datosProyecto,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#detalleProyecto").html('<div>'+respuesta["nombre_proyecto"]+'</div>');
                
                }

            });

            var datosUsuario = new FormData();
            datosUsuario.append("idUsuario", respuesta["id_usuario"]);

            $.ajax({

                url:"ajax/usuarios.ajax.php",
                method: "POST",
                data: datosUsuario,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuestaU){

                    $("#detalleUsuarioEnvio").html('<div class="form-group"><label>Usuario Creación:</label><div>'+respuestaU["nombres"] + " " + respuestaU["apellidos"] +'</div></div>');
                
                }

            });

            /*====================================
            SI TIENE REGISTRO DE QUE CARGO DOCUMENTO MOSTRAMOS LOS DATOS
            =====================================*/
            if(respuesta["id_usuario_carga_documento"] != null){

                var datosUsuario = new FormData();
                datosUsuario.append("idUsuario", respuesta["id_usuario_carga_documento"]);

                $.ajax({

                    url:"ajax/usuarios.ajax.php",
                    method: "POST",
                    data: datosUsuario,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta){

                        $("#detalleTituloCarga").html('<label>Detalle de Carga Documento Radicar</label>');
                        $("#detalleUsuarioCargaRadicar").html('<div><label>Usuario Cargo Documento Radicar:</label> '+respuesta["nombres"]+ " " + respuesta["apellidos"] +'</div>');
                    
                    }

                });

                $("#detalleFechaCargaRadicar").html('<div><label>Fecha Usuario Cargo Documento Radicar:</label> '+respuesta["fecha_carga_documento"]+'</div>');

            }else{

                $("#detalleTituloCarga").html('');
                $("#detalleUsuarioCargaRadicar").html('');
                $("#detalleFechaCargaRadicar").html('');

            }

            /*====================================
            SI TIENE REGISTRO DE QUE CARGO UNA RESPUESTA MOSTRAMOS LOS DATOS
            =====================================*/
            if(respuesta["id_usuario_carga_respuesta"] != null){

                var datosUsuario = new FormData();
                datosUsuario.append("idUsuario", respuesta["id_usuario_carga_respuesta"]);

                $.ajax({

                    url:"ajax/usuarios.ajax.php",
                    method: "POST",
                    data: datosUsuario,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta){

                        $("#detalleTituloRespuesta").html('<label>Detalle de Carga Respuesta/Recibido</label>');
                        $("#detalleUsuarioCargaRespuesta").html('<div><label>Usuario Cargo Respuesta/Recibido:</label> '+respuesta["nombres"]+ " " + respuesta["apellidos"] +'</div>');
                    
                    }

                });

                $("#detalleFechaCargaRespuesta").html('<div><label>Fecha Usuario Cargo Respuesta/Recibido:</label> '+respuesta["fecha_carga_respuesta"]+'</div>');

            }else{

                $("#detalleTituloRespuesta").html('');
                $("#detalleUsuarioCargaRespuesta").html('');
                $("#detalleFechaCargaRespuesta").html('');

            }

            /*====================================
            SI TIENE REGISTRO DE QUE SE ANULO MOSTRAMOS LOS DATOS
            =====================================*/
            if(respuesta["id_usuario_cancelacion"] != null){

                var datosUsuario = new FormData();
                datosUsuario.append("idUsuario", respuesta["id_usuario_cancelacion"]);

                $.ajax({

                    url:"ajax/usuarios.ajax.php",
                    method: "POST",
                    data: datosUsuario,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta){

                        $("#detalleTituloAnulacion").html('<label>Detalle de Anulación/Devolución</label>');
                        $("#detalleUsuarioCargaAnulacion").html('<div><label>Usuario Cargo Anulación/Devolución:</label> '+respuesta["nombres"]+ " " + respuesta["apellidos"] +'</div>');
                    
                    }

                });

                $("#detalleFechaCargaAnulacion").html('<div><label>Fecha Usuario Cargo Anulación/Devolución:</label> '+respuesta["fecha_cancelacion"]+'</div>');

            }else{

                $("#detalleTituloAnulacion").html('');
                $("#detalleUsuarioCargaAnulacion").html('');
                $("#detalleFechaCargaAnulacion").html('');

            }



		}

	});

})


/*===========================
DEVOLVER/ANULAR DOCUMENTO RADICAR
============================*/
$(document).on("click", ".btnAnularDocumentoRadicar", function(){

	var idCorrespondenciaEnviada = $(this).attr("idCorrespondenciaEnviada");

	var datos = new FormData();
	datos.append("idCorrespondenciaEnviada", idCorrespondenciaEnviada);

	$.ajax({

		url:"ajax/correspondencia/correspondencia-cor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

            $("#cancelarCodigoConsecutivo").html('<div>'+respuesta["codigo"]+'</div>');
            $("#verFechaCancelar").html('<div>'+respuesta["fecha_creacion"]+'</div>');
            $("#idEnvioCorrespondenciaCancelar").val(respuesta["id_cor_enviado"]);

            if(respuesta["asunto"] != null){

                $("#verAsuntoCancelar").html('<div>'+respuesta["asunto"]+'</div>');

            }
            
            var datosProyecto = new FormData();
            datosProyecto.append("idProyecto", respuesta["id_proyecto"]);

            $.ajax({

                url:"ajax/correspondencia/proyecto-cor.ajax.php",
                method: "POST",
                data: datosProyecto,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#verProyectoCancelar").html('<div>'+respuesta["nombre_proyecto"]+'</div>');
                
                }

            });

            var datosUsuario = new FormData();
            datosUsuario.append("idUsuario", respuesta["id_usuario"]);

            $.ajax({

                url:"ajax/usuarios.ajax.php",
                method: "POST",
                data: datosUsuario,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#verUsuarioCancelar").html('<div>' + respuesta["nombres"] + " " + respuesta["apellidos"] + '</div>');
                
                }

            });

		}

	});

})

/*===========================
CARGAR DOCUMENTO RESPUESTA
============================*/
$(document).on("click", ".btnCargarRespuestaRadicado", function(){

	var idCorrespondenciaEnviada = $(this).attr("idCorrespondenciaEnviada");

	var datos = new FormData();
	datos.append("idCorrespondenciaEnviada", idCorrespondenciaEnviada);

	$.ajax({

		url:"ajax/correspondencia/correspondencia-cor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

            $("#respuestaCodigoConsecutivo").html('<div>'+respuesta["codigo"]+'</div>');
            $("#verFechaRespuesta").html('<div>'+respuesta["fecha_creacion"]+'</div>');
            $("#idEnvioCorrespondenciaRespuesta").val(respuesta["id_cor_enviado"]);
            $("#verAsuntoRespuesta").html('<div>'+respuesta["asunto"]+'</div>');
            $("#documentoEnviado").html('<a target="_blank" href="'+respuesta["archivo_adj_enviado"]+'"><i class="fa fa-file-pdf-o"></i> Documento Enviado</a>');
            
            var datosProyecto = new FormData();
            datosProyecto.append("idProyecto", respuesta["id_proyecto"]);

            $.ajax({

                url:"ajax/correspondencia/proyecto-cor.ajax.php",
                method: "POST",
                data: datosProyecto,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#verProyectoRespuesta").html('<div>'+respuesta["nombre_proyecto"]+'</div>');
                
                }

            });

            var datosUsuario = new FormData();
            datosUsuario.append("idUsuario", respuesta["id_usuario"]);

            $.ajax({

                url:"ajax/usuarios.ajax.php",
                method: "POST",
                data: datosUsuario,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#verUsuarioRespuesta").html('<div>' + respuesta["nombres"] + " " + respuesta["apellidos"] + '</div>');
                
                }

            });

		}

	});

})

/*===========================
CARGAR DOCUMENTO A RADICAR
============================*/
$(document).on("click", ".btnCargarDocumentoRadicar", function(){

	var idCorrespondenciaEnviada = $(this).attr("idCorrespondenciaEnviada");
	
	var datos = new FormData();
	datos.append("idCorrespondenciaEnviada", idCorrespondenciaEnviada);

	$.ajax({

		url:"ajax/correspondencia/correspondencia-cor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

            $("#verCodigoConsecutivo").html('<div>'+respuesta["codigo"]+'</div>');
            $("#verFecha").html('<div>'+respuesta["fecha_creacion"]+'</div>');
            $("#idEnvioCorrespondencia").val(respuesta["id_cor_enviado"]);
            
            var datosProyecto = new FormData();
            datosProyecto.append("idProyecto", respuesta["id_proyecto"]);

            $.ajax({

                url:"ajax/correspondencia/proyecto-cor.ajax.php",
                method: "POST",
                data: datosProyecto,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#verProyecto").html('<div>'+respuesta["nombre_proyecto"]+'</div>');
                
                }

            });

            var datosUsuario = new FormData();
            datosUsuario.append("idUsuario", respuesta["id_usuario"]);

            $.ajax({

                url:"ajax/usuarios.ajax.php",
                method: "POST",
                data: datosUsuario,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#verUsuario").html('<div>' + respuesta["nombres"] + " " + respuesta["apellidos"] + '</div>');
                
                }

            });

		}

	});

})


/*===========================
VALIDAR QUE EL DOCUMENTO ESTE EN FORMATO .PDF o WORD
============================*/
$("#nuevoDocumentoCorrespondencia").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf" && imagen["type"] != ".docx" && imagen["type"] != ".doc" && imagen["type"] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document"){

        $("#nuevoDocumentoCorrespondencia").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF, .DOC, .DOCX!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})

/*===========================
VALIDAR QUE EL DOCUMENTO ESTE EN FORMATO .PDF o WORD
============================*/
$("#nuevoDocumentoCorrespondenciaRespuesta").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf" && imagen["type"] != ".docx" && imagen["type"] != ".doc" && imagen["type"] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document"){

        $("#nuevoDocumentoCorrespondenciaRespuesta").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF, .DOC, .DOCX!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})

/*===========================
VALIDAR QUE EL DOCUMENTO ESTE EN FORMATO .PDF o WORD
============================*/
$("#nuevoDocumentoProyectoCorRec").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf" && imagen["type"] != ".docx" && imagen["type"] != ".doc" && imagen["type"] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document"){

        $("#nuevoDocumentoProyectoCorRec").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF, .DOC, .DOCX!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})

/*===========================
VALIDAR QUE EL DOCUMENTO ESTE EN FORMATO .PDF o WORD
============================*/
$("#nuevoDocumentoProyectoDocCorRec").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf" && imagen["type"] != ".docx" && imagen["type"] != ".doc" && imagen["type"] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document"){

        $("#nuevoDocumentoProyectoDocCorRec").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF, .DOC, .DOCX!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})


/*===========================
VALIDAR QUE EL DOCUMENTO ESTE EN FORMATO .PDF o WORD
============================*/
$("#nuevoDocumentoProyectoCorRecRad").change(function(){

    var imagen = this.files[0];

    if(imagen["type"] != "application/pdf" && imagen["type"] != ".docx" && imagen["type"] != ".doc" && imagen["type"] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document"){

        $("#nuevoDocumentoProyectoCorRecRad").val("");

        swal({

            title: "Error al subir el Archivo",
            text: "¡El archivo debe tener formato .PDF, .DOC, .DOCX!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }    

})

/*===========================
TRAER CODIGO CONCECUTIVO MASIVO
============================*/
$("#nuevoProyectoConcecutivoMasivo").change(function(){

    var idProyecto = document.getElementById('nuevoProyectoConcecutivoMasivo').value;

    if(idProyecto != ""){

        $.ajax({

            type: "POST",
            url: "ajax/correspondencia/correspondencia-cor.ajax.php",
            data: "idProyecto="+idProyecto,
            success:function(respuesta){

                $("#contenedorCodigoMasivo").html(respuesta);

            }

        })

    }else{

        swal({

            title: "!Error¡",
            text: "¡Debe seleccionar el proyecto para poder generar el Codigo concecutivo!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

        var respuesta = "";

        $("#contenedorCodigoMasivo").html(respuesta);        

    }


});


/*===========================
TRAER CODIGO CONCECUTIVO
============================*/
$("#nuevoProyectoConcecutivo").change(function(){

    var idProyecto = document.getElementById('nuevoProyectoConcecutivo').value;

    if(idProyecto != ""){

        $.ajax({

            type: "POST",
            url: "ajax/correspondencia/correspondencia-cor.ajax.php",
            data: "idProyecto="+idProyecto,
            success:function(respuesta){

                $("#contenedorCodigo").html(respuesta);

            }

        })

    }else{

        swal({

            title: "!Error¡",
            text: "¡Debe seleccionar el proyecto para poder generar el Codigo concecutivo!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

        var respuesta = "";

        $("#contenedorCodigo").html(respuesta);        

    }


});

/*=============================================
Data Table
=============================================*/

$(".tablasCorrespondencia").DataTable({

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
    "order": [[0, "desc"]]

});

$(".tablasCorrespondenciaRecibida").DataTable({

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

$(document).ready(function(){
    var table = $('#tablaCor').DataTable({
       orderCellsTop: true,
       fixedHeader: true 
    });
 
    //Creamos una fila en el head de la tabla y lo clonamos para cada columna
    $('#tablaCor tfoot tr').clone(true).appendTo( '#tablaCor tfoot' );
 
    $('#tablaCor tfoot tr:eq(1) th').each( function (i) {
        var title = $(this).text(); //es el nombre de la columna
        $(this).html( '<input class="form-control" type="text" placeholder="Search..." />' );
  
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );   
});
