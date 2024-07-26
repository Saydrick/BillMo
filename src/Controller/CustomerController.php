<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class CustomerController extends AbstractController
{
    // Retreive all customers /*** ADMIN ***/
    #[Route('/api/customers', name: 'app_customer', methods: ['GET'])]
    public function indexAll(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'This route will soon allow you to retrieve the list of all customers !',
            'path' => 'src/Controller/CustomerController.php',
        ]);
    }


    // Retreive the details of a customer /*** ADMIN ***/
    #[Route('/api/customer/{id}', name: 'app_customer.index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'This route will soon allow you to retrieve the details of a customer !',
            'path' => 'src/Controller/CustomerController.php',
        ]);
    }


    // Create a new customer /*** ADMIN ***/
    #[Route('/api/customers/{id}', name: 'app_customer.create', methods: ['POST'])]
    public function create(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'This route will soon allow a customer to be created !',
            'path' => 'src/Controller/CustomerController.php',
        ]);
    }


    // Modify a customer /*** ADMIN ***/
    #[Route('/api/customers/{id}', name: 'app_customer.edit', methods: ['PUT'])]
    public function edit(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'This route will soon allow a customer to be modified !',
            'path' => 'src/Controller/CustomerController.php',
        ]);
    }


    // Delete a customer /*** ADMIN ***/
    #[Route('/api/customers/{id}', name: 'app_customer.delete', methods: ['DELETE'])]
    public function delete(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'This route will soon allow a customer to be removed !',
            'path' => 'src/Controller/CustomerController.php',
        ]);
    }
}
