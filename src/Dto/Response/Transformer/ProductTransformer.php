<?php

declare(strict_types=1);

namespace App\Dto\Response\Transformer;

use App\Dto\Response\ProductResponse;
use App\Entity\Product;

class ProductTransformer extends AbstractTransformer
{
    /**
     * @param Product $product
     */
    public function transformFromObject($product): ProductResponse
    {
        $dto = new ProductResponse();
        $dto->code = $product->getCode();
        $dto->title = $product->getTitle();
        $dto->description = $product->getDescription();
        $dto->price = $product->getPrice();

        return $dto;
    }
}