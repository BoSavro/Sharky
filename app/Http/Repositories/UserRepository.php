<?php


namespace App\Http\Repositories;


use App\Models\User;

class UserRepository
{
    /**
     * @param int $id
     * @return User
     */
    public function findById(int $id): User
    {
        return User::find($id);
    }
}