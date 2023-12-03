<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Specification;
use Illuminate\Http\Request;

class SpecificationController extends Controller
{
    public function List_Specification()
    {
        $spc_model = new Specification;
        $specification = $spc_model::all();
        return response()->json([
            'status' => 'Success',
            'data' => $specification,
        ], 200);
    }
    public function Create(Request $request)
    {
        // ! Validation Required
        $validator = validator($request->all(), [
            'specification_id' => 'required',
            'pro_id' => 'required',
            'specification_name' => 'required',
            'specification_value' => 'required',
            'price' => 'required',
        ]);
        // ? Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data = [
            'specification_id' => $request->input('specification_id'),
            'pro_id' => $request->input('pro_id'),
            'specification_name' => $request->input('specification_name'),
            'specification_value' => $request->input('specification_value'),
            'price' => $request->input('price'),
        ];
        $specification = Specification::Create($data);
        return response()->json(['data' => $data, 'message' => 'Specifications created successfully']);
    }

    public function Delete($id)
    {
        // * Find data to delete
        $specification = Specification::find($id);

        // ! Delete data
        $specification->delete();

        //* Return message
        $message = 'Specification with ID' . $id . 'deleted successfully';
        return response()->json(['message' => $message]);
    }

    public function Update(Request $request, $id)
    {

        // ! Validation Required
        $validator = validator($request->all(), [
            'specification_id' => 'required',
            'pro_id' => 'required',
            'specification_name' => 'required',
            'specification_value' => 'required',
            'price' => 'required',
        ]);
        // ? Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // * find data to update
        $specification = Specification::find($id);

        // * Update fields to Database
        $specification->specification_id = $request->input('specification_id');
        $specification->pro_id = $request->input('pro_id');
        $specification->specification_name = $request->input('specification_name');
        $specification->specification_value = $request->input('specification_value');
        $specification->price = $request->input('price');

        //? save any change to database
        $specification->save();

        // * Return message
        return response()->json(['data' => $specification, 'message' => 'specification has been updated successfully']);

    }

}
