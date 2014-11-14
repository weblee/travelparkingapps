<?php
require_once realpath(dirname(__FILE__)) . '/../TestHelper.php';

use TravelParkingApps\Client;

class AirportParkingServiceTest extends \PHPUnit_Framework_TestCase {

    protected $soapClient;

    protected function setUp()
    {
        $this->soapClient = new Client(API_KEY, WSDL);
    }

    /**
     * @test
     */
    public function it_checks_for_search_availability_and_receives_multiple_quotes()
    {
        $params = $this->search_params('LHR', '+1 day', '+5 day');
        $this->soapClient->request('AirportParkingService', 'SearchAvailability', $params);
        $results = $this->soapClient->results();

        $this->assertNotEmpty($results);
        $this->assertTrue(is_array($results->SearchAvailabilityResult->Availability->QuoteAvailabilityItemDTO));
        $this->assertNotEmpty($results->SearchAvailabilityResult->Id); // The Uuid
    }

    /**
     * @test
     */
    public function it_checks_for_search_availability_and_receives_one_quote()
    {
        $params = $this->search_params('ABZ', '+1 day', '+5 day');
        $this->soapClient->request('AirportParkingService', 'SearchAvailability', $params);
        $results = $this->soapClient->results();

        $this->assertNotEmpty($results);
        $this->assertFalse(is_array($results->SearchAvailabilityResult->Availability->QuoteAvailabilityItemDTO));
        $this->assertNotEmpty($results->SearchAvailabilityResult->Id); // The Uuid
    }

    protected function tearDown()
    {
        unset($this->soapClient);
    }

    /**
     * Set Search Params
     *
     * @param string $airportCode
     * @param $fromDate
     * @param $toDate
     * @return array
     */
    private function search_params( $airportCode = 'LHR', $fromDate, $toDate )
    {
        return [
            "itinerary" => [
                "Airport" => [
                    "Code" => $airportCode
                ],
                "Dates" => [
                    "From" => [
                        "Date" => date('d/m/Y', strtotime($fromDate)),
                        "Time" => "12:00"
                    ],
                    "To" => [
                        "Date" => date('d/m/Y', strtotime($toDate)),
                        "Time" => "12:00"
                    ]
                ]
            ]
        ];
    }
} 