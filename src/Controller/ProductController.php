<?php

namespace App\Controller;

use App\Entity\Product;
use OpenApi\Attributes as OA;
use App\Repository\ProductRepository;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    // Retreive all products /* USER */
    #[Route('/api/v1/products', name: 'app_product', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    #[OA\Get(
        summary: "Voir la liste des produits"
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
            $item->tag("productsCache");

            $products = $repository->findAll();

            $product_data = [];

            foreach($products as $product)
            {    
                $product_id = $product->getId();
                $product_name = $product->getName();
                $product_description = $product->getDescription();
                $product_price = $product->getPrice();

                $product_links = array('self' => array('href' => '/api/v1/product/' . $product_id));

                $product_data[] = array(
                    'id' => $product_id,
                    'name' => $product_name,
                    'description' => $product_description,
                    'price' => $product_price,
                    '_links' => $product_links,
                );
            }
    
            return $serializer->serialize($product_data, 'json', ['groups' => 'getProducts']);
        });

        return new JsonResponse(
            $jsonProducts,
            Response::HTTP_OK,
            [],
            true
        );
    }


    // Retreive the details of a product /* USER */
    #[Route('/api/v1/product/{id}', name: 'app_product.index', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    #[OA\Get(
        summary: "Voir le détail d'un produit"
    )]
    #[OA\Parameter(
        name: "id",
        in: "path",
        required: true,
        schema: new OA\Schema(type: "integer"),
        description: "ID du produit"
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
