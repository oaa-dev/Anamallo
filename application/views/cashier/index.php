
<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Anamallo Corp. | <?php echo $page_title;?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #7 for dashboard & statistics" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url();?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/datatables.net-bs/css/dataTables.bootstrap.min.css">
        
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url();?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo base_url();?>assets/layouts/layout7/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/layouts/layout6/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" />
        
        <script src="<?php echo base_url(); ?>assets/jQuery/jquery.min.js"></script>

        </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="clearfix " style="background-color:#26344BFF">
                <!-- BEGIN BURGER TRIGGER -->
                <div class="burger-trigger">
                    <!-- the overlay element -->
                </div>
                <!-- END NAV TRIGGER -->
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <img src="<?php echo base_url();?>images/logo1.png" alt="logo" class="logo-default"/><img src="<?php echo base_url();?>images/anamallo.png" alt="logo" class="logo-default" />
                </div>
                <!-- END LOGO -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <div class="dropdown-user-inner">
                                    <span class="username username-hide-on-mobile" style="text-transform: capitalize;"> <?php echo !empty($user_data)? $user_data['username'] : null;?> </span>
                                    <img alt="" src="<?php echo base_url();?>images/<?php echo $user_data['image'];?>" /> </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li class="label-info">
                                    <a>
                                        <i class="icon-user"></i> <?php echo !empty($user_group)? $user_group['group_user'] : null;?> </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>authentication/logout">
                                        <i class="icon-key"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
          <!-- BEGIN CONTENT -->
          <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
              <form method="post" id="form_add" action="<?php echo base_url()?>invoice/insert" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-12">
                    <div id="messages"></div>
                    <div class="row">
                      <div class="col-md-9">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered">
                          <div class="portlet-body">
                            <div  class="scroller" style="height:500px" data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green">
                              <div class="table">
                                <table class="table table-striped table-bordered table-hover" id="manageTable">
                                  <thead>
                                    <tr>
                                      <th class="sorting" style="width: 50px;"> Barcode </th>
                                      <th class="sorting" style="width: 200px;"> Product </th>
                                      <th class="sorting" style="width: 10px;"> Stocks </th>
                                      <th class="sorting" style="width: 10px;"> Price </th>
                                      <th class="sorting" style="width: 10px;"> Quantity </th>
                                      <th class="sorting" style="width: 100px;"> Sub Total </th>
                                      <th style="width: 10px;"> Actions </th>
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
                      <div class="col-md-3">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered"><br>
                          <table class="table">
                            <tr>
                              <td><label>Gross Amount</label></td>
                              <td><span class="control-label" id="total_gross">00.00</span></td>
                            </tr>
                            <tr>
                              <td><label>Net of Vat</label></td>
                              <td><span class="control-label" id="net_vat">00.00</span></td>
                            </tr>
                            <tr>
                              <td><label>Value Added Tax</label></td>
                              <td><input type="hidden" name="vat" id="vat"><span class="control-label" id="total_vat">00.00</span></td>
                            </tr>
                          </table>
                        </div>
                        <div class="portlet light bordered">
                          <div class="form-group">
                            <label>Barcode Number (F2)</label>
                            <input type="text" class="form-control" id="barcode" autocomplete="off" autofocus>
                          </div>
                        </div>
                        <div class="portlet light bordered">
                          <div>
                            <a class="icon-btn" style="width: 100%" data-toggle="modal" data-target="#customerModal"><i class="fa fa-user"></i><div>Customer (F4)</div></a>
                          </div>
                          <div>
                            <a class="icon-btn" id="btnpayment" style="width: 100%"><i class="fa fa-money"></i><div>Payment (F7)</div></a>
                          </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                      </div>
                    </div>
                  </div>
                </div>

                <div id="customerModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" data-attention-animation="false" aria-hidden="false" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title"><i class="fa fa-user"></i> Customer</h4> 
                      </div>
                      <div class="modal-body">
                        <div class="form-group"><a class="btn btn-primary pull-right" data-toggle="modal" data-target="#searchCustomerModal"><span class="fa fa-search"></span> Search</a>
                          <label class="control-label">Customers Name *</label>
                          <input type="hidden" name="customer_id" id="customer_id">
                          <input type="text" class="form-control" id="name" name="name" autocomplete="off">
                          
                        </div>
                        <div class="form-group">
                          <label class="control-label">Address *</label>
                          <input type="text" class="form-control" id="address" name="address">
                        </div>
                        <div class="form-group">
                          <label class="control-label">Contact Number *</label>
                          <input type="text" class="form-control" id="contact" name="contact">
                        </div>
                        <div class="form-group">
                          <label class="control-label">Email Address *</label>
                          <input type="text" class="form-control" id="email" name="email">
                        </div>
                        <div class="modal-footer">
                          <a data-dismiss="modal" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>
                          <button data-dismiss="modal" class="btn btn-success"><i class="fa fa-save"></i> OK</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="paymentModal" class="modal fade bs-modal-sm" tabindex="-1" data-backdrop="static" data-keyboard="false" data-attention-animation="false" aria-hidden="false" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title"><i class="fa fa-plus"></i> Payment</h4> 
                      </div>
                      <div class="modal-body">
                        <div class="form-inline" hidden>
                          <table>
                            <tr>
                              <td style="width: 7em"><label>Capital</label></td>
                              <td><input type="text" class="form-control" style="width: 100%" id="capital" readonly></td>
                            </tr>
                            <tr>
                              <td><label>Max Discount</label></td>
                              <td><input type="text" class="form-control margin-top-10" style="width: 100%" id="threshold" readonly></td>
                            </tr>
                          </table>
                        </div>
                        <div class="form-group">
                          <label>Gross amount</label>
                          <input type="number" class="form-control" id="gross_amount" name="gross_amount" readonly>
                        </div>
                        <div class="form-group">
                          <label>Official Receipt Number (F8)</label>
                          <input type="number" class="form-control" id="or_number" name="or_number" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                          <label>Discount Amount</label>
                          <div class="btn-group pull-right">
                            <span class="btn green dropdown-toggle btn-xs" id="accountview" type="button" data-toggle="dropdown" aria-expanded="false">Add discount
                            </span>
                            <div class="dropdown-menu dropdown-content input-large hold-on-click" role="menu">
                              <h3 class="page-title">Account Details</h3><hr>
                              <div class="form-group">
                                <label>Username *</label>
                                <input type="text" class="form-control" id="username" autocomplete="off" placeholder="Username">
                                <label>Password *</label>
                                <input type="password" class="form-control" id="password" autocomplete="off" placeholder="Password">
                                <div class="btn-group pull-right">
                                  <button class="btn btn-primary btn-sm margin-top-10 " id="btnaccount">Ok</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <span class="label label-danger" id="discount_stat"></span>
                          <input type="number" class="form-control" id="discount" name="discount" step="0.01" pattern="[0-9]+([\.,][0-9]+)?" title="This should be a number with up to 2 decimal places." autocomplete="off" readonly>
                        </div>
                        <div class="form-group">
                          <label>Subtotal</label>
                          <input type="number" class="form-control" id="subtotal" name="subtotal" readonly>
                        </div>
                        <div class="form-group">
                          <label>Payment</label>
                          <span class="label label-info" id="payment_stat"></span>
                          <input type="number" class="form-control" id="payment" name="payment" step="0.01" pattern="[0-9]+([\.,][0-9]+)?" title="This should be a number with up to 2 decimal places." required autocomplete="off">
                        </div>
                        <div class="form-group">
                          <label>Change</label>
                          <input type="number" class="form-control" id="change" name="change" readonly>
                        </div>
                        <div class="modal-footer">
                          <a data-dismiss="modal" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>
                          <button class="btn btn-success" id="btnSave" disabled=""><i class="fa fa-save"></i> Save</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="searchCustomerModal" class="modal fade bs-modal-lg" tabindex="-1" data-backdrop="static" data-keyboard="false" data-attention-animation="false" aria-hidden="false" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title"><i class="fa fa-user"></i> Customer</h4> 
                      </div>
                      <div class="modal-body">
                        <div class="table">
                          <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="manage" role="grid" aria-describedby="sample_1_info">
                            <thead>
                              <tr role="row">
                                <th class="sorting" style="width: 200px;"> Name </th>
                                <th class="sorting" style="width: 100px;"> Email </th>
                                <th class="sorting" style="width: 100px;"> Contact </th>
                                <th class="sorting" style="width: 100px;"> Address </th>
                                <th class="sorting" style="width: 100px;"> Action </th>
                              </tr>
                            </thead>
                            <tbody> 
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="printableArea" style="color: red;" hidden>

                  <small id="petsa" style="position: absolute; margin-top: 85px;margin-left: 430px">#2 2018-09-23</small>
                  <small id="PONo" style="position: absolute; margin-top: 98px;margin-left: 440px">121334</small>
                  <small id="soldTo" style="position: absolute; margin-top: 107px;margin-left: 20px;">Angelo G. Gomez</small>
                  <small id="deliverTo" style="position: absolute; margin-top: 147px;margin-left: 20px">John Christian P. Oraa</small>
                  <small id="custId" style="position: absolute; margin-top: 105px;margin-left: 320px">C0001</small>
                  <small id="seller" style="position: absolute; margin-top: 147px;margin-left: 460px">Marco</small>
                  <table style="position: absolute; margin-top: 190px;margin-left: 35px" id="kinuha">
                  </table>
                  <small id="vatTotal" style="position: absolute; margin-top: 435px;margin-left: 460px">TOTAL</small>
                  <small id="myVat" style="position: absolute; margin-top: 485px;margin-left: 465px">VAT</small>
                  <small id="total" style="position: absolute; margin-top: 510px;margin-left: 460px">TOTAL</small>

                  <!--<img src="resibo.jpg" style="width: 550px;">-->
                </div>
              </form>
            </div>
            <!-- END CONTENT BODY -->
          </div>
          <!-- END CONTENT -->

        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner container-fluid container-lf-space">
                <p class="page-footer-copyright"> <?php echo date("Y");?> Anamallo Corporation</p>
            </div>
            <div class="go2top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        
