
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <img src="<?php echo base_url()?>images/anamallo.png" width="120px" alt="logo" class="logo-default">
                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN PAGE TOP -->
                <div class="page-top">
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                    
                        <ul class="nav navbar-nav pull-right">
                            <?php if(!empty($user_group['id'])):?>
                                <?php if($user_group['id']=='1'||$user_group['id']=='2'):?>
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class below "dropdown-extended" to change the dropdown styte -->
                            <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                            <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                            <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-bell"></i>
                                    <span class="badge badge-default"> 
                                    <?php
                                        $ctr=0;
                                        if(!empty($stocks_alert)){
                                            $ctr++;
                                        }if (!empty($decision_alert)) {
                                            $ctr++;
                                        }if (!empty($update_alert)) {
                                            $ctr++;
                                        }
                                        echo ($ctr==0)?null:$ctr;
                                    ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3>Notifications</h3>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                            <?php if(!empty($stocks_alert)):?>
                                            <li>
                                                <a href="<?php echo base_url('stocks');?>">
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-success">
                                                            <i class="fa fa-exclamation"></i>
                                                        </span> <?php echo $stocks_alert;?> </span>
                                                </a>
                                            </li>
                                            <?php endif;?>
                                            <?php if(!empty($decision_alert)):?>
                                            <li>
                                                <a href="<?php echo base_url('stocks');?>">
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-success">
                                                            <i class="fa fa-exclamation"></i>
                                                        </span> <?php echo $decision_alert;?> </span>
                                                </a>
                                            </li>
                                            <?php endif;?>
                                            <?php if(!empty($update_alert)):?>
                                            <li>
                                                <a href="<?php echo base_url('product');?>">
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-success">
                                                            <i class="fa fa-exclamation"></i>
                                                        </span> <?php echo $update_alert;?> </span>
                                                </a>
                                            </li>
                                            <?php endif;?>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!-- END NOTIFICATION DROPDOWN -->
                                <?php endif?>
                            <?php endif?>
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle" src="<?php echo base_url();?>images/<?php echo !empty($user_data['image'])?$user_data['image']:'null.jpg';?>"/>
                                    <span class="username username-hide-on-mobile" style="text-transform: capitalize;"> <?php echo !empty($user_data)? $user_data['username'] : null;?> </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li class="label-info">
                                        <a href="javascript:;"><span style="text-transform: capitalize;"> <?php echo !empty($user_group)? $user_group['group_user'] : null;?> </span> </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('user/profile');?>">
                                            <i class="icon-user"></i> My Profile </a>
                                    </li>
                                    <?php if(in_array('updateUser', $user_permission)):?>
                                    <li>
                                        <a href="<?php echo base_url('user/edit/');?><?php echo !empty($user_data['id'])?$user_data['id']:null;?>">
                                            <i class="icon-wrench"></i> Setting
                                        </a>
                                    </li>
                                    <?php endif?>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="<?php echo base_url('authentication/logout');?>">
                                            <i class="icon-key"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->