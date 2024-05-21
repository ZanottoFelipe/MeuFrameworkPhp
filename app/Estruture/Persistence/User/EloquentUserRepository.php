<?php

namespace App\Estruture\Persistence\User;

use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use App\Estruture\Persistence\User\UserModel;


class EloquentUserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(UserModel $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function save(User $user)
    {
        // Verifique se o usuário já existe no banco de dados
        $userModel = $this->model->find($user->id) ?? new UserModel();

        // Preencha os dados do usuário no modelo
        $userModel->name = $user->name;
        $userModel->email = $user->email;

        // Salve o modelo no banco de dados
        $userModel->save();

        return $userModel;
    }

    public function delete($id)
    {
        $userModel = $this->model->find($id);
        if ($userModel) {
            $userModel->delete();
            return true;
        }
        return false;
    }


    public function findAll()
    {
        
        return User::all();
    }
}
