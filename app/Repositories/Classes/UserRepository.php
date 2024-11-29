<?php

namespace App\Repositories\Classes;

use App\Exceptions\UserNotFoundException;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function all(): Collection
    {
        return User::where('is_active', true)->get();
    }

    public function find(int $id): ?User
    {
        $user = User::find($id);

        // If user is not found, throw the custom exception
        if (!$user) {
            throw new UserNotFoundException("User with ID {$id} not found.");
        }

        return $user;
    }

    public function create(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['username'].'@example.com',
            'password' => Hash::make($data['password']), 
            'avatar' => $data['avatar'] ?? 'not-set',
            'type' => $data['type'] ?? 'normal'
        ]);

        return $user;
    }

    public function update(int $id, array $data): User
    {
        $user = $this->find($id);
        
        $user->name = $data['name'] ?? $user->name;
        $user->email = ($data['username'] ?? $user->username) .'@example.com';
        $user->password = Hash::make($data['password']); 
        $user->username = $data['username'] ?? $user->username;
        $user->avatar = $data['avatar'] ?? $user->avatar;
        $user->type = $data['type'] ?? $user->type;
        $user->save(); 

        return $user;
    }

    public function delete(int $id): bool
    {
        $user = $this->find($id);
        return $user ? $user->delete() : false;
    }
}