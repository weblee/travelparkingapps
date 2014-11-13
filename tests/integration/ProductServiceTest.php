<?php
require_once realpath(dirname(__FILE__)) . '/../TestHelper.php';

use TravelParkingApps\Client;

class ProductServiceTest  extends \PHPUnit_Framework_TestCase
{
    protected $soapClient;

    protected function setUp()
    {
        $this->soapClient = new Client(API_KEY, WSDL);
    }

    /**
     * @test
     */
    public function it_finds_all_product_at_a_given_airport()
    {
        $params = [
            'product'       => '',
            'airportCode'   => 'ABZ'
        ];

        $this->soapClient->request('ProductService', 'FindAirportParkingProducts', $params);
        $results = $this->soapClient->results();

        $this->assertNotEmpty($results);
        $this->assertTrue(is_array($results->FindAirportParkingProductsResult->ProductDTO));
    }

    protected function tearDown()
    {
        unset($this->soapClient);
    }
} 