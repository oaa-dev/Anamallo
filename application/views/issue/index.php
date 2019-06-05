<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
  <!-- BEGIN CONTENT BODY -->
  <div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h1 class="page-title"> Product Reconcile
      <small>list of product issue</small>
    </h1>
    <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url('dashboard');?>">Dashboard</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Reconcile</span>
          </li>
      </ul>
    </div>
    <!-- END PAGE HEADER-->
    <div class="row">
      <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
          <div class="portlet-title">
            <div class="col-md-3 caption font-dark">
              <i class="fa fa-tags"></i>
              <span class="caption-subject bold uppercase"> Reconcile Items</span>
            </div>
          </div>
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
                  dt.ajax.reload();
                }
            }

        ],
        responsive:!0,order:[[1,"desc"]],
        lengthMenu:[[5,10,15,20,-1],[5,10,15,20,"All"]],
        pageLength:10
    });
  });
</script>