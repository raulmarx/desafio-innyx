<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('View');

        $users = User::all();
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateUserRequest $request)
    {
        $this->authorize('Create');

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
        $this->authorize('View');


        $user = User::findOrFail($id);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateUserRequest $request, string $id)
    {
        $this->authorize('Edit');

        $user = User::findOrFail($id);
        $data = $request->validated();
        $data['password'] = bcrypt($request->password);

        $user->update($data);

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('Delete');

        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    public function register(StoreUpdateUserRequest $request)
    {

        $data = $request->validated();
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        $user->roles()->attach(1);

        return new UserResource($user);
    }
}
