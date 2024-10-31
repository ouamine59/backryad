<?php

namespace App\Controller;

use App\Entity\Products ;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/products')]
class ProductsController extends AbstractController
{
    #[Route(
        name: 'api_admin_products_new',
        path: '/new',
        methods: ['POST'],
        // requirements:
        //    ['img'=>'.+']
    )]
    public function __invoke(Request $request, EntityManagerInterface $entityManager): Response
    {
        try {
            $data = json_decode($request->getContent(), true);
            dump($request->getContent());
            die;
            if (!$data || !isset($data["title"],
             $data["discount"], 
             $data["priceWithDiscount"], 
             $data["price"], 
             $data["description"], 
             $data["image"], 
             $data["categories"])) {
                return new JsonResponse(['error' => $data], Response::HTTP_BAD_REQUEST);
            }
    
            $product = new Products();
            $product->setTitle($data["title"]);
            $product->setDiscount($data["discount"]);
            $product->setPriceWithDiscount($data["priceWithDiscount"]);
            $product->setPrice($data["price"]);
            $product->setDescription($data["description"]);
            $product->setImage($data["image"]);
            $product->setCategories($data["categories"]);
    
            $entityManager->persist($product);
            $entityManager->flush();
    
            return new JsonResponse(['message' => 'Product created successfully'], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'An error occurred: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    #[Route(
        name: 'api_products_index',
        path: '/',
        methods: ['GET'],
        // requirements:
        //    ['img'=>'.+']
    )]
    public function index(ProductsRepository $productsRepository): Response
{
    try {
        $products = $productsRepository->findAllByCategorie();
        $result = [];
        foreach ($products as $product) {
            $result[] = [
                "title" => $product->getTitle(),
                "categories" => $product->getCategories(),
                "priceWithDiscount" => $product->getPriceWithDiscount(),
                "price" => $product->getPrice(),
                "description" => $product->getDescription(),
                "discount" => $product->getDiscount(),
                "image" => $product->getImageName()
            ]; 
        }
        return new JsonResponse(['result' => $result], Response::HTTP_OK);
    } catch (\Exception $e) {
        return new JsonResponse(['error' => 'An error occurred: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
}
