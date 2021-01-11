@extends('layouts.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
  .pager{
    height: 28px;
    position: relative;
    width: 99.3%;
    z-index: 20;
	background-color:#C5C5C5;
	border-top:1px solid rgb(52, 64, 73);
	color:#000000;
	padding:0; margin:0;
	border-bottom-left-radius: 3px;
  -moz-border-bottom-left-radius: 3px;
  -webkit-border-bottom-left-radius: 3px;
  border-bottom-right-radius: 3px;
  -moz-border-bottom-right-radius: 3px;
  -webkit-border-bottom-right-radius: 3px; 
  font-family: Arial;
  font-size: 13px;
}
</style>
<script>
  jQuery(document).ready(function($) {
    var theme = 'classic';
    var employee_id = [<? $i=1; foreach($employees as $value){ if($i!=1){echo ',';} echo '{value:"'.$value->id.'", label:"'.$value->name.'"}'; $i++;}?>];
	  jQuery("#employee_id").jqxComboBox({theme: theme, promptText: "Select Employee", source: employee_id, width: '170'});
  
    var supplier_id = [<? $i=1; foreach($suppliers as $value){ if($i!=1){echo ',';} echo '{value:"'.$value->id.'", label:"'.$value->name.'"}'; $i++;}?>];
	  jQuery("#supplier_id").jqxComboBox({theme: theme, promptText: "Select Supplier", source: supplier_id, width: '170'});
  
    var product_id = [<? $i=1; foreach($products as $value){ if($i!=1){echo ',';} echo '{value:"'.$value->id.'", label:"'.$value->name.'"}'; $i++;}?>];
	  jQuery("#product_id").jqxComboBox({theme: theme, promptText: "Select Product", source: product_id, width: '170'});
  
    var category_id = [<? $i=1; foreach($categories as $value){ if($i!=1){echo ',';} echo '{value:"'.$value->id.'", label:"'.$value->name.'"}'; $i++;}?>];
	  jQuery("#category_id").jqxComboBox({theme: theme, promptText: "Select Category", source: category_id, width: '170'});
  
    var brand_id = [<? $i=1; foreach($brands as $value){ if($i!=1){echo ',';} echo '{value:"'.$value->id.'", label:"'.$value->name.'"}'; $i++;}?>];
	  jQuery("#brand_id").jqxComboBox({theme: theme, promptText: "Select Brand", source: brand_id});

    var theme = 'energyblue';

    $("#popupWindow").jqxWindow({
      theme: theme , width: 1000, resizable: true,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
    });

    $("#purchase_price").width(150);
    $("#purchase_price").height(23);

    $("#sale_price").width(150);
    $("#sale_price").height(23);

    $("#purchase_price").jqxInput({ theme: theme });
    $("#sale_price").jqxInput({ theme: theme });

    $("#Cancel").jqxButton({ theme: theme });
    $("#Save").jqxButton({ theme: theme });
  
  });
  var count=0; var maxrow = 0; var displayrow= 0; inc = 0; decr = 0; //global variable
  function submitonclick(pagenum,next) 
    {
      jQuery("#loading").show();
      //jQuery("#search").hide();
      jQuery('#resultdiv').html('');
      
      if(next==1){count++;pagenum = count;} 
      else if(next==0){if(count > 0){count--;}pagenum = count;} 
      else{count=count;pagenum = pagenum;}
      
      
      var postdata = jQuery('#form').serialize();

      jQuery.ajax({
        headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
        type: "POST",
        url: "{{route('customers.grid')}}",
        data : postdata,
        success: function(response) {
        
        jQuery("#loading").hide();
        jQuery("#search").show();
                
        var json = jQuery.parseJSON(response);
        maxrow = json.total;

        
        

        if(next==0){ if(count > 0){displayrow = displayrow + decr;} else if(count == 0){displayrow = json.data.length;}} 
        else {displayrow = displayrow + json.data.length;}
        
        var str_griddiv = '<div id="jqxgrid"></div>';
        var str_1 = '<div class="pager"><div style="float:left;width:78%;display: inline;top:19%;position: relative;text-align:right">&nbsp;&nbsp;Total Rows: '+json.total+'</div>';
        var str_2 = '<div style="float:left;width:6%;display: inline;top:19%;position: relative;text-align:center">Page: '+(pagenum+1)+'</div>';
        
        var str_3 = '<div style="float:left;width:16%;display: inline;top:13%;position: relative;text-align:center"><div style="background-image:url(<?php echo config('app.url'); ?>/resources/master/images/left.png);display: block;height:19px;width:30px;float:left;background-repeat: no-repeat;cursor:pointer"';
        if(count > 0){ str_3 = str_3+' onclick=submitonclick('+pagenum+',0)';} str_3 = str_3+' ></div>';

        var str_right = '<div style="background-image:url(<?php echo config('app.url'); ?>/resources/master/images/right.png);display: block;height:19px;width:30px;float:left;background-repeat: no-repeat;margin:0 7%;cursor:pointer"';
        if(maxrow > displayrow) {str_right = str_right+' onclick=submitonclick('+pagenum+',1)';} 
        str_right = str_right+' ></div></div>';
        
        //var res = str_griddiv.concat(str_1,str_2,str_3,str_right,'</div>');
        var res = str_griddiv.concat('</div>');
        inc = json.data.length;
        decr = -json.data.length;

        //alert(json.data.amount);

        jQuery('#resultdiv').html(res);
        
        var theme = 'energyblue';
        var source =
          {
            datatype: "json",
            datafields: [
              { name: 'id', type: 'int'},
              { name: 'name', type: 'string'},
              { name: 'address', type: 'string'},
              { name: 'area', type: 'string'},
              { name: 'country', type: 'string'},
              { name: 'primary_contact', type: 'string'},
              { name: 'secondary_contact', type: 'string'},
              { name: 'email', type: 'string'},
              { name: 'customer_type', type: 'string'},
              { name: 'due', type: 'string'},
             
             					  
            ],
            cache: false,
            localdata: json.data
          };
          var dataadapter = new jQuery.jqx.dataAdapter(source, {
              loadError: function(xhr, status, error)
              {						
                alert(error);
              }
            });
                  
          jQuery("#jqxgrid").jqxGrid({		
              width:'99%',
              height:320,
              source: dataadapter,
              theme: theme,
              filterable: true,
              sortable: true,
              autoheight: true,
              pageable: true,
              virtualmode: false,
              editable: false,
              enablehover: true,
              enablebrowserselection: true,
              selectionmode: 'none',
              showstatusbar: true,
              statusbarheight: 25,
              showaggregates: true,
              localization: getLocalization(),
              rendergridrows: function(obj)
              {
                return obj.data;    
              },
              
        
                columns: [
                  { text: 'E', menu: false, datafield: 'Edit', align:'center', editable: false,  sortable: false, width: 30,
                    cellsrenderer: function (row) {
                      editrow = row;
                      var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                      return '<div style="text-align:center;  cursor:pointer" onclick="edit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=config('app.url');?>/resources/master/images/edit.png"></div>';

                  }
                },
                { text: 'ID', datafield: 'id'/* , hidden:true */,  editable: false,  width: '105' },
                { text: 'Customer Name', datafield: 'name', editable: false, width: '250' },
                { text: 'Customer Due', datafield: 'due', editable: false, width: '150' },
                { text: 'Customer Address', datafield: 'address', editable: false, width: '150' },
                { text: 'Customer Area', datafield: 'area', editable: false, width: '150' },
                { text: 'Customer Country', datafield: 'country', editable: false, width: '150' },
                { text: 'Customer Primary Contact', datafield: 'primary_contact', editable: false, width: '150' },
                { text: 'Customer Secondary Contact', datafield: 'secondary_contact', editable: false, width: '150' },
                { text: 'Customer Email', datafield: 'email', editable: false, width: '150' },
                /* { text: 'Customer Type', datafield: 'customer_type', editable: false, width: '150' }, */
                
              ]
            });				
        },
        error: function(xhr, textStatus, errorThrown) {
          alert("error");
        }
      });
    };

    var getLocalization = function () {
    var localizationobj = {};                
    localizationobj.currencysymbol = " ";                
    return localizationobj;

    
    }

    function edit(val,indx)
    {
      $("#id").val(val);

      var customer_id = val;
      jQuery.ajax({
          type: "POST",
          cache: false,
          url: "{{route('customer_info')}}",
          data : { "_token": "{{ csrf_token() }}","customer_id":customer_id},
          datatype: "json",
          success: function(datas){
            data = JSON.parse(datas);
            jQuery("#customer_id_label").text(data.id);
            jQuery("#name").val(data.name);
            jQuery("#address").val(data.address);
            jQuery("#primary_contact").val(data.primary_contact);
            jQuery("#secondary_contact").val(data.secondary_contact);
            jQuery("#email").val(data.email);
            jQuery("#area").val(data.area);
            jQuery("#country").val(data.country);
            type = data.customer_type;
            arr_type = type.split(",");
            jQuery("#customer_type_array").multipleSelect("setSelects", arr_type);
                
          }
      }); 

      $("#product_ID").text(val);
      $("#jqxgrid").jqxGrid('clearselection');
      $("#popupWindow").jqxWindow('open');
      return false;
    }
</script>
<script>
    jQuery('#customer_form').jqxValidator({
      hintType: "label",
			theme:"light",
      rules: [
          { input: '#name', message: 'Required!', action: 'keyup,blur', rule:'required' },
          
          
      ]
  });

  jQuery("#CustomerSaveButton").click(function () {
    alert("hi");			
		var validationResult = function (isValid) {
			if (isValid) {
				call_ajax_submit();
			}
		}
		jQuery('#customer_form').jqxValidator('validate', validationResult);
	});

  function call_ajax_submit(){
      jQuery('#customer_type').val(jQuery('#customer_type_array').val());
      var form = $('#customer_form')[0];
		  var data = new FormData(form);
      //alert(data);
      //data =1;
      jQuery.ajax({
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
            type: "POST",
            cache: false,
            contentType: false,
   			    processData: false,
   			    enctype: 'multipart/form-data',
            url: "{{ route('customer_update') }}",
            data: data,
            datatype: "json",
            success: function(data){
            	$("#popupWindow").jqxWindow('close');
           
					    submitonclick(0,2);
                  
          }
        });
     
    }
    
</script>

<script>
  
</script>

<meta name="csrf-token" content="{{ csrf_token() }}" />
<div id="container">	
	<div id="body"  >
		<div style="display:block; min-height:350px; height:auto">
      <form method="POST" name="form" id="form"  style="margin:0px;">
		    <div style="padding:0.5%;width:99%; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
		  	  <table id="deal_body" style="display:block;width:100%">
            <tr>
              <td><strong>Customer Name&nbsp;&nbsp;</strong></td>
              <td><input type="text" class="text-input-small" name="customer_name" id="customer_name"/></td>
              <td><strong>Email&nbsp;&nbsp;</strong></td>
              <td><input type="text" class="text-input-small" name="email" id="customer_email"/></td>
              <td><strong>Contact No&nbsp;&nbsp;</strong></td>
              <td><input type="text" class="text-input-small" name="contact" id="contact"/></td>
              <td><strong>Customer Type&nbsp;&nbsp;</strong></td>
              <td>
                  <input type="radio" name="customer_type" id="customer_type1" value="1">
                      Retial
                  <input type="radio" name="customer_type" id="customer_type2" value="2">
                      Wholesale
              </td>
              <td width="5%" style="text-align:center;" rowspan="2"><input type='button' class="buttonStyle" id='search' name='search' value='Search' onclick="submitonclick(0,2)" style="width: 90% !important" />
            </tr>
			    </table>
		  </div>
      <br/>
		  <div style="text-align:center"><span id="loading" style="display:none">Please wait... <img src="<?php echo config('app.url'); ?>/resources/master/images/loader.gif" align="bottom"></span></div>
		  
      <div id="resultdiv" style="width:100%;min-height:360px;height:auto;"></div>
		  <div style="float:left"></div>
			
      </form>
      <br/>
    </div>
	</div>	
</div>



<div id="popupWindow">
  <div>Edit</div>
  <div style="overflow: hidden;">
    <form id="customer_form">
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
          <div class="forms-sample" align="center">
            <button onclick="call_ajax_submit();" id="CustomerSaveButton" type="button" class="btn btn-primary">Save</button>
            <span id="loading" style="display:none">Please wait... <img src="<?=config('app.url')?>/resources/master/images/loader.gif" align="bottom"></span>
          </div>
        </form>   
  </div>
</div>

    

@endsection