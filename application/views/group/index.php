<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
  <!-- BEGIN CONTENT BODY -->
  <div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h1 class="page-title"> User Group
      <small> list of system users</small>
    </h1>
    <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url('dashboard');?>">Dashboard</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Group</span>
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
              <i class="fa fa-users"></i>
              <span class="caption-subject bold uppercase"> Manage Groups</span>
            </div>
            <div class="col-md-6">
              <?php if(in_array('createGroup', $user_permission)):?>
              <div class="btn-group pull-right">
                <a class="btn sbold green" href="<?php echo base_url();?>group/add"> Add New
                  <i class="fa fa-plus"></i>
                </a>
              </div>
              <?php endif;?>
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
                      <th class="sorting" style="width: 200px;"> Group </th>
                      <th class="sorting" style="width: 100px;"> Status </th>
                      <?php if(in_array('updateGroup', $user_permission) || in_array('deleteGroup', $user_permission)):?>
                        <th style="width: 10px;"> Actions </th>
                      <?php endif;?>
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
        url:'<?php echo base_url();?>group/find_all'
      }
    });
  });
</script>