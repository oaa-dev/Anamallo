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
              <a href="<?php echo base_url('product');?>">Product</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Add</span>
          </li>
      </ul>
    </div>
    <!-- END PAGE HEADER-->
    <div class="row">
      <div class="col-md-12">
        <?php if(!empty($this->session->flashdata('error'))):?>
        <div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
          </button><strong> <span class="fa fa-warning"></span></strong>&emsp;<?php echo $this->session->flashdata('error');?>
        </div>
        <?php endif;?>
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
          <div class="portlet-title">
            <div class="caption font-dark">
              <i class="fa fa-shopping-cart"></i>
              <span class="caption-subject bold uppercase"> Add Product</span>
            </div>
          </div>
          <form method="post" id="form_add" enctype="multipart/form-data" action="<?php echo base_url()?>product/insert">
            <div class="portlet-body">
              <div class="form-group">
                <label class="control-label">Images *</label>
                <!-- CHANGE AVATAR TAB -->
                <div class="form-group">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                            <img src="<?php echo base_url()?>/images/null.jpg" alt=""/> </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                        <div>
                            <span class="btn btn-primary btn-file">
                                <span class="fileinput-new"> Select image </span>
                                <span class="fileinput-exists"> Change </span>
                                <input type="file" name="product_image" > </span>
                            <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                        </div>
                    </div>
                </div>
                <!-- END CHANGE AVATAR TAB -->
              </div><hr>
              <div class="form-group">
                <label class="control-label">Product *</label>
                <input type="text" class="form-control" name="product" placeholder="Enter product" autocomplete="off">
                <?php echo form_error('product','<span class="label label-danger">','</span>');?>
              </div>
              <div class="form-group">
                <label class="control-label">Barcode *</label>
                <input type="text" class="form-control" name="barcode" placeholder="Enter barcode" autocomplete="off">
                <?php echo form_error('barcode','<span class="label label-danger">','</span>');?>
              </div>
              <div class="form-group">
                <label class="control-label">Brand</label>
                <div class="select2-bootstrap-prepend">
                  <select name="brand" class="form-control select2">
                    <?php foreach($brand as $key => $value):?>
                      <option value="<?php echo $value['id'];?>"><?php echo $value['brand'];?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Category</label>
                <div class="select2-bootstrap-prepend">
                  <select name="category" class="form-control select2">
                    <?php foreach($category as $key => $value):?>
                      <option value="<?php echo $value['id'];?>"><?php echo $value['category'];?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Supplier</label>
                <select name="supplier[]" class="form-control select2-multiple" multiple>
                  <?php foreach($supplier as $key => $value):?>
                    <option value="<?php echo $value['id'];?>"><?php echo $value['supplier'];?></option>
                  <?php endforeach;?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Model</label>
                  <div class="select2-bootstrap-prepend">
                    <select class="form-control select2" id="model" name="model">
                      <?php foreach($model as $key => $value):?>
                        <option value="<?php echo $value['id'];?>"><?php echo $value['model'];?></option>
                      <?php endforeach;?>
                    </select>
                  </div>
              </div>
              <div class="form-group">
                <label class="control-label">Manufacturer Price *</label>
                <input type="number" class="form-control" id="manufacturer_price" name="manufacturer_price" step="0.01" pattern="[0-9]+([\.,][0-9]+)?" title="This should be a number with up to 2 decimal places." autocomplete="off"> 
                <?php echo form_error('manufacturer_price','<span class="label label-danger">','</span>');?>
              </div>
              <div class="form-group">
                <label class="control-label">Selling Price *</label>
                <input type="number" class="form-control" id="selling_price" name="selling_price" step="0.01" pattern="[0-9]+([\.,][0-9]+)?" title="This should be a number with up to 2 decimal places." autocomplete="off">
                <?php echo form_error('selling_price','<span class="label label-danger">','</span>');?>
              </div>
              <div class="form-group">
                <label class="control-label">Descriptions</label>
                <textarea type="text" name="description" id="summernote_1" placeholder="Enter description" autocomplete="off">
                </textarea>
              </div>
              <div class="form-group">
                <label class="control-label">Minimum Quantity *</label>
                <input type="number" class="form-control" name="minimum_quantity" placeholder="00" autocomplete="off">
                <?php echo form_error('minimum_quantity','<span class="label label-danger">','</span>');?>
              </div>
              <div class="form-group">
                <label class="control-label">Availability</label>
                <select class="form-control" name="availability">
                  <option value="1">Yes</option>
                  <option value="2">No</option>
                </select>
              </div>
              <div class="form-group">
                <button class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('product');?>" class="btn btn-warning">Back</a>
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

<script type="text/javascript">
  
  $(document).ready(function(){
    $('#manufacturer_price').on('keyup', function(){
      var price=parseFloat($(this).val());
      var markup=price*(parseFloat(<?php echo $markup;?>)/100);
      var total=parseFloat(price)+parseFloat(markup);
      $('#selling_price').attr('placeholder',total.toFixed(2));
    });
  });
  </script>