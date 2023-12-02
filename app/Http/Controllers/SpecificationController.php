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
}