<script type="text/javascript">
  var manageTable;
  var kinuha;

  $(document).ready(function(){
    manage = $('#manage').DataTable({
      'order': [],
      'ajax': {
        url:'<?php echo base_url();?>customer/find_all'
      }
    });

    $('#barcode').on('change',function(){
      var barcode=$('#barcode').val();
      var table=$('#manageTable tbody tr').length;
      var status=false;

      $.ajax({
        type : 'POST',
        url : '<?php echo base_url()?>invoice/search/'+barcode,
        dataType : 'json',
        success : function(response){
          if(response.stocks<=0){
            alert('Out of stock!');
          }else{

            var tr_barcode;
            for(var index=1;index<=table;index++){
              tr_barcode=$('#manageTable tbody tr:nth-child('+index+') td:nth-child(1)').text();
              if(tr_barcode==response.barcode){
                status=true;
                break;
              }
            }
              //change data if already exist
            if(status){
              var qty=$('#cart'+tr_barcode+' td:nth-child(5) input').val();
              var new_qty=parseInt(qty)+parseInt(1);
              if(new_qty>response.stocks){
                alert("Unsufficient stocks!");
              }else{
                var subtotal=parseInt(new_qty)*parseInt(response.selling_price);

                $('#cart'+tr_barcode+' td:nth-child(5) input').val(new_qty);
                $('#cart'+tr_barcode+' td:nth-child(6)').text(subtotal);
                compute_total_amount();
              }
              $('#barcode').focus();
              $('#barcode').val('');
              $('#product').val('');
              return;
            }
            //note yung sa value hindi na sya negative or positive
            $('#manageTable tbody').append('<tr id="cart'+response.barcode+'"><td><input type="hidden" name="id[]" value="'+response.id
              +'">'+response.barcode
              +'</td><td>'+response.product
              +'</td><td>'+response.stocks
              +'</td><td>'+response.selling_price
              +'<input type="hidden" value="'+response.manufacturer_price+'"/></td><td><input type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" min="1" max="'+response.stocks+'" class="form-control input-sm" style="width:60px" name="qty[]" value="1" autocomplete="off" onkeyup="compute_total('+response.barcode+')"></td><td>'+parseFloat(response.selling_price).toFixed(2)
              +'</td><td><a onclick="remove('+response.barcode+')" class="btn btn-danger btn-xs"><i class="fa fa-times"><i></a></td></tr>');    
          }
          compute_total_amount();
          $('#barcode').focus();
          $('#barcode').val('');
          $('#product').val('');
        }
      });
    });

    $('#payment').on('keyup', function(){
      var subtotal = Number($('#subtotal').val());
      var payment = Number($(this).val());
      var change = (payment-subtotal).toFixed(2);

      if(change>=0){
        $('#change').val(change);
        $('#payment_stat').text('enough');
        $('#btnSave').attr('disabled',false);
      }else{
        $('#change').val('');
        $('#payment_stat').text('not enough');
        $('#btnSave').attr('disabled',true);
      }
    });

    $('#discount').on('keyup', function(){
      $('#payment').val('0');
      var threshold = Number($('#threshold').val());
      var gross_amount = Number($('#gross_amount').val());
      var discount = Number($(this).val());
      var subtotal = (gross_amount-discount).toFixed(2);

      if(discount<=threshold){
        $('#discount_stat').text('');
        if(subtotal>=0){
          $('#subtotal').val(subtotal);
          $('#payment').attr('disabled',false);
        }
      }else{
        $('#discount_stat').text('The amount exceed the maximum discount');
        $('#payment').attr('disabled',true);
      }
    });

    $('#btnpayment').on('click', function(){
      if($('#manageTable tbody tr').length ==0){
        alert('Cart is empty!');
        $('#barcode').focus();
      }else{
        $("#paymentModal").modal('show');
      }
    });

    $('#form_add').unbind('submit').on('submit', function() {
      var form = $(this);
      var table=$('#manageTable tbody tr').length;
      
      if($('#name').val()=="" && $('#contact').val()==""){
        $("#paymentModal").modal('hide');
        $('#customerModal').modal('show');
      }

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(),
        dataType: 'json',
        success:function(response) {

          if(response.success === true) {
            alert(response.messages);
            printMe('printableArea');
            location.reload();
          }
        }
      });
      return false;
    });

    $('#btnaccount').on('click', function() {
      var form = $('#form_add');
      var username = $('#username').val();
      var password = $('#password').val();
      $.ajax({
        url: '<?php echo base_url();?>authentication/authenticate/'+username+'/'+password,
        type: 'POST',
        data: form.serialize(),
        dataType: 'json',
        success:function(response) {
          if(response.status){
            alert('Discount field activate!');
            $('#discount').attr({'readonly':false});
          }
        }
      });
      return false;
    });

    $('#name').on('keyup', function(){
      $('#customer_id').val('');
    });
  });

