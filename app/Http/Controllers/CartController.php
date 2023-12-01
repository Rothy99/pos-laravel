<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response; // Import Response facade
class CartController extends Controller
{
    // public function addToCart($id)
    // {
    //     // Fetch product details from the database
    //     $product = ProductModel::find($id);
    
    //     if (!$product) {
    //         return response()->json(['message' => 'Product not found'], 404);
    //     }
    
    //     $cart = request()->session()->get('cart', []);
    
    //     // No quantity validation
    
    //     // Optional: Get discount by product from the request (if provided)
    //     $productDiscount = request('product_discount', 0); // Default to 0 if not provided
    
    //     if (isset($cart[$id])) {
    //         // If the item is already in the cart, update the quantity based on the request
    //         $cart[$id]['quantity'] += request('quantity', 1); // assuming a default quantity of 1 if not provided
    //     } else {
    //         // If the item is not in the cart, add it with the provided quantity or default to 1
    //         $cart[$id] = [
    //             'pro_id' => $product->id,
    //             'pro_name' => $product->pro_name,
    //             'price' => $product->price,
    //             'quantity' => request('quantity', 1),
    //         ];
    //     }
    
    //     // Calculate the total price for the item
    //     $totalPrice = $cart[$id]['quantity'] * $cart[$id]['price'];
    
    //     // Apply discount by product if provided
    //     $discountedPrice = $totalPrice - $productDiscount;
    
    //     // Ensure the discounted price doesn't go below zero
    //     $cart[$id]['total_price'] = number_format(max(0, $discountedPrice), 2);
    
    //     // Optional: Get total amount discount from the request (if provided)
    //     $totalAmountDiscount = request('total_amount_discount', 0); // Default to 0 if not provided
    
    //     // Apply total amount discount to the cart if provided
    //     foreach ($cart as &$item) {
    //         $item['total_price'] -= $totalAmountDiscount;
    //         $item['total_price'] = max(0, $item['total_price']);
    //     }
    
    //     // Remove the item from the cart if the quantity becomes zero or negative
    //     if ($cart[$id]['quantity'] <= 0) {
    //         unset($cart[$id]);
    //     }
    
    //     request()->session()->put('cart', $cart);
    
    //     // Include information about the added product in the response
    //     $response = [
    //         'message' => 'Item updated in cart',
    //         'added_product' => $cart[$id],
    //     ];
    
    //     return response()->json($response);
    // }
    public function addToCart($id)
    {
        // Fetch product details from the database
        $product = ProductModel::find($id);
    
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    
        $cart = request()->session()->get('cart', []);
    
        // Validate the quantity
        // $validatedData = request()->validate([
        //     'quantity' => 'required|integer|min:1',
        // ]);
    
        // Add the product to the cart as a new entry
        $cartItem = [
            'pro_id' => $product->id,
            'pro_name' => $product->pro_name,
            'price' => $product->price,
            'quantity' => 1,
            'total_price' => number_format(1 * $product->price, 2),
        ];
    
        $cart[] = $cartItem;
    
        request()->session()->put('cart', $cart);
    
        // Include information about the added product in the response
        $response = [
            'message' => 'Item added to cart',
            'added_product' => $cartItem,
        ];
    
        return response()->json($response);
    }
    
    
public function showAddedProducts(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        // Check if the cart is not empty
        if (!empty($cart)) {
            // Extract the details of added products
            $addedProducts = array_values($cart);

            return response()->json(['added_products' => $addedProducts]);
        }

        return response()->json(['message' => 'No products added to the cart']);
    }
    
    public function showCart(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        // You can customize the response as needed
        return response()->json(['cart' => $cart]);
    }

    public function removeFromCart(Request $request, $id)
    {
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            $request->session()->put('cart', $cart);

            return response()->json(['message' => 'Item removed from cart']);
        }

        return response()->json(['message' => 'Item not found in cart'], 404);
    }
    public function clearCart(Request $request)
    {
        $request->session()->forget('cart');

        return response()->json(['message' => 'Cart cleared']);
    }
public function updateQuantity(Request $request, $id)
{
    $cart = $request->session()->get('cart', []);

    if (isset($cart[$id])) {
        // Validate the updated quantity
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Update the quantity of the item in the cart
        $cart[$id]['quantity'] = $validatedData['quantity'];

        // Calculate the total price for the item after updating the quantity
        $cart[$id]['total_price'] = number_format($cart[$id]['quantity'] * $cart[$id]['price'], 2);

        $request->session()->put('cart', $cart);

        return response()->json(['message' => 'Quantity updated in cart', 'updated_product' => $cart[$id]]);
    }

    return response()->json(['message' => 'Item not found in cart'], 404);
}

}