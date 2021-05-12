<!DOCTYPE html>
<html>
	<head>
		<title>E Bill</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type="text/css" media="all">
			body{
				font-family: 'Montserrat', sans-serif;
			}
			section.header {
			    position: relative;
			    background-image: url({{ $custom_data['banner_base64'] }});
			    height: 300px;
			    background-repeat: no-repeat;
			    background-size: cover;
			    display: flex;
			    justify-content: center;
			    align-items: center;
			}
			section.header:after {
			    content: '';
			    background-color: rgba(255,255,255,0.5);
			    position: absolute;
			    top: 0;bottom: 0;
			    width: 100%;
			    height: 100%;
			}
			.header-content {
			    z-index: 9;
			}
			.header-content h1 {
			    color: #ffffff;
			    font-size: 36px;
			}
			.three-col {
			    display: flex;
			    align-items: center;
    			justify-content: space-between;
			}
			.three-col {
			    background-color: #f5f5f5;
			}
			.three-col .col {
			    width: 33.33%;
			    padding: 15px 10px;
			}
			.three-col .col table, .detail table {
			    width: 100%;
			}
			.three-col .col table tr td:nth-child(2) {
			    width: 75%;
			    background-color: #e8e8e8;
			}
			.three-col .col table tr td:first-child {
			    width: 25%;
			}
			.three-col .col table tr td {
			    font-size: 14px;
			    font-weight: 500;
			    padding: 8px;
			}
			section.detail {
			    display: flex;
			}
			.product-detail {
			    width: 70%;
			    margin-right: 15px;
			}
			.expense-detail {
			    width: 30%;
			}
			section.detail h3 {
			    background-color: #259e46;
			    padding: 10px;
			    color: #ffffff;
			    margin: 0;
			}
			table tr td, table tr th {
			    padding: 10px;
			    font-weight: 600;
			    color: #333333;
			    font-size: 14px;
			}
			td.minus {
			    color: #d21414;
			}
			.total {
			    text-align: right;
			    background-color: #259e46;
			    padding: 10px;
			    margin-top: 50px;
			}
			.total h3 {
			    margin: 0;
			    color: #ffffff;
			}
			table.expenses {
			    background-color: #ffebeb;
			}
			.amopunt p {
			    margin: 25px 0 0;
			}
			.logo img {
			    width: 100px;
			}
			.logo {
			    text-align: center;
			}
		</style>
	</head>
