<?php namespace TravelParkingApps;

class Client
{
    private $nameSpace = 'https://www.travelparkingapps.com/api/v3';

    private $wsdl = 'http://dev.travelparkingapps.com';

    private $apikey = '';

    private $client = '';

    private $results = '';

    private $errors = '';

    function __construct($apikey, $wsdl = '')
    {
        if (empty($apikey))
        {
            throw new \InvalidArgumentException('Invalid API Key');
        }
        $this->apikey = $apikey;
        $this->wsdl = $wsdl;
    }

    public function request($service, $action, $params = [])
    {
        $this->buildSoapService($service);

        try {
            $this->results = $this->client->$action($params);
            return true;
        } catch (SoapFault $exception) {
            $this->errors = $exception;
        }
    }

    private function buildSoapService($service)
    {
        $wsdl = "{$this->wsdl}/api/v3/{$service}.svc?wsdl";
        $this->client = new \SoapClient($wsdl);
        $headers = new \SoapHeader($this->nameSpace, 'ApiKey', $this->apikey);
        $this->client->__setSoapHeaders($headers);
    }

    public function results()
    {
        return $this->results;
    }

    public function errors()
    {
        return $this->errors;
    }
} 