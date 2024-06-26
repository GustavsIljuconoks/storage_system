<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderLogs;
use App\Models\Product;
use App\Models\User;
use App\Models\ProductCategory;
use App\Models\Manufacturers;
use App\Models\OrderStates;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function makeOrder(Request $request): JsonResponse
    {
        $validatedData = $this->validate(request(), [
            'count' => 'required | max:255 | not_in:0',
            'manufactureId' => 'required | max:255 | not_in:0',
            'productId' => 'required | max:255 | not_in:0',
        ]);

        $userId = $request->userId;
        $manufactureId = $request->manufactureId;
        $productId = $request->productId;

        $userRoleId = User::where("user_id", $userId)->get(['role_id']);

        if ($userRoleId !== 3 && $manufactureId !== null) {

            if (Product::where('product_id', $productId)->exists()) {

                $order = Order::create([
                    "status_id" => 1,
                    "user_id" => $userId,
                    "manufacturer_id" => $validatedData['manufactureId'],
                    "product_id" => $validatedData['productId'],
                    "product_count" => $validatedData['count'],
                    "created_date" => now(),
                ]);

                $orderId = $order->order_id;

                $newOrder = new OrderLogs();
                $newOrder->order_id = $orderId;
                $newOrder->user_id = $userId;
                $newOrder->action = 'Created';
                $newOrder->created_at = now();
                $newOrder->updated_at = now();
                $newOrder->save();

                return response()->json([
                    "message" => "Order created successfully"
                ], 200);
            }
        }

        return response()->json([
            "message" => "No product found"
        ],404);
    }

    public function getCategories(): JsonResponse
    {
        $categories = ProductCategory::orderBy('created_at', 'desc')->get();
        return response()->json($categories, 200);
    }

    public function getProducts(Request $request): JsonResponse
    {
        $categoryId = $request->id;

        if (Product::where('category_id', $categoryId)->exists()) {
            $products = Product::where('category_id', $categoryId)->get();
            $productInfo = array();

            foreach ($products as $product) {
                $info = array(
                    'id' => $product->product_id,
                    'name' => $product->name,
                    'quantity_in_stock' => $product->quantity_in_stock,
                    'category_id' => $product->category_id,
                );

                array_push($productInfo, $info);
            }
            return response()->json($productInfo, 200);
        }

        return response()->json([
            "message" => "No product found"
        ],404);
    }

    public function getManufactures(Request $request): JsonResponse
    {
        $productId = $request->id;

        if (Manufacturers::where('product_id', $productId)->exists()) {
            $manufacturers = Manufacturers::where('product_id', $productId)->get();
            $manufacturerInfo = array();

            foreach ($manufacturers as $manufacture) {
                $info = array(
                    'id' => $manufacture->manafacturer_id,
                    'name' => $manufacture->name,
                );

                array_push($manufacturerInfo, $info);
            }
            return response()->json($manufacturerInfo, 200);
        }

        return response()->json([
            "message" => "No manufacturers found"
        ],404);
    }

    public function changeOrderStatus(Request $request): JsonResponse
    {
        $orderId = $request->orderId;

        if (Order::where('order_id', $orderId)->exists()) {
            $order = Order::find($orderId);

            $orderId = $order->order_id;

            $newOrder = new OrderLogs();
            $newOrder->order_id = $orderId;
            $newOrder->user_id = $request->userId;
            $newOrder->action = 'Updated';
            $newOrder->created_at = now();
            $newOrder->updated_at = now();
            $newOrder->save();

            $order->update([
                'status_id' => 3,
                'shipment_date' => now()
            ]);

            return response()->json([
                "message" => "Order updated successfully"
            ], 200);
        }

        return response()->json([
            "message" => "No order found"
        ],404);
    }

    public function deleteOrder(Request $request): JsonResponse
    {
        $orderId = $request->orderId;

        if(Order::where('order_id', $orderId)->exists()) {
            $order = Order::find($orderId);
            $statusId = $order->status_id;

            if ($statusId == 1) {

                $orderId = $order->order_id;

//                OrderLogs::create([
//                    'order_id' => $orderId,
//                    'user_id' => $request->userId,
//                    'action' => 'Deleted',
//                    'created_at' => now(),
//                    'updated_at' => now(),
//                ]);

//                $newOrder = new OrderLogs;
//                $newOrder->order_id = $orderId;
//                $newOrder->user_id = $request->userId;
//                $newOrder->action = 'Deleted';
//                $newOrder->created_at = now();
//                $newOrder->updated_at = now();
//                $newOrder->save();

                $order->children()->update(['order_id' => null]);
                $order->delete();

                return response()->json([
                    "success" => "Order deleted successfully"
                ],200);
            }
            return response()->json([
                "message" => "Order couldn't be deleted"
            ],404);
        }
        return response()->json([
            "message" => "Order not found"
        ],404);
    }

    public function getOrders(): JsonResponse
    {
        $orders = Order::orderBy('created_at', 'asc')->get();
        $orderInfo = array();

        foreach ($orders as $order) {
            $info = array(
                'id' => $order->order_id,
                'quantity' => $order->product_count,
            );

            $product = Product::find($order->product_id);
            $categoryId = $product->category_id;
            $productCategory = ProductCategory::find($categoryId);
            $orderState = OrderStates::find($order->status_id);

            $info['name'] = $product ? $product->name : null;
            $info['category'] = $productCategory ? $productCategory->name : null;
            $info['status'] = $orderState ? $orderState->name : null;

            array_push($orderInfo, $info);
        }

        return response()->json($orderInfo, 200);
    }

    public function getPendingOrders(): JsonResponse
    {
        $orders = Order::where('status_id', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        $orderInfo = array();

        foreach ($orders as $order) {
            $info = array(
                'id' => $order->order_id,
                'quantity' => $order->product_count,
            );

            $product = Product::find($order->product_id);
            $categoryId = $product->category_id;
            $productCategory = ProductCategory::find($categoryId);
            $orderState = OrderStates::find($order->status_id);

            $info['name'] = $product ? $product->name : null;
            $info['category'] = $productCategory ? $productCategory->name : null;
            $info['status'] = $orderState ? $orderState->name : null;

            array_push($orderInfo, $info);
        }

        return response()->json($orderInfo, 200);
    }

    public function getDeliveredOrders(): JsonResponse
    {
        $orders = Order::where('status_id', 3)
            ->orderBy('created_at', 'desc')
            ->get();

        $orderInfo = array();

        foreach ($orders as $order) {
            $info = array(
                'id' => $order->order_id,
                'quantity' => $order->product_count,
            );

            $product = Product::find($order->product_id);
            $categoryId = $product->category_id;
            $productCategory = ProductCategory::find($categoryId);
            $orderState = OrderStates::find($order->status_id);

            $info['name'] = $product ? $product->name : null;
            $info['category'] = $productCategory ? $productCategory->name : null;
            $info['status'] = $orderState ? $orderState->name : null;

            array_push($orderInfo, $info);
        }

        return response()->json($orderInfo, 200);
    }

    public function logOrder(): JsonResponse
    {
        $orderLog = OrderLogs::orderBy('created_at', 'asc')->get();
        return response()->json($orderLog,200);
    }
}
