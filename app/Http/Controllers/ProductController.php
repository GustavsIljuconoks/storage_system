<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Laravel\Sanctum\PersonalAccessToken;

class ProductController extends Controller
{
    public function getProducts(): JsonResponse
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        $productInfo = array();

        foreach ($products as $product) {
            $info = array(
                'product_id' => $product->product_id,
                'name' => $product->name,
                'quantity_in_stock' => $product->quantity_in_stock,
            );

            $category = ProductCategory::find($product->category_id);
            $info['category'] = $category ? $category->name : null;

            array_push($productInfo, $info);
        }

        return response()->json($productInfo, 200);
    }

    public function addProduct(Request $request): JsonResponse
    {
        $validatedData = $this->validate(request(), [
            'name' => 'required | max:45',
            'quantity_in_stock' => 'required | max:255',
            'category_id' => 'required',
        ]);

        $postData = $request->post();
        if ($postData === null) {
            return response()->json("Invalid JSON data.", 400);
        }

        // Get request data
        $product = new Product();
        $product->name = $validatedData['name'];
        $product->quantity_in_stock = $validatedData['quantity_in_stock'];
        $product->category_id = $validatedData['category_id'];
        $product->save();

        return response()->json([
            "message" => "Product added"
        ], 200);
    }

    public function updateProduct(Request $request, $id): JsonResponse
    {
        // $productId = $request->productId;
        $userRoleId = $request->userRoleId;

        if ($userRoleId === 1 || $userRoleId === 2) {
            if (Product::where('product_id', $id)->exists()) {
                $product = Product::find($id);

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
        $userRoleId = $request->userRoleId;

        if ($userRoleId === 1) {
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
        return response()->json([
            "message" => "Missing administrator privileges"
        ],404);
    }

    public function productDetails(Request $request, $id): JsonResponse
    {
        $product = Product::find($id);

        if(!empty($product)) {
            return response()->json($product);
        }

        return response()->json([
            "message" => "Product not found"
        ],404);
    }
}
