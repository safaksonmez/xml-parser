<?php

namespace App\Http\Controllers;

use App\Services\Product\ProductCreator;
use App\Services\Product\ProductDeleter;
use App\Services\Product\ProductGetter;
use App\Services\Product\ProductUpdater;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, ProductGetter $productService)
    {
        $products = $productService->getProducts();

        return response()->json($products);
    }
    public function store(Request $request, ProductCreator $productService)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'photo_url' => 'required|url',
        ]);

        $product = $productService->createProduct($request->all());

        return response()->json($product, 201);
    }

    public function show($id, ProductGetter $productService)
    {
        $product = $productService->getProduct($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    public function destroy($id, ProductDeleter $productService)
    {
        $productService->deleteProduct($id);

        return response()->json(null, 204);
    }

    public function update(Request $request, $id, ProductUpdater $productService)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'photo_url' => 'required|url',
        ]);

        $product = $productService->updateProduct($id, $request->all());

        return response()->json($product);
    }
}
