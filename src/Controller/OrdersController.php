<?php

namespace App\Controller;

use App\Repository\OrdersRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
#[Route('/orders', name: 'app_orders')]
class OrdersController extends AbstractController
{
    #[Route(
        name: 'api_orders_index_by_user',
        path: '/by-user/{idclient}',
        methods: ['GET'],
        // requirements:
        //    ['img'=>'.+']
    )]
    public function index(int $idclient, OrdersRepository $ordersRepository): Response
    {
        try {
            $orders = $ordersRepository->findAllById($idclient);
            $result = [];
            foreach ($orders as $order) {
                //recupration des rowsOrder
                 $result[] = [
                    "idOrders" => $order->getId(),
                    "states" => $order->getStates(),
                     "isCreatedAt" => $order->getIsCreatedAt(), 
                ]; 
            }
            return new JsonResponse(['result' => $result], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'An error occurred: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
