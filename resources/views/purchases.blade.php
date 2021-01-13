@extends('layouts.master')
@section('content')
<form id="purchase_form"  method="post" action="{{ route('purchase_print') }}" enctype="multipart/form-data">
@csrf
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-8 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Purchase</h4>
            <p class="card-description">
              Purchase Product
            </p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Invoice No <span style="color:red">*</span></label>
                  <div class="col-sm-8">
                    <label class="col-form-label" id="invoice_no_show"></label>
                    <input id="invoice_no" name="invoice_no" type="hidden" class="form-control"/>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">User <span style="color:red">*</span></label>
                  <div id="employee_id" name="employee_id">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Purchase Date <span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <input value="<?php echo date('Y-m-d')?>" required id="purchase_date" name="purchase_date" type="date" class="form-control" placeholder="dd/mm/yyyy"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Purchase Type <span style="color:red">*</span></label>
                  <div class="col-sm-4">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="purchase_type" id="purchase_type1" value="1">
                            Retail
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-check">
                        <label class="form-check-label">
                          <input checked required type="radio" class="form-check-input" name="purchase_type" id="purchase_type2" value="2">
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
                  <label class="col-sm-3 col-form-label">Supplier ID <span style="color:red">*</span></label>
                  <div onchange="supplier_info()" id="supplier_id" name="supplier_id"></div>
                  <div class="forms-sample">
                    <i onclick="add_supplier()" class="mdi mdi-plus-circle icon-lg mr-3 text-primary"></i>
                  </div>
                  </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Category <span style="color:red">*</span></label>
                  <div onchange="category_product()" id="category_ids" name="category_id">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Name</label>
                  <div class="col-sm-9">
                    <input disabled id="supplier_name" type="text"class="form-control" >
                    <input id="supplier_name_hidden" name="supplier_name"  type="hidden" class="form-control" >
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Brand <span style="color:red">*</span></label>
                  <div onchange="brand_product()" id="brand_ids" name="brand_id">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Address</label>
                  <div class="col-sm-9">
                    <textarea disabled id="supplier_address" class="form-control" rows="4"></textarea>
                    <input id="supplier_address_hidden" name="supplier_address"  type="hidden" class="form-control" >
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Product ID <span style="color:red">*</span></label>
                  <div onchange="product_info()" id="product_id" name="product_id">
                  </div>
                  <div class="forms-sample">
                    <i onclick="add_product()" class="mdi mdi-plus-circle icon-lg mr-3 text-primary"></i>
                  </div>
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
                  <label class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                    <input disabled id="supplier_email" name="supplier_email" type="text"class="form-control" >
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Quantity <span style="color:red">*</span></label>
                  <div class="col-sm-4">
                    <input onblur="quantity_cal()" id="quantity" name="quantity" type="text" class="form-control" />
                  </div>
                  <label class="col-sm-2 col-form-label">Pcs</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Rate</label>
                  <div class="col-sm-4">
                    <input onblur="quantity_cal()" id="rate" name="rate" type="text" class="form-control" />
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
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
                    <button type="button" id="purchase_save_button" class="btn btn-primary mr-2">Purchase</button>
                    <button type="submit" class="btn btn-primary mr-2">Print</button>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>

<!-- Supplier -->

<form id="supplier_form">
  @csrf
  <div id="supplier_add_modal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title">Supplier Add</h5>
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
                      <label class="col-sm-2 col-form-label">Supplier ID</label>
                      <div class="col-sm-9">
                      <label class="col-sm-6 col-form-label" id="supplier_id_label"></label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Name <span style="color:red">*</span></label>
                      <div class="col-sm-9">
                        <input required id="supplier_name_form" name="name" type="text" class="form-control" />
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
                      <label class="col-sm-3 col-form-label">Supplier Type <span style="color:red">*</span></label>
                      <div class="col-sm-9">
                          <select id="supplier_type_array" style="width: 100%;" class="form-control1" multiple data-live-search="true">
                            <option value="1">Retail</option>
                            <option value="2">Wholesale</option>
                          </select>
                          <script>
                            jQuery('#supplier_type_array').multipleSelect({ 
                              placeholder: "Select Supplier Type", 
                              selectAll: true, 
                              multiple: false, 
                              multipleWidth: 120
                            });
                          </script>
                          <input type="hidden" id="supplier_type" name="supplier_type" value="0">
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
          <button id="SupplierSaveButton" type="button" class="btn btn-primary">Save</button>
          <span id="supplierloading" style="display:none">Please wait... <img src="<?=config('app.url')?>/resources/master/images/loader.gif" align="bottom"></span>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Product -->

