<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalesRequest;
use App\Http\Resources\SaleResource;
use App\Jobs\AddSaleJob;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::latest()->withCount('saleItems')->with('user')->paginate(12);
        return SaleResource::collection($sales);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $sale = Sale::create([
                'user_id' => auth()->id(),
                'total' => $request->total,
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
            ]);

            $sale->saleItems()->createMany($request->saleItems);

            foreach ($request->saleItems as $saleItem) {

                $product = Product::find($saleItem['product_id']);

                $product->decrement('stock', $saleItem['quantity']);

            }

            return response()->json([
                'status' => true,
                'message' => 'Sale created successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error creating sale',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $sale = Sale::findOrFail($id);
            $sale->load('saleItems');
            return response()->json([
                'status' => true,
                'message' => 'Sale is retrieved successfully',
                'data' => new SaleResource($sale)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error finding sale',
                'errors' => $e->getMessage()
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SalesRequest $request, $id)
    {
        try {
            $sale = Sale::findOrFail($id);
            $sale->update($request->all());
            $sale->saleItems()->delete();
            $sale->saleItems()->createMany($request->saleItems);
            return response()->json([
                'status' => true,
                'message' => 'Sale updated successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating sale',
                'errors' => $e->getMessage()
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $sale = Sale::findOrFail($id);
            $sale->saleItems()->delete();
            $sale->delete();
            return response()->json([
                'status' => true,
                'message' => 'Sale deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting sale',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
}
