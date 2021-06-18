<!DOCTYPE html>
<html>
<head>
	<title>AgroService - AgroStand</title>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
	<style type="text/css">
		body{
			font-family: 'Open Sans', sans-serif;
			font-size: 14px;
			font-weight: 400;
		}
		p span{
			font-weight: 600;
		}
		img.social-icon {
		    margin: 5px;
		}
		tr.foot-social td {
		    padding: 0;
		}
		tr.footer {
		    background-image: url(img/banner.png);
		    height: 275px;
		    background-position: center;
		    background-size: cover;
		    background-repeat: no-repeat;
		}
		tr.footer td p {
		    color: #000;
		}
		tr.footer td {
		    padding: 0 10px;
		}
		tr.listing td {
		    padding: 0 5px;
		}	
		span.otp {
		    top: 75%;
		    left: 7%;
		    font-weight: bold;
		    border: 1px solid #cccccc;
		    padding: 5px 15px;
		    border-radius: 6px;
		    background: #ffffff;
		    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
		}			
	</style>
</head>
<body>

<table style="width: 600px;background-color: #f1f6f9;margin: 0 auto;" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<table border="0" cellpadding="10" cellspacing="0" width="100%">
				<tr>
					<td align="left" style="display: flex;align-items: center;" display:="">
						<img src="{{ asset('front/img/logo.png') }}" style="width: 250px; height: auto;">
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="10" cellspacing="0" width="100%">
				<tr>
					<td>
						<p style="margin: 0;">Hello <span> Admin</span> ,</p>
					</td>
				</tr>
				<tr>
					<td>
						<p>Agro Service has been created for you.</p>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<p style="margin: 0;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</td>
				</tr>
				<!-- Ebill Data start -->
				<tr>
					<td>
						<p style="margin: 0;">E-Bill Data</p>
					</td>
				</tr>
				<tr>
					<td><p style="margin: 0;"><span style="font-weight: bold; width: 15%; display: inline-block;">Order ID</span> {{ $data['ebill']->order_id }}</p></td>
				</tr>
				<tr>
					<td><p style="margin: 0;"><span style="font-weight: bold; width: 15%; display: inline-block;">Bill Number</span> {{ $data['ebill']->bill_number }}</p></td>
				</tr>
				<tr>
					<td><p style="margin: 0;"><span style="font-weight: bold; width: 15%; display: inline-block;">Specification</span> {{ $data['ebill']->specification }}</p></td>
				</tr>
				<tr>
					<td><p style="margin: 0;"><span style="font-weight: bold; width: 15%; display: inline-block;">Ship To</span> {{ $data['ebill']->ship_to }}</p></td>
				</tr>
				<tr>
					<td><p style="margin: 0;"><span style="font-weight: bold; width: 15%; display: inline-block;">Bill To</span> {{ $data['ebill']->bill_to }}</p></td>
				</tr>
				<tr>
					<td><p style="margin: 0;"><span style="font-weight: bold; width: 15%; display: inline-block;">Bill Date</span> {{ $data['ebill']->bill_date }}</p></td>
				</tr>
				<tr>
					<td><p style="margin: 0;"><span style="font-weight: bold; width: 15%; display: inline-block;">Due To</span> {{ $data['ebill']->due_date }}</p></td>
				</tr>
				<tr>
					<td><p style="margin: 0;"><span style="font-weight: bold; width: 15%; display: inline-block;">Advance Amount</span> {{ $data['ebill']->advance_amount }}</p></td>
				</tr>
				<tr>
					<td><p style="margin: 0;"><span style="font-weight: bold; width: 15%; display: inline-block;">Due Amount</span> {{ $data['ebill']->due_amount }}</p></td>
				</tr>
				<tr>
					<td><p style="margin: 0;"><span style="font-weight: bold; width: 15%; display: inline-block;">Total Amount</span> {{ $data['ebill']->total_amount }}</p></td>
				</tr>

	     		<tr>
	     			<td>
	     				<p style="text-align: center;">Wish, you all the best!</p>
	     			</td>
	     		</tr>
	     		<tr>
	     			<td>
	     				<p style="margin: 0;">Your sincerely,</p>
	     				<p style="margin: 10px 0; font-size: 16px;font-weight: bold;color: #f06135; ">My Agrostand Team</p>
	     			</td>
	     		</tr>
				<tr>
					<td style="text-align: center;">
						<img src="{{ asset('img/logo.png') }}" style="width: 250px; height: auto;">
					</td>
				</tr>
				<tr style="display: flex;align-items: center;justify-content: center;" class="foot-social">
					<td><a target="_blank" href="javascript:;"><img src="{{ asset('front/images/mail/twitter.png') }}" width="30" class="social-icon" alt="twitter"></a></td>
					<td><a target="_blank" href="javascript:;"><img src="{{ asset('front/images/mail/facebook.png') }}" width="30" class="social-icon" alt="facebook"></a></td>
					<td><a target="_blank" href="javascript:;"><img src="{{ asset('front/images/mail/insta.png') }}" width="30" class="social-icon" alt="insta"></a></td>
					<td><a target="_blank" href="javascript:;"><img src="{{ asset('front/images/mail/youtube.png') }}" width="30" class="social-icon" alt="youtube"></a></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr class="footer">
		<td>
			<p style="margin: 5px 0;">If you have any question, feel free to message us at myagrostand@gmail.com</p>
			<p style="margin: 15px 0 0;"><span>Address:</span> 121, Devi Ahilya Marg, Sahakar Nagar, Snehlataganj, Indore, Madhya Pradesh 452003</p>
			<p style="margin: 15px 0;"><span>Tel:</span> 7489480837</p>
			<p style="margin: 5px 0;"><span>Website:</span> http://myagrostand.com</p>
			<p style="margin: 25px 0;text-align: center;">© 2021, All Rights Reserved</p>
		</td>
	</tr>
</table>
</body>
</html>