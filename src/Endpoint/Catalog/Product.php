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
     * @param  string $scope
     * @param  array  $searchCriteria
     * @return array
     */
    public function search(string $scope, array $searchCriteria)
    {
        $path = "$scope/V1/products";
        $this->client->get('products');
    }
}
