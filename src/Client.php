<?php

namespace Alanaktion\Magento;

use Alanaktion\Magento\Traits\EndpointLookup;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7;

class Client
{
    use EndpointLookup;

    /**
     * API Scope
     *
     * @var string
     */
    protected $scope;

    /**
     * API Bearer Token
     *
     * @var string
     */
    protected $token;

    /**
     * API Base URL
     *
     * @var string
     */
    protected $baseUrl;

    /**
     * Create an instance of the API client
     * @param string $scope
     * @param string $token
     * @param string $baseUrl
     * @throws \Exception
     */
    public function __construct(
        string $scope = 'default',
        ?string $token = null,
        ?string $baseUrl = null
    ) {
        $this->scope = $scope;
        if ($token !== null) {
            $this->token = $token;
        } else {
            $this->token = config('magento.integration_token');
        }
        if ($baseUrl !== null) {
            $this->baseUrl = rtrim($baseUrl, '/');
        } elseif (config('magento.base_url')) {
            $this->baseUrl = rtrim(config('magento.base_url'), '/');
        } else {
            throw new \Exception("Magento base URL not specified.");
        }
    }

    /**
     * Get the bearer token used for this API client instance
     *
     * @return string|null
     */
    public function getToken() : ?string
    {
        return $this->token;
    }

    /**
     * Get the base URL used for this API client instance
     *
     * @return string
     */
    public function getBaseUrl() : string
    {
        return $this->baseUrl;
    }

    /**
     * Perform a GET request on the API
     *
     * @param  string $path
     * @return mixed
     * @throws MagentoErrorException
     */
    public function get(string $path)
    {
        $client = new HttpClient();
        $url = "$this->baseUrl/rest/$this->scope/" . ltrim($path, '/');
        $options = [
            'headers' => [
                'Accept' => 'application/json',
            ]
        ];
        if ($this->token) {
            $options['headers']['Authorization'] = "Bearer $this->token";
        }

        $response = $client->request('GET', $url, $options);
        $body = $response->getBody();
        $contentType = Psr7\parse_header($response->getHeader('Content-Type'));
        if ($contentType[0][0] == 'application/json') {
            return json_decode($body);
        }
        return $body;
    }
}
