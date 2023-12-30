<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{
    public function List_Category()
    {
        $cat_model = new CategoryModel;
        $category = $cat_model::all();
        return response()->json(
            [
                'status' => 'Success',
                'data' => $category,
            ], 200);
    }
    public function Create(Request $request)
    {
        // Validate the incoming request data
        $validator = validator($request->all(), [
            'cat_id' => 'required',
            'cat_name' => 'required',
            'description' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Extract data from the request
        $data = [
            'cat_id' => $request->input('cat_id'),
            'cat_name' => $request->input('cat_name'),
            'description' => $request->input('description'),
        ];

        // Create a new category in the database
        $category = CategoryModel::create($data);

        // Return a success response
        return response()->json(['data' => $data, 'message' => 'Category created successfully']);
    }
    public function Update(Request $request, $id)
    {
        // Validate the incoming request data
        $validator = validator($request->all(), [
            'cat_id' => 'required',
            'cat_name' => 'required',
            'description' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Find the category to update
        $category = CategoryModel::find($id);

        // Update fields
        $category->cat_id = $request->input('cat_id');
        $category->cat_name = $request->input('cat_name');
        $category->description = $request->input('description');

        // Save changes to the database
        $category->save();

        // Return a success response
        return response()->json(['data' => $category, 'message' => 'Category updated successfully']);
    }
    public function Delete($id)
    {
        // Find the category to delete
        $category = CategoryModel::find($id);

        // Check if the category exists
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        // Delete the category
        $category->delete();

        // Return a success response
        $message = 'Category with ID ' . $id . ' deleted successfully';
        return response()->json(['message' => $message]);
    }
}
