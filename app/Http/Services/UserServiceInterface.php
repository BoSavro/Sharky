<?php


namespace App\Http\Services;


use App\Models\User;

interface UserServiceInterface
{
    public function getById(int $id): User;
}