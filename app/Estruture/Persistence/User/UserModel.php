<?php

namespace App\Estruture\Persistence\User;


use App\Estruture\Persistence\ORM\Model;



class UserModel extends Model
{  protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $fillable = ['nome', 'email', 'token', 'sobrenome'];
    protected $attributes = ['nome' => '','sobrenome' => '', 'email' => '', 'token' => ''];
}
