

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reportes
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Reportes</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">

        <div class="col-md-12 col-xs-12">
          <form class="form-inline" action="<?php echo base_url('reports/') ?>" method="POST">
            <div class="form-group">
              <label for="date">Year</label>
              <select class="form-control" name="select_year" id="select_year">
                <?php foreach ($report_years as $key => $value): ?>
                  <option value="<?php echo $value ?>" <?php if($value == $selected_year) { echo "selected"; } ?>><?php echo $value; ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
        </div>

        <br /> <br />


        <div class="col-md-12 col-xs-12">

          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-error alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Total de pedidos - Informe</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Total de pedidos pagados - Datos del informe</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="datatables" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Mes - Año</th>
                  <th>Monto</th>
                </tr>
                </thead>
                <tbody>

                  <?php foreach ($results as $k => $v): ?>
                    <tr>
                      <td><?php echo $k; ?></td>
                      <td><?php 
                      
                        echo $company_currency .' ' . $v;
                        //echo $v;
                      
                      ?></td>
                    </tr>
                  <?php endforeach ?>
                  
                </tbody>
                <tbody>
                  <tr>
                    <th>Total Amount</th>
                    <th>
                      <?php //echo $company_currency . ' ' . array_sum($parking_data); ?>
                      <?php echo array_sum($results); ?>
                    </th>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
      
       <!-- Main content -->
 
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>


        <div class="box">
          <div class="box-header">
            <h3 class="box-title">REPORTE PEPS</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Fecha</th>
                <th>Evento</th>
                <th>Cantidad Entrada</th>
                <th>Costo Unitario Entrada</th>
                <th>Total Entrada</th>
                <th>Cantidad Salida</th>
                <th>Costo Unitario Salida</th>
                <th>Total Salida</th>
                <th>Cantidad Inventario</th>
                <th>Costo Unitario Inventario</th>
                <th>Total Inventario</th>                
                
                <?php if(in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
                  <th>Acción</th>
                <?php endif; ?>
              </tr>
              </thead>

            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
    

 
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

  <script type="text/javascript">

    $(document).ready(function() {
      $("#reportNav").addClass('active');
    }); 

    var report_data = <?php echo '[' . implode(',', $results) . ']'; ?>;
    

    $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
     var areaChartData = {
      labels  : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : report_data
        }
      ]
    }

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    barChartData.datasets[0].fillColor   = '#00a65a';
    barChartData.datasets[0].strokeColor = '#00a65a';
    barChartData.datasets[0].pointColor  = '#00a65a';
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  })
  </script>
