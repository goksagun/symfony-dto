<?php

declare(strict_types=1);

namespace App\Dto\Response;

use JMS\Serializer\Annotation as Serialization;

/**
 * @Serialization\VirtualProperty(
 *     name="completedOrders",
 *     exp="object.getCompletedOrders()",
 *     options={@Serialization\SerializedName("completed_orders")}
 * )
 */
class CustomerStatisticResponse
{
    /**
     * @Serialization\Type("int")
     */
    public int $customerId;

    /**
     * @Serialization\Type("int")
     */
    public int $orderTotalCount;

    /**
     * @Serialization\Type("float")
     * @Serialization\Accessor(getter="getOrderTotalPrice")
     * @Serialization\Groups("Admin")
     */
    public \Closure $orderTotalPrice;

    /**
     * @return float
     */
    public function getOrderTotalPrice(): float
    {
        $callable = $this->orderTotalPrice;

        return $callable();
    }

    /**
     * @param \Closure $orderTotalPrice
     */
    public function setOrderTotalPrice(\Closure $orderTotalPrice): void
    {
        $this->orderTotalPrice = $orderTotalPrice;
    }

    public function getCompletedOrders(): int
    {
        return random_int(10, 25);
    }
}