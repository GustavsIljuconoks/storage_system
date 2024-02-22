<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function getProducts(): JsonResponse
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return response()->json($products, 200);
    }

    public function updateProduct(Request $request): JsonResponse
    {
        $productId = $request->productId;
        $userRoleId = $request->userRoleId;

        if ($userRoleId === 1) {
            if (Product::where('product_id', $productId)->exists()) {
                $product = Product::find($productId);

                $product->update($request->all());

                if ($request->has('name')) {
                    $product->name = $request->name;
                }

                if ($request->has('quantity_in_stock')) {
                    $product->quantity_in_stock = $request->quantity_in_stock;
                }

                if ($request->has('category_id')) {
                    $product->category_id = $request->category_id;
                }

                return response()->json([
                    "data" => $product,
                    "message" => "Product updated successfully"
                ], 200);
            }
            return response()->json([
                "message" => "No product found"
            ],404);
        }

        return response()->json([
            "message" => "Missing administrator privileges"
        ],404);
    }

    public function deleteProduct(Request $request): JsonResponse
    {
        $productId = $request->productId;

        if(Product::where('product_id', $productId)->exists()) {
            $product = Product::find($productId);
            $product->delete();

            return response()->json([
                "success" => "Product deleted successfully"
            ],200);
        }

        return response()->json([
            "message" => "Product not found"
        ],404);
    }
}
