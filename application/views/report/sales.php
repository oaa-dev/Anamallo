<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
  <!-- BEGIN CONTENT BODY -->
  <div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h1 class="page-title"> Sales Report
      <small>list of sales</small>
    </h1>
    <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url('dashboard');?>">Dashboard</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Sales Report</span>
          </li>
      </ul>
    </div>
    <!-- END PAGE HEADER-->
    <div class="row">
      <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
          <div class="portlet-title">
            <div class="caption font-dark">
              <i class="fa fa-money"></i>
              <span class="caption-subject bold uppercase">Sales Information</span>
            </div>
            <div class="col-md-5">
              <div class="btn-group">
                  <button class="btn dark btn-outline dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-filter"></i> Search Filter
                      <i class="fa fa-angle-down"></i>
                  </button>
                  <div class="dropdown-menu dropdown-content input-large hold-on-click" role="menu">
                    <div class="input-group">
                      <input type="text" id="from" class="input-group form-control form-control-inline date date-picker margin-top-10" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="from...">
                      <input type="text" id="to" class="input-group form-control form-control-inline date date-picker margin-top-10" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="to..."> 
                      <button class="btn btn-primary margin-top-10" id="range_search"><i class="fa fa-search"></i>Search</button>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper no-footer">
              <div class="table">
                <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="manageTable" role="grid" aria-describedby="sample_1_info">
                  <thead>
                    <tr role="row">
                      <th class="sorting" style="width: 80px;"> Date </th>
                      <th class="sorting" style="width: 80px;"> Total Order </th>
                      <th class="sorting" style="width: 100px;"> Gross Income </th>
                      <th class="sorting" style="width: 100px;"> Value Added Tax </th>
                      <th class="sorting" style="width: 100px;"> Net Income </th>
                    </tr>
                  </thead>
                  <tbody> 
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
      </div>
    </div>
  </div>
  <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->

<script type="text/javascript">
  var manageTable;

  $(document).ready(function(){
    view();

    $('#range_search').on('click', function () {
      manageTable.destroy();

      var from=$('#from').val();
      var to=$('#to').val();
      manageTable = $('#manageTable').DataTable({
      'order': [],
      'ajax': {
        url:'<?php echo base_url();?>report/get_sales/'+from+'/'+to
      },
      "dom": 'Bfrtip',
      "buttons":
      [
          {extend:"print",className:"btn dark btn-outline"},
          {extend:"pdf",className:"btn green btn-outline"},
          {extend:"excel",className:"btn yellow btn-outline "},
          {
              text: 'Reload',
              className: 'btn green btn-outline',
              action: function ( e, dt, node, config ) {
                manageTable.destroy();
                view();
              }
          }

      ],
      responsive:!0,order:[[0,"asc"]],
      lengthMenu:[[5,10,15,20,-1],[5,10,15,20,"All"]],
      pageLength:10
      });
    });
  });

  function view(){
    manageTable = $('#manageTable').DataTable({
      'order': [],
      'ajax': {
        url:'<?php echo base_url();?>report/get_sales'
      },
      "dom": 'Bfrtip',
      "buttons":
      [
          {extend:"print",className:"btn dark btn-outline"},
          {extend:"pdf",className:"btn green btn-outline"},
          {extend:"excel",className:"btn yellow btn-outline "},
          {
              text: 'Reload',
              className: 'btn green btn-outline',
              action: function ( e, dt, node, config ) {
                manageTable.destroy();
                view();
              }
          }

      ],
      responsive:!0,order:[[0,"asc"]],
      lengthMenu:[[5,10,15,20,-1],[5,10,15,20,"All"]],
      pageLength:10
    });
  }
</script>