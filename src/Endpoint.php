<?php

namespace Alanaktion\Magento;

use Alanaktion\Magento\Traits\EndpointLookup;
use Alanaktion\Magento\Client;

abstract class Endpoint
{
    use EndpointLookup;

    /**
     * Client instance
     *
     * @var Client
     */
    protected $client;

    /**
     * Create an endpoint instance
     *
     * @param  Client $client
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
