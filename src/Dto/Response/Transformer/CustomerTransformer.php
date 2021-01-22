<?php

declare(strict_types=1);

namespace App\Dto\Response\Transformer;

use App\Dto\Exception\UnexpectedTypeException;
use App\Dto\Response\CustomerResponse;
use App\Entity\Customer;

class CustomerTransformer extends AbstractTransformer
{
    /**
     * @param Customer $customer
     */
    public function transformFromObject($customer): CustomerResponse
    {
        if (!$customer instanceof Customer) {
            throw new UnexpectedTypeException('Expected type of Customer but got '.\get_class($customer));
        }

        $dto = new CustomerResponse();
        $dto->email = $customer->getEmail();
        $dto->phoneNumber = $customer->getPhoneNumber();

        return $dto;
    }
}