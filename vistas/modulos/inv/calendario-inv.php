<div class="content-wrapper">

  <?php 
  
    $ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/vistas/modulos/ui/validacion-permiso.php"; 

    include_once $ruta;
  
  ?>


  <section class="content-header">
    
    <h1>
      
      Visualización Mantenimientos Preventivos/Correctivos

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio-inv"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Visualización Mantenimientos Preventivos/Correctivos</li>

    </ol>

  </section>

  <section class="content">


    <?php include_once "ui/menu-inv.php"; ?>

      <div class="box box-info">

        <div class="box-header with-border">

          <h3><center><b>Calendario Mantenimientos</b></center></h3>

        </div>
          
        <div class="box-body">

          <!-- TRAE EL CALENDARIO -->
          <div id="calendar" class="fc fc-unthemed fc-ltr"></div>

        </div>

      </div>

  </section>
    
</div>
    
<!-- MODAL FECHA A REALIZAR MANTENIMIENTOS  -->

<!--=====================================
MODAL PARA VER MANTENIMIENTO PREVENTIVO/CORRECTIO
======================================-->

<div id="modalEditarMantenimiento" class="modal fade" role="dialog" style="overflow-y: scroll">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Ver Mantenimiento Preventivo/Correctivo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">
              <div class="col-md-4">
                <!-- ENTRADA PARA EL RESPONSABLE -->
                <div class="form-group">  
                  <label>Responsable:</label>
                  <div id="editarResponsableMantenimiento"></div>
                  <input type="hidden" id="EditarCalendario" name ="EditarCalendario" value="">  
                </div>
              </div>
              <div class="col-md-4">
                <!-- ENTRADA PARA FECHA MANTENIMIENTO -->
                <div class="form-group">  
                  <label>Fecha Mantenimiento Preventivo/Correctivo:</label>
                  <a class="btn btn-success btn-xs"><div id="editarFechaMantenimiento"></div></a>
                </div>
              </div>
              <div class="col-md-4">
                <!-- ENTRADA PARA PROX FECHA MANTENIMIENTO -->
                <div class="form-group">  
                  <label>Fecha Proximo Mantenimiento Preventivo/Correctivo:</label>
                  <a class="btn btn-warning btn-xs"><div id="editarProFechaMantenimiento"></div></a>
                </div>
              </div>
            </div>

            <hr>

            <div class="row">

              <div class="col-md-12">

                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" style="color: #00a65a;" href="#collapseInfoActivo" class="collapsed" aria-expanded="false">
                        Información del Activo
                      </a>
                    </h4>
                  </div>
                  <div id="collapseInfoActivo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="box-body">

                      <div id="contenedorInfoActivo"></div>

                    </div>
                  </div>
                </div>

              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-12">

                <label>Mantenimientos Realizados:</label>

                <div id="contenedorMantenimientos"></div>


              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-8">

                <div class="form-group">  

                  <label>Observaciónes Mantenimiento:</label>

                  <div id="contenedorObservacionesMantenimiento"></div>

                </div>

              </div>

              <div class="col-md-4">

                <div class="form-group">

                  <label>Estado Mantenimiento:</label>

                  <div id="contenedorEstadoMantenimiento"></div>

                </div>

              </div>

            </div>




          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <div id="contenedorEditarMantenimiento"></div>

          <button type="submit"  name="enviarCorreo" class="btn btn-success"><i class="fas fa-paper-plane"></i> Enviar Correo</button>

        </div>

        <?php

          if(isset($_POST["enviarCorreo"])){

            $enviarCorreo = new ControladorCronograma();
            $enviarCorreo->ctrCorreo();

          }

        ?>

      </form>

    </div>

  </div>

</div>
    
