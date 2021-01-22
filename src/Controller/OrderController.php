<?php

namespace App\Controller;

use App\Dto\Response\Transformer\OrderTransformer;
use App\Entity\Order;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends AbstractApiController
{
    private OrderTransformer $orderTransformer;

    public function __construct(OrderTransformer $orderTransformer)
    {
        $this->orderTransformer = $orderTransformer;
    }

    /**
     * @Rest\Route("/api/v1/orders/{id<\d+>}")
     */
    public function showAction(int $id): Response
    {
        $order = $this->getDoctrine()->getRepository(Order::class)->find($id);

        $dto = $this->orderTransformer->transformFromObject($order);

        return $this->respond($dto);
    }
}