<body>
<div style="width: 1000px;margin: 0 auto;">
	<div class="logo">
		<img src="{{ $custom_data['logo_base64'] }}" alt="logo">
	</div>
	<section class="header">
		<div class="header-content">
			<h1>Agro Agrochemic</h1>
		</div>
	</section>

	<section>
		<div class="three-col">
			<div class="col">
				<table>
					<tr>
						<td style="font-weight: bold;">From</td>
					</tr>
					<tr>
						<td>Name :</td>
						<td>{{ $ebill->user->name }}</td>
					</tr>
					<tr>
						<td>Address :</td>
						<td>{{ $ebill->ship_to }}</td>
					</tr>
					<tr>
						<td>Email :</td>
						<td>{{ $ebill->user->email }}</td>
					</tr>
					<tr>
						<td>phone :</td>
						<td>{{ $ebill->user->mobile }}</td>
					</tr>
				</table>
			</div>

			<div class="col">
				<table>
					<tr>
						<td style="font-weight: bold;">To</td>
					</tr>
					<tr>
						<td>Name</td>
						<td>{{ $ebill->vendor->name }}</td>
					</tr>
					<tr>
						<td>Address :</td>
						<td>{{ $ebill->bill_to }}</td>
					</tr>
					<tr>
						<td>Email :</td>
						<td>{{ $ebill->vendor->email }}</td>
					</tr>
					<tr>
						<td>Phone :</td>
						<td>{{ $ebill->vendor->mobile }}</td>
					</tr>
				</table>
			</div>

			<div class="col">
				<table>
					<tr>
						<td style="font-weight: bold;">Bill Detail</td>
					</tr>
					<tr>
						<td>Bill Number</td>
						<td>#{{ $ebill->bill_number }}</td>
					</tr>
					<tr>
						<td>Order Id</td>
						<td>{{ $ebill->order_id }}</td>
					</tr>
					<tr>
						<td>Bill Date:</td>
						<td>{{ date('d-m-Y', strtotime($ebill->bill_date)) }}</td>
					</tr>
					<tr>
						<td>Due Date:</td>
						<td>{{ date('d-m-Y', strtotime($ebill->due_date)) }}</td>
					</tr>
				</table>
			</div>			
		</div>
	</section>

	<section class="detail">
		<div class="product-detail">
			<h3>Product Detail</h3>
				<table>
					<thead>
						<tr>
							<th align="left" bgcolor="#cccccc">#</th>
							<th align="left" bgcolor="#cccccc">Product</th>
							<th align="left" bgcolor="#cccccc">QTY</th>
							<th align="left" bgcolor="#cccccc">Volume</th>
							<th align="left" bgcolor="#cccccc">Unit</th>
							<th align="left" bgcolor="#cccccc">Rate</th>
							<th align="left" bgcolor="#cccccc">Tax</th>
							<th align="left" bgcolor="#cccccc">TOTAL</th>
						</tr>
					</thead>
					<tbody>
						@php
			        		$counter = 1;
			        	@endphp
			        	@foreach($ebill->products as $product)
							<tr>
								<td align="left">{{ $counter }}</td>
								<td align="left">{{ $product->product_name }}</td>
								<td align="left">{{ $product->packet_number }}</td>
								<td align="left">{{ $product->total_volume }}</td>
								<td align="left">{{ $product->volume_unit }}</td>
								<td align="left">{{ $product->product_rate }}</td>
								<td align="left">{{ $product->product_tax }}</td>
								<td align="left">{{ $product->subtotal }}</td>
							</tr>
							@php
			        			$counter++;
			        		@endphp
						@endforeach
						
						<!-- <tr>
							<td align="right" colspan="5">Total Commodities Amount</td>
							<td align="right">₹60,000</td>
						</tr> -->

					</tbody>
				</table>
		</div>
		<div class="expense-detail">
			<h3>Expenses Details</h3>
				<table class="expenses">
					<thead>
						<tr>
							<th align="left" bgcolor="#cccccc">Item</th>
							<th align="right" bgcolor="#cccccc">Amount</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td align="left">Shipping Charge</td>
							<td align="right">₹{{ $ebill->expenses->shipping_charge }}</td>
						</tr>

						<tr>
							<td align="left">Bank Charge</td>
							<td align="right">₹{{ $ebill->expenses->bank_charge }}</td>
						</tr>

						<tr>
							<td align="left">Mandi Tax</td>
							<td align="right">₹{{ $ebill->expenses->mandi_tax }}</td>
						</tr>

						<tr>
							<td align="left">Other Expenses</td>
							<td align="right">₹{{ $ebill->expenses->other_expense }}</td>
						</tr>

						<tr>
							<td align="left">Advance Amount</td>
							<td align="right">₹{{ $ebill->advance_amount }}</td>
						</tr>
						<tr>
							<td align="left">Advance Amount</td>
							<td align="right">₹{{ $ebill->due_amount }}</td>
						</tr>

						<!-- <tr>
							<td align="left">Expenses:</td>
							<td align="right" class="minus">-₹4,200</td>
						</tr> -->

					</tbody>
				</table>
		</div>
	</section>

	<div class="total">
		<h3>Total Payable Amount: <span>₹{{ $ebill->total_amount }}</span></h3>
	</div>

	<div class="amopunt">
		<p>Total Payable Amount in words:</p>
		<h4>Fifty Five Thousand Eight Hundred Only</h4>
	</div>
</div>	
</body>
</html>