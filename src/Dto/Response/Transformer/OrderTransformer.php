<?php

declare(strict_types=1);

namespace App\Dto\Response\Transformer;

use App\Dto\Response\OrderResponse;
use App\Entity\Order;

class OrderTransformer extends AbstractTransformer
{
    private CustomerTransformer $customerTransformer;
    private ProductTransformer $productTransformer;

    /**
     * @param CustomerTransformer $customerTransformer
     * @param ProductTransformer $productTransformer
     */
    public function __construct(CustomerTransformer $customerTransformer, ProductTransformer $productTransformer)
    {
        $this->customerTransformer = $customerTransformer;
        $this->productTransformer = $productTransformer;
    }

    /**
     * @param Order $order
     */
    public function transformFromObject($order): OrderResponse
    {
        $dto = new OrderResponse();
        $dto->createdAt = $order->getCreatedAt();
        $dto->comment = $order->getComment();
        $dto->customer = $this->customerTransformer->transformFromObject($order->getCustomer());
        $dto->products = $this->productTransformer->transformFromObjects($order->getProducts());

        return $dto;
    }
}