
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
  <!-- BEGIN CONTENT BODY -->
  <div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h1 class="page-title"> Purchase Report
      <small>statistics, charts, recent events and reports</small>
    </h1>
    <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url('dashboard');?>">Dashboard</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Purchase Report</span>
          </li>
      </ul>
    </div>
    <!-- END PAGE HEADER-->
    
    <div class="row">
      <div class="col-md-12">
        <div class="portlet light bordered">
          <div class="caption font-dark">
            <i class="fa fa-random"></i>
            <span class="caption-subject bold uppercase">Custom Range</span>
          </div>
          <div class="portlet-body form-inline">
            <label class="control-label">From</label>
            <input type="text" id="from" class="input-group form-control form-control-inline date date-picker" autocomplete="off" data-date-format="yyyy-mm-dd">
            <label class="control-label">To</label>
            <input type="text" id="to" class="input-group form-control form-control-inline date date-picker" autocomplete="off" data-date-format="yyyy-mm-dd">
            <button class="btn btn-primary" id="range_search"><i class="fa fa-search"></i> Search</button>
          </div>
        </div>
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
          <div class="portlet-title">
            <div class="col-md-6 caption font-dark">
              <i class="fa fa-tags"></i>
              <span class="caption-subject bold uppercase"> Manage Delivery</span>
            </div>

            <div class="col-md-6">
              <div class="btn-group pull-right">
                <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                  <i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu pull-right">
                  <li>
                    <a href="javascript:window.print();">
                      <i class="fa fa-print"></i> Print </a>
                  </li>
                  <li>
                    <a href="javascript:;">
                      <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                  </li>
                  <li>
                    <a href="javascript:;">
                      <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div id="messages"></div>
          <?php if(!empty($this->session->flashdata('success'))):?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button><strong> <span class="fa fa-check-circle"></span></strong>&emsp;<?php echo $this->session->flashdata('success');?>
          </div>
          <?php endif;?>
          <?php if(!empty($this->session->flashdata('error'))):?>
          <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button><strong> <span class="fa fa-warning"></span></strong>&emsp;<?php echo $this->session->flashdata('error');?>
          </div>
          <?php endif;?>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper no-footer">
              <div class="table">
                <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="manageTable" role="grid" aria-describedby="sample_1_info">
                  <thead>
                    <tr role="row">
                      <th class="sorting" style="width: 100px;"> Date Issued </th>
                      <th class="sorting" style="width: 200px;"> Product </th>
                      <th class="sorting" style="width: 50px;"> Price </th>
                      <th class="sorting" style="width: 50px;"> Quantity </th>
                      <th class="sorting" style="width: 50px;"> Total Price </th>
                      <th class="sorting" style="width: 50px;"> Reason </th>
                      <th class="sorting" style="width: 50px;"> Remarks </th>
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
    manageTable = $('#manageTable').DataTable({
      'order': [],
      'ajax': {
        url:'<?php echo base_url();?>issue/find_issue'
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
        responsive:!0,order:[[1,"desc"]],
        lengthMenu:[[5,10,15,20,-1],[5,10,15,20,"All"]],
        pageLength:10
    });
  });

</script>