<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserCart;
use Illuminate\Http\Request;

class UserCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = UserCart::with(['user', 'product'])->get();
        return response()->json($items);
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
            'userId' => 'required|integer|exists:users,id',
            'productId' => 'required|integer|exists:products,id'
        ]);

        $userCart = UserCart::create($request->only(['userId', 'productId']));
        return response()->json($userCart, 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = UserCart::with(['user', 'product'])->findOrFail($id);
        return response()->json($item);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'userId' => 'required|integer|exists:users,id',
            'productId' => 'required|integer|exists:products,id'
        ]);

        $userCart = UserCart::findOrFail($id);
        $userCart->update($request->only(['userId', 'productId']));
        return response()->json($userCart);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userCart = UserCart::findOrFail($id);
        $userCart->delete();
        return response()->noContent();
    }
}
