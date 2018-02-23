<?php

namespace Alanaktion\Magento\Traits;

use Alanaktion\Magento\Client;
use Alanaktion\Magento\Exceptions\EndpointNotFoundException;

/**
 * Allows Client and Endpoint instances to instantiate other endpoints
 */
trait EndpointLookup
{
    protected $instances = [];

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
        if ($topLevel) {
            $name = 'Endpoint\\' . $name;
            $namespace = preg_replace('/\\\\[0-9a-z]+$/i', '', get_class($this));
        } else {
            $namespace = get_class($this);
        }
        $name = '\\' . $namespace . '\\' . $name;

        if (array_key_exists($name, $this->instances)) {
            return $this->instances[$name];
        }

        if (!class_exists($name)) {
            $message = "The endpoint class $name cannot be found.";
            throw new EndpointNotFoundException($message);
        }

        if ($topLevel) {
            $client = $this;
        } else {
            $client = $this->client;
        }

        return $this->instances[$name] = new $name($client);
    }
}
