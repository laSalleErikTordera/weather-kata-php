<?php

namespace Codium\CleanCode; 

use Codium\CleanCode\MetaweatherApiConnector;

class City {

    private $cityName;
    private $windOption;
   
    function __construct(string $cityName, bool $wind)
    {
        $this->cityName = $cityName;
        $this->windOption = $wind;
    }

    public function SetName(string $nName): void
    {
        $this->cityName = $nName; 
    }

    public function GetName(): string
    {
        return $this->cityName;
    }

    public function SetWindOption(bool $nWindOption): void
    {
        $this->windOption = $nWindOption; 
    }

    public function GetWindOption(): bool
    {
        return $this->windOption; 
    }

    public function GetId(): string
    {
        return (new MetaweatherApiConnector())->GetCityId($this->cityName);
    }
}

?>