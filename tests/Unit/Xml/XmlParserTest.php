<?php

namespace Tests\Unit\Xml;

use App\Services\Xml\XmlParser;
use Tests\TestCase;

class XmlParserTest extends TestCase
{
    protected $xmlService;

    public function setUp(): void
    {
        parent::setUp();
        $this->xmlService = new XmlParser();
    }

    public function testParseProduct()
    {
        $xmlString = '
        <product>
            <id>1</id>
            <name>Test Product</name>
            <description>This is a test product</description>
            <price>10.99</price>
            <quantity>20</quantity>
            <photo_url>http://example.com/product.jpg</photo_url>
        </product>
        ';
        $xml = $this->xmlService->parse($xmlString);

        $this->assertInstanceOf(\SimpleXMLElement::class, $xml);
        $this->assertEquals(1, (int) $xml->id);
        $this->assertEquals('Test Product', (string) $xml->name);
    }
}