<form id="product_form">
  @csrf
  <div id="product_add_modal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title">Product Add</h5>
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
                        <label class="col-sm-3 col-form-label">Category <span style="color:red">*</span></label>
                        <div id="category_id" name="category_id">
                        </div>
                        <div class="col-sm-1 forms-sample">
                          <i onclick="add_category()" class="mdi mdi-plus-circle icon-lg mr-3 text-primary"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Brand <span style="color:red">*</span></label>
                        <div id="brand_id" name="brand_id">
                        </div>
                        <div class="col-sm-1 forms-sample">
                          <i onclick="add_brand()" class="mdi mdi-plus-circle icon-lg mr-3 text-primary"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Name <span style="color:red">*</span></label>
                        <div class="col-sm-9">
                          <input required id="products_name" name="name" type="text" class="form-control" />
                        </div>
                      </div>
                    </div>

                  </div>
                
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                        <textarea required id="description" name="description" class="form-control" rows="4"></textarea>
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
          <button id="ProductSaveButton" type="button" class="btn btn-primary">Save</button>
          <span id="productloading" style="display:none">Please wait... <img src="<?=config('app.url')?>/resources/master/images/loader.gif" align="bottom"></span>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Category -->

<form id="category_form">
  @csrf
  <div id="category_add_modal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title">Category Add</h5>
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
                      <label class="col-sm-3 col-form-label">Name <span style="color:red">*</span></label>
                      <div class="col-sm-9">
                        <input required id="category_name" name="name" type="text" class="form-control" />
                      </div>
                    </div>
                  </div>
                </div>
              
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Description</label>
                      <div class="col-sm-9">
                      <textarea required id="category_description" name="description" class="form-control" rows="4"></textarea>
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
          <button id="CategorySaveButton" type="button" class="btn btn-primary">Save</button>
          <span id="categoryloading" style="display:none">Please wait... <img src="<?=config('app.url')?>/resources/master/images/loader.gif" align="bottom"></span>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Brand -->

