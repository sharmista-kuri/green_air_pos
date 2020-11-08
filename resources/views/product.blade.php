@extends('layouts.master')
@section('content')

<form id="product_form">
  @csrf
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Product</h4>
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
  </div>
  <div class="forms-sample">
    <button id="ProductSaveButton" type="button" class="btn btn-primary">Save</button>
    <span id="productloading" style="display:none">Please wait... <img src="<?=config('app.url')?>/resources/master/images/loader.gif" align="bottom"></span>
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

    var category_id = [<? $i=1; foreach($categories as $value){ if($i!=1){echo ',';} echo '{value:"'.$value->id.'", label:"'.$value->name.'"}'; $i++;}?>];
	  jQuery("#category_id").jqxComboBox({theme: theme, promptText: "Select Category", source: category_id});

    var brand_id = [<? $i=1; foreach($brands as $value){ if($i!=1){echo ',';} echo '{value:"'.$value->id.'", label:"'.$value->name.'"}'; $i++;}?>];
	  jQuery("#brand_id").jqxComboBox({theme: theme, promptText: "Select Brand", source: brand_id});
  
  });

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
</script>

@endsection