<?php

namespace App\Services\Xml;

use Illuminate\Support\Facades\Storage;

class XmlGetter
{
    public function getXml(string $path)
    {
        $content = Storage::get($path);
        return $content;
    }
}
