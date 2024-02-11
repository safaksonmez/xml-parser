<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class XmlController extends Controller
{
    public function mock1()
    {
        $path = storage_path('app/public/mock1.xml');
        $content = Storage::get('public/mock1.xml');
        return response($content, 200)->header('Content-Type', 'application/xml');
    }

    public function mock2()
    {
        $path = storage_path('app/public/mock2.xml');
        $content = Storage::get('public/mock2.xml');
        return response($content, 200)->header('Content-Type', 'application/xml');
    }
}
