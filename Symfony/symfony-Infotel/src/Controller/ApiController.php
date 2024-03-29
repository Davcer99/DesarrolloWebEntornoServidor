<?php

namespace App\Controller;
use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path:'/api')]
class ApiController extends AbstractController
{
    #[Route('/show/{id}', name: 'api-show',  methods: ['GET'])]
    public function show(ManagerRegistry $doctrine, $id): JsonResponse
    {
        $repository = $doctrine->getRepository(Product::class);
        $product = $repository->find($id);
        if (!$product)
            return new JsonResponse("[]", Response::HTTP_NOT_FOUND);
        
        $data = [
            "name" => $product->getName(),
            "brand" => $product->getBrand(),
            "processor" => $product->getProcessor(),
            "ram" => $product->getRam(),
            "storage" => $product->getStorage(),
            "price" => $product->getPrice(),
            "photo" => $product->getPhoto()
         ];
        return new JsonResponse($data, Response::HTTP_OK);
    }
}
