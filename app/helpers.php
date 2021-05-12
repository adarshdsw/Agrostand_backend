<?php

function send_sms($data = null){
	// create curl resource
	$ch = curl_init();

	$url = 'http://sms.bulksmsind.in/v2/sendSMS?username=apsmobilerr&message=this is test message&sendername=SCREEB&smstype=TRANS&numbers=8818883436&apikey=129d3d35-cc04-4ad3-bf7d-56d67d26f028&peid=1201161847497442672&templateid=1207161908466462809';

	// $url = 'http://sms.indiawebsoft.in/api/sendhttp.php?authkey=15533AfOT51IKke5e6375d4P15&mobiles=8818883436&message=Hello There Test Message from Myagrostand&sender=INDWEB&route=4&country=91';

	// set url
	curl_setopt($ch, CURLOPT_URL, $url);

	//return the transfer as a string
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	// $output contains the output string
	$output = curl_exec($ch);

	// close curl resource to free up system resources
	curl_close($ch);

	return $output;
}



?>