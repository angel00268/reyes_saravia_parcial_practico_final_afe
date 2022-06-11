<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Auth::user()->seller->products;
        return response()->json(['message' => 'success', 'products' => $products]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => ['required', 'string', 'max:50'],
            'product_description' => ['required', 'string', 'max:255'],
            'unit_price' => ['required', 'numeric','min:0.01'],
            'stock' => ['required', 'numeric',],
            'warranty' => ['required', 'string', 'max:100'],
        ], [], [
            'product_name' => 'Nombre de producto',
            'product_description' => 'Descripción del producto',
            'unit_price' => 'Precio unitario',
            'stock' => 'Stock',
            'warranty' => 'Garantía',
        ]);

        Product::create($request->all());
        return response()->json(['message' => 'success']);
    }

    public function show(Product $product)
    {
        return response()->json(['message' => 'success', 'product' => $product]);
    }

    public function update(Request $request, $product)
    {
        $request->validate([
            'product_name' => ['required', 'string', 'max:50'],
            'product_description' => ['required', 'string', 'max:255'],
            'unit_price' => ['required', 'numeric','min:0.01'],
            'stock' => ['required', 'numeric',],
            'warranty' => ['required', 'string', 'max:100'],
        ], [], [
            'product_name' => 'Nombre de producto',
            'product_description' => 'Descripción del producto',
            'unit_price' => 'Precio unitario',
            'stock' => 'Stock',
            'warranty' => 'Garantía',
        ]);

        $array = [
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'unit_price' => $request->unit_price,
            'stock' => $request->stock,
            'warranty' => $request->warranty,
        ];
        Product::where('id',$request->id)->update($array);
        return response()->json(['message' => 'success']);
    }

    public function destroy($product)
    {
        Product::where('id',$product)->delete();
        return response()->json(['message' => 'success']);
    }
}
