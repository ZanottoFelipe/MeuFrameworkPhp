<?php

namespace App\Domain\User;

interface UserRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function save(User $user);
    public function delete($id);
    public function findAll();
}
