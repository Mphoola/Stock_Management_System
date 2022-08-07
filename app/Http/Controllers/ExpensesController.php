<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Http\Resources\ExpenseResource;
use App\Http\Requests\ExpenseRequest;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $xpenses = Expense::with('user')->latest()->paginate(10);
        return ExpenseResource::collection($xpenses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseRequest $request)
    {
        try{
            Expense::create([
                'expense_on' => $request->expense_on,
                'description' => $request->description,
                'total' => $request->total,
                'user_id' => auth()->user()->id,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Expense is created successfully',
            ], 201);
        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
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
        try{
            $expense = Expense::findOrFail($id);
            $expense->load('user');
            return response()->json([
                'status' => true,
                'message' => 'Expense is retrieved successfully',
                'data' => new ExpenseResource($expense)
            ], 200);
        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $expense = Expense::findOrFail($id);
            $expense->update([
                'expense_on' => $request->expense_on,
                'description' => $request->description,
                'total' => $request->total,
                'user_id' => auth()->user()->id,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Expense is updated successfully',
            ], 200);
        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
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
        try{
            $expense = Expense::findOrFail($id);
            $expense->delete();
            return response()->json([
                'status' => true,
                'message' => 'Expense is deleted successfully',
            ], 200);
        }catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
