<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:50',
        'src' => 'nullable|string|max:500',
        'quantity' => 'required|integer',
        'price' => 'required|integer',
        'category' => 'required|integer',
        'description' => 'nullable|string|max:500',
        'brand' => 'nullable|string|max:50'
    ]);

    return Product::create($request->only([
        'title', 'src', 'quantity', 'price', 'category', 'description', 'brand'
    ]));
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
{
    return $product;
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
{
    $request->validate([
        'title' => 'required|string|max:50',
        'src' => 'nullable|string|max:500',
        'quantity' => 'required|integer',
        'price' => 'required|integer',
        'category' => 'required|integer',
        'description' => 'nullable|string|max:500',
        'brand' => 'nullable|string|max:50'
    ]);

    $product->update($request->only([
        'title', 'src', 'quantity', 'price', 'category', 'description', 'brand'
    ]));

    return $product;
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
{
    $product->delete();
    return response()->noContent();
}
}
