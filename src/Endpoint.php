<?php

namespace Alanaktion\Magento;

use Alanaktion\Magento\Traits\EndpointLookup;

abstract class Endpoint
{
    use EndpointLookup;

    /**
     * Client instance
     *
     * @var Alanaktion\Magento\Client
     */
    protected $client;
}
