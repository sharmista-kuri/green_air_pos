@extends('layouts.master')
@section('content')
<form id="transaction_form"  method="post" action="{{ route('transactions.store') }}" enctype="multipart/form-data">
@csrf
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Transaction</h4>
          <p class="card-description">
          Transaction Info
          </p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Transaction ID</label>
                <div class="col-sm-9">
                  <label class="col-sm-9 col-form-label" id="id" name="id"></label>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Date</label>
                  <div class="col-sm-9">
                      <input value="<?php echo date('Y-m-d')?>" required id="date" name="date" type="date" class="form-control" placeholder="dd/mm/yyyy"/>
                  </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Transaction Type</label>
                
                  <div class="col-sm-4">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input checked required type="radio" class="form-check-input" name="transaction_type_id" id="transaction_type_id1" value="1">
                        Cash Receive
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="transaction_type_id" id="transaction_type_id2" value="2">
                          Cash Out
                        </label>
                    </div>
                  </div>
                
              </div> 
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label id="due_label" style="display:none;" class="col-sm-3 col-form-label">Due</label>
                <div class="col-sm-9">
                  <label class="col-sm-9 col-form-label" id="due_amount"></label>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Account Type</label>
                <div class="col-sm-9">
                  <!-- <select onchange="account_change()" id="account_type" name="account_type" class="form-control">
                    @foreach($account_types as $account_type)
                    <option value="{{$account_type->id}}">{{$account_type->name}}</option>
                    @endforeach
                  </select> -->

                  <div onchange="account_change()" id="account_type">
                  </div>
                  <input id="account_type_id_hidden" name="account_type_id" type="hidden" class="form-control"/>
                </div>
              </div>
            </div>
          </div>
          <div id="official_div" style="display:none" class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Official Type</label>
                <div id="account_div" class="col-sm-9">
                  <div onchange="official_type_change()" id="official_type_id" name="official_type_id"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Account ID</label>
                <div id="account_div" class="col-sm-9">
                  <div onchange="account_info()" id="account_id"></div>
                  <input id="account_id_hidden" name="account_id" type="hidden" class="form-control"/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-9">
                  <textarea required id="description" name="description" class="form-control" rows="4"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Account Name</label>
                <div class="col-sm-9">
                  <label id="account_name" name="account_name" class="col-sm-9 col-form-label"></label>
                </div>
              </div> 
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Amount</label>
                <div class="col-sm-9">
                  <input required id="amount" name="amount" type="text" class="form-control" />
                </div>
              </div>
            </div>
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
              <div class="forms-sample">
                  <button type="submit" class="btn btn-primary mr-2">Save</button>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
<script>
  //account_change();
  transaction_id();

  jQuery(document).ready(function($) {
    var theme = 'classic';
    var official_type = [<? $i=1; foreach($official_types as $value){ if($i!=1){echo ',';} echo '{value:"'.$value->id.'", label:"'.$value->name.'"}'; $i++;}?>];
	  jQuery("#official_type_id").jqxComboBox({theme: theme, promptText: "Select Official Type", source: official_type});
  
    var account_types = [<? $i=1; foreach($account_types as $value){ if($i!=1){echo ',';} echo '{value:"'.$value->id.'", label:"'.$value->name.'"}'; $i++;}?>];
	  jQuery("#account_type").jqxComboBox({theme: theme, promptText: "Select Account Type", source: account_types, width: '200'});
  
    jQuery("#account_id").jqxComboBox({theme: theme, promptText: "Select Account ID", width: '200'});
    
  
  });

  

  function official_type_change(){
    var account_type = jQuery("#account_type").jqxComboBox('getSelectedItem').value;
    var official_type = jQuery("#official_type_id").jqxComboBox('getSelectedItem').value;
    
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "{{route('account_select_box')}}",
        data : { "_token": "{{ csrf_token() }}","account_type":account_type, "official_type":official_type},
        datatype: "json",
        success: function(data){
          var json = jQuery.parseJSON(data);
          var acc = json.acc;
          jQuery("#account_id").jqxComboBox({source: acc});
        }
    });
    

  }

  function account_change(){
    var account_type = jQuery("#account_type").jqxComboBox('getSelectedItem').value;
    if(account_type<3){
      jQuery("#official_div").hide();
      jQuery.ajax({
          type: "POST",
          cache: false,
          url: "{{route('account_select_box')}}",
          data : { "_token": "{{ csrf_token() }}","account_type":account_type},
          datatype: "json",
          success: function(data){
            var json = jQuery.parseJSON(data);
            var acc = json.acc;
            jQuery("#account_id").jqxComboBox({source: acc});
            $("#account_type_id_hidden").val(account_type);
          }
      });
    }
    else{
      jQuery("#official_div").show();
    }

  }

  function account_info(){
    var account_type = jQuery("#account_type").jqxComboBox('getSelectedItem').value;
    var account_id = jQuery("#account_id").jqxComboBox('getSelectedItem').value;

    //alert(account_type);
    
    jQuery.ajax({
      type: "POST",
      cache: false,
      url: "{{route('account_info_select_box')}}",
      data : { "_token": "{{ csrf_token() }}","account_id":account_id,"account_type":account_type},
      datatype: "json",
      success: function(datas){
        data = JSON.parse(datas);
        //alert(data[0].name);
        jQuery("#account_name").text(data.name);
        jQuery("#account_id_hidden").val(data.id);
        $("#due_label").show();
        $("#due_amount").text(data.due);
      }
    });
  

    
  }

  function transaction_id(){
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "{{route('transaction_id')}}",
        data : { "_token": "{{ csrf_token() }}"},
        datatype: "json",
        success: function(datas){
          id = 1000000;
          if(datas!="null"){
            data = JSON.parse(datas);
            id = parseInt(data.id)+1;
          }
          jQuery("#id").text(id);
        }
    });
  }
</script>
@endsection