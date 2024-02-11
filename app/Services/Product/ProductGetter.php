<?php

namespace App\Services\Product;

use App\Models\Product;

class ProductGetter
{
    public function getProduct($id)
    {
        return Product::find($id);
    }

    public function getProducts()
    {
        return Product::all();
    }
}
