<?php

namespace App\Application\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Domain\User\UserService;
use App\Core\View;
class UserController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        $view = new View(__DIR__ . '/../../../resources/views/comun/user/index.php', ['users' => $users]);
        $html = $view->render();
        return new Response($html, 200);
    }

    public function store(Request $request)
    {
        $data = $request->getBody();
        $user = $this->userService->createUser($data);
        return new Response(json_encode($user), 201, ['Content-Type' => 'application/json']);
    }

    public function show(Request $request, $id)
    {
        $user = $this->userService->getUserById($id);
        if ($user) {
            return new Response(json_encode($user), 200, ['Content-Type' => 'application/json']);
        }
        return new Response('User not found', 404);
    }

    public function update(Request $request, $id)
    {
        $data = $request->getBody();
        $user = $this->userService->updateUser($id, $data);
        return new Response(json_encode($user), 200, ['Content-Type' => 'application/json']);
    }

    public function destroy(Request $request, $id)
    {
        $this->userService->deleteUser($id);
        return new Response('User deleted', 200);
    }
}
