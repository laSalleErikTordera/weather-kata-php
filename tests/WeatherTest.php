<?php

namespace Tests\Codium\CleanCode;

use Codium\CleanCode\CityPredictions;
use Codium\CleanCode\City;
use PHPUnit\Framework\TestCase;

class WeatherTest extends TestCase
{
    private const TEST_WOEID = "766273";

    // https://www.metaweather.com/api/location/766273/
    /** @test */
    public function find_the_weather_of_today()
    {
        $forecast = new CityPredictions();
        $city = new City("Madrid", true);

        $prediction = $forecast->PredictForCity($city, null);

        echo "Today: $prediction\n";
        $this->assertTrue(true, 'I don\'t know how to test it');
    }

    /** @test */
    public function find_the_weather_of_any_day()
    {
        $forecast = new CityPredictions();
        $city = new City("Madrid", false);

        $prediction = $forecast->PredictForCity($city, new \DateTime('+2 days'));

        echo "Day after tomorrow: $prediction\n";
        $this->assertTrue(true, 'I don\'t know how to test it');
    }

    /** @test */
    public function find_the_wind_of_any_day()
    {
        $forecast = new CityPredictions();
        $city = new City("Madrid", true);

        $prediction = $forecast->PredictForCity($city, null);

        echo "Wind: $prediction\n";
        $this->assertTrue(true, 'I don\'t know how to test it');
    }

    /** @test */
    public function change_the_city_to_woeid()
    {
        $forecast = new CityPredictions();
        $city = new City("Madrid", true);

        $forecast->PredictForCity($city, null);

        $this->assertEquals(self::TEST_WOEID, $city->GetId());
    }

    /** @test */
    public function there_is_no_prediction_for_more_than_5_days()
    {
        $forecast = new CityPredictions();
        $city = new City("Madrid", false);

        $prediction = $forecast->PredictForCity($city, new \DateTime('+6 days'));

        $this->assertEquals("", $prediction);
    }
}