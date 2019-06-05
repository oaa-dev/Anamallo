<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
  <!-- BEGIN CONTENT BODY -->
  <div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <div class="page-bar">
      <ul class="page-breadcrumb">
        <li>
          <i class="icon-home"></i>
          <a href="<?php echo base_url('dashboard');?>">Dashboard</a>
          <i class="fa fa-angle-right"></i>
        </li>
        <li>
          <span>Invoice</span>
        </li>
      </ul>
    </div>
    <!-- END PAGE HEADER-->
    <form method="post" id="form_add" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-12">
          <div id="messages"></div>
          <div class="row">
            <div class="col-md-3">
              <!-- BEGIN EXAMPLE TABLE PORTLET-->
              <div class="portlet light bordered">
                <div class="form-group">
                  <label>Official Receipt (F2)</label>
                  <input type="text" class="form-control" id="or_number" autocomplete="off" autofocus>
                </div>
                <div class="form-group">
                  <label>Customer Name</label>
                  <input type="hidden" id="invoice_id" name="invoice_id" readonly>
                  <input type="hidden" id="cust_id" name="cust_id" readonly>
                  <input type="text" class="form-control" id="name" readonly>
                </div>
                <div class="form-group">
                  <label>Address</label>
                  <input type="text" class="form-control" id="address" readonly>
                </div>
                <div class="form-group">
                  <label>Email Address</label>
                  <input type="text" class="form-control" id="email" readonly>
                </div>
              </div>
              <!-- END EXAMPLE TABLE PORTLET-->
            </div>
            <div class="col-md-9">
              <!-- BEGIN EXAMPLE TABLE PORTLET-->
              <div class="portlet light bordered">
                <div class="portlet-body">
                  <div  class="scroller" style="height:285px" data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green">
                    <div class="table">
                      <table class="table table-striped table-bordered table-hover" id="manageTable">
                        <thead>
                          <tr>
                            <th class="sorting" style="width: 50px;"> Barcode </th>
                            <th class="sorting" style="width: 200px;"> Product </th>
                            <th class="sorting" style="width: 10px;"> Price </th>
                            <th class="sorting" style="width: 10px;"> Quantity </th>
                            <th class="sorting" style="width: 10px;"> Return </th>
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
          </div>
          <div class="row">
            <div class="col-md-9">
              <div class="portlet light bordered">
                <div class="portlet-body">
                  <div  class="scroller" style="height:350px" data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green">
                    <div class="table">
                      <table class="table table-striped table-bordered table-hover" id="managereturn">
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
            </div>
            <div class="col-md-3">
              <div class="portlet light bordered">
                <div class="form-group">
                  <label>Barcode Number</label>
                  <input type="text" class="form-control" id="barcode" autocomplete="off" autofocus>
                </div>
                <div class="form-group">
                  <label>Total amount return</label>
                  <input type="text" class="form-control" id="total_return" name="total_return" readonly>
                  <input type="hidden" class="form-control" id="vat" name="vat">
                </div>
                <div class="form-group">
                  <label>Total replace amount</label>
                  <input type="text" class="form-control" id="total_replace" readonly>
                </div>
                <div class="form-group">
                  <label>Balance</label>
                  <input type="text" class="form-control" id="balance" readonly>
                </div>
                <div>
                  <a id="btnpayment" class="icon-btn" style="width: 100%"><i class="fa fa-money"></i><div>Payment (F7)</div></a>
                </div>
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
              <div class="form-group">
                <label>Official Receipt</label>
                <input type="number" class="form-control" name="or_number" autocomplete="off">
              </div>
              <div class="form-group">
                <label>Balance</label>
                <input type="number" class="form-control" id="balance_amount" name="balance_amount" readonly>
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
    </form>
  </div>
  <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->


