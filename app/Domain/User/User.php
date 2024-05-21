<?php

namespace App\Domain\User;

class User
{
    protected $id;
    protected $name;
    protected $email;

    public function __construct($data)
    {
        $this->fill($data);
    }

    public function fill($data)
    {
        $this->name = $data['name'] ?? $this->name;
        $this->email = $data['email'] ?? $this->email;
    }

    // Métodos getters e setters
}
