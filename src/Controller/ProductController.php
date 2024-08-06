<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use OpenApi\Attributes as OA;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProductController extends AbstractController
{
    // Retreive all products /* USER */
    #[Route('/api/products', name: 'app_product', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    #[OA\Get(
        summary: "Voir le détail d'un produit"
    )]
    #[OA\Response(
        response: 200,
        description: "Voici la liste des produits",
        content: new OA\JsonContent(
            type: "object",
            properties: [
                new OA\Property(property: "id", type: "integer", example: 1),
                new OA\Property(property: "name", type: "string", example: "Nom du produit"),
                new OA\Property(property: "description", type: "string", example: "Description du produit"),
                new OA\Property(property: "price", type: "float", example: 11.11)
            ]
        )
    )]
    #[OA\Response(
        response: 400,
        description: "Invalid input"
    )]
    #[OA\Tag(name: "Produits")]
    public function indexAll(
        ProductRepository $repository,
        SerializerInterface $serializer,
        TagAwareCacheInterface $cache
        ): JsonResponse
    {
        $idCache = "Products";

        $jsonProducts = $cache->get($idCache, function (ItemInterface $item) use ($repository, $serializer) {
            echo("L'élément n'est pas en cache !\n");
            $item->tag("productsCache");

            $products = $repository->findAll();
            return $serializer->serialize($products, 'json', ['groups' => 'getProducts']);
        });

        return new JsonResponse(
            $jsonProducts,
            Response::HTTP_OK,
            [],
            true
        );
    }


    // Retreive the details of a product /* USER */
    #[Route('/api/product/{id}', name: 'app_product.index', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    #[OA\Get(
        summary: "Voir le détail d'un produit"
    )]
    #[OA\Parameter(
        name: "product",
        in: "path",
        required: true,
        schema: new OA\Schema(type: "integer"),
        description: "ID du produit"
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: "object",
            properties: [
                new OA\Property(property: "productID", type: "int", example: 1)
            ]
        )
    )]
    #[OA\Response(
        response: 200,
        description: "Voici le détail du produit",
        content: new OA\JsonContent(
            type: "object",
            properties: [
                new OA\Property(property: "id", type: "integer", example: 1),
                new OA\Property(property: "name", type: "string", example: "Nom du produit"),
                new OA\Property(property: "description", type: "string", example: "Description du produit"),
                new OA\Property(property: "price", type: "float", example: 11.11)
            ]
        )
    )]
    #[OA\Response(
        response: 400,
        description: "Invalid input"
    )]
    #[OA\Tag(name: "Produits")]
    public function index(
        Product $product,
        SerializerInterface $serializer,
        TagAwareCacheInterface $cache
        ): JsonResponse
    {
        $idCache = "Product-" . $product->getId();

        $jsonProduct = $cache->get($idCache, function (ItemInterface $item) use ($product, $serializer) {
            $item->tag("productCache");

            return $serializer->serialize($product, 'json', ['groups' => 'getProducts']);
        });
        
        return new JsonResponse(
            $jsonProduct,
            Response::HTTP_OK,
            [],
            true
        );

    }
}
