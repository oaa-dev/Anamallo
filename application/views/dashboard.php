
<link href="<?php echo base_url();?>assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
  <!-- BEGIN CONTENT BODY -->
  <div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h1 class="page-title"> Admin Dashboard
      <small>statistics, charts and reports</small>
    </h1>
    <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="index.html">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Dashboard</span>
          </li>
      </ul>
    </div>
    <!-- END PAGE HEADER-->
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="dashboard-stat blue">
              <div class="visual">
                  <i class="fa fa-bar-chart fa-icon-medium"></i>
              </div>
              <div class="details">
                  <div class="number"> <?php echo $total_invoice_sales;?> </div>
                  <div class="desc"> Total Sales </div>
              </div>
              <a class="more" href="<?php echo base_url('invoice');?>"> View more
                  <i class="m-icon-swapright m-icon-white"></i>
              </a>
          </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="dashboard-stat red">
              <div class="visual">
                  <i class="fa fa-shopping-cart"></i>
              </div>
              <div class="details">
                  <div class="number"> <?php echo $total_invoices;?> </div>
                  <div class="desc"> Total Invoice </div>
              </div>
              <a class="more" href="<?php echo base_url('invoice');?>"> View more
                  <i class="m-icon-swapright m-icon-white"></i>
              </a>
          </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="dashboard-stat green">
              <div class="visual">
                  <i class="fa fa-group fa-icon-medium"></i>
              </div>
              <div class="details">
                  <div class="number"> <?php echo $total_users;?> </div>
                  <div class="desc"> Total Users </div>
              </div>
              <a class="more" href="<?php echo base_url('user');?>"> View more
                  <i class="m-icon-swapright m-icon-white"></i>
              </a>
          </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="dashboard-stat purple">
              <div class="visual">
                  <i class="fa fa-truck fa-icon-medium"></i>
              </div>
              <div class="details">
                  <div class="number"> <?php echo $total_products;?> </div>
                  <div class="desc"> Product Available </div>
              </div>
              <a class="more" href="<?php echo base_url('supplier');?>"> View more
                  <i class="m-icon-swapright m-icon-white"></i>
              </a>
          </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-5">
        <!-- Begin: life time stats -->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-share font-blue"></i>
                    <span class="caption-subject font-blue bold uppercase">Overview</span>
                    <span class="caption-helper">top five selling product...</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered" id="manageTable">
                        <thead>
                            <tr>
                                <th> Product Name </th>
                                <th> Price </th>
                                <th> Sold </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($top_five as $key => $value):?>
                            <tr>
                                <td><?php echo $value[0]; ?></td>
                                <td><?php echo '₱ '.number_format($value[1]); ?></td>
                                <td><?php echo $value[2]; ?></td>
                                <td>
                                    <?php echo $value[3]; ?>
                                </td>
                            </tr>
                        <?php endforeach?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End: life time stats -->
        
        <div class="portlet light portlet-fit bordered">
          <div class="portlet-title tabbable-line">
            <div class="caption">
                <i class="icon-globe font-red"></i>
                <span class="caption-subject font-red bold uppercase">Pie Chart</span>
                <span class="caption-helper">total sales of the year...</span>
            </div>
          </div>
          <div class="portlet-body">
            <div id="chart_2" style="height:350px;"></div>
          </div>
        </div>
      </div>
      <div class="col-md-7">
          <!-- Begin: life time stats -->
          <!-- BEGIN PORTLET-->
          <div class="portlet light bordered">
              <div class="portlet-title tabbable-line">
                  <div class="caption">
                      <i class="icon-globe font-red"></i>
                      <span class="caption-subject font-red bold uppercase">Total Sales</span>
                      <span class="caption-helper">total sales of the year...</span>
                  </div>
                  <ul class="nav nav-tabs">
                      <li>
                          <a href="<?php echo base_url('report/sales');?>"> View More </a>
                      </li>
                  </ul>
              </div>
              <div class="portlet-body">
                  <div style="height: 300px">
                      <canvas id="barChart" style="height:300px"></canvas>
                  </div>
                  <div class="well margin-top-20">
                      <div class="row" align="center">
                          <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                              <span class="label label-success"> Total Sales: </span>
                              <h3> ₱ <?php echo number_format(array_sum($total_sales),2);?></h3>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                              <span class="label label-info"> Total VAT: </span>
                              <h3> ₱ <?php echo number_format(array_sum($total_tax),2);?></h3>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-6 text-stat">
                              <span class="label label-warning"> Invoice: </span>
                              <h3><?php echo number_format(array_sum($total_invoice));?></h3>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <div class="portlet light portlet-fit bordered">
            <div class="portlet-title tabbable-line">
              <div class="caption">
                  <i class="icon-globe font-red"></i>
                  <span class="caption-subject font-red bold uppercase">Pie Chart</span>
                  <span class="caption-helper">total purchase</span>
              </div>
              <div class="form-inline">
                <form method="post" action="<?php echo base_url()?>dashboard/index">
                  <select class="form-control" name="pie_data">
                    <option value="product">Product</option>
                    <option value="model">Model</option>
                    <option value="category">Category</option>
                    <option value="brand">Brand</option>
                  </select>
                  <button type="submit" class="btn btn-primary">Search</button>
                </form>
              </div>
            </div>
            <div class="portlet-body">
              <div id="chart_1" style="height:350px;"></div>
            </div>
          </div>
      </div>
    </div>
  </div>
  <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->

