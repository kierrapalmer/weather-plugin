<?php
	/**
	Plugin Name: Weather Forecast
	description: Display a 5-day Forecast for a specified location
	Version: 1.0
	Author: Kierra Palmer
	License: GPLv2 or later
	 * Converted initial program to wordpress theme and plugin
	 */
	function get_weather_forecast($zip){
		$url = 'http://api.apixu.com/v1';
		$authToken = 'e690024b3b2b4122bcb140627192704';

		$forecast = curl_init($url . '/forecast.json?key=' . $authToken . '&q=' . $zip . '&days=5');
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
	function get_weather( $atts) {
		$atts = shortcode_atts( array(
			'zip'  => '0',
			'day'   => null,
			'measurement' => ''
		), $atts, 'weather_forecast' );

		//Error checking
		if($atts['zip'] == '0'){
			die("No Zip entered");
		}else if($atts['measurement'] == ''){
			die("No measurement entered");
		}else if($atts['day'] == null){
			die("No day entered");
		}

		//Call API and get weather forecast
		$responseData = get_weather_forecast($atts['zip']);

		if($atts['day'] == 5)
			return $responseData['current'][$atts['measurement']];
		else
			return $responseData['forecast']['forecastday'][$atts['day']]['day'][$atts['measurement']];
	}

	function get_location($atts){
		$atts = shortcode_atts( array(
			'zip'  => '0',
		), $atts, 'forecast_location' );

		//Error checking
		if($atts['zip'] == '0'){
			die("No Zip entered");
		}

		//Call API and get weather forecast
		$responseData = get_weather_forecast($atts['zip']);

		return $responseData['location'][$atts['name']] . ', ' . $responseData['location'][$atts['region']];

	}

	add_shortcode( "weather_forecast", "get_weather" );
	add_shortcode( "forecast_location", "get_location" );


	//		$zip = $_POST['zip'];


?>

