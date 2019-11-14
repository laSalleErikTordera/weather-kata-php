<?php

namespace Codium\CleanCode;

use Codium\CleanCode\City;
use Codium\CleanCode\MetaweatherApiConnector;

class CityPredictions
{
    public function PredictForCity(&$city, \DateTime $datetime = null): string
    {
        $connector = new MetaweatherApiConnector();
         // When date is not provided we look for the current prediction
        if(!$datetime){
            $datetime = new \DateTime();
        }

        //MODIFIED
        if ($datetime >= new \DateTime("+6 days 00:00:00")) {
            return "";
        }

        return $connector->Predict($city, $datetime);
    }

    
}