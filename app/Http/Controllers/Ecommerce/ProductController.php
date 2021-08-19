<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->all();

        try {
            DB::transaction(function () use($data) {
                Product::updateOrCreate([
                    'name' => $data['name'],
                ], [
                    'prices' => $data['prices'],
                    'slug' => $data['slug'] ?? Str::of($data['name'])->slug('-')
                ]);
            }, 3);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'stauts' => 400,
                'message' => 'product not created'
            ]);
        }
        return response()->json([
            'message' => 'created'
        ], 201);
    }

    public function delete($id): JsonResponse
    {
        $product = Product::find($id);

        if (!$product) {
           return response()->json([
               'message' => 'not found product'
           ], 404);
        }

        $product->delete();

        return response()->json([
            'status' => 200
        ]);
    }
}
