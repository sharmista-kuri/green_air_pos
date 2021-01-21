@extends('layouts.master')
@section('content')

<form id="brand_form">
  @csrf
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"></h4>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Official Type <span style="color:red">*</span></label>
                  <div class="col-sm-9">
                  <div id="official_type_id" name="official_type_id"></div>
                  </div>
                </div>
              </div>
            </div>
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
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="forms-sample" align="center">
    <button id="BrandSaveButton" type="button" class="btn btn-primary">Save</button>
    <span id="brandloading" style="display:none">Please wait... <img src="<?=config('app.url')?>/resources/master/images/loader.gif" align="bottom"></span>
  </div>
</form>

<script>
  jQuery(document).ready(function($) {
    var theme = 'classic';

    var official_type_id = [<? $i=1; foreach($official_types as $value){ if($i!=1){echo ',';} echo '{value:"'.$value->id.'", label:"'.$value->name.'"}'; $i++;}?>];
	  jQuery("#official_type_id").jqxComboBox({theme: theme, promptText: "Select Official Type", source: official_type_id});

   
  
  });
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
        url: "{{ route('officials.store') }}",
        data: data,
        datatype: "json",
        success: function(data){
          $("#brandloading").hide();
          $("#BrandSaveButton").show();
          alert("Successfully Saved");               
      }
    });	
  }
</script>

@endsection