document.onkeyup = function(e) {
  //alert(e.which);
  switch(e.which) {
    case 119:$('#or_number').focus();break;
    case 113:$('#barcode').focus();break;
    case 115:
      $("#paymentModal").modal('hide');
      $('#customerModal').modal('show');
      break;
    case 118:
      $('#customerModal').modal('hide');
      if($('#manageTable tbody tr').length <=1){
        alert('Cart is empty!');
      }else{
        $("#paymentModal").modal('show');
      }
      break;
  }
};

function remove(code) {
  var status=false;
  var table=$('#manageTable tbody tr').length;

  for(var index=1;index<=table;index++){
    bar=$('#manageTable tbody tr:nth-child('+index+') td:nth-child(1)').text();
    if(bar==code){
      status=true;
      break;
    }
  }
  if(status){
    $('#manageTable tbody tr:nth-child('+index+')').remove();
    compute_total_amount();
  }
}

function compute_total(barcode){
  var total=0;

  var qty=parseInt($('#cart'+barcode+' td:nth-child(5) input').val());
  var stocks=parseInt($('#cart'+barcode+' td:nth-child(3)').text());

  if(qty>stocks){
    alert('Unsufficient stocks!');
    $('#cart'+barcode+' td:nth-child(5) input').val(0);
    $('#cart'+barcode+' td:nth-child(6)').text(0);
  }else{
    var price=parseFloat($('#cart'+barcode+' td:nth-child(4)').text());
    var total=parseFloat(price)*parseInt(qty);
    $('#cart'+barcode+' td:nth-child(6)').text(total.toFixed(2));  
  }

  compute_total_amount();
}

