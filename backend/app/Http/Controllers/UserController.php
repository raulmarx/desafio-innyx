<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();        
        return UserResource::collection($users) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateUserRequest $request)
    {

        $data = $request->validated();
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $user = User::findOrFail($id);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $user = User::findOrFail($id);

        $data = $request->validated();
        $user->update($data);

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }

    public function createSuperUser(StoreUpdateUserRequest $request)
    {

        $data = $request->validated();
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);

        return new UserResource($user);
    }
}
