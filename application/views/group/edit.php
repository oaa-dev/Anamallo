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
              <a href="<?php echo base_url('group');?>"> Group </a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span> Edit </span>
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
              <i class="fa fa-groups"></i>
              <span class="caption-subject bold uppercase"> Edit Groups</span>
            </div>
          </div>
          <form method="post" id="form_edit" action="<?php echo base_url();?>group/update/<?php echo $permission['id'];?>">
            <div class="portlet-body">
              <div class="form-group">
                <label class="control-label">Group Name *</label>
                <input type="text" class="form-control" value="<?php echo $permission['group_user'];?>" name="group" autocomplete="off" placeholder="Enter group name">
                <?php echo form_error('group','<span class="label label-danger">','</span>');?>
              </div>
              <div class="form-group">
                <label class="control-label">Status</label>
                <select class="form-control" name="status">
                  <option value="1" <?php echo ($permission['status']=='1')?'selected':null;?>>Active</option>
                  <option value="2" <?php echo ($permission['status']=='2')?'selected':null;?>>Inactive</option>
                </select>
              </div>
              <?php $unserial_permission=unserialize($permission['permission']); ?>
              <div class="dataTables_wrapper no-footer">
                <div class="table">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr role="row">
                        <th class="sorting" style="width: 200px;"> Sub-systems </th>
                        <th class="sorting" style="width: 100px;"> Create </th>
                        <th class="sorting" style="width: 100px;"> Update </th>
                        <th class="sorting" style="width: 100px;"> View </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Brands</td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('createBrand',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="createBrand"></td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('updateBrand',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="updateBrand"></td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('viewBrand',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="viewBrand"></td>
                      </tr>
                      <tr>
                        <td>Category</td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('createCategory',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="createCategory"></td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('updateCategory',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="updateCategory"></td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('viewCategory',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="viewCategory"></td>
                      </tr>
                        <td>Model</td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('createModel',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="createModel"></td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('updateModel',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="updateModel"></td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('viewModel',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="viewModel"></td>
                      </tr>
                      <tr>
                        <td>Supplier</td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('createSupplier',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="createSupplier"></td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('updateSupplier',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="updateSupplier"></td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('viewSupplier',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="viewSupplier"></td>
                      </tr>
                      <tr>
                        <td>Can set discount</td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('createDiscount',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="createDiscount"></td>
                        <td>-</td>
                        <td>-</td>
                      </tr>
                      <tr>
                        <td>Product</td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('createProduct',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="createProduct"></td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('updateProduct',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="updateProduct"></td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('viewProduct',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="viewProduct"></td>
                      </tr>
                      <tr>
                        <td>Invoice</td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('createInvoice',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="createInvoice"></td>
                        <td>-</td>
                        <td>-</td>
                      </tr>
                      <tr>
                        <td>Purchase</td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('createPurchase',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="createPurchase"></td>
                        <td>-</td>
                        <td>-</td>
                      </tr>
                      <tr>
                        <td>Group</td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('createGroup',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="createGroup"></td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('updateGroup',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="updateGroup"></td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('viewGroup',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="viewGroup"></td>
                      </tr>
                      <tr>
                        <td>User</td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('createUser',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="createUser"></td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('updateUser',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="updateUser"></td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('viewUser',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="viewUser"></td>
                      </tr>
                      <tr>
                        <td>Report</td>
                        <td>-</td>
                        <td>-</td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('viewReport',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="viewReport"></td>
                      </tr>
                      <tr>
                        <td>Stocks</td>
                        <td>-</td>
                        <td>-</td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('viewStocks',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="viewStocks"></td>
                      </tr>
                      <tr>
                        <td>Reconcile</td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('createIssue',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="createIssue"></td>
                        <td>-</td>
                        <td>-</td>
                      </tr>
                      <tr>
                        <td>Value added Tax / Markup</td>
                        <td>-</td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('updateVat',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="updateVat"></td>
                        <td>-</td>
                      </tr>
                      <tr>
                        <td>Logs</td>
                        <td>-</td>
                        <td>-</td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('viewLogs',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="viewLogs"></td>
                      </tr>
                      <tr>
                        <td>Logs</td>
                        <td><input type="checkbox" <?php echo !empty($unserial_permission)? (in_array('backupDatabase',$unserial_permission)? 'checked':null) :null;?> name="permission[]" value="backupDatabase"></td>
                        <td>-</td>
                        <td>-</td>
                      </tr>
                    </tbody>
                  </table>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                  <a href="<?php echo base_url();?>group" class="btn btn-warning">Back</a>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
      </div>
    </div>
  </div>
  <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->