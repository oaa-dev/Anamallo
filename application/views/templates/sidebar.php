
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- END SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu  page-sidebar-menu-compact" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                        <li class="sidebar-toggler-wrapper hide">
                            <div class="sidebar-toggler">
                                <span></span>
                            </div>
                        </li>
                        <!-- END SIDEBAR TOGGLER BUTTON -->
                       
                        <li class="nav-item start ">
                            <a href="<?php echo base_url('dashboard');?>" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <?php if(isset($user_permission)||!empty($user_permission)):?>

                            <?php if(in_array('createSupplier', $user_permission)||in_array('updateSupplier', $user_permission)||
                                in_array('viewSupplier', $user_permission)):?>
                                <li class="nav-item  ">
                                    <a href="<?php echo base_url('supplier');?>" class="nav-link nav-toggle">
                                        <i class="fa fa-truck"></i>
                                        <span class="title">Suppliers</span>
                                    </a>
                                </li>
                            <?php endif;?>

                            <?php if(in_array('createGroup', $user_permission)||in_array('updateGroup', $user_permission)||
                                in_array('viewGroup', $user_permission)):?>
                                <li class="nav-item  ">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="fa fa-users"></i>
                                        <span class="title">Groups</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <?php if(in_array('createGroup', $user_permission)):?>
                                        <li class="nav-item  ">
                                            <a href="<?php echo base_url('group/add');?>" class="nav-link ">
                                                <span class="fa fa-plus"></span>
                                                <span class="title">Add Group</span>
                                            </a>
                                        </li>
                                        <?php endif;?>
                                        <?php if(in_array('updateGroup', $user_permission)||
                                                in_array('viewGroup', $user_permission)):?>
                                        <li class="nav-item  ">
                                            <a href="<?php echo base_url('group');?>" class="nav-link ">
                                                <span class="fa fa-edit"></span>
                                                <span class="title">Manage Groups</span>
                                            </a>
                                        </li>
                                        <?php endif;?>
                                    </ul>
                                </li>
                            <?php endif;?>

                            <?php if(in_array('createProduct', $user_permission)||in_array('updateProduct', $user_permission)||
                                in_array('deleteProduct', $user_permission)||
                                in_array('viewProduct', $user_permission)):?>
                                <li class="nav-item  ">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span class="title">Products</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">

                                        <?php if(in_array('createBrand', $user_permission)||in_array('updateBrand', $user_permission)||
                                            in_array('viewBrand', $user_permission)):?>
                                            <li class="nav-item  ">
                                                <a href="<?php echo base_url('brand');?>" class="nav-link nav-toggle">
                                                    <i class="fa fa-tags"></i>
                                                    <span class="title">Manage Brands</span>
                                                </a>
                                            </li>
                                        <?php endif;?>

                                        <?php if(in_array('createCategory', $user_permission)||in_array('updateCategory', $user_permission)||
                                            in_array('viewCategory', $user_permission)):?>
                                            <li class="nav-item  ">
                                                <a href="<?php echo base_url('category');?>" class="nav-link nav-toggle">
                                                    <i class="fa fa-envelope"></i>
                                                    <span class="title">Manage Category</span>
                                                </a>
                                            </li>
                                        <?php endif;?>
                                        
                                        <?php if(in_array('createModel', $user_permission)||in_array('updateModel', $user_permission)||
                                            in_array('viewModel', $user_permission)):?>
                                            <li class="nav-item  ">
                                                <a href="<?php echo base_url('model');?>" class="nav-link nav-toggle">
                                                    <i class="fa fa-files-o"></i>
                                                    <span class="title">Manage Models</span>
                                                </a>
                                            </li>
                                        <?php endif;?>
                                        <?php if(in_array('updateProduct', $user_permission)||in_array('deleteProduct', $user_permission)||
                                            in_array('view', $user_permission)):?>
                                        <li class="nav-item  ">
                                            <a href="<?php echo base_url('product');?>" class="nav-link ">
                                                <span class="fa fa-shopping-cart"></span>
                                                <span class="title">Manage Products</span>
                                            </a>
                                        </li>
                                        <?php endif;?>
                                    </ul>
                                </li>
                            <?php endif;?>

                            <?php if(in_array('createInvoice', $user_permission)):?>
                                <li class="nav-item  ">
                                    <a href="<?php echo base_url('invoice');?>" class="nav-link nav-toggle">
                                        <i class="fa fa-money"></i>
                                        <span class="title">Invoice</span>
                                        <span class="arrow"></span>
                                    </a>
                                </li>
                            <?php endif;?>

                            <?php if(in_array('createPurchase', $user_permission)):?>
                            <li class="nav-item  ">
                                <a href="<?php echo base_url('purchase');?>" class="nav-link nav-toggle">
                                    <i class="fa fa-archive"></i>
                                    <span class="title">Purchase</span>
                                    <span class="arrow"></span>
                                </a>
                            </li>
                            <?php endif;?>

                            <li class="nav-item  ">
                                <a href="<?php echo base_url('stocks');?>" class="nav-link nav-toggle">
                                    <i class="fa fa-database"></i>
                                    <span class="title">Stocks</span>
                                </a>
                            </li>

                            <?php if(in_array('viewReport', $user_permission)):?>
                                <li class="nav-item  ">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="fa fa-book"></i>
                                        <span class="title">Reports</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item">
                                            <a href="<?php echo base_url('report/sales');?>" class="nav-link ">
                                                <span class="fa fa-edit"></span>
                                                <span class="title">Summary Sales Report</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo base_url('report/detailed_sales');?>" class="nav-link ">
                                                <span class="fa fa-edit"></span>
                                                <span class="title">Detailed Sales Report</span>
                                            </a>
                                        </li>
                                        <li class="nav-item  ">
                                            <a href="<?php echo base_url('report/invoice');?>" class="nav-link ">
                                                <span class="fa fa-edit"></span>
                                                <span class="title">Invoice Report</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo base_url('report/purchase');?>" class="nav-link ">
                                                <span class="fa fa-edit"></span>
                                                <span class="title">Purchase Reports</span>
                                            </a>
                                        </li>
                                        <li class="nav-item  ">
                                            <a href="<?php echo base_url('report/inventory');?>" class="nav-link ">
                                                <span class="fa fa-edit"></span>
                                                <span class="title">Inventory Report</span>
                                            </a>
                                        </li>
                                        <li class="nav-item  ">
                                            <a href="<?php echo base_url('issue');?>" class="nav-link ">
                                                <span class="fa fa-edit"></span>
                                                <span class="title">Reconcile</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif;?>

                            <?php if(in_array('createUser', $user_permission)||in_array('updateUser', $user_permission)||
                                in_array('viewUser', $user_permission)):?>
                                <li class="nav-item  ">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="fa fa-user"></i>
                                        <span class="title">Users</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <?php if(in_array('createGroup', $user_permission)):?>
                                        <li class="nav-item  ">
                                            <a href="<?php echo base_url('user/add');?>" class="nav-link ">
                                                <span class="fa fa-plus"></span>
                                                <span class="title">Add User</span>
                                            </a>
                                        </li>
                                        <?php endif;?>
                                        <?php if(in_array('updateUser', $user_permission)||in_array('viewUser', $user_permission)):?>
                                        <li class="nav-item  ">
                                            <a href="<?php echo base_url('user');?>" class="nav-link ">
                                                <span class="fa fa-edit"></span>
                                                <span class="title">Manage Users</span>
                                            </a>
                                        </li>
                                        <?php endif;?>
                                    </ul>
                                </li>
                            <?php endif;?>
    
                            <?php if(in_array('updateVat', $user_permission)):?>
                            <li class="nav-item  ">
                                <a href="<?php echo base_url('vat');?>" class="nav-link nav-toggle">
                                    <i class="fa fa-usd"></i>
                                    <span class="title">Value Added Tax</span>
                                </a>
                            </li>
                            <?php endif;?>
                                
                            <?php if(in_array('updateVat', $user_permission)):?>
                            <li class="nav-item  ">
                                <a href="<?php echo base_url('return_product');?>" class="nav-link nav-toggle">
                                    <i class="fa fa-arrow-right"></i>
                                    <span class="title">Return</span>
                                </a>
                            </li>
                            <?php endif;?>


                            <?php if(in_array('viewLogs', $user_permission)):?>
                            <li class="nav-item  ">
                                <a href="<?php echo base_url('user/logs');?>" class="nav-link nav-toggle">
                                    <i class="fa fa-wrench"></i>
                                    <span class="title">Activity Logs</span>
                                </a>
                            </li>
                            <?php endif;?>

                            <?php if(in_array('viewLogs', $user_permission)):?>
                            <li class="nav-item  ">
                                <a href="<?php echo base_url('barcode');?>" class="nav-link nav-toggle">
                                    <i class="fa fa-barcode"></i>
                                    <span class="title">Barcode Generator</span>
                                </a>
                            </li>
                            <?php endif;?>

                            <?php if(in_array('backupDatabase', $user_permission)):?>
                            <li class="nav-item  ">
                                <a href="<?php echo base_url('backup/back_up');?>" class="nav-link nav-toggle">
                                    <i class="fa fa-database"></i>
                                    <span class="title">Backup Database</span>
                                </a>
                            </li>
                            <?php endif;?>
                        <?php endif;?>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
