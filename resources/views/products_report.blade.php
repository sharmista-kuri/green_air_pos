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
      theme: theme , height: 150, width: 350, resizable: true,  isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01           
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
        url: "{{route('products.grid')}}",
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
              { name: 'category_name', map: 'categories>name'},
              { name: 'brand_name', map: 'brands>name'},
              { name: 'current_stock', type: 'int'},
              { name: 'purchase_price', type: 'string'},
              { name: 'sale_price', type: 'string'},
             					  
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
                { text: 'Product Name', datafield: 'name', editable: false, width: '250' },
                { text: 'Category Name', datafield: 'category_name', editable: false, width: '150' },
                { text: 'Brand Name', datafield: 'brand_name', editable: false, width: '150' },
                { text: 'Purchase Price', datafield: 'purchase_price', cellsalign: 'right', cellsformat: 'c2', editable: false, width: '150' },
                { text: 'Sale Price', datafield: 'sale_price',cellsalign: 'right', cellsformat: 'c2', editable: false, width: '150' },
                { text: 'Current Stock', datafield: 'current_stock',  width: 170, cellsalign: 'left',  
                    aggregates: [{ '<b>Total</b>':
                          function (aggregatedValue, currentValue) {
                              var aggregatedValue = aggregatedValue + currentValue;
                              return aggregatedValue;
                          }
                    }]                  
                }
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
      $("#product_ID").text(val);
      $("#jqxgrid").jqxGrid('clearselection');
      $("#popupWindow").jqxWindow('open');
      return false;
    }

    jQuery("#Save").click(function (){
      //alert("hi");
      call_ajax_submit();
    });

  function call_ajax_submit(){

      var form = $('#product_form')[0];
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
            url: "{{ route('products_update_price') }}",
            data: data,
            datatype: "json",
            success: function(data){
            	$("#popupWindow").jqxWindow('close');
           
					    submitonclick(0,2);
                  
          }
        });
      /* jQuery.ajax({
        headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
          type: "POST",
          cache: false,
          contentType: false,
          processData: false,
          enctype: 'multipart/form-data',
          url: "{{ route('products_update_price')}}",
          data : data,
          datatype: "json",
          success: function(data){
            $("#popupWindow").jqxWindow('close');
           
					  submitonclick(0,2);
            //jQuery("#jqxgrid").jqxGrid('updatebounddata');
          }
      });  */
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
              <td><strong>Product&nbsp;&nbsp;</strong></td>
              <td><div name="product_id" style="padding-left:1.8%" id="product_id"></div></td>
              <td><strong>Category Name&nbsp;&nbsp;</strong></td>
              <td><div name="category_id" style="padding-left:1.8%" id="category_id"></div></td>
              <td><strong>Brand Name&nbsp;&nbsp;</strong></td>
              <td><div name="brand_id" style="padding-left:1.8%" id="brand_id"></div></td>
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
  
      <table>
      <form id="product_form">
        <input type="hidden" id="id" name="id"/>
        <tr>
            <td align="right">Product ID:</td>
            <td align="left"><span id="product_ID"></span></td>
        </tr>
        <!-- <tr>
            <td align="right">Purchase Price:</td>
            <td align="left"><input id="purchase_price" name="purchase_price"/></td>
        </tr> -->
        <tr>
            <td align="right">Sale Price:</td>
            <td align="left"><input id="sale_price" name="sale_price"/></td>
        </tr>
        <tr>
            <td align="right"></td>
            <td style="padding-top: 10px;" align="right"><input onclick="call_ajax_submit()" style="margin-right: 5px;" type="button" id="Save" value="Save" /><input id="Cancel" type="button" value="Cancel" /></td>
        </tr>
        </form> 
      </table>
      
  </div>
</div>

    

@endsection