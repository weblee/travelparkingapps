<?php namespace TravelParkingApps;

/**
 * Class Client
 * @package TravelParkingApps
 */
class Client
{
    /**
     * @var string
     */
    private $nameSpace = 'https://www.travelparkingapps.com/api/v3';

    /**
     * @var string
     */
    private $wsdl = 'http://dev.travelparkingapps.com';

    /**
     * @var string
     */
    private $apikey = '';

    /**
     * @var string
     */
    private $client = '';

    /**
     * @var string
     */
    private $results = '';

    /**
     * @var string
     */
    private $errors = '';

    /**
     * @param $apikey
     * @param string $wsdl
     */
    function __construct($apikey, $wsdl = '')
    {
        if (empty($apikey))
        {
            throw new \InvalidArgumentException('Invalid API Key');
        }
        $this->apikey = $apikey;
        $this->wsdl = $wsdl;
    }

    /**
     * @param $service
     * @param $action
     * @param array $params
     * @return bool
     */
    public function request($service, $action, $params = [])
    {
        $this->buildSoapService($service);

        try {
            $this->results = $this->client->$action($params);
            return true;
        } catch (\SoapFault $exception) {
            $this->errors = $exception;
            return false;
        }
    }

    /**
     * @param $service
     */
    private function buildSoapService($service)
    {
        $wsdl = "{$this->wsdl}/api/v3/{$service}.svc?wsdl";
        $this->client = new \SoapClient($wsdl);
        $headers = new \SoapHeader($this->nameSpace, 'ApiKey', $this->apikey);
        $this->client->__setSoapHeaders($headers);
    }

    /**
     * @return string
     */
    public function results()
    {
        return $this->results;
    }

    /**
     * @return string
     */
    public function errors()
    {
        return $this->errors;
    }
} 