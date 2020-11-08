@extends('layouts.master')
@section('content')

<form id="category_form">
  @csrf
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Category</h4>
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
  </div>
  <div class="forms-sample">
      <button id="CategorySaveButton" type="button" class="btn btn-primary">Save</button>
      <span id="categoryloading" style="display:none">Please wait... <img src="<?=config('app.url')?>/resources/master/images/loader.gif" align="bottom"></span>
  </div>
</form>

<script>
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
            alert("Successfully Saved");
        }
    });	
  }
</script>

@endsection