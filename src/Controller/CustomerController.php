<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Customer;
use OpenApi\Attributes as OA;
use App\Repository\UserRepository;
use App\Repository\CustomerRepository;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CustomerController extends AbstractController
{
    // Retreive all customers /* ADMIN */
    #[Route('/api/v1/customer', name: 'app_customer', methods: ['GET'])]
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
        
        $customers_data = [];

        foreach($customers as $customer)
        {
            $customer_id = $customer->getId();
            $customer_name = $customer->getName();

            $customer_links = array('self' => array('href' => '/api/v1/customer/' . $customer_id . '/users'));
    
            $customer_data[] = array(
                'id' => $customer_id,
                'name' => $customer_name,
                '_links' => $customer_links,
            );
        }

        $jsonCustomers = $serializer->serialize($customer_data, 'json', ['groups' => 'getCustomers']);

        return new JsonResponse(
            $jsonCustomers,
            Response::HTTP_OK,
            [],
            true
        );
    }

    // Retreive all users linked to a customer /* USER */
    #[Route('/api/v1/customer/{customer}/users', name: 'app_customer.index', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    #[OA\Get(
        summary: "Voir la liste des utilisateurs liés à un client"
    )]
    #[OA\Parameter(
        name: "customer",
        in: "path",
        required: true,
        schema: new OA\Schema(type: "integer"),
        description: "ID du client"
    )]
    #[OA\Response(
        response: 200,
        description: "Voici la liste des utilisateurs liés au client",
        content: new OA\JsonContent(
            type: "object",
            properties: [
                new OA\Property(property: "id", type: "integer", example: 1),
                new OA\Property(property: "email", type: "string", example: "john.doe@example.com"),
                new OA\Property(property: "role", type: "string", example: "['ROLE_USER']"),
                new OA\Property(property: "customer", type: "object", properties: [
                    new OA\Property(property: "id", type: "integer", example: 1),
                    new OA\Property(property: "name", type: "string", example: "Nom du client")
                ])
            ]
        )
    )]
    #[OA\Response(
        response: 400,
        description: "Invalid input"
    )]
    #[OA\Tag(name: "Clients")]
    public function index(
        Customer $customer,
        UserRepository $repository,
        SerializerInterface $serializer
        ): JsonResponse
    {        
        $users = $repository->FindAllByCustomer($customer);

        $user_data = [];

        foreach($users as $user)
        {
            $user_id = $user->getId();
            $user_email = $user->getEmail();
            $user_roles = $user->getRoles();
            $user_customer = $user->getCustomer();
    
            $user_links = array(
                        'self' => array('href' => '/api/v1/customer/' . $customer->getId() . '/users/' . $user_id),
                        'create' => array('href' => '/api/v1/customer/' . $customer->getId() . '/users')
                    );
    
    
            $user_data[] = array(
                'id' => $user_id,
                'email' => $user_email,
                'roles' => $user_roles,
                'customer' => $user_customer,
                '_links' => $user_links,
            );
        }

        $jsonUsers = $serializer->serialize($user_data, 'json', ['groups' => 'getUsers']);

        return new JsonResponse(
            $jsonUsers,
            Response::HTTP_OK,
            [],
            true
        );
    }
}
