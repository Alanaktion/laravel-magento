<?php

namespace Alanaktion\Magento\Endpoint\Catalog;

use Alanaktion\Magento\Endpoint;
use Alanaktion\Magento\Instance\Product as ProductInstance;

class Product extends Endpoint
{
    /**
     * Search products
     *
     * GET /V1/products
     *
     * @param  array  $searchCriteria
     * @return array
     */
    public function search(array $searchCriteria)
    {
        $path = "/V1/products";
        $path .= '?' . http_build_query([
            'searchCriteria' => $searchCriteria,
        ]);
        $body = $this->client->get($path);
        return $body;
    }
}
