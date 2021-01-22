<?php

declare(strict_types=1);

namespace App\Dto\Response;

use JMS\Serializer\Annotation as Serialization;

class OrderResponse
{
    /**
     * @Serialization\Type("App\Dto\Response\CustomerResponse")
     */
    public CustomerResponse $customer;

    /**
     * @Serialization\Type("array<App\Dto\Response\ProductResponse>")
     */
    public array $products;

    /**
     * @Serialization\Type("string")
     */
    public ?string $comment;

    /**
     * @Serialization\Type("DateTime<'Y-m-d\TH:i:s'>")
     */
    public \DateTime $createdAt;
}
