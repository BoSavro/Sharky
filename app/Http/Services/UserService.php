<?php


namespace App\Http\Services;


use App\Http\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Contracts\Queue\EntityNotFoundException;

class UserService implements UserServiceInterface
{
    public function __construct(
        private UserRepository $userRepository
    ) { }

    public function getById(int $id): User
    {
        $user = $this->userRepository->findById($id);

        if ($user === null) {
            throw new EntityNotFoundException('User', $id);
        }

        return $user;
    }
}