<!-- ACA HACE EL SCRIPT QUE VA EN EL CALENDARIO -->
<script>

  $(function () {
    /* ACA VAN LOS EVENTOS
    -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {


        var eventObject = {
          title: $.trim($(this).text()) 
        }

        $(this).data('eventObject', eventObject)

        $(this).draggable({
          zIndex        : 1070,
          revert        : true, 
          revertDuration: 0  
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
    -----------------------------------------------------------------*/
    var date = new Date()
    var d    = date.getDate(),
    m    = date.getMonth(),
    y    = date.getFullYear()
    $('#calendar').fullCalendar({
      themeSystem: 'bootstrap3',
      header    : {
       locale:'es',
       left  : 'prev,next today',
       center: 'title',
       right : 'month,agendaWeek,agendaDay',
       prev: 'left-single-arrow',
       next: 'right-single-arrow',
       prevYear: 'left-double-arrow',
       nextYear: 'right-double-arrow',
       editable: true,
       dayMaxEvents: true, 
       events: 'https://fullcalendar.io/demo-events.json?overload-day'
     },
     buttonText: {
      today: 'DIA DE HOY',
      month: 'MES',
      week : 'SEMANA',
      day  : 'DIA'
    },
    height: 800,
    width: 400,
    events:[

    <?php 

    $item = null;
    $valor = null;
    $activos = ControladorCronograma::ctrMostrarCronograma($item,$valor);
    
    foreach ($activos as $key => $value): 

      ?>

      <?php if($value["estado"] == 1):

      echo "{";

      ?>

        title: <?php echo "'".$value["placa"]."'"; ?>,
        start: <?php echo "'".$value["fecha_mante"]."'"; ?>,
        color: <?php echo "'".$value["color"]."'"; ?>,
        id_calendario: <?php echo "'".$value["id_calendario"]."'"; ?>,
        responsable: <?php echo "'".$value["responsable"]."'"; ?>,
        placa:<?php echo "'".$value["placa"]."'"; ?>,
        prox_mante :<?php echo "'".$value["prox_mante"]."'"; ?>,
        serial : <?php echo "'".$value["serial"]."'"; ?>,
        fecha_mante :<?php echo "'".$value["fecha_mante"]."'"; ?>,
        observaciones :<?php echo "'".$value["observaciones"]."'"; ?>,
        idActivo: <?php echo "'".$value["id_activo"]."'"; ?>,
        estadoMantenimiento: <?php echo "'".$value["estado_mantenimiento"]."'"; ?>

      <?php 

        echo "},";

        endif

      ?>

      <?php endforeach ?>
    ],
    eventClick:function(event){

      $("#modalEditarMantenimiento").modal('toggle');
      $("#EditarCalendario").val(event.id_calendario);

      if(event.estadoMantenimiento == "Pendiente"){

        $("#contenedorEditarMantenimiento").html('<button type="button" class="btn btn-info pull-left btnRealizarMantenimiento" idMantenimiento="'+event.id_calendario+'"><i class="fas fa-toolbox"></i> Realizar Mantenimiento</button>');

      }else{

        $("#contenedorEditarMantenimiento").html('');

      }

      if(event.estadoMantenimiento == "Pendiente"){

        $("#contenedorEstadoMantenimiento").html('<a class="btn btn-warning btn-xs">'+event.estadoMantenimiento+'</a>');

      }else if(event.estadoMantenimiento == "Realizado"){

        $("#contenedorEstadoMantenimiento").html('<a class="btn btn-success btn-xs">'+event.estadoMantenimiento+'</a>');

      }

      $("#editarResponsableMantenimiento").html(event.responsable);
      $("#editarNumeroplacas").val(event.placa); 
      $("#editarSerialx").val(event.serial);
      $("#editarFechaMantenimiento").html(event.fecha_mante);
      $("#editarcolor").val(event.color);
      $("#editarMantenimiento").val(event.mantenimiento);
      $("#contenedorObservacionesMantenimiento").html(event.observaciones);
      $("#editarProFechaMantenimiento").html(event.prox_mante);

      $.ajax({

        type: "POST",
        url: "ajax/inv/tecnologia.ajax-inv.php",
        data: "idActivoMostrar="+event.idActivo,
        success:function(respuesta){

          $("#contenedorInfoActivo").html(respuesta);

        }

      })

      $.ajax({

          type: "POST",
          url: "ajax/inv/mantenimiento.ajax-inv.php",
          data: "DatosCalendario="+event.id_calendario,
          success:function(respuesta){

              $("#contenedorMantenimientos").html(respuesta);

          }

      })


    },
    dayClick: function(date) {

    var fecha =date.format();

    var fechaDos = date.format();
    var fechaParse = new Date(fechaDos);
    fechaParse.setMonth(fechaParse.getMonth()+6);
    var fechaPro = (fechaParse.getFullYear()+'-'+('0' + (fechaParse.getMonth()+1)).slice(-2)+'-'+('0' + fechaParse.getDate()).slice(-2));             

      $("#ModalEnviarFechas").modal('toggle');
      $("#fecha_actual").val(fecha);
      $("#fecha_proximo").val(fechaPro); 
    },
 
    editable  : true,
    droppable : true, 
    drop      : function (date,allDay){ 


      var originalEventObject = $(this).data('eventObject')
      var copiedEventObject = $.extend({}, originalEventObject)

      copiedEventObject.start           = date
      copiedEventObject.allDay          = allDay
      copiedEventObject.backgroundColor = $(this).css('background-color')
      copiedEventObject.borderColor     = $(this).css('border-color')

      $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)


      if ($('#drop-remove').is(':checked')) {

        $(this).remove()
      }

    }
  })

    var currColor = '#3c8dbc' 
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()

      currColor = $(this).css('color')

      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      
      var event = $('<div/>')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#FOF8FF'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)


      init_events(event)

      
      $('#new-event').val('')
    })
  })
</script>
