<?php

namespace App\Http\Controllers;

use App\Services\Xml\XmlGetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Util\Xml;

class XmlController extends Controller
{
    public function mock1(XmlGetter $xmlGetter)
    {
        $path = storage_path('app/public/mock1.xml');
        $xmlFile = $xmlGetter->getXml($path);
        return response($xmlFile, 200)->header('Content-Type', 'application/xml');
    }

    public function mock2(XmlGetter $xmlGetter)
    {
        $path = storage_path('app/public/mock2.xml');
        $xmlFile = $xmlGetter->getXml($path);
        return response($xmlFile, 200)->header('Content-Type', 'application/xml');
    }
}
