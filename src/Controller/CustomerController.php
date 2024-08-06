<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use OpenApi\Attributes as OA;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class CustomerController extends AbstractController
{
    // Retreive all customers /* ADMIN */
    #[Route('/api/customer', name: 'app_customer', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    #[OA\Get(
        summary: "Voir la liste des clients",
        description: "Disponible uniquement pour le rôle ['ROLE_ADMIN']"
    )]
    #[OA\Response(
        response: 200,
        description: "Voici la liste des clients",
        content: new OA\JsonContent(
            type: "object",
            properties: [
                new OA\Property(property: "id", type: "integer", example: 1),
                new OA\Property(property: "name", type: "string", example: "Nom du client")
            ]
        )
    )]
    #[OA\Response(
        response: 400,
        description: "Invalid input"
    )]
    #[OA\Tag(name: "Clients")]
    public function indexAll(
        CustomerRepository $repository,
        SerializerInterface $serializer
        ): JsonResponse
    {
        $customers = $repository->FindAll();
        $jsonCustomers = $serializer->serialize($customers, 'json', ['groups' => 'getCustomers']);

        return new JsonResponse(
            $jsonCustomers,
            Response::HTTP_OK,
            [],
            true
        );
    }
}
