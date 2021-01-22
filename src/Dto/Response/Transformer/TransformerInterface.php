<?php

declare(strict_types=1);

namespace App\Dto\Response\Transformer;

interface TransformerInterface
{
    public function transformFromObject($object);
    public function transformFromObjects(iterable $objects): iterable;
}