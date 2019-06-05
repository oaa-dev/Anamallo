
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
  <!-- BEGIN CONTENT BODY -->
  <div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h1 class="page-title"> Purchase Report
      <small>list of purchase transaction</small>
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
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
          <div class="portlet-title">
            <div class="caption font-dark">
              <i class="fa fa-tags"></i>
              <span class="caption-subject bold uppercase"> Purchase Report</span>
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
                      <th class="sorting" style="width: 100px;"> OR Number </th>
                      <th class="sorting" style="width: 50px;"> Date </th>
                      <th class="sorting" style="width: 100px;"> Supplier </th>
                      <th class="sorting" style="width: 1px;"> Quantity </th>
                      <th class="sorting" style="width: 1px;"> Price </th>
                        <th style="width: 10px;"> Actions </th>
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

<div id="detailsModal" class="modal fade bs-lg in" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><i class="fa fa-shopping-truck"></i> Purchase Details</h4> 
      </div>
      <div class="modal-body">
        <div  class="scroller" style="height:300px" data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green">
          <div class="table">
            <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="manageDetails" role="grid" aria-describedby="sample_1_info">
              <thead>
                <tr role="row">
                  <th class="sorting" style="width: 100px;"> Barcode </th>
                  <th class="sorting" style="width: 200px;"> Product </th>
                  <th class="sorting" style="width: 100px;"> Price </th>
                  <th class="sorting" style="width: 100px;"> Quantity </th>
                  <th class="sorting" style="width: 100px;"> Total </th>
                </tr>
              </thead>
              <tbody> 
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-danger"><i class="fa fa-times"></i> Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var manageTable;
  var manageDetails;

  $(document).ready(function(){
    view();

    $('#range_search').on('click', function () {
      manageTable.destroy();

      var from=$('#from').val();
      var to=$('#to').val();
      manageTable = $('#manageTable').DataTable({
        'order': [],
        'ajax': {
          url:'<?php echo base_url();?>purchase/find_purchase/'+from+'/'+to
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
  });

  function details(id){
    manageDetails=$('#manageDetails').DataTable({
      'order': [],
      'ajax': {
        url:'<?php echo base_url();?>purchase/find_purchase_details/'+id
      }
    });
    manageDetails.destroy();
  }

  function view(){
    manageTable = $('#manageTable').DataTable({
      'order': [],
      'ajax': {
        url:'<?php echo base_url();?>purchase/find_purchase'
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
  }

</script>