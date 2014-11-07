<?php

define('API_KEY', 'api-key');
define('WSDL', 'http://dev.travelparkingapps.com/api');

function print_results($results)
{
    file_put_contents('data.txt', print_r($results, true));
}