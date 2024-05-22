<?php

namespace App\Http\Controllers;

use App\Models\Cell;
use App\Models\Shelf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShelfController extends Controller
{
    public function getAllShelfes(): JsonResponse
    {
        $shelves = Shelf::all();

        return response()->json([
            "data" => $shelves,
            "message" => "Shelfes retrieved successfully"
        ], 200);
    }

    public function putItem(Request $request): JsonResponse
    {
        $productId = $request->productId;
        $row = $request->row;
        $column = $request->column;
        $shelfId = $request->shelfId;

        $shelf = Shelf::select('shelf_id', 'column', 'row')->first();

        if ($shelf->shelf_id == $shelfId) {
            if ($row <= $shelf->row && $column <= $shelf->column) {

                $cellFree = Cell::class
                    ->where('row', $row)
                    ->where('column', $column)
                    ->where('occupied', '0');

                if ($cellFree) {
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
                ], 404);
            }

            return response()->json([
                "message" => "Place doesn't exist"
            ], 404);
        }
    }

    public function deleteItem(Request $request): JsonResponse
    {
        $cell = Cell::find($request->cellId);

        if ($cell) {
            $cell->delete();

            return response()->json([
                "message" => "Item removed from shelf successfully"
            ], 200);
        }

        return response()->json([
            "message" => "Item not found"
        ], 404);
    }
}
