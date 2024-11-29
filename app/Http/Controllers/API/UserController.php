<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        // Retrieve all active users
        $users = $this->userRepository->all();
        return response()->json($users);
    }

    public function show($id)
    {
        // Retrieve user by ID
        $user = $this->userRepository->find($id);
        return response()->json($user);
    }
   
    public function store(StoreUserRequest $request)
    {
        // Create a new user
        $user = $this->userRepository->create($request->all());
        return response()->json($user, 201); 
    }

    public function update(UpdateUserRequest $request, $id)
    {
        // Delete User
        $user = $this->userRepository->update($id, $request->all());
        return response()->json($user); 
    }

    public function destroy($id)
    {
        // Delete User
        $this->userRepository->delete($id);
        return response()->json(['message' => 'User deleted successfully'], 200); 
    }
}
