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

        $data =$request->validated();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        return response()->json($user, 201);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data =$request->validated();
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        return $user->update($data);
    }

    public function delete(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }
}
