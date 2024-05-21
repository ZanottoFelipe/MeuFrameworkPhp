<?php
namespace App\Core;

class View
{
    protected $path;
    protected $data = [];

    public function __construct($path, $data = [])
    {
        $this->path = $path;
        $this->data = $data;
    }

    public function render()
    {
        if (file_exists($this->path)) {
            extract($this->data);
            ob_start();
            require $this->path;
            return ob_get_clean();
        }
        
        throw new \Exception("View [{$this->path}] not found.");
    }

    public static function make($view, $data = [])
    {
        $path = __DIR__ . '/../../resources/views/' . str_replace('.', '/', $view) . '.php';
        return new self($path, $data);
    }
}
