<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
  <!-- BEGIN CONTENT BODY -->
  <div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h1 class="page-title"> Anamallo Products
      <small> products of anamallo corporation</small>
    </h1>
    <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url('dashboard');?>">Dashboard</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Product</span>
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
              <i class="fa fa-shopping-cart"></i>
              <span class="caption-subject bold uppercase"> Manage Product</span>
            </div>
            <div class="col-md-6">
              <?php if(in_array('createProduct', $user_permission)):?>
                <div class="btn-group pull-right">
                  <a href="<?php echo base_url('product/add');?>" class="btn sbold green"> Add New
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
              </button><strong> <span class="fa fa-check-circle"></span></strong>&emsp;
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php endif;?>
          <?php if(!empty($this->session->flashdata('error'))):?>
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button><strong> <span class="fa fa-times-circle"></span></strong>&emsp;
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php endif;?>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper no-footer">
              <div class="table">
                <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="manageTable" role="grid" aria-describedby="sample_1_info">
                  <thead>
                    <tr role="row">
                      <th class="sorting" style="width: 10px;"> Image </th>
                      <th class="sorting" style="width: 10px;"> Barcode </th>
                      <th class="sorting" style="width: 100px;"> Product </th>
                      <th class="sorting" style="width: 10px;"> Price </th>
                      <th class="sorting" style="width: 10px;"> Brand </th>
                      <th class="sorting" style="width: 10px;"> Availability </th>
                      <?php if(in_array('updateProduct', $user_permission)||
                              in_array('updateProduct', $user_permission)):?>
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

<div id="updatePrice" class="modal fade bs-modal-sm"  tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><i class="fa fa-pencil"></i> Update Price</h4> 
      </div>
      <form method="post" id="form_add" action="<?php echo base_url('product/insert_price');?>" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="product_id" id="product_id">
            <label class="control-label">Manufacturer Price *</label>
            <input type="number" class="form-control" id="manufacturer_price" name="manufacturer_price" step="0.01" pattern="[0-9]+([\.,][0-9]+)?" title="This should be a number with up to 2 decimal places." required autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label">Selling Price *</label>
            <input type="number" class="form-control" id="selling_price" name="selling_price" step="0.01" pattern="[0-9]+([\.,][0-9]+)?" title="This should be a number with up to 2 decimal places." required autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label">Date Implement</label>
            <input type="text" class="input-group form-control form-control-inline date date-picker" autocomplete="off" name="date_implement" data-date-format="yyyy-mm-dd">
          </div>
          <div class="form-group">
            <label class="control-label">Password *</label>
            <input type="password" class="form-control" id="password" name="password" autocomplete="off">
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

<script type="text/javascript">
  var manageTable;

  $(document).ready(function(){
    manageTable = $('#manageTable').DataTable({
      'order': [],
      'ajax': {
        url:'<?php echo base_url();?>product/find_all'
      }
    });

    $('#manufacturer_price').on('keyup', function(){
      var price=parseFloat($(this).val());
      var markup=price*(parseFloat(<?php echo $markup;?>)/100);
      var total=parseFloat(price)+parseFloat(markup);
      $('#selling_price').attr('placeholder',total.toFixed(2));
    });
  });


  function edit(id){
    $.ajax({
      url: 'product/find_by_id/'+id,
      type: 'post',
      dataType: 'json',
      success:function(response){
        $('#product_id').val(response.id);
        $('#manufacturer_price').val(response.manufacturer_price);
        $('#selling_price').val(response.selling_price);
      
        $('#form_add').unbind('submit').bind('submit', function() {
          var form=$(this);
          $.ajax({
            url: form.attr('action') + '/' + id,
            type: form.attr('method'),
            data: form.serialize(),
            dataType: 'json',
            success:function(response){
              manageTable.ajax.reload(null, false); 

              if(response.success === true) {
                $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="fa fa-check-circle"></span> </strong>'+response.messages+
                  '</div>');
                // hide the add new modals
                $("#updatePrice").modal('hide');

                // reset the form
                $("#form_add")[0].reset();
              }else{
                $("#messages").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                    '<strong> <span class="fa fa-warning"></span> </strong>'+response.messages+
                    '</div>');
                // hide the add new modals
                $("#updatePrice").modal('hide');
                
                // reset the form
                $("#form_add")[0].reset();  
              }
            }
          });
          return false;
        });
      }
    });
  }
</script>