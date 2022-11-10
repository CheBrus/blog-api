<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index()
    {
        return User::paginate();
    }

    public function show(User $user)
    {
        return $user;
    }

    public function store(StoreUserRequest $request)
    {


        $user = User::create($request->validated());
        return response()->json($user, 201);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        return $user->update($request->validated());
    }

    public function delete(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }
}