<form id="brand_form">
  @csrf
  <div id="brand_add_modal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title">Brand Add</h5>
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
                      <label class="col-sm-3 col-form-label">Name <span style="color:red">*</span></label>
                      <div class="col-sm-9">
                        <input required id="brand_name" name="name" type="text" class="form-control" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Description</label>
                      <div class="col-sm-9">
                      <textarea required id="brand_description" name="description" class="form-control" rows="4"></textarea>
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
          <button id="BrandSaveButton" type="button" class="btn btn-primary">Save</button>
          <span id="brandloading" style="display:none">Please wait... <img src="<?=config('app.url')?>/resources/master/images/loader.gif" align="bottom"></span>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
  jQuery(document).ready(function($) {
    var theme = 'classic';
    var employee_id = [<? $i=1; foreach($employees as $value){ if($i!=1){echo ',';} echo '{value:"'.$value->id.'", label:"'.$value->name.'"}'; $i++;}?>];
	  jQuery("#employee_id").jqxComboBox({theme: theme, promptText: "Select Employee", source: employee_id});
  
    var supplier_id = [<? $i=1; foreach($suppliers as $value){ if($i!=1){echo ',';} echo '{value:"'.$value->id.'", label:"'.$value->name.'"}'; $i++;}?>];
	  jQuery("#supplier_id").jqxComboBox({theme: theme, promptText: "Select Supplier", source: supplier_id, width: '170'});
  
    var product_id = [<? $i=1; foreach($products as $value){ if($i!=1){echo ',';} echo '{value:"'.$value->id.'", label:"'.$value->name.'"}'; $i++;}?>];
	  jQuery("#product_id").jqxComboBox({theme: theme, promptText: "Select Product", source: product_id, width: '170'});
  
    var category_id = [<? $i=1; foreach($categories as $value){ if($i!=1){echo ',';} echo '{value:"'.$value->id.'", label:"'.$value->name.'"}'; $i++;}?>];
	  jQuery("#category_id").jqxComboBox({theme: theme, promptText: "Select Category", source: category_id});

    var brand_id = [<? $i=1; foreach($brands as $value){ if($i!=1){echo ',';} echo '{value:"'.$value->id.'", label:"'.$value->name.'"}'; $i++;}?>];
	  jQuery("#brand_id").jqxComboBox({theme: theme, promptText: "Select Brand", source: brand_id});

    var category_id = [<? $i=1; foreach($categories as $value){ if($i!=1){echo ',';} echo '{value:"'.$value->id.'", label:"'.$value->name.'"}'; $i++;}?>];
	  jQuery("#category_ids").jqxComboBox({theme: theme, promptText: "Select Category", source: category_id});

    var brand_id = [<? $i=1; foreach($brands as $value){ if($i!=1){echo ',';} echo '{value:"'.$value->id.'", label:"'.$value->name.'"}'; $i++;}?>];
	  jQuery("#brand_ids").jqxComboBox({theme: theme, promptText: "Select Brand", source: brand_id});
  
    invoice_create();
  
  });

  function invoice_create(){
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "{{route('purchase_invoice_create')}}",
        data : { "_token": "{{ csrf_token() }}"},
        datatype: "json",
        success: function(datas){
          id = 1;
          if(datas!="null"){
            data = JSON.parse(datas);
            id = parseInt(data.id)+1;
          }
          date = $("#purchase_date").val();
          id = "SI-"+date+"-"+id;

          jQuery("#invoice_no_show").text(id);
          jQuery("#invoice_no").val(id);
        }
    }); 
  }

  jQuery('#purchase_form').jqxValidator({
      hintType: "label",
			theme:"light",
      rules: [
         // { input: '#invoice_no', message: 'Required!', action: 'keyup,blur', rule:'required' },
         
          
          
      ]
  });

  jQuery("#purchase_save_button").click(function () {			
		/* var validationResult = function (isValid) {
			if (isValid) {
				purchase();
			}
		}
    jQuery('#purchase_form').jqxValidator('validate', validationResult); */
    purchase();
	});

  function purchase()
  {
		jQuery("#purchase_save_button").hide();    
		var form = $('#purchase_form')[0];
		var data = new FormData(form);

		jQuery.ajax({
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        enctype: 'multipart/form-data',
        url: "{{ route('purchases.store') }}",
        data: data,
        datatype: "json",
        success: function(data){
          jQuery("#purchase_save_button").show();
          alert("Successfully Saved"); 
              
      }
    });	
	}

  function supplier_info(){
    var supplier_id = jQuery("#supplier_id").jqxComboBox('getSelectedItem').value;
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "{{route('supplier_info')}}",
        data : { "_token": "{{ csrf_token() }}","supplier_id":supplier_id},
        datatype: "json",
        success: function(datas){
          data = JSON.parse(datas);
          jQuery("#supplier_name").val(data.name);
          jQuery("#supplier_name_hidden").val(data.name);
          jQuery("#supplier_address").text(data.address);
          jQuery("#supplier_address_hidden").val(data.address);
          jQuery("#contact_no").val(data.primary_contact);
          jQuery("#supplier_email").val(data.email);
              
        }
    }); 
	}

  function product_info(){
    var product_id = jQuery("#product_id").jqxComboBox('getSelectedItem').value;
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "{{route('product_info')}}",
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
    var product_id = jQuery("#product_id").jqxComboBox('getSelectedItem').value;
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
    if(jQuery("#rate").val()!=""&&jQuery("#quantity").val()!=""){
      var rate = parseFloat(jQuery("#rate").val());
      var quantity = parseFloat(jQuery("#quantity").val());
      var amount = rate * quantity;
      jQuery("#amount").val(amount);
    }
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

  function add_supplier(){
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "{{route('supplier_id')}}",
        data : { "_token": "{{ csrf_token() }}"},
        datatype: "json",
        success: function(datas){
          id = 1000000;
          if(datas!="null"){
            data = JSON.parse(datas);
            id = parseInt(data.id)+1;
          }
          jQuery("#supplier_id_label").text(id);
        }
    });

    $('#supplier_add_modal').modal('show');
  }

  jQuery('#supplier_form').jqxValidator({
      hintType: "label",
			theme:"light",
      rules: [
          { input: '#supplier_name_form', message: 'Required!', action: 'keyup,blur', rule:'required' },
      ]
  });

  jQuery("#SupplierSaveButton").click(function () {			
		var validationResult = function (isValid) {
			if (isValid) {
				supplier_call_ajax_submit();
			}
		}
		jQuery('#supplier_form').jqxValidator('validate', validationResult);
	});

  function supplier_call_ajax_submit()
	{
		jQuery("#SupplierSaveButton").hide();
		jQuery("#supplierloading").show();
		
    
    jQuery('#supplier_type').val(jQuery('#supplier_type_array').val());
		var form = $('#supplier_form')[0];
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
            url: "{{ route('suppliers.store') }}",
            //data : { "_token": "{{ csrf_token() }}","postdata":data},
            data: data,
            datatype: "json",
            success: function(data){
            	jQuery("#supplierloading").hide();
              jQuery("#SupplierSaveButton").show();
              
              $('#supplier_add_modal').modal('toggle');

              jQuery.ajax({
                type: "POST",
                cache: false,
                url: "{{ route('supplier_select_box')}}",
                data : { "_token": "{{ csrf_token() }}"},
                datatype: "json",
                success: function(data){
                  var json = jQuery.parseJSON(data);
                  var sup = json.sup;
                  jQuery("#supplier_id").jqxComboBox({source: sup});
                }
            }); 



              
                  
          }
        });	
  }
  

  function add_product(){
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "{{route('product_id')}}",
        data : { "_token": "{{ csrf_token() }}"},
        datatype: "json",
        success: function(datas){
          id = 1000000;
          if(datas!="null"){
            data = JSON.parse(datas);
            id = parseInt(data.id)+1;
          }
          jQuery("#product_id_label").text(id);
        }
    });

    $('#product_add_modal').modal('show');
  }

  jQuery('#product_form').jqxValidator({
      hintType: "label",
			theme:"light",
      rules: [
          { input: '#products_name', message: 'Required!', action: 'keyup,blur', rule:'required' },
      ]
  });

  jQuery("#ProductSaveButton").click(function () {			
		var validationResult = function (isValid) {
			if (isValid) {
				product_call_ajax_submit();
			}
		}
		jQuery('#product_form').jqxValidator('validate', validationResult);
	});

  function product_call_ajax_submit()
	{
		jQuery("#ProductSaveButton").hide();
		jQuery("#productloading").show();
    
		var form = $('#product_form')[0];
		var data = new FormData(form);
    
    jQuery.ajax({
			  headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        enctype: 'multipart/form-data',
        url: "{{ route('products.store') }}",
        data: data,
        datatype: "json",
        success: function(data){
          $("#productloading").hide();
          $("#ProductSaveButton").show();
          $('#product_add_modal').modal('toggle');

          jQuery.ajax({
            type: "POST",
            cache: false,
            url: "{{ route('product_select_box')}}",
            data : { "_token": "{{ csrf_token() }}"},
            datatype: "json",
            success: function(data){
              var json = jQuery.parseJSON(data);
              var pro = json.pro;
              jQuery("#product_id").jqxComboBox({source: pro});
            }
        });                
      }
    });	
  }

  function add_category(){
    $('#category_add_modal').modal('show');
  }

  jQuery('#category_form').jqxValidator({
      hintType: "label",
			theme:"light",
      rules: [
          //{ input: '#brand_id', message: 'Required!', action: 'keyup,blur', rule:'required' },
          { input: '#category_name', message: 'Required!', action: 'keyup,blur', rule:'required' },
      ]
  });

  jQuery("#CategorySaveButton").click(function () {			
		var validationResult = function (isValid) {
			if (isValid) {
				category_call_ajax_submit();
			}
		}
		jQuery('#category_form').jqxValidator('validate', validationResult);
	});

  function category_call_ajax_submit()
	{
		jQuery("#CategorySaveButton").hide();
		jQuery("#categoryloading").show();
    
		var form = $('#category_form')[0];
		var data = new FormData(form);
    
    jQuery.ajax({
			  headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        enctype: 'multipart/form-data',
        url: "{{ route('categories.store') }}",
        data: data,
        datatype: "json",
        success: function(data){
          $("#categoryloading").hide();
          $("#CategorySaveButton").show();
          $('#category_add_modal').modal('toggle');

          jQuery.ajax({
            type: "POST",
            cache: false,
            url: "{{ route('category_select_box') }}",
            data : { "_token": "{{ csrf_token() }}"},
            datatype: "json",
            success: function(data){
              var json = jQuery.parseJSON(data);
              var cat = json.cat;
              jQuery("#category_id").jqxComboBox({source: cat});
            }
        });                
      }
    });	
  }

  function add_brand(){
    $('#brand_add_modal').modal('show');
  }

  jQuery('#brand_form').jqxValidator({
      hintType: "label",
			theme:"light",
      rules: [
          { input: '#brand_name', message: 'Required!', action: 'keyup,blur', rule:'required' },
      ]
  });

  jQuery("#BrandSaveButton").click(function () {			
		var validationResult = function (isValid) {
			if (isValid) {
				brand_call_ajax_submit();
			}
		}
		jQuery('#brand_form').jqxValidator('validate', validationResult);
	});

  function brand_call_ajax_submit()
	{
		jQuery("#BrandSaveButton").hide();
		jQuery("#brandloading").show();
    
		var form = $('#brand_form')[0];
		var data = new FormData(form);
    
    jQuery.ajax({
			  headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        enctype: 'multipart/form-data',
        url: "{{ route('brands.store') }}",
        data: data,
        datatype: "json",
        success: function(data){
          $("#brandloading").hide();
          $("#BrandSaveButton").show();
          $('#brand_add_modal').modal('toggle');

          jQuery.ajax({
            type: "POST",
            cache: false,
            url: "{{ route('brand_select_box') }}",
            data : { "_token": "{{ csrf_token() }}"},
            datatype: "json",
            success: function(data){
              var json = jQuery.parseJSON(data);
              var brand = json.b;
              jQuery("#brand_id").jqxComboBox({source: brand});
            }
        });                
      }
    });	
  }

  function category_product(){
    var category_id = jQuery("#category_ids").jqxComboBox('getSelectedItem').value;
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "{{route('category_product')}}",
        data : { "_token": "{{ csrf_token() }}","category_id":category_id},
        datatype: "json",
        success: function(data){
          var json = jQuery.parseJSON(data);
          var pro = json.pro;
          var brnd = json.brnd;
          jQuery("#brand_ids").jqxComboBox({source: brnd});
          jQuery("#product_id").jqxComboBox({source: pro});

        }
    }); 
  }

  function brand_product(){
    var category_id = jQuery("#category_ids").jqxComboBox('getSelectedItem').value;
    var brand_id = jQuery("#brand_ids").jqxComboBox('getSelectedItem').value;
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "{{route('brand_product')}}",
        data : { "_token": "{{ csrf_token() }}","category_id":category_id,"brand_id":brand_id},
        datatype: "json",
        success: function(data){
          var json = jQuery.parseJSON(data);
          var pro = json.pro;
          jQuery("#product_id").jqxComboBox({source: pro});

        }
    }); 
  }


</script>



@endsection
