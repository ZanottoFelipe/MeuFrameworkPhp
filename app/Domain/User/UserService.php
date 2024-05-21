<?php

namespace App\Domain\User;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAll();
    }

    public function getUserById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function createUser($data)
    {
        $user = new User($data);
        return $this->userRepository->save($user);
    }

    public function updateUser($id, $data)
    {
        $user = $this->userRepository->findById($id);
        if ($user) {
            $user->fill($data);
            return $this->userRepository->save($user);
        }

        return null;
    }

    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }
}
