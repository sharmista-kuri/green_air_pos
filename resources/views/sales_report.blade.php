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
  
    var customer_id = [<? $i=1; foreach($customers as $value){ if($i!=1){echo ',';} echo '{value:"'.$value->id.'", label:"'.$value->name.'"}'; $i++;}?>];
	  jQuery("#customer_id").jqxComboBox({theme: theme, promptText: "Select Customer", source: customer_id, width: '170'});
  
    var product_id = [<? $i=1; foreach($products as $value){ if($i!=1){echo ',';} echo '{value:"'.$value->id.'", label:"'.$value->name.'"}'; $i++;}?>];
	  jQuery("#product_id").jqxComboBox({theme: theme, promptText: "Select Product", source: product_id, width: '170'});
  
    var category_id = [<? $i=1; foreach($categories as $value){ if($i!=1){echo ',';} echo '{value:"'.$value->id.'", label:"'.$value->name.'"}'; $i++;}?>];
	  jQuery("#category_id").jqxComboBox({theme: theme, promptText: "Select Category", source: category_id, width: '170'});
  
  
  
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
        url: "{{route('sales.grid')}}",
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
              { name: 'sales_id', map: 'sales>name'},
              { name: 'invoice_no', type: 'string'},
              { name: 'name', type: 'string'},
              { name: 'cus_name', map: 'customers>name'},
              { name: 'emp_name', map: 'users>name'},
              { name: 'total', type: 'string'},
              { name: 'paid', type: 'string'},
              { name: 'due', type: 'string'},
              { name: 'quantity', type: 'string'},
              { name: 'rate', type: 'string'},
              { name: 'amount', type: 'string'},
              { name: 'sale_date', type: 'string'},
             					  
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
                  { text: 'Print', menu: false, datafield: 'Print', align:'center', editable: false,  sortable: false, width: 30,
                    cellsrenderer: function (row) {
                      editrow = row;
                      var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                      return '<div style="text-align:center;  cursor:pointer" onclick="Print('+dataRecord.sales_id+')" ><img align="center" src="<?=config('app.url');?>/resources/master/images/edit.png"></div>';

                  }
                },
                { text: 'ID', datafield: 'id', hidden:true,  editable: false,  width: '145' },
                { text: 'Invoice No', datafield: 'invoice_no', editable: false, width: '150' },
                { text: 'Sale Date', datafield: 'sale_date', editable: false, width: '150' },
                { text: 'Employee Name', datafield: 'emp_name', editable: false, width: '150' },
                { text: 'Customer Name', datafield: 'cus_name', editable: false, width: '150' },
                { text: 'Product Name', datafield: 'name', editable: false, width: '150' },
                { text: 'Quantity', datafield: 'quantity', editable: false, width: '150' },
                { text: 'Rate', datafield: 'rate', editable: false, width: '150' },
                /* { text: 'Amount', datafield: 'amount', editable: false, width: '150' }, */
                { text: 'Amount', datafield: 'amount', cellsalign: 'left', cellsformat: 'c2', aggregates: ['sum'] },
                /* { text: 'Price', datafield: 'amount', cellsalign: 'right', cellsformat: 'c2', aggregates: [{ '<b>Total</b>':
                          function (aggregatedValue, currentValue, column, record) {
                              var total = currentValue * parseInt(record['quantity']);
                              return aggregatedValue + total;
                          }
                    }]                  
                } */
                /* { text: 'Total', datafield: 'total', editable: false, width: '150' },
                { text: 'Paid', datafield: 'paid', editable: false, width: '150' },
                { text: 'Due', datafield: 'due', editable: false, width: '150' }, */
                		 
                
                
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

function Print(id){
  /* url= "<?=route("grid_sales_print")?>";
  var win = window.open(url, '_blank');
  win.focus(); */
  $("#id").val(id);
  var form = $('#sales_form')[0];
  var data = new FormData(form);
  
  form.submit();
  
}
</script>
<form target="_blank" id="sales_form"  method="post" action="{{ route('grid_sales_print') }}" enctype="multipart/form-data">
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
              <td><strong>Invoice No&nbsp;&nbsp;</strong> </td>
              <td><input type="text" class="text-input-small" name="invoice_no"/></td>
              <td><strong>Employee Name&nbsp;&nbsp;</strong></td>
              <td><div name="employee_id" style="padding-left:1.8%" id="employee_id"></div></td>
              <td><strong>Sale Date&nbsp;&nbsp; From</strong></td>
              <td><input type="date" class="text-input-small" name="sale_date_from"/></td>
              <td><strong>To</strong></td>
              <td><input type="date" class="text-input-small" name="sale_date_to"/></td>
              
            </tr>
            <tr>
              <td><strong>Customer&nbsp;&nbsp;</strong></td>
              <td><div name="customer_id" style="padding-left:1.8%" id="customer_id"></div></td>
              
              <td><strong>Product&nbsp;&nbsp;</strong></td>
              <td><div name="product_id" style="padding-left:1.8%" id="product_id"></div></td>
              </td>
              <td><strong>Sale Type&nbsp;&nbsp;</strong></td>
              <td>
                  <input type="radio" name="sale_type" id="sale_type1" value="1">
                      Retial
                  <input type="radio" name="sale_type" id="sale_type2" value="2">
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

@endsection