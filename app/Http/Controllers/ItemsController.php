<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Validator;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();

        return response()->json([
            "success" => true,
            "message" => "Item showed successfully.",
            "data" => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Item();
        $input = $request->all();

        $item->name = $input['name'];
        $item->description = $input['description'];
        $item->quantity = $input['quantity'];
        $item->cost = $input['cost'];
        $item->lower_limit = $input['lower_limit'];

        $item->save();

        return response()->json([
            "success" => true,
            "message" => "Item created successfully.",
            "data" => $item
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // use the $id variable to query the db for a record
        $item = Item::findOrFail($id);

        return response()->json([
            "success" => true,
            "message" => "Item Get successfully.",
            "data" =>$item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $input = $request->all();
        // $validator = Validator::make($input, [
        //     'name' => 'required',
        //     'detail' => 'required'
        // ]);
        // if ($validator->fails()) {
        //     return $this->sendError('Validation Error.', $validator->errors());
        // }
        $data = $item->update([
            'name' => $input['name'],
            'description' => $input['description'],
            'quantity' => $input['quantity'],
            'cost' => $input['cost'],
            'lower_limit' => $input['lower_limit']
        ]);
        return response()->json([
            "success" => true,
            "message" => "Item updated successfully.",
            "data" => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return response()->json([
            "success" => true,
            "message" => "Item deleted successfully."
        ]);
    }
}
