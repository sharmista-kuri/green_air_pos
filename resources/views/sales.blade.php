@extends('layouts.master')
@section('content')
<form id="sales_form"  method="post" action="{{ route('sale.store') }}" enctype="multipart/form-data">
@csrf
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-8 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Sales</h4>
            <p class="card-description">
              Sales Product
            </p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Invoice No</label>
                  <div class="col-sm-8">
                    <input required id="invoice_no" name="invoice_no" type="text" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">User</label>
                  <div class="col-sm-9">
                    <select id="employee_id" name="employee_id" class="form-control">
                      @foreach($employees as $employee)
                      <option value="{{$employee->id}}">{{$employee->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Sale Date</label>
                        <div class="col-sm-8">
                            <input required id="sale_date" name="sale_date" type="date" class="form-control" placeholder="dd/mm/yyyy"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Sale Type</label>
                  <div class="col-sm-4">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input required type="radio" class="form-check-input" name="sale_type" id="sale_type1" value="1">
                            Retial
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="sale_type" id="sale_type2" value="2">
                            Wholesale
                        </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Customer ID</label>
                    <div class="col-sm-6" id="cust_div">
                        <select onchange="cust_info()" id="customer_id" name="customer_id" class="form-control">
                        @foreach($customers as $customer)
                          <option value="{{$customer->id}}">{{$customer->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="forms-sample">
                      <i onclick="add_customer()" class="mdi mdi-plus-circle icon-lg mr-3 text-primary"></i>
                    </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Product ID</label>
                    <div class="col-sm-8">
                        <select id="product_id" name="product_id" class="form-control">
                        @foreach($products as $product)
                          <option value="{{$product->id}}">{{$product->name}}({{$product->id}})</option>
                        @endforeach
                        </select>
                    </div>
                    <!-- <div class="forms-sample">
                      <i class="mdi mdi-plus-circle icon-lg mr-3 text-primary"></i>
                    </div> -->
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Name</label>
                  <div class="col-sm-9">
                    <input disabled id="customer_name" name="customer_name" type="text"class="form-control" >
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Name</label>
                  <div class="col-sm-9">
                    <input disabled id="product_name" name="product_name" type="text" class="form-control" />
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Address</label>
                  <div class="col-sm-9">
                    <textarea  disabled id="customer_address" name="customer_address" class="form-control" rows="4"></textarea>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Quantity</label>
                  <div class="col-sm-4">
                    <input onblur="quantity_cal()" id="quantity" name="quantity" type="text" class="form-control" />
                  </div>
                  <label class="col-sm-2 col-form-label">Pcs</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Contact No</label>
                  <div class="col-sm-9">
                    <input disabled id="contact_no" name="contact_no" type="text"class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Rate</label>
                  <div class="col-sm-4">
                    <input disabled id="rate" name="rate" type="text" class="form-control" />
                  </div>
                  <div class="">
                  <label class="col-form-label container-fluid table-success py-2" style="color:red">STOCK</label>
                  <label class="col-form-label container-fluid table-success py-2" style="color:blue"><span id="stock" name="stock"></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                    <input disabled id="customer_email" name="customer_email" type="text"class="form-control" >
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Amount</label>
                  <div class="col-sm-4">
                    <input disabled id="amount" name="amount" type="text" class="form-control" />
                  </div>
                  <div class="forms-sample">
                    <button onclick="add_to_cart()" type="button" class="btn btn-primary mr-2">Add To Cart</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12 stretch-card">
                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Information</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Rate</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="product_tbody">
                        </tbody>
                        <input type="hidden" id="tr_counter" name="tr_counter" value="1"/>
                    </table>
                </div>
            </div>
          
        </div>
      </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Amount Details</h4>
          
            <p class="card-description">
                Amount Details
            </p>
            <div class="form-group">
                <label class="col-sm-12 col-form-label">Sub Total</label>
                <label class="col-sm-12 col-form-label"><span id="subtotal_span">0.00</span></label>
                <input id="subtotal" name="subtotal" value="0.00" type="hidden" class="form-control" />
            </div>
            <div class="form-group">
                <label class="col-sm-12 col-form-label">VAT</label>
                <div class="row">
                    <div class="col-md-4">
                        <input onblur="vat_cal()" id="vat_percent" name="vat_percent" value="0" type="text" class="form-control" />
                    </div>
                    %
                    <div class="col-md-7">
                        <input id="vat" name="vat" value="0.00" type="text" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-12 col-form-label">Transport/Labour</label>
                <input id="transport_labour" name="transport_labour" value="0" type="text" class="form-control" />
            </div>
            <div class="form-group">
                <label class="col-sm-12 col-form-label">Discount</label>
                <div class="row">
                    <div class="col-md-4">
                        <input onblur="discount_cal()" id="discount_percent" name="discount_percent" value="0" type="text" class="form-control" />
                    </div>
                    %
                    <div class="col-md-7">
                        <input id="discount" name="discount" value="0.00" type="text" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-12 col-form-label">Total</label>
                <label class="col-sm-12 col-form-label" id="total_label">0.00</label>
                <input id="total" name="total" value="0.00" type="hidden" class="form-control" />
            </div>
            <div class="form-group">
                <label class="col-sm-12 col-form-label">Paid</label>
                <input id="paid" name="paid" value="0.00" type="text" class="form-control" />
            </div>   
            <div class="form-group">
                <label class="col-sm-12 col-form-label">Due</label>
                <input id="due" name="due" value="0.00" type="text" class="form-control" />
            </div>                
          
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Notes</label>
                  <div class="col-sm-8">
                    <textarea id="remarks" name="remarks" class="form-control" id="exampleTextarea1" rows="4"></textarea>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <h2>Total= </h2>
                  <h2><span style="color:red" id="total_span" name="total_span"> 0.00 tk</span></h2>
                </div>
              </div>
              <div class="forms-sample">
                    <button type="submit" class="btn btn-primary mr-2">Sell</button>
                    <button type="button" class="btn btn-primary mr-2">Print</button>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>

<form id="customer_form">
@csrf
<div id="customer_add_modal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Customer Add</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-12 grid-margin">
          <div class="card">
            <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Customer ID</label>
                      <div class="col-sm-9">
                      <label class="col-sm-6 col-form-label" id="customer_id_label"></label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Name</label>
                      <div class="col-sm-9">
                        <input required id="name" name="name" type="text" class="form-control" />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Phone</label>
                      <div class="col-sm-9">
                        <input required id="primary_contact" name="primary_contact" type="text" class="form-control" />
                      </div>
                    </div>
                  </div>
                </div>
               
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Customer Type</label>
                      <div class="col-sm-9">
                          <select id="customer_type_array" style="width: 100%;" class="form-control1" multiple data-live-search="true">
                            <option value="1">Retail</option>
                            <option value="2">Wholesale</option>
                          </select>
                          <script>
                            jQuery('#customer_type_array').multipleSelect({ 
                              placeholder: "Select Customer Type", 
                              selectAll: true, 
                              multiple: false, 
                              multipleWidth: 120
                            });
                          </script>
                          <input type="hidden" id="customer_type" name="customer_type" value="0">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Phone 2</label>
                      <div class="col-sm-9">
                        <input id="secondary_contact" name="secondary_contact" type="text" class="form-control" value=" "/>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Address</label>
                      <div class="col-sm-9">
                      <textarea required id="address" name="address" class="form-control" rows="4"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Email</label>
                      <div class="col-sm-9">
                        <input id="email" name="email" type="text" class="form-control" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Area</label>
                      <div class="col-sm-9">
                        <input id="area" name="area" type="text" class="form-control" />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Country</label>
                      <div class="col-sm-9">
                        <select required id="counntry" name="country" class="form-control">
                          <option>Bangladesh</option>
                          <option>America</option>
                          <option>China</option>
                          <option>Russia</option>
                          <option>Britain</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="CustomerSaveButton" type="button" class="btn btn-primary">Save</button>
        <span id="loading" style="display:none">Please wait... <img src="<?=config('app.url')?>/resources/master/images/loader.gif" align="bottom"></span>
      </div>
    </div>
  </div>
</div>
</form>




<script>
jQuery(document).ready(function (){
  cust_info();
  product_info();
});
  function cust_info(){
    var customer_id = jQuery("#customer_id").val();
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "customer_info",
        data : { "_token": "{{ csrf_token() }}","customer_id":customer_id},
        datatype: "json",
        success: function(datas){
          data = JSON.parse(datas);
          jQuery("#customer_name").val(data.name);
          jQuery("#customer_address").text(data.address);
          jQuery("#contact_no").val(data.primary_contact);
          jQuery("#customer_email").val(data.email);
              
        }
    }); 
	}

  function product_info(){
    var product_id = jQuery("#product_id").val();
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "product_info",
        data : { "_token": "{{ csrf_token() }}","product_id":product_id},
        datatype: "json",
        success: function(datas){
          data = JSON.parse(datas);
          jQuery("#product_name").val(data.name);
          jQuery("#rate").val(data.purchase_price);
          jQuery("#stock").text(data.current_stock);
        }
    }); 
	}

  function add_to_cart(){
    var tr_counter = jQuery("#tr_counter").val();
    var product_id = jQuery("#product_id").val();
    var product_name = jQuery("#product_name").val();
    var quantity = jQuery("#quantity").val();
    var rate = jQuery("#rate").val();
    var amount = parseFloat(jQuery("#amount").val()).toFixed(2);
    
    var str = "";
    str+='<tr id="tr_'+tr_counter+'" class="table-success">';
    str+='          <td></td>';

    str+='          <td>'+product_name+'<input type="hidden" id="product_'+tr_counter+'" name="product_'+tr_counter+'" value="'+product_id+'"/></td>';

    str+='          <td>'+quantity+'<input type="hidden" id="quantity_'+tr_counter+'" name="quantity_'+tr_counter+'" value="'+quantity+'"/></td>';

    str+='          <td>pcs</td>';

    str+='          <td>'+rate+'<input type="hidden" id="rate_'+tr_counter+'" name="rate_'+tr_counter+'" value="'+rate+'"/></td>';

    str+='          <td>'+amount+'<input type="hidden" id="amount_'+tr_counter+'" name="amount_'+tr_counter+'" value="'+amount+'"/></td>';

    str+='          <td><input type="hidden" id="delete_'+tr_counter+'" name="delete_'+tr_counter+'" value="0"/><i onclick="delete_cart('+tr_counter+')" class="mdi mdi-delete-circle icon-md text-primary"></i></td>';

    str+='      </tr>';

    jQuery("#product_tbody").append(str);
    jQuery("#tr_counter").val(parseInt(tr_counter)+1);

    var subtotal = (parseFloat(jQuery("#subtotal").val())+ parseFloat(jQuery("#amount").val())).toFixed(2);

    var total = (parseFloat(jQuery("#total").val())+ parseFloat(jQuery("#amount").val())+parseFloat(jQuery("#vat").val())+parseFloat(jQuery("#transport_labour").val())-parseFloat(jQuery("#discount").val())).toFixed(2);

    var paid = (parseFloat(jQuery("#paid").val())+ parseFloat(jQuery("#amount").val())).toFixed(2);

    jQuery("#subtotal").val(subtotal);
    jQuery("#subtotal_span").text(subtotal);
    jQuery("#total").val(total);
    jQuery("#total_span").text(total);
    jQuery("#total_label").text(total);
    jQuery("#paid").val(paid);

    jQuery("#quantity").val("");
    jQuery("#amount").val("");




  }

  function delete_cart(i){
    jQuery("#delete_"+i).val(1);
    jQuery("#tr_"+i).hide();

  }

  function quantity_cal(){
    var rate = parseFloat(jQuery("#rate").val());
    var quantity = parseFloat(jQuery("#quantity").val());
    var amount = rate * quantity;
    jQuery("#amount").val(amount);
  }

  function vat_cal(){
    var vat_percent = parseFloat(jQuery("#vat_percent").val());
    var vat = (vat_percent % 100).toFixed(2);
    jQuery("#vat").val(vat);
    
  }

  function discount_cal(){
    var discount_percent = parseFloat(jQuery("#discount_percent").val());
    var discount = (discount_percent % 100).toFixed(2);
    jQuery("#discount").val(discount);
  }

  function add_customer(){
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "customer_id",
        data : { "_token": "{{ csrf_token() }}"},
        datatype: "json",
        success: function(datas){
          data = JSON.parse(datas);
          id = parseInt(data.id)+1;
          //alert(id);
          jQuery("#customer_id_label").text(id);
        }
    });

    $('#customer_add_modal').modal('show');
  }

  jQuery('#customer_form').jqxValidator({
      hintType: "label",
			theme:"light",
      rules: [
          { input: '#name', message: 'Required!', action: 'keyup,blur', rule:'required' },
          
          
      ]
  });

  jQuery("#CustomerSaveButton").click(function () {			
		var validationResult = function (isValid) {
			if (isValid) {
				call_ajax_submit();
			}
		}
		jQuery('#customer_form').jqxValidator('validate', validationResult);
		//call_ajax_submit();
	});

  function call_ajax_submit()
	{
		jQuery("#CustomerSaveButton").hide();
		jQuery("#loading").show();
		
    
    jQuery('#customer_type').val(jQuery('#customer_type_array').val());
		var form = $('#customer_form')[0];
		var data = new FormData(form);
		//alert(data); 
		jQuery.ajax({
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
            type: "POST",
            cache: false,
            contentType: false,
   			    processData: false,
   			
   			    //processData: false,
   			    enctype: 'multipart/form-data',
            url: "{{ route('customer.store') }}",
            //data : { "_token": "{{ csrf_token() }}","postdata":data},
            data: data,
            datatype: "json",
            success: function(data){
            	jQuery("#loading").hide();
              jQuery("#CustomerSaveButton").show();
              
              $('#customer_add_modal').modal('toggle');

              jQuery.ajax({
                type: "POST",
                cache: false,
                url: "customer_select_box",
                data : { "_token": "{{ csrf_token() }}"},
                datatype: "json",
                success: function(datas){
                  $("#cust_div").html(datas);
                }
            }); 



              
                  
          }
        });	
	}


</script>



@endsection
