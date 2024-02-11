<?php

namespace Tests\Unit\Product;

use App\Models\Product;

use App\Services\Product\ProductUpdater;
use Tests\TestCase;

class ProductUpdaterTest extends TestCase
{
    protected $productService;

    public function setUp(): void
    {
        parent::setUp();
        $this->productService = new ProductUpdater();
    }

    public function testUpdateProduct()
    {
        $product = Product::factory()->create();

        $name = 'New Name';
        $price = 100;
        $description = 'New Description';
        $data = [
            'name' => $name,
            'price' => $price,
            'description' => $description,
        ];
        $this->productService->updateProduct($product->id, $data);
        $product = Product::find($product->id);
        $this->assertEquals($name, $product->name);
    }
}
