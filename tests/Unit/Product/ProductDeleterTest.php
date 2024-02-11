<?php

namespace Tests\Unit\Product;

use App\Models\Product;
use App\Services\Product\ProductDeleter;
use Tests\TestCase;

class ProductDeleterTest extends TestCase
{
    protected $productService;

    public function setUp(): void
    {
        parent::setUp();
        $this->productService = new ProductDeleter();
    }

    public function testDeleteProduct()
    {
        $product = Product::factory()->create();

        $this->productService->deleteProduct($product);

        $this->assertSoftDeleted('products', ['id' => $product->id]);
    }
}
