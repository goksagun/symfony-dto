<?php

declare(strict_types=1);

namespace App\Dto\Response\Transformer;

use App\Dto\Exception\UnexpectedTypeException;
use App\Dto\Response\CustomerStatisticResponse;
use App\Entity\Customer;
use App\Repository\OrderRepository;

class CustomerStatisticTransformer extends AbstractTransformer
{
    private OrderRepository $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Customer $customer
     */
    public function transformFromObject($customer): CustomerStatisticResponse
    {
        if (!$customer instanceof Customer) {
            throw new UnexpectedTypeException('Expected type of Customer but got '.\get_class($customer));
        }

        $dto = new CustomerStatisticResponse();
        $dto->customerId = $customer->getId();
        $dto->orderTotalCount = $this->repository->findTotalCountByCustomer($customer);
        $dto->setOrderTotalPrice(
            function () use ($customer) {
                return $this->repository->findTotalPriceByCustomer($customer);
            }
        );

        return $dto;
    }
}