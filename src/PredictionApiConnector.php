<?php 

namespace Codium\CleanCode; 
use Codium\CleanCode\City; 

interface PredictionApiConnector
{
    function Predict(City $city, \Datetime $target_date): string;
    function PredictWithWind(City $city, \Datetime $target_date): string;
    function PredictWithoutWind(City $city, \Datetime $target_date): string;
}