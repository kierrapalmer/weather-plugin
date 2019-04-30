<?php
	/**
	Plugin Name: Weather Forecast
	description: Display a 5-day Forecast for a specified location
	Version: 1.0
	Author: Kierra Palmer
	License: GPLv2 or later
	 * Converted initial program to wordpress theme and plugin
	 */


	function get_weather_forecast(){
		$url = 'http://api.apixu.com/v1';
		$authToken = 'e690024b3b2b4122bcb140627192704';

		if(isset($_POST['location']))
			$location = $_POST['location'];
		else
			$location = 'New York City';
		$forecast = curl_init($url . '/forecast.json?key=' . $authToken . '&q=' . $location . '&days=5');
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

		// Decode and return the response
		return json_decode($responseForecast, TRUE);
	}

	function format_date($date){
		$newDate=date_create($date);
		return date_format($newDate,"m/d");
	}

	add_shortcode( "get_forecast", "print_layout" );



	function print_layout(){
		$responseData= get_weather_forecast();

		echo $responseData;
		echo '<div id="currentWeather" class="card">';
			echo '<div class="card-header">';
				echo '<form action="#" method="post" id="zipForm">';
					echo '<input type="text" name="location" id="location" value="';
					echo $responseData['location']['name'] . ', ' . $responseData['location']['region'] . '">';
					echo '<input type="submit">';
				echo '</form>';

				echo '<img src="';
				echo $responseData['current']['condition']['icon'] . '" alt="condition icon">';

				echo'<h1 class="currentTemp">';
				echo $responseData["current"]["temp_f"] . '&deg; </h1>';

				echo '<h3 class="conditionText">';
				echo $responseData['current']['condition']['text'] . '</h3>	';

				echo '<p>H ';
				echo $responseData['forecast']['forecastday'][0]['day']['maxtemp_f'] . '&deg; L ';
				echo $responseData['forecast']['forecastday'][0]['day']['mintemp_f'] . '&deg; </p>';

				echo '<p class="humidity"> Humidity: ';
				echo $responseData['current']['humidity'] . '&percnt; </p>';

				echo '<p class="wind">Wind: ';
				echo $responseData['current']['wind_mph'] . ' mph ';
				echo $responseData['current']['wind_dir'] . '</p>';
			echo '</div>';    //end of card-header div


		//loop through next 4 days
		echo '<table>';
		for($day=1; $day<5; $day++){
			echo '<tr class="forecastRow" >' ;
				echo '<td class="date">';
				echo format_date($responseData['forecast']['forecastday'][$day]['date']) . '</td>';

				echo '<td> <img src="';
				echo $responseData['forecast']['forecastday'][$day]['day']['condition']['icon'] . '" class="forecastIcon" alt="forecast icon"> </td>';

				echo '<td><i class="fas fa-tint"></i>';
				echo $responseData['forecast']['forecastday'][$day]['day']['avghumidity'] . '&percnt; </td>';

				echo'<td class="temp">';
				echo $responseData['forecast']['forecastday'][$day]['day']['mintemp_f'] . '&deg; /';
				echo $responseData['forecast']['forecastday'][$day]['day']['maxtemp_f'] . '&deg; </td>';
			echo '</tr>';
		}
		echo '</table>';
		echo '</div>';
	}



