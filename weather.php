<?php
	$url = 'http://api.apixu.com/v1';
	$authToken = 'e690024b3b2b4122bcb140627192704';


	if(isset($_POST['zip'])){
		$zip = $_POST['zip'];

		// Setup cURL with authentication token and location
		$forecast = curl_init($url.'/forecast.json?key='.$authToken.'&q='.$zip.'&days=5');
		curl_setopt_array($forecast, array(
			CURLOPT_POST => TRUE,
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Content-Length: 0'
			),
		));


		// Send requests
		$responseForecast = curl_exec($forecast);

		// Check for errors
		if($responseForecast === FALSE) {
			die(curl_error($forecast));

		}

			// Decode the response
		//$responseData = json_decode($responseCurrent, TRUE);


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
            $apiResponseForecast = <?php echo $responseForecast?>;


            $('#location #cityState').append($apiResponseForecast['location']['name'] +', '+ $apiResponseForecast['location']['region']);

            $('#currentWeather .avgTemp').append($apiResponseForecast['current']['temp_f'] + '&deg;F');
            $('#currentWeather .precip').append($apiResponseForecast['current']['precip_in']+ ' in');
            $('#currentWeather .humidity').append($apiResponseForecast['current']['humidity']+ '&percnt;');
            $('#currentWeather .wind').append($apiResponseForecast['current']['wind_mph']+ ' mph');
            $('#currentWeather .windDirection').append($apiResponseForecast['current']['wind_dir']);


            for(let day=0; day<5; day++) {
                $('#forecastDay'+day+' .date').append($apiResponseForecast['forecast']['forecastday'][day]['date']);
                $('#forecastDay'+day+' .avgTemp').append($apiResponseForecast['forecast']['forecastday'][day]['day']['avgtemp_f'] + '&deg;F');
                $('#forecastDay'+day+' .maxTemp').append($apiResponseForecast['forecast']['forecastday'][day]['day']['maxtemp_f']+ '&deg;F');
                $('#forecastDay'+day+' .minTemp').append($apiResponseForecast['forecast']['forecastday'][day]['day']['mintemp_f']+ '&deg;F');
                $('#forecastDay'+day+' .precip').append($apiResponseForecast['forecast']['forecastday'][day]['day']['totalprecip_in']+ ' in');
                $('#forecastDay'+day+' .humidity').append($apiResponseForecast['forecast']['forecastday'][day]['day']['avghumidity']+ '&percnt;');
                $('#forecastDay'+day+' .wind').append($apiResponseForecast['forecast']['forecastday'][day]['day']['maxwind_mph']+ ' mph');
            }

        });
	</script>
</head>
<body>

<form action="#" method="post">
	<input type="text" name="zip" id="zip">
	<input type="submit">
	<div id="location">
		<h2 id="cityState">Location: </h2>
	</div>
	<div id="currentWeather">
		<h2>Current Weather</h2>
		<p class="avgTemp">Average Temperature: </p>
		<p class="precip">Precipitation: </p>
		<p class="humidity">Humidity: </p>
		<p class="wind">Wind Speed: </p>
		<p class="windDirection">Wind Direction: </p>

	</div>

	<div id="forecastDay0">
		<h2 class="date">Day 1 - </h2>
		<p class="avgTemp">Average Temperature: </p>
		<p class="maxTemp">Max Temperature: </p>
		<p class="minTemp">Min Temperature: </p>
		<p class="precip">Precipitation: </p>
		<p class="humidity">Humidity: </p>
		<p class="wind">Wind Speed: </p>
	</div>
	<div id="forecastDay1">
		<h2 class="date">Day 2 - </h2>
		<p class="avgTemp">Average Temperature: </p>
		<p class="maxTemp">Max Temperature: </p>
		<p class="minTemp">Min Temperature: </p>
		<p class="precip">Precipitation: </p>
		<p class="humidity">Humidity: </p>
		<p class="wind">Wind Speed: </p>
	</div>
	<div id="forecastDay2">
		<h2 class="date">Day 3 - </h2>
		<p class="avgTemp">Average Temperature: </p>
		<p class="maxTemp">Max Temperature: </p>
		<p class="minTemp">Min Temperature: </p>
		<p class="precip">Precipitation: </p>
		<p class="humidity">Humidity: </p>
		<p class="wind">Wind Speed: </p>
	</div>
	<div id="forecastDay3">
		<h2 class="date">Day 4 - </h2>
		<p class="avgTemp">Average Temperature: </p>
		<p class="maxTemp">Max Temperature: </p>
		<p class="minTemp">Min Temperature: </p>
		<p class="precip">Precipitation: </p>
		<p class="humidity">Humidity: </p>
		<p class="wind">Wind Speed: </p>
	</div>
	<div id="forecastDay4">
		<h2 class="date">Day 5 - </h2>
		<p class="avgTemp">Average Temperature: </p>
		<p class="maxTemp">Max Temperature: </p>
		<p class="minTemp">Min Temperature: </p>
		<p class="precip">Precipitation: </p>
		<p class="humidity">Humidity: </p>
		<p class="wind">Wind Speed: </p>
	</div>
</form>
</body>
</html>