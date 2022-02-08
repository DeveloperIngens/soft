
/*=============================================
EDITAR USUARIO
=============================================*/
$(document).on("click", ".btnEditarActivo", function(){

	var idActivo = $(this).attr("idActivo");
	
	var datos = new FormData();
	datos.append("idActivo", idActivo);

	$.ajax({

		url:"ajax/inv/prestadores-inv.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
 	
			$("#editarIdActivos").val(respuesta["id_activos"]);
			$("#editarbien").val(respuesta["bien"]);
			$("#editartipo").val(respuesta["tipo"]);
			if(respuesta["tipo"] == "MUEBLES Y ENSERES"){$("#editartipo").val('1');};
			$("#editarNumeroplaca").val(respuesta["numero_placa"]);
			$("#editarestado_activo").val(respuesta["estado_activo"]);
			if(respuesta["estado_activo"] == "MALO"){$("#editarestado_activo").val('3');}else if(respuesta["estado_activo"] == "REGULAR"){$("#editarestado_activo").val('2');}else if(respuesta["estado_activo"] == "BUENO"){$("#editarestado_activo").val('1');};
			$("#editarValoractivo").val(respuesta["valor_activo"]);
		

			}

		})

	});

/*=============================================
ELIMINAR ACTIVO
=============================================*/

$(document).on("click", ".btnEliminarActivo", function(){
  
  var bien = $(this).attr("bien");
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

      window.location = "index.php?ruta=prestadores-inv&bien="+bien+"&placa="+placa+"&IdActivos="+id_activos;

    }


  })

})

/*=============================================
ACTIVAR ACITVO
=============================================*/
$(document).on("click", ".btnActivaractivo", function(){

	var idActivo = $(this).attr("idActivo");
	var estadoActivo = $(this).attr("estadoActivo");
	
	var datos = new FormData();
 	datos.append("activarId", idActivo);
  	datos.append("activarActivo", estadoActivo);

  	$.ajax({

	  url:"ajax/inv/prestadores-inv.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

      	if(window.matchMedia("(max-width:767px)").matches){
		
      		 swal({
		      	title: "El activo ha sido actualizado",
		      	type: "success",
		      	confirmButtonText: "¡Cerrar!"
		    	}).then(function(result) {
		        
		        	if (result.value) {

		        	window.location = "prestadores-inv";

		        }

		      });


		}
      }

  	})

  	if(estadoActivo == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Inactivo');
  		$(this).attr('estadoActivo',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estadoActivo',0);

  	}

})




  