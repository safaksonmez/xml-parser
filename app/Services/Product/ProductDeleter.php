<?php

namespace App\Services\Product;

use App\Models\Product;

class ProductDeleter
{
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return;
        }
        return $product->each->delete();
    }
}
