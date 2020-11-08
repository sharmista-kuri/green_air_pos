@extends('layouts.master')
@section('content')

<form id="supplier_form">
  @csrf
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Supplier</h4>
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
  </div>
  <div class="forms-sample">
    <button id="CustomerSaveButton" type="button" class="btn btn-primary">Save</button>
    <span id="loading" style="display:none">Please wait... <img src="<?=config('app.url')?>/resources/master/images/loader.gif" align="bottom"></span>
  </div>
</form>


<script>
  jQuery('#category_form').jqxValidator({
      hintType: "label",
			theme:"light",
      rules: [
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
      }
    });	
  }
</script>

@endsection