<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
  <!-- BEGIN CONTENT BODY -->
  <div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h1 class="page-title"> Stocks Management
      <small>list of product stocks</small>
    </h1>
    <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url('dashboard');?>">Dashboard</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Stocks</span>
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
              <span class="caption-subject bold uppercase"> Stocks</span>
            </div>
            <div class="col-md-5">
              <div class="btn-group">
                  <button class="btn green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-filter"></i> Search Filter
                      <i class="fa fa-angle-down"></i>
                  </button>
                  <div class="dropdown-menu dropdown-content input-large hold-on-click" role="menu">
                    <div class="input-group">
                      <select class="form-control margin-top-10" id="view_by">
                        <option value="all">View all stocks</option>
                        <option value="low">Low stocks</option>
                        <option value="out">Out of stocks</option>
                      </select>
                      <div class="btn-group margin-top-10">
                        <div class="select2-bootstrap-prepend">
                          <select class="form-control select2" id="cboproduct">
                              <option value="no_selected" selected>Select Product</option>
                              <?php foreach ($product_list as $key => $value):?>
                              <option style="text-transform: capitalize;" value="<?php echo $value['id'];?>"><?php echo $value['product'];?></option>
                              <?php endforeach;?>
                          </select>
                        </div>
                      </div>
                      <div class="btn-group margin-top-10">
                        <div class="select2-bootstrap-prepend">
                          <select class="form-control select2" id="cbobrand">
                              <option value="no_selected" selected>Select Brand</option>
                              <?php foreach ($brand_list as $key => $value):?>
                              <option style="text-transform: capitalize;" value="<?php echo $value['id'];?>"><?php echo $value['brand'];?></option>
                              <?php endforeach;?>
                          </select>
                        </div>
                      </div>
                      <div class="btn-group margin-top-10">
                        <div class="select2-bootstrap-prepend">
                          <select class="form-control select2" id="cbocategory">
                              <option value="no_selected" selected>Select Category</option>
                              <?php foreach ($category_list as $key => $value):?>
                              <option style="text-transform: capitalize;" value="<?php echo $value['id'];?>"><?php echo $value['category'];?></option>
                              <?php endforeach?>
                          </select>
                        </div>
                      </div>
                      <button class="btn btn-primary margin-top-10" id="range_search"><i class="fa fa-search"></i>Search</button>
                    </div>
                  </div>
              </div>
              <button class="btn btn-primary" id="refresh"><i class="fa fa-search"></i>Refresh</button>
            </div>
          </div>
          <div id="messages"></div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper no-footer">
              <div class="table">
                <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="manageTable" role="grid" aria-describedby="sample_1_info">
                  <thead>
                    <tr role="row">
                      <th class="sorting" style="width: 100px;"> Barcode </th>
                      <th class="sorting" style="width: 200px;"> Product </th>
                      <th class="sorting" style="width: 50px;"> Price </th>
                      <th class="sorting" style="width: 50px;"> Quantity </th>
                      <th class="sorting" style="width: 50px;"> Total Price </th>
                      <?php if(in_array('createIssue', $user_permission)):?>
                      <th class="sorting" style="width: 50px;"> Action </th>
                    <?php endif?>
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
<div id="addModal" class="modal fade bs-modal-sm" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><i class="fa fa-database"></i> Stocks</h4> 
      </div>
      <form method="post" id="form_add" action="<?php echo base_url();?>issue/insert" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label class="label-control">Stocks</label>
            <input type="hidden" id="product_id" name="product_id">
            <input class="form-control" id="stocks" type="text" readonly>
          </div>
          <div class="form-group">
            <label class="label-control">Price</label>
            <input class="form-control" id="price" type="text" name="price" readonly>
          </div>
          <div class="form-group">
            <label class="label-control">Quantity</label><span class="label label-danger" id="errqty"></span>
            <input class="form-control" id="quantity" type="number" name="quantity" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label class="label-control">Total Price</label>
            <input class="form-control" id="total" type="text" name="total" placeholder="00.00" readonly>
          </div>
          <div class="form-group">
            <label class="label-control">Reason</label>
            <select class="form-control" name="reason">
              <option>Broken</option>
              <option>Lost</option>
            </select>  
          </div>
          <div class="form-group">
            <label class="label-control">Remarks</label>
            <textarea class="form-control" name="remarks"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <a data-dismiss="modal" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>
          <button class="btn btn-success" id="btnsave"><i class="fa fa-save"></i> Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  var manageTable;

  $(document).ready(function(){
    view();

    $('#range_search').on('click', function(){
      manageTable.destroy();
      var stat=$('#view_by').val();
      var product=$('#cboproduct').val();
      var brand=$('#cbobrand').val();
      var category=$('#cbocategory').val();
      
      if(brand=='no_selected'){ brand='na';}
      if(product=='no_selected'){ product='na';}
      if(category=='no_selected'){ category='na';}
      alert(category+""+stat+""+product+""+brand);

      manageTable = $('#manageTable').DataTable({
        'order': [],
        'ajax': {
          url:'<?php echo base_url();?>stocks/find_details/'+stat+'/'+product+'/'+brand+'/'+category
        }
      });
    });

    $('#refresh').on('click', function(){
      manageTable.destroy();
      view();
    });

    $('#form_add').unbind('submit').on('submit',function(){
      var form=$(this);

      $.ajax({
        url:form.attr('action'),
        type:form.attr('method'),
        data:form.serialize(),
        dataType:'json',
        success:function(response){
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

    $('#quantity').on('keyup', function(){
      var quantity = parseInt($(this).val());
      var stocks = parseInt($('#stocks').val());
      if(quantity <= stocks){
        $('#errqty').text('');
        var price = $('#price').val();
        var total = parseFloat(price*quantity);
        $('#total').val(total);
      }if(quantity > stocks){
        $('#errqty').text("Oops! the available quantity is "+stocks);
      }
    });
  });

  function view(){
    manageTable = $('#manageTable').DataTable({
      'order': [],
      'ajax': {
        url:'<?php echo base_url();?>stocks/find_details/all'
      }
    });
  }
  function issue(id){
    $.ajax({
      url:'<?php echo base_url()?>product/find_by_id/'+id,
      data:'POST',
      dataType:'json',
      success:function(response){
        $('#product_id').val(response.id);
        $('#stocks').val(response.stocks);
        $('#price').val(response.selling_price);
        $('#quantity').attr({'max':response.stocks});
        
        if(response.stocks==0){
          $('#quantity').attr({'disabled':true,'placeholder':'Out of Stocks'});
          $('#btnsave').hide();
        }else{
          $('#quantity').attr({'disabled':false,'placeholder':'0'});
          $('#btnsave').show();
        }
      }
    });
  }
</script>