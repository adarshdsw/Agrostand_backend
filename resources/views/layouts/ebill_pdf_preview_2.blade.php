<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>{{config('app.name')}} - Invoice</title>
    <style type="text/css" media="all">
    	.clearfix:after {
		  content: "";
		  display: table;
		  clear: both;
		}

		a {
		  color: #5D6975;
		  text-decoration: underline;
		}

		body {
		  position: relative;
		  width: 21cm;  
		  height: 29.7cm; 
		  margin: 0 auto; 
		  color: #001028;
		  background: #FFFFFF; 
		  font-family: Arial, sans-serif; 
		  font-size: 12px; 
		  font-family: Arial;
		}

		header {
		  padding: 10px 0;
		  margin-bottom: 30px;
		}

		#logo {
		  text-align: center;
		  margin-bottom: 10px;
		}

		#logo img {
		  width: 90px;
		}

		h1 {
		  border-top: 1px solid  #5D6975;
		  border-bottom: 1px solid  #5D6975;
		  color: #5D6975;
		  font-size: 2.4em;
		  line-height: 1.4em;
		  font-weight: normal;
		  text-align: center;
		  margin: 0 0 20px 0;
		  background: url({{ $custom_data['dimention_base64'] }});
		}

		.project {
		  	/*float: left;*/
		  	width: 100%
		}

		.project span {
		  color: #5D6975;
		  text-align: right;
		  width: 52px;
		  margin-right: 10px;
		  display: inline-block;
		  font-size: 0.8em;
		}

		#company {
		  /*float: right;*/
		  text-align: right;
		}

		.project div,
		#company div {
		  /*display: flex;  */
  		  flex-wrap: wrap;
		}

		table {
		  width: 100%;
		  border-collapse: collapse;
		  border-spacing: 0;
		  margin-bottom: 20px;
		}

		table tr:nth-child(2n-1) td {
		  background: #F5F5F5;
		}

		table th,
		table td {
		  text-align: center;
		}

		table th {
		  padding: 5px 20px;
		  color: #5D6975;
		  border-bottom: 1px solid #C1CED9;
		  white-space: nowrap;        
		  font-weight: normal;
		}

		table .service,
		table .desc {
		  text-align: left;
		}

		table td {
		  padding: 15px;
		  text-align: right;
		}
		
		table tr.other_expenses td {
		  padding: 3px;
		  text-align: right;
		}

		table td.service,
		table td.desc {
		  vertical-align: top;
		}

		table td.unit,
		table td.qty,
		table td.total {
		  font-size: 1.2em;
		}

		table td.grand {
		  border-top: 1px solid #5D6975;;
		}

		#notices .notice {
		  color: #5D6975;
		  font-size: 1.2em;
		}

		footer {
		  color: #5D6975;
		  width: 100%;
		  height: 30px;
		  position: absolute;
		  bottom: 0;
		  border-top: 1px solid #C1CED9;
		  padding: 8px 0;
		  text-align: center;
		}
		p span {
		    display: table-cell;
		}
		.project > table td {
		    padding: 0px 2px;
		    text-align: left;
		}
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="{{ $custom_data['logo_base64'] }}">
      </div>
      <h1>INVOICE-{{ $ebill->bill_number }}</h1>

      <div class="project">
	      <table width="100%" style="margin: 0 auto;" cellspacing="0" cellpadding="5" >
	      	<tr>
	      		<td style="width: 33.33%">
	      			<table width="100%" cellspacing="0" cellpadding="0" border="0">
						<tr>
							<td colspan="12" style="font-weight: bold;">From </td>
						</tr>
	      				<tr>
	      					<td width="20%">
	      						<p style="font-size: 10px;">Name : </p>
	      					</td>
	      					<td width="80%">
	      						<p style="font-size: 10px";>{{ $ebill->user->name }}</p>
	      					</td>
	      				</tr>
	      				<tr>
	      					<td width="20%">
	      						<p style="font-size: 10px;">Address : </p>
	      					</td>
	      					<td width="80%">
	      						<p style="font-size: 10px";>{{ $ebill->ship_to }}</p>
	      					</td>
	      				</tr>
	      				<tr>
	      					<td width="20%">
	      						<p style="font-size: 10px;">Email : </p>
	      					</td>
	      					<td width="80%">
	      						<p style="font-size: 10px";>{{ $ebill->user->email }}</p>
	      					</td>
	      				</tr>
	      				<tr>
	      					<td width="20%">
	      						<p style="font-size: 10px";>phone : </p>
	      					</td>
	      					<td width="80%">
	      						<p style="font-size: 10px";>{{ $ebill->user->mobile }}</p>
	      					</td>
	      				</tr>
	      				<!-- <tr>
	      					<td width="20%">
	      						<p style="font-size: 10px";>extra</p>
	      					</td>
	      					<td width="80%">
	      						<p style="font-size: 10px";>sed do eiusmod incididunt ut labore.</p>
	      					</td>
	      				</tr> -->
	      			</table>
	      		</td>

	      		<td style="width: 33.33%">
	      			<table width="100%" cellspacing="0" cellpadding="0" border="0">
	      				<tr>
							<td colspan="12" style="font-weight: bold;">To </td>
						</tr>
	      				<tr>
	      					<td width="20%">
	      						<p style="font-size: 10px;">Name : </p>
	      					</td>
	      					<td width="80%">
	      						<p style="font-size: 10px";>{{ $ebill->vendor->name }}</p>
	      					</td>
	      				</tr>
	      				<tr>
	      					<td width="20%">
	      						<p style="font-size: 10px;">Address : </p>
	      					</td>
	      					<td width="80%">
	      						<p style="font-size: 10px";>{{ $ebill->bill_to }}</p>
	      					</td>
	      				</tr>
	      				<tr>
	      					<td width="20%">
	      						<p style="font-size: 10px;">Email</p>
	      					</td>
	      					<td width="80%">
	      						<p style="font-size: 10px";>{{ $ebill->vendor->email }}</p>
	      					</td>
	      				</tr>
	      				<tr>
	      					<td width="20%">
	      						<p style="font-size: 10px";>phone</p>
	      					</td>
	      					<td width="80%">
	      						<p style="font-size: 10px";>{{ $ebill->vendor->mobile }}</p>
	      					</td>
	      				</tr>
	      				<!-- <tr>
	      					<td width="20%">
	      						<p style="font-size: 10px";>extra</p>
	      					</td>
	      					<td width="80%">
	      						<p style="font-size: 10px";>sed do eiusmod incididunt ut labore.</p>
	      					</td>
	      				</tr> -->
	      			</table>
	      		</td>

	      		<td style="width: 33.33%">
	      			<table width="100%" cellspacing="0" cellpadding="0" border="0">
	      				<tr>
							<td colspan="12" style="font-weight: bold;">Bill Detail</td>
						</tr>
	      				<tr>
	      					<td width="20%">
	      						<p style="font-size: 10px;">Bill Number</p>
	      					</td>
	      					<td width="80%">
	      						<p style="font-size: 10px";>#{{ $ebill->bill_number }}</p>
	      					</td>
	      				</tr>
	      				<tr>
	      					<td width="20%">
	      						<p style="font-size: 10px;">Order Id</p>
	      					</td>
	      					<td width="80%">
	      						<p style="font-size: 10px";>{{ $ebill->order_id }}</p>
	      					</td>
	      				</tr>
	      				<tr>
	      					<td width="20%">
	      						<p style="font-size: 10px;">Bill Date:</p>
	      					</td>
	      					<td width="80%">
	      						<p style="font-size: 10px";>{{ date('d-m-Y', strtotime($ebill->bill_date)) }}</p>
	      					</td>
	      				</tr>
	      				<tr>
	      					<td width="20%">
	      						<p style="font-size: 10px";>Due Date</p>
	      					</td>
	      					<td width="80%">
	      						<p style="font-size: 10px";>{{ date('d-m-Y', strtotime($ebill->due_date)) }}</p>
	      					</td>
	      				</tr>
	      			</table>
	      		</td>

	      	</tr>
	      </table>
      </div>
      	
    </header>
    <main>
      <table>
        <thead>
          <tr>
          	<th>#</th>
            <th class="service">Product</th>
            <th>QTY</th>
            <th>Volume</th>
            <th>Unit</th>
            <th>Rate</th>
            <th>Tax</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
        	@php
        		$counter = 1;
        	@endphp
        	@foreach($ebill->products as $product)
				<tr>
					<td>{{ $counter }}</td>
					<td>{{ $product->product_name }}</td>
					<td>{{ $product->packet_number }}</td>
					<td>{{ $product->total_volume }}</td>
					<td>{{ $product->volume_unit }}</td>
					<td>{{ $product->product_rate }}</td>
					<td>{{ $product->product_tax }}</td>
					<td>{{ $product->subtotal }}</td>
				</tr>
				@php
        			$counter++;
        		@endphp
			@endforeach
	
			<tr style="width: 100%">
				<td style="width: 33.33%">
					<table width="100%" cellspacing="0" cellpadding="0" border="0">
			          <tr>
			            <td>Shipping Charge</td>
			            <td class="total">{{ $ebill->expenses->shipping_charge }}</td>
			          </tr>
			          <tr>
			            <td>Bank Charge</td>
			            <td class="total">{{ $ebill->expenses->bank_charge }}</td>
			          </tr>
			          <tr>
			            <td>Mandi Tax:</td>
			            <td class="total">{{ $ebill->expenses->mandi_tax }}</td>
			          </tr>
			          <tr>
			            <td>Other Expense:</td>
			            <td class="total">{{ $ebill->expenses->other_expense }}</td>
			          </tr>
			        </table>
				</td>
				<td style="width: 33.33%">
					<table width="100%" cellspacing="0" cellpadding="0" border="0">
			          <tr>
			            <td colspan="7">Advance Amount</td>
			            <td class="total">{{ $ebill->advance_amount }}</td>
			          </tr>
			          <tr>
			            <td colspan="7">Due Amount</td>
			            <td class="total">{{ $ebill->due_amount }}</td>
			          </tr>
			          <tr>
			            <td colspan="7" class="grand total">GRAND TOTAL</td>
			            <td class="grand total">{{ $ebill->total_amount }}</td>
			          </tr>
			        </table>
				</td>
			</tr>
        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>