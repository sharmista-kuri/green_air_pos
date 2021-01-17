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
        url: "{{route('transactions.grid')}}",
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
              { name: 'users_name', type: 'string'},
              { name: 'customer_name', type: 'string'},
              { name: 'supplier_name', type: 'string'},
              { name: 'officials_name', type: 'string'},
              { name: 'amount', type: 'string'},
              
             
             					  
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
              editable: true,
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
                  
                  //{ text: 'ID', datafield: 'id', hidden:true,  editable: false,  width: '145' },
                  { text: 'Transaction ID', datafield: 'id', editable: false, width: '100' },
                  { text: 'Employee Name', datafield: 'users_name', editable: false, width: '200' },
                  { text: 'Customer Name', datafield: 'customer_name', editable: false, width: '200' },
                  { text: 'Supplier Name', datafield: 'supplier_name', editable: false, width: '200' },
                  { text: 'Official Name', datafield: 'officials_name', editable: false, width: '200' },
                  { text: 'Amount', datafield: 'amount', editable: false, width: '200' },
                  
  
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



</script>
<form target="_blank" id="employee_form"  method="post">
@csrf 
  <input id="id" name="id" type="hidden"/>
</form>
<div id="container">	
	<div id="body"  >
		<div style="display:block; min-height:350px; height:auto">
      <form method="POST" name="form" id="form"  style="margin:0px;">
		    <div style="padding:0.5%;width:99%; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
		  	  <table id="deal_body" style="display:block;width:100%">
            <tr>
              <td><strong>Transaction ID&nbsp;&nbsp;</strong></td>
              <td><input name="transaction_id"></input></td>

              <td><strong>Sales Invoice No&nbsp;&nbsp;</strong> </td>
              <td><input type="text" class="text-input-small" name="sales_invoice_no"/></td>

              <td><strong>Purchase Invoice No&nbsp;&nbsp;</strong></td>
              <td><input type="text" class="text-input-small" name="purchase_invoice_no"></input></td>
              
            </tr>
            <tr>
              <td><strong>Employee Name&nbsp;&nbsp;</strong></td>
              <td><input type="text" class="text-input-small" name="employee_name" /></td>

              <td><strong>Customer Name&nbsp;&nbsp;</strong></td>
              <td><input type="text" class="text-input-small" name="customer_name"/></td>

              <td><strong>Supplier Name&nbsp;&nbsp;</strong></td>
              <td><input type="text" class="text-input-small" name="supplier_name"/></td>

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

@endsection