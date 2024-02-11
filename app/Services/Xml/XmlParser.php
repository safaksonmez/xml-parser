<?php

namespace App\Services\Xml;

class XmlParser
{
    public function parse($xmlString)
    {
        return simplexml_load_string($xmlString);
    }
}
