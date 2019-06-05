<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h1 class="page-title"> Value Added Tax
            <small>anamallo value added tax</small>
        </h1>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="<?php echo base_url('dashboard');?>">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <span>Value added Tax</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE HEADER-->
        <div class="row">
          <div class="col-md-12">
            <div id="messages"></div>
            <div class="col-md-6">
              <div class="portlet light bordered" style="height: 260px">
                <div class="portlet-body">
                  <div align="center">
                    <h4>Value Added Tax</h4>
                    <h1><?php echo isset($vat)?$vat:'0';?></h1>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#vat">CHANGE</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="portlet light bordered" style="height: 260px">
                <div class="portlet-body">
                  <div align="center">
                    <h4>Mark up</h4>
                    <h1><?php echo isset($markup)?$markup:'0';?>%</h1>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#markup">CHANGE</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->

<div id="vat" class="modal fade" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Value Added Tax</h4> 
      </div>
      <form method="post" id="form_vat_edit" action="<?php echo base_url('vat/update_vat/1');?>" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label">New Value Added Tax:</label>
            <input type="text" class="form-control" name="vat" placeholder="Value Added Tax" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label class="control-label">Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off" required>
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

<div id="markup" class="modal fade" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit Markup</h4> 
      </div>
      <form method="post" id="form_markup_edit" action="<?php echo base_url('vat/update_markup');?>" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label">New Markup:</label>
            <input type="text" class="form-control" name="markup" placeholder="Percentage" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label class="control-label">Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off" required>
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
  $(document).ready(function(){
    
    $('#form_vat_edit').unbind('submit').bind('submit', function() {
      var form=$(this);

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(),
        dataType: 'json',
        success:function(response){
          if(response.success === true){
            alert(response.messages); 
            location.reload();
          }else{
               alert(response.messages); 
          }
        }
      });
      return false;
    });

     $('#form_markup_edit').unbind('submit').bind('submit', function() {
      var form=$(this);

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(),
        dataType: 'json',
        success:function(response){
          if(response.success === true){
            alert(response.messages); 
            location.reload();
          }else{   
            alert(response.messages); 
         }
        }
      });
      return false;
    });
  });

</script>