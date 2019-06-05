<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
  <!-- BEGIN CONTENT BODY -->
  <div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h1 class="page-title"> Admin Dashboard
      <small>statistics, charts, recent events and reports</small>
    </h1>
    <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url()?>dashboard">Dashboard</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>User</span>
          </li>
          <li>
              <span>Profile</span>
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
              <span class="caption-subject bold uppercase"> User Profile</span>
            </div>
          </div>
          <div id="messages"></div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper no-footer">
              <div class="table">
                <?php if(isset($user_data)||!empty($user_data)):?>
                <table class="table table-striped table-bordered">
                  <tbody> 
                    <tr>
                      <td colspan="2" style="width: 200px;"> <img style="border: solid" width="200px" src="<?php echo base_url();?>images/<?php echo (!empty($user_data['image']))?$user_data['image']:'null.jpg'?>"> </td>
                    </tr>
                    <tr>
                      <td style="width: 50px;"> Username </td>
                      <td style="width: 200px;"><span class="label label-primary"><?php echo $user_data['username'];?></span></td>
                    </tr>
                    <tr>
                      <td style="width: 50px;"> First Name </td>
                      <td style="width: 200px;"> <?php echo $user_data['firstname'];?> </td>
                    </tr>
                    <tr>
                      <td style="width: 50px;"> Last Name </td>
                      <td style="width: 200px;"> <?php echo $user_data['lastname'];?> </td>
                    </tr>
                    <tr>
                      <td style="width: 50px;"> Middle Name </td>
                      <td style="width: 200px;"> <?php echo $user_data['middlename'];?> </td>
                    </tr>
                    <tr>
                      <td style="width: 50px;"> Date of Birth </td>
                      <td style="width: 200px;"> <?php echo $user_data['dateofbirth'];?> </td>
                    </tr>
                    <tr>
                      <td style="width: 50px;"> Contact Number </td>
                      <td style="width: 200px;"> <?php echo $user_data['contact'];?> </td>
                    </tr>
                    <tr>
                      <td style="width: 50px;"> Gender </td>
                      <td style="width: 200px;"> <?php echo ($user_data['gender']=='1')? 'Male':'Female';?> </td>
                    </tr>
                    <tr>
                      <td style="width: 50px;"> Group </td>
                      <td style="width: 200px;"><span class="label label-primary"><?php echo $user_group['group_user'];?></span></td>
                    </tr>
                  </tbody>
                </table>
              <?php endif;?>
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
