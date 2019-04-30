<?php
	/*
	Template Name: Page With Forecast
	*/
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Weather</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
	      integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

	<style>
		:root {
			--accent: #008080; /*rgb(0,128,128)*/
			--darkAccent: #006767; /*rgb(0,103,103)*/
		}

		body {
			text-transform: uppercase;
			font-family: cursive, sans-serif !important;
			line-height: .9em;
			font-size: .9em !important;
		}

		table{
			font-family: cursive, sans-serif !important;
		}
		.card {
			margin: 10px;
			border: 1px solid grey;
			width: 35%;
			text-align: center;
		}
		/*Overrides user style sheet*/
		.card p{
			margin-block-start: 0;
			margin-block-end: 0;

		}
		.card h3{
			margin: 10px;
		}
		.card-header {
			background-color: var(--accent);
			color: white;
			font-weight: bold;
			padding-bottom: 5px;
		}

		.card-body {
			padding: 10px;
		}

		.currentWeather {
			padding: 10px;
		}

		.forecastIcon {
			width: 50%;
		}

		.forecastRow td {
			width: 25%;
		}

		.forecastRow .temp {
			width: 30%;
		}

		#zipForm {
			width: 100%;
			background-color: var(--darkAccent);
			padding: 5px 0;
		}

		#location {
			width: 88%;
			background-color: var(--darkAccent);
			padding: 10px 3px;
			border: none;
			color: white;
			text-transform: uppercase;
			font-weight: bold;
			font-family: cursive, sans-serif !important;

		}

		#location:focus {
			outline: none;
		}

		#submitLocation {
			padding: 9px 5px;
			color: white;
			background-color: var(--darkAccent);;
			font-size: 1em;
			border: none; /* Prevent double borders */
		}

		.fa-tint {
			color: midnightblue;
		}

		.forecastRow td{
			border: none !important;
			padding: 0px;
		}
	</style>

</head>
<body>
	<?php  get_header();?>
	<!--Prints out forecast module-->
	<?php echo do_shortcode("[get_forecast]"); ?>

</body>
</html>