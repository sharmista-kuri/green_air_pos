@extends('layouts.master')
@section('content')
<form id="transaction_form"  method="post" action="{{ route('transaction.store') }}" enctype="multipart/form-data">
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
                      <input required id="date" name="date" type="date" class="form-control" placeholder="dd/mm/yyyy"/>
                  </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Transaction Type</label>
                <div class="col-sm-9">
                  <select id="transaction_type_id" name="transaction_type_id" class="form-control">
                    @foreach($transaction_types as $transaction_type)
                    <option value="{{$transaction_type->id}}">{{$transaction_type->name}}</option>
                    @endforeach
                  </select>
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
                  <select onchange="account_change()" id="account_type" name="account_type" class="form-control">
                    @foreach($account_types as $account_type)
                    <option value="{{$account_type->id}}">{{$account_type->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Account ID</label>
                <div id="account_div" class="col-sm-9">
                  <select id="account_id" name="account_id" class="form-control">
                  </select>
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
  account_change();
  transaction_id();

  

  function account_change(){
    var account_type = $("#account_type").val();
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "account_select_box",
        data : { "_token": "{{ csrf_token() }}","account_type":account_type},
        datatype: "json",
        success: function(data){
          $("#account_div").html(data);
          account_info();
        }
    });

  }

  function account_info(){
    var account_type = $("#account_type").val();
    var account_id = $("#account_id").val();

    //alert(account_type);
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "account_info_select_box",
        data : { "_token": "{{ csrf_token() }}","account_id":account_id,"account_type":account_type},
        datatype: "json",
        success: function(datas){
          data = JSON.parse(datas);
          //alert(data.name);
          jQuery("#account_name").text(data.name);
          $("#due_label").show();
          $("#due_amount").text(data.id);
        }
    });
  }

  function transaction_id(){
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "transaction_id",
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