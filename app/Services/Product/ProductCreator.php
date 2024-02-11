<?php

namespace App\Services\Product;

use App\Models\Product;

class ProductCreator
{
    public function createOrUpdateProductFromXml($productXml)
    {
        return Product::fromXml($productXml);
    }

    public function createProduct(array $data)
    {
        return Product::create($data);
    }
}
