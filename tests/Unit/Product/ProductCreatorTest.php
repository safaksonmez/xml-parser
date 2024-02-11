<?php

namespace Tests\Unit\Product;

use App\Models\Product;
use App\Services\Product\ProductCreator;
use Tests\TestCase;

class ProductCreatorTest extends TestCase
{
    protected $productService;

    public function setUp(): void
    {
        parent::setUp();
        $this->productService = new ProductCreator();
    }

    public function testCreateProduct()
    {
        $data = [
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'price' => 10.99,
            'quantity' => 100,
            'photo_url' => 'http://example.com/product.jpg',
        ];

        $product = $this->productService->createProduct($data);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals($data['name'], $product->name);
        $this->assertEquals($data['description'], $product->description);
        $this->assertEquals($data['price'], $product->price);
        $this->assertEquals($data['quantity'], $product->quantity);
        $this->assertEquals($data['photo_url'], $product->photo_url);
    }
}
