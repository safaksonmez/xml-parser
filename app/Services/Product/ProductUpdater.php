<?php

namespace App\Services\Product;

use App\Models\Product;

class ProductUpdater
{
    public function updateProduct($id, array $data)
    {
        $product = Product::find($id);
        return $product->update($data);
    }
}
