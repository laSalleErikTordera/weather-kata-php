<?php

namespace Codium\CleanCode;

use Codium\CleanCode\PredictionApiConnector; 
use Codium\CleanCode\City;
use GuzzleHttp\Client;

class MetaweatherApiConnector implements PredictionApiConnector
{
    private $base_url;
    private $client;

    function __construct()
    {
        $this->base_url = "https://www.metaweather.com/api/location";
        $this->client = new Client(); 
    }

    public function Predict(City $city, \Datetime $target_date): string
    {
        $cityId = $this->GetCityId($city->GetName());
        $results = $this->GetResults($cityId, $city->GetWindOption());

        foreach ($results as $result) {

            // When the date is the expected
            if ($result["applicable_date"] == $target_date->format('Y-m-d')) {
                // If we have to return the wind information
                return ($city->GetWindOption()) 
                     ? $this->GetWindSpeed($result) 
                     : $this->GetWeatherStateName($result); //MODIFIED
            }
        }
    }

    public function PredictWithWind(City $city, \Datetime $target_date): string
    {
        return $this->Predict($city, $target_date, true);
    }

    public function PredictWithoutWind(City $city, \Datetime $target_date): string
    {
        return $this->Predict($city, $target_date, false);
    }









    public function GetCityId(string $cityName): string
    {
        $CityId = json_decode(
            $this->client->get($this->base_url . "/search/?query=$cityName")->getBody()->getContents(),
            true
        )[0]['woeid'];

        return $CityId;
    }


    private function GetResults(string $city): array
    {
        $results = json_decode(
            $this->client->get($this->base_url . "/$city")->getBody()->getContents(),
            true
        )['consolidated_weather'];

        return $results;
    }


    private function GetWindSpeed(array $result) {
        return $result['wind_speed'];
    }


    private function GetWeatherStateName(array $result) {
        return $result['weather_state_name'];
    }
}

?>