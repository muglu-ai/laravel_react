<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index()
    {
        //return response(User::with('role')->paginate(), 200);
        $users = User::paginate();
        return UserResource::collection($users);
    }

    //show individual user
    public function show($id)
    {
        $user = User::with('role')->find($id);
        return new UserResource($user);
        //return response()->json($user, 200);
    }

    //store user with post request and user first name and last_name and email, password in request
    public function store(CreateUserRequest $request)
    {
//
        $user = User::create(
            $request->only('first_name', 'last_name', 'email', 'password', 'role_id')
            + ['password' => Hash::make($request->password)]
        );

        return response()->json($user, 201);
    }

    public function user()
    {
        return Auth::user();
    }

    //update user with put request and user first name and last_name and email, password in request
    public function update(UdateUserRequest $request, $id)
    {
        $user = Auth::user();
        $user->update($request->only(['first_name', 'last_name', 'email', 'role_id']));
        return response()->json($user, Response::HTTP_ACCEPTED);
    }

    //update password with put request
    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        return response()->json($user, Response::HTTP_ACCEPTED);
    }

    //delete user with delete request
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(null, 204);
    }
}