<div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Product Information</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:480px" data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green">
                    <div class="container">
                        <div id="description"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn green">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div id="alert" class="modal fade"  tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
          <center><h2></i> <?php echo $stocks_alert;?></h2></center>
      </div>
      <div class="modal-footer">
        <a data-dismiss="modal" class="btn red">Close</a>
        <a class="btn btn-info" href="<?php echo base_url('stocks/index');?>">View</a>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url();?>assets/Chart.js/Chart.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/pages/scripts/charts-amcharts.min.js" type="text/javascript"></script>

<script src="<?php echo base_url();?>assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script type="text/javascript">

function info(id){
    $.ajax({
      url: '<?php echo base_url();?>product/find_by_id/'+id,
      type: 'post',
      dataType: 'json',
      success:function(response){
        $('#description').html('<br><br>'+response.description);
        } 
    });
}
</script>

<script type="text/javascript">
  var table;
  jQuery(document).ready(function() {

  table=$('#product_analytics').DataTable({
    'order' : [],
    'ajax' : {
      url : '<?php echo base_url();?>dashboard/analytics'
    }
  });
});
</script>
<script type="text/javascript">

    $(document).ready(function() {
      $("#reportNav").addClass('active');
      if(<?php echo (!empty($stocks_alert))?'true':'false';?>){ $('#alert').modal('show'); }
      if(<?php echo (!empty($decision_alert))?'true':'false';?>){ $('#decision_alert').modal('show'); }
    }); 

    var report_data = [<?php echo implode(',', $total_sales);?>];
    

    $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
     var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],

      datasets: [
        {
          label               : 'Sales',
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
      legendTemplate          : '',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  })
</script>
<script type="text/javascript">
  var ChartsAmcharts = function() {
    var initChartSample1 = function() {
        var chart = AmCharts.makeChart("chart_1", {
            "type": "pie",
            "theme": "light",

            "fontFamily": 'Open Sans',
            
            "color":    '#888',

            "dataProvider": [
            <?php foreach ($pie2 as $key => $value):?>
               {"label": "<?php echo $key;?>", "value": <?php echo $value;?>},
            <?php endforeach;?>],
            "valueField": "value",
            "titleField": "label",
            "exportConfig": {
                menuItems: [{
                    icon: App.getGlobalPluginsPath() + "amcharts/amcharts/images/export.png",
                    format: 'png'
                }]
            }
        });

        $('#chart_1').closest('.portlet').find('.fullscreen').click(function() {
            chart.invalidateSize();
        });
    }
    var initChartSample2 = function() {
        <?php 
          $income=0;$invoice=0;$amount=0;$vat=0;
          foreach($pie as $key => $values) {
              $invoice += $values[ 'total_invoice' ];
              $income += $values[ 'total_income' ];
              $amount += $values[ 'total_amount' ];
              $vat += $values[ 'total_vat' ];
          }
        ?>
        var chart = AmCharts.makeChart("chart_2", {
            "type": "pie",
            "theme": "light",

            "fontFamily": 'Open Sans',
            
            "color":    '#888',

            "dataProvider": [
              {label: "Total Sales", value: <?php echo $amount;?>},
              {label: "Income", value: <?php echo $income;?>},
              {label: "Value Added Tax", value: <?php echo $vat;?>}
            ],
            "valueField": "value",
            "titleField": "label",
            "exportConfig": {
                menuItems: [{
                    icon: App.getGlobalPluginsPath() + "amcharts/amcharts/images/export.png",
                    format: 'png'
                }]
            }
        });

        $('#chart_2').closest('.portlet').find('.fullscreen').click(function() {
            chart.invalidateSize();
        });
    }
    
    return {
        //main function to initiate the module

        init: function() {
            initChartSample1();
            initChartSample2();
        }

    };

}();

jQuery(document).ready(function() {    
   ChartsAmcharts.init(); 
});
</script>