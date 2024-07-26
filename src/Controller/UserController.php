<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    // Retreive all users linked to a customer /* USER */
    #[Route('/api/customer/{customerId}/users', name: 'app_user', methods: ['GET'])]
    public function indexAll(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'This route will soon allow you to retrieve the list of all users linked to a customer !',
            'path' => 'src/Controller/UserController.php',
        ]);
    }


    // Retreive the details of a user /* USER */
    #[Route('/api/customer/{customerId}/user/{userId}', name: 'app_user.index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'This route will soon allow you to retrieve the details of a user !',
            'path' => 'src/Controller/UserController.php',
        ]);
    }


    // Create a new user /* USER */
    #[Route('/api/customer/{customerId}/users/{userId}', name: 'app_user.create', methods: ['POST'])]
    public function create(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'This route will soon allow a user to be created !',
            'path' => 'src/Controller/UserController.php',
        ]);
    }


    // Modify a user /*** ADMIN ***/
    #[Route('/api/customer/{customerId}/users/{userId}', name: 'app_user.edit', methods: ['PUT'])]
    public function edit(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'This route will soon allow a user to be modified !',
            'path' => 'src/Controller/UserController.php',
        ]);
    }


    // Delete a user /* USER */
    #[Route('/api/customer/{customerId}/users/{userId}', name: 'app_user.delete', methods: ['DELETE'])]
    public function delete(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'This route will soon allow a user to be removed !',
            'path' => 'src/Controller/UserController.php',
        ]);
    }
}
