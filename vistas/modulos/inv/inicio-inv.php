<div class="content-wrapper">

  <?php 
  
    $ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/vistas/modulos/ui/validacion-permiso.php"; 

    include_once $ruta;
  
  ?>

  <section class="content-header">
    
   <h1>     
      INVENTARIO DE AGS 

    </h1>

    <ol class="breadcrumb">
      
    </ol>

  </section>

  <!-- CONTENIDO -->
  <section class="content">

    <?php include_once "ui/menu-inv.php"; ?>

    <!-- CAJA DESPLEGABLE -->

    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Bienvenido: <b><?php echo $_SESSION["nombres"] . " " . $_SESSION["apellidos"] . " - " . "Software: " . $_SESSION["permiso_software"]; ?></b></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">


      </div>
    </div>

    <div class="row">

      <div class="col-md-12">

        <div class="box">

          <div class="box-body">

            <?php 

              $resultado = ControladorReportes::ctrObtenerEquiposPcDatos();

            ?>

            <div id="contenedorArrendadosPropiosPc"></div>

          </div>

        </div>

      </div>

    </div>

    <div class="row">

      <div class="col-md-6">

        <div class="box">

          <div class="box-body">

            <?php 

              $resultado = ControladorReportes::ctrObtenerEquiposPropiosArrendados();

            ?>

            <div id="contenedorArrendadosPropios"></div>

          </div>

        </div>

      </div>

      <div class="col-md-6">

        <div class="box">

          <div class="box-body">

            <?php 

              $resultado = ControladorReportes::ctrObtenerEquiposEstadoCondicion();


            ?>

            <div id="contenedorEquiposEstadosCondicion"></div>

          </div>

        </div>

      </div>

    </div>
    
  </section>
</div>

<script>

  Highcharts.chart('contenedorArrendadosPropios', {
    chart: {
      type: 'column'
    },
    title: {
      text: 'Activos Ags Americas/Consorcio'
    },
    xAxis: {
      categories: [
        <?php 

          $resultado = ControladorReportes::ctrObtenerEquiposPropiosArrendados();

          foreach ($resultado as $key => $value) {

            echo "'".$value["centro_costos_activo"]."',";

          }
        ?>

      ],
    },
    yAxis: {
      title: {
        text: 'Cantidad'
      }
    },
    tooltip: {
      headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
      footerFormat: '</table>',
      shared: true,
      useHTML: true
    },
    plotOptions: {
      column: {
        pointPadding: 0.2,
        borderWidth: 0
      }
    },
    series: [{<?php 

      $resultado = ControladorReportes::ctrObtenerEquiposPropiosArrendados();

      $cadenaPropio = "";

      foreach ($resultado as $key => $value) {

        if($value["propio"] != ""){

          $cadenaPropio .= $value["propio"].",";

        }
      }

      $cadenaPropioF = substr($cadenaPropio, 0, -1);

      echo "name: 'Propio',"."data: [".$cadenaPropioF."], color: '#54a75b'";
    
    ?>},{<?php

      $resultado = ControladorReportes::ctrObtenerEquiposPropiosArrendados();

      $cadenaRentado = "";

      foreach ($resultado as $key => $value) {

        if($value["rentado"] != ""){

          $cadenaRentado .= $value["rentado"].",";

        }
      }

      $cadenaRentadoF = substr($cadenaRentado, 0, -1);

      echo "name: 'Rentado',"."data: [".$cadenaRentadoF."]";

    ?>}]
  });

</script>

<script>

  Highcharts.chart('contenedorArrendadosPropiosPc', {
    chart: {
      type: 'column'
    },
    title: {
      text: 'Computadores Propios/Rentados x Centro de Costos'
    },
    xAxis: {
      categories: [
        <?php 

          $resultado = ControladorReportes::ctrObtenerEquiposPcDatos();

          foreach ($resultado as $key => $value) {

            echo "'".$value["categoria"]." - " . "<b>" .$value["centro_costos_activo"] . "</b>" . "',";

          }
        ?>

      ],
    },
    yAxis: {
      title: {
        text: 'Cantidad'
      }
    },
    tooltip: {
      headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
      footerFormat: '</table>',
      shared: true,
      useHTML: true
    },
    plotOptions: {
      column: {
        pointPadding: 0.2,
        borderWidth: 0
      }
    },
    series: [{<?php 

      $resultado = ControladorReportes::ctrObtenerEquiposPcDatos();

      $cadenaPropio = "";

      foreach ($resultado as $key => $value) {

        if($value["propio"] != ""){

          $cadenaPropio .= $value["propio"].",";

        }
      }

      $cadenaPropioF = substr($cadenaPropio, 0, -1);

      echo "name: 'Propio',"."data: [".$cadenaPropioF."], color: '#54a75b'";

      ?>},{<?php

      $resultado = ControladorReportes::ctrObtenerEquiposPcDatos();

      $cadenaRentado = "";

      foreach ($resultado as $key => $value) {

        if($value["rentado"] != ""){

          $cadenaRentado .= $value["rentado"].",";

        }
      }

      $cadenaRentadoF = substr($cadenaRentado, 0, -1);

      echo "name: 'Rentado',"."data: [".$cadenaRentadoF."], color: '#f29c33'";

    ?>}]
  });

</script>

<script>

  Highcharts.chart('contenedorEquiposEstadosCondicion', {
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie'
    },
    title: {
      text: 'Estado Condicion Uso - Ags Americas/Consorcio'
    },
    plotOptions: {
      pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        dataLabels: {
          enabled: false
        },
        showInLegend: true
      }
    },
    series: [{
      name: 'Cantidad',
      colorByPoint: true,
      data: [<?php 

        $resultado = ControladorReportes::ctrObtenerEquiposEstadoCondicion();

        foreach ($resultado as $key => $value) {

          if($value["estado_activo"] == "BUENO"){

            echo "{name: '".$value["centro_costos_activo"] . " - " . $value["estado_activo"] . " - " . $value["metodo_adquisicion_activo"] . "', y: ".$value["cantidad_estado"].", color: '#54a75b'},";

          }elseif($value["estado_activo"] == "REGULAR"){

            echo "{name: '".$value["centro_costos_activo"] . " - " . $value["estado_activo"] . " - " . $value["metodo_adquisicion_activo"] . "', y: ".$value["cantidad_estado"].", color: '#f29c33'},";

          }elseif($value["estado_activo"] == "MALO"){

            echo "{name: '".$value["centro_costos_activo"] . " - " . $value["estado_activo"] . " - " . $value["metodo_adquisicion_activo"] . "', y: ".$value["cantidad_estado"].", color: '#dd4b39'},";

          }

        }
      
      ?>]

      /*
      data: [{
        name: 'Chrome',
        y: 61.41,
        sliced: true,
        selected: true
      }, {
        name: 'Internet Explorer',
        y: 11.84
      }, {
        name: 'Firefox',
        y: 10.85
      }, {
        name: 'Edge',
        y: 4.67
      }, {
        name: 'Safari',
        y: 4.18
      }, {
        name: 'Other',
        y: 7.05
      }]
      */
    }]
  });


</script>