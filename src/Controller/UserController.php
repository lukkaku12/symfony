<?php

namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

#[Route('/user')]
final class UserController extends AbstractController
{

    private UserService $userService;

    public function __construct(UserService $userService) {}

    #[Route('', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    public function list(): JsonResponse
    {
        $users = $this->userService->listUsers();

        return $this->json($users);
    }

    #[Route('', name: 'user_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $user = $this->userService->createUser($data['name'], $data['last_name']);

        return $this->json($user, 201);
    }

    #[Route('/{id}', name: 'user_get', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        $user = $this->userService->getUser($id);

        return $this->json($user);
    }

    #[Route('/{id}', name: 'user_update', methods: ['PUT', 'PATCH'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $user = $this->userService->updateUser($id, $data['name'], $data['last_name']);

        return $this->json($user);
    }

    #[Route('/{id}', name: 'user_delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $this->userService->deleteUser($id);

        return $this->json(null, 204);
    }


}
