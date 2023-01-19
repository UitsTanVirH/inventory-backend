<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();

        return response()->json([
            "success" => true,
            "message" => "Order showed successfully.",
            "data" => $orders
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
        $order = new Order();

        $order->name = request('name');
        $order->item_id = request('item_id');
        $order->quantity = request('quantity');
        $order->cost = request('cost');
        $order->status = request('status');

        $order->save();

        //send mail

        return response()->json([
            "success" => true,
            "message" => "Order stored successfully."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return response()->json([
            "success" => true,
            "message" => "Order details",
            "data" => $order->item
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $input = $request->all();
        // $validator = Validator::make($input, [
        //     'name' => 'required',
        //     'detail' => 'required'
        // ]);
        // if ($validator->fails()) {
        //     return $this->sendError('Validation Error.', $validator->errors());
        // }
        $pre_order_status = $order->status;

        $data = $order->update([
            'name' => $input['name'],
            'quantity' => $input['quantity'],
            'cost' => $input['cost'],
            'status' => $input['status'],
        ]);
        if($data && $order->status != $pre_order_status && $order->status == 1){
            // inventory update
            $data = $order->item()->update([
                'quantity' =>  $order->item->quantity + $input['quantity'],
                'cost' =>  $order->item->cost + $input['cost']
            ]);
        }
        return response()->json([
            "success" => true,
            "message" => "Order updated successfully.",
            "data" => $order->with('item')->get()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json([
            "success" => true,
            "message" => "Order deleted successfully."
        ]);
    }
}
