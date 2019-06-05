<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
  <!-- BEGIN CONTENT BODY -->
  <div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h1 class="page-title"> Systems User
      <small>list of systems users</small>
    </h1>
    <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url()?>dashboard">Dashboard</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <a href="<?php echo base_url()?>user">User</a>
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
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
          <div class="portlet-title">
            <div class="caption font-dark">
              <i class="fa fa-user"></i>
              <span class="caption-subject bold uppercase"> Add User</span>
            </div>
          </div>
          <form method="post" id="form_add" enctype="multipart/form-data" action="<?php echo base_url()?>user/insert">
            <div class="portlet-body">
              <div class="form-group">
                <label class="control-label">Images</label>
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
                                <input type="file" name="user_image" > </span>
                            <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                        </div>
                    </div>
                </div>
                <!-- END CHANGE AVATAR TAB -->
              </div><hr>
              <div class="form-group">
                <label class="control-label">Group</label>
                <select class="form-control" name="group">
                  <?php if($user_group['id']=='1'):?>
                    <option selected value="1">Super Administrator</option>
                  <?php endif;?>
                  <?php foreach($group as $key => $value):?>
                    <option value="<?php echo $value['id'];?>"><?php echo $value['group_user'];?></option>
                  <?php endforeach;?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">First Name *</label>
                <input type="text" class="form-control" name="firstname" autocomplete="off" placeholder="Enter firstname">
                <?php echo form_error('firstname','<span class="label label-danger">','</span>');?>
              </div>
              <div class="form-group">
                <label class="control-label">Last Name *</label>
                <input type="text" class="form-control" name="lastname" autocomplete="off" placeholder="Enter lastname">
                <?php echo form_error('lastname','<span class="label label-danger">','</span>');?>
              </div>
              <div class="form-group">
                <label class="control-label">Middle Name *</label>
                <input type="text" class="form-control" name="middlename" autocomplete="off" placeholder="Enter middlename">
                <?php echo form_error('middlename','<span class="label label-danger">','</span>');?>
              </div>
              <div class="form-group">
                <label class="control-label">Date of Birth *</label>
                <input type="text" class="input-group form-control form-control-inline date date-picker" name="dateofbirth" data-date-format="yyyy-mm-dd">
                <?php echo form_error('dateofbirth','<span class="label label-danger">','</span>');?>
              </div>
              <div class="form-group">
                <label class="control-label">Contact Number *</label>
                <input type="text" class="form-control" name="contact" autocomplete="off" placeholder="Enter contact number">
                <?php echo form_error('contact','<span class="label label-danger">','</span>');?>
              </div>
              <div class="form-group">
                <label class="control-label">Gender</label>
                <select class="form-control" name="gender">
                  <option value="1">Male</option>
                  <option value="2">Female</option>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Email *</label>
                <input type="text" class="form-control" name="email" autocomplete="off" placeholder="Enter email">
                <?php echo form_error('email','<span class="label label-danger">','</span>');?>
              </div>
              <div class="form-group">
                <label class="control-label">Username *</label>
                <input type="text" class="form-control" name="username" autocomplete="off" placeholder="Enter username">
                <?php echo form_error('username','<span class="label label-danger">','</span>');?>
              </div>
              <div class="form-group">
                <label class="control-label">Password *</label>
                <input type="password" class="form-control" name="password" autocomplete="off" placeholder="Enter password">
              </div>
              <div class="form-group">
                <label class="control-label">Confirm Password *</label>
                <input type="password" class="form-control" name="confirmation" autocomplete="off" placeholder="Enter confirmation">
                <?php echo form_error('confirmation','<span class="label label-danger">','</span>');?>
              </div>
              <div class="form-group">
                <label class="control-label">Status</label>
                <select class="form-control" name="status">
                  <option value="1">Active</option>
                  <option value="2">Inctive</option>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Address *</label>
                <textarea class="form-control" name="address"></textarea>
                <?php echo form_error('address','<span class="label label-danger">','</span>');?>
              </div>
              <div class="form-group">
                <button class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('user');?>" class="btn btn-warning">Back</a>
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
