<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products', compact('products'));
    }


    public function cart()
    {
        return view('cart');
    }


    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


    public function update(Request $request)
{
    if ($request->id && $request->quantity) {
        $cart = session()->get('cart');

        if (isset($cart[$request->id])) {
            $cart[$request->id]["quantity"] = (int) $request->quantity;
            $cart[$request->id]["total_price"] = $cart[$request->id]["price"] * $cart[$request->id]["quantity"];

            session()->put('cart', $cart);

            // Calculate new total
            $total = array_sum(array_map(function ($item) {
                return $item['price'] * $item['quantity'];
            }, $cart));

            $productCount = count($cart);
            $discount = ($productCount >= 3) ? $total * 0.10 : 0;
            $finalTotal = $total - $discount;

            return response()->json([
                'success' => true,
                'total_price' => number_format($cart[$request->id]["total_price"], 2),
                'cart_total' => number_format($total, 2),
                'discount' => number_format($discount, 2),
                'final_total' => number_format($finalTotal, 2)
            ]);
        }
    }

    return response()->json(['success' => false, 'message' => 'Item not found in cart']);
}



   
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
