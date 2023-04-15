<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ProductTypeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $productType = new ProductType([
            'name' => $request->name,
            'image' => $request->image,
        ]);
        $productType->save();

        return response()->json(['message' => 'productType created successfully'], 201);
    }

    public function show()
    {
        $productTypes = ProductType::with('items')->get();

        return $productTypes;
    }

    public function getProductTypeById($id)
    {
        $productType = DB::table('product_types')
            ->where('id', '=', $id)
            ->get();

        return $productType;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $productType = ProductType::find($request->id);

        if (!$productType) {
            return 'product type not found';
        }

        $productType->name = $request->name;
        $productType->image = $request->image;

        $productType->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    function deleteProductTypeById($id)
    {
        $productType = ProductType::find($id);

        if (!$productType) {
            return 'product type not found';
        }

        $productType->delete();

        return 'deleted successfuly';
    }
}
