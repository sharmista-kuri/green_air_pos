@extends('layouts.master')
@section('content')

<!DOCTYPE html>
<html>
<head>
	<title></title>
  <style>
* {
  box-sizing: border-box;
}

.row {
  margin-left:-5px;
  margin-right:-5px;
}
  
.column {
  float: left;
  width: 50%;
  padding: 5px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
}
th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  position: sticky;
  top: 0;
  background-color: dodgerblue;
  color: white;

}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
#divScroll{
overflow:scroll;
height:400px;
width:520px;
}
#divScroll1{
overflow:scroll;
height:400px;
width:520px;
}
#divScroll2{
overflow:scroll;
height:400px;
width:520px;
}
#divScroll3{
overflow:scroll;
height:400px;
width:520px;
}#divScroll4{
overflow:scroll;
height:400px;
width:520px;
}

</style>
	</head>
  <body>
    <div class="row" >
  <div class="column" id="divScroll1" >
    <table id="customers">
  
  <thead>
    <tr>
      <th colspan="5"><b><i>Sale Information:</i></b></th>
    </tr>
  <tr>
    <th>Invoice No</th>
    <th>Customer ID</th>
    <th>Total</th>
    <th>Paid</th>
    <th>Due</th>
  </tr>
  </thead>
  <tbody>
@foreach($sales as $row)
  <tr>
    <td>{{$row->invoice_no}}</td>
    <td>{{$row->customer_id}}</td>
    <td>{{$row->total}}</td>
     <td>{{$row->paid}}</td>
      <td>{{$row->due}}</td>
  </tr>
  @endforeach 
  </tbody>
</table>
  </div>
   <div class="column" id="divScroll2">
   <table id="customers2">
  <tr>
    <th colspan="5">
      <b><i>Supplier information:</i></b>
    </th>
  </tr>
  <tr>
    <th>Name</th>
    <th>Address</th>
    <th>Primary Contact</th>
    <th>Secondary Contact</th>
    <th>Email</th>
  </tr>
  @foreach($suppliers as $row)
  <tr>
    <td>{{$row->name}}</td>
    <td>{{$row->address}}</td>
    <td>{{$row->primary_contact}}</td>
    <td>{{$row->secondary_contact}}</td>
    <td>{{$row->email}}</td>
  </tr>
  @endforeach
</table>
  </div>
   <div class="column" id="divScroll3">
     <table id="customers4">

  <tr>
    <th colspan="3">
      <b><i>User Information:</i></b>
    </th>
  </tr>
  <tr>
    <th>User Name</th>
    <th>User Email</th>
    <th>User Role</th>
  </tr>
@foreach($users as $row)
  <tr>
    <td>{{$row->name}}</td>
    <td>{{$row->email}}</td>
    <td>{{$row->role}}</td>
  </tr>
  @endforeach
 
</table>
  </div>
   <div class="column" id="divScroll">
    <table id="customers1">
  <tr><th colspan="6"><b><i>Purchase Information:</i></b></th></tr>
  <tr>
   <th>Invoice No</th>
    <th>Supplier ID</th>
    <th>Purchase Date</th>
    <th>Total</th>
    <th>Paid</th>
    <th>Due</th>
  </tr>
  @foreach($purchase as $row)
  <tr>
    <td>{{$row->invoice_no}}</td>
    <td>{{$row->supplier_id}}</td>
    <td>{{$row->purchase_date}}</td>
    <td>{{$row->total}}</td>
     <td>{{$row->paid}}</td>
      <td>{{$row->due}}</td>
  </tr>
  @endforeach 
</table>
  </div>
  <div class="column" id="divScroll4">
  <table id="customers3">
  <tr><th colspan="3"><b><i>Customer Information:</i></b></th>
  </tr>
  <tr>
    <th>Customer ID</th>
    <th>Name</th>
    <th>Address</th>
  </tr>
  @foreach($customers as $row)
<tr>
    <td>{{$row->customer_id}}</td>
    <td>{{$row->name}}</td>
    <td>{{$row->address}}</td>
</tr>
@endforeach
</table>
  </div>
</div>
  </body>

</html>


@endsection
