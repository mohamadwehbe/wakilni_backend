<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'serial_number' => 'required|string',
            'product_type_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $item = new Item([
            'serial_number' => $request->serial_number,
            'product_type_id' => $request->product_type_id
        ]);
        $item->save();

        return response()->json(['message' => 'item created successfully'], 201);
    }

    public function getItemsByProductType($product_type_id)
    {
        $items = DB::table('items')
            ->where('product_type_id', '=', $product_type_id)
            ->get();

        return $items;
    }


    public function getItemById($id)
    {
        $item = DB::table('items')
            ->where('id', '=', $id)
            ->get();

        return $item;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $Item = Item::find($request->id);

        if (!$Item) {
            return 'item not found';
        }

        $Item->serial_number = $request->serial_number;

        $Item->save();
    }

    public function setIsSold(Request $request)
    {
        $Item = Item::find($request->id);

        if (!$Item) {
            return 'item not found';
        }

        $Item->is_sold = true;

        $Item->save();
    }

    public function setIsNotSold(Request $request)
    {
        $Item = Item::find($request->id);

        if (!$Item) {
            return 'item not found';
        }

        $Item->is_sold = false;

        $Item->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    function deleteItemById($id)
    {
        $Item = Item::find($id);

        if (!$Item) {
            return 'product type not found';
        }

        $Item->delete();

        return 'deleted successfuly';
    }
}