function compute_total_amount(){
  var total_amount=0;
  var total_payment=0;
  var threshold=0;
  tr=$('#manageTable tbody tr').length;
  for(var index=1;index<=tr;index++){
    total_amount += parseFloat($('#manageTable tbody tr:nth-child('+index+') td:nth-child(6)').text());
    threshold += parseFloat($('#manageTable tbody tr:nth-child('+index+') td:nth-child(4)').text()-$('#manageTable tbody tr:nth-child('+index+') td:nth-child(4) input').val())*$('#manageTable tbody tr:nth-child('+index+') td:nth-child(5) input').val();
  }
  var vat=<?php echo (!empty($vat))?$vat:'0';?>;
  var net_vat=total_amount/vat;
  var total_vat=total_amount-net_vat;
  var total_payment=(total_amount);
  var capital=total_amount-threshold;

  $('#gross_amount').val(total_payment.toFixed(2));
  $('#subtotal').val(total_payment.toFixed(2));
  $('#total_gross').text(total_payment.toFixed(2));
  $('#total_vat').text(total_vat.toFixed(2));
  $('#vat').val(total_vat.toFixed(2));
  $('#net_vat').text(net_vat.toFixed(2));
  $('#capital').val(capital.toFixed(2));
  $('#threshold').val(threshold.toFixed(2));
}

