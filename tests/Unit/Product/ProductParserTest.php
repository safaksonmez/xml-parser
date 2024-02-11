<?php

namespace Tests\Unit\Product;

use App\Models\Product;
use App\Services\Product\ProductCreator;
use Tests\TestCase;

class ProductParserTest extends TestCase
{
    protected $productService;

    public function setUp(): void
    {
        parent::setUp();
        $this->productService = new ProductCreator();
    }

    public function testParseProduct()
    {
        $xmlString = simplexml_load_string('
        <product>
            <id>1</id>
            <name>Test Product</name>
            <description>This is a test product</description>
            <price>10.99</price>
            <quantity>20</quantity>
            <photo_url>http://example.com/product.jpg</photo_url>
        </product>
    ');
        $product = $this->productService->createOrUpdateProductFromXml($xmlString);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals(1, $product->id);
        $this->assertEquals('Test Product', $product->name);
        $this->assertEquals('This is a test product', $product->description);
        $this->assertEquals(10.99, $product->price);
        $this->assertEquals(20, $product->quantity);
        $this->assertEquals('http://example.com/product.jpg', $product->photo_url);
    }
}
