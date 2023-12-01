<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function List_Purchase()
    {
        $pur_model = new Purchase;
        $purchase = $pur_model::all();
        return response()->json(
            [
                'status' => 'Success',
                'data' => $purchase,
            ], 200);
    }
    public function Create(Request $request)
    {
        // validation the incoming request data
        $validator = validator($request->all(), [
            'pur_id' => 'required',
            'pur_name' => 'required',
            'pro_id' => 'required',
            'category_id' => 'required',
            'unit_id' => 'required',
            'amount' => 'required',
            'qty' => 'required',
            'total_amt' => 'required',
            'status' => 'required',
            'remark' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data = [
            'pur_id' => $request->input('pur_id'),
            'pur_name' => $request->input('pur_name'),
            'pro_id' => $request->input('pro_id'),
            'category_id' => $request->input('category_id'),
            'unit_id' => $request->input('unit_id'),
            'amount' => $request->input('amount'),
            'qty' => $request->input('qty'),
            'total_amt' => $request->input('total_amt'),
            'status' => $request->input('status'),
            'remark' => $request->input('remark'),
        ];
        $purchase = Purchase::Create($data);
        return response()->json(['data' => $data, 'message' => 'Purchase create successfully']);
    }
    public function Delete($id)
    {

        //* find purchase to delete
        $purchase = Purchase::find($id);

        //! Delete the category
        $purchase->delete();

        //Return a success response
        $message = 'Purchase with ID' . $id . 'deleted successfully';
        return response()->json(['message' => $message]);
    }

    public function Update(Request $request, $id)
    {

        // validation the incoming request data
        $validator = validator($request->all(), [
            'pur_id' => 'required',
            'pur_name' => 'required',
            'pro_id' => 'required',
            'category_id' => 'required',
            'unit_id' => 'required',
            'amount' => 'required',
            'qty' => 'required',
            'total_amt' => 'required',
            'status' => 'required',
            'remark' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        //? find Purchase to update
        $purchase = Purchase::find($id);

        //* Update fields to the Database
        $purchase->pur_id = $request->input('pur_id');
        $purchase->pur_name = $request->input('pur_name');
        $purchase->pro_id = $request->input('pro_id');
        $purchase->category_id = $request->input('category_id');
        $purchase->unit_id = $request->input('unit_id');
        $purchase->amount = $request->input('amount');
        $purchase->qty = $request->input('qty');
        $purchase->total_amt = $request->input('total_amt');
        $purchase->status = $request->input('status');
        $purchase->remark = $request->input('remark');

        //! save any update to database
        $purchase->save();

        //* Return Success message response
        return response()->json(['data' => $purchase, 'message' => 'Purchase has been update successfully']);

    }
}
