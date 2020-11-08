@extends('layouts.master')
@section('content')

<form id="customer_form">
  @csrf
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Customer</h4>
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
                  <label class="col-sm-3 col-form-label">Name <span style="color:red">*</span></label>
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
  </div>
  <div class="forms-sample">
    <button id="CustomerSaveButton" type="button" class="btn btn-primary">Save</button>
    <span id="loading" style="display:none">Please wait... <img src="<?=config('app.url')?>/resources/master/images/loader.gif" align="bottom"></span>
  </div>
</form>


<script>
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
	});

  function call_ajax_submit()
	{
		jQuery("#CustomerSaveButton").hide();
		jQuery("#loading").show();
		
    
    jQuery('#customer_type').val(jQuery('#customer_type_array').val());
		var form = $('#customer_form')[0];
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
      url: "{{ route('customers.store') }}",
      data: data,
      datatype: "json",
      success: function(data){
        jQuery("#loading").hide();
        jQuery("#CustomerSaveButton").show();
               
      }
    });	
  }
</script>

@endsection