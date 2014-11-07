<?php
require_once realpath(dirname(__FILE__)) . '/../TestHelper.php';

use TravelParkingApps\Client;

class AirportServiceTest extends \PHPUnit_Framework_TestCase
{
    protected $soapClient;

    protected function setUp()
    {
        $this->soapClient = new Client(API_KEY, WSDL);
    }

    /**
     * @test
     */
    public function it_retrieves_all_airports()
    {
        $this->soapClient->request('AirportService', 'All');
        $results = $this->soapClient->results();

        $this->assertNotEmpty($results);
        $this->assertTrue(is_array($results->AllResult->AirportDTO));
    }

    /**
     * @test
     */
    public function it_retrieves_all_airports_by_country()
    {
        $this->soapClient->request('AirportService', 'AllByCountry', ['countryCode' => 'GB']);
        $results = $this->soapClient->results();

        $this->assertNotEmpty($results);
        $this->assertTrue(is_array($results->AllByCountryResult->AirportDTO));
        $this->assertCount(27, $results->AllByCountryResult->AirportDTO);
    }

    /**
     * @test
     */
    public function it_retrieves_a_single_airport()
    {

        $this->soapClient->request('AirportService', 'Get', ['airportCode' => 'LHR']);
        $results = $this->soapClient->results();

        $this->assertNotEmpty($results);
        $this->assertEquals('LHR', $results->GetResult->Code);
        $this->assertEquals('GB', $results->GetResult->Country->Code);
        $this->assertEquals('heathrow', $results->GetResult->Url);
    }

    protected function tearDown()
    {
        unset($this->soapClient);
    }
} 