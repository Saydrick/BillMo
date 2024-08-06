<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Customer;
use OpenApi\Attributes as OA;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class UserController extends AbstractController
{
    public function __construct(private UserPasswordHasherInterface $userPasswordHasher)
    {        
    }
    
    // Retreive all users linked to a customer /* USER */
    #[Route('/api/customer/{customer}/users', name: 'app_user', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    #[OA\Get(
        summary: "Voir la liste des utilisateurs liés à un client"
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: "object",
            properties: [
                new OA\Property(property: "customer", type: "int", example: 1)
            ]
        )
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
    public function indexAll(
        Customer $customer,
        UserRepository $repository,
        SerializerInterface $serializer
        ): JsonResponse
    {
        $users = $repository->FindAllByCustomer($customer);
        $jsonUsers = $serializer->serialize($users, 'json', ['groups' => 'getUsers']);

        return new JsonResponse(
            $jsonUsers,
            Response::HTTP_OK,
            [],
            true
        );
    }


    // Retreive the details of a user /* USER */
    #[Route('/api/customer/{customer}/users/{user}', name: 'app_user.index', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    #[OA\Get(
        summary: "Voir le détail d'un utilisateur"
    )]
    #[OA\Parameter(
        name: "customer",
        in: "path",
        required: true,
        schema: new OA\Schema(type: "integer"),
        description: "ID du client"
    )]
    #[OA\Parameter(
        name: "user",
        in: "path",
        required: true,
        schema: new OA\Schema(type: "integer"),
        description: "ID de l'utilisateur"
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: "object",
            properties: [
                new OA\Property(property: "customerID", type: "int", example: 1),
                new OA\Property(property: "userID", type: "int", example: 1)
            ]
        )
    )]
    #[OA\Response(
        response: 200,
        description: "Voici le détail de l'utilisateur",
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
        User $user,
        UserRepository $repository,
        SerializerInterface $serializer,
        TagAwareCacheInterface $cache
        ): JsonResponse
    {
        $idCache = "getUser-" . $user->getId();
        
        
        $jsonUser = $cache->get($idCache, function (ItemInterface $item) use ($repository, $user, $serializer) {
            $item->tag("userCache");

            $user = $repository->findOneByID($user);
            return $serializer->serialize($user, 'json', ['groups' => 'getUsers']);
        });

        return new JsonResponse(
            $jsonUser,
            Response::HTTP_OK,
            [],
            true
        );
    }


    // Create a new user /* USER */
    #[Route('/api/customer/{customer}/users', name: 'app_user.create', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    #[OA\Post(
        summary: "Ajouter un nouvel utilisateur"
    )]
    #[OA\Parameter(
        name: "customer",
        in: "path",
        required: true,
        schema: new OA\Schema(type: "integer"),
        description: "ID du client"
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: "object",
            properties: [
                new OA\Property(property: "email", type: "string", example: "john.doe@example.com"),
                new OA\Property(property: "password", type: "string", example: "password123")
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: "L'utilisateur a bien été créé",
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
    public function create(
        Customer $customer,
        Request $request,
        SerializerInterface $serializer,
        EntityManagerInterface $em,
        ValidatorInterface $validator,
        UrlGeneratorInterface $urlGenerator
        ): JsonResponse 
    {
        $data = json_decode($request->getContent(), true);

        // dd($data);

        $user = new User();
        $user->setEmail($data['email']);
        $user->setPassword($this->userPasswordHasher->hashPassword($user, $data['password']));
        $user->setRoles(['ROLE_USER']);
        $user->setCustomer($customer);

        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            return new JsonResponse((string) $errors, JsonResponse::HTTP_BAD_REQUEST);
        }

        $em->persist($user);
        $em->flush();

        $jsonUser = $serializer->serialize($user, 'json', ['groups' => 'getUser']);

        $locatation = $urlGenerator->generate('app_user.index', ['customer' => $user->getCustomer()->getId(), 'user' => $user->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        return new JsonResponse($jsonUser, JsonResponse::HTTP_CREATED, ["location" => $locatation], true);
    }



    // Delete a user /* USER */
    #[Route('/api/customer/{customer}/users/{user}', name: 'app_user.delete', methods: ['DELETE'])]
    #[IsGranted('ROLE_USER')]
    #[OA\Delete(
        summary: "Supprimer un utilisateur"
    )]
    #[OA\Parameter(
        name: "customer",
        in: "path",
        required: true,
        schema: new OA\Schema(type: "integer"),
        description: "ID du client"
    )]
    #[OA\Parameter(
        name: "user",
        in: "path",
        required: true,
        schema: new OA\Schema(type: "integer"),
        description: "ID de l'utilisateur"
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: "object",
            properties: [
                new OA\Property(property: "email", type: "string", example: "john.doe@example.com"),
                new OA\Property(property: "password", type: "string", example: "password123")
            ]
        )
    )]
    #[OA\Response(
        response: 204,
        description: "L'utilisateur a bien été supprimé"
    )]
    #[OA\Response(
        response: 400,
        description: "Invalid input"
    )]
    #[OA\Tag(name: "Clients")]
    public function delete(
        User $user,
        EntityManagerInterface $em
    ): JsonResponse
    {
        $em->remove($user);
        $em->flush();

        return new JsonResponse(
            null,
            Response::HTTP_NO_CONTENT
        );
    }
}
