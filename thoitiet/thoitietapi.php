<?php
	include "WeatherCode.php";


	$url = "http://api.worldweatheronline.com/premium/v1/weather.ashx";
	$key = "2c857aa5b9de47eab02124811191611";

	function callApi($url, $data) {
		$curl = curl_init();

		$params = '';
		foreach($data as $key=>$value) {
		    $params .= $key.'='.$value.'&';
		}
		         
		$params = trim($params, '&');

		curl_setopt($curl, CURLOPT_URL, $url.'?'.$params ); //Url together with parameters
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HEADER, 0);

		$result = curl_exec($curl);
		curl_close($curl);

	   	if(!$result){
	   		die("Connection Failure");
	   	}
	   	return $result;
	}

	$data = array(
		"key" => $key,
		"q" => 'Ho+Chi+Minh,viet+nam',
		"format" => "json"
	);

	$result = callApi($url, $data);

	$weatherData = json_decode($result);
	
	$weatherData = $weatherData->data;

	$responseData = [];

	$weatherCode = $weatherData->current_condition[0]->weatherCode;


	$responseData['description'] = $codeString[$weatherCode];

	$responseData['temp_C'] = $weatherData->current_condition[0]->temp_C;

	$responseData['image'] = $weatherData->current_condition[0]->weatherIconUrl[0]->value;

	$responseData['windSpeedKmph'] = $weatherData->current_condition[0]->windspeedKmph;

	$responseData['humidity'] = $weatherData->current_condition[0]->humidity;
	$responseData['precipMM'] = $weatherData->current_condition[0]->precipMM;

	$responseData['date'] = $weatherData->weather[0]->date;

	$responseData['maxtempC'] = $weatherData->weather[0]->maxtempC;
	$responseData['mintempC'] = $weatherData->weather[0]->mintempC;

	var_dump($responseData);
?>