<script type="text/javascript">
  $(document).ready(function(){
    $('#or_number').on('change',function(){
      var or=$('#or_number').val();
      
      $.ajax({
        type : 'POST',
        url : '<?php echo base_url()?>return_product/find_by_or/'+or,
        dataType : 'json',
        success : function(response){
          $('#invoice_id').val(response[0].invoice_id);
          $('#cust_id').val(response[1].id);
          $('#name').val(response[1].name);
          $('#address').val(response[1].address);
          $('#email').val(response[1].email);
          for (var i = 2; i < response.length; i++) {
            $('#manageTable tbody').append('<tr id="ret'+response[i].barcode+'"><td><input type="hidden" name="id[]" value="'+response[i].id
              +'">'+response[i].barcode
              +'</td><td>'+response[i].product
              +'</td><td>'+response[i].price
              +'</td><td>'+response[i].quantity
              +'</td><td><input type="number" value="'+response[i].quantity+'" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" min="1" max="'+response[i].quantity+'" class="form-control input-sm" style="width:60px" name="qty[]" value="1" autocomplete="off" onkeyup="compute_total('+response[i].barcode+')"></td><td>'+parseFloat(response[i].amount).toFixed(2)
              +'</td><td><a onclick="remove('+response[i].barcode+')" class="btn btn-danger btn-xs"><i class="fa fa-times"><i></a></td></tr>');      
          }
        $('#or_number').val('');
        compute_total_amount();
        }
      });
    });


    $('#btnpayment').on('click', function(){
      if($('#managereturn tbody tr').length ==0){
        alert('Cart is empty!');
        $('#barcode').focus();
      }else{
        $("#paymentModal").modal('show');
      }
    });

    $('#barcode').on('change',function(){
      var barcode=$('#barcode').val();
      var table=$('#managereturn tbody tr').length;
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
              tr_barcode=$('#managereturn tbody tr:nth-child('+index+') td:nth-child(1)').text();
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
                compute_total_replace();
              }
              $('#barcode').focus();
              $('#barcode').val('');
              return;
            }
            //note yung sa value hindi na sya negative or positive
            $('#managereturn tbody').append('<tr id="cart'+response.barcode+'"><td><input type="hidden" name="id_invoice[]" value="'+response.id
              +'">'+response.barcode
              +'</td><td>'+response.product
              +'</td><td>'+response.stocks
              +'</td><td>'+response.selling_price
              +'<input type="hidden" value="'+response.manufacturer_price+'"/></td><td><input type="number" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" min="1" max="'+response.stocks+'" class="form-control input-sm" style="width:60px" name="qty_invoice[]" value="1" autocomplete="off" onkeyup="compute_replace('+response.barcode+')"></td><td>'+parseFloat(response.selling_price).toFixed(2)
              +'</td><td><a onclick="remove_replace('+response.barcode+')" class="btn btn-danger btn-xs"><i class="fa fa-times"><i></a></td></tr>');    
          }
          compute_total_replace();
          $('#barcode').focus();
          $('#barcode').val('');
          $('#product').val('');
        }
      });
    });
    
    $('#payment').on('keyup', function(){
      var balance = Number($('#balance').val());
      var payment = Number($(this).val());
      var change = (payment-balance).toFixed(2);

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

    $('#btnSave').on('click', function() {
      var form = $('#form_add');

      $.ajax({
        url: '<?php echo base_url()?>return_product/insert',
        type: 'POST',
        data: form.serialize(),
        dataType: 'json',
        success:function(response) {
          if(response.success == true) {
            alert("Transaction saved!");
            location.reload();
          }
        }
      });
    });

  });

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

//return
function compute_total(barcode){
  var total=0;

  var qty=parseInt($('#ret'+barcode+' td:nth-child(5) input').val());
  var stocks=parseInt($('#ret'+barcode+' td:nth-child(4)').text());

  if(qty>stocks){
    alert('Unsufficient stocks!');
    $('#ret'+barcode+' td:nth-child(5) input').val(0);
    $('#ret'+barcode+' td:nth-child(6)').text(0);
  }else{
    var price=parseFloat($('#ret'+barcode+' td:nth-child(3)').text());
    var total=parseFloat(price)*parseInt(qty);
    $('#ret'+barcode+' td:nth-child(6)').text(total.toFixed(2));
    compute_total_amount(); 
  }
}

function compute_total_amount(){
  var total_amount=0;
  var total_payment=0;
  var threshold=0;
  tr=$('#manageTable tbody tr').length;
  for(var index=1;index<=tr;index++){
    total_amount += parseFloat($('#manageTable tbody tr:nth-child('+index+') td:nth-child(6)').text());
  }
  $('#total_return').val(total_amount.toFixed(2));
  var total_return=$('#total_return').val();
  if(total_amount>total_return){
    var total=total_amount-total_return;
    $('#balance').val(total.toFixed(2));
    $('#balance_amount').val(total.toFixed(2));
  }else{
    $('#balance').val('00.00');
    $('#balance_amount').val('00.00');
    $('#btnSave').attr('disabled',false);
  }

  var vat=<?php echo (!empty($vat))?$vat:'0';?>;
  var net_vat=total_amount/vat;
  var total_vat=total_amount-net_vat;
  $('#vat').val(total_vat.toFixed(2));

}

function compute_total_replace(){
  var total_amount=0;
  var total_payment=0;
  var threshold=0;
  tr=$('#managereturn tbody tr').length;
  for(var index=1;index<=tr;index++){
    total_amount += parseFloat($('#managereturn tbody tr:nth-child('+index+') td:nth-child(6)').text());
  }
  $('#total_replace').val(total_amount.toFixed(2));
  var total_return=$('#total_return').val();
  if(total_amount>total_return){
    var total=total_amount-total_return;
    $('#balance').val(total.toFixed(2));
    $('#balance_amount').val(total.toFixed(2));
  }else{
    $('#balance').val('00.00');
    $('#balance_amount').val('00.00');
  }

  var vat=<?php echo (!empty($vat))?$vat:'0';?>;
  var net_vat=total_amount/vat;
  var total_vat=total_amount-net_vat;
  $('#vat').val(total_vat.toFixed(2));

}

function compute_replace(barcode){
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
    compute_total_replace(); 
  }
}

function remove_replace(code) {
  var status=false;
  var table=$('#managereturn tbody tr').length;

  for(var index=1;index<=table;index++){
    bar=$('#managereturn tbody tr:nth-child('+index+') td:nth-child(1)').text();
    if(bar==code){
      status=true;
      break;
    }
  }
  if(status){
    $('#managereturn tbody tr:nth-child('+index+')').remove();
    compute_total_replace();
  }
}
</script>