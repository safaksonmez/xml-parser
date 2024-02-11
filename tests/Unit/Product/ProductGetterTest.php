<?php

namespace Tests\Unit\Product;

use App\Models\Product;

use App\Services\Product\ProductGetter;
use Tests\TestCase;

class ProductGetterTest extends TestCase
{
    protected $productService;

    public function setUp(): void
    {
        parent::setUp();
        $this->productService = new ProductGetter();
    }

    public function testGetProduct()
    {
        $product = Product::factory()->create();

        $retrievedProduct = $this->productService->getProduct($product->id);

        $this->assertEquals($product->id, $retrievedProduct->id);
    }
}
