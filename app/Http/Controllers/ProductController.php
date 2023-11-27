<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{
public function List_product(){
    $pro_model = new ProductModel;
    $Product = $pro_model::all();
    return response()->json(
            [
                'status' => 'Success',
                'data' => $Product
            ], 200);
    }
    
    public function Create(Request $request)
    {
        // Validate the incoming request data
        $validator = validator($request->all(), [
            'pro_name' => 'required',
            'pro_code' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'alert' => 'required',
            'unit_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['status' => 'Validation Error', 'errors' => $validator->errors()], 422);
        }
    
        // Access validated data
        $input = $request->all();
    
        // Handle file upload
        if ($image = $request->file('image')) {
            $destinationPath = 'asset/product/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
    
        // Mocked user response
        $data = [
            'pro_name' => $input['pro_name'],
            'pro_code' => $input['pro_code'],
            'category_id' => $input['category_id'],
            'cur_stock' => 0,
            'price' => $input['price'],
            'alert' => $input['alert'],
            'unit_id'  => $input['unit_id'],
            'image' => $input['image'],
        ];
    
        // Simulate database insertion success
        // You can replace this with your actual database insertion logic
        $product = ProductModel::create($data);
    
        if ($product) {
            return response()->json(
                [
                    'status' => 'Success',
                    'message' => 'Product created successfully',
                    'data' => $data
                ], 201);
        } else {
            return response()->json(
                [
                    'status' => 'Error',
                    'message' => 'Failed to create product'
                ], 500);
        }
    }
    public function Update(Request $request, $id)
    {
        
        $input = $request->all();

        // Handle file upload if an image is provided
        if ($request->hasFile('image')) {
            $destinationPath = 'asset/product/';
            $profileImage = date('YmdHis') . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
    
        // Mocked user response
        $data = [
            'pro_name' => $input['pro_name'],
            'pro_code' => $input['pro_code'],
            'category_id' => $input['category_id'],
            'cur_stock' => 0,
            'price' => $input['price'],
            'alert' => $input['alert'],
            'unit_id' => $input['unit_id'],
            'image' => $input['image'] ?? null,
        ];
    
        // Simulate database update success
        // You can replace this with your actual database update logic
        $isUpdated = true;
    
        if ($isUpdated) {
            return response()->json(
                [
                    'status' => 'Success',
                    'message' => 'Product updated successfully',
                    'data' => $data
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => 'Error',
                    'message' => 'Failed to update product'
                ],
                500
            );
        }
    }

public function Delete($id)
    {
        // Simulate database deletion
        // Replace this with your actual database deletion logic
        $isDeleted = true;

        if ($isDeleted) {
            return response()->json(['message' => 'Product deleted successfully']);
        } else {
            return response()->json(['message' => 'Failed to delete product'], 500);
        }
    }
}