function customer(id,name,email,contact,address){
  $('#customer_id').val(id);
  $('#name').val(name);
  $('#email').val(email);
  $('#contact').val(contact);
  $('#address').val(address);
  $('#searchCustomerModal').modal('hide');
  $('#custId').text(id);
}

function printMe(divName){
  getLeData();

  var printContents = document.getElementById(divName).innerHTML;
  var originalContents = document.body.innerHTML;

  document.body.innerHTML = printContents;

  window.print();

  document.body.innerHTML = originalContents;
}

function getLeData(){
  var ctr = 0;
  var total_amount=0;

    ctr=$('#manageTable tbody tr').length;
  for(index1 = 1; index1 <= ctr; index1++){
    $('#kinuha').append('<tr><td style="width: 28px"><small>'+ index1 
      +'</small></td><td style="width: 48px" align="center"><small>'+
      $('#manageTable tbody tr:nth-child('+ (index1 ) +') td:nth-child(1)').text() 
      +'</small></td><td style="width: 190px; paddingRight:4px;"><small>'+
      $('#manageTable tbody tr:nth-child('+ (index1 ) +') td:nth-child(2)').text()
      +'</small></td><td style="width: 35px" align="center"><small>'+
      $('#manageTable tbody tr:nth-child('+ (index1 ) +') td:nth-child(5) input').val()
      +'</small></td><td style="width: 53px" align="center"><small>pcs</small></td><td style="width: 60px" align="center"><small>'+ $('#manageTable tbody tr:nth-child('+ (index1 ) +') td:nth-child(4)').text() +'</small></td><td style="width: 70px" align="center"><small>'+
      $('#manageTable tbody tr:nth-child('+ (index1 ) +') td:nth-child(6)').text()
      +'</small></td></tr>');
  }
  $('#vatTotal').text($('#net_vat').text());
  $('#total').text($('#gross_amount').val());
  $('#myVat').text($('#vat').val());
  $('#soldTo').text($('#name').val());
  $('#deliverTo').text($('#name').val());
  $('#seller').text('<?php echo $user_data['lastname'];?>');
  $('#petsa').text('<?php echo date("m-d-Y");?>');
  $('#PONo').text($('#or_number').val());
}

</script>

        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->


        <script src="<?php echo base_url();?>assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script> 

        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url();?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url();?>assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url();?>assets/layouts/layout7/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
            })
        </script>
    </body>

</html>