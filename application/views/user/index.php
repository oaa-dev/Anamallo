<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
  <!-- BEGIN CONTENT BODY -->
  <div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h1 class="page-title"> Systems User
      <small>list of system users in anamallo corporation </small>
    </h1>
    <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url('dashboard');?>">Dashboard</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>User</span>
          </li>
      </ul>
    </div>
    <!-- END PAGE HEADER-->
    <div class="row">
      <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
          <div class="portlet-title">
            <div class="col-md-6 caption font-dark">
              <i class="fa fa-user"></i>
              <span class="caption-subject bold uppercase"> Manage Users</span>
            </div>
            <div class="col-md-6">
              <?php if(in_array('createUser', $user_permission)):?>
              <div class="btn-group pull-right">
                <a class="btn sbold green" href="<?php echo base_url()?>user/add"> Add New
                  <i class="fa fa-plus"></i>
                </a>
              </div>
              <?php endif?>
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
                      <th class="sorting" style="width: 50px;"> Images </th>
                      <th class="sorting" style="width: 100px;"> Username </th>
                      <th class="sorting" style="width: 100px;"> Name </th>
                      <th class="sorting" style="width: 100px;"> Email </th>
                      <th class="sorting" style="width: 100px;"> Phone </th>
                      <th class="sorting" style="width: 100px;"> Group </th>
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

<script type="text/javascript">
  var manageTable;

  $(document).ready(function(){
    manageTable = $('#manageTable').DataTable({
      'order': [],
      'ajax': {
        url:'<?php echo base_url();?>user/find_all'
      }
    });

    $('#form_add').unbind('submit').on('submit', function() {
      var form = $(this);

      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(),
        dataType: 'json',
        success:function(response) {
          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="fa fa-check-circle"></span> </strong>'+response.messages+
              '</div>');

            // hide the add new modals
            $("#addModal").modal('hide');

            // reset the form
            $("#form_add")[0].reset();
          }
        }
      });
      return false;
    });
  });
</script>