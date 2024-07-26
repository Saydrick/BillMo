<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    // Retreive all products /* USER */
    #[Route('/api/products', name: 'app_product', methods: ['GET'])]
    public function indexAll(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'This route will soon allow you to retrieve the list of all products !',
            'path' => 'src/Controller/ProductController.php',
        ]);
    }


    // Retreive the details of a product /* USER */
    #[Route('/api/product/{id}', name: 'app_product.index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'This route will soon allow you to retrieve the details of a product !',
            'path' => 'src/Controller/ProductController.php',
        ]);
    }


    // Create a new product /*** ADMIN ***/
    #[Route('/api/products/{id}', name: 'app_product.create', methods: ['POST'])]
    public function create(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'This route will soon allow a product to be created !',
            'path' => 'src/Controller/ProductController.php',
        ]);
    }


    // Modify a product /*** ADMIN ***/
    #[Route('/api/products/{id}', name: 'app_product.edit', methods: ['PUT'])]
    public function edit(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'This route will soon allow a product to be modified !',
            'path' => 'src/Controller/ProductController.php',
        ]);
    }


    // Delete a product /*** ADMIN ***/
    #[Route('/api/products/{id}', name: 'app_product.delete', methods: ['DELETE'])]
    public function delete(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'This route will soon allow a product to be removed !',
            'path' => 'src/Controller/ProductController.php',
        ]);
    }
}
