<?php

namespace App\Controller;

use App\Dto\Response\Transformer\ProductTransformer;
use App\Entity\Product;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractApiController
{
    private ProductTransformer $productTransformer;

    public function __construct(ProductTransformer $productTransformer)
    {
        $this->productTransformer = $productTransformer;
    }

    /**
     * @Rest\Route("/api/v1/products")
     */
    public function indexAction(): Response
    {
        $orders = $this->getDoctrine()->getRepository(Product::class)->findAll();

        $dto = $this->productTransformer->transformFromObjects($orders);

        return $this->respond($dto);
    }

    /**
     * @Rest\Route("/api/v1/products/{id<\d+>}")
     */
    public function showAction(int $id): Response
    {
        $order = $this->getDoctrine()->getRepository(Product::class)->find($id);

        $dto = $this->productTransformer->transformFromObject($order);

        return $this->respond($dto);
    }
}
