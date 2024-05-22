<?php

namespace App\Http\Controllers;

use App\Models\Cell;
use App\Models\Shelf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShelfController extends Controller
{
    public function putItem(Request $request): JsonResponse
    {
        $productId = $request->productId;
        $row = $request->row;
        $column = $request->column;

        $cellFree = Cell::class
                    ->where('row', $row)
                    ->where('column', $column)
                    ->where('occupied', '0');

        if($cellFree) {
            $cell = new Cell();
            $cell->shelf_id = $request->shelfId;
            $cell->product_id = $productId;
            $cell->column = $column;
            $cell->row = $row;
            $cell->is_occupied = true;
            $cell->save();

            return response()->json([
                "data" => $cell,
                "message" => "Item placed successfully"
            ], 200);
        }

        return response()->json([
            "message" => "Place occupied"
        ],404);
    }
}