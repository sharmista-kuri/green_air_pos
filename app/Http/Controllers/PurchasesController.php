<?php

namespace App\Http\Controllers;

use App\User;
use App\Brand;
use Mpdf\Mpdf;
use App\Product;
use App\Category;
use App\Customer;
use App\Employee;
use App\Purchase;
use App\Supplier;
use App\Transaction;
use App\PurchaseCartDetail;
use Illuminate\Http\Request;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employees = User::get();
        $suppliers = Supplier::get();
        $products = Product::get();
        $categories = Category::get();
        $brands = Brand::get();
        return view('purchases_report',compact('employees','suppliers','products','categories','brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $employees = User::get();
        $suppliers = Supplier::get();
        $products = Product::get();
        $categories = Category::get();
        $brands = Brand::get();
        return view('purchases',compact('employees','suppliers','products','categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //echo'<pre>';print_r($request->all());exit;
        $purchase_id = Purchase::create($request->all())->id;
        $counter = $request->tr_counter;
        for($i=1; $i<$counter; $i++){
            if($request['delete_'.$i]==0){
                $data['purchase_id']=$purchase_id;
                $data['product_id']=$request['product_'.$i];
                $data['quantity']=$request['quantity_'.$i];
                $data['rate']=$request['rate_'.$i];
                $data['amount']=$request['amount_'.$i];
                $salesCart = PurchaseCartDetail::create($data);
                //echo'<pre>';print_r($request->all());exit;
                $product_id = $request['product_'.$i];
                $quantity = $request['quantity_'.$i];
                $exists = Product::whereId($product_id)->exists();
                
                if($exists){
                    $products = Product::select('current_stock')->whereId($product_id)->first();
                    if($products->current_stock==null){
                        $current_stocks = 0;
                    }
                    else{
                        $current_stocks = $products->current_stock;
                    }
                    
                }
                else{
                    $current_stocks = 0;
                }

                $current_stock = $current_stocks + $quantity;
                $data_product['current_stock'] = $current_stock;
                $data_product['purchase_price'] = $request['rate_'.$i];
                Product::whereId($product_id)->update($data_product);
            }
            
        }

        $data_transaction['date']=$request['purchase_date'];
        $data_transaction['transaction_type_id']=2;
        $data_transaction['account_type_id']=2;
        $data_transaction['account_id']=$request['supplier_id'];
        $data_transaction['description']=$request['remarks'];
        $data_transaction['amount']=$request['paid'];

        $transaction = Transaction::create($data_transaction);

        return redirect()->action('PurchasesController@create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function grid(Request $request){

        
		$pagenum = $request->pagenum;
		$pagesize = $request->per_pagess;
        $start = $pagenum * $pagesize;


        $filterscount = $request->filterscount;
        $sortdatafield = $request->sortdatafield;
        $sortorder = $request->sortorder;

        
		$where="purchases.id<>0";  
		$where1="purchase_cart_details.id<>0";  

        
        if($request->invoice_no != '') 
        {$where.=" AND invoice_no = '".trim($request->invoice_no)."' ";}
        
        if($request->employee_id != '') 
		{$where.=" AND employee_id = ".$request->employee_id;}
        
        if($request->purchase_date_from != '') 
        {$where.=" AND purchase_date >= '".trim($request->purchase_date_from)."' ";}

        if($request->purchase_date_to != '') 
        {$where.=" AND purchase_date <= '".trim($request->purchase_date_to)."' ";}
        
        if($request->purchase_type != '') 
        {$where.=" AND purchase_type = ".$request->purchase_type;}

        if($request->supplier_id != '') 
        {$where.=" AND supplier_id = ".$request->supplier_id;}
        
        if($request->product_id != '') 
        {$where1.=" AND product_id = ".$request->product_id;}
        
        $products = PurchaseCartDetail::whereRaw($where1);
		
        $q = Purchase::with(['employees'])->with(['suppliers'])->whereRaw($where)
        ->joinSub($products, 'purchase_cart_details', function ($join) {
            $join->on('purchases.id', '=', 'purchase_cart_details.purchase_id');
        })
        ->join('products','products.id','=','purchase_cart_details.product_id')
        ->get();
	
        
		
		$result["total"] = $q->count();
		
		if ($q->count() > 0){        
			$result["Rows"] = $q;
		} else {
			$result["Rows"] = array();
		}  		
		
	
		
		
		echo "{\"total\":".json_encode($result['total']).",\"data\":".json_encode($result['Rows'])."}";

    }

    function purchase_invoice_create(){
        $purchase_id = Purchase::select('id')->orderBy('id','desc')->first();
        echo json_encode($purchase_id);
    }


    function purchase_print(Request $request){
        //echo'<pre>';print_r($request->all());exit;
        ob_get_clean();
        @include('vendor/autoload.php');

        $mpdf = new Mpdf();

        
        $img = config('app.url')."/resources/master/images/ga.png";
        $str="";
        $str.="<html>";
        $str.="<body>";
        //$str.='<img src='.$img.' alt="Green Air" width="50" height="60">';
        
        $str.='<div align="center" color="green" style="font-size:30px">
                <img src='.$img.' alt="Green Air" width="110" height="110">
                </div>';
        
        $str.='<table>';
        $str.='<tr>';
        $str.='<td width="15%">Invoice No: '.$request->invoice_no.'</td>';
        $str.='<td style="text-align: center;
        vertical-align: middle;"  color="green">One Stop Electronics & Air Conditioning Solutions</td>';
        $str.='<td width="20%"> Date: '.$request->purchase_date.'</td>';
        $str.='</tr>';

        $str.='<tr>';
        $str.='<td width="20%"></td>';
        $str.='<td text-align="center"></td>';
        $str.='<td width="20%"></td>';
        $str.='</tr>';

        $str.='<tr>';
        $str.='<td></td>';
        $str.='<td style="text-align: center;
        vertical-align: middle;" >1285 Begum Rokeya Sarani, East Monipur, Mirput 10, Dhaka-1216</td>';
        $str.='<td></td>';
        $str.='</tr>';

        $str.='<tr>';
        $str.='<td></td>';
        $str.='<td style="text-align: center;
        vertical-align: middle;">Contact No:01914120894, 01676031397 Email:greenair.official@gmail.com</td>';
        $str.='<td></td>';
        $str.='</tr>';

        $str.='</table>';

        $str.='<br>';
        
        $str.='<div style="">';

        $str.='<div align="center" color="green" style="font-size:30px;border:1px solid green;border-radius: 25px;">
                INVOICE
                </div>';
        $str.='</div>';

        /* $str.='<table>';
        $str.='<tr>';
        $str.='<td>';
        $str.='<div align="center" color="green" style="font-size:30px;border:1px solid green;border-radius: 25px;">
                INVOICE
                </div>';
        $str.='</td>';
        $str.='</tr>';
        $str.='</table>'; */

        $str.='<br>';
        $str.='<br>';

        $str.='<table>';
        $str.='<tr>';
        $str.='<td width="20%"></td>';
        $str.='<td text-align="center"></td>';
        $str.='<td width="20%"></td>';
        $str.='</tr>';
        $str.='</table>';

        $str.='<table>';

        $str.='<tr>';
        $str.='<td>Supplier Name: '.$request->supplier_name;
        $str.='</td>';

        


        $str.='<td> Mob: '.$request->contact_no;
        $str.='</td>';
        $str.='</tr>';

        $str.='<tr>';
        $str.='<td>&nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;.....................................................................';
        $str.='</td>';

        $str.='<td> &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;....................................................';
        $str.='</td>';
        $str.='</tr>';

        $str.='<tr>';
        $str.='<td>Address: '.$request->supplier_address;
        $str.='</td>';
        $str.='</tr>';

        $str.='<tr>';
        $str.='<td>&nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;.....................................................................';
        $str.='</td>';
        $str.='<td>..............................................................';
        $str.='</td>';
        $str.='</tr>';
        $str.='</table>';


        $str.='<br>';
        $str.='<br>';

        $str.='<table border=1 style="border-collapse: collapse; text-align:center" width="100%">';
        $str.='<tr>';
        
        $str.='<td>Sl No.';
        $str.='</td>';

        $str.='<td>Product Description';
        $str.='</td>';

        $str.='<td>Quantity';
        $str.='</td>';

        $str.='<td>Unit Price';
        $str.='</td>';

        $str.='<td>Amount';
        $str.='</td>';

        $str.='</tr>';

        $counter = $request->tr_counter;

        for($i=1; $i<$counter; $i++){
            
            if($request['delete_'.$i]==0){               
                $id = $request['product_'.$i];
                $quantity = $request['quantity_'.$i];
                $rate = $request['rate_'.$i];
                $amount = $request['amount_'.$i];

                $product_details = Product::find($id);

                $str.='<tr>';
        
                $str.='<td>'.$i;
                $str.='</td>';

                $str.='<td>'.$product_details->description;
                $str.='</td>';

                $str.='<td>'.$quantity;
                $str.='</td>';

                $str.='<td  align="right" >'.$this->comma($rate);
                $str.='</td>';

                $str.='<td align="right" >'.$this->comma($amount);
                $str.='</td>';

                $str.='</tr>';
            }
            
        }

        /* $str.='</tr>';
        $str.='</table>'; */
        $total_amount_words= $this->convet_TK($request->total);
     

        $str.='<tr>'; 

        $str.='<td colspan="3" rowspan="3" align="left"> Amount in words:  '.$total_amount_words;
        $str.='</td>';

        $str.='<td align="right">Total = ';
        $str.='</td>';

        $str.='<td align="right"> '.$this->comma($request->subtotal);
        $str.='</td>';

        $str.='</tr>';
        
        $str.='<tr>';
        $str.='<td align="right">Less Discount = ';
        $str.='</td>';

        $str.='<td align="right"> '.$this->comma($request->discount);
        $str.='</td>';
        $str.='</tr>';

        $str.='<tr>';
        $str.='<td align="right">Net Amount = ';
        $str.='</td>';

        $str.='<td align="right"> '.$this->comma($request->total);
        $str.='</td>';
        $str.='</tr>';

        $str.='</table>';


        $str.='<br>';
        $str.='<br>';
        $str.='<br>';
        $str.='<br>';
        $str.='<br>';
        $str.='<br>';



        $str.='<table>';
        $str.='<tr>';
        $str.='<td width="20%">..............................................</td>';
        $str.='<td style="text-align: center; vertical-align: middle;">Goods once sold not refundable</td>';
        $str.='<td width="20%">...............................................</td>';
        $str.='</tr>';

        $str.='<tr>';
        $str.='<td width="20%" style="text-align: center; vertical-align: middle;">Customer Signature</td>';
        $str.='<td style="text-align: center; vertical-align: middle;">THANK YOU FOR YOUR BUSINESS</td>';
        $str.='<td width="20%" style="text-align: center; vertical-align: middle;">Green Air</td>';
        $str.='</tr>';
        $str.='</table>';
        
        
        $str.="</body>";
        $str.="</html>";




        $mpdf->SetAuthor("Sharmista Kuri");
        $mpdf->SetTitle("Purchase".$request->invoice_no.".pdf");
        $mpdf->AddPage('P', 'A4');
     
        $mpdf->writeHTML($str, \Mpdf\HTMLParserMode::HTML_BODY, true, false);
       
        $mpdf->Output(date('Y-m-d').'_'.$request->invoice_no.'_purchase.pdf', 'I');
    }

    function convet_TK($amountcon)
	{
		$NO_A=explode(".",$amountcon);
		
		if (count($NO_A)==1)
			{$part1=$NO_A[0]; $part2='0';}
		else{$part1=$NO_A[0]; 
			$part2=substr("$NO_A[1]",0,2);}
		if ($this->convert_number($part2)=="zero")
		{
			return ' '.$this->convert_number($part1).'  Only.';
		}
		else
		{
			return ' '.$this->convert_number($part1).'  and Paisa '.$this->convert_number($part2).' only.';
		}
    }
    
    function convert_number($number)
	{
		if (($number < 0) || ($number > 99999999999999))
		{
			return "$number";
		}

		$Co = floor($number / 10000000);  /* Crore (giga) */
		$number -= $Co * 10000000;

		$Gn = floor($number / 1000000);
		//    $number -= $Gn * 1000000;

		$lukn = floor($number / 100000);  //luk (giga)
		$number -= $lukn * 100000;

		$kn = floor($number / 1000);     /* Thousands (kilo) */
		$number -= $kn * 1000;
		$Hn = floor($number / 100);      /* Hundreds (hecto) */
		$number -= $Hn * 100;
		$Dn = floor($number / 10);       /* Tens (deca) */
		$n = $number % 10;               /* Ones */

		$res = "";

		if ($Co)
		{
			$res .= $this->convert_number($Co) . " Crore";
		}

		if ($lukn)
		{
			$res .= (empty($res) ? "" : " ") .
				$this->convert_number($lukn) . " Lac";
		}

		if ($kn)
		{
			$res .= (empty($res) ? "" : " ") .
				$this->convert_number($kn) . " Thousand";
		}

		if ($Hn)
		{
			$res .= (empty($res) ? "" : " ") .
				$this->convert_number($Hn) . " Hundred";
		}

		$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven",
		"Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen");

		$tens = array("", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty" , "Ninety");

		if ($Dn || $n)
		{
			if (!empty($res))
			{
				$res .= " ";
			}

			if ($Dn < 2)
			{
				$res .= $ones[$Dn * 10 + $n];
			}
			else
			{
				$res .= $tens[$Dn];

				if ($n)
				{
					$res .= "-" . $ones[$n];
				}
			}
		}

		if (empty($res))
		{
			$res = "zero";
		}

		return $res;
    }
    
    function comma($amout)
	{
		$minSign='';
		$len3=0;
		if($amout<0){
			$removeminus=str_replace("-","",$amout);
			$amout=$removeminus;
			$minSign='-';
		}
		$removeDot=explode(".",$amout);
		if (count($removeDot)==1){$amountf=$amout; $spart='00';}else{$amountf=$removeDot[0]; $spart=$removeDot[1];}

		$len3=strlen($amountf);
		if($len3 > 3)
		{
			$out3=substr($amountf, $len3-3);
			$out2=substr($amountf, 0, $len3-3);
			$len2=strlen($out2);
			$out2r=$out2;

			if($len2 > 2){
				$out22=$this->coma2($out2,$len2);
				$result=$out22.$out3.'.'.$spart;
			}
			else{
			$result=$out2.','.$out3.'.'.$spart;
			}
		}
		else
		{
		$result=$removeDot[0].'.'.$spart;
		}
		return $minSign.$result;
    }
    
    function coma2($amout,$len2)
	{
		$out2r=$amout;
		$out22r='';
		$len2h=$len2;
		for($i=1; $i<$len2; $i=$i+2)
		{
			$outNext='';
			$out22r=substr($out2r, $len2h-2).','.$out22r;
			$outNext=substr($out2r, 0, $len2h-2);
			if(strlen($outNext)<=2){
			 $out22r=$outNext.','.$out22r;
			 break;
			}
			$len2h=strlen($outNext);
			$out2r=$outNext;

		}
		return $out22r;
    }

    
}
