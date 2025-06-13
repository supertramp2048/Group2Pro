<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
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
        'userName' => 'required|string|max:30',
        'email' => 'nullable|email|max:30',
        'password' => 'required|string',
        'admin' => 'boolean'
    ]);

    return User::create($request->only(['userName', 'email', 'password', 'admin']));
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
{
    return $user;
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
{
    $request->validate([
        'userName' => 'required|string|max:30',
        'email' => 'nullable|email|max:30',
        'password' => 'required|string',
        'admin' => 'boolean'
    ]);

    $user->update($request->only(['userName', 'email', 'password', 'admin']));

    return $user;
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
{
    $user->delete();
    return response()->noContent();
}
}
