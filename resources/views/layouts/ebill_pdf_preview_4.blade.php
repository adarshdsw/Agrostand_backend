<!DOCTYPE html>
<html>
	<head>
		<title>E Bill</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

		<style type="text/css">
			body {
				font-family: 'Montserrat', sans-serif;
				font-size: 14px;
			}
			th, td {
			    padding: 10px;
			}
			.bg {
			    position: relative;
			    background-image: url({{ $custom_data['banner_base64'] }});
			    height: 300px;
			    background-repeat: no-repeat;
			    background-size: cover;
			    display: flex;
			    justify-content: center;
			    align-items: center;
			}
			.bg:after {
			    content: '';
			    background-color: rgba(255,255,255,0.5);
			    position: absolute;
			    top: 0;
			    bottom: 0;
			    width: 100%;
			    height: 100%;
			}
			.bg h2 {
			    z-index: 99;	
			    color: #ffffff;
			    text-shadow: 2px 2px 4px rgb(0 0 0 / 70%);
			    font-size: 36px;
			}
			td.minus {
			    color: #d21414;
			}
		</style>	
	</head>
<body>
<table width="1000" cellpadding="0" cellspacing="0" border="0" style="width: 1000px; margin: 0 auto;">
	<tr>
		<td align="center" colspan="6">
			<img src="{{ $custom_data['logo_base64'] }}" alt="logo">
		</td>
	</tr>

	<tr>
		<td colspan="6">
			<div class="bg">
				<h2>Agro Agrochecmic</h2>
			</div>
		</td>
	</tr>

	<tr>
		<td>
			<table width="100%" cellpadding="7" cellspacing="5" border="0" style="width: 100%; padding: 15px; background-color: #f1f1f1;">
					<tr>
						<td width="7%">To</td>
						<td width="26.33%" bgcolor="#e8e8e8" style="font-weight: 600;">Lorem Ipsum</td>
						<td width="7%">To</td>
						<td width="26.33%" bgcolor="#e8e8e8" style="font-weight: 600;">Lorem Ipsum</td>
						<td width="7%">To</td>
						<td width="26.33%" bgcolor="#e8e8e8" style="font-weight: 600;">Lorem Ipsum</td>
					</tr>
					<tr>
						<td width="7%">To</td>
						<td width="26.33%" bgcolor="#e8e8e8" style="font-weight: 600;">Lorem Ipsum</td>
						<td width="7%">To</td>
						<td width="26.33%" bgcolor="#e8e8e8" style="font-weight: 600;">Lorem Ipsum</td>
						<td width="7%">To</td>
						<td width="26.33%" bgcolor="#e8e8e8" style="font-weight: 600;">Lorem Ipsum</td>
					</tr>
					<tr>
						<td width="7%">To</td>
						<td width="26.33%" bgcolor="#e8e8e8" style="font-weight: 600;">Lorem Ipsum</td>
						<td width="7%">To</td>
						<td width="26.33%" bgcolor="#e8e8e8" style="font-weight: 600;">Lorem Ipsum</td>
						<td width="7%">To</td>
						<td width="26.33%" bgcolor="#e8e8e8" style="font-weight: 600;">Lorem Ipsum</td>
					</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td>
			<table width="70%" cellpadding="0" cellspacing="2" border="0" >
				<tr>
					<td colspan="6">
						<h3 style="background-cOlor: #259e46; margin: 0; padding: 10px; color: #ffffff;">Lorem Ipsum</h3>
					</td>
				</tr>
				<tr>
					<th align="left" width="16.66%" style="font-size: 12px;" bgcolor="#cccccc">
						S. No.
					</th>
					<th align="left" width="16.66%" style="font-size: 12px;" bgcolor="#cccccc">
						Lot Item
					</th>
					<th align="left" width="16.66%" style="font-size: 12px;" bgcolor="#cccccc">
						Packet
					</th>
					<th align="left" width="16.66%" style="font-size: 12px;" bgcolor="#cccccc">
						Weight
					</th>
					<th align="left" width="16.66%" style="font-size: 12px;" bgcolor="#cccccc">
						Rate
					</th>
					<th align="left" width="16.66%" style="font-size: 12px;" bgcolor="#cccccc">
						Total Amount
					</th>
				</tr>
				<tr>
					<td>
						1
					</td>
					<td>
						Tomato A11
					</td>
					<td>
						10
					</td>
					<td>
						20 Qtl
					</td>
					<td>
						₹1,000/Qtl
					</td>
					<td>
						₹20,000
					</td>
				</tr>
				<tr>
					<td>
						1
					</td>
					<td>
						Tomato A11
					</td>
					<td>
						10
					</td>
					<td>
						20 Qtl
					</td>
					<td>
						₹1,000/Qtl
					</td>
					<td>
						₹20,000
					</td>
				</tr>
				<tr>
					<td>
						1
					</td>
					<td>
						Tomato A11
					</td>
					<td>
						10
					</td>
					<td>
						20 Qtl
					</td>
					<td>
						₹1,000/Qtl
					</td>
					<td>
						₹20,000
					</td>
				</tr>
								<tr>
					<td>
						1
					</td>
					<td>
						Tomato A11
					</td>
					<td>
						10
					</td>
					<td>
						20 Qtl
					</td>
					<td>
						₹1,000/Qtl
					</td>
					<td>
						₹20,000
					</td>
				</tr>

				<tr>
					<td colspan="5" width="83.34%" align="right" style="font-weight: 600;">
						Total Commodities Amount
					</td>
					<td width="16.66%" align="right" style="font-weight: 600;">
						₹60,000
					</td>
				</tr>
			</table>

			<table width="30%" cellpadding="0" cellspacing="2" border="0">
				<tr>
					<td colspan="2">
						<h3 style="background-cOlor: #259e46; margin: 0; padding: 10px; color: #ffffff;">Lorem Ipsum</h3>
					</td>
				</tr>
				<tr>
					<th align="left" width="60%" style="font-size: 12px;" bgcolor="#cccccc">
						Item
					</th>
					<th align="left" width="40%" style="font-size: 12px;" bgcolor="#cccccc">
						Amount
					</th>
				</tr>
				<tr>
					<td style="font-weight: 600;">
						Advance
					</td>
					<td align="right" style="font-weight: 600;">
						₹1,000
					</td>
				</tr>
				<tr>
					<td style="font-weight: 600;">
						Bank Charge
					</td>
					<td align="right" style="font-weight: 600;">
						₹200
					</td>
				</tr>
				<tr>
					<td style="font-weight: 600;">
						Mandi Tax
					</td>
					<td align="right" style="font-weight: 600;">
						₹1,500
					</td>
				</tr>
				<tr>
					<td style="font-weight: 600;">
						Other Expenses
					</td>
					<td align="right" style="font-weight: 600;">
						₹1,500
					</td>
				</tr>
				<tr>
					<td style="font-weight: 600;">
						Expenses:
					</td>
					<td align="right" style="font-weight: 600;" class="minus">
						₹4,200
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<h2 style="background-cOlor: #259e46; margin: 0; padding: 10px; color: #ffffff; text-align: right;">Total Payable Amount: ₹55,800</h2>
		</td>
	</tr>
	<tr>
		<td>
			<p>Total Payable Amount in words:</p>
			<h4 style="font-weight: bold;">Fifty Five Thousand Eight Hundred Only</h4>
		</td>
	</tr>
</table>
</body>
</html>
