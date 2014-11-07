<?php

use TravelParkingApps\Client;

class TravelParkingAppsExceptionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException InvalidArgumentException
     * @test
     */
    public function it_throws_invalid_argument_exception()
    {
        (new Client(''));
    }
} 