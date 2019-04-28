<?php
	$url = 'http://api.apixu.com/v1';
	$authToken = 'e690024b3b2b4122bcb140627192704';


	if(isset($_POST['zip'])){
		$zip = $_POST['zip'];

		// Setup cURL with authentication token and location
		$ch = curl_init($url.'/current.json?key='.$authToken.'&q='.$zip);
		curl_setopt_array($ch, array(
			CURLOPT_POST => TRUE,
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Content-Length: 0'
			),
		));


		// Send request
		$response = curl_exec($ch);

		// Check for errors
		if($response === FALSE){
			die(curl_error($ch));
		}

		// Decode the response
		$responseData = json_decode($response, TRUE);


		// Print the date from the response
		//echo $responseData['current']['temp_f'];

	}
?>


<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Weather</title>
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"
		integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
		crossorigin="anonymous"></script>

	<script>
        $(document).ready(function() {
            $apiResponse = <?php echo $response?>;

            $('#currentWeather').append($apiResponse["current"]["temp_f"]);


        });
	</script>
</head>
<body>

<form action="#" method="post">
	<input type="text" name="zip" id="zip">
	<input type="submit">

	<div id="currentWeather">

	</div>
</form>
</body>
</html>