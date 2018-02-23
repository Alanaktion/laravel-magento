<?php

namespace Alanaktion\Magento\Traits;

use Alanaktion\Magento\Client;
use Alanaktion\Magento\Exceptions\EndpointNotFoundException;

/**
 * Allows Magento\Client and its descendents to instantiate other endpoints
 */
trait EndpointLookup
{
    /**
     * Get endpoint instance relative to current position
     *
     * @param  string $name
     * @return object
     */
    public function __get(string $name) : object
    {
        $topLevel = $this instanceof Client;

        $name = ucfirst($name);

        // If top-level, enter the Endpoints namespace before searching
        if ($topLevel) {
            $name = 'Endpoints\\' . ucfirst($name);
        }

        if (!class_exists($name)) {
            $message = "The endpoint class $name cannot be found.";
            throw EndpointNotFoundException($message);
        }

        if ($topLevel) {
            $client = $this;
        } else {
            $client = $this->client;
        }

        return new $name($client);
    }
}
