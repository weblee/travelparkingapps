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
    private $client;

    /**
     * @var string
     */
    private $results;

    /**
     * @var
     */
    private $requestHeaders;

    /**
     * @var
     */
    private $responseHeaders;

    /**
     * @var
     */
    private $lastRequest;

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
     * Send Soap Request
     *
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
            $this->responseHeaders = $this->client->__getLastResponseHeaders();
            $this->requestHeaders = $this->client->__getLastRequestHeaders();
            $this->lastRequest = $this->client->__getLastRequest();
            return true;
        } catch (\SoapFault $exception) {
            $this->errors = $exception;
            return false;
        }
    }

    /**
     * Build Soap Service
     *
     * @param $service
     */
    private function buildSoapService($service)
    {
        $wsdl = "{$this->wsdl}/api/v3/{$service}.svc?wsdl";
        $this->client = new \SoapClient($wsdl, ['trace' => 1]);
        $headers = new \SoapHeader($this->nameSpace, 'ApiKey', $this->apikey);
        $this->client->__setSoapHeaders($headers);
    }

    /**
     * Soap Results
     *
     * @return string
     */
    public function results()
    {
        return $this->results;
    }

    /**
     * Soap Request Headers
     *
     * @return mixed
     */
    public function requestHeaders()
    {
        return $this->requestHeaders;
    }

    /**
     * Soap Response Headers
     *
     * @return mixed
     */
    public function responseHeaders()
    {
        return $this->requestHeaders;
    }

    /**
     * Soap Last Request
     *
     * @return mixed
     */
    public function lastRequest()
    {
        return $this->lastRequest;
    }

    /**
     * Soap Errors
     *
     * @return string
     */
    public function errors()
    {
        return $this->errors;
    }
} 