
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h1 class="page-title"> Product Brand
            <small>list of product brands</small>
        </h1>
        <div class="page-bar">
          <ul class="page-breadcrumb">
              <li>
                  <i class="icon-home"></i>
                  <a href="<?php echo base_url('dashboard');?>">Dashboard</a>
                  <i class="fa fa-angle-right"></i>
              </li>
              <li><span>Brand</span></li>
          </ul>
        </div>
        <!-- END PAGE HEADER-->
        <div class="row">
          <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
              <div class="portlet-title">
                <div class="col-md-6 caption font-dark">
                  <i class="fa fa-tags"></i>
                  <span class="caption-subject bold uppercase"> Manage Brands</span>
                </div>
                <div class="col-md-6">
                  <?php if(in_array('createBrand', $user_permission)):?>
                    <div class="btn-group pull-right">
                      <button class="btn sbold green" data-toggle="modal" data-target="#addModal" title="Create new brand"> Add New
                        <i class="fa fa-plus"></i>
                      </button>
                    </div>
                  <?php endif;?>
                </div>
              </div>
              <div id="messages"></div>
              <div class="portlet-body">
                <div id="sample_1_wrapper" class="dataTables_wrapper no-footer">
                  <div class="table">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="manageTable" role="grid" aria-describedby="sample_1_info">
                      <thead>
                        <tr role="row">
                          <th class="sorting" style="width: 200px;"> Brand Name </th>
                          <th class="sorting" style="width: 100px;"> Status </th>
                          <?php if(in_array('updateBrand', $user_permission)):?>
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


<?php if(in_array('createBrand', $user_permission)):?>
<div id="addModal" class="modal fade"  tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Brand</h4> 
      </div>
      <form method="post" id="form_add" action="<?php echo base_url('brand/insert');?>" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
              <label class="control-label">Brand *</label>
              <input type="text" class="form-control" name="brand" autocomplete="off" placeholder="Brand" required>
            </div>
            <div class="form-group">
              <label class="control-label">Status</label>
              <select class="form-control" name="status" required>
                <option value="1" selected>Active</option>
                <option value="2">Inactive</option>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button data-dismiss="modal" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</button>
          <button class="btn btn btn-success"><i class="fa fa-save"></i>Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif;?>

<?php if(in_array('updateBrand', $user_permission)):?>
<div id="editModal" class="modal fade" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Brand</h4> 
      </div>
      <form method="post" id="form_edit" action="<?php echo base_url('brand/update');?>" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
              <label class="control-label">Brand *</label>
              <input type="text" class="form-control" name="brand" id="brand" placeholder="Brand" autocomplete="off" required>
            </div>
            <div class="form-group">
              <label class="control-label">Status</label>
              <select class="form-control" name="status" id="status" required>
                <option value="1" selected>Active</option>
                <option value="2">Inactive</option>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button data-dismiss="modal" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</button>
          <button class="btn btn btn-success"><i class="fa fa-save"></i>Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif;?>

<script type="text/javascript">
  var manageTable;

  $(document).ready(function(){
    manageTable = $('#manageTable').DataTable({
      'order': [],
      'ajax': {
        url:'<?php echo base_url();?>brand/find_all'
      }
    });

    <?php if(in_array('createBrand', $user_permission)):?>
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
    <?php endif;?>
  });


  <?php if(in_array('updateBrand', $user_permission)):?>
  function edit(id){
    $.ajax({
      url: 'brand/find_by_id/'+id,
      type: 'post',
      dataType: 'json',
      success:function(response){
        $('#brand').val(response.brand);
        $('#status').val(response.status);
      
        $('#form_edit').unbind('submit').bind('submit', function() {
          var form=$(this);
          $('.text-danger').remove();

          $.ajax({
            url: form.attr('action') + '/' + id,
            type: form.attr('method'),
            data: form.serialize(),
            dataType: 'json',
            success:function(response){
              manageTable.ajax.reload(null, false);

              if(response.success === true){
                $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                '</div>');

                $('#editModal').modal('hide');
                $('#form_edit')[0].reset();
              }
            }
          });
          return false;
        });
      }
    });
  }
  <?php endif;?>

</script>