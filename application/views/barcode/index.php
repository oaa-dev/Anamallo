
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h1 class="page-title"> Barcode
            <small>generates barcode for product</small>
        </h1>
        <div class="page-bar">
          <ul class="page-breadcrumb">
              <li>
                  <i class="icon-home"></i>
                  <a href="<?php echo base_url('dashboard');?>">Dashboard</a>
                  <i class="fa fa-angle-right"></i>
              </li>
              <li><span>Barcode</span></li>
          </ul>
        </div>
        <!-- END PAGE HEADER-->
        <div class="row">
          <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered" style="height: 500px">
              <div class="portlet-title">
                <div class="col-md-6 caption font-dark">
                  <i class="fa fa-barcode"></i>
                  <span class="caption-subject bold uppercase"> Generates Barcode</span>
                </div>
              </div>
              <div class="portlet-body">
                <form method="post" id="generate_barcode">
                  <center>
                    <div class="col-md-5">
                    <table class="table">
                      <tr>
                        <td><label class="form-label">Barcode Number</label></td>
                        <td><input type="number" style="width: 250px;" class="form-control" name="barcode" id="barcode" autocomplete="off"></td>
                      </tr>
                      <tr>
                        <td><label class="form-label">Price</label></td>
                        <td><input type="number" style="width: 250px;" class="form-control" id="price" autocomplete="off"></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td>
                          <button class="btn btn-primary margin-top-10">Generates</button>
                        </td>
                      </tr>
                    </table>
                    <div class="margin-top-10" id="img"></div>
                  </div>
                  </center>
                </form>
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
  $(document).ready(function(){
    $('#generate_barcode').unbind('submit').on('submit',function(){
      var barcode=$('#barcode').val();
      var price=$('#price').val();
      $('#img').html('<img style="width:200px" src="<?php echo base_url()?>barcode/generate_barcode/'+barcode+'/'+price+'" />');
      
      $('#barcode').val('');
      $('#price').val('');
      return false;
    });
  });
</script>