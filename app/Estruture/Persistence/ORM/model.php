<?php

namespace App\Estruture\Persistence\ORM;
use PDO;

class Model
{
    protected $table;
    protected $primaryKey = 'id';
    protected $fillable = [];
    protected $attributes = [];

    protected static $pdo;

    public function __construct()
    {
        if (!self::$pdo) {
            $dsn = 'mysql:host='.HOST.';dbname='.BD;
            $username = USER;
            $password = SENHA;
            self::$pdo = new PDO($dsn, $username, $password);
        }
    }

    public function __get($key)
    {
        return $this->attributes[$key] ?? null;
    }

    public function __set($key, $value)
    {
        if (in_array($key, $this->fillable)) {
            $this->attributes[$key] = $value;
        }
    }

    public function save()
    {
        $columns = implode(',', array_keys($this->attributes));
        $values = implode(',', array_map(fn($value) => ":$value", array_keys($this->attributes)));

        $stmt = self::$pdo->prepare("INSERT INTO {$this->table} ($columns) VALUES ($values)");
        foreach ($this->attributes as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();
    }

    public static function find($id)
    {
        $instance = new static();
        $stmt = self::$pdo->prepare("SELECT * FROM {$instance->table} WHERE {$instance->primaryKey} = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $attributes = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($attributes) {
            $instance->attributes = $attributes;
            return $instance;
        }

        return null;
    }

    public static function all()
    {
        $instance = new static();
        $stmt = self::$pdo->query("SELECT * FROM {$instance->table}");
        return $stmt->fetchAll(PDO::FETCH_CLASS, get_called_class());
    }
}