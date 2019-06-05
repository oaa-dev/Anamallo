<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
  <!-- BEGIN CONTENT BODY -->
  <div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h1 class="page-title"> Detailed Sales Report
      <small>sales report of the items</small>
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
                          <select class="form-control select2" id="cbocategory">
                              <option value="no_selected" selected>Select Category</option>
                              <?php foreach ($category_list as $key => $value):?>
                              <option style="text-transform: capitalize;" value="<?php echo $value['id'];?>"><?php echo $value['category'];?></option>
                              <?php endforeach?>
                          </select>
                        </div>
                      </div>
                      <div class="btn-group margin-top-10">
                        <div class="select2-bootstrap-prepend">
                          <select class="form-control select2" id="cbosupplier">
                              <option value="no_selected" selected>Select Supplier</option>
                              <?php foreach ($supplier_list as $key => $value):?>
                              <option style="text-transform: capitalize;" value="<?php echo $value['id'];?>"><?php echo $value['supplier'];?></option>
                              <?php endforeach?>
                          </select>
                        </div>
                      </div>
                      <div class="form-inline">
                        <input type="number" style="width: 10em" class="form-control margin-top-10" name="" id="from_price" placeholder="from price">
                        <input type="number" style="width: 10em" class="form-control margin-top-10" name="" id="to_price" placeholder="to price">
                      </div>
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
                      <th class="sorting" style="width: 20px;"> Or Number </th>
                      <th class="sorting" style="width: 200px;"> Product </th>
                      <th class="sorting" style="width: 20px;"> Price </th>
                      <th class="sorting" style="width: 20px;"> Quantity </th>
                      <th class="sorting" style="width: 20px;"> Total </th>
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
        <h4 class="modal-title"><i class="fa fa-shopping-cart"></i> Invoice Details</h4> 
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

  $(document).ready(function(){
    view();

    $('#range_search').on('click', function () {
      var from=$('#from').val();
      var to=$('#to').val();
      var category=$('#cbocategory').val();
      var product=$('#cboproduct').val();
      var supplier=$('#cbosupplier').val();
      var from_price=$('#from_price').val();
      var to_price=$('#to_price').val();

      if(from=='' && to==''){from="na";to="na";}
      if(product=='no_selected'){product="na";}
      if(category=='no_selected'){category="na";}
      if(supplier=='no_selected'){supplier="na";}
      if(from_price=='' && to_price==''){from_price="na";to_price="na";}

      manageTable.destroy();
      manageTable = $('#manageTable').DataTable({
        'order': [],
        'ajax': {
          url:'<?php echo base_url();?>invoice/get_detailed_invoice/'+from+'/'+to+'/'+category+'/'+product+"/"+supplier+"/"+from_price+"/"+to_price
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
      responsive:!0,order:[[0,"desc"]],
      lengthMenu:[[5,10,15,20,-1],[5,10,15,20,"All"]],
      pageLength:10
      });
    });
  });

  function view(){
    manageTable = $('#manageTable').DataTable({
      'order': [],
      'ajax': {
        url:'<?php echo base_url();?>invoice/get_detailed_invoice'
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
      responsive:!0,order:[[0,"desc"]],
      lengthMenu:[[5,10,15,20,-1],[5,10,15,20,"All"]],
      pageLength:10
    });
    
  }

</script>