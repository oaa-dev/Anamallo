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
              <a href="<?php echo base_url('product');?>">Dashboard</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <a href="<?php echo base_url('product');?>">Product</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
            <span>Edit</span>
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
              <i class="fa fa-shopping-cart"></i>
              <span class="caption-subject bold uppercase"> Edit Product</span>
            </div>
          </div>
          <form method="post" enctype="multipart/form-data" action="<?php echo base_url()?>product/update/<?php echo $product['id'];?>">
            <div class="portlet-body">
              <div class="form-group">
                <label class="control-label">Images</label>
                <!-- CHANGE AVATAR TAB -->
                <div class="form-group">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                            <img src="<?php echo base_url()?>images/<?php echo isset($product['image'])?$product['image']:'null.jpg';?>" alt=""/> </div>
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
                <input type="text" class="form-control" name="product" value="<?php echo $product['product'];?>" placeholder="Enter product">
                <?php echo form_error('product','<span class="label label-danger">','</span>');?>
              </div>
              <div class="form-group">
                <label class="control-label">Barcode</label>
                <input type="text" class="form-control" name="barcode" value="<?php echo $product['barcode'];?>" readonly>
              </div>
              <div class="form-group">
                <label class="control-label">Brand</label>
                <div class="select2-bootstrap-prepend">
                  <select class="form-control select2" name="brand">
                    <?php foreach($brand as $key => $value):?>
                      <option <?php echo ($product['category_id']==$value['id'])? 'selected':null;?> value="<?php echo $value['id'];?>"><?php echo $value['brand'];?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Category</label>
                <div class="select2-bootstrap-prepend">
                  <select class="form-control select2" name="category">
                    <?php foreach($category as $key => $value):?>
                      <option <?php echo ($product['category_id']==$value['id'])? 'selected':null;?> value="<?php echo $value['id'];?>"><?php echo $value['category'];?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Supplier</label>
                <select name="supplier[]" class="form-control select2-multiple" multiple>
                  <?php foreach($supplier as $key => $value):?>
                    <?php foreach($product_supplier as $key => $prod_supplier):?>
                      <option <?php echo ($prod_supplier['supplier_id']==$value['id'])? 'selected':null;?> value="<?php echo $value['id'];?>"><?php echo $value['supplier'];?></option> 
                    <?php endforeach;?>
                  <?php endforeach;?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Model</label>
                <div class="select2-bootstrap-prepend">
                  <select name="model" class="form-control select2">
                    <?php foreach($model as $key => $value):?>
                      <option <?php echo ($product['model_id']==$value['id'])? 'selected':null;?> value="<?php echo $value['id'];?>"><?php echo $value['model'];?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Descriptions</label>
                <textarea type="text" name="description" id="summernote_1" placeholder="Enter description" autocomplete="off"><?php echo $product['description'];?>
                </textarea>
              </div>
              <div class="form-group">
                <label class="control-label">Availability</label>
                <select class="form-control" name="availability">
                  <option <?php echo ($product['availability']==1)? 'selected':null;?> value="1">Yes</option>
                  <option <?php echo ($product['availability']==2)? 'selected':null;?> value="2">No</option>
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