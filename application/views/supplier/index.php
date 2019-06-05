<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
  <!-- BEGIN CONTENT BODY -->
  <div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h1 class="page-title"> Product Supplier
      <small> supplier of the products</small>
    </h1>
    <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url('dashboard');?>">Dashboard</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Supplier</span>
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
              <i class="fa fa-truck"></i>
              <span class="caption-subject bold uppercase"> Manage Supplier</span>
            </div>
            <div class="col-md-6">
              <div class="btn-group pull-right">
                  <?php if(in_array('createSupplier', $user_permission)):?>
                  <div class="btn-group">
                    <button class="btn sbold green" data-toggle="modal" data-target="#addModal"> Add New
                      <i class="fa fa-plus"></i>
                    </button>
                  </div>
                <?php endif;?>
              </div>
            </div>
          </div>
          <div id="messages"></div>
          <div class="portlet-body">
            <div class="table-toolbar">
              <div class="row">
                <div class="col-md-6">
                </div>
              </div>
            </div>
            <div id="sample_1_wrapper" class="dataTables_wrapper no-footer">
              <div class="table">
                <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="manageTable" role="grid" aria-describedby="sample_1_info">
                  <thead>
                    <tr role="row">
                      <th class="sorting" style="width: 200px;"> Supplier Name </th>
                      <th class="sorting" style="width: 50px;"> Contact </th>
                      <th class="sorting" style="width: 50px;"> Email </th>
                      <th class="sorting" style="width: 10px;"> Status </th>
                    <?php if(in_array('updateSupplier', $user_permission)||in_array('deleteSupplier', $user_permission)):?>
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

<?php if(in_array('createSupplier', $user_permission)):?>
<div id="addModal" class="modal fade" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Supplier</h4> 
      </div>
      <form method="post" id="form_add" action="<?php echo base_url();?>supplier/insert" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
              <label class="control-label">Supplier *</label>
              <input type="text" class="form-control" name="supplier" autocomplete="off" placeholder="Supplier Name" required>
            </div>
            <div class="form-group">
              <label class="control-label">Address *</label>
              <input type="text" class="form-control" name="address" autocomplete="off" placeholder="Address" required>
            </div>
            <div class="form-group">
              <label class="control-label">Contact *</label>
              <input type="text" class="form-control" name="contact" autocomplete="off" placeholder="Contact Number" required>
            </div>
            <div class="form-group">
              <label class="control-label">Email *</label>
              <input type="text" class="form-control" name="email" autocomplete="off" placeholder="Email" required>
            </div>
            <div class="form-group">
              <label class="control-label">Status *</label>
              <select class="form-control" name="status" required>
                <option value="1" selected>Active</option>
                <option value="2">Inactive</option>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button data-dismiss="modal" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</button>
          <button class="btn btn-success"><i class="fa fa-save"></i> Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif;?>

<?php if(in_array('updateSupplier', $user_permission)):?>
<div id="editModal" class="modal fade" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Supplier</h4> 
      </div>
      <form method="post" id="form_edit" action="<?php echo base_url();?>supplier/update" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <span class="control-label">Supplier *</span>
            <input type="text" class="form-control" name="supplier" id="supplier" required>
          </div>
          <div class="form-group">
            <span class="control-label">Address *</span>
            <input type="text" class="form-control" name="address" id="address" required>
          </div>
          <div class="form-group">
            <span class="control-label">Contact *</span>
            <input type="text" class="form-control" name="contact" id="contact" required>
          </div>
          <div class="form-group">
            <span class="control-label">Email *</span>
            <input type="email" class="form-control" name="email" id="email" required>
          </div>
          <div class="form-group">
            <span class="control-label">Status *</span>
            <select class="form-control" name="status" id="status" required>
              <option value="1" selected>Active</option>
              <option value="2">Inactive</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button data-dismiss="modal" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</button>
          <button class="btn btn-success"><i class="fa fa-save"></i> Save changes</button>
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
        url:'<?php echo base_url();?>supplier/find_all'
      }
    });

    <?php if(in_array('createSupplier', $user_permission)):?>
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


  <?php if(in_array('updateSupplier', $user_permission)):?>
    function edit(id){
      $.ajax({
        url: 'supplier/find_by_id/'+id,
        type: 'post',
        dataType: 'json',
        success:function(response){
          $('#supplier').val(response.supplier);
          $('#address').val(response.address);
          $('#contact').val(response.contact);
          $('#email').val(response.email);
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