<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{
    public function List_Category()
    {

        $category = [

            (object) [
                'id' => 1,
                'cat_id' => 'S001',
                'cat_name' => 'Soft drink',
                'desc' => 'testing',
            ],
            (object) [
                'id' => 2,
                'cat_id' => 'S002',
                'cat_name' => 'Coffee',
                'desc' => 'testing',
            ],
            (object) [
                'id' => 3,
                'cat_id' => 'S003',
                'cat_name' => 'Food',
                'desc' => 'testing',
            ],
            (object) [
                'id' => 4,
                'cat_id' => 'S003',
                'cat_name' => 'Food',
                'desc' => 'testing',
            ],
            (object) [
                'id' => 5,
                'cat_id' => 'S003',
                'cat_name' => 'Food',
                'desc' => 'testing',
            ],
        ];

        $data = [
            'data' => $category,
        ];
        return response()->json($data);
    }
    public function Create(Request $request)
    {
        // Mocked response
        $cat = [
            'id' => 3,
            'cat_id' => $request->input('cat_id'),
            'cat_name' => $request->input('cat_name'),
            'desc' => $request->input('desc'),
        ];

        return response()->json(['data' => $cat, 'message' => 'Category created successfully']);
    }
    public function Update(Request $request, $id)
    {
        // Mocked response
        $cat = [
            'id' => $id,
            'cat_id' => $request->input('cat_id'),
            'cat_name' => $request->input('cat_name'),
            'desc' => $request->input('desc'),
        ];

        // Simulate an update by modifying the 'cat_name' in the response
        // $updatedCatName = 'Updated to ' . $request->input('cat_name');
        // $cat['cat_name'] = $updatedCatName;

        return Response::json(['data' => $cat, 'message' => 'Category updated successfully']);
    }
    public function Delete($id)
    {
        // Simulate a delete by ID you know?
        $message = 'Category with ID ' . $id . ' deleted successfully';

        return Response::json(['message' => $message]);
    }
}
