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
              <span>Purchase</span>
          </li>
      </ul>
    </div>
    <!-- END PAGE HEADER-->
    <form method="post" id="form_add" action="<?php echo base_url()?>purchase/insert" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-12">
          <div id="messages"></div>
            <div class="row">
              <div class="col-md-9">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                  <div class="portlet-body">
                    <div  class="scroller" style="height:560px" data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green">
                      <div class="table">
                        <table class="table table-striped table-bordered table-hover" id="manageTable">
                          <thead>
                            <tr>
                              <th class="sorting" style="width: 10px;"> Barcode </th>
                              <th class="sorting" style="width: 80px;"> Product </th>
                              <th class="sorting" style="width: 50px;"> Quantity </th>
                              <th class="sorting" style="width: 50px;"> Price </th>
                              <th class="sorting" style="width: 50px;"> Sub Total </th>
                              <th style="width: 10px;"> Actions </th>
                            </tr>
                          </thead>
                          <tbody></tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
              </div>
              <div class="col-md-3">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                  <div class="form-group">
                    <label class="control-label">Supplier (F4)</label>
                    <select name="supplier" class="form-control" id="supplier">
                      <?php foreach($supplier as $key => $value):?>
                        <option value="<?php echo $value['id'];?>"><?php echo $value['supplier'];?></option>
                      <?php endforeach;?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Barcode Number (F2)</label>
                    <input type="text" class="form-control" id="barcode" autocomplete="off" autofocus>
                  </div>
                </div>
                <div class="portlet light bordered">
                  <div class="form-group">
                    <label>Total Price</label>
                    <input type="text" class="form-control" name="purchase_price" readonly id="total_price">
                  </div>
                  <div class="form-group">
                    <label>Total Quantity</label>
                    <input type="text" class="form-control" name="purchase_quantity" readonly id="total_qty">
                  </div>
                  <div class="form-group">
                    <label>Official Receipt (F8)</label>
                    <input type="number" class="form-control" name="or_number" id="or_number" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label>Date Supplied (F7)</label>
                    <input type="text" class="input-group form-control form-control-inline date date-picker" autocomplete="off" name="date_supplied" data-date-format="yyyy-mm-dd" id="date_supplied">
                  </div>
                </div>
                <div class="portlet light bordered">
                  <div>
                    <button class="icon-btn" style="width: 100%" id="btnsave"><i class="fa fa-save"></i><div>Save</div></button>
                  </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
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
  var manageTable;
  $(document).ready(function(){

    $('#barcode').on('change',function(){
      var barcode=$('#barcode').val();
      var supplier=$('#supplier').val();
      var table=$('#manageTable tbody tr').length;
      var status=false;
      
        $.ajax({
          type : 'POST',
          url : '<?php echo base_url()?>purchase/search/'+barcode,
          dataType : 'json',
          success : function(response){
            for(var x=0;x<response.length;x++){
              if(response[x].supplier_id == supplier){ 

                var tr_barcode;
                for(var index=1;index<=table;index++){
                  tr_barcode=$('#manageTable tbody tr:nth-child('+index+') td:nth-child(1)').text();
                    if(tr_barcode==response[x].barcode){
                      status=true;
                      break;
                    }
                }

                if(status){
                  var qty=$('#cart'+tr_barcode+' td:nth-child(3) input').val();
                  var price=$('#cart'+tr_barcode+' td:nth-child(4) input').val();
                  var new_qty=parseInt(qty)+1;
                  var subtotal=parseInt(new_qty)*parseFloat(price);

                  $('#cart'+tr_barcode+' td:nth-child(3) input').val(new_qty);
                  $('#cart'+tr_barcode+' td:nth-child(5) input').val(subtotal);


                  compute_total_amount();
                  $('#barcode').focus();
                  $('#barcode').val('');
                  return;
                }

                $('#manageTable tbody').append('<tr id="cart'+response[x].barcode+'"><td><input type="hidden" name="product[]" value="'+response[x].id
                +'"><input type="hidden" name="sellingprice[]" value="'+response[x].id
                +'">'+response[x].barcode
                +'</td><td>'+response[x].product
                +'</td><td><input type="number" value="1" onkeyup="compute_total('+response[x].barcode+')" class="form-control input-sm" name="quantity[]"/></td><td><input type="text" value="'+response[x].manufacturer_price+'" class="form-control input-sm" name="price[]" readonly autocomplete="off" /></td><td><input type="text" value="'+response[x].manufacturer_price+'" class="form-control input-sm" name="totalprice[]" readonly /></td><td><a onclick="remove('+response[x].barcode+')" class="btn btn-danger btn-xs"><i class="fa fa-times"><i></a></td></tr>');
                  
                $('#barcode').focus();
                $('#barcode').val('');
                compute_total_amount();
              }
            }
          }
        });
        return false;
    });

    $('#form_add').unbind('submit').on('submit', function(e) {
      var form = $(this);

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(),
        dataType: 'json',
        success:function(response) {
          if(response.success === true) {
            alert(response.messages);
            location.reload();
          }
        }
      });
      return false;
    });

    $('#supplier').on('change', function(){
      reset();
    });
  });

  function compute_total(barcode){
    var total=0;
    var qty=parseInt($('#cart'+barcode+' td:nth-child(3) input').val());
    var price=parseFloat($('#cart'+barcode+' td:nth-child(4) input').val());
    var total=price*qty;

    $('#cart'+barcode+' td:nth-child(5) input').val(total.toFixed(2));

    compute_total_amount();
  }

  function compute_total_amount(){
    var total_price=0;
    var total_qty=0;

    tr=$('#manageTable tbody tr').length;
    for(var index=1;index<=tr;index++){
      total_price += parseFloat($('#manageTable tbody tr:nth-child('+index+') td:nth-child(5) input').val());
      total_qty += parseInt($('#manageTable tbody tr:nth-child('+index+') td:nth-child(3) input').val());
    }
    $('#total_price').val(total_price.toFixed(2));
    $('#total_qty').val(total_qty);
  }

  
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

  function reset(){
    $('#total_qty').val('');
    $('#total_price').val('');
    $('#or_number').val('');
    $('#date_supplied').val('');
    $('#manageTable tbody tr').remove();
    $('#barcode').val('');
    
  }
  
  document.onkeyup = function(e) {

  //alert(e.which);
  switch(e.which) {
    case 119:$('#or_number').focus();break;
    case 113:$('#barcode').focus();break;
    case 115:$('#supplier').focus();break;
    case 118:$("#date_supplied").focus();break;
    }
  };
</script>